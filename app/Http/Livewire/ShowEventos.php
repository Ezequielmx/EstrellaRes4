<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evento;

class ShowEventos extends Component
{
    public function render()
    {
        $eventos = Evento::where('activo', 1)->get();
        return view('livewire.show-eventos', compact('eventos'));
    }
}
