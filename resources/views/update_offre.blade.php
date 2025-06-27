@extends('layouts.back_layout')
@section('content')
    <?php
    $paysold = \Illuminate\Support\Facades\DB::table('pays')
        ->where('id', $updates[0]->id_pays)
        ->first();
    $categorieold = \Illuminate\Support\Facades\DB::table('categories')
        ->where('id', $updates[0]->id_categorie)
        ->first();
    $modeold = \Illuminate\Support\Facades\DB::table('modes')
        ->where('id', $updates[0]->mode_id)
        ->first();
    $autoriteold = \Illuminate\Support\Facades\DB::table('autoritecontractantes')
        ->where('autoritecontractantes.id', $updates[0]->id_autorite)
        ->select('autoritecontractantes.*')
        ->first();
    $secteurold = \Illuminate\Support\Facades\DB::table('secteuractivite')
        ->where('idsecteuractivite', $updates[0]->idsecteuractivite)
        ->first();
    ?>

    <section class="section">
        <div class="section-body">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4>Modification d'appel d'offre</h4>
                    </div>
                    <form method="POST" action="{{ route('add_update_offre', $updates[0]->id) }}">
                        @csrf
                        <div class="card-body">
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="reference">Numéro Appel d’offre</label>
                                        <input type="text" class="form-control @error('reference') is-invalid @enderror"
                                            name="reference" value="{{ $updates[0]->reference }}" id="source">
                                        @error('reference')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date_publication">Secteur d'activité</label>
                                        <select class="form-control" name="secteur" required>
                                            @if ($secteurold != null)
                                                <option value="{{ $updates[0]->idsecteuractivite }}" selected="true">
                                                    {{ $secteurold->libellesecteuractivite }} </option>
                                            @else
                                                <option value="" selected="true"> </option>
                                            @endif

                                            @foreach ($secteur_activites as $secteur_activite)
                                                @if ($updates[0]->idsecteuractivite != $secteur_activite->idsecteuractivite)
                                                    <option value="{{ $secteur_activite->idsecteuractivite }}">
                                                        {{ $secteur_activite->libellesecteuractivite }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="libelle">libelle de l'appel d'offre</label>
                                        <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                                            name="libelle" value="{{ $updates[0]->libelle_appel }}" id="libelle">
                                        @error('libelle')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">

                                        <label for="date_publication">Date de publication <?php $datep = new DateTime($updates[0]->date_publication); ?></label>

                                        <input type="date"
                                            class="form-control @error('date_publication') is-invalid @enderror"
                                            name="date_publication" value="{{ $datep->format('Y-m-d') }}"
                                            id="date_publication">

                                        @error('date_publication')
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
                                        <label>Pays de l’annonceur</label>
                                        <select class="form-control pays" name="pays" required id="pays">
                                            <option value="0" disabled="true" selected="true">--- Selectionner ---
                                            </option>

                                            @foreach ($pays as $pay)
                                                <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date_cloture">Date de Clôture</label>
                                        <input type="datetime-local"
                                            class="form-control @error('date_cloture') is-invalid @enderror"
                                            name="date_cloture" value="{{ $updates[0]->date_cloture }}" id="date_cloture">
                                        @error('date_cloture')
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
                                            <option value="{{ $updates[0]->id_autorite }}" selected="true">
                                                {{ $autoriteold->raison_social }}</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date_cloture">Personne à contacter</label>
                                        <input type="text" class="form-control @error('contact') is-invalid @enderror"
                                            name="contact" value="{{ $updates[0]->contact }}" id="contact">
                                        @error('contact')
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
                                        <label for="date_publication">Mode de passation</label>
                                        <select class="form-control" name="mode" required>

                                            @if ($modeold != null)
                                                <option value="{{ $updates[0]->mode_id }}" selected="true">
                                                    {{ $modeold->libelle }} </option>
                                            @else
                                                <option value="" selected="true"> </option>
                                            @endif

                                            @foreach ($modes as $mode)
                                                @if ($updates[0]->mode_id != $mode->id)
                                                    <option value="{{ $mode->id }}">{{ $mode->libelle }}</option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="source">Source</label>
                                        <input type="text" class="form-control @error('source') is-invalid @enderror"
                                            name="source" value="{{ $updates[0]->source }}" id="source">
                                        @error('source')
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
                                        <label>Type de Marché à Conclure</label>
                                        <select class="form-control" name="categorie" required>

                                            @if ($categorieold != null)
                                                <option value="{{ $updates[0]->id_categorie }}" selected="true">
                                                    {{ $categorieold->nom_categorie }} </option>
                                            @else
                                                <option value="" selected="true"> </option>
                                            @endif

                                            @foreach ($categories as $categorie)
                                                @if ($updates[0]->id_categorie != $categorie->id)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}
                                                    </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        @error('description')
                                            <span class="invalid-feedback" role="alert">

                                                <strong>{{ $message }}</strong>

                                            </span>
                                        @enderror

                                        <label for="description">Description </label>

                                        <textarea id="description" type="text" name="description"
                                            class="form-control @error('image') is-invalid @enderror" value="{{ old('description') }}" id="description">{{ $updates[0]->description }}</textarea>


                                    </div>
                                </div>
                            </div>

                            <!-- <div class="form-group">
                                        <label>Status</label>
                                        <select class="form-control" required  name="status">
                                            <option value="1">Activer</option>
                                            <option value="0">Clôturer</option>
                                        </select>
                                    </div> -->



                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Modifier</button>
                            <button class="btn btn-danger" type="reset">Annuler</button>
                        </div>
                    </form>
                </div>
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
                            op += '<option value="' + data[i].id + '">' + data[i].name +
                                '</option>';
                        }

                        if (data.length == 0) {
                            op =
                                '<option value="0" disabled="true" selected="true">Aucune information</option>';
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
    @if (Session::has('date_nok'))
        <script>
            alert('la date de cloture doit etre superieur de la date de publication')
        </script>
    @endif
@endsection
