<div class="cta7" style="background-image: url(/frontoffice/img/bg/cta7-bg.jpg);">
    <div class="container">
        <div class="row align-items-center">
            <div class="col-lg-5">
                <div class="heading6-w">
                    <h2>Abonnez vous à notre newsletter</h2>
                    <div class="space16"></div>
                    <p>Nous vous enverrons des nouvelles et des offres exclusives.</p>
                    <div class="form-area">
                        <form action="{{ route('newsletter') }}" method="POST">
                            @csrf
                            <input type="email" placeholder="Votre adresse mail" name="email_n" required>
                            <div class="button">
                                <button class="theme-btn12" type="submit">Souscrire</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="col-md-7">
                <div class="cta-contact-area">
                    <div class="row">
                        <div class="col-lg-4"></div>
                        <div class="col-lg-6">
                            <div class="contact-box">
                                <div class="">
                                    <div class="icon">
                                        <img src="/frontoffice/img/icons/cta7-icon2.svg" alt="">
                                    </div>
                                </div>
                                <div class="heading">
                                    <h6>Envoyez-nous un message</h6>
                                    <a href="mailto:contact@gnonel.com">contact@gnonel.com</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!--=====CTA AREA END=======-->

<!--===== FOOTER AREA START =======-->

<div class="footer7 _relative">
    <div class="container">
        <div class="row">
            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-footer-items footer-logo-area">
                    <div class="footer-logo">
                        <a href="{{ route('index') }}"><img src="/frontoffice/images/logo.png" alt=""></a>
                    </div>
                    <div class="space20"></div>
                    <div class="heading1-w">
                        <p>Notre objectif est de faciliter la passation des Marchés.</p>
                    </div>
                    <ul class="social-icon">
                        <li><a target="_blank" href="https://www.linkedin.com/company/gnonel-technologies"><i
                                    class="fa-brands fa-linkedin-in"></i></a></li>
                        <li><a target="_blank" href="https://www.facebook.com/GnonelTechnologies"><i
                                    class="fa-brands fa-facebook"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-instagram"></i></a></li>
                        <li><a href="#"><i class="fa-brands fa-tiktok"></i></a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg col-md-6 col-12">
                <div class="single-footer-items">
                    <h3>Liens rapides</h3>

                    <ul class="menu-list">
                        <li><a href="{{ route('index') }}">Accueil</a></li>
                        <li><a href="{{ route('nos_service') }}">Nos services</a></li>
                        <li><a href="{{ route('pricing') }}">Tarifs </a></li>
                    </ul>
                </div>
            </div>

            <div class="col-lg col-md-6 col-12">
                <div class="single-footer-items pl-5">
                    <h3>Autres</h3>

                    <ul class="menu-list">
                        <li><a href="/cgu">Conditions d'utilisations</a></li>
                        <li><a href="/privacy-policy">Politique de confidentialité</a></li>
                    </ul>
                </div>
            </div>


            <div class="col-lg-4 col-md-6 col-12">
                <div class="single-footer-items">
                    <h3>Contactez-nous</h3>

                    <div class="contact-box">
                        <div class="icon">
                            <img src="/frontoffice/img/icons/footer6-icon1.svg" alt="">
                        </div>
                        <div class="pera">
                            <a href="tel:0022890717676">00228 90717676 Lomé (Togo)</a>
                        </div>
                    </div>

                    <div class="contact-box">
                        <div class="icon">
                            <img src="/frontoffice/img/icons/footer6-icon1.svg" alt="">
                        </div>
                        <div class="pera">
                            <a href="tel:002250152487802">00225 0152487802 Abidjan (Côte d'ivoire)</a>
                        </div>
                    </div>

                    <div class="contact-box">
                        <div class="icon">
                            <img src="/frontoffice/img/icons/footer6-icon1.svg" alt="">
                        </div>
                        <div class="pera">
                            <a href="tel:00221787135426">00221 787135426 Dakar (Sénégal)</a>
                        </div>
                    </div>

                    <div class="contact-box">
                        <div class="icon">
                            <img src="/frontoffice/img/icons/footer6-icon3.svg" alt="">
                        </div>
                        <div class="pera">
                            <a href="mailto:contact@gnonel.com">contact@gnonel.com</a>
                        </div>
                    </div>

                </div>
            </div>

        </div>

        <div class="space70"></div>
    </div>

    <div class="copyright-area _relative">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-md-12">
                    <div class="coppyright">
                        <p>© Copyright 2024 - GNONEL. Tous droits réservé</p>
                    </div>
                </div>
            </div>
        </div>

    </div>

</div>
