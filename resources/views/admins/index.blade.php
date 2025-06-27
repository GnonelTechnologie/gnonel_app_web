@extends('layouts.back_layout')
@section('title')
    Liste des adminstrateurs
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
                            <li class="breadcrumb-item active">Liste des adminstrateurs</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des adminstrateurs</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Liste des adminstrateurs</h4>
                        <div class="row">
                            <button class="btn btn-primary offset-9 col-lg-3" data-bs-toggle="modal"
                                data-bs-target="#infos1">
                                <i class="fa fa-plus"></i> AJOUTER UN ADMIN
                            </button>
                            <div class="modal fade" id="infos1" tabindex="-1" aria-hidden="true" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <form action="{{ route('admins.store') }}" method="post" file="true"
                                            enctype="multipart/form-data">
                                            <div class="modal-header">
                                                <h2>Nouveau admin</h2>
                                            </div>
                                            <div class="modal-body">

                                                <input type="hidden" name="_token" value="{{ csrf_token() }}" required
                                                    class="form-control">
                                                <label>Email</label>
                                                <input class="form-control" name="email" type="email" required> <br>
                                                <label>Mot de passe</label>
                                                <input class="form-control" name="password" type="password" required> <br>
                                            </div>
                                            <div class="modal-footer">
                                                <br><input type="submit" class="btn btn-success" value="Enregistrer">
                                                <button class="btn btn-danger" data-dismiss="modal">Fermer</button>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Email</th>
                                    <th>Profil</th>
                                    <th>Etat</th>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($us as $t)
                                    <tr>
                                        <td>
                                            {{ $t->email }}
                                        </td>
                                        <td>
                                            Admin
                                        </td>
                                        <td>
                                            @if ($t->etat == 1)
                                                Activé
                                            @else
                                                Activé
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('admins.edit', $t->id) }}" class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $t->id }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $t->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <form action="{{ route('admins.destroy', $t->id) }}" method="post"></form>
                                        {{ method_field('delete') }}
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}" required
                                            class="form-control">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer cet admin?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">
                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <button type="submit" class="btn btn-success">
                                                        Oui</button>
                                                </div>
                                            </div>
                                        </div>
                                        </form>
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
