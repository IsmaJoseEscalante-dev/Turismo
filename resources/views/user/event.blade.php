@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Reservar a <b>{{ $event->name }}</b></h4>
        <div class="row">
            <div class="col-md-6 col-lg-7 col-xl-8">
                <div class="card">
                    <div class="card-body p-0">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                <div class="carousel-item active">
                                    <img src="{{ asset('imagenes/fondo1.jpg') }}" width="100%" height="400px"
                                         alt="...">
                                </div>
                            </div>
                            <a class="carousel-control-prev" href="#carouselExampleControls" role="button"
                               data-slide="prev">
                                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                <span class="sr-only">Previous</span>
                            </a>
                            <a class="carousel-control-next" href="#carouselExampleControls" role="button"
                               data-slide="next">
                                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                <span class="sr-only">Next</span>
                            </a>
                        </div>
                    </div>
                </div>
                {{-- Descripcion del event --}}
                <section class="mt-5">
                    <div class="text-justify">
                        <p class="lead">{!! $event->tour->description_event !!}</p>
                    </div>
                </section>
                <section class="mt-5">
                    <h3 class="text-primary">Descripcion del tour</h3>
                    <div class="text-justify">
                        <p class="lead">{!! $event->tour->description_place !!}</p>
                    </div>
                </section>
                {{-- Descripcion del event --}}
                <section class="mt-5">
                    <h3 class="text-primary">Itinerario</h3>
                    <div>
                        <p class="lead">{!! $event->tour->itinerario !!}</p>
                    </div>
                </section>

                <section class="mt-5">
                    <h3 class="text-primary">Servicios</h3>
                    <div>
                        <p class="lead">{!! $event->tour->services !!}</p>
                    </div>
                </section>

                <section class="mt-5">
                    <h3 class="text-primary">Tips</h3>
                    <div>
                        <p class="lead">{!! $event->tour->tips !!}</p>
                    </div>
                </section>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-body">
                    <h4 class="text-right text-primary font-weight-bold">$ {{ $event->amount }}</h4>
                        <event-component
                            :model="{{ json_encode($event) }}"
                        ></event-component>
                    </div>
                </div>
            </div>
        </div>

        {{-- Comentarios --}}
        <section class="mt-5">
            <div class="text-center">
                <h3 class="text-primary">Opiniones de nuestros clientes</h3>
                <p class="lead">Todas las opiniones han sido escritas por clientes reales que han reservado con
                    nosotros.
                </p>
            </div>
            <comment-component :tour="{{ json_encode($event->tour_id) }}"></comment-component>
        </section>
    </div>
@endsection
