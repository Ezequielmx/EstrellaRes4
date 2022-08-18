<x-app-layout>
    @php
    setlocale(LC_TIME, "spanish");	
    $tema=0;
    $fecha=0;
    @endphp 
    <div class="max-w-7xl px-2 mx-auto sm:px-4 lg:px-8">

        <div 
            class="mt-4 mb-4 rounded enc-evt"
            style="background:linear-gradient(0deg, rgba(0, 0, 0, 0.5), rgba(0, 0, 0, 0.5)), url(/storage/{{ $evento->imagen }});   background-position: center;
            background-size: cover;">
            <div class="row p-3 text-white" >
                <div class="col-md-6 col-lg-4 mb-2">
                    <h1 class="respneg tit-rck">{{ $evento->lugar }}</h1>
                    <p class="respneg">
                        {{ $evento->speach }}
                    </p>
                    
                    <span class="badge bg-danger mb-1" style="font-size:1.1em">Valor Entradas: ${{ $evento->precio }}</span>
                    <span class="badge bg-danger" style="font-size:1.1em">Menores de 3 años/CUD: ${{ $evento->precio_seg }}</span>
                </div>
                <div class="col-md-6 col-lg-4 mb-2 recbco">
                    <h2 style="color: #990412"><i class="fa fa-map-marker"></i>   Donde?</h2>
                    <p>{{ $evento->direccion }}</p>   
                    <h2 style="color: #990412"><i class="fa fa-calendar"></i>   Cuando?</h2>
                    @if($evento->fechas()->count() > 0)
                        @foreach ($evento->fechas() as $fecha)
                            <li> {{ utf8_encode(strftime("%A %d de %B", strtotime($fecha->fecha))) }}</li>
                        @endforeach
                    @else
                        <p> Próximamente </p>
                    @endif   

                    <h2 style="color: #990412"><i class="fa fa-clock-o"></i>   Duración</h2>
                    <p>{{ $evento->duracion()->minutos }} minutos</p>   
                </div>
                <div class="col-md-6 col-lg-4 mb-2">
                    <iframe src="https://maps.google.com/maps?q={{ $evento->ubicacion }}&ie=UTF8&output=embed" width="100%" height="100%" style="border:0; min-height:250px" allowfullscreen="" loading="lazy"></iframe>
                </div>
            </div>
        </div>
@if($evento->fechas()->count() > 0)
        @php
        $entdisp=false;
        foreach($evento->temas_func() as $funcion)
        {
            $disp = ($funcion->capacidad * (1 + $sobreventa/100))-($funcion->cant_total);
            $disp = round($disp, 0, PHP_ROUND_HALF_DOWN);
            if($disp > 0)
            {
                $entdisp=true;
                break;
            }
        }
        @endphp
   
        <div class="cont-func">
            <div>
                @if ($entdisp)
                    <h1 class="tit-rck text-center">Funciones Disponibles</h1>
                @else
                    <h1 class="tit-rck text-center">Entradas Agotadas</h1>
                @endif
               
            </div>
            
            @if ($entdisp)
                <div class="cont-btn">
                    @livewire('reserva-evento', ['evento'=>$evento], key('-1'))  
                </div>
            @endif
            
        </div>
        
        <div class="row" >
            <div><div><div>
            @foreach ( $evento->temas_func() as $funcion)

                    @if ($funcion->id != $tema)
                        </div></div></div>
                        <div class="col-md-6 col-lg-4 mt-4">
                            <div class="card" style="width:100%; height:100%; margin-bottom:10px">
                                <img class="card-img-top" src="storage/{{ $funcion->imagen }}" alt="Card image" style="width:100%">
                                <div class="card-body">
                                    <h4 class="card-title tit-rck">{{ $funcion->titulo }} </h4>
                                    <p class="card-text" style="color: #7d7e7e;">{{ $funcion->descripcion }} </p>
                                
                            
                            @php
                                $tema =  $funcion->id;
                                $fecha=0;
                            @endphp     
                    @endif

                    @if ($funcion->fecha != $fecha)
                        <br>
                        <h4 style="color: #042c9d"><b>
                            <i class="fa fa-calendar" aria-hidden="true"></i> {{ utf8_encode(strftime("%A %d de %B", strtotime($funcion->fecha))) }}
                        </h4></b>
                      
                        @php
                            $fecha = $funcion->fecha
                        @endphp
                        
                    @endif
                    @php
                        $disp = ($funcion->capacidad * (1 + $sobreventa/100))-($funcion->cant_total);
                        $disp = round($disp, 0, PHP_ROUND_HALF_DOWN);
                    @endphp

                    <hr>
                    <div class="flexh">
                        <div class="hor">
                            <p style="margin-bottom: 0px; font-size: 1.1em;"><b>{{ strftime("%H:%M", strtotime($funcion->horario))}} hs.</b></p> 
                            @if ($disp > 0)
                                {{ min($disp, rand(10,25)) }} disponibles 
                            @endif
                        </div>
                        <div class="btnres">
                            @if ($disp > 0)
                                @livewire('reserva-evento', ['evento'=>$evento, 'func_id'=>$funcion->func_id], key($funcion->func_id))
                            @else
                                Entradas agotadas 
                            @endif
                        </div>
                    </div>
                    
            @endforeach
        </div>
@endif

        @livewire('save-res')
    </div>

</x-app-layout>
