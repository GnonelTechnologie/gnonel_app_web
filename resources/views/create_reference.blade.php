@extends('layouts.back_layout')

@section('content')
    <?php
    if (isset($reference)) {
        $categorieold = \Illuminate\Support\Facades\DB::table('categories')->where('id', '=', $reference->type_marche)->first();
        $autoriteold = \Illuminate\Support\Facades\DB::table('autoritecontractantes')->where('autoritecontractantes.id', '=', $reference->autorite_contractante)->select('autoritecontractantes.*')->first();
        $operateurold = DB::table('operateurs')->join('pays', 'pays.id', '=', 'operateurs.id_pays')->where('operateurs.id', '=', $reference->operateur)->select('operateurs.*', 'pays.nom_pays')->first();
    }
    
    ?>
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    @if (!isset($reference))
                        <div class="card">
                            <div class="card-header">
                                <h4>Formulaire d’enregistrement de réference technique</h4>
                            </div>
                            <form method="POST" action="{{ route('add_reference') }}" enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="reference">Numéro Contrat</label>
                                                <input type="text"
                                                    class="form-control @error('reference') is-invalid @enderror"
                                                    name="reference" value="{{ old('reference') }}" id="source">
                                                @error('reference')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Pays du titulaire du marche</label>
                                                <select class="form-control payst" name="payst" required id="payst">
                                                    <option value="0" disabled="true" selected="true">--- Selectionner
                                                        ---</option>
                                                    @foreach ($pays as $pay)
                                                        <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Date contrat</label>
                                                <input type="date"
                                                    class="form-control @error('date_offre') is-invalid @enderror"
                                                    name="date_contrat" value="{{ old('date_contrat') }}" id="date_contrat">
                                                @error('date_contrat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="titulaire">Titulaire du marche</label>
                                                <select class="form-control" name="titulaire" required id="titulaire">
                                                    <option value="" disabled="true" selected="true">---
                                                        Sélectionner---</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="marche">Libelle du marché</label>
                                                <input type="text"
                                                    class="form-control @error('marche') is-invalid @enderror"
                                                    name="marche" value="{{ old('marche') }}" id="marche">
                                                @error('marche')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="annee_execution">Année d'exécution</label>
                                                <select class="form-control" name="annee_execution" required>
                                                    <option value="">Sélectionnez une année</option>
                                                    @for ($year = date('Y'); $year >= 1990; $year--)
                                                        <option>{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="montant">Montant</label>
                                                        <input type="number"
                                                            class="form-control @error('montant') is-invalid @enderror"
                                                            name="montant" value="{{ old('montant') }}" id="montant"
                                                            placeholder="facultatif">
                                                        @error('montant')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Afficher</label><br>
                                                        <div class="mt-2">
                                                            <input type="radio" value="Oui" name="show_amount"> Oui
                                                            &nbsp;&nbsp;
                                                            <input type="radio" value="Non" name="show_amount" checked>
                                                            Non
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="sous_traitance">Sous traitance par</label>
                                                <input type="text"
                                                    class="form-control @error('sous_traitance') is-invalid @enderror"
                                                    name="sous_traitance" value="{{ old('sous_traitance', 'Aucun') }}"
                                                    id="sous_traitance">
                                                @error('sous_traitance')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Type de marché</label>
                                                <select class="form-control" name="type" required>
                                                    @foreach ($categories as $categorie)
                                                        <option value="{{ $categorie->id }}">
                                                            {{ $categorie->nom_categorie }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="groupement">En groupement avec</label>
                                                <input type="text"
                                                    class="form-control @error('groupement') is-invalid @enderror"
                                                    name="groupement" value="{{ old('groupement', 'Aucun') }}"
                                                    id="groupement">
                                                @error('groupement')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Pays de l’autorité Contractante</label>
                                                <select class="form-control pays" name="pays" required id="pays">
                                                    <option value="0" disabled="true" selected="true">---
                                                        Selectionner ---</option>
                                                    @foreach ($pays as $pay)
                                                        <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="compte">Consultant pour le compte de</label>
                                                <input type="text"
                                                    class="form-control @error('compte') is-invalid @enderror"
                                                    name="compte" value="{{ old('compte', 'Aucun') }}" id="compte">
                                                @error('compte')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Autorité contractante</label>
                                                <select class="form-control" name="autorite" required id="autorite">
                                                    <option value="" disabled="true" selected="true">---
                                                        Sélectionner ---</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Preuve d'exécution</label>
                                                <input type="file" class="form-control" name="preuve_execution"
                                                    id="preuve">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">Publier</button>
                                    <button class="btn btn-danger" type="reset">Annuler</button>
                                </div>
                            </form>
                        </div>
                    @else
                        <div class="card">
                            <div class="card-header">
                                <h4>modification de réference technique</h4>
                            </div>
                            <form method="POST" action="{{ route('add_update_reference', $reference->idreference) }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="card-body">

                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="reference">Numéro Contrat</label>
                                                <input type="text"
                                                    class="form-control @error('reference') is-invalid @enderror"
                                                    name="reference" value="{{ $reference->reference_marche }}"
                                                    id="source">
                                                @error('reference')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Pays du titulaire du marche</label>
                                                <select class="form-control payst" name="payst" required
                                                    id="payst">
                                                    <option value="0" disabled="true" selected="true">---
                                                        Selectionner ---</option>
                                                    @foreach ($pays as $pay)
                                                        <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Date contrat</label>
                                                <input type="date"
                                                    class="form-control @error('date_offre') is-invalid @enderror"
                                                    name="date_contrat" value="{{ $reference->date_contrat }}"
                                                    id="date_contrat">
                                                @error('date_contrat')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="titulaire">Titulaire du marche</label>
                                                <select class="form-control" name="titulaire" required id="titulaire">
                                                    <option value="{{ $reference->operateur }}" selected="true">
                                                        {{ $operateurold->raison_social }}</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="marche">Libelle du marché</label>
                                                <input type="text"
                                                    class="form-control @error('marche') is-invalid @enderror"
                                                    name="marche" value="{{ $reference->libelle_marche }}"
                                                    id="marche">
                                                @error('marche')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="annee_execution">Année d'exécution</label>
                                                <select class="form-control" name="annee_execution" required>
                                                    <option value="{{ $reference->annee_execution }}">
                                                        {{ $reference->annee_execution }}</option>
                                                    @for ($year = date('Y'); $year >= 1990; $year--)
                                                        <option>{{ $year }}</option>
                                                    @endfor
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="row">
                                                <div class="col-lg-8">
                                                    <div class="form-group">
                                                        <label for="montant">Montant</label>
                                                        <input type="number"
                                                            class="form-control @error('montant') is-invalid @enderror"
                                                            name="montant" value="{{ $reference->montant }}"
                                                            id="montant" placeholder="facultatif">
                                                        @error('montant')
                                                            <span class="invalid-feedback" role="alert">
                                                                <strong>{{ $message }}</strong>
                                                            </span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-lg-4">
                                                    <div class="form-group">
                                                        <label>Afficher</label><br>
                                                        <div class="mt-2">
                                                            <input type="radio" value="Oui" name="show_amount"
                                                                {{ $reference->show_amount == 1 ? 'checked' : '' }}>
                                                            Oui
                                                            &nbsp;&nbsp;
                                                            <input type="radio" value="Non" name="show_amount"
                                                                {{ $reference->show_amount == 0 ? 'checked' : '' }}>
                                                            Non
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="sous_traitance">Sous traitance par</label>
                                                <input type="text"
                                                    class="form-control @error('sous_traitance') is-invalid @enderror"
                                                    name="sous_traitance" value="{{ $reference->sous_traitance }}"
                                                    id="sous_traitance">
                                                @error('sous_traitance')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Type de marché</label>
                                                <select class="form-control" name="type" required>
                                                    @if ($categorieold != null)
                                                        <option value="{{ $reference->type_marche }}" selected="true">
                                                            {{ $categorieold->nom_categorie }} </option>
                                                    @else
                                                        <option value="" selected="true"> </option>
                                                    @endif

                                                    @foreach ($categories as $categorie)
                                                        @if ($reference->type_marche != $categorie->id)
                                                            <option value="{{ $categorie->id }}">
                                                                {{ $categorie->nom_categorie }}</option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="groupement">En groupement avec</label>
                                                <input type="text"
                                                    class="form-control @error('groupement') is-invalid @enderror"
                                                    name="groupement" value="{{ $reference->groupement }}"
                                                    id="groupement">
                                                @error('groupement')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Pays de l’autorité Contractante</label>
                                                <select class="form-control pays" name="pays" required id="pays">
                                                    <option value="0" disabled="true" selected="true">---
                                                        Selectionner ---</option>
                                                    @foreach ($pays as $pay)
                                                        <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label for="compte">Consultant pour le compte de</label>
                                                <input type="text"
                                                    class="form-control @error('compte') is-invalid @enderror"
                                                    name="compte" value="{{ $reference->compte }}" id="compte">
                                                @error('compte')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Autorité contractante</label>
                                                <select class="form-control" name="autorite" required id="autorite">
                                                    <option value="{{ $reference->autorite_contractante }}"
                                                        selected="true">{{ $autoriteold->raison_social }}</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col">
                                            <div class="form-group">
                                                <label>Preuve d'exécution</label>
                                                <input type="file" class="form-control" name="preuve_execution"
                                                    id="preuve">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="card-footer text-end">
                                    <button class="btn btn-primary" type="submit">Modifier</button>
                                    <button class="btn btn-danger" type="reset">Annuler</button>
                                </div>
                            </form>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </section>
    <!-- AJAX Libraries -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('change', '#pays', function() {

                var idpays = $(this).val();
                var div = $(this).parent();
                var op = " ";

                $.ajax({

                    type: 'get',
                    url: '{!! URL::to('ajaxgetautorite') !!}',
                    data: {
                        'id': idpays
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
                                '<option value="" disabled="true" selected="true">Aucune information</option>';
                        }

                        document.getElementById("autorite").innerHTML = op;


                        //console.log(op);


                    },
                    error: function() {
                        console.log('error');
                    }


                });
            });
        });

        $(document).ready(function() {

            $(document).on('change', '#payst', function() {

                var idpays = $(this).val();
                var div = $(this).parent();
                var opt = " ";

                $.ajax({

                    type: 'get',
                    url: '{!! URL::to('ajaxgetoperateur') !!}',
                    data: {
                        'id': idpays
                    },
                    dataType: 'json',
                    success: function(data) {
                        //console.log('success');

                        //console.log(data);

                        //op+='<option value="0" disabled="true" selected="true">--- Préselectionner le pays ---</option>';

                        for (var i = 0; i < data.length; i++) {
                            opt += '<option value="' + data[i].id + '">' + data[i]
                                .raison_social + '</option>';
                        }

                        if (data.length == 0) {
                            opt =
                                '<option value="" disabled="true" selected="true">Aucune information</option>';
                        }

                        document.getElementById("titulaire").innerHTML = opt;


                    },
                    error: function() {
                        console.log('error');
                    }


                });
            });
        });
    </script>

    @if (Session::has('update_ok'))
        <script>
            alert('Offre modifiée avec succès')
        </script>
    @endif
    @if (Session::has('update_no'))
        <script>
            alert('Echec de modification de l\'offre')
        </script>
    @endif
@endsection
