<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Evento extends Model
{
    use HasFactory;

    protected $fillable= ['lugar', 'ubicacion', 'direccion', 'speach', 'precio', 'precio_seg','precio_prom', 'sobreventa', 'imagen', 'activo'];

    public function funciones(){
        return $this->hasMany('App\Models\Funcione');
    }

    public function temas_func(){
        $func_ent = DB::table('funcione_reserva')
        ->join('reservas', 'reservas.id', '=', 'funcione_reserva.reserva_id')
        ->select('funcione_reserva.funcione_id', DB::raw('SUM(COALESCE(cant_adul, 0) + COALESCE(cant_esp,0)) as cant_total'))
        ->groupBy('funcione_reserva.funcione_id')
        ;

        $temas_funcs = DB::table('eventos')
            ->join('funciones', 'eventos.id', '=', 'funciones.evento_id')
            ->join('temas', 'funciones.tema_id', '=', 'temas.id')
            ->select('temas.id', 'temas.titulo', 'temas.descripcion', 'temas.imagen', 'temas.video', 'temas.duracion', 'fecha', 'horario', 'capacidad', DB::raw('COALESCE(cant_total,0) as cant_total'), 'funciones.id as func_id')
            ->orderBy('temas.id')->orderBy('fecha')->orderBy('horario')
            ->where('eventos.id', '=', $this->id)
            ->leftjoinSub($func_ent, 'func_ent', function ($join) {
                $join->on('funciones.id', '=', 'func_ent.funcione_id');})
            ->get()
            ;
        return $temas_funcs;

    }

    public function fechas(){
        $fechas = DB::table('eventos')
        ->join('funciones', 'eventos.id', '=', 'funciones.evento_id')
        ->select('fecha')
        ->where('eventos.id', '=', $this->id)
        ->orderBy('fecha')
        ->distinct()
        ->get()
        ;
        return $fechas;
    }

    public function duracion(){

        $duracion = DB::table('generales')
        ->select('minutos')
        ->first();


        return $duracion;
    }
}
