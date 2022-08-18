<?php

namespace App\Http\Livewire;

use Livewire\Component;
use App\Models\Evento;
use App\Models\Reserva;
use App\Services\SaveResSheet;
use App\Models\Generale;
use Illuminate\Queue\Listener;
use Illuminate\Support\Facades\DB;
use App\Models\Funcione;
use App\Models\Tema;


class ReservaEvento extends Component
{
    public $evento;

    public $open = false;
    public $entr_gral = 1;
    public $entr_seg = 0;
    public $usuario = null;
    public $tel = null;
    public $selectedFunc1 = null;
    public $selectedFunc2 = null;
    public $temaFunc1 = null;
    public $funciones1 = null;
    public $precio = 0;
    public $precio_seg = 0;
    public $func_id;
    public $sobreventa;
    public $maxEntr;
    public $cant_funciones=1;

    protected $listeners = ['resetP'];

    protected $rules = [
        'usuario' => 'required|min:3',
        'tel' => 'required|digits:10'
    ];

    public function mount(Evento $evento, int $func_id = null){
        $this->maxEntr = 10;
        $this->evento = $evento;
        $this->func_id = $func_id;
        $this->selectedFunc1 = $func_id;
        $this->precio = $this->evento->precio;
        $this->precio_seg = $this->evento->precio_seg;
        $this->sobreventa = $this->evento->sobreventa;
        
        if (is_null($this->selectedFunc1)) {
            $funciones = $this->evento->temas_func();
            foreach( $funciones as $funcion)
            {
                if (round($funcion->capacidad * (1 + $this->sobreventa/100)-($funcion->cant_total), 0, PHP_ROUND_HALF_DOWN) > 0)
                {
                    $this->selectedFunc1 = $funcion->func_id;
                    break;
                }
            } 
        }

        $func1 = $this->evento->temas_func()->where('func_id','=', $this->selectedFunc1)->first();
        $this->temaFunc1 = $func1->id;
        $disp_func1 = round($func1->capacidad * (1 + $this->sobreventa/100)-($func1->cant_total), 0, PHP_ROUND_HALF_DOWN);

        $this->maxEntr = max(0 , min(10, $disp_func1));
        
    }

    public function updatedselectedFunc1($func1_id)
    {
        $func1 = $this->evento->temas_func()->where('func_id','=', $func1_id)->first();
        $this->temaFunc1 = $func1->id;
        $disp_func1 = round($func1->capacidad * (1 + $this->sobreventa/100)-($func1->cant_total), 0, PHP_ROUND_HALF_DOWN);

        $this->maxEntr = max(0 , min(10, $disp_func1));
        $this->entr_gral = max(0 , min($this->entr_gral, $this->maxEntr));

        $this->selectedFunc2 = null;
        $this->precio = $this->evento->precio;
        $this->cant_funciones=1;

    }

    public function updatedselectedFunc2($func2_id)
    {
        if ($func2_id == null) {
            $this->precio = $this->evento->precio;
            $this->cant_funciones=1;
        }
        else{
            $func2 = $this->evento->temas_func()->where('func_id','=', $func2_id)->first();
            $disp_func2= round($func2->capacidad * (1 + $this->sobreventa/100)-($func2->cant_total), 0, PHP_ROUND_HALF_DOWN);
    
            $this->maxEntr = max(0 ,min($this->maxEntr, $disp_func2));
            $this->entr_gral = max(0 ,min($this->entr_gral, $this->maxEntr));
            $this->precio = $this->evento->precio_prom;
            $this->cant_funciones=2;
        }
    }

    public function updated()
    {
        if ( ($this->entr_gral + $this->entr_seg) > $this->maxEntr) {
            $this->entr_seg = max(0 ,$this->maxEntr - $this->entr_gral);
        }
    }


    public function save()
    {
        $this->validate();

        $resAnt = DB::table('reservas')
                    ->join('funcione_reserva', 'reservas.id', '=', 'funcione_reserva.reserva_id')
                    ->join('funciones', 'funcione_reserva.funcione_id', '=', 'funciones.id')
                    ->select('reservas.id')
                    ->where('reservas.telefono','=',$this->tel)
                    ->where('funciones.evento_id','=',$this->evento->id)
                    ->get()
                    ->count();

        if ($resAnt > 0)
        {
            $mensaje = "<b>Ya existe una reserva registrada con el numero $this->tel</b>. 
                        <br>Ante cualquier duda o modificacion de tu reserva comunicate con 
                        nosotros por <a href='https://api.whatsapp.com/send?phone=+5491141462850' target='_blank'>Whatsapp</a>";
                        

            $this->emit('alert', $mensaje, 'Uups...', 'error');
    
            $this->reset(['open', 'usuario', 'tel', 'maxEntr']);
        }
        else
        {
            setlocale(LC_TIME, "spanish");

            $importe=$this->entr_gral * $this->precio * $this->cant_funciones + $this->entr_seg * $this->precio_seg * $this->cant_funciones;
            $usuario = $this->usuario;
            $telefono = $this->tel;
            $cant_adul = $this->entr_gral;
            $cant_esp = $this->entr_seg;

            $mens = "&#x1F4F1 Celular: <b>" . $telefono . "</b> <br>
                    &#x1F9D1 Nombre: <b>" . $usuario . "</b> <br>
                    &#x1F39F Entradas Adultos: <b>" . $cant_adul . "</b> <br>
                    &#x1F39F Entradas Niños/CUD : <b>" . $cant_esp . "</b> <br>
                    &#x1F4B5 Importe : <b>$ " . number_format($importe) . "</b> <br>
                    ";

            $func1 = Funcione::find($this->selectedFunc1);
            $tema1 = Tema::find($func1->tema_id);

            if (!is_null($this->selectedFunc2)) {

                $func2 = Funcione::find($this->selectedFunc2);
                $tema2 = Tema::find($func2->tema_id);

                $mens .= "Funciones: <br>";
                $mens .= "<b>&#x1F4E3 $tema1->titulo - " . utf8_encode(strftime("%A %d de %B", strtotime($func1->fecha))). " " . strftime("%H:%M", strtotime($func1->horario)) . " hs. <br>";
                $mens .= "&#x1F4E3 $tema2->titulo - " . utf8_encode(strftime("%A %d de %B", strtotime($func2->fecha))). " " . strftime("%H:%M", strtotime($func2->horario)) . " hs. </b>";
            }
            else
            {
                $mens .= "Funcion: <br>";
                $mens .= "<b>&#x1F4E3 $tema1->titulo  - " . utf8_encode(strftime("%A %d de %B", strtotime($func1->fecha))). " a las " . strftime("%H:%M", strtotime($func1->horario)) . " hs. </b>";
            }
            $this->emit('confirmRes', $mens, $importe, $usuario ,$telefono, $cant_adul, $cant_esp, $this->selectedFunc1, $this->selectedFunc2, $this->evento->id);

        }
    }

    public function render()
    {
        return view('livewire.reserva-evento', [
            'funciones' => $this->evento->temas_func(),
            'temaFunc1'=> $this->temaFunc1
        ]);
    }

    public function resetP()
    {
        $this->reset(['open', 'usuario', 'tel', 'maxEntr']);
    }

}
