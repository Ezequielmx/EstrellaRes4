@extends('adminlte::page')

@section('title','Estrella del Plata')



@section('content')
    @if (session('info'))
    <div class="alert alert-success">
        <strong>{{ session('info') }}</strong>
    </div>
    @endif
    <h1 style="padding:7px"><i class="fas fa-fw fa-tools"></i>&nbsp;&nbsp;Agregar Usuario</h1>
    <div class="card" style="max-width: 1250px">
        <div class="card-body">
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

                    <div class="form-group">
                        {!! Form::label('email', 'Email') !!}
                        {!! Form::email('email', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el email']) !!}
                    
                        @error('email')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    <div class="form-group">
                        {!! Form::label('pass', 'Contraseña') !!}
                        {!! Form::email('pass', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la contraseña']) !!}
                        <p>La contraseña debe tener una longitud mínima de 8 caracteres</p>
                        @error('pass')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    </div>

                    {!! Form::submit('Guardar', ['class' => 'btn btn-primary float-right']) !!}
                </div>
                <div class="col">
                </div>
            </div>
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
                    document.getElementById("imagen_gral").setAttribute('src', event.target.result);
                };

                reader.readAsDataURL(file);
            }
    </script>
    

@stop