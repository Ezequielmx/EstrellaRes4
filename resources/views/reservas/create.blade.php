@extends('layouts.plantilla')

@section('title', 'RESERVA')

@section('content')
    @php
        setlocale(LC_TIME, "spanish");	
    @endphp 

    @livewire('form-res-component')

    
@endsection