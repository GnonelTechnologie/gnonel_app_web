@extends('layouts.back_layout')
@section('title')
    Liste des Secteurs d'activités
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Liste des Secteurs d'activités</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des Secteurs d'activités</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-4">
                <form method="POST" class="new-form" action="{{ route('createsecteur_activite') }}">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Créer un secteur d’activité</h4>
                            @csrf

                            <div class="form-group">
                                <label for="code">Code</label>
                                <input type="text" class="form-control @error('code') is-invalid @enderror"
                                    name="code" value="{{ old('code') }}" id="code" maxlength="3">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="libelle">Libelle</label>
                                <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                                    name="libelle" value="{{ old('libelle') }}" id="libelle">
                                @error('libelle')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
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
                        <h4 class="header-title">Affichage des Secteurs d'activité</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Code</th>
                                    <th>Libelle du Secteur d'activité</th>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($secteur_activites as $secteur_activite)
                                    <tr>
                                        <td>{{ $secteur_activite->codesecteur }}</td>
                                        <td>{{ $secteur_activite->libellesecteuractivite }}</td>
                                        <td>
                                            <!--<a href="{{ route('updatesecteur_activite', $secteur_activite->idsecteuractivite) }}"
                                                    class="btn btn-info">
                                                    <i class="fe-edit"></i>
                                                </a>-->
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $secteur_activite->idsecteuractivite }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $secteur_activite->idsecteuractivite }}"
                                        tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer ce secteur d'activité?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('deletesecteur_activite', $secteur_activite->idsecteuractivite) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
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
