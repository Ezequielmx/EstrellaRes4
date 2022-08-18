<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">
        <link href="https://fonts.googleapis.com/css2?family=RocknRoll+One&display=swap" rel="stylesheet">
        <!-- Styles -->
        <link rel="stylesheet" href="{{ mix('css/app.css') }}">
        <link rel="stylesheet" href="css/st.css">

        

         <!-- Latest compiled and minified CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Latest compiled JavaScript -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.2/dist/js/bootstrap.bundle.min.js"></script>    
    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        @livewireStyles

        <!-- Scripts -->
        <script src="{{ mix('js/app.js') }}" defer></script>

        <!-- sweetalert -->
        <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>


           <!-- Global site tag (gtag.js) - Google Analytics -->
            <script async src="https://www.googletagmanager.com/gtag/js?id=G-E4DY2SX1MN"></script>
            <script>
            window.dataLayer = window.dataLayer || [];
            function gtag(){dataLayer.push(arguments);}
            gtag('js', new Date());

            gtag('config', 'G-E4DY2SX1MN');
            </script>
    </head>
    <body class="font-sans antialiased">
        {{--  
        <a href="https://api.whatsapp.com/send?phone=+5491141462850" class="btn-wsp" target="_blank">
            <i class="fa fa-whatsapp icono"></i>
        </a>
        --}}
        <x-jet-banner />

        <div class="min-h-screen">
            @livewire('navigation-menu')

            <!-- Page Heading -->
            @if (isset($header))
                <header class="bg-white shadow">
                    <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                        {{ $header }}
                    </div>
                </header>
            @endif

            <!-- Page Content -->
            <main>
                {{ $slot }}
            </main>
        </div>

        @stack('modals')

        @livewireScripts

        @stack('js')

        <script>
            Livewire.on('alert', function(message, titulo, icono){
                Swal.fire({
                    title: 
                        titulo,
                    icon: 
                        icono,
                    html: 
                        message,
            })
        });

        Livewire.on('confirmRes', function(mens, importe, usuario ,telefono, cant_adul, cant_esp, selectedFunc1, selectedFunc2, evento_id){
            Swal.fire({
                title: 'Revisá si está todo bien antes de Reservar:',
                html: mens,
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#d33',
                cancelButtonColor: '#3085d6',
                confirmButtonText: 'Si. Reservar',
                cancelButtonText: 'No. Cancelar'
            }).then((result) => {
                if (result.isConfirmed) {
                    Livewire.emit('saveResU', importe, usuario ,telefono, cant_adul, cant_esp, selectedFunc1, selectedFunc2, evento_id);
                }
            })  
        });

        </script>
    </body>
</html>
