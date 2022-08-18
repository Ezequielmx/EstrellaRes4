<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Tema;
use App\Models\Funcione;

class Showfunc extends Component
{
    public $evento;
    public $temas;

    protected $listeners = ['deleteFun'];

    public function mount(Evento $evento){
        $this->evento = $evento;
        $this->temas = Tema::pluck('titulo', 'id');
    }


    public function render()
    {
        return view('livewire.admin.showfunc');
    }

    public function deleteFun(Funcione $funcion){
        $funcion->delete();
    }
}
