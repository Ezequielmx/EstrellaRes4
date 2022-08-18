<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Generale;
use App\Models\Reserva;
use App\Services\SaveResSheet;

class Newreserva extends Component
{
    public $eventoSel;

    public $selectedFunc1;
    public $cap_func1;
    public $cap_sob_func1;
    public $reserv_func1;
    public $disp_func1;


    public $selectedFunc2;
    public $cap_func2;
    public $cap_sob_func2;
    public $reserv_func2;
    public $disp_func2;

    public $usuario;
    public $tel;
    public $precio;
    public $precio_seg;

    public $entr_gral;
    public $entr_seg;
    public $cant_funciones=0;
    public $importe;

    protected $rules = [
        'usuario' => 'required|min:3',
        'tel' => 'required|digits:10'
    ];

    public function mount()
    {
        $this->eventoSel = Evento::first()->id;
        $this->sobreventa = Generale::First()->value('sobreventa');
        $this->entr_seg=0;
        $this->entr_gral=1;

        $this->precio = Evento::find($this->eventoSel)->precio;
        $this->precio_seg = Evento::find($this->eventoSel)->precio_seg;
    }

    public function render()
    {
        $eventos = Evento::all();
        $funciones = Evento::find($this->eventoSel)->temas_func();
        return view('livewire.admin.newreserva', compact('eventos', 'funciones'));
    }

    public function updatedselectedFunc1($func1_id)
    {
        if ($func1_id>0) {
            $func1 = Evento::find($this->eventoSel)->temas_func()->where('func_id','=', $func1_id)->first();

            $this->cap_func1 = $func1->capacidad;
            $this->cap_sob_func1 = $func1->capacidad * (1 + $this->sobreventa/100);
            $this->reserv_func1 = $func1->cant_total;
            $this->disp_func1 = $func1->capacidad * (1 + $this->sobreventa/100)-($func1->cant_total);

            $this->precio = Evento::find($this->eventoSel)->precio;
            $this->cant_funciones=1;
        }
        else
        {
            $this->cap_func1 = null;
            $this->cap_sob_func1 = null;
            $this->reserv_func1 = null;
            $this->disp_func1 = null;

            $this->precio = null;
            $this->cant_funciones=0;
        }

        $this->selectedFunc2 = null;
        $this->cap_func2 = null;
        $this->cap_sob_func2 = null;
        $this->reserv_func2 = null;
        $this->disp_func2 = null;
    }


    public function updatedselectedFunc2($func2_id)
    {
        if ($func2_id>0) {
            $func2 = Evento::find($this->eventoSel)->temas_func()->where('func_id','=', $func2_id)->first();

            $this->cap_func2 = $func2->capacidad;
            $this->cap_sob_func2 = $func2->capacidad * (1 + $this->sobreventa/100);
            $this->reserv_func2 = $func2->cant_total;
            $this->disp_func2 = $func2->capacidad * (1 + $this->sobreventa/100)-($func2->cant_total);

            $this->precio = Evento::find($this->eventoSel)->precio_prom;
            $this->cant_funciones=2;
        }
        else
        {
            $this->cap_func2 = null;
            $this->cap_sob_func2 = null;
            $this->reserv_func2 = null;
            $this->disp_func2 = null;

            $this->precio = Evento::find($this->eventoSel)->precio;
            $this->cant_funciones=1;
        }  
    }

    public function updatedeventoSel()
    {
        $this->selectedFunc1 = null;
        $this->cap_func1 = null;
        $this->cap_sob_func1 = null;
        $this->reserv_func1 = null;
        $this->disp_func1 = null;

        $this->selectedFunc2 = null;
        $this->cap_func2 = null;
        $this->cap_sob_func2 = null;
        $this->reserv_func2 = null;
        $this->disp_func2 = null;
    }


    public function save()
    {
        $this->validate();

        setlocale(LC_TIME, "spanish");
        
        $reserva = new Reserva();

        $reserva->codigo_res="123";
        if(is_null($this->importe)){
            $reserva->importe=$this->entr_gral * $this->precio * $this->cant_funciones + $this->entr_seg * $this->precio_seg * $this->cant_funciones;
        }else{
            $reserva->importe=$this->importe;
        }
        
        $reserva->usuario = $this->usuario;
        $reserva->telefono = $this->tel;
        $reserva->cant_adul = $this->entr_gral;
        $reserva->cant_esp = $this->entr_seg;
        $reserva->wppconf = '0';
        $reserva->wpprecord = '0';

        $reserva->save();
        $reserva->codigo_res=str_pad($reserva->id, 4 ,"0", STR_PAD_LEFT);
        $reserva->save();

        $reserva->funciones()->attach($this->selectedFunc1);

        if ($this->selectedFunc2<0) {
            $this->selectedFunc2 = null;
        }

        if (!is_null($this->selectedFunc2)) {
            $reserva->funciones()->attach($this->selectedFunc2);
        }

        $mensaje = 'Reserva registrada.<br> Código de reserva: <b>' . str_pad($reserva->id, 4 ,"0", STR_PAD_LEFT) . 
        '</b><br>Detalles enviados por WhatsApp al usuario.'; 

        $this->reset(['usuario', 'tel']);
        
        $this->emit('alerta', $mensaje);

        $resSheet = new SaveResSheet($reserva, Evento::find($this->eventoSel), $this->selectedFunc1, $this->selectedFunc2);
       
        
        //$resSheet->save();

        $resSheet->wppConf();
        
    }
}
