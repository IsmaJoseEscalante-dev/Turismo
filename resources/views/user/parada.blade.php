@extends('layouts.app')

@section('content')
    <div class="container">
        <h4>Preservar a  <b>{{ $tour->name }}</b></h4>


        <div class="row">
            <div class="col-md-6 col-lg-7 col-xl-8">
                <div class="card">
                    <div class="card-body">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($paradas as $parada)
                                    @if ($loop->iteration == 1)
                                        @foreach ($parada->images as $image)
                                            <div class="carousel-item active">
                                                <img src="{{ Storage::url($image->image) }}" class="d-block w-100"
                                                    alt="...">
                                            </div>
                                        @endforeach
                                    @else
                                        @foreach ($parada->images as $image)
                                            <div class="carousel-item">
                                                <img src="{{ Storage::url($image->image) }}" class="d-block w-100"
                                                    alt="...">
                                            </div>
                                        @endforeach
                                    @endif

                                @endforeach
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
                {{-- Descripcion del tour --}}
                <section class="mt-5">
                    <div class="text-justify">
                        <p class="lead">{!! $tour->description_tour !!}</p>
                    </div>
                </section>
                <section class="mt-5">
                    <h3 class="color-primary">Descripcion</h3>
                    <div class="text-justify">
                        <p class="lead">{!! $tour->description_place !!}</p>
                    </div>
                </section>
                {{-- Descripcion del tour --}}
                <section class="mt-5">
                    <h3 class="color-primary">Itinerario</h3>
                    <div>
                        <p class="lead">{!! $tour->itinerario !!}</p>
                    </div>
                </section>

                <section class="mt-5">
                    <h3 class="color-primary">Servicios</h3>
                    <div>
                        <p class="lead">{!! $tour->services !!}</p>
                    </div>
                </section>

                <section class="mt-5">
                    <h3 class="color-primary">Tips</h3>
                    <div>
                        <p class="lead">{!! $tour->tips !!}</p>
                    </div>
                </section>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-body">
                        <form-booking-component :tour="{{ json_encode($tour) }}"></form-booking-component>
                    </div>
                </div>
            </div>
        </div>

        {{-- Comentarios --}}
        <section class="mt-5">
            <div class="text-center">
                <h3 class="color-primary">Opiniones de nuestros clientes</h3>
                <p class="lead">Todas las opiniones han sido escritas por clientes reales que han reservado con nosotros.
                </p>
            </div>
            <comment-component :tour="{{ json_encode($tour->id) }}"></comment-component>
        </section>
    </div>
@endsection

@section('css')
    <style>
        .color-primary {
            color: #14505C !important;
        }

    </style>
@endsection
