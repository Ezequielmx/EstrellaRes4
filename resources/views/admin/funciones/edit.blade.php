@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-film"></i>&nbsp;&nbsp;Editar Funcion</h1>
    <div class="card">
        @php
            setlocale(LC_TIME, "spanish");
        @endphp	

        <div class="card-body">
            {!! Form::model($funcione, ['route' =>['admin.funciones.update', $funcione], 'method' => 'put']) !!}
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
                            {!! Form::number('capacidad', null,['class'=> 'form-control']) !!}  
                        </div>
                        @error('capacidad')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror                        
                    </div>
                    {!! Form::text('evento_id', $evento->id,['class'=> 'd-none']) !!}  
                </div>
                          

                {!! Form::submit('Guardar', ['class' => 'btn btn-primary']) !!}
                <a class="btn btn-secondary" href="{{ route('admin.eventos.show', $evento) }}">Cancelar</a>
                
            {!! Form::close() !!}
    
        </div>
    </div>

        
@stop

@section('css')
@stop

@section('js')

@stop
