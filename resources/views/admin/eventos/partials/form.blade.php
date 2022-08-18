<div class="row">  
    <div class="col">
        <div class="row">
            <div class="col-md-8">
                <div class="form-group">
                    {!! Form::label('lugar', 'Lugar') !!}
                    {!! Form::text('lugar', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el Lugar']) !!}

                    @error('lugar')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col-md-4">    
                <div class="form-check form-switch">
                    <label>
                        @isset($evento)
                            @if ($evento->activo==0)
                                {!! Form::checkbox('activo', null, null) !!}
                            @else
                                {!! Form::checkbox('activo', null, 'cheched') !!}
                            @endif
                        @else
                            {!! Form::checkbox('activo', null, 'cheched') !!}
                        @endisset
                        Activo
                    </label>
                </div>
            </div>
        </div>
        <div class="form-group">
            {!! Form::label('speach', 'Speach') !!}
            @isset($evento->speach)
                {!! Form::textarea('speach', $evento->speach, ['class' => 'form-control', 'placeholder' => 'Ingrese el Speach']) !!}
            @else
                {!! Form::textarea('speach', $general->speach, ['class' => 'form-control', 'placeholder' => 'Ingrese el Speach']) !!}    
            @endisset
            

            @error('speach')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <div class="row">
            <div class="col">
                <div class="form-group">
                    {!! Form::label('precio', 'Precio General') !!}
                    @isset($evento->precio)
                        {!! Form::number('precio', $evento->precio, ['class' => 'form-control', 'placeholder' => 'Seleccione Precio General']) !!}
                    @else
                        {!! Form::number('precio', $general->precio, ['class' => 'form-control', 'placeholder' => 'Seleccione Precio General']) !!}
                    @endisset
                    
                    @error('precio')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {!! Form::label('precio_prom', 'Precio Promocional (2 eventos)') !!}
                    @isset($evento->precio_prom)
                        {!! Form::number('precio_prom', $evento->precio_prom, ['class' => 'form-control', 'placeholder' => 'Seleccione Precio Promocional']) !!}
                    @else
                        {!! Form::number('precio_prom', $general->precio_prom, ['class' => 'form-control', 'placeholder' => 'Seleccione Precio Promocional']) !!}
                    @endisset


                    @error('precio_prom')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {!! Form::label('precio_seg', 'Precio Seguro (menores)') !!}
                    @isset($evento->precio_seg)
                        {!! Form::number('precio_seg', $evento->precio_seg, ['class' => 'form-control', 'placeholder' => 'Seleccione Precio Promocional']) !!}
                    @else
                        {!! Form::number('precio_seg', $general->precio_seg, ['class' => 'form-control', 'placeholder' => 'Seleccione Precio Promocional']) !!}
                    @endisset

                    @error('precio_seg')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
            <div class="col">
                <div class="form-group">
                    {!! Form::label('sobreventa', 'Sobreventa (%)') !!}
                    @isset($evento->sobreventa)
                        {!! Form::number('sobreventa', $evento->sobreventa, ['class' => 'form-control', 'placeholder' => 'Seleccione sobreventa']) !!}
                    @else
                        {!! Form::number('sobreventa', $general->sobreventa, ['class' => 'form-control', 'placeholder' => 'Seleccione sobreventa']) !!}
                    @endisset

                    @error('sobreventa')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                </div>
            </div>
        </div>
    </div> 

    <div class="col">

        <div class="form-group">
            {!! Form::label('direccion', 'Dirección') !!}
            {!! Form::text('direccion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Dirección']) !!}

            @error('direccion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>
 

        <div class="input-group mb-3">
            <span class="input-group-text">Ubicación</span>
            {!! Form::text('ubicacion', null, ['class' => 'form-control', 'placeholder' => 'Ingrese la Ubicación', 'id' => 'ubicacion']) !!}
            <a  class="btn btn-outline-primary" id="btnint">Buscar</a> 
        
            @error('ubicacion')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        <iframe id="mapa"
            width="100%"
            height="250px"
            frameborder="0" style="border:0"
            @isset($evento->ubicacion)
                src="https://maps.google.com/maps?q={{$evento->ubicacion }}&ie=UTF8&output=embed">
            @else
                src="https://maps.google.com/maps?q=Rodriguez peña 126&ie=UTF8&output=embed">
            @endisset
            
        </iframe>
    </div>

</div> 

<div class="row mb-3">
    <div class="col-sm-9">
        <div class="image-wrapper">
            @isset($evento->imagen)
                <img id="imagen_evento" src="{{ Storage::url($evento->imagen) }}" alt="">
            @else
                <img id="imagen_evento" src="{{ Storage::url ($general->imagen) }}" alt="">
            @endif
        </div>
    </div>

    <div class="col-sm-3">
        <div class="form-group">
            {!! Form::label('imagen', 'Imagen del Evento') !!}
            {!! Form::file('imagen', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}
            <p>Selecciona una imagen. Medida recomendada:  1250 x 320 pixeles.</p>

            @error('imagen')
                <span class="text-danger">{{ $message }}</span>
            @enderror


        </div>

    </div>

</div>

