<?php

namespace App\Services;

use App\Jobs\AvisoFuncion;
use App\Jobs\ReservaWpp;
use App\Models\Funcione;
use App\Models\Tema;
use App\Jobs\ReservaSheet;
use Illuminate\Support\Facades\DB;

class AvisoWpp
{

    public $eventoSel;
    public $funcionSel;
    public $reservas;
    public $mensaje; 

    public function __construct(int $funcSel, String $mensaje)
    {   
        $this->mensaje = $mensaje;
        $this->reservas = DB::table('reservas')
                        ->join('funcione_reserva', 'reservas.id', '=', 'funcione_reserva.reserva_id') 
                        ->join('funciones', 'funcione_reserva.funcione_id', '=', 'funciones.id') 
                        ->join('temas', 'funciones.tema_id', '=', 'temas.id') 
                        ->join('eventos', 'funciones.evento_id', '=', 'eventos.id') 
                        ->select(
                                'reservas.id',
                                'reservas.usuario',
                                'reservas.telefono',
                                'funciones.id',
                                'temas.titulo',
                                'funciones.fecha',
                                'funciones.horario'
                                )
                        ->where('funciones.id', '=', $funcSel)
                        ->get();
    }

    public function wppAviso()
    {
        setlocale(LC_TIME, "spanish");

        foreach ($this->reservas as $reserva) {

            $this->mensaje = str_replace("\n", "\\n", $this->mensaje);

            $name = $reserva->usuario ;
            $cel = "549" . $reserva->telefono;
            $mens= "*Hola $name!* \\nTenemos un *AVISO IMPORTANTE* acerca de tu reserva para el Planetario Móvil - Función: $reserva->titulo -" . 
                    utf8_encode(strftime('%A %d de %B', strtotime($reserva->fecha))) . 
                    " - " . strftime('%H:%M', strtotime($reserva->horario )) . "\\n" . $this->mensaje;

            

            AvisoFuncion::dispatch($cel, $mens);
        } 

    }

}