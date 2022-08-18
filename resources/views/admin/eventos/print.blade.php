@php
    setlocale(LC_TIME, "spanish");
    $funcionid = 0;
    $total = 0;
@endphp
<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Reservas - {{ $reservas[0]->lugar }}</title>
    <style>
        .page-break {
            page-break-after: always;
        }

        body {
            font-family: "Source Sans Pro",-apple-system,BlinkMacSystemFont,"Segoe UI",Roboto,"Helvetica Neue",Arial,sans-serif,"Apple Color Emoji","Segoe UI Emoji","Segoe UI Symbol";
        }

        table {
        border-collapse: collapse;
        border-spacing: 0;
        width: 100%;
        border: 1px solid #ddd;
        }

        th, td {
        text-align: left;
        padding: 5px;
        }

        tr:nth-child(even) {
            background-color: #c5c3c2;
            padding: 10px;
        }

        .fle{
            margin: 0 auto;
        }

        .titcol{
            float: left;
            background-color: #be5c0b;
            border: 2px solid #be5c0b;
            padding: 5px;
        }

        .datt{
            float: left;
            border: 2px solid #be5c0b;
            padding: 5px;
        }
        
        h1, h2, h3, h4{
            margin: 0;
        }

        .container
        {

        }

    </style>
</head>
<body>
    <div class="container">
        <table class="table">
            <tbody>
@foreach ($reservas as $reserva)
    @if($reserva->funcion_id != $funcionid)
            </tbody>
        </table>

        @if ($funcionid !=0)
            <br>
           <div class="titcol">
                <h4 style="color:white">Total: </h4>
            </div>
            <div class="datt">
                <h4>{{ $total }}</h4>
            </div> 
            <div class="page-break"></div>
        @endif

            <div class="fle">
                <div class="titcol">
                    <h3 style="color:white"> Evento:</h3>
                </div>
                <div class="datt">
                    <h3>{{ $reserva->lugar }}</h3>
                </div>
            </div>
                <br><br><br>


                <div class="titcol">
                    <h4 style="color:white"> Funcion:</h4>
                </div>
                <div class="datt">
                    <h4>{{ $reserva->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($reserva->fecha ))). " - " . strftime("%H:%M", strtotime( $reserva->horario))}}</h4>
                </div>


            <br><br><br>

            

        <table class="table">
            <thead>
                <tr>
                    <th>Codigo</th>
                    <th>Usuario</th>
                    <th>Adultos</th>
                    <th>Niños/CUD</th>
                </tr>
            </thead>
            <tbody>
            @php
                $funcionid = $reserva->funcion_id;
                $total =0;
            @endphp 
    @endif
                <tr>
                    <td> {{ $reserva->codigo_res }}</td>
                    <td> {{ $reserva->usuario }}</td>
                    <td> {{ $reserva->cant_adul }}</td>
                    <td> {{ $reserva->cant_esp }}</td>
                </tr>    
    @php
        $total += $reserva->cant_adul + $reserva->cant_esp;
    @endphp    
        
@endforeach
</tbody>
</table>
<br>
<div class="titcol">
    <h4 style="color:white">Total: </h4>
</div>
<div class="datt">
    <h4>{{ $total }}</h4>
</div> 
</div>
</body>
</html>