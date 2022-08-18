<div class="form-group">
    {!! Form::label('titulo', 'Título') !!}
    {!! Form::text('titulo', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Título']) !!}

    @error('titulo')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('descripcion', 'Descripción') !!}
    {!! Form::textarea('descripcion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la descripción']) !!}

    @error('descripcion')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('duracion', 'Duración (minutos)') !!}

    @if(isset($duracion))
        {!! Form::number('duracion', $duracion, ['class' => 'form-control', 'placeholder' => 'Seleccione Duración']) !!}
    @else
        {!! Form::number('duracion', null, ['class' => 'form-control', 'placeholder' => 'Seleccione Duración']) !!}
    @endif

    @error('duracion')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>


<div class="row mb-3">
    <div class="col-md-4">
        <div class="image-wrapper">
            @isset($tema->imagen)
                <img id="imagen_tema" src="{{ Storage::url($tema->imagen) }}" alt="">
            @else
                <img id="imagen_tema" src="" alt="">
            @endif
            
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            {!! Form::label('imagen', 'Imagen del Tema') !!}
            {!! Form::file('imagen', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
            <p>Selecciona una imagen cuadrada de al menos 600 x 600 pixeles.</p>
        </div>
        @error('imagen')
            <span class="text-danger">{{ $message }}</span>
        @enderror
    </div>
</div>