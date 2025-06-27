@extends('layouts.back_layout')

@section('content')
    <section class="section">
        <div class="section-body">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Créer un opérateur économique</h4>
                        </div>
                        <form method="POST" action="{{ route('add_operateur') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nom de la Société *</label>
                                            <input type="text" class="form-control @error('name') is-invalid @enderror"
                                                name="name" value="{{ old('name') }}" id="name">
                                            @error('name')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Adresse mail</label>
                                            <input type="text" class="form-control @error('mail') is-invalid @enderror"
                                                name="mail" value="{{ old('mail') }}" id="nom">
                                            @error('mail')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Pays *</label>
                                            <select class="form-control" id="pays" name="pays" required>
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
                                            <label for="num_fiscal">Numéro RCCM</label>
                                            <input type="text"
                                                class="form-control @error('num_fiscal') is-invalid @enderror"
                                                name="num_fiscal" value="{{ old('num_fiscal') }}" id="num_fiscal">
                                            @error('num_fiscal')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
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
                                    </div>

                                    <div class="col">

                                        <div class="form-group">

                                            <label for="description">Télephone </label>
                                            <textarea id="description" type="text" name="description" class="form-control @error('image') is-invalid @enderror"
                                                id="description">{{ old('description') }}</textarea>
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>

                                    <div class="col" id="jfe" style="display: none;">
                                        <div class="form-group">
                                            <label for="exampleFormControlSelect1" style="">Le fournisseur est un
                                                JFE?</label><br>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="typeoperateur" value="1">
                                                <label class="form-check-label" for="typeoperateur">OUI</label>
                                            </div>
                                            <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio" name="type"
                                                    id="typeautorite" value="0" checked>
                                                <label class="form-check-label" for="typeautorite">NON</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Créer</button>
                                <button class="btn btn-danger" type="reset">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $(document).on('change', '#pays', function() {

                var idpays = $(this).val();

                if (idpays == 1) {
                    $('#jfe').css("display", "block")
                } else {

                    $('#jfe').css("display", "none")
                    var radioButton = document.querySelector('input[name="type"][value="0"]');

                    // Vérifiez si l'input de type radio est sélectionné
                    if (radioButton) {
                        // Cochez l'input de type radio si nécessaire
                        radioButton.checked = true;
                    }
                }

            });
        });
    </script>

    @if (Session::has('update_ok'))
        <script>
            alert('Opérateur modifié avec succès')
        </script>
    @endif
    @if (Session::has('delete_ok'))
        <script>
            alert('Opérateur supprimé avec succès')
        </script>
    @endif
    @if (Session::has('delete_no'))
        <script>
            alert('la suppression a échouée, reprendre')
        </script>
    @endif
@endsection
