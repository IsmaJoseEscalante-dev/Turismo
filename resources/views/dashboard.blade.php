@extends('layouts.admin')

@section('title', 'Dashboard')

@section('content')
    <div class="container pt-3">
        <div class="row">
            <div class="col-6 col-md-4 col-lg-3">
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
            <div class="col-6 col-md-4 col-lg-3">
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
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card bg-primary">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>USUARIOS</b>
                                <h5>
                                    <h5>{{ $users }}<h5>
                        </div>
                        <div>
                            <i class="fas fa-users" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card bg-warning ">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>RESERVAS</b></h5>
                            <h5>{{ $bookings }}</h5>
                        </div>
                        <div>
                            <i class="fas fa-address-book" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card bg-warning ">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>CARRITO</b></h5>
                            <h5>{{ $carts }}</h5>
                        </div>
                        <div>
                            <i class="fas fa-shopping-cart" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-6 col-md-4 col-lg-3">
                <div class="card bg-danger ">
                    <div class="card-body text-white d-flex align-items-center justify-content-between">
                        <div>
                            <h5><b>TOTAL RESERVAS</b></h5>
                            <h5>{{ $total }}</h5>
                        </div>
                        <div>
                            <i class="fas fa-dollar-sign" style="font-size:50px"></i>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Ganancias por mes</h5>
                        <canvas id="ganancias_Mes" height="150px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Ganancias por año</h5>
                        <canvas id="ganancias_Year" height="150px"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Reservas por mes</h5>
                        <canvas id="booking_month" height="150px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-6">
                <div class="card">
                    <div class="card-body">
                        <h5>Reservas por año</h5>
                        <canvas id="booking_year" height="150px"></canvas>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <h5>Usuarios registrados por mes</h5>
                        <canvas id="user-register" height="150px"></canvas>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <h5>Usuarios registrados en los ultimos años</h5>
                        <canvas id="user-year" height="150px"></canvas>
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
        let year = <?php echo $year; ?>;

        let barChartData = {
            labels: <?php echo $meses; ?>,
            datasets: [{
                label: 'usuarios',
                data: <?php echo $userMonth; ?>,
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

        let bookingForMonth = {
            labels: <?php echo $meses; ?>,
            datasets: [{
                label: 'reservas',
                data: <?php echo $bookingsMonth; ?>,
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
        let montoForMonth = {
            labels: <?php echo $meses; ?>,
            datasets: [{
                label: 'Ganancias',
                data: <?php echo $montoMonth; ?>,
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
                data: <?php echo $userYear; ?>,
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

        let bookingsYear = {
            labels: year,
            datasets: [{
                label: 'usuarios',
                data: <?php echo $bookingYear; ?>,
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

        let montoYear = {
            labels: year,
            datasets: [{
                label: 'year',
                data: <?php echo $montoYear; ?>,
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

        window.onload = function() {
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
            let montoMeses = document.getElementById("ganancias_Mes").getContext("2d");
            window.myBar = new Chart(montoMeses, {
                type: 'bar',
                data: montoForMonth,
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
                        text: 'Reservas por por año'
                    }
                }
            });
            let bookingMeses = document.getElementById("booking_month").getContext("2d");
            window.myBar = new Chart(bookingMeses, {
                type: 'bar',
                data: bookingForMonth,
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
                        text: 'Reservas por por año'
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

            let montoForYear = document.getElementById("ganancias_Year").getContext("2d");
            window.myBar = new Chart(montoForYear, {
                type: 'bar',
                data: montoYear,
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
                        text: 'Ganancias registrados por año'
                    }
                }
            });
        };

        let bookingsForYear = document.getElementById("booking_year").getContext("2d");
        window.myBar = new Chart(bookingsForYear, {
            type: 'bar',
            data: bookingsYear,
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
    </script>
@stop
