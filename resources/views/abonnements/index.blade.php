@extends('layouts.back_layout')
@section('title')
    Abonnements
@endsection
@section('content')
    <?php
    if (isset($abonnement)) {
        $categorieold = \Illuminate\Support\Facades\DB::table('categorie_abonnements')
            ->where('id', $abonnement->categorie)
            ->first();
    }
    ?>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Abonnements</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Abonnements</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-4">
                @if (isset($abonnement))
                    <form method="POST" id="new-form" action="{{ route('abonnements.update', $abonnement->id) }}">
                    @else
                        <form method="POST" id="new-form" action="{{ route('abonnements.store') }}">
                @endif
                <div class="card">
                    <div class="card-body">
                        @if (!isset($abonnement))
                            <h4 class="header-title">Créer un abonnement</h4>
                        @else
                            <h4 class="header-title">Modifier un abonnement</h4>
                        @endif
                        @csrf

                        @if (isset($abonnement))
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="code">Libelle</label>
                                <input type="text" value="{{ $abonnement->libelle }}"
                                    class="form-control @error('libelle') is-invalid @enderror" name="libelle"
                                    value="{{ old('libelle') }}" id="libelle">
                                @error('libelle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Monnaie</label>
                                <input type="text" value="{{ $abonnement->monnaie }}"
                                    class="form-control @error('monnaie') is-invalid @enderror" name="monnaie"
                                    value="{{ old('monnaie') }}" id="monnaie">
                                @error('monnaie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">prix</label>
                                <input type="number" value="{{ $abonnement->prix }}"
                                    class="form-control @error('prix') is-invalid @enderror" name="prix"
                                    value="{{ old('prix') }}" id="prix">
                                @error('prix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Prix exo</label>
                                <input type="text" value="{{ $abonnement->prix_exo }}"
                                    class="form-control @error('prix_exo') is-invalid @enderror" name="prix_exo"
                                    value="{{ old('prix_exo') }}" id="prix_exo">
                                @error('prix_exo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Nombre de jours</label>
                                <input type="text" value="{{ $abonnement->nbjours }}"
                                    class="form-control @error('jours') is-invalid @enderror" name="jours"
                                    value="{{ old('jours') }}" id="jours">
                                @error('jours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="categorie">Categorie d'abonnement </label>
                                <select class="form-control" name="categorie" required>

                                    @if ($categorieold != null)
                                        <option value="{{ $abonnement->categorie }}" selected="true">
                                            {{ $categorieold->libelle }} </option>
                                    @else
                                        <option value="" selected="true"> </option>
                                    @endif

                                    @foreach ($categories as $categorie)
                                        @if ($abonnement->categorie != $categorie->id)
                                            <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                                        @endif
                                    @endforeach
                                </select>
                                @error('categorie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nom">Description</label>
                                <textarea rows="4" cols="50" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ old('description') }}" id="description">{{ $abonnement->description }}</textarea>
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="checkbox" @if ($abonnement->choixaut == 1) checked @endif id="choixaut"
                                    name="choixaut" value="1">
                                <label for="vehicle1">Autorité</label><br>
                                <input type="checkbox" @if ($abonnement->choixop == 1) checked @endif id="choixop"
                                    name="choixop" value="1">
                                <label for="vehicle2">Opérateur</label><br>
                            </div>
                        @else
                            <div class="form-group">
                                <label for="code">Libelle</label>
                                <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                                    name="libelle" value="{{ old('libelle') }}" id="libelle">
                                @error('libelle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Monnaie</label>
                                <input type="text" class="form-control @error('monnaie') is-invalid @enderror"
                                    name="monnaie" value="{{ old('monnaie') }}" id="monnaie">
                                @error('monnaie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">prix</label>
                                <input type="number" class="form-control @error('prix') is-invalid @enderror"
                                    name="prix" value="{{ old('prix') }}" id="prix">
                                @error('prix')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Prix exo</label>
                                <input type="text" class="form-control @error('prix_exo') is-invalid @enderror"
                                    name="prix_exo" value="{{ old('prix_exo') }}" id="prix_exo">
                                @error('prix_exo')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="code">Nombre de jours</label>
                                <input type="text" class="form-control @error('jours') is-invalid @enderror"
                                    name="jours" value="{{ old('jours') }}" id="jours">
                                @error('jours')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="categorie">Categorie d'abonnement </label>
                                <select class="form-control" name="categorie" required>
                                    @foreach ($categories as $categorie)
                                        <option value="{{ $categorie->id }}">{{ $categorie->libelle }}</option>
                                    @endforeach
                                </select>
                                @error('categorie')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="nom">Description</label>
                                <textarea rows="4" cols="50" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ old('description') }}" id="description"></textarea>
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <input type="checkbox" id="choixop" name="choixaut" value="1">
                                <label for="vehicle1">Autorité</label><br>
                                <input type="checkbox" id="choixop" name="choixop" value="1">
                                <label for="vehicle2">Opérateur</label><br>
                            </div>
                        @endif
                    </div>
                    <div class="card-footer text-end">
                        <button class="btn btn-primary" type="submit">Valider</button>
                        <button class="btn btn-danger" type="reset">Annuler</button>
                    </div>
                </div>
                </form>
            </div>
            <div class="col-8">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des abonnements</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>Libelle</td>
                                    <td>Monnaie</td>
                                    <td>Prix</td>
                                    <td>Date de création</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($abonnements as $abonnement)
                                    <tr>
                                        <td>{{ $abonnement->libelle }}</td>
                                        <td>{{ $abonnement->monnaie }}</td>
                                        <td>{{ $abonnement->prix }}</td>
                                        <td>
                                            <?php $date = new DateTime($abonnement->created_at); ?>
                                            {{ $date->format('d-m-Y H:i:s') }}
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#detailsCard{{ $abonnement->id }}">
                                                <i class="fe-info"></i>
                                            </button>
                                            <a href="{{ route('abonnements.edit', $abonnement->id) }}"
                                                class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $abonnement->id }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $abonnement->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer cet abonnement?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('delete_abonnement', $abonnement->id) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="detailsCard{{ $abonnement->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel{{ $abonnement->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel{{ $abonnement->id }}">
                                                        Détails</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        <strong class="">Libelle:</strong>
                                                        {{ $abonnement->libelle }}
                                                        <hr>
                                                        <strong class="">Prix:</strong>
                                                        {{ $abonnement->prix }}
                                                        <hr>
                                                        <strong class="">Prix exo:</strong>
                                                        {{ $abonnement->prix_exo }}
                                                        <hr>
                                                        <strong class="">Nbre jours:</strong>
                                                        {{ $abonnement->nbjours }}
                                                        <hr>
                                                        <strong class="">Categorie:</strong>
                                                        @if (\App\Categorieabonnement::find($abonnement->categorie) != null)
                                                            {{ \App\Categorieabonnement::find($abonnement->categorie)->libelle }}
                                                        @endif
                                                        <hr>
                                                        <strong class="">Description:</strong>
                                                        {{ $abonnement->description }}
                                                    </p>
                                                </div>
                                            </div><!-- /.modal-content -->
                                        </div><!-- /.modal-dialog -->
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
@endsection
