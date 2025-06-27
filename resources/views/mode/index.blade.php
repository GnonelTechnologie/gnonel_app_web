@extends('layouts.back_layout')
@section('title')
    Mode de passation
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
                            <li class="breadcrumb-item active">Mode de passation</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Mode de passation</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-4">
                @if (isset($mode))
                    <form method="POST" action="{{ route('modepassations.update', $mode->id) }}">
                    @else
                        <form method="POST" action="{{ route('modepassations.store') }}">
                @endif
                <div class="card">
                    <div class="card-body">
                        @if (!isset($mode))
                            <h4 class="header-title">Créer un mode de passation</h4>
                        @else
                            <h4 class="header-title">Modifier un mode de passation</h4>
                        @endif
                        @csrf

                        @if (isset($mode))
                            {{ method_field('PUT') }}
                            <div class="form-group">
                                <label for="code">Libelle</label>
                                <input type="text" value="{{ $mode->libelle }}"
                                    class="form-control @error('libelle') is-invalid @enderror" name="libelle"
                                    value="{{ old('libelle') }}" id="libelle">
                                @error('code')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>

                            <div class="form-group">
                                <label for="nom">Description</label>
                                <textarea rows="4" cols="50" class="form-control @error('description') is-invalid @enderror"
                                    name="description" value="{{ old('description') }}" id="description">{{ $mode->description }}</textarea>
                                @error('nom')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        @else
                            <div class="form-group">
                                <label for="code">Libelle</label>
                                <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                                    name="libelle" value="{{ old('libelle') }}" id="libelle">
                                @error('code')
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
                        <h4 class="header-title">Affichage des modes de passation</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>Libelle</td>
                                    <td>Description</td>
                                    <td>Date de création</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($modes as $mode)
                                    <tr>
                                        <td>{{ $mode->libelle }}</td>
                                        <td>{{ $mode->description }}</td>
                                        <td>
                                            <?php $date = new DateTime($mode->created_at); ?>
                                            {{ $date->format('d-m-Y H:i:s') }}
                                        </td>
                                        <td>
                                            <a href="{{ route('modepassations.edit', $mode->id) }}" class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $mode->id }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $mode->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer ce mode de passation?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('delete_mode', $mode->id) }}"
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
