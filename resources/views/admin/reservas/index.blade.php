@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')

    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    <h1 style="padding:7px"><i class="fas fa-search"></i>&nbsp;&nbsp;Reservas</h1>
    <div class="card">
        @livewire('admin.reservas')
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                
    <script>
        Livewire.on('deleteReserv', reservId =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar la Reserva?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteRes', reservId);
                    Swal.fire(
                    'Eliminado!',
                    'La reserva ha sido eliminada.',
                    'success'
                    )
                }
            })  
        });
        
    </script>
 
@stop


