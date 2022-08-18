<div>
    <div class="card-body">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th>Id</th>
                    <th>Lugar</th>
                    <th>Direccion</th>
                    <th>Precio</th>
                    <th>Precio Promo</th>
                    <th>Precio Seguro</th>
                    <th>Activo</th>
                    <th colspan="4"></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($eventos as $evento)
                    <tr>
                        <td>{{ $evento->id }}</td>
                        <td>{{ $evento->lugar }}</td>
                        <td>{{ $evento->direccion }}</td>
                        <td>$ {{ $evento->precio }}</td>
                        <td>$ {{ $evento->precio_prom }}</td>
                        <td>$ {{ $evento->precio_seg }}</td>
                        <td>
                            <div class="form-check form-switch">
                                <input class="form-check-input" type="checkbox" id="mySwitch" name="darkmode" value="yes"
                                @if ($evento->activo)
                                    checked
                                @endif                                
                                readonly="readonly">
                            </div>
                        </td>
                        <td width="10px">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.eventos.show', $evento) }}">Funciones</a>
                        </td>
                        <td width="10px">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.eventos.edit', $evento) }}">Editar</a>
                        </td>
                        <td width="10px">
                            <a wire:click="$emit('deleteEvent', {{ $evento->id }})" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                        <td>
                            <a class="btn btn-secondary btn-sm" href="{{ route('eventoprint', $evento) }}" target="_blank">Imprimir Reservas</a>
                        </td>
                    </tr>    
                @endforeach
            </tbody>
        </table>
    </div>

    @push('js')

    @endpush
</div>
