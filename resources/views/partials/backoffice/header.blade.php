<div class="navbar-custom">
    <div class="container-fluid">
        <ul class="list-unstyled topnav-menu float-end mb-0">

            <li class="dropdown d-none d-lg-inline-block">
                <a class="nav-link dropdown-toggle arrow-none waves-effect waves-light" data-toggle="fullscreen"
                    href="#">
                    <i class="fe-maximize noti-icon"></i>
                </a>
            </li>
            <li class="dropdown notification-list topbar-dropdown">
                <a class="nav-link dropdown-toggle nav-user me-0 waves-effect waves-light" data-bs-toggle="dropdown"
                    href="#" role="button" aria-haspopup="false" aria-expanded="false">
                    <img src="{{ asset('backoffice/images/default.png') }}" alt="user-image" class="rounded-circle">
                    <span class="pro-user-name ms-1">
                        {{ Auth::user()->email }} <i class="mdi mdi-chevron-down"></i>
                    </span>
                </a>
                <div class="dropdown-menu dropdown-menu-end profile-dropdown ">
                    <!-- item-->
                    <div class="dropdown-header noti-title">
                        <h6 class="text-overflow m-0">Ravi de vous revoir</h6>
                    </div>

                    @if (Auth::user()->type_user == 0)
                    @elseif(Auth::user()->type_user == 4)
                        <!-- item-->
                        <a href="{{ route('profile') }}" class="dropdown-item notify-item">
                            <i class="fe-user"></i>
                            <span>Mon Profil</span>
                        </a>

                        <!-- item-->
                        {{-- <a href="{{ route('change-password') }}" class="dropdown-item notify-item">
                            <i class="fe-settings"></i>
                            <span>Changer de mot de passe</span>
                        </a> --}}
                    @endif

                    <div class="dropdown-divider"></div>

                    <!-- item-->
                    <a class="dropdown-item notify-item">
                        <form action="{{ route('logout') }}" method="post">
                            @csrf
                            <i class="fe-log-out"></i>
                            <button class="btn btn-link" type="submit">Déconnexion</button>
                        </form>
                    </a>

                </div>
            </li>

        </ul>

        <!-- LOGO -->
        <div class="logo-box">

            <a href="{{ route('home') }}" class="logo logo-light text-center">
                <span class="logo-sm">
                    <img src="{{ asset('backoffice/images/logo-sm.png') }}" alt="" height="30">
                </span>
                <span class="logo-lg bg-white">
                    <img src="/frontoffice/images/logo.png" class="" alt="" height="40" width="130">
                </span>
            </a>
        </div>

        <ul class="list-unstyled topnav-menu topnav-menu-left m-0">
            <li>
                <button class="button-menu-mobile waves-effect waves-light">
                    <i class="fe-menu"></i>
                </button>
            </li>

            <li>
                <!-- Mobile menu toggle (Horizontal Layout)-->
                <a class="navbar-toggle nav-link" data-bs-toggle="collapse" data-bs-target="#topnav-menu-content">
                    <div class="lines">
                        <span></span>
                        <span></span>
                        <span></span>
                    </div>
                </a>
                <!-- End mobile menu toggle-->
            </li>
        </ul>
        <div class="clearfix"></div>
    </div>
</div>
<!-- end Topbar -->
