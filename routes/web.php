<?php

use App\Http\Controllers\Admin\Ocupacion;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventoController;
use App\Http\Livewire\ShowEventos;
use App\Http\Controllers\Admin\GeneraleController;
use App\Http\Controllers\WebHookController;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::middleware(['auth:sanctum', 'verified'])->get('/admin', [GeneraleController::class, 'index'])->name('admin');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/mensajes', function () {
    return view('admin.mensajes.index');
})->name('adminmens');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/nuevareserva', function () {
    return view('admin.nuevareserva.index');
})->name('nuevareserva');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/ocupacion', [Ocupacion::class, 'index'])
->name('ocupacion');

Route::middleware(['auth:sanctum', 'verified'])->get('/admin/eventoprint/{id_event}', [EventoController::class, 'print'])
->name('eventoprint');


Route::get('users/report', 'UsersController@report');

Route::post('/webhook', [WebHookController::class, 'handle']);

Route::get('/', ShowEventos::class)->name('home');

Route::get('/{id_event}', [EventoController::class, 'show'])->name('evento.show');




