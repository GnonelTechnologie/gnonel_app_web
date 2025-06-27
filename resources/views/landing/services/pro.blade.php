@extends('layouts.landing')
@section('title')
    Formules PRO
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
                                    <img class="rounded-2" src="/frontoffice/images/formules/pro.jpg" alt="">
                                </div>
                                <div class="space30"></div>
                                <p>
                                    Finies les recherches interminables sur les capacités techniques (références techniques)
                                    des soumissionnaires. Les formules PRO sont conçues pour les professionnels
                                    (Spécialistes de la Passation des Marchés) au sein des Autorités Contractantes. Grace à
                                    cette formule, vous pouvez accéder directement aux références techniques des milliers
                                    d’opérateurs économiques.
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
                                            Avec le relevé de références techniques, vous gagnez un temps considérable lors
                                            des consultations des opérateurs économiques ;
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Vous avez l’assurance sur l’authenticité des références
                                            techniques des soumissionnaires ;</div>
                                    </div>
                                </div>
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Vous disposez de meilleures informations sur les
                                            soumissionnaires ;</div>
                                    </div>
                                </div>
                                {{-- <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseFour" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingFour" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Vous pouvez consulter la totalité des publications
                                            d’appels d’offre dans plusieurs pays.</div>
                                    </div>
                                </div> --}}

                            </div>

                        </div>
                        <div class="space20"></div>

                        <article>
                            <div class="heading1">
                                <p>
                                    En version locale, vous pouvez consulter les références techniques des soumissionnaires
                                    de votre pays.
                                </p>
                                <div class="space20"></div>
                                <p>
                                    En version internationale en plus des références techniques de votre pays, vous pouvez
                                    consulter les références techniques des soumissionnaires hors de votre pays.
                                </p>
                            </div>
                        </article>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
