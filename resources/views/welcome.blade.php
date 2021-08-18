@extends('layouts.app')

@section('css')
    <link rel="stylesheet" href="{{ asset('css/main.css') }}">
@endsection

@section('content')
    <main>
        <div class="main-content">
            <h3 style="color:rgb(182, 182, 64)"> desde 890$ </h3>
            <h4 class="text"> Realizamos tours a Salta y Jujuy</h4>
            <br>
            <h2> Welcome </h2>
            <h1 class="text-big"> ALL TURISMO </h1>
            <br>
            <h4 class="text"> Gracias por su confianza , esperamos <br />que tenga momentos inolvidables
                junto a nostros</h4>
            <br>
            <a class="boton-personalizado" href="https://vinkula.com">Read More</a>
        </div>
        <div class="carousel">
            <div id="MyCarousel" class="carousel slide" data-ride="carousel">
                <div class="carousel-inner">
                    <div class="carousel-item active">
                        <img src="/imagenes/fondo1.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/imagenes/fondo2.jpg" class="d-block w-100" alt="...">
                    </div>
                    <div class="carousel-item">
                        <img src="/imagenes/fondo3.jpg" class="d-block w-100" alt="...">
                    </div>
                </div>
            </div>
        </div>
    </main>

    <div class="container-fluid" style="background-color:rgb(218, 214, 214);">
        <div class="" style="text-align:center;">
            <h1 style = 'text-align:center'> Excursiones diarias </h1>
        </div>
        <div class="container">
            @foreach ($tours as $tour)
                <div class="row" style="background-color:#fdfdfd;" >
                    <div class="card-body">
                        <a href="{{ route('paradas', $tour->slug) }}" class="text-decoration-none text-dark">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="/imagenes/img1.jpeg" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <div class="d-flex justify-content-between">
                                        <h5 class="card-title"><b>{{ $tour->name }}</b></h5>
                                        <h5><b> $ {{ $tour->amount }} </b></h5>
                                    </div>
                                    <div class="card__stars">
                                        <svg xmlns="http://www.w3.org/2000/svg" width="100" height="16">
                                           <g fill="none" fill-rule="evenodd">
                                              <path stroke="#FFBF2C" d="M92 1.13l2.02 4.09 4.514.657-3.267 3.185.771 4.496L92 11.435l-4.038 2.123.771-4.496-3.267-3.185 4.515-.656L92 1.13z" />
                                              <path fill="#FFBF2C" d="M71 12l-4.702 2.472.898-5.236-3.804-3.708 5.257-.764L71 0l2.351 4.764 5.257.764-3.804 3.708.898 5.236zM50 12l-4.702 2.472.898-5.236-3.804-3.708 5.257-.764L50 0l2.351 4.764 5.257.764-3.804 3.708.898 5.236zM29 12l-4.702 2.472.898-5.236-3.804-3.708 5.257-.764L29 0l2.351 4.764 5.257.764-3.804 3.708.898 5.236zM8 12l-4.702 2.472.898-5.236L.392 5.528l5.257-.764L8 0l2.351 4.764 5.257.764-3.804 3.708.898 5.236z" />
                                           </g>
                                        </svg>
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
                <br>
            @endforeach
        </div>
       {{--  <div class="col-md-4 px-0">
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
        </div> --}}
    </div>
   {{--  <h3 class="text-center">Eventos de esta semana</h3>
    <div class="row container-fluid">
        <div class="col-md-8">
            @foreach ($events as $event)
                <div class="card mb-3">
                    <div class="card-body">
                        <a href="#" class="text-decoration-none text-dark">
                            <div class="row">
                                <div class="col-md-4">
                                    <img src="/imagenes/img1.jpeg" class="img-fluid rounded-start" alt="...">
                                </div>
                                <div class="col-md-8">
                                    <h5 class="card-title"><b>{{ $event->title }}</b></h5>
                                    <h5>{!! $event->description !!}</h5>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="col-md-4">
            <div class="card">
                <div class="card-body">
                    <h4>limpiando</h4>
                </div>
            </div>
        </div>
    </div> --}}

    <div class="py-5">
        <div class="text-center">
            <h1>HOT DEALS</h1>
            Use our special offers for exploring the world
            <div class="separador"></div>
        </div>
        <div id="carouselExampleIndicators" class="carousel slide mb-4" data-ride="carousel">
            <ol class="carousel-indicators">
                <li data-target="#carouselExampleIndicators" data-slide-to="0" class="active"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="1"></li>
                <li data-target="#carouselExampleIndicators" data-slide-to="2"></li>
            </ol>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-0 img-content">
                                    <img src="imagenes/slider3.jpg" alt="img-carousel1" class="img-carousel-card">
                                    <div class="letras-carousel">
                                        <span class="letras-bg h4">letras</span>
                                        <p class="lead carousel-parrafo pl-2">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Dolor corrupti ratione et?</p>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-0 img-content">
                                    <img src="imagenes/slider2.jpg" alt="img-carousel1" class="img-carousel-card">
                                    <div class="letras-carousel">
                                        <span class="letras-bg h4">letras</span>
                                        <p class="lead carousel-parrafo pl-2">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Dolor corrupti ratione et?</p>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-0 img-content">
                                    <img src="imagenes/slider4.jpg" alt="img-carousel1" class="img-carousel-card">
                                    <div class="letras-carousel">
                                        <span class="letras-bg h4">letras</span>
                                        <p class="lead carousel-parrafo pl-2">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Dolor corrupti ratione et?</p>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-0 img-content">
                                    <img src="imagenes/slider1.jpg" alt="img-carousel1" class="img-carousel-card">
                                    <div class="letras-carousel">
                                        <span class="letras-bg h4">letras</span>
                                        <p class="lead carousel-parrafo pl-2">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Dolor corrupti ratione et?</p>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-0 img-content">
                                    <img src="imagenes/slider3.jpg" alt="img-carousel1" class="img-carousel-card">
                                    <div class="letras-carousel">
                                        <span class="letras-bg h4">letras</span>
                                        <p class="lead carousel-parrafo pl-2">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Dolor corrupti ratione et?</p>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-0 img-content">
                                    <img src="imagenes/slider4.jpg" alt="img-carousel1" class="img-carousel-card">
                                    <div class="letras-carousel">
                                        <span class="letras-bg h4">letras</span>
                                        <p class="lead carousel-parrafo pl-2">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Dolor corrupti ratione et?</p>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="carousel-item">
                    <div class="row">
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-0 img-content">
                                    <img src="imagenes/slider1.jpg" alt="img-carousel1" class="img-carousel-card">
                                    <div class="letras-carousel">
                                        <span class="letras-bg h4">letras</span>
                                        <p class="lead carousel-parrafo pl-2">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Dolor corrupti ratione et?</p>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-0 img-content">
                                    <img src="imagenes/slider2.jpg" alt="img-carousel1" class="img-carousel-card">
                                    <div class="letras-carousel">
                                        <span class="letras-bg h4">letras</span>
                                        <p class="lead carousel-parrafo pl-2">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Dolor corrupti ratione et?</p>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="card">
                                <div class="card-body p-0 img-content">
                                    <img src="imagenes/slider3.jpg" alt="img-carousel1" class="img-carousel-card">
                                    <div class="letras-carousel">
                                        <span class="letras-bg h4">letras</span>
                                        <p class="lead carousel-parrafo pl-2">Lorem ipsum dolor sit amet consectetur
                                            adipisicing elit. Dolor corrupti ratione et?</p>
                                    </div>
                                    <div class="overlay"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="py-5">
        <div class="text-center">
            <h1>COUNTRY TOURS</h1>
            Each country provides a lot of opportunity to relax, learn something new and be excited.
            <div class="separador"></div>
        </div>

        <div class="wrapper-img container-fluid">
            <div class="card-images">
                <img
                    src="https://images.unsplash.com/photo-1477666250292-1419fac4c25c?auto=format&amp;fit=crop&amp;w=667&amp;q=80&amp;ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" />
                <h4 class="text-card-before text-center">Mountain</h4>
                <div class="info">
                    <h1>Mountain</h1>
                    <p>Lorem Ipsum is simply dummy text from the printing and typeseting industry</p>
                    <button>Read More</button>
                </div>
            </div>
            <div class="card-images">
                <img
                    src="https://images.unsplash.com/photo-1425342605259-25d80e320565?auto=format&amp;fit=crop&amp;w=750&amp;q=80&amp;ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" />

                <div class="info">
                    <h1>Road</h1>
                    <p>Lorem Ipsum is simply dummy text from the printing and typeseting industry</p>
                    <button>Read More</button>
                </div>
            </div>
            <div class="card-images">
                <img
                    src="https://images.unsplash.com/photo-1503249023995-51b0f3778ccf?auto=format&amp;fit=crop&amp;w=311&amp;q=80&amp;ixid=dW5zcGxhc2guY29tOzs7Ozs%3D" />

                <div class="info">
                    <h1>Protester</h1>
                    <p>Lorem Ipsum is simply dummy text from the printing and typeseting industry</p>
                    <button>Read More</button>
                </div>
            </div>
        </div>
    </div>
@endsection
