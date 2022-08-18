@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    @livewire('admin.showres', ['funcione' => $funcione])
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
