@extends('layouts.landing')
@section('title')
    Nos services
@endsection
@section('content')
    <div class="service1 service-page-service sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-3 col-md-6">
                    <div class="service1-box">
                        <div class="image overlay-anim">
                            <img src="/frontoffice/images/formules/business.png" alt="">
                        </div>
                        <div class="hover-area">
                            <div class="icon">
                                <img src="assets/img/icons/service1-icon1.png" alt="">
                            </div>
                            <div class="space16"></div>
                            <div class="heading1-w">
                                <h4><a href="{{ route('service-business') }}">Formules Business</a></h4>
                                <div class="space16"></div>
                                <p>
                                    Spécialement conçues pour les opérateurs économiques qui souhaitent soumissionner aux
                                    appels à concurrence.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="service1-box">
                        <div class="image overlay-anim">
                            <img src="/frontoffice/images/formules/pro.png" alt="">
                        </div>
                        <div class="hover-area">
                            <div class="icon">
                                <img src="assets/img/icons/service1-icon2.png" alt="">
                            </div>
                            <div class="space16"></div>
                            <div class="heading1-w">
                                <h4><a href="{{ route('service-pro') }}">Formules PRO</a></h4>
                                <div class="space16"></div>
                                <p>
                                    Les formules PRO sont conçues pour les professionnels (Spécialistes de la Passation des
                                    Marchés).
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-lg-3 col-md-6">
                    <div class="service1-box">
                        <div class="image overlay-anim">
                            <img src="/frontoffice/images/formules/mix.png" alt="">
                        </div>
                        <div class="hover-area">
                            <div class="icon">
                                <img src="assets/img/icons/service1-icon3.png" alt="">
                            </div>
                            <div class="space16"></div>
                            <div class="heading1-w">
                                <h4><a href="{{ route('service-mix') }}">Formules MIX</a></h4>
                                <div class="space16"></div>
                                <p>
                                    Formules idéales pour les grandes entreprises. Elles combinent les avantages des
                                    formules business et ceux des formules PRO.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-lg-3 col-md-6">
                    <div class="service1-box">
                        <div class="image overlay-anim">
                            <img src="/frontoffice/images/formules/options.png" alt="">
                        </div>
                        <div class="hover-area">
                            <div class="icon">
                                <img src="assets/img/icons/service1-icon4.png" alt="">
                            </div>
                            <div class="space16"></div>
                            <div class="heading1-w">
                                <h4><a href="{{ route('service-options') }}">Options</a></h4>
                                <div class="space16"></div>
                                <p>
                                    Gnonel vous offre des options pour compléter votre offre de base « déjà intéressante.»
                                </p>
                            </div>
                        </div>
                    </div>
                </div>


            </div>

        </div>
    </div>
@endsection
