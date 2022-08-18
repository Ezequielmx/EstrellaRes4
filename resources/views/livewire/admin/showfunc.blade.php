<div>
    <h1 style="padding:7px"><i class="fas fa-film"></i>&nbsp;&nbsp;Funciones</h1>
    <div class="card">
        @php
            setlocale(LC_TIME, "spanish");
        @endphp	

        <div class="card-header">
            <h2>Evento: {{ $evento->lugar }} </h2>
        </div>    

        <div class="card-body">
            {!! Form::open(['route' =>'admin.funciones.store']) !!}
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('tema_id', 'Tema') !!}
                            {!! Form::select('tema_id', $temas, null, ['class'=> 'form-control']) !!}
                            @error('tema_id')
                                <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('fecha', 'Fecha') !!}
                            {!! Form::date('fecha', null, ['class'=> 'form-control']) !!}  
                        </div>
                        @error('fecha')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('horario', 'Horario') !!}
                            {!! Form::time('horario', null, ['class'=> 'form-control']) !!}  
                        </div>
                        @error('horario')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="col">
                        <div class="form-group">
                            {!! Form::label('capacidad', 'Capacidad') !!}
                            {!! Form::number('capacidad', 60,['class'=> 'form-control']) !!}  
                        </div>
                        @error('capacidad')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror                        
                    </div>
                    {!! Form::text('evento_id', $evento->id,['class'=> 'd-none']) !!}  
                </div>
                          

                {!! Form::submit('Agregar Función', ['class' => 'btn btn-primary']) !!}
                
            {!! Form::close() !!}
    
        </div>
    </div>

    <div class="card">

        <div class="card-header">
            <h2>Funciones</h2>
        </div>    

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Tema</th>
                        <th>Fecha</th>
                        <th>Horario</th>
                        <th>Capacidad</th>
                        <th>Reservas</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach ($evento->funciones()->get()->SortBy('horario')->SortBy('fecha') as $funcion)
                    <tr>
                        <td>{{ $temas[$funcion->tema_id] }}</td>
                        <td>{{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }}</td>
                        <td>{{ strftime("%H:%M", strtotime($funcion->horario))}} hs.</td>
                        <td>{{ $funcion->capacidad }}</td>
                        <td>{{ $funcion->tot_res() }}</td>
                        <td width="10px">
                            <a class="btn btn-info btn-sm" href="{{ route('admin.funciones.show', $funcion) }}">Reservas</a>
                        </td>
                        <td width="10px">
                            <a wire:click="$emit('deleteFunc', {{ $funcion->id }})" class="btn btn-danger btn-sm">Eliminar</a>
                        </td>
                        <td width="10px">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.funciones.edit', [$funcion, $evento]) }}">Editar</a>
                        </td>
                    </tr>
                @endforeach
            </table>
        </div>
    </div>
</div>
