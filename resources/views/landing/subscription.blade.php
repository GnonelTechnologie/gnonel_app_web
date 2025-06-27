<?php
$categories=\Illuminate\Support\Facades\ DB::table('categorieautorites')->get();
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <title>Gnonel | Abonnement</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Notre objectif est de faciliter la passation des Marchés." name="description" />
    <meta content="KOF CORPORATION" name="author" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- App favicon -->
    <link rel="shortcut icon" href="{{ asset('backoffice/images/favicon.ico') }}">

    <!-- App css -->
    <link href="{{ asset('backoffice/css/config/default/bootstrap_.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('backoffice/css/config/default/app_.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <link href="{{ asset('backoffice/css/config/default/bootstrap-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-dark-stylesheet" />
    <link href="{{ asset('backoffice/css/config/default/app-dark.min.css') }}" rel="stylesheet" type="text/css"
        id="app-dark-stylesheet" />

    <link href="{{ asset('backoffice/libs/select2/css/select2.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backoffice/libs/selectize/css/selectize.bootstrap3.css') }}" rel="stylesheet"
        type="text/css" />

    <!-- icons -->
    <link href="{{ asset('backoffice/css/icons.min.css') }}" rel="stylesheet" type="text/css" />

</head>

<body class="loading authentication-bg authentication-bg-pattern">
    @if (Session::has('flash_message_error'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('flash_message_error') }}", "Merci", "error");
        </script>
    @endif
    @if (Session::has('flash_message_success'))
        <script type="text/javascript" src="{{ asset('backoffice/js/sweetalert.min.js') }}"></script>
        <script type="text/javascript">
            swal("{{ session('flash_message_success') }}", "Merci", "success");
        </script>
    @endif

    <div class="account-pages mt-5 mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-8 col-lg-8 col-xl-6">
                    <div class="card bg-pattern">

                        <div class="card-body p-4">
                            <div class="text-center w-75 m-auto">
                                <div class="auth-logo">
                                    <a href="/" class="logo logo-dark text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('backoffice/images/logo_.png') }}" alt=""
                                                height="100">
                                        </span>
                                    </a>

                                    <a href="/" class="logo logo-light text-center">
                                        <span class="logo-lg">
                                            <img src="{{ asset('backoffice/images/logo_.png') }}" alt=""
                                                height="22">
                                        </span>
                                    </a>
                                </div>
                                <h4 class="mt-0">Formulaire d'inscription</h4>
                                <p class="text-muted mb-4 mt-3">Compléter le formulaire pour finaliser votre
                                    inscription.
                                </p>
                            </div>

                            <div>
                                @if ($errors->any())
                                    <div class="alert alert-danger">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endif
                            </div>

                            <form action="{{ route('souscription') }}" method="POST">
                                {{ csrf_field() }}
                                <div id="progressbarwizard">
                                    <ul class="nav nav-pills bg-light nav-justified form-wizard-header mb-3">
                                        <li class="nav-item">
                                            <a href="#pack" onclick="accessTab(0);" data-bs-toggle="tab"
                                                data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-grid me-1"></i>
                                                <span class="d-none d-sm-inline">Formule</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#infos-pro" onclick="accessTab(1);" data-bs-toggle="tab"
                                                data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-briefcase-check me-1"></i>
                                                <span class="d-none d-sm-inline">Informations pro</span>
                                            </a>
                                        </li>
                                        <li class="nav-item">
                                            <a href="#infos-perso" onclick="accessTab(2);" data-bs-toggle="tab"
                                                data-toggle="tab" class="nav-link rounded-0 pt-2 pb-2">
                                                <i class="mdi mdi-account-circle me-1"></i>
                                                <span class="d-none d-sm-inline">Informations perso</span>
                                            </a>
                                        </li>
                                    </ul>

                                    <div class="tab-content b-0 mb-0 pt-0">

                                        <div id="bar" class="progress mb-3" style="height: 7px;">
                                            <div
                                                class="bar progress-bar progress-bar-striped progress-bar-animated bg-success">
                                            </div>
                                        </div>

                                        <div class="tab-pane" id="pack">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label" for="abonnement">Votre
                                                            abonnement*</label>
                                                        <div class="col-md-9">
                                                            <select id="abonnement" name="abonnement" required>
                                                                <option value="">Choisir...</option>
                                                                @foreach ($abonnements as $abonnement)
                                                                    <option value="{{ $abonnement->id }}"
                                                                        <?php if ($offre == $abonnement->libelle) {
                                                                            print ' selected';
                                                                        } ?>>
                                                                        {{ $abonnement->libelle }}-{{ $abonnement->prix }}{{ $abonnement->monnaie }}
                                                                    </option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label" for="count">Nombre
                                                            d'abonnements*</label>
                                                        <div class="col-md-9">
                                                            <select id="count" name="count" required>
                                                                <option value="">Choisir...</option>
                                                                @for ($abonnement = 1; $abonnement <= 20; $abonnement++)
                                                                    <option value="{{ $abonnement }}"
                                                                        <?= $abonnement == 1 ? 'selected' : '' ?>>
                                                                        {{ $abonnement }}
                                                                    </option>
                                                                @endfor
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </div>

                                        <div class="tab-pane" id="infos-pro">
                                            <div class="row">
                                                <div class="col-12">
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label"
                                                            for="pays">Pays*</label>
                                                        <div class="col-md-9">
                                                            <select id="pays" name="pays" required>
                                                                <option value="">Choisir...</option>
                                                                @foreach ($pays as $pay)
                                                                    <option value="{{ $pay->id }}">
                                                                        {{ $pay->nom_pays }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label" for="abonnement">Vous
                                                            êtes ?</label>
                                                        <div class="col-md-3">
                                                            <div class="form-check mt-1">
                                                                <input class="form-check-input" name="type"
                                                                    type="radio" id="typeoperateur"
                                                                    value="operateur" required>
                                                                <label class="form-check-label" for="typeoperateur">Un
                                                                    Opérateur</label>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-check mt-1 form-check-success">
                                                                <input class="form-check-input" name="type"
                                                                    type="radio" id="typeautorite" checked
                                                                    value="autorite" required>
                                                                <label class="form-check-label" for="typeautorite">Une
                                                                    autorité</label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <label class="col-md-3 col-form-label"
                                                            for="structure">Sélectionner votre structure*</label>
                                                        <div class="col-md-8">
                                                            <select id="structure" name="structure"
                                                                class="form-control" required>
                                                                <option value="">Rechercher...
                                                                </option>

                                                            </select>
                                                        </div>
                                                        <div class="col-md-1">
                                                            <button type="button" id="add"
                                                                class="btn btn-outline-secondary">
                                                                <i class="mdi mdi-plus-circle"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div> <!-- end col -->
                                            </div> <!-- end row -->
                                        </div>

                                        <div class="tab-pane" id="infos-perso">
                                            <div class="row">
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label" for="name">
                                                        Nom*</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="name"
                                                            class="form-control @error('name') is-invalid @enderror"
                                                            name="name" value="{{ old('name') }}"
                                                            autocomplete="name" placeholder="KOSSI" required>
                                                    </div>
                                                    @error('name')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label" for="prename">
                                                        Prénoms*</label>
                                                    <div class="col-md-9">
                                                        <input type="text" id="prename"
                                                            class="form-control @error('prename') is-invalid @enderror"
                                                            name="prename" value="{{ old('prename') }}"
                                                            autocomplete="prename" placeholder="Lionel" required>
                                                    </div>
                                                    @error('prename')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label" for="telephone">
                                                        Téléphone*</label>
                                                    <div class="col-md-9">
                                                        <input type="tel" id="telephone"
                                                            class="form-control @error('telephone') is-invalid @enderror"
                                                            name="telephone" value="{{ old('telephone') }}"
                                                            autocomplete="telephone" placeholder="Tapez votre numéro"
                                                            required>
                                                    </div>
                                                    @error('telephone')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label" for="email"> Adresse
                                                        mail*</label>
                                                    <div class="col-md-9">
                                                        <input type="email" id="email"
                                                            class="form-control @error('email') is-invalid @enderror"
                                                            name="email" value="{{ old('email') }}"
                                                            autocomplete="email" placeholder="lionel@gmail.com"
                                                            required>
                                                    </div>
                                                    @error('email')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label" for="password"> Mot de
                                                        passe*</label>
                                                    <div class="col-md-9">
                                                        <input type="password" id="password"
                                                            class="form-control @error('password') is-invalid @enderror"
                                                            name="password" autocomplete="new-password"
                                                            placeholder="***********" required>
                                                    </div>
                                                    @error('password')
                                                        <span class="invalid-feedback" role="alert">
                                                            <strong>{{ $message }}</strong>
                                                        </span>
                                                    @enderror
                                                </div>
                                                <div class="row mb-3">
                                                    <label class="col-md-3 col-form-label"
                                                        for="password_confirmation">
                                                        Confirmation*</label>
                                                    <div class="col-md-9">
                                                        <input type="password" id="password_confirmation"
                                                            name="password_confirmation" class="form-control"
                                                            placeholder="***********" autocomplete="new-password"
                                                            required>
                                                    </div>
                                                </div>

                                            </div> <!-- end col -->
                                        </div> <!-- end row -->
                                    </div>

                                    <hr>
                                    <div class="alert alert-info">
                                        Prix total : <b id="prix_total"></b>
                                    </div>
                                    <hr>

                                    <ul class="list-inline mb-0 wizard">
                                        <li class="previous list-inline-item">
                                            <a href="javascript: void(0);" onclick="previousTab();"
                                                class="btn btn-secondary px-2"><i class="mdi mdi-arrow-left-bold"></i>
                                                Précédent</a>
                                        </li>
                                        <li class="next list-inline-item float-end" onclick="nextTab();"
                                            id="next-button">
                                            <a href="javascript: void(0);" class="btn btn-primary px-4">Suivant <i
                                                    class="mdi mdi-arrow-right-bold"></i></a>
                                        </li>
                                        <li class="next list-inline-item float-end d-none" id="finish-button">
                                            <button type="submit" class="btn btn-primary px-4">Valider <i
                                                    class="mdi mdi-arrow-right-bold"></i></button>
                                        </li>
                                    </ul>

                                </div> <!-- tab-content -->

                            </form>



                        </div> <!-- end card-body -->
                    </div>
                    <!-- end card -->

                </div> <!-- end col -->
            </div>
            <!-- end row -->
        </div>
        <!-- end container -->
    </div>
    <!-- end page -->

    <div id="operator-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="operator-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <form method="POST" action="{{ route('enreg_operateur') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="standard-modalLabel">Enregistrer un opérateur economique</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="alert alert-warning">
                            <strong>Attention!</strong> En créant un opérateur économique, la page se rechargera.
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="nomop">Nom/raison sociale</label>
                                <input class="form-control" id="nomop" type="text" name="nomop"
                                    required="true" placeholder="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="modal1-sector">Secteur d'activité</label>
                                <select class="form-control" id="modal1-sector" name="secteur" required>
                                    <option value="" disabled="true" selected="true">--- Sélectionner ---
                                    </option>
                                    @foreach ($secteur_activites as $secteur_activite)
                                        <option value="{{ $secteur_activite->idsecteuractivite }}">
                                            {{ $secteur_activite->libellesecteuractivite }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group" style="display: none;">
                                <label for="exampleFormControlSelect1">Adresse email</label>
                                <input class="form-control" name="mailop" type="email" placeholder="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="modal1-pays">Pays*</label>
                                <select class="form-control" id="modal1-pays" name="paysop">
                                    <option value="" disabled="true" selected="true">--- Sélectionner ---
                                    </option>
                                    @foreach ($pays as $pay)
                                        <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="numop">Numéro RCCM</label>
                                <input class="form-control" id="numop" name="numop" type="text"
                                    required="true" placeholder="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="telephone">Téléphone</label>
                                <input class="form-control" id="telephone" name="autreop" type="text"
                                    placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>

        </div><!-- /.modal-dialog -->
    </div>

    <div id="autorite-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="operator-modalLabel"
        aria-hidden="true">
        <div class="modal-dialog">

            <form method="POST" action="{{ route('enreg_autorite') }}">
                <div class="modal-content">
                    <div class="modal-header">
                        <h4 class="modal-title" id="standard-modalLabel">Enregistrer une autorité contractante</h4>
                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                            aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        @csrf
                        <div class="alert alert-warning">
                            <strong>Attention!</strong> En créant une autorité contractante, la page se rechargera.
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="name">Nom/raison sociale</label>
                                <input class="form-control" id="name" name="nomaut" type="text"
                                    required="true" placeholder="">
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="modal2-pays">Pays*</label>
                                <select class="form-control" id="modal2-pays" name="paysaut">
                                    <option value="" disabled="true" selected="true">--- Sélectionner ---
                                    </option>
                                    @foreach ($pays as $pay)
                                        <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="modal2-type">Type*</label>
                                <select class="form-control" id="modal2-type" name="typeaut">
                                    <option value="" disabled="true" selected="true">--- Sélectionner ---
                                    </option>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->libelleCat }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="row mb-2">
                            <div class="form-group">
                                <label for="telephone">Télephone</label>
                                <input class="form-control" name="autreaut" id="telephone" type="text"
                                    placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </div><!-- /.modal-content -->
            </form>

        </div><!-- /.modal-dialog -->
    </div>


    <!-- Vendor js -->
    <script src="{{ asset('backoffice/js/vendor.min.js') }}"></script>

    <!-- App js -->
    <script src="{{ asset('backoffice/js/app.min.js') }}"></script>

    <!-- Plugins js-->
    <script src="{{ asset('backoffice/libs/twitter-bootstrap-wizard/jquery.bootstrap.wizard.min.js') }}"></script>

    <!-- Init js-->
    <script src="{{ asset('backoffice/js/pages/form-wizard.init.js') }}"></script>

    <script src="{{ asset('backoffice/libs/selectize/js/standalone/selectize.min.js') }}"></script>
    <script src="{{ asset('backoffice/libs/select2/js/select2.min.js') }}"></script>

    <script>
        var tabIndex = 0;

        function nextTab() {
            tabIndex++;
            check();
        }

        function previousTab() {
            tabIndex++;
            check();
        }

        function accessTab(i) {
            tabIndex = i;
            check();
        }

        function check() {
            var nextButton = document.getElementById("next-button");
            var finishButton = document.getElementById("finish-button");
            if (tabIndex == 2) {
                nextButton.classList.add("d-none");
                finishButton.classList.remove("d-none");
            } else {
                nextButton.classList.remove("d-none");
                finishButton.classList.add("d-none");
            }

        }

        $(document).ready(function() {
            $("#abonnement").selectize({});
            $("#count").selectize({});
            $("#pays").selectize({});
            //$("#structure").selectize({});
            $("#modal1-sector").selectize({});
            $("#modal1-pays").selectize({});
            $("#modal2-pays").selectize({});
            $("#modal2-type").selectize({});

            let abonnement = $("#abonnement option:selected").text();
            abonnement.trim();
            let abonnementPrice = abonnement.split('-')[1];
            $("#prix_total").text(abonnementPrice);


            $("#count").on('change', function() {
                let count = $("#count option:selected").val();
                let abonnement = $("#abonnement option:selected").text();
                abonnement.trim();
                let abonnementPrice = abonnement.split('-')[1].split('FCFA')[0];

                let totalPrice = count * abonnementPrice;

                $("#prix_total").text(totalPrice + ' FCFA');
            })

            function ajaxform() {
                var formule = $("#abonnement option:selected").val();
                $.ajax({

                    type: 'get',
                    url: '{!! URL::to('ajaxbonnement') !!}/' + formule,
                    dataType: 'json',
                    success: function(data) {
                        if (data.choixop === 1) {
                            console.log(data.choixop)
                            $("#typeoperateur").prop("checked", true);
                        } else if (data.choixaut === 1) {
                            console.log(data.choixaut)
                            $("#typeautorite").prop("checked", true);

                        }

                        console.log(data)

                    },
                    error: function() {
                        console.log('error');
                    }


                });
            }
            ajaxform();

            $("#abonnement").on('change', function() {
                $('.formule').text('')
                $('.formule2').text('')
                $('.formule').text($("#abonnement option:selected").text());


                ajaxform();
            })

            $('#add').click(
                function(event) {
                    event.preventDefault();
                    var t = document.querySelector('input[name="type"]:checked').value;

                    if (t == 'operateur') {
                        console.log('operateur')

                        $('#operator-modal').modal('show');
                    } else if (t == 'autorite') {
                        console.log('autorite')

                        $('#autorite-modal').modal('show');
                    }
                }
            );

            $(document).on('change', '#pays, #typeautorite, #typeoperateur', function() {

                // var idpays=$(this).val();
                var idpays = document.getElementById("pays").value;
                var type = document.querySelector('input[name="type"]:checked').value;
                var div = $(this).parent();
                var op = " ";


                $.ajax({
                    type: 'get',
                    url: '{!! URL::to('ajaxgetoperateur_autorite') !!}',
                    data: {
                        'id': idpays,
                        'type': type
                    },
                    dataType: 'json',
                    success: function(data) {
                        // console.log('success');

                        //console.log(data);

                        //op+='<option value="0" disabled="true" selected="true">--- Préselectionner le pays ---</option>';

                        if (data.length > 0) {
                            op +=
                                '<option value="0" disabled="true" selected="true">--- Rechercher ---</option>';
                        }
                        for (var i = 0; i < data.length; i++) {
                            op += '<option value="' + data[i].id + '">' + data[i]
                                .raison_social + '</option>';
                        }

                        if (data.length == 0) {
                            op =
                                '<option value="0" disabled="true" selected="true">Aucune information</option>';
                        }

                        document.getElementById("structure").innerHTML = op;


                        $("#structure").selectize({});


                    },
                    error: function() {
                        console.log('error');
                    }


                });
            });
        })
    </script>

</body>

</html>
