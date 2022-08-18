<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Evento;



class Testliv extends Component
{

    protected $listeners = ['delete'];

    public $search;

    public function render()
    {
        $eventos = Evento::all()->sortBy('lugar')->sortByDesc('activo');
        return view('livewire.admin.testliv', compact('eventos'));
    }

    public function delete(Evento $evento){
        $evento->delete();
    }
}
