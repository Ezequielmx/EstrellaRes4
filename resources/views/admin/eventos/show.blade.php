@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif

    @livewire('admin.showfunc', ['evento' => $evento])
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
               
    <script>
        Livewire.on('deleteFunc', funcId =>{
            Swal.fire({
                title: 'Está seguro que desea eliminar la Función?',
                text: "También se eliminarán todas las reservas de esta función. No se puede revertir esto!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Eliminar',
                cancelButtonText: 'Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('deleteFun', funcId);
                    Swal.fire(
                    'Eliminado!',
                    'La función ha sido eliminada.',
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
