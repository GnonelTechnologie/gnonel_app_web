<?php
$categories=\Illuminate\Support\Facades\ DB::table('categorieautorites')->get();
?>
<!doctype html>
<html lang="fr">

<head>
    <!-- Required meta tags -->
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
    <!-- Chargement des fichiers CSS de Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <!-- Chargement des fichiers CSS de Selectpicker -->
    <link rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/css/bootstrap-select.min.css">

    <title>Formulaire de souscription</title>
</head>

<body>
    <div class="container py-5 h-100">
        <div class="row d-flex justify-content-center align-items-center h-100">
            <div class="col-xl-10">
                <div class="card rounded-3 text-black" style="box-shadow: 0 0 15px rgba(10, 10, 10, 0.3)">
                    <div class="row g-0">
                        <div class="col-lg-6">
                            <div class="card-body p-md-5">

                                <div class="">
                                    <h4 class="mt-1 mb-3 pb-1">Formulaire de souscription</h4>
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

                                <form method="POST" action="{{ route('souscription') }}">
                                    @csrf

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">votre abonnement</label>
                                        <select class="form-control" id="abonnement" name="abonnement">
                                            <option value="0" disabled="true" selected="true">--- Sélectionner
                                                l'abonnement ---</option>
                                            @foreach ($abonnements as $abonnement)
                                                <option value="{{ $abonnement->id }}" <?php if ($offre == $abonnement->libelle) {
                                                    print ' selected';
                                                } ?>>
                                                    {{ $abonnement->libelle }}-{{ $abonnement->prix }}{{ $abonnement->monnaie }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Pays</label>
                                        <select class="form-control" name="pays" id="pays">
                                            <option value="0" disabled="true" selected="true">--- Sélectionner le
                                                pays ---</option>
                                            @foreach ($pays as $pay)
                                                <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                            @endforeach
                                        </select>
                                    </div>

                                    <div class="form-group">
                                        <label for="exampleFormControlSelect1">Vous êtes ?</label><br>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type"
                                                id="typeoperateur" value="operateur" checked>
                                            <label class="form-check-label" for="typeoperateur">Un Opérateur</label>
                                        </div>
                                        <div class="form-check form-check-inline">
                                            <input class="form-check-input" type="radio" name="type"
                                                id="typeautorite" value="autorite">
                                            <label class="form-check-label" for="typeautorite">Une autorité</label>
                                        </div>
                                    </div>

                                    <label for="exampleFormControlSelect1">Sélectionner votre structure </label>
                                    <div class="form-group" style="display: flex;">

                                        <select class="form-control" name="structure" id="structure"
                                            style="width: 89%;margin-right: 1%;">
                                            <option value="0" disabled="true" selected="true">--- Selectionner ---
                                            </option>
                                        </select>
                                        <button id="add" class="btn btn-default"
                                            style="border: 1px solid">+</button>
                                    </div>
                                    <div class="form-group">

                                        <label for="name">Nom</label>
                                        <input id="name" type="text"
                                            class="form-control @error('name') is-invalid @enderror" name="name"
                                            value="{{ old('name') }}" autocomplete="name" autofocus>
                                        @error('name')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                    <div class="form-group">

                                        <label for="prename">Prénoms</label>
                                        <input id="prename" type="text"
                                            class="form-control @error('prename') is-invalid @enderror" name="prename"
                                            value="{{ old('prename') }}" autocomplete="prename" autofocus>
                                        @error('prename')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="telephone">Téléphone</label>
                                        <input id="telephone" type="telephone"
                                            class="form-control @error('telephone') is-invalid @enderror"
                                            name="telephone" value="{{ old('telephone') }}" autocomplete="telephone">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="email">Adresse mail</label>
                                        <input id="email" type="email"
                                            class="form-control @error('email') is-invalid @enderror" name="email"
                                            value="{{ old('email') }}" autocomplete="email">

                                        @error('email')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>


                                    <div class="form-group ">
                                        <label for="password">Mot de passe</label>
                                        <input id="password" type="password"
                                            class="form-control @error('password') is-invalid @enderror"
                                            name="password" autocomplete="new-password">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>

                                    <div class="form-group">
                                        <label for="password-confirm">Confirmer le mot de passe</label>
                                        <input id="password-confirm" type="password" class="form-control"
                                            name="password_confirmation" autocomplete="new-password">

                                    </div>

                                    <button type="submit" class="btn btn-sm mt-3"
                                        style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'>Envoyer</button>
                                    <button class="btn btn-danger btn-sm mt-3" data-dismiss="modal"
                                        aria-label="Close">Annuler <span aria-hidden="true">&times;</span></button>
                                </form>

                            </div>
                        </div>
                        <div class="col-lg-6 " style='background-color: #3232cc;color:#ffffff'>
                            <br><br><br>
                            <div class="text-white px-3 py-4 p-md-5 mx-md-4">
                                <center>
                                    <h4 class="mb-4"><span
                                            class="formule">{{ \Illuminate\Support\Facades\DB::table('abonnement')->where('libelle', $offre)->first()->prix }}{{ \Illuminate\Support\Facades\DB::table('abonnement')->where('libelle', $offre)->first()->monnaie }}</span>
                                    </h4>
                                </center>
                                <center>
                                    <h4 class="mb-4"><span class="formule2">{{ $offre }}</span> </h4>
                                </center>
                                <p class="small mb-0"></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" id="myModal1">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 ml-auto">
                            <h5 class="modal-title" id="exampleModalLabel" style='color:#3232cc'>Enrégistrer
                                operateur economique</h5>
                            <hr style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'
                                data-toggle="modal" data-target=".bd-example-modal-lg">
                        </div>
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('enreg_operateur') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nom/ raison sociale</label>
                                    <input class="form-control" type="text" name="nomop" required="true"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="secteur">Secteur d'activité</label>
                                    <select class="form-control" name="secteur" required>
                                        <option value="" disabled="true" selected="true">--- Selectionner ---
                                        </option>
                                        @foreach ($secteur_activites as $secteur_activite)
                                            <option value="{{ $secteur_activite->idsecteuractivite }}">
                                                {{ $secteur_activite->libellesecteuractivite }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group" style="display: none;">
                                    <label for="exampleFormControlSelect1">Adresse email</label>
                                    <input class="form-control" name="mailop" type="email" placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pays*</label>
                                    <select class="form-control" name="paysop">
                                        <option value="0" disabled="true" selected="true">--- Sélectionner le
                                            pays ---</option>
                                        @foreach ($pays as $pay)
                                            <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Numéro RCCM</label>
                                    <input class="form-control" name="numop" type="text" required="true"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Téléphone</label>
                                    <input class="form-control" name="autreop" type="text" placeholder="">
                                </div>
                                <button type="submit" class="btn btn-sm mt-3"
                                    style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'>Envoyer</button>
                                <button class="btn btn-danger btn-sm mt-3" data-dismiss="modal"
                                    aria-label="Close">Annuler <span aria-hidden="true">&times;</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example1-modal-md" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel"
        aria-hidden="true" id="myModal2">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 ml-auto">
                            <h5 class="modal-title" id="exampleModalLabel" style='color:#3232cc'>Enrégistrer autorité
                                contratante</h5>
                            <hr style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'
                                data-toggle="modal" data-target=".bd-example-modal-lg">
                        </div>
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('enreg_autorite') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nom/ raison sociale</label>
                                    <input class="form-control" name="nomaut" type="text" required="true"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pays*</label>
                                    <select class="form-control" name="paysaut">
                                        <option value="0" disabled="true" selected="true">--- Sélectionner le
                                            pays ---</option>
                                        @foreach ($pays as $pay)
                                            <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Type*</label>
                                    <select class="form-control" name="typeaut">
                                        <option value="0" disabled="true" selected="true">--- Sélectionner le
                                            type ---</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->libelleCat }}
                                            </option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Télephone</label>
                                    <input class="form-control" name="autreaut" type="text" placeholder="">
                                </div>
                                <button type="submit" class="btn btn-sm mt-3"
                                    style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'>Envoyer</button>
                                <button class="btn btn-danger btn-sm mt-3" data-dismiss="modal"
                                    aria-label="Close">Annuler <span aria-hidden="true">&times;</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.13.1/js/bootstrap-select.min.js"></script>

    <!-- AJAX Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

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
                        jQuery.noConflict();
                        $('#myModal1').modal('show');
                    } else if (t == 'autorite') {
                        console.log('autorite')
                        jQuery.noConflict();
                        $('#myModal2').modal('show');
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
                        //console.log('success');

                        //console.log(data);

                        //op+='<option value="0" disabled="true" selected="true">--- Préselectionner le pays ---</option>';

                        for (var i = 0; i < data.length; i++) {
                            op += '<option value="' + data[i].id + '">' + data[i]
                                .raison_social + '</option>';
                        }

                        if (data.length == 0) {
                            op =
                                '<option value="0" disabled="true" selected="true">Aucune information</option>';
                        }

                        document.getElementById("structure").innerHTML = op;

                        console.log(op);


                    },
                    error: function() {
                        console.log('error');
                    }


                });
            });
        });
    </script>

</body>

</html>
