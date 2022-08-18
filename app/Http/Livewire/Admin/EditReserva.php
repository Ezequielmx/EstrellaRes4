<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Generale;
use App\Models\Reserva;
use App\Services\SaveResSheet;
use App\Models\Funcione;

class EditReserva extends Component
{
    public $eventoSel;
    public $reserva;

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

    public $test;

    protected $rules = [
        'usuario' => 'required|min:3',
        'tel' => 'required|digits:10'
    ];

    public function mount(Reserva $reserva)
    {
        $this->reserva = $reserva;
        $this->usuario = $reserva->usuario;
        $this->tel = $reserva->telefono;
        $this->eventoSel = $reserva->funciones->first()->evento->id;
        $this->sobreventa = Generale::First()->value('sobreventa');
        $this->entr_seg=$reserva->cant_esp;
        $this->entr_gral=$reserva->cant_adul;

        $this->precio = Evento::find($this->eventoSel)->precio;
        $this->precio_seg = Evento::find($this->eventoSel)->precio_seg;
        $this->selectedFunc1 = $reserva->funciones->first()->id;
        $this->importe = $reserva->importe;

        $func1 = Evento::find($this->eventoSel)->temas_func()->where('func_id','=', $this->selectedFunc1)->first();

        $this->cap_func1 = $func1->capacidad;
        $this->cap_sob_func1 = $func1->capacidad * (1 + $this->sobreventa/100);
        $this->reserv_func1 = $func1->cant_total;
        $this->disp_func1 = $func1->capacidad * (1 + $this->sobreventa/100)-($func1->cant_total);

        $this->precio = Evento::find($this->eventoSel)->precio;
        $this->cant_funciones=1;

        if($reserva->funciones->count()>1){
            $this->selectedFunc2 = $reserva->funciones->last()->id;

            $func2 = Evento::find($this->eventoSel)->temas_func()->where('func_id','=', $this->selectedFunc2)->first();

            $this->cap_func2 = $func2->capacidad;
            $this->cap_sob_func2 = $func2->capacidad * (1 + $this->sobreventa/100);
            $this->reserv_func2 = $func2->cant_total;
            $this->disp_func2 = $func2->capacidad * (1 + $this->sobreventa/100)-($func2->cant_total);

            $this->precio = Evento::find($this->eventoSel)->precio_prom;
            $this->cant_funciones=2;



        }


    
    }


    public function render()
    {
        $reserva = $this->reserva;
        $eventos = Evento::all();
        $funciones = Evento::find($this->eventoSel)->temas_func();
        return view('livewire.admin.edit-reserva', compact('eventos', 'funciones', 'reserva'));
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
        $this->importe = null;
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

        $this->importe = null;
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
        $this->importe = null;
    }

    public function updated(){
        $this->importe = null;
    }

    public function save()
    {
        $this->validate();

        setlocale(LC_TIME, "spanish");
        
        //$reserva = new Reserva();

  
        if(is_null($this->importe)){
            $this->reserva->importe=$this->entr_gral * $this->precio * $this->cant_funciones + $this->entr_seg * $this->precio_seg * $this->cant_funciones;
        }else{
            $this->reserva->importe=$this->importe;
        }
        
        $this->reserva->usuario = $this->usuario;
        $this->reserva->telefono = $this->tel;
        $this->reserva->cant_adul = $this->entr_gral;
        $this->reserva->cant_esp = $this->entr_seg;
        $this->reserva->wppconf = '0';
        $this->reserva->wpprecord = '0';

        $this->reserva->save();

        $func_att = [$this->selectedFunc1];

        //$this->reserva->funciones()->attach($this->selectedFunc1);

        if ($this->selectedFunc2<0) {
            $this->selectedFunc2 = null;
        }

        if (!is_null($this->selectedFunc2)) {
            array_push($func_att, $this->selectedFunc2);
        }

        $this->reserva->funciones()->sync($func_att);

        $resSheet = new SaveResSheet($this->reserva, Evento::find($this->eventoSel), $this->selectedFunc1, $this->selectedFunc2);
       
        $resSheet->wppConf();

        return redirect()->route('admin.reservas.index')->with('info', 'Reserva actualizada con éxito. Se reenvió Whatsapp al Usuario.');
        
    }
}

