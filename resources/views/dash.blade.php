@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pendataan bulan ini</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="data-pendataan"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Pembayaran bulan ini</h3>
                </div>
                <div class="card-body">
                    <div class="chart">
                        <canvas id="data-pembayaran"></canvas>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" herf="{{ asset('vendor/chart.js/Chart.min.css') }}">
@stop

@section('js')
    <script src="{{ asset('vendor/chart.js/Chart.min.js') }}"></script>

    <script>
        new Chart($('#data-pendataan'), {
            type: 'pie',
            data: {
                labels: ['Belum', 'Sudah'],
                datasets: [{
                    label: '# of Votes',
                    data: {{ json_encode($pendataan)}},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });

        new Chart($('#data-pembayaran'), {
            type: 'pie',
            data: {
                labels: ['Sebagian', 'Lunas', 'Belum'],
                datasets: [{
                    label: '# of Votes',
                    data: {!! json_encode($pembayaran) !!},
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                    ],
                    borderColor: [
                        'rgba(255, 99, 132, 1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                    ],
                    borderWidth: 1
                }]
            }
        });
    </script>
@stop
