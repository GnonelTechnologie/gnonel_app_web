<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gnonel | @yield('title')</title>

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



    @yield('styles')

</head>

<body class="body">


    <!-- Preloader Start -->
    <div class="preloader">
        <div class="loading-container">
            <div class="loading"></div>
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
        <div class="header-area header-area1 header-area-all d-none d-lg-block" id="header">
            <div class="container">
                <div class="row">
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

    <div class="common-hero">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 m-auto text-center">
                    <div class="main-heading">
                        <h1>@yield('title')</h1>
                        <div class="pages-intro">
                            <a href="{{ route('index') }}">Accueil </a>
                            <span><i class="fa-regular fa-angle-right"></i></span>
                            <p>@yield('title')</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!--=====HERO AREA END=======-->

    <!--=====SERVICE AREA START=======-->

    @yield('content')

    <!--=====SERVICE AREA END=======-->

    @include('partials.landing.footer')


    <!--=====JQUERY=======-->
    <script src="/frontoffice/js/jquery-3-6-0.min.js"></script>
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
    <script src="{{ asset('backoffice/js/app.min.js') }}"></script>
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
    @yield('scripts')



</body>

</html>
