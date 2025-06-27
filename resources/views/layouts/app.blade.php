<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="UTF-8">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, shrink-to-fit=no" name="viewport">
    <title>Gnonel - Tous les appels d'offres ici</title>

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
            <nav class="navbar navbar-expand-lg main-navbar">
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
                            <a href="#" class="dropdown-item has-icon">
                                <i class="far fa-user"></i> Profil
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
                        <a href="index.html">GNONEL</a>
                    </div>
                    <div class="sidebar-brand sidebar-brand-sm">
                        <a href="index.html">GN</a>
                    </div>
                    <ul class="sidebar-menu">
                        <li class="menu-header">DASHBOARD</li>
                        <li><a class="nav-link" href="{{ route('home') }}"><i class="fas fa-fire"></i> <span
                                    class="menusize">DASHBOARD</span></a></li>
                        <li class="menu-header">MENU</li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-th-large"></i> <span class="menusize">APPEL D’OFFRES</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('create_offre') }}"> Enregistrer un Appel
                                        d’Offre</a></li>
                                <li><a class="nav-link" href="{{ route('liste_offre') }}">Liste des appels d'offre</a>
                                </li>
                                <!-- <li><a class="nav-link" href="{{ route('liste_model') }}">Model d'appel d'offre</a></li> -->
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-th-large"></i> <span class="menusize">REFERENCES TECHNIQUES</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('create_reference') }}">Enrégistrer une
                                        reference</a></li>
                                <li><a class="nav-link" href="{{ route('liste_reference') }}">Liste des references</a>
                                </li>
                            </ul>
                        </li>
                        <li class="nav-item dropdown">
                            <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                    class="fas fa-th-large"></i> <span class="menusize">GESTION DES
                                    INTERNAUTES</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('liste_utilisateur') }}">liste des
                                        internautes</a></li>
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
                                    class="fas fa-th-large"></i> <span class="menusize">COMMERCIAL</span></a>
                            <ul class="dropdown-menu">
                                <li><a class="nav-link" href="{{ route('liste_utilisateur_abonne') }}">liste des
                                        abonnements actif</a></li>
                                <li><a class="nav-link" href="{{ url('liste_recommandation') }}">Recommandations</a>
                                </li>
                                <li><a class="nav-link"
                                        href="{{ route('specifications.indexAdmin') }}">Specifications techniques</a>
                                </li>
                                <li><a class="nav-link" href="{{ route('getnewsletter') }}">Newsletter</a></li>
                            </ul>

                    </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link has-dropdown" data-toggle="dropdown"><i
                                class="fas fa-th-large"></i> <span class="menusize">PARAMETRES SYSTEME</span></a>
                        <ul class="dropdown-menu">
                            <li><a class="nav-link" href="{{ route('liste_autorite') }}">Autorités Contractantes </a>
                            </li>
                            <li><a class="nav-link" href="{{ route('liste_operateur') }}">Opérateurs économiques</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('liste_pays') }}">Pays</a></li>
                            <li><a class="nav-link" href="{{ route('viewsecteur_activite') }}">Secteur d'activité</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('liste_categorie') }}">Type de Marché</a></li>

                            <li><a class="nav-link" href="{{ route('categorieautorites.index') }}">Catégorie AC</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('modepassations.index') }}">Mode de passation</a>
                            </li>
                            <li><a class="nav-link" href="{{ route('abonnements.index') }}">Abonnements</a></li>
                            <li><a class="nav-link" href="{{ route('categorieabonnements.index') }}">Categories
                                    d'abonnement</a></li>
                            <li><a class="nav-link" href="{{ route('admins.index') }}">Gestion des
                                    administrateurs</a></li>
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
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
        integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
        integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.nicescroll/3.7.6/jquery.nicescroll.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.24.0/moment.min.js"></script>
    <script src="{{ asset('assets/js/stisla.js') }}"></script>

    <!-- JS Libraies -->

    <!-- Template JS File -->
    <script src="{{ asset('assets/js/scripts.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>

    <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
    <script>
        $(document).ready(function() {
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
        });
    </script>
    <!-- Page Specific JS File -->
</body>

</html>
