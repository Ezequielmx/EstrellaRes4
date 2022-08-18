<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Reserva;
use App\Models\Funcione;

class Showres extends Component
{
    public $funcione;

    protected $listeners = ['deleteRes'];

    public function mount(Funcione $funcione){
        $this->funcione = $funcione;
    }


    public function render()
    {
        return view('livewire.admin.showres');
    }

    public function deleteRes(Reserva $reserva){
        $reserva->delete();
    }
}
