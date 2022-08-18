@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-book-open"></i>&nbsp;&nbsp;Crear Tema</h1>
    <div class="card">
        <div class="card-body">
            {!! Form::open(['route' =>'admin.temas.store', 'files' => true]) !!}
            
            @include('admin.temas.partials.form')

                {!! Form::submit('Crear Tema', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.temas.index') }}"  class="btn btn-secondary">Cancelar</a>
                
            {!! Form::close() !!}
        </div>
    </div>

@stop

@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 100%;
        }

        .image-wrapper img{
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
        }


    </style>
@stop

@section('js')
    <script>
        document.getElementById("imagen").addEventListener('change', cambiarImagen);

            function cambiarImagen(event){
                var file = event.target.files[0];

                var reader = new FileReader();
                reader.onload = (event) => {
                    document.getElementById("imagen_tema").setAttribute('src', event.target.result);
                };

                reader.readAsDataURL(file);
            }
    </script>
    

@stop
