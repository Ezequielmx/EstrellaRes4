@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

   

    <h1 style="padding:7px"><i class="fas fa-bullhorn"></i>&nbsp;&nbsp;Eventos</h1>
    <div class="card">
        <div class="card-header">
            <a href="{{ route('admin.eventos.create') }}" class="btn btn-primary">Agregar Evento</a>    
        </div> 
        @livewire('admin.testliv')
    </div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
            
    <script>
        Livewire.on('deleteEvent', eventId =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar el Evento?',
                text: "No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminarlo',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {

                    Livewire.emit('delete', eventId);

                    Swal.fire(
                    'Eliminado!',
                    'El evento ha sido eliminado.',
                    'success'
                    )
                }
            })  
        });
    </script>
    <script>
        $(document).ready(function(){
            $(':checkbox[readonly=readonly]').click(function(){
                return false;        
                });
        });
    </script>
@stop


