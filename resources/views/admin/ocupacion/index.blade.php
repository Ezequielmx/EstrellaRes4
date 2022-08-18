@extends('adminlte::page')

@section('title','Estrella del Plata')

@section('content')
    <h1 style="padding:7px"><i class="fas fa-chart-bar"></i> </i>&nbsp;&nbsp;Ocupación</h1>
    <div class="card">
        @livewire('admin.reserva-chart')
    </div>
    <div id="container-graph" style="height: 70vh">
		
	</div>

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin.css">
@stop

@section('js')

    <script src="https://code.highcharts.com/highcharts.js"></script>

    <script>
    Livewire.on('graph', function(titulo, categorias, dataRes, dataLib){
        //document.write(Array.from(dataRes));
        const reservas = [];
        dataRes.forEach(myFunction);
        function myFunction(item) {
            reservas.push(parseInt(item));
        }

        const libres = [];
        dataLib.forEach(myFunction2);
        function myFunction2(item) {
            libres.push(parseInt(item));
        }
        //document.write(vals);

        Highcharts.chart('container-graph', {
		    chart: {
		        type: 'bar'
		    },
		    title: {
		        text: titulo
		    },
		    xAxis: {
		        categories: categorias
		    },
		    yAxis: {
		        title: {
		            text: 'Reservas'
		        }
		    },
		    legend: {
		        reversed: true
		    },
		    plotOptions: {
		        series: {
		            stacking: 'normal',
		            dataLabels: {
                	enabled: true
            		}
		        },
		        
		    },
		    series: [{
		        name: 'Reservadas',
		        data: reservas,
                color: '#388e3c'
		    }, {
		        name: 'Restantes/Sobreventa',
		        data: libres,
		        color: '#e64a19'
		    }]
		});
    })

    </script>
@stop
