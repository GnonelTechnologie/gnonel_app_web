<?php
$abon = \App\User::verifabonnement(\Illuminate\Support\Facades\Auth::user());
if ($abon != null) {
    $abon->mon_port;
    $abon->oper_local;
    $abon->oper_international;
}

?>
<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Gnonel</title>
    <link rel="icon" type="image/x-icon" href="{{ asset('assets/img/logo.png') }}" />
    <!-- General CSS Files -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css"
        integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css"
        integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
    <!-- Template CSS -->
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/components.css') }}">


    <!--DATATABLE-->
</head>

<body class="">
    <style type="text/css">
        .menusize {
            font-size: 12px;
        }
    </style>
    <div id="app">
        <div class="main-wrapper">
            <div class="navbar-bg"></div>
            <nav class="navbar navbar-expand-lg main-navbar bg-primary">
                <form class="form-inline mr-auto">
                    <ul class="navbar-nav mr-3">
                        <li><a href="#" data-toggle="sidebar" class="nav-link nav-link-lg"><i
                                    class="fas fa-bars"></i></a></li>
                        <li><a href="#" data-toggle="search" class="nav-link nav-link-lg d-sm-none"><i
                                    class="fas fa-search"></i></a></li>
                    </ul>
                </form>
                <ul class="navbar-nav navbar-right">
                    <li class="dropdown"><a href="#" data-toggle="dropdown"
                            class="nav-link dropdown-toggle nav-link-lg nav-link-user">
                            <img alt="image" src="{{ asset('assets/img/user.png') }}" class="rounded-circle mr-1">
                            <div class="d-sm-none d-lg-inline-block">{{ Auth::user()->name }}</div>
                        </a>
                        <div class="dropdown-menu dropdown-menu-right">
                            @if (\Illuminate\Support\Facades\Auth::user()->type_user == 4)
                                <a href="{{ route('info_compte') }}" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profil
                                </a>
                            @elseif(\Illuminate\Support\Facades\Auth::user()->type_user == 5)
                                <a href="{{ route('infocompteaut') }}" class="dropdown-item has-icon">
                                    <i class="far fa-user"></i> Profil
                                </a>
                            @endif

                            <a href="{{ route('modifpass') }}" class="dropdown-item has-icon">
                                <i class="far fa-user"></i>Modifier mot de passe
                            </a>
                            <div class="dropdown-divider"></div>

                            <a class="dropdown-item has-icon text-danger" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                  document.getElementById('logout-form').submit();">
                                <i class="fas fa-sign-out-alt"></i> Déconnexion
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>

                        </div>
                    </li>
                </ul>
            </nav>
            <div class="main-sidebar">
                <aside id="sidebar-wrapper">
                    <div class="sidebar-brand">
                        <a href="{{ route('home') }}"><span class="fs-3 font-weight-bold pull-left"
                                style="color: #3fa46a">gno<span>nel</span><span
                                    style="color: #1b87fa">.com</span></span></a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">GN</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">DASHBOARD</li>
                        <li><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-fire"></i> <span
                                    class="menusize">ACCUEIL</span></a></li>
                        <li class="menu-header">MENU</li>
                        <!--<li><a class="nav-link" href="{{ route('recherche') }}?pays=1"><i class="fas fa-th-large"></i> <span class="menusize">APPELS D’OFFRES</span></a></li> -->
                        @if ($abon != null)
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                        class="fas fa-th-large"></i> <span class="menusize">REFERENCES
                                        TECHNIQUES</span></a>
                                <ul class="dropdown-menu">
                                    @if ($abon->mon_port == 1)
                                        <li><a class="nav-link" href="{{ route('viewmesref') }}">Mes références
                                                tech</a>
                                        </li>
                                    @endif
                                    @if ($abon->oper_local == 1 || $abon->oper_international == 1)
                                        <li><a class="nav-link" href="{{ route('selectoperateur') }}">Relevés de
                                                références</a></li>
                                    @endif
                                    @if ($abon->mon_port == 1)
                                        <li><a class="nav-link" href="{{ url('view/viewextraitmesref') }}">Mon extrait
                                                de
                                                références</a></li>
                                    @endif
                                </ul>
                            </li>
                        @endif
                        @if ($abon != null && $abon->base_four == 1)
                            <li class="nav-item dropdown">
                                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                        class="fas fa-th-large"></i> <span class="menusize">BASE
                                        FOURNISSEURS</span></a>
                                <ul class="dropdown-menu">
                                    <li><a class="nav-link"
                                            href="{{ route('basefournisseurs.create') }}">Création</a></li>
                                    <li><a class="nav-link"
                                            href="{{ route('basefournisseurs.index') }}">Recherche</a></li>
                                </ul>
                            </li>
                        @endif
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-th-large"></i> <span class="menusize">SPECIFICATIONS TECH</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('specifications.create') }}">Publier une
                                        spécification</a></li>
                                <li><a class="nav-link" href="{{ route('specifications.index') }}">Liste de mes
                                        publications</a></li>
                                <li><a class="nav-link" href="#"
                                        onclick=" $('#monetise').modal('show');">Monétiser</a></li>
                                <li><a class="nav-link" href="{{ route('listspecabonne') }}">Vitrine des
                                        publications</a></li>
                            </ul>
                        </li>
                        <!-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="far fa-square"></i> <span>Autorité contractante</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('liste_autorite') }}">Autorités Contractantes </a></li>
                  <li><a class="nav-link" href="{{ route('create_bon') }}">Bon commande</a></li>
                </ul>
              </li> -->
                        <!-- <li class="nav-item dropdown">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i class="fas fa-map-marker-alt"></i> <span>Opérateur économique</span></a>
                <ul class="dropdown-menu">
                  <li><a class="nav-link" href="{{ route('liste_operateur') }}">Opérateur économique</a></li>
                </ul>
              </li> -->
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-th-large"></i> <span class="menusize">PARAMETRES</span></a>
                            <ul class="dropdown-menu">
                                @if (\Illuminate\Support\Facades\Auth::user()->type_user == 4)
                                    <li><a class="nav-link" href="{{ route('info_compte') }}">Profil</a></li>
                                @elseif(\Illuminate\Support\Facades\Auth::user()->type_user == 5)
                                    <li><a class="nav-link" href="{{ route('infocompteaut') }}">Profil</a></li>
                                @endif
                                <li><a class="nav-link" href="{{ route('recommanders.index') }}">Recommander</a></li>
                                <!--  <li><a class="nav-link" href="{{ route('liste_reference') }}">Références</a></li> -->
                            </ul>
                        </li>
                    </ul>

                    <div class="mt-4 mb-4 p-3 hide-sidebar-mini">
                        <!-- <a href="https://getstisla.com/docs" class="btn btn-primary btn-lg btn-block btn-icon-split">
                <i class="fas fa-rocket"></i> Documentation
              </a> -->
                    </div>
                </aside>
            </div>

            <!-- Main Content -->
            <div class="main-content">
                <!-- Contenu de l'application -->
                <main class="py-4">
                    @yield('content')
                </main>
                <!-- Contenu de l'application -->
            </div>

            <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog"
                aria-labelledby="myLargeModalLabel" aria-hidden="true" id="monetise">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-md-12 ml-auto">
                                    <h5 class="modal-title" id="exampleModalLabel" style='color:#3232cc'>Information
                                    </h5>
                                    <hr style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'
                                        data-toggle="modal" data-target=".bd-example-modal-lg">
                                </div>
                                <div class="col-md-12">
                                    <img src="{{ asset('assets/img/monetise.png') }}"
                                        style="width:150px;height: 200px;">
                                    <span>Coming Soon</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <footer class="main-footer">
                <div class="footer-left">
                    <!-- Copyright &copy; 2018 <div class="bullet"></div> Design By <a href="https://nauval.in/">Muhamad Nauval Azhar</a> -->
                </div>
                <div class="footer-right">
                    2.3.0
                </div>
            </footer>
        </div>
    </div>
    <!-- General JS Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.min.js"
        integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jspdf/2.4.0/jspdf.umd.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="{{ asset('assets/js/plugins/moment.min.js') }}"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    @yield('script')
    <script>
        $(document).ready(function() {
            $('#example').DataTable({
                stateSave: true,
                "bDestroy": true,
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
        });
    </script>
    <!-- Page Specific JS File -->
</body>

</html>
