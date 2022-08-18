<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\EventoController;
use App\Http\Controllers\Admin\FuncionController;
use App\Http\Controllers\Admin\GeneraleController;
use App\Http\Controllers\Admin\ReservaController;
use App\Http\Controllers\Admin\TemaController;
use App\Http\Controllers\Admin\UsuarioController;

Route::resource('generales', GeneraleController::class)->names('admin.generales');

Route::resource('temas', TemaController::class)->names('admin.temas');

Route::resource('eventos', EventoController::class)->names('admin.eventos');

Route::resource('funciones', FuncionController::class)->names('admin.funciones');

Route::resource('reservas', ReservaController::class)->names('admin.reservas');

Route::resource('usuarios', UsuarioController::class)->names('admin.usuarios');

