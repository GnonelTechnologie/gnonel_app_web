<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gnonel | Accueil</title>

    <!--=====FAB ICON=======-->
    <link rel="shortcut icon" href="/frontoffice/images/favicon.png" type="image/x-icon">


    <!--=====CSS=======-->
    <link rel="stylesheet" href="/frontoffice/css/bootstrap.min.css">
    <link rel="stylesheet" href="/frontoffice/css/fontawesome.css">
    <link rel="stylesheet" href="/frontoffice/css/magnific-popup.css">
    <link rel="stylesheet" href="/frontoffice/css/nice-select.css">
    <link rel="stylesheet" href="/frontoffice/css/slick-slider.css">
    <link rel="stylesheet" href="/frontoffice/css/owl.carousel.min.css">
    <link rel="stylesheet" href="/frontoffice/css/aos.css">
    <link rel="stylesheet" href="/frontoffice/css/mobile-menu.css">
    <link rel="stylesheet" href="/frontoffice/css/main.css">

    <style>
        .carousel-item img {
            height: 400px;
            object-fit: cover;
        }
    </style>



    <!--=====JQUERY=======-->
    <script src="/frontoffice/js/jquery-3-6-0.min.js"></script>
</head>

<body class="body">

    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading loading7"></div>
            <div id="loading-icon"><img src="/frontoffice/images/preloader-icon.png" alt=""></div>
        </div>
    </div>
    <!-- Preloader End -->

    <!--=====progress END=======-->

    <div class="paginacontainer">

        <div class="progress-wrap">
            <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
                <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" />
            </svg>
        </div>

    </div>

    <!--=====progress END=======-->

    <!--=====HEADER START=======-->
    <header>
        <div class="header-area header-area7 header-area-all d-none d-lg-block" id="header">
            <div class="container">
                <div class="row header-bg">
                    <div class="col-12">
                        @include('partials.landing.menu')
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!--=====HEADER END=======-->

    <!--=====Mobile header start=======-->
    @include('partials.landing.mobile-menu')

    <!--=====Mobile header end=======-->


    <!--=====HERO AREA START =======-->

    <div class="hero7" style="background-image: url(/frontoffice/img/bg/hero7-bg.jpg);">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="main-heading">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700"><img
                                src="/frontoffice/img/icons/span6.svg" alt="">Bienvenue sur gnonel.com</span>
                        <h1 class="text-anime-style-3" style="font-size:40px">
                            La solution technologique la plus complète au service des acteurs
                            de la Passation des Marchés.
                        </h1>
                        <div class="space16"></div>
                        <p>Rejoignez les milliers d’acteurs (Opérateurs économiques, les spécialistes en passation des
                            Marchés, experts domaines,) et vivez une expérience professionnelle incroyable.</p>
                        <div class="space30"></div>
                        <a class="theme-btn13" href="/listspec">Spécifications techniques</a>
                    </div>
                </div>
                <div class="col-lg-7">
                    <div class="hero7-images">
                        <div class="cs_height_118 cs_height_lg_70"></div>
                        <div class="cs_case_study_1_list">
                            <div class="cs_case_study cs_style_1 cs_hover_active active">
                                <div class="cs_case_study_thumb cs_bg_filed"
                                    data-src="/frontoffice/images/slides/slide1.jpg">
                                </div>
                            </div>
                            <div class="cs_case_study cs_style_1 cs_hover_active">
                                <div class="cs_case_study_thumb cs_case_study_thumb2 cs_bg_filed"
                                    data-src="/frontoffice/images/slides/slide1.jpg"></div>
                            </div>
                            <div class="cs_case_study cs_style_1 cs_hover_active">
                                <div class="cs_case_study_thumb cs_case_study_thumb3 cs_bg_filed"
                                    data-src="/frontoffice/images/slides/slide1.jpg"></div>
                            </div>
                        </div>
                        <img src="/frontoffice/img/shapes/hero7-shape.png" alt=""
                            class="shape shape-animaiton4">
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====HERO AREA END=======-->

    <!--=====ABOUT AREA START=======-->

    <div class="about7 sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="images-all">
                        <img src="/frontoffice/img/shapes/about7-shape.png" alt="" class="shape animate3">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="image reveal overlay-anim">
                                    <img src="/frontoffice/images/gnonel1.png" class="rounded-2" alt="">
                                </div>
                                <div class="review-area">
                                    <p>Disponible dans plus de 15 pays.</p>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="space50"></div>
                                <div class="image reveal overlay-anim">
                                    <img src="/frontoffice/images/gnonel2.png" class="rounded-2" alt="">
                                </div>
                                <div class="image reveal overlay-anim">
                                    <img src="/frontoffice/images/gnonel3.jpg" class="rounded-2" alt="">
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="heading7">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700"><img
                                src="/frontoffice/img/icons/span7.png" alt=""> Gnonel</span>
                        <h2 class="text-anime-style-3">Operateurs économiques, Spécialistes en Passation de Marchés,
                            experts domaines</h2>
                        <div class="space16"></div>
                        <p data-aos="fade-left" data-aos-duration="800">Nous mettons à votre disposition de nombreux
                            services et options technologiques qui facilitent votre quotidien sur le plan professionnel.
                            Rejoignez-nous et profitez de nombreuses opportunité...</p>
                        <div class="space30"></div>
                        <div class="" data-aos="fade-left" data-aos-duration="800">
                            <a href="{{ route('nos_service') }}" class="theme-btn12">En savoir plus</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--=====ABOUT AREA END=======-->

    <div class="work7 sp" style="background-color: #5957E5;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-5">
                    <div class="heading6-w">
                        <h2>Contactez-nous pour votre pub</h2>
                        <div class="space16"></div>
                        <p>Offrez vous plus de visibilité</p>
                        <div class="form-area mt-4">
                            <a href="{{ route('contact') }}" class="theme-btn13">Contactez-nous</a>
                        </div>
                    </div>
                </div>
                <div class="col-md-7 mt-3">

                    <div id="autoCarousel" class="carousel slide" data-bs-ride="carousel">
                        <!-- Indicators -->
                        <div class="carousel-indicators">
                            @foreach (getCarouselSliders() as $slider)
                                <button type="button" data-bs-target="#autoCarousel"
                                    data-bs-slide-to="{{ $loop->index }}"
                                    class="{{ $loop->first ? 'active' : '' }}"></button>
                            @endforeach
                        </div>

                        <!-- Slides -->
                        <div class="carousel-inner rounded-3">
                            @foreach (getCarouselSliders() as $slider)
                                <div class="carousel-item {{ $loop->first ? 'active' : '' }} rounded-3">
                                    <img src="{{ $slider->path }}" class="d-block w-100" alt="Nature">
                                </div>
                            @endforeach
                        </div>

                        <!-- Controls -->
                        <button class="carousel-control-prev" type="button" data-bs-target="#autoCarousel"
                            data-bs-slide="prev">
                            <span class="carousel-control-prev-icon"></span>
                        </button>
                        <button class="carousel-control-next" type="button" data-bs-target="#autoCarousel"
                            data-bs-slide="next">
                            <span class="carousel-control-next-icon"></span>
                        </button>
                    </div>
                </div>
            </div>
            <div class="space10"></div>
        </div>
    </div>


    <div class="service7 sp" style="background-color: #F8F7FF;">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading7">
                        <span class="span" data-aos="zoom-in-left" data-aos-duration="700"><img
                                src="/frontoffice/img/icons/span7.png" alt=""> Choisissez votre plan</span>
                        <h2 class="text-anime-style-3">Profitez de nombreux avantages</h2>
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="arrows-button">
                        <button class="service7-next-arrow1"><i class="fa-solid fa-angle-left"></i></button>
                        <button class="service7-prev-arrow1"><i class="fa-solid fa-angle-right"></i></button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="service7-slider" data-aos="fade-up" data-aos-duration="700">
                    <div class="single-slider">
                        <div class="image">
                            <img src="/frontoffice/images/formules/business.png" alt="">
                            <a href="{{ route('service-business') }}" class="hover-icon"><i
                                    class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="hover-area">
                            <div class="icon">
                                <i class="fa-solid fa-arrow-right" style="font-size: 20px"></i>
                            </div>
                            <div class="heading">
                                <h3><a href="{{ route('service-business') }}">Formules "Business"</a></h3>
                            </div>
                        </div>
                    </div>

                    <div class="single-slider">
                        <div class="image">
                            <img src="/frontoffice/images/formules/pro.png" alt="">
                            <a href="{{ route('service-pro') }}" class="hover-icon"><i
                                    class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="hover-area">
                            <div class="icon">
                                <i class="fa-solid fa-arrow-right" style="font-size: 20px"></i>
                            </div>
                            <div class="heading">
                                <h3><a href="{{ route('service-pro') }}">Forumules "Pro"</a></h3>
                            </div>
                        </div>
                    </div>

                    <div class="single-slider">
                        <div class="image">
                            <img src="/frontoffice/images/formules/mix.png" alt="">
                            <a href="{{ route('service-mix') }}" class="hover-icon"><i
                                    class="fa-solid fa-arrow-right"></i></a>
                        </div>
                        <div class="hover-area">
                            <div class="icon">
                                <i class="fa-solid fa-arrow-right" style="font-size: 20px"></i>
                            </div>
                            <div class="heading">
                                <h3><a href="{{ route('service-mix') }}">Formules "MIX"</a></h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>



    @include('partials.landing.footer')


    <script src="/frontoffice/js/bootstrap.min.js"></script>
    <script src="/frontoffice/js/aos.js"></script>
    <script src="/frontoffice/js/fontawesome.js"></script>
    <script src="/frontoffice/js/jquery.countup.js"></script>
    <script src="/frontoffice/js/mobile-menu.js"></script>
    <script src="/frontoffice/js/jquery.magnific-popup.js"></script>
    <script src="/frontoffice/js/owl.carousel.min.js"></script>
    <script src="/frontoffice/js/slick-slider.js"></script>
    <script src="/frontoffice/js/gsap.min.js"></script>
    <script src="/frontoffice/js/ScrollTrigger.min.js"></script>
    <script src="/frontoffice/js/Splitetext.js"></script>
    <script src="/frontoffice/js/SmoothScroll.js"></script>
    <script src="/frontoffice/js/text-animation.js"></script>
    <script src="/frontoffice/js/jquery.lineProgressbar.js"></script>
    <script src="/frontoffice/js/tilt.jquery.js"></script>
    <script src="/frontoffice/js/main.js"></script>


    <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>

    @if (Session::has('flash_message_error'))
        <script type="text/javascript">
            swal("{{ session('flash_message_error') }}", "Merci", "error");
        </script>
    @endif
    @if (Session::has('flash_message_success'))
        <script type="text/javascript">
            swal("{{ session('flash_message_success') }}", "Merci", "success");
        </script>
    @endif
    @if (Session::has('flash_message_warning'))
        <script type="text/javascript">
            swal("{{ session('flash_message_warning') }}", "Merci", "warning");
        </script>
    @endif

    <script>
        const myCarousel = new bootstrap.Carousel(document.getElementById('autoCarousel'), {
            interval: 3000, // 3 seconds
            pause: 'hover',
            loop: true
        });
    </script>
</body>

</html>
