@extends('layouts.back_layout')
@section('title')
    Liste des opérateurs économiques
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
                            <li class="breadcrumb-item active">Liste des opérateurs économiques</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des opérateurs économiques</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des opérateurs économiques</h4>
                        <div class="row">
                            <a class="btn btn-primary offset-9 col-lg-3" href="{{ route('create_operateur') }}">
                                <i class="fa fa-plus"></i> AJOUTER UN OPÉRATEUR
                            </a>
                        </div>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>Gnonel ID</td>
                                    <td>Nom</td>
                                    <td>Numéro fiscal</td>
                                    <td>Pays</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($operateurs as $operateur)
                                    <tr>
                                        <td>{{ $operateur->gnonelid }}</td>
                                        <td>{{ $operateur->raison_social }}</td>
                                        <td><?php if ($operateur->num_fiscal == 'null') {
                                        } ?><?php if ($operateur->num_fiscal != 'null') {
                                            echo $operateur->num_fiscal;
                                        } ?></td>
                                        <td>{{ $operateur->nom_pays }}</td>
                                        <td>
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#detailsCard{{ $operateur->id }}">
                                                <i class="fe-info"></i>
                                            </button>
                                            <a href="{{ route('get_update_operateur', $operateur->id) }}"
                                                class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $operateur->id }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $operateur->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer cet opérateur?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('delete_operateur', $operateur->id) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="detailsCard{{ $operateur->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel{{ $operateur->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel{{ $operateur->id }}">
                                                        Détails</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        <strong class="">Secteur d'activité:</strong>
                                                        {{ $operateur->libellesecteuractivite }}
                                                        <hr>
                                                        <strong class="">Autres Informations:</strong>
                                                        {{ $operateur->des_operateur }}
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
