<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Funcione extends Model
{
    use HasFactory;

    protected $fillable= ['evento_id', 'capacidad', 'horario', 'fecha', 'tema_id'];
    
    public function evento(){
        return $this->belongsTo('App\Models\Evento');
    }

    public function tema(){
        return $this->belongsTo('App\Models\Tema');
    }

    public function reservas(){
        return $this->belongsToMany('App\Models\Reserva');
    }

    public function tot_res(){
        $tot_res = DB::table('funciones')
        ->leftjoin('funcione_reserva', 'funcione_reserva.funcione_id', '=', 'funciones.id')
        ->leftjoin('reservas', 'funcione_reserva.reserva_id', '=', 'reservas.id')
        ->select(DB::raw('SUM(COALESCE(cant_adul,0)+COALESCE(cant_esp,0))  as ent_reserv'))
        ->where('funciones.id', '=', $this->id)
        ->groupBy('funciones.id')
        ->value('ent_reserv');

        return $tot_res;
    }
}
