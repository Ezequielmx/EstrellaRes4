<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Funcione;
use Illuminate\Support\Facades\DB;

class ReservaChart extends Component
{

    public $eventoSel;
    public $fechaSel;
    public $resTotal;

    public function render()
    {   
        $eventos = Evento::all();
        $fechas = DB::table('funciones')
        ->select('fecha')
        ->distinct()
        ->where('funciones.evento_id', "=", $this->eventoSel)  
        ->orderBy('fecha')
        ->get();

        return view('livewire.admin.reserva-chart', compact('eventos','fechas'));
    }

    public function mount(){
        $this->eventoSel= Evento::first()->id;


        $fechas = DB::table('funciones')
        ->select('fecha')
        ->distinct()
        ->where('funciones.evento_id', "=", $this->eventoSel)  
        ->orderBy('fecha')
        ->get();

        $this->fechaSel = $fechas->first()->fecha;        
    }

    public function updatedfechaSel(){
        setlocale(LC_TIME, "spanish");
        $titulo = Evento::find($this->eventoSel)->lugar . " - " . utf8_encode(strftime("%A %d de %B", strtotime($this->fechaSel)));
        $this->datos();
    }

    public function updatedEventoSel(){
        setlocale(LC_TIME, "spanish");
        $fechas = DB::table('funciones')
        ->select('fecha')
        ->distinct()
        ->where('funciones.evento_id', "=", $this->eventoSel)  
        ->orderBy('fecha')
        ->get();

        $this->fechaSel = $fechas->first()->fecha;

        $this->datos();

    }

    public function datos(){

        setlocale(LC_TIME, "spanish");

        $dat = DB::select("SELECT
                    funciones.id,
                    temas.titulo, 
                    funciones.fecha, 
                    funciones.horario, 
                    SUM(reservas.cant_adul + reservas.cant_esp) as reservas,
                    MAX(funciones.capacidad) - SUM(reservas.cant_adul + reservas.cant_esp) as disponible
                FROM `reservas`
                JOIN funcione_reserva ON reservas.id = funcione_reserva.reserva_id
                JOIN funciones ON funcione_reserva.funcione_id = funciones.id
                JOIN temas ON funciones.tema_id= temas.id
                WHERE funciones.evento_id = $this->eventoSel and funciones.fecha ='$this->fechaSel'
                GROUP BY 
                    funciones.id,
                    temas.titulo, 
                    funciones.fecha, 
                    funciones.horario
                ORDER BY 	
                    funciones.fecha, 
                    funciones.horario,
                    funciones.id");

        $categorias = array();
        $dataRes = array();
        $dataLib = array();
        $this->resTotal=0;
        foreach($dat as $funcion){
            array_push($categorias, $funcion->titulo . " - " . utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha)))  . " - " . strftime("%H:%M", strtotime($funcion->horario)));
            array_push($dataRes, $funcion->reservas);
            array_push($dataLib, $funcion->disponible);
            $this->resTotal += $funcion->reservas;
        }

        
        $titulo = Evento::find($this->eventoSel)->lugar . " - " . utf8_encode(strftime("%A %d de %B", strtotime($this->fechaSel)));
        $this->emit('graph', $titulo, $categorias, $dataRes, $dataLib);
    }

}
