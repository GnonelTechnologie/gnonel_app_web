@extends('layouts.back_layout')
@section('title')
    Liste des Pays
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
                            <li class="breadcrumb-item active">Liste des Pays</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des Pays</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-4">
                <form method="POST" class="new-form" action="{{ route('add_pays') }}">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Ajouter un pays</h4>
                            @csrf

                            <div class="form-group">
                                <label for="code">Code du pays</label>
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
                                <label for="nom">Nom du pays</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" name="nom"
                                    value="{{ old('nom') }}" id="nom">
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="indicatif">Indicatif</label>
                                <input type="text" class="form-control @error('indicatif') is-invalid @enderror"
                                    name="indicatif" value="{{ old('indicatif') }}" id="indicatif">
                                @error('indicatif')
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
                        <h4 class="header-title">Affichage des Pays</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Code</th>
                                    <th>Nom du pays</th>
                                    <th>Indicatif</th>
                                    <th>Date de création</th>
                                    <th>Statut</th>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pays as $pay)
                                    <tr>
                                        <td>{{ $pay->code_pays }}</td>
                                        <td>{{ $pay->nom_pays }}</td>
                                        <td>{{ $pay->indicatif }}</td>
                                        <td>
                                            <?php $date = new DateTime($pay->created_at); ?>
                                            {{ $date->format('d-m-Y H:i:s') }}
                                        </td>
                                        <td>
                                            @if ($pay->status == 0)
                                                <div class="btn btn-danger">Inactive</div>
                                            @endif

                                            @if ($pay->status == 1)
                                                <div class="btn btn-success">Active</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('get_update_pays', $pay->id) }}" class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $pay->id }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $pay->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer ce pays?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('delete_pays', $pay->id) }}" class="btn btn-success">
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
