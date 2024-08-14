@extends('adminlte::page')

@section('title', 'Sales-SarSoft')

@section('content_header')
@stop

@section('content')
    <div class="row">
        <div class="col-md-6 card">
            <canvas id="vistaSales"></canvas>
        </div>
    </div>
@stop

@section('css')
    <!-- Puedes agregar tus estilos personalizados aquí -->
@stop

@section('js')
    @vite(['resources/js/app.js'])

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            if (typeof Chart !== 'undefined') {
                console.log('Chart.js loaded:', Chart);

                var ctx = document.getElementById('vistaSales').getContext('2d');

                var productNames = @json($boardSale->pluck('product.name'));
                var productAmounts = @json($boardSale->pluck('total_amount'));

                var myChart = new Chart(ctx, {
                    type: 'doughnut',
                    data: {
                        labels: productNames,
                        datasets: [{
                            label: 'Cantidad Comprada',
                            data: productAmounts,
                            backgroundColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderColor: [
                                'rgba(255, 99, 132, 1)',
                                'rgba(54, 162, 235, 1)',
                                'rgba(255, 206, 86, 1)',
                                'rgba(75, 192, 192, 1)',
                                'rgba(153, 102, 255, 1)',
                                'rgba(255, 159, 64, 1)'
                            ],
                            borderWidth: 1
                        }]
                    },
                    options: {
                        responsive: true,
                        plugins: {
                            legend: {
                                position: 'top',
                            },
                            title: {
                                display: true,
                                text: 'Productos más comprados en el mes'
                            }
                        }
                    }
                });
            } else {
                console.error('Chart.js no está cargado correctamente.');
            }
        });
    </script>
@stop
