@extends('layouts.back_layout')

@section('content')
    <?php
    $i = 1;
    ?>
    <section class="section">

        <div class="section-body">
            <!--<p class="section-lead">Example of some Bootstrap table components.</p>-->
            <div class="row">
                <div class="col-12 col-md-12 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Créer une autorité contractante</h4>
                        </div>
                        <form method="POST" action="{{ route('add_autorite') }}">
                            @csrf
                            <div class="card-body">
                                <div class="row">
                                    <div class="col">
                                        <div class="form-group">
                                            <label>Nom de l'institution *</label>
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
                                            <label>Pays *</label>
                                            <select class="form-control" name="pays" required>
                                                @foreach ($pays as $pay)
                                                    <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            <label for="categorie">Categorie Autorite Contractante </label>
                                            <select class="form-control" name="categorie" required>
                                                <option value="">..Selectionnez..</option>
                                                @foreach ($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->libelleCat }}
                                                    </option>
                                                @endforeach
                                            </select>
                                            @error('categorie')
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
                                            <label for="adresse">Adresse</label>
                                            <input type="text"
                                                class="form-control @error('adresse') is-invalid @enderror" name="adresse"
                                                value="{{ old('adresse') }}" id="adresse">
                                            @error('adresse')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col">
                                        <div class="form-group">
                                            @error('description')
                                                <span class="invalid-feedback" role="alert">
                                                    <strong>{{ $message }}</strong>
                                                </span>
                                            @enderror
                                            <label for="description">Autre Information </label>
                                            <textarea id="description" type="text" name="description" class="form-control @error('image') is-invalid @enderror"
                                                id="description">{{ old('description') ? old('description') : 'Aucun' }}</textarea>

                                        </div>

                                    </div>
                                    <div class="col">

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
    @if (Session::has('update_ok'))
        <script>
            alert('Autorité modifiée avec succès')
        </script>
    @endif
    @if (Session::has('delete_ok'))
        <script>
            alert('Autorité supprimée avec succès')
        </script>
    @endif
    @if (Session::has('delete_no'))
        <script>
            alert('la suppression a échouée, reprendre')
        </script>
    @endif
@endsection
