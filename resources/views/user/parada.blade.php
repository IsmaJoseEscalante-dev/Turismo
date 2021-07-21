@extends('layouts.app')

@section('content')
    <div class="container-fluid">
        <h4>parada {{ $tour->name }}</h4>
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
                            <ul class="slides">
                                <li class="ml-3">
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
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <form-booking-component></form-booking-component>
                    </div>
                </div>
            </div>
        </div>

    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="{{ asset('plugins/FlexSlider/flexslider.css') }}" type="text/css">
    <style>
        .flexslider {
            margin: 0 0 !important;
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
                itemWidth: 110,
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/js/bootstrap-datepicker.js"></script>
@endsection
