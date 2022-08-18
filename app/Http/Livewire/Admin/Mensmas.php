<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Evento;
use App\Services\AvisoWpp;
use App\Models\Funcione;

use function PHPUnit\Framework\isNull;

class Mensmas extends Component
{
    public $eventoSel;
    public $funcionSel;
    public $mensaje;
    public $cantRes;


    protected $rules = [
        'eventoSel' => 'required',
        'funcionSel' => 'required|min:1',
        'mensaje' => 'required'
    ];

    public function render()
    {   
        $eventos = Evento::all();
        $funciones = Evento::find($this->eventoSel)->temas_func();     
        return view('livewire.admin.mensmas', compact('eventos', 'funciones'));
    }

    public function mount(){
        $this->eventoSel= Evento::first()->id;
    }

    public function save(){
        $this->validate();
        $avwpp = new AvisoWpp($this->funcionSel, $this->mensaje);
        $avwpp->wppAviso();

        $this->reset('mensaje');
        $this->emit('enviado');
    }

    public function updatedeventoSel(){
        $this->funcionSel= null;
    }

    public function updatedfuncionSel(){
        if(is_null($this->funcionSel)){
            $this->cantRes = -1;
        }
        else{
            $this->cantRes = Funcione::find($this->funcionSel)->reservas->count(); 
        }
    }


}
