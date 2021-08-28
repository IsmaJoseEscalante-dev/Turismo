<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="shortcut icon" href="{{ asset('/imagenes/icono.jpg') }}" type="image/png">

    <!--=============== REMIXICONS ===============-->
    <link href="https://cdn.jsdelivr.net/npm/remixicon@2.5.0/fonts/remixicon.css" rel="stylesheet">

    <!--=============== SWIPER CSS ===============-->
    <link rel="stylesheet" href="{{ asset('css/swiper-bundle.min.css') }}">

    <!--=============== CSS ===============-->
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">


    <!-- Bootstrap CSS -->
    <!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous"> -->
    <title>A'lli Turismo</title>
</head>

<body>
    <header class="header" id="header">
        <nav class="nav container">
            <a href="#" class="nav__logo">A'lli Turismo</a>

            <div class="nav__menu" id="nav-menu">
                <ul class="nav__list">
                    <li class="nav__item">
                        <a href="#home" class="nav__link active-link">Principal</a>
                    </li>
                    <li class="nav__item">
                        <a href="#place" class="nav__link">Servicios</a>
                    </li>
                    <li class="nav__item">
                        <a href="#event" class="nav__link">Eventos</a>
                    </li>
                    <li class="nav__item">
                        <a href="#about" class="nav__link"> Nuesta Agencia</a>
                    </li>
                    <li class="nav__item">
                        <a href="#discover" class="nav__link">Descubrí </a>
                    </li>
                    @guest
                            @if (Route::has('login'))
                                <li class="nav__item">
                                    <a class="nav__link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif
                        @else
                            @if (Request::is('/'))
                                <li class="nav__item">
                                    <a href="{{ route('home') }}" class="nav__link">Home</a>
                                </li>
                            @else
                                <li class="nav__item dropdown">
                                    <a id="navbarDropdown" class="nav__link dropdown-toggle" href="#" role="button"
                                        data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                        {{ Auth::user()->name }}
                                    </a>

                                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                            class="d-none">
                                            @csrf
                                        </form>
                                    </div>
                                </li>
                            @endif
                        @endguest
                </ul>

                <div class="nav__dark">
                    <!-- Theme change button -->
                    <span class="change-theme-name">Dark mode</span>
                    <i class="ri-moon-line change-theme" id="theme-button"></i>
                </div>

                <i class="ri-close-line nav__close" id="nav-close"></i>
            </div>

            <div class="nav__toggle" id="nav-toggle">
                <i class="ri-function-line"></i>
            </div>
        </nav>
    </header>
    <main class="main">
        <!--==================== HOME ====================-->
        <section class="home" id="home">
            <img src="{{ asset('imagenes/fondo1.jpg') }}" class="home__img" alt="...">
            <!-- <div id="carouselExampleSlidesOnly" class="carousel slide home__img" data-bs-ride="carousel">
                    <div class="carousel-inner">
                      <div class="carousel-item active">
                        <img src="assets/img/FB_IMG_1624836172476.jpg" class="img-carousel" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="assets/img/IMG-20210614-WA0009.jpg" class="img-carousel" alt="...">
                      </div>
                      <div class="carousel-item">
                        <img src="assets/img/IMG-20210805-WA0016.jpg" class="img-carousel" alt="...">
                      </div>
                    </div>
                  </div> -->

            <div class="home__container container grid">
                <div class="home__data">
                    <span class="home__data-subtitle">Conoce nuevos lugares</span>
                    <h1 class="home__data-title"><b>A'lli Turismo </b> Leg.14876</b><br> Agencia de <b>viajes</b> </h1>
                    <a href="#" class="button">Explore</a>
                </div>

                <div class="home__social">
                    <a href="https://www.facebook.com/AlliTurismo" target="_blank" class="home__social-link">
                        <i class="ri-facebook-box-fill"></i>
                    </a>
                    <a href=https://www.instagram.com/alli_turismo/ target="_blank" class="home__social-link">
                        <i class="ri-instagram-fill"></i>
                    </a>
                    <a href="https://twitter.com/" target="_blank" class="home__social-link">
                        <i class="ri-twitter-fill"></i>
                    </a>
                </div>

                <div class="home__info">
                    @forelse ($promotions as $promotion)
                        <div>
                            <span class="home__info-title">{{ $promotion->name }}</span>
                            <a href="{{ route('promotions', $promotion->slug) }}" class="button button--flex button--link home__info-button">
                                Reservar <i class="ri-arrow-right-line"></i>
                            </a>
                        </div>

                        <div class="home__info-overlay">
                            <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="home__info-img">
                        </div>
                    @empty
                        <h6>No hay promociones</h6>
                    @endforelse
                </div>
            </div>
        </section>

        <!--==================== PLACES ====================-->
        <section class="place section" id="place">
            <h2 class="section__title">reserva tu lugar</h2>

            <div class="place__container container grid">
                <!--==================== PLACES CARD 1 ====================-->

                @foreach ($tours as $tour)
                    <div class="place__card">
                        <img src="{{ asset(Storage::url($tour->image->image)) }}" alt="" class="place__img">

                        <div class="place__content">
                            <span class="place__rating">
                                <i class="ri-star-line place__rating-icon"></i>
                                <span class="place__rating-number">4,8</span>
                            </span>

                            <div class="place__data">
                                <h3 class="place__title">{{ $tour->name }}</h3>
                                <span class="place__subtitle">{{ $tour->category->name }}</span>
                                <span class="place__price">{{ $tour->amount }}</span>
                            </div>
                        </div>

                        <a href="{{ route('paradas', $tour->slug) }}" class="button button--flex place__button">
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                @endforeach

        </section>

        <section class="place section" id="event">
            <h2 class="section__title">Proximos Eventos</h2>

            <div class="place__container container grid">
                <!--==================== PLACES CARD 1 ====================-->

                @foreach ($events as $event)
                    @foreach ($event->tours as $tour)
                    <div class="place__card">
                        <img src="{{ asset(Storage::url($tour->image->image)) }}" alt="" class="place__img">

                        <div class="place__content">
                            <span class="place__rating">
                                <i class="ri-star-line place__rating-icon"></i>
                                <span class="place__rating-number">4,8</span>
                            </span>

                            <div class="place__data">
                                {{-- <h3 class="place__title">{{ $tour->name }}</h3> --}}
                                {{-- <span class="place__subtitle">{{ $tour->category->name }}</span> --}}
                                <span class="place__subtitle">{{ $event->start }}</span>
                                <span class="place__price">{{ $tour->amount }}</span>
                            </div>
                        </div>

                        <a href="{{ route('paradas', $tour->slug) }}" class="button button--flex place__button">
                            <i class="ri-arrow-right-line"></i>
                        </a>
                    </div>
                    @endforeach
                @endforeach
        </section>

        <!--==================== ABOUT ====================-->
        <section class="about section" id="about">
            <div class="about__container container grid">
                <div class="about__data">
                    <h2 class="section__title about__title">Más información <br> Acerca hermoso paisajes</h2>
                    <p class="about__description">Podrás encontrar los lugares más lindos y agradables a los mejores
                        precios con descuentos especiales, tu eliges el lugar te guiaremos todo el camino para esperar,
                        consigue tu lugar ahora.
                    </p>
                    <a href="#" class="button">Reserve tu butaca</a>
                </div>

                <div class="about__img">
                    <div class="about__img-overlay">
                        <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="about__img-one">
                    </div>

                    <div class="about__img-overlay">
                        <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="about__img-two">
                    </div>
                </div>
            </div>
        </section>

        <!--==================== DISCOVER ====================-->
        <section class="discover section" id="discover">
            <h2 class="section__title">Descubrí <br> paisajes más atractivos</h2>

            <div class="discover__container container swiper-container">
                <div class="swiper-wrapper">

                    @foreach ($tours as $tour)
                        <!--==================== DISCOVER 1 ====================-->
                        <div class="discover__card swiper-slide">
                            <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="discover__img">
                            <div class="discover__data">
                                <h2 class="discover__title">{{ $tour->name }}</h2>
                                <span class="discover__description">24 tours available</span>
                            </div>
                        </div>
                    @endforeach

                </div>
            </div>
        </section>

        <!--==================== EXPERIENCE ====================-->
        <section class="experience section">
            <h2 class="section__title">Con nuestra experiencia <br> Nosotros te serviremos</h2>

            <div class="experience__container container grid">
                <div class="experience__content grid">
                    <div class="experience__data">
                        <h2 class="experience__number">8</h2>
                        <span class="experience__description">Años <br> Experiencia</span>
                    </div>

                    <div class="experience__data">
                        <h2 class="experience__number">200</h2>
                        <span class="experience__description">Excursiones <br> Completadas</span>
                    </div>

                    <div class="experience__data">
                        <h2 class="experience__number">10+</h2>
                        <span class="experience__description"> Destinos <br> Destinos</span>
                    </div>
                </div>

                <div class="experience__img grid">
                    <div class="experience__overlay">
                        <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="experience__img-one">
                    </div>

                    <div class="experience__overlay">
                        <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="experience__img-two">
                    </div>
                </div>
            </div>
        </section>

        <!--==================== VIDEO ====================-->
        {{-- <section class="video section">
                <h2 class="section__title">Video Tour</h2>

                <div class="video__container container">
                    <p class="video__description">Find out more with our video of the most beautiful and
                        pleasant places for you and your family.
                    </p>

                    <div class="video__content">
                        <video id="video-file">
                            <source src="assets/video/video.mp4" type="video/mp4">
                        </video>

                        <button class="button button--flex video__button" id="video-button">
                            <i class="ri-play-line video__button-icon" id="video-icon"></i>
                        </button>
                    </div>
                </div>
            </section> --}}

        <!--==================== SUBSCRIBE ====================-->
        {{-- <section class="subscribe section">
            <div class="subscribe__bg">
                <div class="subscribe__container container">
                    <h2 class="section__title subscribe__title">Subscribe Our <br> Newsletter</h2>
                    <p class="subscribe__description">Subscribe to our newsletter and get a
                        special 30% discount.
                    </p>

                    <form action="" class="subscribe__form">
                        <input type="text" placeholder="Enter email" class="subscribe__input">

                        <button class="button">
                            Subscribe
                        </button>
                    </form>
                </div>
            </div>
        </section> --}}

        <!--==================== SPONSORS ====================-->
        <section class="sponsor section">
            <div class="sponsor__container container grid">
                <div class="sponsor__content">
                    <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="sponsor__img">
                </div>
                <div class="sponsor__content">
                    <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="sponsor__img">
                </div>
                <div class="sponsor__content">
                    <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="sponsor__img">
                </div>
                <div class="sponsor__content">
                    <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="sponsor__img">
                </div>
                <div class="sponsor__content">
                    <img src="{{ asset('imagenes/fondo1.jpg') }}" alt="" class="sponsor__img">
                </div>
            </div>
        </section>
    </main>

    <!--==================== FOOTER ====================-->
    <footer class="footer section">
        <div class="footer__container container grid">
            <div class="footer__content grid">
                <div class="footer__data">
                    <h3 class="footer__title">Travel</h3>
                    <p class="footer__description">Travel you choose the <br> destination,
                        we offer you the <br> experience.
                    </p>
                    <div>
                        <a href="https://www.facebook.com/" target="_blank" class="footer__social">
                            <i class="ri-facebook-box-fill"></i>
                        </a>
                        <a href="https://twitter.com/" target="_blank" class="footer__social">
                            <i class="ri-twitter-fill"></i>
                        </a>
                        <a href="https://www.instagram.com/" target="_blank" class="footer__social">
                            <i class="ri-instagram-fill"></i>
                        </a>
                        <a href="https://www.youtube.com/" target="_blank" class="footer__social">
                            <i class="ri-youtube-fill"></i>
                        </a>
                    </div>
                </div>

                <div class="footer__data">
                    <h3 class="footer__subtitle">About</h3>
                    <ul>
                        <li class="footer__item">
                            <a href="" class="footer__link">About Us</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Features</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">New & Blog</a>
                        </li>
                    </ul>
                </div>

                <div class="footer__data">
                    <h3 class="footer__subtitle">Company</h3>
                    <ul>
                        <li class="footer__item">
                            <a href="" class="footer__link">Team</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Plan y Pricing</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Become a member</a>
                        </li>
                    </ul>
                </div>

                <div class="footer__data">
                    <h3 class="footer__subtitle">Support</h3>
                    <ul>
                        <li class="footer__item">
                            <a href="" class="footer__link">FAQs</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Support Center</a>
                        </li>
                        <li class="footer__item">
                            <a href="" class="footer__link">Contact Us</a>
                        </li>
                    </ul>
                </div>
            </div>

            <div class="footer__rights">
                <p class="footer__copy">&#169; 2021 Bedimcode. All rigths reserved.</p>
                <div class="footer__terms">
                    <a href="#" class="footer__terms-link">Terms & Agreements</a>
                    <a href="#" class="footer__terms-link">Privacy Policy</a>
                </div>
            </div>
        </div>
    </footer>

    <!--========== SCROLL UP ==========-->
    <a href="#" class="scrollup" id="scroll-up">
        <i class="ri-arrow-up-line scrollup__icon"></i>
    </a>

    <!--=============== SCROLL REVEAL===============-->
    <script src="{{ asset('js/scrollreveal.min.js') }}"></script>

    <!--=============== SWIPER JS ===============-->
    <script src="{{ asset('js/swiper-bundle.min.js') }}"></script>

    <!--=============== MAIN JS ===============-->
    <script src="{{ asset('js/main.js') }}"></script>

    <!--=============== Boopstrap 5 JS ===============-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous">
    </script>
</body>

</html>
