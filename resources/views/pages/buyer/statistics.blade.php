@extends('layouts.cotizador')
@section('content')

<div class="container mx-auto w-full px-2 mt-8">

    <div class="font-semibold text-slate-700 flex items-center mx-20">
       
        <div class="w-full flex justify-between">
            <div class="flex">
                <a class="text-secondary mr-2" href="/">Inicio </a>
                <p class="text-secondary mr-2"> / </p>
                <a class="text-secondary mr-2" href="#">Estadísticas</a>

            </div>

            <div class="flex"> 

                <!-- Modal toggle -->
                <button data-modal-target="default-modal" data-modal-toggle="default-modal" class="block text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800 mr-2" type="button">
                    Filtrar por fechas
                </button>
                
                <!-- Main modal -->
                <div id="default-modal" tabindex="-1" aria-hidden="true" class="hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50 justify-center items-center w-full md:inset-0 h-[calc(100%-1rem)] max-h-full">
                    <div class="relative p-4 w-full max-w-2xl max-h-full">
                        <!-- Modal content -->
                        <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                            <!-- Modal header -->
                            <div class="flex items-center justify-between p-4 md:p-5 border-b rounded-t dark:border-gray-600">
                                <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                                    Filtrar por fechas
                                </h3>
                                <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm w-8 h-8 ms-auto inline-flex justify-center items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-hide="default-modal">
                                    <svg class="w-3 h-3" aria-hidden="true" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 14 14">
                                        <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 6 6m0 0 6 6M7 7l6-6M7 7l-6 6"/>
                                    </svg>
                                    <span class="sr-only">Close modal</span>
                                </button>
                            </div>
                            <!-- Modal body -->
                            <div class="p-4 md:p-5 space-y-4">
                                <div class="p-4 md:p-5 space-y-4">
                                    <form action="{{ route('view.stadisticsFilter') }}" method="POST">
                                        @csrf
                                        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 mb-4">
                                            <div>
                                                <label for="start_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Fecha de inicio</label>
                                                <input type="date" name="start_date" id="start_date" required
                                                    class="mt-1 block w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            </div>
                                            <div>
                                                <label for="end_date" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Fecha de término</label>
                                                <input type="date" name="end_date" id="end_date" required
                                                    class="mt-1 block w-full p-2.5 bg-gray-50 border border-gray-300 text-gray-900 rounded-lg shadow-sm focus:ring-blue-500 focus:border-blue-500 sm:text-sm dark:bg-gray-700 dark:border-gray-600 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500">
                                            </div>
                                        </div>
                                        <div class="flex items-center justify-end">
                                            <button type="submit" class="text-white bg-primary hover:bg-black hover:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm px-5 py-2.5 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">Filtrar</button>
                                            <button data-modal-hide="default-modal" type="button" class="py-2.5 px-5 ms-3 text-sm font-medium text-gray-900 focus:outline-none bg-white rounded-lg border border-gray-200 hover:bg-gray-100 hover:text-blue-700 focus:z-10 focus:ring-4 focus:ring-gray-100 dark:focus:ring-gray-700 dark:bg-gray-800 dark:text-gray-400 dark:border-gray-600 dark:hover:text-white dark:hover:bg-gray-700">Cancelar</button>
                                        </div>
                                    </form>
                                </div>

                            </div>
                        
                        </div>
                    </div>
                </div>


                <form action="{{ route('download.stadistics') }}" method="POST">
                    @csrf                
                    <button type="submit" class="bg-primary text-black hover:bg-black hover:text-white font-bold py-2 px-4 rounded">
                        Descargar Estadísticas
                    </button>
                </form>
            </div>
        </div>
    </div>
    
    <br>


    <div class="grid grid-cols-3 gap-4 mx-20 my-5">

        <div class="col-span-1 bg-white shadow-md rounded-lg p-4">
            <h6 class="font-semibold mb-4 text-sm text-center">Acceso a la plataforma</h6>
            <canvas id="activeUsersData" width="300" height="300"></canvas>
        </div>

        <div class="col-span-2 bg-white shadow-md rounded-lg p-4">
            <h6 class="font-semibold mb-4 text-sm text-center">Muestras por usuario</h6>
            <canvas id="muestrasBarChart" width="300" height="300"></canvas>
        </div>
    </div>

    <div class="grid grid-cols-4 gap-4 mx-20 my-5">

        <div class="col-span-2 bg-white shadow-md rounded-lg p-4">
            <h6 class="font-semibold mb-4 text-sm text-center">Cotizaciones por usuario</h6>
            <canvas id="cotizacionesBarChart" width="300" height="300"></canvas>
        </div>

        <div class="col-span-2 bg-white shadow-md rounded-lg p-4">
            <h6 class="font-semibold mb-4 text-sm text-center">Compras por usuario</h6>
            <canvas id="comprasBarChart" width="300" height="300"></canvas>
        </div>

    </div>
    
    <p class="mx-20 mt-10 mb-4 text-lg"> Registro de acceso de usuarios</p>
    <div class="mx-20 mb-10">
        <table class="w-full bg-white border border-gray-200">
            <thead>
                <tr class="bg-black text-white">
                    <th class="py-2 px-4 border-b">#</th>
                    <th class="py-2 px-4 border-b">Usuario</th>
                    <th class="py-2 px-4 border-b">Correo</th>
                    <th class="py-2 px-4 border-b">Actividad</th>
                    <th class="py-2 px-4 border-b">Descripción</th>
                    <th class="py-2 px-4 border-b">Fecha y hora</th>
                </tr>
            </thead>
            <tbody>
                @foreach($stadistics as $stadistic)
                    <tr class="text-center">
                        <td class="py-2 px-4 border-b">{{ $loop->iteration}}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->user->name }}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->user->email }}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->type }}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->value }}</td>
                        <td class="py-2 px-4 border-b">{{ $stadistic->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>

            
        </table>

        <style>
            .pagination {
                display: flex;
                justify-content: flex-end; /* Alinear a la derecha */
                flex-wrap: nowrap; /* Evitar que se envuelvan en varias líneas */
                gap: 4px; /* Espaciado entre los elementos */
            }

            .page-item {
                display: inline-block;
            }

            .page-link {
                display: block;
                padding: 0.5rem 0.75rem;
                margin-left: -1px;
                line-height: 1.25;
                color: #000000;
                background-color: #fff;
                border: 1px solid #dee2e6;
                text-decoration: none;
            }

            .page-link:hover {
                color: #0056b3;
                background-color: #e9ecef;
                border-color: #dee2e6;
            }
        </style>
        <div class="w-full flex justify-end mt-4">
            <div class="inline-flex items-center">
                {{ $stadistics->links() }}
            </div>
        </div>
    </div>
  
</div>
   

    
@endsection


@section('scripts')
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js"></script>
    <script>
        // Colores para los gráficos
        var chartColors = ['#1B396A', '#26914F', '#37AF74', '#ECD90F', '#A12040', '#D6BC97'];

        // Configuración de opciones comunes para los gráficos
        var chartOptions = {
            responsive: true,
            maintainAspectRatio: false,
            scales: {
                xAxes: [{
                    ticks: {
                        fontSize: 12
                    }
                }],
                yAxes: [{
                    ticks: {
                        beginAtZero: true
                    }
                }]
            }
        };

        // Datos de los gráficos
        var chartsData = {
            activeUsersData: {!! json_encode($activeUsersData) !!},
        };

        var allCotizations = {!! json_encode($totalCotizations) !!};
        var userNames = allCotizations.map(item => item.user);
        var totals = allCotizations.map(item => item.total);

        var allCotizations = {!! json_encode($totalShoppings) !!};
        var shoppingUserNames = allCotizations.map(item => item.user);
        var shoppingTotals = allCotizations.map(item => item.total);

        var allCotizations = {!! json_encode($totalShoppings) !!};
        var shoppingUserNames = allCotizations.map(item => item.user);
        var shoppingTotals = allCotizations.map(item => item.total);

        // Labels comunes para los gráficos
        var labels_ranking = ['Muy malo', 'Malo', 'Regular', 'Bueno', 'Excelente'];
      
        var allMuestras = {!! json_encode($totalMuestras) !!};
        var muestasUserNames = allCotizations.map(item => item.user);
        var muestasTotals = allCotizations.map(item => item.total);

        // Función para generar gráfico de barras
        function generarGraficoBarras(ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: userNames,
                    datasets: [{
                        label: 'Total de Cotizaciones',
                        data: totals,
                        backgroundColor: chartColors,
                        borderColor: chartColors,
                        borderWidth: 1
                    }]
                },
                options: chartOptions
            });
        }

        function generarGraficoBarras2(ctx) {
            new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: shoppingUserNames,
                    datasets: [{
                        label: 'Total de Cotizaciones',
                        data: shoppingTotals,
                        backgroundColor: chartColors,
                        borderColor: chartColors,
                        borderWidth: 1
                    }]
                },
                options: chartOptions
            });
        }

        // Función para generar gráfico de dona
        function generarGraficoDona(ctx, data) {
            new Chart(ctx, {
                type: 'doughnut',
                data: {
                    labels: ['Activo', 'Inactivo'],
                    datasets: [{
                        label: 'Total',
                        data: Object.values(data),
                        backgroundColor: chartColors,
                        borderColor: chartColors,
                        borderWidth: 1
                    }]
                },
                options: chartOptions
            });
        }

        generarGraficoDona(document.getElementById('activeUsersData').getContext('2d'), chartsData.activeUsersData);
        generarGraficoBarras(document.getElementById('cotizacionesBarChart').getContext('2d'));
        generarGraficoBarras2(document.getElementById('comprasBarChart').getContext('2d'));
        generarGraficoBarras2(document.getElementById('muestrasBarChart').getContext('2d'));

    </script>
@endsection
