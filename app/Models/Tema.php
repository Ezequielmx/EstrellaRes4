<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tema extends Model
{
    use HasFactory;

    protected $fillable= ['titulo', 'descripcion', 'duracion', 'imagen'];

    public function funciones(){
        return $this->hasMany('App\Models\Funcione');
    } 
}
