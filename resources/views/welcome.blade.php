@extends('layouts.appwelcom')
@section('titre')
    Gnonel
@endsection
@section('content')
    <style>
        .tof {
            text-align: center;
            background-color: #cce196;
            height: 200px;
            width: auto;
            overflow: hidden;
        }

        @media (min-width: 1280px) {
            .img1 {
                height: 400px;
                width: 1000px
            }
        }

        @media (min-width: 300px) {
            #visibilite {
                font-size: 15px;
                margin-top: 20px;
            }

            .img1 {
                height: 200px;
                width: 500px
            }
        }

        @media (min-width: 400px) {
            #newsletter {
                font-size: 15px;
                margin-top: 20px;
            }

            .img1 {
                height: 200px;
                width: 500px
            }
        }

        @media (min-width: 600px) {
            #newsletter {
                font-size: 15px;
                margin-top: 20px;
            }

            .img1 {
                height: 200px;
                width: 500px
            }
        }

        @media (min-width: 900px) {

            .img1 {
                height: 200px;
                width: 500px
            }
        }

        @media (min-width: 1020px) {
            .img1 {
                height: 400px;
                width: 1000px
            }
        }

        @media (min-width: 1366px) {
            .img1 {
                height: 400px;
                width: 1000px
            }
        }

        @media (min-width: 1600px) {
            .img1 {
                height: 400px;
                width: 1000px
            }
        }

        .a {
            color: white;
        }

        .a:hover {
            color: white;
        }
    </style>
    <div class="container">
        <!-- Heading Row-->
        <div class="row">
            <div class="col-lg-6 col-md-6" id="top">
                <H1 style="color: #3fa46a;">Bienvenue sur gnonel.com, la solution technologique la plus complète au service
                    des </H1>
                <H1 style="color: #1b87fa;">acteurs de la Passation des Marchés.</H1>
                <br>
                <span>Rejoignez les milliers d’acteurs (Opérateurs économiques, les spécialistes en passation des Marchés,
                    experts domaines,…) et vivez une expérience professionnelle incroyable.</span>
                <form method="GET" action="{{ route('rechercheoffre') }}">
                    <input type="hidden" value="1" name="pays">
                    <!--<button class="p-2 text-white btn btn-primary py-1" type="submit" style="border: 0.0001px SOLID;width: 120PX;margin-right:10%;margin-bottom: 10px; ">Appels d’offres</button> -->
                    <a href="{{ url('listspec') }}">
                        <button class="p-2 text-white btn btn-primary py-2" type="button"
                            style="border: 0.0001px SOLID;width: 195PX;margin-bottom: 10px;">Spécifications
                            techniques</button>
                    </a>
                </form>
            </div>
            <!--<div class="col-lg-6 col-md-6  shadow-sm p-3"  style="border:solid 1px;border-radius:5px;box-shadow: 5px;border-color:#3fa46a;height:400px;background-image:url('{{ asset('assets/img/Design_sans_titre_(33).png') }}');background-size: cover; ">
                
                </div>-->
            <div class="col-lg-6"
                style="height:400px;border:solid 1px;border-radius:5px;box-shadow: 5px;border-color:#3fa46a;padding: inherit;">
                <div id="carouselExampleControlsNoTouching" class="carousel slide" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="{{ asset('assets/img/slide1.jpg') }}" style="height:400px;" class="d-block w-100"
                                alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/slide2.jpg') }}" style="height:400px;" class="d-block w-100"
                                alt="...">
                        </div>
                        <!-- <div class="carousel-item">
                              <img src="{{ asset('assets/img/slide3.jpg') }}"  style="height:400px;" class="d-block w-100" alt="...">
                          </div> -->
                        <div class="carousel-item">
                            <img src="{{ asset('assets/img/slide4.jpg') }}" style="height:400px;" class="d-block w-100"
                                alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                        data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleControlsNoTouching"
                        data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <br><br>
    <div style="width: 100%;height: 350px;border-bottom: solid 4px;border-color:#3fa46a;border-bottom-left-radius:250px;padding-top:120px;padding-left:50px;padding-right: :50px;"
        class="bg-primary">
        <center>
            <div style="width: 80%;height:auto;background-color: whitesmoke">
                <h1 style="color: #1b87fa;font-size: 40PX;" id="visibilite">
                    <span style="color: #3fa46a;float: left;">
                        << /span>
                            Offrez vous plus de visibilité<span style="color: #3fa46a;float: right;">></span>
                </h1>
            </div>
        </center>
    </div>
    <br><br>

    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-md-6 col-sm-12 shadow-sm p-3"
                style="height:500px;background-image:url('{{ asset('assets/img/Gnonel_image.svg') }}');background-size: cover; ">

            </div>
            <div class="col-lg-6 col-md-6 col-sm-12">
                <!--<h1 style="color: #1b87fa;font-size: 40PX;">Operateurs</h1>
                <h1 style="color: #1b87fa;font-size: 40PX;">économique,</h1><h1 style="color: #3fa46a;font-size: 50PX;">Autorités</h1>-->
                <h1 style="color: #3fa46a;font-size: 40PX;">Operateurs économiques, Spécialistes en Passation de Marchés,
                    experts domaines</h1>
                <!-- <h1 style="color: #3fa46a;font-size: 40PX;">L'UEMOA</h1> -->
                <p>
                    gnonel.com met à votre disposition de nombreux services et options technologiques qui facilitent votre
                    quotidien sur le plan professionnel. Rejoignez-nous et profitez de nombreuses opportunités…
                </p>
                <button class="p-2 text-white btn btn-primary py-1" type="submit"
                    style="border: 0.0001px SOLID;width: 120PX; "><a href="{{ route('nos_service') }}" class="a"
                        style="font-size: 16px;">En savoir plus</a></button>
            </div>
        </div>
    </div>
    <br><br>
    <div class="container">
        <div class="row">
            <center><span style="color: #3fa46a;">Choisissez votre plan</span></center>
            <center>
                <h1 style="color: #1b87fa;" id="avant">Profitez de nombreux avantages</h1>
            </center>
            <br><br>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card h-100">
                    <a target="_blank" href="#">
                        <div class="tof"><img class="card-img-top" src="{{ asset('assets/img/Gnonel_image(1).png') }}"
                                alt=""></div>
                    </a>
                    <div class="modal fade" id="infos2">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <span style="color: #3fa46a;">Les Formules <span
                                style="font-size: 30px;color: #1b87fa;">Business</span></span>

                        <p class="card-text" style="font-size: 13px"> Elles sont conçues pour les opérateurs économiques
                            qui participent aux appels à concurrence lancés par le secteur public, les grandes entreprises
                            et les institutions,…</p>

                        <center> <small class="text-muted"><button class="p-2 text-white btn btn-primary py-1"
                                    type="submit" style="border: 0.0001px SOLID;width: 170PX; "><a
                                        href="{{ route('nos_service') }}#business" class="a">En savoir plus
                                        ></a></button></small></center>
                    </div>
                </div>
            </div>
            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card h-100">
                    <a target="_blank" href="#">
                        <div class="tof"><img class="card-img-top"
                                src="{{ asset('assets/img/Gnonel_image(2).png') }}" alt=""></div>
                    </a>
                    <div class="modal fade" id="infos2">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <span style="color: #3fa46a;">Les formules <span
                                style="font-size: 30px;color: #1b87fa;">Pro</span></span>

                        <p class="card-text" style="font-size: 13px">Les formules PRO sont conçues pour les professionnels
                            (Spécialistes de la Passation des Marchés)
                        </p>
                        <center>
                            <small class="text-muted"><button class="p-2 text-white btn btn-primary py-1" type="submit"
                                    style="border: 0.0001px SOLID;width: 170PX; "><a
                                        href="{{ route('nos_service') }}#Pro" class="a">En savoir plus
                                        ></a></button></small>
                        </center>
                    </div>
                </div>
            </div>


            <div class="col-lg-4 col-md-4 mb-4">
                <div class="card h-100">
                    <a target="_blank" href="#">
                        <div class="tof"><img class="card-img-top"
                                src="{{ asset('assets/img/Gnonel_image(3).png') }}" alt=""></div>
                    </a>
                    <div class="modal fade" id="infos2">
                        <div class="modal-dialog">
                            <div class="modal-content"></div>
                        </div>
                    </div>
                    <div class="card-body">
                        <span style="color: #3fa46a;">Les formules <span
                                style="font-size: 30px;color: #1b87fa;">MIX</span></span>

                        <p class="card-text" style="font-size: 13px">Conçue à l'attention des entreprises qui participent
                            aux appels à concurrence en tant que soumissionnaire mais également lancent des appels d'offre
                            pour leurs propres acquisitions</p>

                        <center> <small class="text-muted"><button class="p-2 text-white btn btn-primary py-1"
                                    type="submit" style="border: 0.0001px SOLID;width: 170PX; "><a
                                        href="{{ route('nos_service') }}#Premium" class="a">En savoir plus
                                        ></a></button></small></center>
                    </div>
                </div>

            </div>
        </div>
    </div>
    <br><br><br><br>
    <div style="width: 100%;height: 200px;border-top: 4px solid;border-color:#3fa46a;border-top-right-radius:150px; "
        class="bg-primary">
        <center>
            <h1 style="color: white;margin-bottom: 15px" id="newsletter">Abonnez vous à notre newsletter</h1>
        </center>
        <center>
            <div class="input-group mb-3" style="width:50%">
                <input type="email" class="form-control" placeholder="Veuillez remplir votre e-mail" id="email_n"
                    name="">
                <div class="input-group-append">
                    <button class="btn btn-success" onclick="addnewletter()">S'abonner</button>
                </div>
            </div>

        </center>

    </div>
@endsection
@section('script')
    <script>
        function addnewletter() {
            var email = $('#email_n').val();
            if (email !== '') {
                $.ajax({
                    type: 'post',
                    data: {
                        email_n: email,
                        _token: "{{ csrf_token() }}"
                    },
                    url: "{{ url('newsletter') }}",
                    success: function(response) {
                        alert(response.message);
                        $('#email_n').val('')
                    }

                })
            } else {
                alert("Veuillez renseigner votre adresse electronique");
            }

        }
    </script>
@endsection
