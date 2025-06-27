<div class="mobile-header mobile-header-main d-block d-lg-none ">
    <div class="container-fluid">
        <div class="col-12">
            <div class="mobile-header-elements">
                <div class="mobile-logo">
                    <a href="{{ route('index') }}"><img src="/frontoffice/images/logo.png" alt=""></a>
                </div>
                <div class="mobile-nav-icon">
                    <i class="fa-duotone fa-bars-staggered"></i>
                </div>
            </div>
        </div>
    </div>
</div>

<div class="mobile-sidebar d-block d-lg-none">
    <div class="logo-m">
        <a href="{{ route('index') }}"><img src="/frontoffice/images/logo.png" alt=""></a>
    </div>
    <div class="menu-close">
        <i class="fa-solid fa-xmark"></i>
    </div>
    <div class="mobile-nav">

        <ul>
            <li><a href="{{ route('index') }}">Accueil</a></li>
            <li class="as-dropdown"><a href="{{ route('nos_service') }}">
                    Nos services</a>
                <ul class="sub-menu">
                    <li><a href="{{ route('service-business') }}">Formules Business</a></li>
                    <li><a href="{{ route('service-pro') }}">Formules PRO</a></li>
                    <li><a href="{{ route('service-mix') }}">Formules MIX</a></li>
                    <li><a href="{{ route('service-options') }}">Options</a></li>
                </ul>
            </li>
            <li><a href="{{ route('pricing') }}">Tarifs</a></li>

        </ul>

        <div class="mobile-button">
            @if (auth()->check())
                <a class="theme-btn10" href="{{ route('index') }}">Mon compte <span><i
                            class="fa-solid fa-arrow-right"></i></span></a>
            @else
                <a class="theme-btn10" href="{{ route('login') }}">Se connecter <span><i
                            class="fa-solid fa-arrow-right"></i></span></a>
            @endif

        </div>

        <div class="single-footer-items">
            <h3>Contactez-nous</h3>

            <div class="contact-box">
                <div class="icon">
                    <img src="/frontoffice/img/icons/footer-icon1.png" alt="">
                </div>
                <div class="pera">
                    <a href="tel:0022890717676">00228 90717676 Lomé (Togo)</a>
                </div>
            </div>

            <div class="contact-box">
                <div class="icon">
                    <img src="/frontoffice/img/icons/footer-icon1.png" alt="">
                </div>
                <div class="pera">
                    <a href="tel:002250152487802">00225 0152487802 Abidjan (Côte d'ivoire)</a>
                </div>
            </div>

            <div class="contact-box">
                <div class="icon">
                    <img src="/frontoffice/img/icons/footer-icon1.png" alt="">
                </div>
                <div class="pera">
                    <a href="tel:00221 787135426">00221 787135426 Dakar (Sénégal)</a>
                </div>
            </div>

            <div class="contact-box">
                <div class="icon">
                    <img src="/frontoffice/img/icons/footer-icon2.png" alt="">
                </div>
                <div class="pera">
                    <a href="mailto:contact@gnonel.com">contact@gnonel.com</a>
                </div>
            </div>

        </div>

    </div>
</div>
