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
        
        $mens = "๐ *Hola " . $this->reserva->usuario . "*\\n";
        $mens .= "Esta confirmada tu reserva para el Planetario Mรณvil en *".  $this->evento->lugar ."* \\n";
        $mens .= "๐ ".  $this->evento->direccion ."\\n";
        $mens .= "โโโโโโโ\\n"; 
        $mens .= "๐ CODIGO DE RESERVA: *" . str_pad($this->reserva->id, 4 ,"0", STR_PAD_LEFT) . "*\\n";
        $mens .= "๐ซ Cantidad de Entradas: *". $this->reserva->cant_adul . "*\\n";
        $mens .= "๐ซ Seguro (niรฑos entre 1 y 2 aรฑos รณ CUD): *". $this->reserva->cant_esp . "*\\n";
        $mens .= "โโโโโโโ\\n"; 
        if (!is_null($this->func2)) {
            $mens .= "Funciones: \\n";
            $mens .= "๐ข *" . $this->tema1->titulo . " - " . utf8_encode(strftime("%A %d de %B", strtotime($this->func1->fecha))). " a las " . strftime("%H:%M", strtotime($this->func1->horario)) . " hs.*\\n";
            $mens .= "๐ข *" . $this->tema2->titulo . " - " . utf8_encode(strftime("%A %d de %B", strtotime($this->func2->fecha))). " a las " . strftime("%H:%M", strtotime($this->func2->horario)) . " hs.*\\n";
        }
        else
        {
            $mens .= "Funcion: \\n";
            $mens .= "๐ข *" . $this->tema1->titulo . " - " . utf8_encode(strftime("%A %d de %B", strtotime($this->func1->fecha))). " a las " . strftime("%H:%M", strtotime($this->func1->horario)) . " hs.*\\n";
        }
        $mens .= "-Duraciรณn de cada funciรณn: *35minutos*-\\n";
        $mens .= "โโโโโโโ\\n";
        
        if($this->reserva->importe > 0)
        {
            $mens .= "๐ต Importe Total: *$". $this->reserva->importe . "*\\n";
            $mens .= "โโโโโโโ\\n"; 
            $mens .= "*ยฟCรณmo y cuรกndo se retiran las entradas?*\\n";
            $mens .= "Tenรฉs que estar 30 min antes para asegurar tu lugar y abonar la entrada en el lugar del evento. *Si no llegรกs las entradas pasan a disponibilidad*\\n\\n";
            $mens .= "*Medios de pago? | Solo en efectivo*\\n\\n";
        }
        else
        {
            $mens .= "*Entrada Gratuita*\\n";
            $mens .= "โโโโโโโ\\n"; 
            $mens .= "*ยฟCรณmo y cuรกndo se retiran las entradas?*\\n";
            $mens .= "Tenรฉs que estar 30 min antes para asegurar tu lugar y retirar la entrada en el lugar del evento. *Si no llegรกs las entradas pasan a disponibilidad*\\n\\n";
        }
        
        
        $mens .= "Por favor sino vas al evento, avรญsanos, asรญ la reserva se la damos a otra persona que si quiera ir!\\nLa reserva de entradas es *un compromiso de asistencia  al evento*. Pedimos por favor, que no nos fallen. *Gracias!*";

        ReservaWpp::dispatch($this->reserva->id, $cel, $mens);

    }

}