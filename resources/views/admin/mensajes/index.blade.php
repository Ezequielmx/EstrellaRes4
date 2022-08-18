@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')  

    <h1 style="padding:7px"><i class="fab fa-whatsapp"></i>&nbsp;&nbsp;Mensajes</h1>

    <div class="card">
            @livewire('admin.mensmas')
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
    <script>
        Livewire.on('enviado', function(){
            Swal.fire(
                'Listo!',
                'Mensaje enviado a todas las reservas!',
                'success'
            )
        });
    </script>
@stop


