@extends('layouts.landing')
@section('title')
    Contactez-nous
@endsection
@section('content')
    <div class="contact-page sp">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6">
                    <div class="heading1">
                        <span class="span">Contactez-nous</span>
                        <h2>Nous sommes toujours disponibles pour vous aider.</h2>
                        <div class="space16"></div>
                        <p>Avez-vous une question ? Voulez-vous augmenter votre visibilité à travers notre plateforme?
                            N’hesitez pas de nous contacter.</p>
                    </div>

                    <div class="contact-page-box">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="contact-box">
                                    <div class="icon">
                                        <img src="/frontoffice/img/icons/contact-icon1.png" alt="">
                                    </div>
                                    <div class="heading1">
                                        <p>Appelez-nous</p>
                                        <h4><a href="tel:22890717676">00228 90717676</a></h4>
                                        <h4><a href="tel:2250152487802">00225 0152487802</a></h4>
                                        <h4><a href="tel:221787135426">00221 787135426</a></h4>
                                    </div>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="contact-box contact-box2">
                                    <div class="icon">
                                        <img src="/frontoffice/img/icons/contact-icon2.png" alt="">
                                    </div>
                                    <div class="heading1">
                                        <p>Écrivez-nous un mail</p>
                                        <h4><a href="mailto:contact@gnonel.com">contact@gnonel.com</a></h4>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                </div>

                <div class="col-lg-6">
                    <div class="contact1-form">
                        <div class="heading1">
                            <h3>Écrivez-nous</h3>
                            <div class="space16"></div>
                            <p>Remplissez le formulaire ci-dessous pour nous contacter.</p>
                        </div>
                        <div class="space10"></div>

                        <form action="#">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="text" placeholder="Nom">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="text" placeholder="Prénoms">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="email" placeholder="Adresse mail">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="single-input">
                                        <input type="number" placeholder="Téléphone">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="single-input">
                                        <input type="text" placeholder="Objet">
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="single-input">
                                        <textarea rows="4" placeholder="Message"></textarea>
                                    </div>
                                </div>

                                <div class="col-md-12">
                                    <div class="button">
                                        <button class="theme-btn1">Envoyer maintenant <span><i
                                                    class="fa-solid fa-arrow-right"></i></span></button>
                                    </div>
                                </div>

                            </div>
                        </form>
                    </div>
                </div>

            </div>
        </div>
    </div>
@endsection
