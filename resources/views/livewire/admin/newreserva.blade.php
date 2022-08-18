<div>
    @php
        setlocale(LC_TIME, "spanish");	
    @endphp
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col-md-6">
                    <b><label for="evento">Selecciona el Evento</label></b>
                    <select class="form-control" name="evento" wire:model="eventoSel">
                        @foreach ($eventos as $evento)
                            <option value="{{ $evento->id }}">{{ $evento->lugar }} </option>    
                        @endforeach
                    </select>
                    <br>
                    <b><label for="funcion1">Selecciona la primer función</label></b>
                    <select class="form-control" name="funcion1" wire:model="selectedFunc1">
                        <option value="-1">-------</option>
                        @foreach ($funciones as $funcion)
                            <option value="{{ $funcion->func_id }}">{{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}</option>    
                        @endforeach
                    </select>
                    <p>
                    Capacidad real: <b>{{ $cap_func1 }}</b> - Con Sobreventa: <b>{{ $cap_sob_func1 }}</b> - 
                    Reservado: <b>{{ $reserv_func1 }}</b> - Disponible: <b>{{ $disp_func1 }}</b></p>

                    <b><label for="funcion2">Selecciona la segunda función</label></b>
                    <select class="form-control" name="funcion2" wire:model="selectedFunc2">
                        <option value="-1">-------</option>
                        @if ($selectedFunc1>0)
                            @foreach ($funciones as $funcion)
                                <option value="{{ $funcion->func_id }}">{{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}</option>    
                            @endforeach 
                        @endif
                    </select>
                    <p>
                    Capacidad real: <b>{{ $cap_func2 }}</b> - Con Sobreventa: <b>{{ $cap_sob_func2 }}</b> - 
                    Reservado: <b>{{ $reserv_func2 }}</b> - Disponible: <b>{{ $disp_func2 }}</b></p>
                </div>
                <div class="col-md-6">
                    <b><label for="usuario" class="form-label">Nombre:</label></b>
                    <input type="text" class="form-control" placeholder="Nombre" name="usuario" required wire:model="usuario">
                    @error('usuario')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <br>

                    <b><label for="twl" class="form-label">Celular:</label></b>
                    <input type="number" class="form-control" name="tel" placeholder="Sin 0 y sin 15 Ej: 1160208707" required wire:model="tel">
                    @error('tel')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <p></p>
                    <br>

                    <div class="row">
                        <div class="col">
                            <b><label for="cant_adul">Cantidad de Entradas:</label></b>
                            <select class="form-control" name="entr_gral" wire:model="entr_gral">
                                @for ($i=1; $i <= 20; $i++ )
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <p>Mayores de 3 años ${{ $precio }}c/u.</p>
                        </div>
                        <div class="col">
                            <b><label for="cant_men">Cantidad seguros:</label></b>
                            <select class="form-control" name="entr_seg" wire:model="entr_seg">
                                @for ($i=0; $i <= 20; $i++ )
                                    <option value="{{ $i }}">{{ $i }}</option>
                                @endfor
                            </select>
                            <p>Niños entre 1 y 2 años ó CUD ${{ $precio_seg }}c/u.</p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col"><br>
                            <p>Precio calculado: <b>  {{'$ ' .  number_format(max(0, ($entr_gral * $precio * $cant_funciones + 
                            $entr_seg * $precio_seg * $cant_funciones))) }}</b></p>
                            
                            <b><label for="importe">Importe :</label></b>
                            <input type="number" class="form-control" name="importe" value="{{max(0, ($entr_gral * $precio * $cant_funciones + $entr_seg * $precio_seg * $cant_funciones)) }}" wire:model="importe">
                            (Si se omite se utilizará el precio calculado)
                        </div>
                        <div class="col">
                            <br><br>
                            <span style="text-align: center"><h3>Total:<b>  
                                @php
                                    if(is_null($importe)){
                                        $val =  '$ ' .  number_format(max(0, ($entr_gral * $precio * $cant_funciones + $entr_seg * $precio_seg * $cant_funciones)));
                                    }else{
                                        $val = '$ ' . number_format($importe);

                                    }
                                @endphp
                                {{ $val }}
                                </b></h3></span>
                        </div>
                    </div>
                </div>
            </div>
        </form>
        @if (isset($selectedFunc1))
            <button class="btn btn-primary" wire:click="save">
                Reservar
            </button>
        @endif
    </div>
</div>
