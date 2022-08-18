<div>
    
    <x-jet-danger-button wire:click="$set('open', true)">
        Reservar Entradas
    </x-jet-danger-button>

    <x-jet-dialog-modal wire:model="open">

       <x-slot name='title'>
           <h3 style="color: #2312b6"><b> Reserva de Entradas - {{ $evento->lugar }} </b></h3>
           <hr style="color: #2312b6; border-top: 4px solid;">
       </x-slot>
       <x-slot name='content'>
        @php
            setlocale(LC_TIME, "spanish");	
        @endphp 
        <form>
            @csrf
            <input type="text" class="form-control" name="evento_id" value="{{ $evento->id }}" readonly hidden>
            <div class="row">
                <div class="col-md-6">
                    <b><label for="usuario" class="form-label">Tu Nombre:</label></b>
                    <input type="text" class="form-control" placeholder="Tu nombre" name="usuario" required wire:model="usuario">
                    <x-jet-input-error for="usuario"/> 
                </div>
                <div class="col-md-6">
                    <b><label for="telefono" class="form-label">Celular:</label></b>
                    <input type="number" class="form-control" name="telefono" placeholder="Sin 0 y sin 15 Ej: 1160208707" required wire:model="tel">
                    <x-jet-input-error for="tel"/> 
                </div>
            </div>
            <br>
            <div class="row">
                <div class="col">
                    <b><label for="funcion1">Selecciona la primer función</label></b>
                    <select class="form-control" name="funcion1" wire:model="selectedFunc1">
                        @foreach ($funciones as $funcion)
                            @if ($funcion->func_id == $func_id )
                                <option value="{{ $funcion->func_id }}">{{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}</option>    
                            @endif
                            
                        @endforeach
                        @foreach ( $funciones as $funcion)
                        @if ($funcion->func_id != $func_id && ($funcion->capacidad * (1 + $sobreventa/100)-($funcion->cant_total) > 0))
                            <option value="{{ $funcion->func_id }}">{{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}
                            </option>    
                        @endif
                        
                        @endforeach
                    </select>
                </div>
            </div>
            <br>
          
          <p style="color: #2312b6; margin-bottom:0px;">
            <b>Si querés sacar entradas para dos funciones seleccioná la segunda función abajo.</b></p>
           <p style="color: #2312b6; margin-bottom:0px;"> (Si solo querés asistir a una función no selecciones nada)  </p>
           
    
                  @if ($evento->precio != $evento->precio_prom)
                        <p style="color: #2312b6; margin-bottom:0px;">Si sacás entradas para dos funciones <b>tenés  descuento!</b>
                        Pagás el <b>precio promocional de ${{ $evento->precio_prom }} </b>cada entrada!</p>
                    @endif
          
          
          
          
            <div class="row">
                <div class="col">
                    <!--<b><label for="funcion2">Selecciona la segunda función (opcional)</label></b>-->
                    <select class="form-control" name="funcion2" wire:model="selectedFunc2">
                        <option value="" >------------------------------</option>
                        @foreach ( $funciones as $funcion2)
                            @if ($funcion2->func_id !=  $selectedFunc1 && $funcion2->id != $temaFunc1 && ($funcion2->capacidad * (1 + $sobreventa/100)-($funcion2->cant_total) > 0))
                                <option value="{{ $funcion2->func_id }}">{{ $funcion2->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion2->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion2->horario ))}}
                                </option>
                            @endif
                        @endforeach
                    </select>
                </div>
            </div>

            <br>
    
            <div class="row">
                <div class="col-md-4">
                    <b><label for="cant_adul">Cantidad de Entradas:</label></b>
                    <select class="form-control" name="cant_adul" wire:model="entr_gral">
                        @for ($i=1; $i <= $maxEntr; $i++ )
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <p>Mayores de 3 años ${{ $precio }}c/u.</p>
                </div>
                <div class="col-md-4">
                    <b><label for="cant_men">Cantidad seguros:</label></b>
                    <select class="form-control" name="cant_men" wire:model="entr_seg">
                        @for ($i=0; $i <= $maxEntr - $entr_gral; $i++ )
                            <option value="{{ $i }}">{{ $i }}</option>
                        @endfor
                    </select>
                    <p>Niños entre 1 y 2 años ó CUD ${{ $precio_seg }}c/u.</p>
                </div>
                <div class="col-md-4"><br>
                    <span style="text-align: right"><h3>Total: <b>  {{'$ ' .  number_format(max(0, ($entr_gral * $precio * $cant_funciones + $entr_seg * $evento->precio_seg * $cant_funciones))) }}</b></h3></span>
                </div>
            </div>
         
        </form>
        </x-slot>

        <x-slot name='footer'>
            <x-jet-secondary-button wire:click="$set('open', false)">
                Cancelar
            </x-jet-secondary-button>
            @if ($entr_gral >0 && $entr_seg>=0)
                <x-jet-danger-button wire:click="save">
                    Reservar
                </x-jet-secondary-button>
            @endif
        </x-slot>

        
    </x-jet-dialog-modal>
</div>
