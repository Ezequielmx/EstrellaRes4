@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    <h1 style="padding:7px"><i class="fas fa-book-open"></i>&nbsp;&nbsp;Usuarios</h1>
    <div class="card">

        <div class="card-header">

            {!! Form::open(['route' =>'admin.usuarios.store']) !!}

            <div class="row">
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('nombre', 'Nombre') !!}
                        {!! Form::text('nombre', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Nombre']) !!}
                    
                        @error('nombre')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el email']) !!}
                    
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    <div class="form-group">
                        {!! Form::label('pass', 'Contraseña') !!}
                        {!! Form::text('pass', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña']) !!}
                        <p>Longitud mínima: 8 caracteres</p>
                        @error('pass')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>
                </div>
                <div class="col">
                    {!! Form::submit('Agregar Usuario', ['class' => 'btn btn-primary', 'style' => 'margin-top:32px']) !!}
                </div>
            </div>
            {!! Form::close() !!}
        </div>    

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Nombre</th>
                        <th>Email</th>
                        <th></th>
                    </tr>
                </thead>
                @foreach ($usuarios as $usuario)
                    <tr>
                        <td>{{ $usuario->id }}</td>
                        <td>{{ $usuario->name }}</td>
                        <td>{{ $usuario->email }}</td>
                        <td width="10px">
                            <form action="{{ route('admin.usuarios.destroy', $usuario) }}" method="POST">
                                @csrf
                                @method('delete')
                                <button type="submit" class="btn btn-danger btn-sm">Eliminar</button>
                            </form>
                        </td>

                    </tr>
                    
                @endforeach

            </table>
        </div>
    </div>

@stop

@section('css')

    <link rel="stylesheet" href="/css/admin.css">

@stop
