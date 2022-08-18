<div>
    @php
        setlocale(LC_TIME, "spanish");
    @endphp	

    <div class="card-header">
        <form>
        <div class="row">
            <div class="col">
                <div class="form-group">
                    <label for="usuario">Usuario</label>
                    <input type="text" class="form-control" wire:model="searchUser">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="telefono">Telefono</label>
                    <input type="text" class="form-control" wire:model="searchTel">
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    <label for="codigo">Código</label>
                    <input type="text" class="form-control" wire:model="searchCod">
                </div>
            </div>
        </div>
        </form>
    </div>       

    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Evento</th>
                    <th>Tema</th>
                    <th>Fecha</th>
                    <th>Horario</th>
                    <th>Código</th>
                    <th>Usuario</th>
                    <th>Teléfono</th>
                    <th>Entradas</th>
                    <th>Seguros</th>
                    <th>Importe</th>
                    <th></th>
                </tr>
            </thead>
            @foreach ($reservt as $reserva)
                <tr>
                    <td>{{ $reserva->lugar }}</td>
                    <td>{{ $reserva->titulo }}</td>
                    <td>{{ utf8_encode(strftime("%A %d de %B", strtotime($reserva->fecha))) }}</td>
                    <td>{{ strftime("%H:%M", strtotime($reserva->horario ))}}</td>
                    <td>{{ str_pad($reserva->id , 4 ,"0", STR_PAD_LEFT) }}</td>
                    <td>{{ $reserva->usuario }}</td>
                    <td>{{ $reserva->telefono }}</td>
                    <td>{{ $reserva->cant_adul }}</td>
                    <td>{{ $reserva->cant_esp }}</td>
                    <td>{{ "$". $reserva->importe }}</td>
                    <td width="10px">
                        <a wire:click="$emit('deleteReserv', {{ $reserva->id }})" class="btn btn-danger btn-sm">Eliminar</a>
                    </td>
                    <td width="10px">
                        <a class="btn btn-primary btn-sm" href="{{ route('admin.reservas.edit', ['reserva'=>$reserva->id]) }}">Editar</a>
                    </td>
                </tr>
            @endforeach
        </table>
        </table>
    </div>

</div>
