@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Editar Evento</h1>
    <div class="card">
        <div class="card-body">
            {!! Form::model($evento, ['route' =>['admin.eventos.update', $evento], 'files' => true, 'method' => 'put']) !!}
            
            @include('admin.eventos.partials.form')

                {!! Form::submit('Actualizar Evento', ['class' => 'btn btn-primary']) !!}
                <a href="{{ route('admin.eventos.index') }}"  class="btn btn-secondary">Cancelar</a>
                
            {!! Form::close() !!}
        </div>
    </div>

        
@stop

@section('css')
    <style>
        .image-wrapper{
            max-width: 1250px;
            width:100%;
            text-align:center;
            line-height:320px;
            height:320px;
        }

        .image-wrapper img{
            position: relative;
            
            vertical-align:middle;
            margin: -100%;
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
                document.getElementById("imagen_evento").setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }

        document.getElementById("btnint").addEventListener("click", function(event){
            event.preventDefault();
            var dir = document.getElementById("ubicacion").value;          
            document.getElementById("mapa").setAttribute('src',"https://maps.google.com/maps?q=" + dir + "&ie=UTF8&output=embed") ;
        });
    </script>
    

@stop
