@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h4>Paradas de  <b>{{ $tour->name }}</b></h4>
        <div class="row">
            <div class="col-md-7">
                <div class="card">
                    <div class="card-body">
                        <div id="slider" class="flexslider" style="margin:0 0 15px;">
                            <ul class="slides">
                                <li>
                                    <img src="{{ asset('imagenes/slider1.jpg') }}"/>
                                </li>
                                <li>
                                    <img src="{{ asset('imagenes/slider2.jpg') }}"/>
                                </li>
                                <li>
                                    <img src="{{ asset('imagenes/slider3.jpg') }}"/>
                                </li>
                                <li>
                                    <img src="{{ asset('imagenes/slider4.jpg') }}"/>
                                </li>
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides ul-flex">
                                <li class="ml-3 li-flex">
                                    <img src="{{ asset('imagenes/slider1.jpg') }}" alt="img1"/>
                                </li>
                                <li class="li-flex">
                                    <img src="{{ asset('imagenes/slider2.jpg') }}" alt="img2"/>
                                </li>
                                <li class="li-flex">
                                    <img src="{{ asset('imagenes/slider3.jpg') }}" alt="img3"/>
                                </li>
                                <li class="li-flex">
                                    <img src="{{ asset('imagenes/slider4.jpg') }}" alt="img4"/>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5 mt-3 mt-md-0">
                <div class="card">
                    <div class="card-body">
                        <form-booking-component
                            :tour="{{ json_encode($tour) }}"
                        ></form-booking-component>
                    </div>
                </div>
            </div>
        </div>
        {{-- Descripcion del tour --}}
        <section>
            <div class="row container-fluid my-3">
                <div class="col-md-4">
                    {{ $tour->description }}
                </div>
            </div>
        </section>

        {{-- Comentarios --}}
        <section>
            <h3>Comentarios</h3>
            <comment-component :tour="{{ json_encode($tour->id) }}"></comment-component>
        </section>
    </div>
@endsection

@section('style')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.9.0/css/bootstrap-datepicker.min.css">
    <link rel="stylesheet" href="{{ asset('plugins/FlexSlider/flexslider.css') }}" type="text/css">
    <style>
        .flexslider {
            margin: 0 0 !important;
        }

        .ul-flex {
            display: flex;
            width: 100% !important;
            justify-content: center;
        }

        .li-flex {
            float: none !important;
            width: 20% !important;

        }
    </style>
@endsection
@section('script')
    <script src="{{ asset('plugins/FlexSlider/jquery.flexslider.js') }}"></script>
    <script>
        $(document).ready(function () {
            $('#carousel').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: true,
                slideshow: false,
                itemWidth: 130,
                itemMargin: 4,
                asNavFor: '#slider'
            });

            $('#slider').flexslider({
                animation: "slide",
                controlNav: false,
                animationLoop: false,
                slideshow: false,
                sync: "#carousel"
            });
        });
    </script>
@endsection
