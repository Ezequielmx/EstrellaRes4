<div>
    @php
        setlocale(LC_TIME, "spanish");
    @endphp	
    <h1 style="padding:7px"><i class="fas fa-ticket-alt"></i>&nbsp;&nbsp;Reservas</h1>
    <div class="card">

        <div class="card-header">
            <h2><b>{{ $funcione->evento->lugar }}</b></h2>
            <hr>
            <h2>{{ $funcione->tema->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcione->fecha))) }} - {{ strftime("%H:%M", strtotime($funcione->horario))}} hs.</h2>
           
            <a href="{{ route('admin.eventos.show', $funcione->evento) }}" class="btn btn-secondary">
                <div style='text-align:center;'><i class="fas fa-arrow-left"></i>&nbsp;&nbsp;Volver</div>  
            </a>    
        </div>    

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Telefono</th>
                        <th>Código</th>
                        <th>Importe</th>
                        <th>Cantidad Adultos</th>
                        <th>Cantidad Niños</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach($funcione->reservas as $reserva) 
                    <tr>
                        <td>{{ $reserva->usuario }}</td>
                        <td>{{ $reserva->telefono }}</td>
                        <td>{{ $reserva->codigo_res }}</td>
                        <td>$ {{ $reserva->importe }}</td>
                        <td>{{ $reserva->cant_adul }}</td>
                        <td>{{ $reserva->cant_esp}}</td>
                        <td width="10px">
                            <a wire:click="$emit('deleteReserv', {{ $reserva->id }})" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                        <td width="10px">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.reservas.edit', ['reserva'=>$reserva->id]) }}">Editar</a>
                        </td>

                    </tr>
                    
                @endforeach 

            </table>
        </div>
    </div>
</div>
