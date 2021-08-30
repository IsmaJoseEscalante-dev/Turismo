@extends('layouts.app')

@section('content')
    <div class="container">
        <h3>{{ $promotion->name }}</h3>
        {{-- <ul class="nav">
            @foreach ($promotion->tours as $tour)

                @if ($loop->iteration == 1)
                    <li class="nav-item">
                        <a class="nav-link active" href="#">{{ $tour->name }}</a>
                    </li>
                @else
                    <li class="nav-item">
                        <a class="nav-link " href="#">{{ $tour->name }}</a>
                    </li>
                @endif
            @endforeach
        </ul> --}}

        <div class="row">
            <div class="col-md-6 col-lg-7 col-xl-8">
                <div class="card">
                    <div class="card-body p-0">
                        <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
                            <div class="carousel-inner">
                                @foreach ($promotion->tours as $tour)
                                    @if ($loop->iteration == 1)
                                        <div class="carousel-item active">
                                            <img src="{{ Storage::url($tour->image->image) }}" width="100%" height="400px"
                                                alt="...">
                                        </div>
                                    @else
                                        <div class="carousel-item">
                                            <img src="{{ Storage::url($tour->image->image) }}" width="100%" height="400px"
                                                alt="...">
                                        </div>
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
                <nav>
                    <ul class="nav nav-tabs pt-3" id="myTab" role="tablist">
                        @foreach ($promotion->tours as $tour)
                            <li class="nav-item" role="presentation">
                                @if ($loop->iteration == 1)
                                    <a class="nav-link active" id="{{ $tour->id }}-tab" data-toggle="tab"
                                        href="#{{ $tour->id }}" role="tab" aria-controls="{{ $tour->id }}"
                                        aria-selected="true">{{ $tour->name }}</a>
                                @else
                                    <a class="nav-link" id="{{ $tour->id }}-tab" data-toggle="tab"
                                        href="#{{ $tour->id }}" role="tab" aria-controls="{{ $tour->id }}"
                                        aria-selected="true">{{ $tour->name }}</a>
                                @endif
                            </li>
                        @endforeach
                    </ul>
                </nav>
                <div class="tab-content" id="myTabContent">
                    @foreach ($promotion->tours as $tour)
                        <div class="tab-pane fade {{ $loop->first ? 'show active' : '' }}" id="{{ $tour->id }}"
                            role="tabpanel" aria-labelledby="{{ $tour->id }}-tab">
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
                    @endforeach
                </div>
            </div>
            <div class="col-md-6 col-lg-5 col-xl-4 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-body">
                        <h4 class="text-right">$ {{ $promotion->amount }}</h4>
                        <promotion-component :model="{{ json_encode($promotion) }}"></promotion-component>
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
@section('script')
    <script>
        let size = {{ count($promotion->tours) }}
            for(let i = 1; i<= size; i++){
                $("a[href='#"+i+"']").click(function(){
                    $("#"+i).addClass("show active");
                    for(let j = 1; j<= size; j++){
                        if (j!= i) {
                            $("#"+j).removeClass("show active");
                        }
                    }
                });
            }
    </script>
@endsection
