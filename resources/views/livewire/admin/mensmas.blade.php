<div>
    @php
        setlocale(LC_TIME, "spanish");
    @endphp
    <div class="card-body">
        <form>
            <div class="row">
                <div class="col">
                        <b><label for="evento">Seleccione el Evento</label></b>
                        <select class="form-control" name="evento" wire:model="eventoSel">
                            @foreach ($eventos as $evento)
                                    <option value="{{ $evento->id }}">{{ $evento->lugar }} </option>    
                            @endforeach
                        </select>
                        @error('eventoSel')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                    <br>
                        <b><label for="funcion">Seleccione la función</label></b>
                        <select class="form-control" name="funcion" wire:model="funcionSel">
                            @foreach ($funciones as $funcion)
                            <option value="{{ $funcion->func_id }}">{{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}
                            </option>  
                                
                            @endforeach
                        </select>
                        @error('funcionSel')
                            <span class="text-danger">{{ $message }}</span>
                        @enderror
                        <b>Reservas: </b>{{ $cantRes }}
                        <br><br>
                        <b>Vista Previa:</b>
                        <div style="background-color: #e7ffdb; padding: 10px; border: 1px solid #ced4da; border-radius: 0.25rem;">
                            <b>Hola Usuario!</b>
                            <p>Tenemos un <b>AVISO IMPORTANTE</b> acerca de tu reserva para el Planetario Móvil - Función: {{ $funcion->titulo }} - {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }} - {{ strftime("%H:%M", strtotime($funcion->horario ))}}</p>
                            <p style="margin-top: -15px">{{ $mensaje }}</p>
                        </div>
                        <br>
                </div>  
                <div class="col">
                    <b><label for="mensaje">Mensaje:</label></b>
                    <textarea class="form-control" name="mensaje" cols="30" rows="10" wire:model="mensaje"></textarea>
                    @error('mensaje')
                        <span class="text-danger">{{ $message }}</span>
                    @enderror
                    <br>

                </div> 
            </div>
        </form>
        @if ($cantRes >0)
            <button class="btn btn-primary" wire:click="save">
                Enviar
            </button>
        @else
            <button class="btn btn-warning" wire:click="save" disabled>
                Enviar
            </button>
        @endif

    </div>
</div>
