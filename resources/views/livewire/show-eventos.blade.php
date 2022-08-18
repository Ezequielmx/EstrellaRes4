@extends('layouts.plantilla')

@section('title', 'EVENTOS')

@livewireStyles()
@section('content')
<div>
    @php
        setlocale(LC_TIME, "spanish");	
    @endphp 

     <div class="max-w-7xl mx-auto sm:px-0 lg:px-8 te">
      <h1 class="tit-rck mb-4 mt-4 text-center respneg" style="color: white">No te pierdas los próximos EVENTOS!!</h1>

      <div class="row">
          
          @foreach ($eventos as $evento)
              @php
                  $img = $evento->imagen;
              @endphp             
                  <div class="col-md-6 col-lg-4 mb-4">
                      <a class="deco-none" href="{{ route('evento.show', $evento->id) }}">
                      <div class="card" style="width:100%; height:100%">
                          <img class="card-img-top" src="storage/{{ $evento->imagen }}" alt="Card image" style="width:100%">
                          <div class="card-body">
                            <h4 class="card-title tit-rck">{{ $evento->lugar }}</h4>
                            <x-jet-danger-button>
                              Reservar Entradas
                            </x-jet-danger-button>
                            <hr>
                              @foreach ($evento->fechas() as $fecha)
                              <li style="font-size: 1.1em; font-weight: bold;">
                                {{ utf8_encode(strftime("%A %d de %B", strtotime($fecha->fecha))) }}
                              </li>
                              @endforeach
                              <hr>
                            <p class="card-text">{{ $evento->speach }}</p>
                          </div>
                        </div>
                      </a>
                  </div> 
          @endforeach
      </div>
    </div>
</div>
@endsection
