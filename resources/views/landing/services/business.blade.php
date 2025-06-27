@extends('layouts.landing')
@section('title')
    Formules Business
@endsection
@section('content')
    <div class="service-details-all sp">
        <div class="container">
            <div class="row">
                <div class="col-lg-4">
                    @include('partials.landing.services-sidebar')
                </div>

                <div class="col-lg-8">
                    <div class="service-details-area left-padding">
                        <article>
                            <div class="heading1">
                                <div class="image">
                                    <img class="rounded-2" src="/frontoffice/images/formules/business.jpg" alt="">
                                </div>
                                <div class="space30"></div>
                                <p>
                                    Elles sont conçues pour les opérateurs économiques qui participent aux appels à
                                    concurrence lancés par le secteur public, les grandes entreprises et les institutions, …
                                    Choisissez une de ses formules qui vous convient et vous mettrez en valeur votre
                                    véritable expérience dans l’exécution des marchés dans votre secteur d’activité.
                                </p>
                                <div class="space30"></div>
                                <h3>Avantages</h3>
                            </div>
                        </article>

                        <div class="space20"></div>

                        <div class="faq-all-area">
                            <div class="accordion accordion1 accordion-flush" id="accordionFlushExample">
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseOne" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">
                                            Les références techniques de votre entreprise sont désormais consultables au bon
                                            endroit et à tout moment par les acheteurs publics et institutionnels ;
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Renforcer votre crédibilité vis-à-vis des acheteurs
                                            publics et institutionnels ; </div>
                                    </div>
                                </div>
                                {{-- <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Vous pouvez consulter la totalité des publications des
                                            appels d’offre dans plusieurs pays ; </div>
                                    </div>
                                </div> --}}
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Augmenter la visibilité de votre entreprise à travers
                                            une communication ciblée.</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="space20"></div>

                        <article>
                            <div class="heading1">
                                <p>
                                    En version locale, vos publications de références techniques sont consultables par les
                                    acheteurs publics et institutionnels de votre pays.
                                </p>
                                <div class="space20"></div>
                                <p>
                                    En version internationale, vos publications de références techniques sont consultables
                                    par les acheteurs publics et institutionnels de votre pays et à l’international.
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
