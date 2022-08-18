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
                </div>
                <div class="col">
                    <b><label for="fecha">Seleccione la fecha</label></b>
                    <select class="form-control" name="fecha" wire:model="fechaSel">
                            @foreach ($fechas as $fecha)
                            <option value="{{ $fecha->fecha }}">{{ utf8_encode(strftime("%A %d de %B", strtotime($fecha->fecha))) }}
                            </option> 
                        @endforeach
                    </select>
                    
                </div>
                <div class="col">
                    <br>
                    <span style="text-align: center"><h3>Total Reservas: <b>  {{ $resTotal }}</b></h3></span>
                </div>   
            </div>
        </form>
    </div> 
</div>