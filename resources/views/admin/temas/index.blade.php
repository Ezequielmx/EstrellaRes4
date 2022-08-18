@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    <h1 style="padding:7px"><i class="fas fa-book-open"></i>&nbsp;&nbsp;Temas</h1>
    <div class="card">

        <div class="card-header">
            <a href="{{ route('admin.temas.create') }}" class="btn btn-primary">Agregar Tema</a>    
        </div>    

        <div class="card-body">
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>Id</th>
                        <th>Título</th>
                        <th>Descripción</th>
                        <th>Duración</th>
                        <th colspan="2"></th>
                    </tr>
                </thead>
                @foreach ($temas as $tema)
                    <tr>
                        <td>{{ $tema->id }}</td>
                        <td>{{ $tema->titulo }}</td>
                        <td>{{ $tema->descripcion }}</td>
                        <td>{{ $tema->duracion }}</td>
                        <td width="10px">
                            <a class="btn btn-primary btn-sm" href="{{ route('admin.temas.edit', $tema) }}">Editar</a>
                        </td>
                        <td width="10px">
                            <form action="{{ route('admin.temas.destroy', $tema) }}" method="POST">
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
