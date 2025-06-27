<div class="left-side-menu">

    <div class="h-100" data-simplebar>
        <!-- User box -->
        <div class="user-box text-center">
            <img src="{{ asset('avatars/default.png') }}" alt="user-img" title="Mat Helme" class="rounded-circle avatar-md">
            <div class="dropdown">
                <a href="javascript: void(0);" class="text-dark dropdown-toggle h5 mt-2 mb-1 d-block"
                    data-bs-toggle="dropdown">{{ Auth::user()->name }} </a>
                <div class="dropdown-menu user-pro-dropdown">

                    @if (Auth::user()->type_user == 0)
                    @elseif(Auth::user()->type_user == 4)
                        <!-- item-->
                        <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>Mon Profil</span>
                        </a>

                        <!-- item-->
                        <a href="{{ route('change-password') }}" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>Changer de mot de passe</span>
                        </a>
                    @endif
                    <!-- item-->
                    <a href="{{ route('logout') }}" class="dropdown-item notify-item">
                        <i class="fe-log-out"></i>
                        <span>Déconnexion</span>
                    </a>
                </div>
            </div>
            <p class="text-muted">
                @if (Auth::user()->type_user == 0)
                    Administrateur
                @elseif(Auth::user()->type_user == 4)
                    Membre
                @endif
            </p>
        </div>

        <!--- Sidemenu -->
        <div id="sidebar-menu">

            <ul id="side-menu">
                <li class="menu-title mt-2">Menu Principal</li>
                <li>
                    <a href="{{ route('home') }}">
                        <i data-feather="airplay"></i>
                        <span> Tableau de bord </span>
                    </a>
                </li>

                @if (Auth::user()->type_user == 0)
                    <li>
                        <a href="#sidebarOffersCall" data-bs-toggle="collapse">
                            <i data-feather="folder"></i>
                            <span> Appel d'offres </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarOffersCall">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('create_offre') }}">Enregistrer</a>
                                </li>
                                <li>
                                    <a href="{{ route('liste_offre') }}">Voir tout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#sidebarTechnicalReferences" data-bs-toggle="collapse">
                            <i data-feather="file"></i>
                            <span> Références techs </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTechnicalReferences">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('create_reference') }}">Enregistrer</a>
                                </li>
                                <li>
                                    <a href="{{ route('liste_reference') }}">Voir tout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('liste_utilisateur') }}">
                            <i data-feather="users"></i>
                            <span> Gestion des internautes </span>
                        </a>
                    </li>
                    <li>
                        <a href="#sidebarCommercial" data-bs-toggle="collapse">
                            <i data-feather="info"></i>
                            <span> Commercial </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarCommercial">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('liste_utilisateur_abonne') }}">Abonnements actifs</a>
                                </li>
                                <li>
                                    <a href="{{ url('liste_recommandation') }}">Recommandations</a>
                                </li>
                                <li>
                                    <a href="{{ route('specifications.indexAdmin') }}">Spécifications techniques</a>
                                </li>
                                <li>
                                    <a href="{{ route('getnewsletter') }}">Newsletters</a>
                                </li>
                            </ul>
                        </div>
                    </li>


                    <li class="menu-title mt-2"> Paramètres systèmes</li>
                    <li>
                        <a href="{{ route('liste_autorite') }}">
                            <i data-feather="layers"></i>
                            <span> Autorités Contractantes</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('liste_operateur') }}">
                            <i data-feather="briefcase"></i>
                            <span> Opérateurs éco</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('liste_pays') }}">
                            <i data-feather="flag"></i>
                            <span> Pays</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('viewsecteur_activite') }}">
                            <i data-feather="pocket"></i>
                            <span> Secteur d'activité</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('liste_categorie') }}">
                            <i data-feather="codesandbox"></i>
                            <span> Type de Marché</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categorieautorites.index') }}">
                            <i data-feather="align-justify"></i>
                            <span> Catégorie AC</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('modepassations.index') }}">
                            <i data-feather="corner-up-right"></i>
                            <span> Mode de passation</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('abonnements.index') }}">
                            <i data-feather="plus-circle"></i>
                            <span> Abonnements</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('categorieabonnements.index') }}">
                            <i data-feather="layers"></i>
                            <span> Categories d'abonnements</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('admins.index') }}">
                            <i data-feather="users"></i>
                            <span> Administrateurs</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('carousel.index') }}">
                            <i data-feather="image"></i>
                            <span> Carousel</span>
                        </a>
                    </li>
                @elseif(Auth::user()->type_user == 3)
                    <li>
                        <a href="#sidebarTechnicalReferences" data-bs-toggle="collapse">
                            <i data-feather="file"></i>
                            <span> Références techs </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTechnicalReferences">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('viewmesref') }}">Mes références</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="#sidebarTechnicalSpecs" data-bs-toggle="collapse">
                            <i data-feather="codesandbox"></i>
                            <span> Spécifications techs </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTechnicalSpecs">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('listspecabonne') }}">Vitrine des spécifications</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('recommanders.index') }}">
                            <i data-feather="share"></i>
                            <span> Recommander</span>
                        </a>
                    </li>
                @elseif(Auth::user()->type_user == 4 || Auth::user()->type_user == 5)
                    <?php
                    $abon = \App\User::verifabonnement(\Illuminate\Support\Facades\Auth::user());
                    if ($abon != null) {
                        $abon->mon_port;
                        $abon->oper_local;
                        $abon->oper_international;
                    }
                    ?>
                    @if ($abon != null)
                        <li>
                            <a href="#sidebarTechnicalReferences" data-bs-toggle="collapse">
                                <i data-feather="file"></i>
                                <span> Références techs </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarTechnicalReferences">
                                <ul class="nav-second-level">
                                    @if ($abon->mon_port == 1)
                                        <li>
                                            <a href="{{ route('viewmesref') }}">Mes références</a>
                                        </li>
                                    @endif
                                    @if ($abon->oper_local == 1 || $abon->oper_international == 1)
                                        <li>
                                            <a href="{{ route('selectoperateur') }}">Relevés</a>
                                        </li>
                                    @endif
                                    @if ($abon->mon_port == 1)
                                        <li>
                                            <a href="{{ url('view/viewextraitmesref') }}">Mon extrait</a>
                                        </li>
                                    @endif
                                </ul>
                            </div>
                        </li>
                    @endif
                    @if ($abon != null && $abon->base_four == 1)
                        <li>
                            <a href="#sidebarProviders" data-bs-toggle="collapse">
                                <i data-feather="folder"></i>
                                <span> Base fournisseurs </span>
                                <span class="menu-arrow"></span>
                            </a>
                            <div class="collapse" id="sidebarProviders">
                                <ul class="nav-second-level">
                                    <li>
                                        <a href="{{ route('basefournisseurs.create') }}">Créer une liste</a>
                                    </li>
                                    <li>
                                        <a href="{{ route('basefournisseurs.index') }}">Rechercher un fournisseur</a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endif
                    <li>
                        <a href="#sidebarTechnicalSpecs" data-bs-toggle="collapse">
                            <i data-feather="codesandbox"></i>
                            <span> Spécifications techs </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarTechnicalSpecs">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="{{ route('specifications.create') }}">Publier</a>
                                </li>
                                <li>
                                    <a href="{{ route('specifications.index') }}">Voir tout</a>
                                </li>
                                {{-- <li>
                                    <a onclick="$('#monetise').modal('show');" href="#">Monétiser</a>
                                </li> --}}
                                <li>
                                    <a href="{{ route('listspecabonne') }}">Vitrine des spécifications</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    @if (\Illuminate\Support\Facades\Auth::user()->pack_user_id == null)
                        <li>
                            <a href="{{ route('my-souscription') }}">
                                <i data-feather="box"></i>
                                <span> Ma souscription</span>
                            </a>
                        </li>
                    @endif
                    <li class="menu-title mt-2"> Paramètres</li>
                    <li>
                        @if (\Illuminate\Support\Facades\Auth::user()->type_user == 4)
                            <a href="{{ route('info_compte') }}">
                                <i data-feather="user"></i>
                                <span> Profil</span>
                            </a>
                        @elseif(\Illuminate\Support\Facades\Auth::user()->type_user == 5)
                            <a href="{{ route('infocompteaut') }}">
                                <i data-feather="user"></i>
                                <span> Profil</span>
                            </a>
                        @endif
                    </li>
                    <li>
                        <a href="{{ route('recommanders.index') }}">
                            <i data-feather="share"></i>
                            <span> Recommander</span>
                        </a>
                    </li>

                @endif

                {{-- @if (getAdminAuth()->level == 3)
                    <li>
                        <a href="#sidebarAdmin" data-bs-toggle="collapse">
                            <i data-feather="users"></i>
                            <span> Administrateurs </span>
                            <span class="menu-arrow"></span>
                        </a>
                        <div class="collapse" id="sidebarAdmin">
                            <ul class="nav-second-level">
                                <li>
                                    <a href="/admin/admins/add">Ajouter un administrateur</a>
                                </li>
                                <li>
                                    <a href="/admin/admins">Voir tout</a>
                                </li>
                            </ul>
                        </div>
                    </li>
                @endif --}}



                <li>
                    <a>
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <i class="fe-log-out"></i>
                            <button class="btn btn-link" type="submit">Déconnexion</button>
                        </form>
                    </a>
                </li>
            </ul>

        </div>
        <!-- End Sidebar -->

        <div class="clearfix"></div>

    </div>
    <!-- Sidebar -left -->

</div>

<div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
    aria-hidden="true" id="monetise">
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
                        <img src="{{ asset('assets/img/monetise.png') }}" style="width:150px;height: 200px;">
                        <span>Coming Soon</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
