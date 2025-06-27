<div class="header-elements">
    <div class="site-logo">
        <a href="{{ route('index') }}">
            <img src="/frontoffice/images/logo.png" alt="">
        </a>
    </div>


    <div class="main-menu-ex main-menu-ex1">
        <ul>
            <li>
                <a href="{{ route('index') }}">Accueil</a>
            </li>
            <li class="dropdown-menu-parrent"><a href="{{ route('nos_service') }}" class="main1">
                    Nos services <i class="fa-solid fa-angle-down"></i></a>
                <ul>
                    <li><a href="{{ route('service-business') }}">Formules Business</a></li>
                    <li><a href="{{ route('service-pro') }}">Formules PRO</a></li>
                    <li><a href="{{ route('service-mix') }}">Formules MIX</a></li>
                    <li><a href="{{ route('service-options') }}">Options</a></li>
                </ul>
            </li>
            <li>
                <a href="{{ route('pricing') }}">Tarifs</a>
            </li>

        </ul>
    </div>


    <div class="header2-buttons">
        <div class="button">
            @if (auth()->check())
                <a class="theme-btn12" href="{{ route('home') }}">Mon compte</a>
            @else
                <a class="theme-btn12" href="{{ route('login') }}">Se connecter</a>
            @endif
        </div>
    </div>

</div>
