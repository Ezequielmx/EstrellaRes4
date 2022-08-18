<?php

namespace App\Services;

use App\Jobs\ReservaWpp;
use App\Models\Reserva;
use App\Models\Evento;
use App\Models\Funcione;
use App\Models\Tema;
use App\Jobs\ReservaSheet;


class SaveResSheet
{

    public $evento;
    public $reserva;
    public $selectedFunc1;
    public $selectedFunc2;
    public $func1;
    public $tema1;
    public $func2;
    public $tema2;

    public function __construct(Reserva $reserva, Evento $evento, int $selectedFunc1, int $selectedFunc2 = null)
    {   
        $this->reserva = $reserva;
        $this->evento = $evento;
        $this->selectedFunc1 = $selectedFunc1;
        $this->selectedFunc2 = $selectedFunc2;
    }


    public function wppConf()
    {
        $this->func1 = Funcione::find($this->selectedFunc1);
        $this->tema1 = Tema::find($this->func1->tema_id);

        if (!is_null($this->selectedFunc2)) {
            $this->func2 = Funcione::find($this->selectedFunc2);
            $this->tema2 = Tema::find($this->func2->tema_id);
        }

        $cel = "549". $this->reserva->telefono;
        
        $mens = "👋 *Hola " . $this->reserva->usuario . "*\\n";
        $mens .= "Esta confirmada tu reserva para el Planetario Móvil en *".  $this->evento->lugar ."* \\n";
        $mens .= "📍 ".  $this->evento->direccion ."\\n";
        $mens .= "➖➖➖➖➖➖➖\\n"; 
        $mens .= "🔑 CODIGO DE RESERVA: *" . str_pad($this->reserva->id, 4 ,"0", STR_PAD_LEFT) . "*\\n";
        $mens .= "🎫 Cantidad de Entradas: *". $this->reserva->cant_adul . "*\\n";
        $mens .= "🎫 Seguro (niños entre 1 y 2 años ó CUD): *". $this->reserva->cant_esp . "*\\n";
        $mens .= "➖➖➖➖➖➖➖\\n"; 
        if (!is_null($this->func2)) {
            $mens .= "Funciones: \\n";
            $mens .= "📢 *" . $this->tema1->titulo . " - " . utf8_encode(strftime("%A %d de %B", strtotime($this->func1->fecha))). " a las " . strftime("%H:%M", strtotime($this->func1->horario)) . " hs.*\\n";
            $mens .= "📢 *" . $this->tema2->titulo . " - " . utf8_encode(strftime("%A %d de %B", strtotime($this->func2->fecha))). " a las " . strftime("%H:%M", strtotime($this->func2->horario)) . " hs.*\\n";
        }
        else
        {
            $mens .= "Funcion: \\n";
            $mens .= "📢 *" . $this->tema1->titulo . " - " . utf8_encode(strftime("%A %d de %B", strtotime($this->func1->fecha))). " a las " . strftime("%H:%M", strtotime($this->func1->horario)) . " hs.*\\n";
        }
        $mens .= "-Duración de cada función: *35minutos*-\\n";
        $mens .= "➖➖➖➖➖➖➖\\n";
        
        if($this->reserva->importe > 0)
        {
            $mens .= "💵 Importe Total: *$". $this->reserva->importe . "*\\n";
            $mens .= "➖➖➖➖➖➖➖\\n"; 
            $mens .= "*¿Cómo y cuándo se retiran las entradas?*\\n";
            $mens .= "Tenés que estar 30 min antes para asegurar tu lugar y abonar la entrada en el lugar del evento. *Si no llegás las entradas pasan a disponibilidad*\\n\\n";
            $mens .= "*Medios de pago? | Solo en efectivo*\\n\\n";
        }
        else
        {
            $mens .= "*Entrada Gratuita*\\n";
            $mens .= "➖➖➖➖➖➖➖\\n"; 
            $mens .= "*¿Cómo y cuándo se retiran las entradas?*\\n";
            $mens .= "Tenés que estar 30 min antes para asegurar tu lugar y retirar la entrada en el lugar del evento. *Si no llegás las entradas pasan a disponibilidad*\\n\\n";
        }
        
        
        $mens .= "Por favor sino vas al evento, avísanos, así la reserva se la damos a otra persona que si quiera ir!\\nLa reserva de entradas es *un compromiso de asistencia  al evento*. Pedimos por favor, que no nos fallen. *Gracias!*";

        ReservaWpp::dispatch($this->reserva->id, $cel, $mens);

    }

}