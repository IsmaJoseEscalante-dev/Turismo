@extends('layouts.app')

@section('content')
    <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
            <div class="carousel-item active">
                <img src="/imagenes/img1.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/imagenes/img2.jpeg" class="d-block w-100" alt="...">
            </div>
            <div class="carousel-item">
                <img src="/imagenes/img3.jpeg" class="d-block w-100" alt="...">
            </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <div class="container-fluid row mt-4">
        <div class="col-md-8">
            @foreach ($tours as $tour)
                <div class="card mb-3">
                    <div class="card-body">
                        <a href="{{ route('paradas', $tour->slug) }}" class="text-decoration-none text-dark">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="/imagenes/img1.jpeg" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-between">
                                    <h5 class="card-title"><b>{{ $tour->name }}</b></h5>
                                    <h5><b>{{ $tour->amount }} $</b></h5>
                                    </div>
                                    <p class="card-text">This is a wider card with supporting text below as a natural
                                        lead-in to
                                        additional content. This content is a little bit longer.</p>
                                    <p class="card-text"><small class="text-muted">Last updated 3 mins ago</small></p>

                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4 px-0">
            <div class="card">
                <div class="card-body">
                    <h4>¿Por qué reservar con Viator?</h4>
                    <p class="lead">
                    <h4>Reserva flexible</h4>
                    Reservar con Viator es muy fácil: disfrute de cancelaciones gratuitas y opciones de pago flexibles.
                    <h4>Experiencias de primera</h4>
                    Con casi 400.000 tours y actividades, ofrecemos experiencias muy bien valoradas en todo el mundo.
                    </p>
                </div>
            </div>
        </div>
    </div>
@endsection
