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
                                    <img src="{{ asset('imagenes/slider1.jpg') }}" />
                                </li>
                                <li>
                                    <img src="{{ asset('imagenes/slider2.jpg') }}" />
                                </li>
                                <li>
                                    <img src="{{ asset('imagenes/slider3.jpg') }}" />
                                </li>
                                <li>
                                    <img src="{{ asset('imagenes/slider4.jpg') }}" />
                                </li>
                            </ul>
                        </div>
                        <div id="carousel" class="flexslider">
                            <ul class="slides">
                                <li class="ml-3">
                                    <img src="{{ asset('imagenes/slider1.jpg') }}" />
                                </li>
                                <li>
                                    <img src="{{ asset('imagenes/slider2.jpg') }}" />
                                </li>
                                <li>
                                    <img src="{{ asset('imagenes/slider3.jpg') }}" />
                                </li>
                                <li>
                                    <img src="{{ asset('imagenes/slider4.jpg') }}" />
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-5">
                <div class="card">
                    <div class="card-body">
                        <div class="form-group">
                            <label>Select Date: </label>
                            <div id="datepicker" class="input-group date" data-date-format="mm-dd-yyyy">
                                <input class="form-control" type="text" readonly />
                                <span class="input-group-addon"><i class="glyphicon glyphicon-calendar"></i></span>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">seleccionar el numero de pasajeros a reservar</label>
                            <input type="text" class="form-control">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

@endsection

@section('css')
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.3.0/css/datepicker.css" rel="stylesheet"
        type="text/css" />
    <style>
        .datepicker.dropdown-menu th,
        .datepicker.dropdown-menu td {
            padding: 10px 10px;
            font-size: 16px;
        }
        .flexslider{
            margin: 0 0 !important;
        }
    </style>
    <link rel="stylesheet" href="{{ asset('plugins/FlexSlider/flexslider.css') }}">
@endsection
@section('script')
    <script src="{{ asset('plugins/FlexSlider/jquery.flexslider.js') }}"></script>
    <script>
        $(document).ready(function() {
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
    <script>
        $(function() {
            $("#datepicker").datepicker({
                autoclose: true,
                todayHighlight: true,
                locale: 'es-es',
            }).datepicker('update', new Date());
        });
    </script>
    <script>
        $(function() {
            $("#datepicker").datepicker({
                closeText: 'Cerrar',
                prevText: '<Ant',
                nextText: 'Sig>',
                currentText: 'Hoy',
                monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto',
                    'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'
                ],
                monthNamesShort: ['Ene', 'Feb', 'Mar', 'Abr', 'May', 'Jun', 'Jul', 'Ago', 'Sep', 'Oct',
                    'Nov', 'Dic'
                ],
                dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
                dayNamesShort: ['Dom', 'Lun', 'Mar', 'Mié', 'Juv', 'Vie', 'Sáb'],
                dayNamesMin: ['Do', 'Lu', 'Ma', 'Mi', 'Ju', 'Vi', 'Sá'],
                weekHeader: 'Sm',
                dateFormat: 'dd/mm/yy',
                firstDay: 1,
                isRTL: false,
                showMonthAfterYear: false,
                yearSuffix: ''
            });
        });
    </script>
@endsection
