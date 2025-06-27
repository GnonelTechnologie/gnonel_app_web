<!DOCTYPE html>
<html lang="fr">

<head>
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-YFTP8J6JDF"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-YFTP8J6JDF');
    </script>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <title>@yield('titre')</title>
    <!-- Favicon-->
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}" />
    <!-- Core theme CSS (includes Bootstrap)-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{ asset('assets_recherche/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css">
    <link href="{{ asset('assets/css/plugins/chosen/chosen.css') }}" rel="stylesheet">
</head>

<body>
    <style type="text/css">
        li>a {
            color: black;
            font-size: 18px;
        }

        li>a:hover {
            color: black;
            font-size: 18px;
        }
    </style>
    <nav class="navbar navbar-expand-lg  fixed-top shadow-sm p-3 mb-5 bg-white rounded  bg-light">
        <a class="navbar-brand" style="margin-left: 7%;" href="{{ url('/') }}"><span
                class="fs-3 font-weight-bold pull-left" style="color: #3fa46a">gno<span>nel</span><span
                    style="color: #1b87fa">.com</span></span></a>
        <button class="navbar-toggler bg-primary" type="button" data-toggle="collapse" data-target="#navbarNav"
            aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav" style="margin-right: 7%;">
            <ul class="navbar-nav ml-auto">
                <li class="nav-item active">
                    <a class="nav-link text-dark " href="{{ route('welcome') }}">Accueil </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link text-dark " href="{{ route('nos_service') }}">Nos services</a>
                </li>

                @guest
                    <li class="nav-item">
                        <a class="nav-link text-dark " href="{{ route('login') }}">Se connecter</a>
                    </li>

                    @if (Route::has('register'))
                        <li class="nav-item">
                            <a class="nav-link text-white font-weight-bold btn btn-primary "
                                href="{{ route('choix_abonnement') }}">S'Abonner</a>
                        </li>
                    @endif
                @else
                    <li class="nav-item">
                        <a class="nav-link text-dark  dropdown-toggle" id="navbarDropdown" href="#" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                            <li><a class="text-dark dropdown-item" href="{{ route('info_compte') }}">Mon Compte</a></li>
                            <li><a class="dropdown-item text-dark" href="{{ route('logout') }}"
                                    onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    <i class="fas fa-sign-out-alt"></i> Déconnexion
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>
                    </li>
                @endguest
            </ul>
        </div>
    </nav>

    <div class="main-content" style="background-color:whitesmoke ">
        <br><br><br><br><br><br>
        @if (session()->has('okk'))
            <div class="container" style="z-index: 1000">
                <div class="row">
                    <div class=" col-lg-12 bg-success" id="okk"
                        style="height: 50px;font-size: 15px;border-radius: 10px">
                        <span
                            style="margin-top: 12px;color: white;font-size: 28px"><b>{{ session()->get('okk') }}</b></span>
                    </div>
                </div>
            </div>
        @endif

        @yield('content')
    </div>
    <!-- Contenu de l'application -->
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="{{ asset('assets/assetclient/js/scripts.js') }}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script src="{{ asset('assets/js/plugins/chosen/chosen.jquery.js') }}"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets_recherche/css/popper.min.js') }}"></script>
    <script src="{{ asset('assets_recherche/css/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets_recherche/css/popper.min.js') }}"></script>
    <script>
        $(document).ready(function() {
            $('#message').delay(8000).slideUp(300);
            $('#okk').delay(8000).slideUp(300);
            $('#example').DataTable({
                "oLanguage": {
                    "sProcessing": "Traitement en cours ...",
                    "sLengthMenu": "Afficher _MENU_ lignes",
                    "sZeroRecords": "Aucun résultat trouvé",
                    "sEmptyTable": "Aucune donnée disponible",
                    "sInfo": "Lignes _START_ à _END_ sur _TOTAL_",
                    "sInfoEmpty": "Aucune ligne affichée",
                    "sInfoFiltered": "(Filtrer un maximum de_MAX_)",
                    "sInfoPostFix": "",
                    "sSearch": "Chercher:",
                    "sUrl": "",
                    "sInfoThousands": ",",
                    "sLoadingRecords": "Chargement...",
                    "oPaginate": {
                        "sFirst": "Premier",
                        "sLast": "Dernier",
                        "sNext": "Suivant",
                        "sPrevious": "Précédent"
                    },
                    "oAria": {
                        "sSortAscending": ": Trier par ordre croissant",
                        "sSortDescending": ": Trier par ordre décroissant"
                    }
                }
            });

            var config = {


                '.chosen-select': {},

                '.chosen-select-deselect': {
                    allow_single_deselect: true
                },

                '.chosen-select-no-single': {
                    disable_search_threshold: 10
                },

                '.chosen-select-no-results': {
                    no_results_text: 'Oops, nothing found!'
                },

                '.chosen-select-width': {
                    width: "95%"
                }

            }

            for (var selector in config) {

                $(selector).chosen(config[selector]);

            }
        });
    </script>

    @yield('script')
    <div class="container">
        <footer>
            <div class="row row-cols-5 py-5 my-5 border-top">
                <div class="col">
                    <h5> <span class="fs-3 font-weight-bold pull-left" style="color: #3fa46a">gno<span>nel</span><span
                                style="color: #1b87fa">.com</span></span></h5>
                </div>
                <div class="col">
                    <h5 style="color: #1b87fa;text-decoration:underline;text-decoration-color:#3fa46a; ">Liens utiles
                    </h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="{{ route('welcome') }}" class="nav-link p-0 text-muted"><img
                                    src="{{ asset('assets/img/icone_gnonel(4).svg') }}"
                                    style="width: 32px;">Accueil</a></li>
                        <li class="nav-item mb-2"><a href="{{ route('nos_service') }}"
                                class="nav-link p-0 text-muted"><img
                                    src="{{ asset('assets/img/icone_gnonel(4).svg') }}" style="width: 32px">Nos
                                services</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"><img
                                    src="{{ asset('assets/img/icone_gnonel(4).svg') }}" style="width: 32px">Blog</a>
                        </li>
                    </ul>
                </div>

                <div class="col">
                    <h5 style="color: #1b87fa;text-decoration:underline;text-decoration-color:#3fa46a;">Contact</h5>
                    <ul class="nav flex-column">
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                                style="font-size: medium;"><img src="{{ asset('assets/img/icone_gnonel(1).svg') }}"
                                    style="width: 32px;font-size:10px">00228 90717676 Lomé (Togo)</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                                style="font-size: medium;"><img src="{{ asset('assets/img/icone_gnonel(1).svg') }}"
                                    style="width: 32px;font-size:10px"> 00225 0152487802 Abidjan (Côte d'ivoire)</a>
                        </li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                                style="font-size: medium;"><img src="{{ asset('assets/img/icone_gnonel(1).svg') }}"
                                    style="width: 32px;">00221 787135426 Dakar (Sénégal)</a></li>
                        <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"
                                style="font-size: medium;"><img src="{{ asset('assets/img/icone_gnonel(3).svg') }}"
                                    style="width: 32px">contact@gnonel.com</a></li>






                        <!-- <li class="nav-item mb-2"><a href="#" class="nav-link p-0 text-muted"><img src="{{ asset('assets/img/icone_gnonel(2).svg') }}" style="width: 32px">Lome Togo</a></li> -->
                    </ul>
                </div>

            </div>
            <div class="row">
                <div class="col">
                    <img src="{{ asset('assets/img/icone_gnonel.png') }}" style="width: 32px;height:32px"><img
                        src="{{ asset('assets/img/icone_gnonel(1).png') }}" style="width: 32px;height:32px"><img
                        src="{{ asset('assets/img/icone_gnonel(2).png') }}" style="width: 32px;height:32px">
                </div>
            </div>
            <hr style="color: #1b87fa">
            <div class="row">
                <div class="col">
                    <span style="color: #3fa46a;">{{ date('Y') }} Copyright Gnonel,Tous droits reservé</span>
                </div>
                <div class="col">
                    <span style="color: #3fa46a;">Conditions d'utilisations</span>
                </div>
                <div class="col">
                    <span style="color: #3fa46a;float: right;">Privacy policy</span>
                </div>
            </div>
        </footer>
    </div>
</body>

</html>
