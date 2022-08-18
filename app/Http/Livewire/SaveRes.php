<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Reserva;
use App\Services\SaveResSheet;



class SaveRes extends Component
{
    protected $listeners = ['saveResU'];

    public function render()
    {
        return view('livewire.save-res');
    }

    public function saveResU(int $importe, string $usuario , string $telefono, int $cant_adul, int $cant_esp, $selectedFunc1, $selectedFunc2, int $evento_id){

        setlocale(LC_TIME, "spanish");

        $evt = Evento::find($evento_id);

        $reserva = new Reserva();

        $reserva->codigo_res='123';
        $reserva->importe=$importe;
        $reserva->usuario = $usuario;
        $reserva->telefono = $telefono;
        $reserva->cant_adul = $cant_adul;
        $reserva->cant_esp = $cant_esp;
        $reserva->wppconf = '0';
        $reserva->wpprecord = '0';

        $reserva->save();
        $reserva->codigo_res=str_pad($reserva->id, 4 ,"0", STR_PAD_LEFT);
        $reserva->save();

        $reserva->funciones()->attach($selectedFunc1);

        if (!is_null($selectedFunc2)) {
            $reserva->funciones()->attach($selectedFunc2);
        }

        $mensaje = 'Tu reserva ya está registrada.<br> Código de reserva: <b>' . str_pad($reserva->id, 4 ,"0", STR_PAD_LEFT) . 
        '</b><br>Recibirás todos los detalles por WhatsApp. <br> <b>Te esperamos!</b>'; 
        
        $resSheet = new SaveResSheet($reserva, $evt, $selectedFunc1, $selectedFunc2);
        
        //$resSheet->save();

        $resSheet->wppConf();

        $this->emit('alert', $mensaje, 'Listo!!', 'success');

        $this->emit('resetP');
    } 


}
