<?php

namespace App\Http\Controllers;

use App\Models\Evento;
use App\Models\Generale;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class EventoController extends Controller
{
    protected $listeners = ['render'=>'show'];

    public function show($evento_id){
        $sobreventa = Evento::find($evento_id)->sobreventa;
        $evento = Evento::find($evento_id);
        return view('eventos.show', compact('evento', 'sobreventa'));
    }

    public function print($evento_id)
    {

        $reservas = DB::table('reservas')
                    ->join('funcione_reserva','reservas.id','=','funcione_reserva.reserva_id')
                    ->join('funciones','funcione_reserva.funcione_id','=','funciones.id')
                    ->join('temas','funciones.tema_id','=','temas.id')
                    ->join('eventos','eventos.id','=','funciones.evento_id')
                    ->select('eventos.id as evento_id', 'eventos.lugar', 'funciones.id as funcion_id','temas.titulo', 'funciones.fecha', 
                            'funciones.horario', 'reservas.codigo_res', 'reservas.usuario', 'reservas.telefono',
                            'reservas.cant_adul','reservas.cant_esp','reservas.importe','funciones.capacidad')
                    ->where('evento_id', '=', $evento_id)
                    ->orderBy('funciones.fecha')
                    ->orderBy('funciones.horario')
                    ->orderBy('temas.titulo')
                    ->orderBy('reservas.codigo_res')
                    ->get();

        
        $pdf = PDF::loadView('admin.eventos.print', compact('reservas'));
        return $pdf->stream('reservas.pdf');

    }
}
