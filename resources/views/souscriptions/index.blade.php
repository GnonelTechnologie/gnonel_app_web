@extends('layouts.back_layout')
@section('title')
    Ma souscription
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
                            <li class="breadcrumb-item active">Ma souscription</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Ma souscription</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                @if ($souscription == null)
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Aucune souscription</h4>
                        </div>
                    </div>
                @else
                    <div class="card">
                        <div class="card-body">
                            <div class="row">
                                <div class="col-lg-12 col-xl-12">
                                    <div class="card" style="background-color: aliceblue">
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-3">
                                                    @if ($souscription->date_fin == null || $souscription->date_fin < date('Y-m-d'))
                                                        <div class="avatar-md bg-danger rounded">
                                                            <i class="avatar-title font-18 text-white">Expiré</i>
                                                        </div>
                                                    @else
                                                        <div class="avatar-md bg-success rounded">
                                                            <i class="avatar-title font-18 text-white">Actif</i>
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="col-9">
                                                    <div class="text-end">
                                                        <h3 class="text-dark my-1">{{ $souscription->libelle }}
                                                        </h3>
                                                        <p class="text-muted mb-0 text-truncate">
                                                            @if ($souscription->count == 1)
                                                                PACK SOLO
                                                            @else
                                                                PACK ÉQUIPE ({{ $souscription->count }})
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div> <!-- end card-->
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            </div>
        </div>
        @if ($souscription != null && $souscription->count > 1)
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <div class="card-body">
                            <h4 class="header-title">Mon équipe</h4>
                            @if ($souscription->count > $teamUsers->count())
                                <div class="row">
                                    <button class="btn btn-primary offset-9 col-lg-3" type="button" data-bs-toggle="modal"
                                        data-bs-target="#user-modal">
                                        <i class="fa fa-plus"></i> AJOUTER UNE PERSONNE
                                    </button>
                                </div>
                            @endif
                            <br>
                            <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                                <thead class="bg-primary text-white">
                                    <tr>
                                        <td>Nom complet</td>
                                        <td>Adresse mail</td>
                                        <td>Actions</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($teamUsers as $teamUser)
                                        <tr>
                                            <td>
                                                {{ $teamUser->prenoms }} {{ $teamUser->name }}
                                            </td>
                                            <td>
                                                {{ $teamUser->email }}
                                            </td>
                                            <td>
                                                <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCard{{ $teamUser->id }}">
                                                    <i class="fe-trash"></i>
                                                </button>
                                            </td>
                                        </tr>
                                        <div class="modal fade" id="deleteCard{{ $teamUser->id }}" tabindex="-1"
                                            role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog" role="document">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <p>Etes-vous sûr de retirer cette personne de votre équipe?</p>
                                                    </div>
                                                    <div class="modal-footer bg-whitesmoke br">

                                                        <button type="button" class="btn btn-danger" style="color:white;"
                                                            data-bs-dismiss="modal">Fermer</button>
                                                        <a href="{{ url('souscription/delete-user', $teamUser->id) }}"
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
                    </div>
                </div>
            </div>

            <div id="user-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="user-modalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <form method="POST" action="{{ route('add_user_souscription') }}">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="standard-modalLabel">Ajouter une personne à l'équipe</h4>
                                <button type="button" class="btn-close" data-bs-dismiss="modal"
                                    aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                @csrf
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="lastname">Nom</label>
                                            <input class="form-control" id="lastname" type="text" name="lastname"
                                                required placeholder="DOE">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="firstname">Prénoms</label>
                                            <input class="form-control" id="firstname" type="text" name="firstname"
                                                required placeholder="John">
                                        </div>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-12">
                                        <label for="email">Adresse email</label>
                                        <input class="form-control" name="email" type="email"
                                            placeholder="johndoe@gmail.com" required>
                                    </div>
                                </div>
                                <div class="row mb-2">
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="password">Mot de passe</label>
                                            <input class="form-control" id="password" type="password" name="password"
                                                required placeholder="********">
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="form-group">
                                            <label for="confirm_password">Confirmation</label>
                                            <input class="form-control" id="confirm_password" type="password"
                                                name="confirm_password" required placeholder="********">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-light" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary">Valider</button>
                            </div>
                        </div><!-- /.modal-content -->
                    </form>

                </div><!-- /.modal-dialog -->
            </div>
        @endif

    </div>
@endsection
@section('script')
@endsection
