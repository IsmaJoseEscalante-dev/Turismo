@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container pt-3">
        <div class="row">
            <div class="col-6 col-md-3">
                <div class="card bg-danger ">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>EXCURSIONES</b>
                                <h5>
                                    <h5>{{ $tours }}<h5>
                        </div>
                        <div>
                            <i class="fas fa-hiking" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-success">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>ESTACIONES</b>
                                <h5>
                                    <h5>{{ $stations }}<h5>
                        </div>
                        <div>
                            <i class="fas fa-charging-station" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-primary">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>USUARIOS</b>
                                <h5>
                                    <h5>{{ $users }}<h5>
                        </div>
                        <div>
                            <i class="fas fa-hiking" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-warning ">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>RESERVAS</b></h5>
                            <h5>{{ $bookings }}</h5>
                        </div>
                        <div>
                            <i class="fas fa-hiking" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-6 col-md-3">
                <div class="card bg-warning ">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>CARRITO</b></h5>
                            <h5>{{ $carts }}</h5>
                        </div>
                        <div>
                            <i class="fas fa-hiking" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-3">
                <div class="card bg-danger ">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>TOTAL</b></h5>
                            <h5>{{ $total }}</h5>
                        </div>
                        <div>
                            <i class="fas fa-hiking" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChartTS"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <canvas id="myChartCT"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <canvas id="user-register" height="150px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">
                        <canvas id="sales_for_mounth" height="300px"></canvas>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-body">
                        <canvas id="user-year" height="150px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-4">
                <div class="card">
                    <div class="card-body">

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
    <!--favicon-->
    <link rel="icon" href="assets/images/favicon.ico" type="image/x-icon">

@stop

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
        var ctx = document.getElementById('myChartTS').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($namesTour); ?>,
                datasets: [{
                    label: '# Paradas por Excursión',
                    data: <?php echo json_encode($countStations); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
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
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        })
    </script>
    <script>
        var ctx = document.getElementById('myChartCT').getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
                labels: <?php echo json_encode($namesCategory); ?>,
                datasets: [{
                    label: '# Excursiónes por Cateogoria',
                    data: <?php echo json_encode($countTours); ?>,
                    backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)',
                        'rgba(153, 102, 255, 0.2)',
                        'rgba(255, 159, 64, 0.2)'
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
        });
    </script>

    <script>
        let meses = <?php echo $meses; ?>;
        let val_months = <?php echo $val_months; ?>;
        let year = <?php echo $year; ?>;
        let user = <?php echo $user; ?>;

        let barChartData = {
            labels: meses,
            datasets: [{
                label: 'usuarios',
                data: val_months,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgb(227, 34, 205, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                    'rgb(0, 113, 206, 0.2)',
                    'rgba(240, 208, 225, 0.2)',
                    'rgba(145, 116, 201, 0.2)',
                    'rgba(80, 146, 169, 0.2)',
                    'rgba(0, 0, 246, 0.2)',
                    'rgba(247, 139, 5, 0.2)',
                    'rgba(145, 0, 247, 0.2)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(227, 34, 205)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(0, 113, 206)',
                    'rgb(240, 208, 225)',
                    'rgb(145, 116, 201)',
                    'rgb(80, 146, 169)',
                    'rgb(0, 0, 246)',
                    'rgb(247, 139, 5)',
                    'rgb(145, 0, 247)',
                ],
                borderWidth: 1
            }]
        };
        let userYear = {
            labels: year,
            datasets: [{
                label: 'usuarios',
                data: user,
                backgroundColor: [
                    'rgba(255, 99, 132, 0.2)',
                    'rgb(227, 34, 205, 0.2)',
                    'rgba(255, 205, 86, 0.2)',
                    'rgba(75, 192, 192, 0.2)',
                    'rgba(54, 162, 235, 0.2)',
                ],
                borderColor: [
                    'rgb(255, 99, 132)',
                    'rgb(227, 34, 205)',
                    'rgb(255, 205, 86)',
                    'rgb(75, 192, 192)',
                    'rgb(54, 162, 235)',
                    'rgb(0, 113, 206)',
                ],
                borderWidth: 1
            }]
        };

        window.onload = function () {
            let ctx = document.getElementById("user-register").getContext("2d");
            window.myBar = new Chart(ctx, {
                type: 'bar',
                data: barChartData,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Usuarios registrados por año'
                    }
                }
            });

            let ctx_user = document.getElementById("user-year").getContext("2d");
            window.myBar = new Chart(ctx_user, {
                type: 'bar',
                data: userYear,
                options: {
                    elements: {
                        rectangle: {
                            borderWidth: 2,
                            borderColor: '#c1c1c1',
                            borderSkipped: 'bottom'
                        }
                    },
                    responsive: true,
                    title: {
                        display: true,
                        text: 'Usuarios registrados por año'
                    }
                }
            });
        };
    </script>
@stop
