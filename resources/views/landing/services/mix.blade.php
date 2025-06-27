@extends('layouts.landing')
@section('title')
    Formules MIX
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
                                    <img class="rounded-2" src="/frontoffice/images/formules/mix.jpg" alt="">
                                </div>
                                <div class="space30"></div>
                                <p>
                                    Elles sont disponibles en version locale et internationale. Formules idéales pour les
                                    grandes entreprises qui participent aux appels à concurrence en tant que soumissionnaire
                                    mais également procèdent aux appels à concurrence pour leurs propres acquisitions.
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
                                            Consulter directement et en toute sérénité, les références techniques des
                                            soumissionnaires locaux comme internationaux ;
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Gagner du temps lors des travaux de consultation et
                                            d’analyse des offres ;</div>
                                    </div>
                                </div>
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Valoriser vos expériences acquises dans l’exécution des
                                            marchés ;</div>
                                    </div>
                                </div>
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Augmenter votre crédibilité vis-à-vis des autorités
                                            contractantes ; </div>
                                    </div>
                                </div>
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseFive" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingFive" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Accroitre la visibilité de la société.</div>
                                    </div>
                                </div>

                            </div>

                        </div>
                        <div class="space20"></div>

                        <article>
                            <div class="heading1">
                                <p>
                                    En version locale, vos publications de références techniques sont consultables par les
                                    autorités contractantes de votre pays et en retour vous pourrez consulter les
                                    publications de références techniques des opérateurs économiques de votre pays.
                                </p>
                                <div class="space20"></div>
                                <p>
                                    En version internationale, vos publications de références techniques seront visibles par
                                    les autorités contractantes de votre pays et hors de votre pays. Vous accéderez en
                                    retour aux références techniques des opérateurs économiques de votre pays et hors de
                                    votre pays.
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
