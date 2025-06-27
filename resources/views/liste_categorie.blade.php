@extends('layouts.back_layout')
@section('title')
    Liste des types de marchés
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
                            <li class="breadcrumb-item active">Liste des types de marchés</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des types de marchés</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-4">
                <form method="POST" class="new-form" action="{{ route('add_categorie') }}">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Créer un type de marché</h4>
                            @csrf

                            <div class="form-group">
                                <label for="code">Code type</label>
                                <input type="text" maxlength="3"
                                    class="form-control @error('code') is-invalid @enderror" name="code"
                                    value="{{ old('code') }}" id="code">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nom">Libelle type</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                                    value="{{ old('nom') }}" id="nom">
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label>Statut</label>
                                <select class="form-control" required name="status">
                                    <option value="1">Active</option>
                                    <option value="0">Inavtive</option>
                                </select>
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
                        <h4 class="header-title">Affichage des types de marchés</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Code</th>
                                    <th>libelle type</th>
                                    <th>Date de création</th>
                                    <th>Statut</th>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($categories as $categorie)
                                    <tr>
                                        <td>{{ $categorie->code_categorie }}</td>
                                        <td>{{ $categorie->nom_categorie }}</td>
                                        <td>
                                            <?php $date = new DateTime($categorie->created_at); ?>
                                            {{ $date->format('d-m-Y H:i:s') }}
                                        </td>
                                        <td>
                                            @if ($categorie->status == 0)
                                                <div class="badge badge-danger">Inactive</div>
                                            @endif

                                            @if ($categorie->status == 1)
                                                <div class="badge badge-success">Active</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('get_update_categorie', $categorie->id) }}"
                                                class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $categorie->id }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $categorie->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer ce type de marché?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('delete_categorie', $categorie->id) }}"
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
