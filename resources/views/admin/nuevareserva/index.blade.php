@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-ticket-alt "></i>&nbsp;&nbsp;Nueva Reserva</h1>
    <div class="card">
        @livewire('admin.newreserva')
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
    <script>
        Livewire.on('alerta', function(mens){
            Swal.fire({
                title: 'Listo!!',
                icon: 'success',
                html: 
                    mens,
            })
        })
    </script>

@stop


