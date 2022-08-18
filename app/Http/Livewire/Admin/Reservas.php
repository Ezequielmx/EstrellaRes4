<?php

namespace App\Http\Livewire\Admin;

use App\Models\Reserva;
use Livewire\Component;
use Illuminate\Support\Facades\DB;
use App\Jobs\DeleteRowsSheet;

class Reservas extends Component
{
     public $searchUser;
     public $searchCod;
     public $searchTel;

     protected $listeners = ['deleteRes'];

    public function render()
    {
        
        $reservt = DB::table('reservas')
        ->join('funcione_reserva', 'reservas.id', '=', 'funcione_reserva.reserva_id') 
        ->join('funciones', 'funcione_reserva.funcione_id', '=', 'funciones.id') 
        ->join('temas', 'funciones.tema_id', '=', 'temas.id') 
        ->join('eventos', 'eventos.id', '=', 'funciones.evento_id')
        ->select(
                'eventos.activo',
                'eventos.lugar',
                'temas.titulo', 
                'funciones.fecha', 
                'funciones.horario', 
                'reservas.id', 
                'reservas.usuario', 
                'reservas.telefono',
                'reservas.cant_adul',
                'reservas.cant_esp',
                'reservas.importe',
                'funciones.capacidad')
        ->where('usuario','like','%' . $this->searchUser . '%')
        ->where('telefono','like','%' . $this->searchTel. '%')
        ->where('reservas.id','like','%' . $this->searchCod . '%')
        ->orderByDesc('eventos.activo')
        ->orderBy('reservas.id')
        ->limit(30)
        ->get();

        return view('livewire.admin.reservas', compact('reservt'));
    }

    public function deleteRes(Reserva $reserva){
        $reserva->delete();
    }
}
