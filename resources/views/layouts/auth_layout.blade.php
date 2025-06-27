<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Gnonel | @yield('title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Notre objectif est de faciliter la passation des Marchés." name="description" />
    <meta content="KOF CORPORATION" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backoffice/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('backoffice/css/config/default/bootstrap_.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('backoffice/css/config/default/app_.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('backoffice/css/config/default/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" />
    <link href="{{ asset('backoffice/css/config/default/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" />


    <meta name="csrf-token" content="{{ csrf_token() }}">
    <!-- icons -->
    <link href="{{ asset('backoffice/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern"
    style="background-image: url({{ asset('backoffice/images/bg.png') }});background-size: cover">

    @if (Session::has('flash_message_error'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('flash_message_error') }}", "Merci", "error");
        </script>
    @endif
    @if (Session::has('flash_message_success'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('flash_message_success') }}", "Merci", "success");
        </script>
    @endif
    @if (Session::has('flash_message_warning'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('flash_message_warning') }}", "Merci", "warning");
        </script>
    @endif

    @if (Session::has('email_ok'))
        <script>
            alert('veuillez consulter votre mail un mot de passe par défaut vous a été envoyé')
        </script>
    @endif
    @if (Session::has('email_nok'))
        <script>
            alert('adresse mail ou compte invalide')
        </script>
    @endif
    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                @yield('content')
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <footer class="footer footer-alt" style="color:white">
        2024 -
        <script>
            document.write(new Date().getFullYear())
        </script> &copy; Gnonel Powered by <a style="color:white;font-weight: bold;"
            href="https://kofcorporation.com" target="_blank" class="text-white-50">KOFCORPORATION</a>
    </footer>

    <!-- Vendor js -->
    <script src="{{ asset('backoffice/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backoffice/js/app.min.js') }}"></script>

</body>

</html>
