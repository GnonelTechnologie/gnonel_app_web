@extends('layouts.landing')
@section('title')
    Options
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
                                    <img class="rounded-2" src="/frontoffice/images/formules/options.jpg" alt="">
                                </div>
                                <div class="space30"></div>
                                <p>
                                    Il est mis à votre disposition, des options pour compléter vos fonctionnalités de base
                                    déjà intéressantes. Pour profiter de ces options vous devez être abonné à une des
                                    formules de base proposées. Il s’agit de l'option de certification et l'option d'accès à
                                    la vitrine des spécifications techniques.
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
                                            Permettre aux acteurs de la passation des marchés de retrouver rapidement des
                                            spécifications techniques déjà réalisées par d’autres acteurs et l’adapter à son
                                            cas ;
                                        </div>
                                    </div>
                                </div>
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseTwo" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">Donner la chance aux consultants et aux SPM de monétiser
                                            les spécifications techniques que ces derniers auront mis en ligne;</div>
                                    </div>
                                </div>
                                <div class="accordion-item active">
                                    <br>
                                    <div id="flush-collapseThree" class="accordion-collapse collapse show"
                                        aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
                                        <div class="accordion-body">De faciliter la rédaction des cahiers de charge à
                                            travers les spécifications techniques mises en ligne par d'autres spécialistes.
                                        </div>
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
