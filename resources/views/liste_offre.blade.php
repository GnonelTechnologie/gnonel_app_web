@extends('layouts.back_layout')
@section('title')
    Liste des appels d'offres
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
                            <li class="breadcrumb-item active">Liste des appels d'offres</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des appels d'offres</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des appels d'offres</h4>
                        {{-- <div class="row">
                            <a class="btn btn-primary offset-9 col-lg-3" href="/admin/lessons/add">
                                <i class="fa fa-plus"></i> AJOUTER UN CHAPITRE
                            </a>
                        </div> --}}
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>Numéro </td>
                                    <td>Libelle</td>
                                    <td>Pays de l'annonceur</td>
                                    <td>Date de Publication</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($offres as $offre)
                                    <tr>
                                        <td>{{ $offre->reference }}</td>
                                        <td>{{ Str::limit($offre->libelle_appel, 30) }}</td>
                                        <td>{{ $offre->nom_pays }}</td>
                                        <td>
                                            <?php $datep = new DateTime($offre->date_publication); ?>
                                            {{ $datep->format('d-m-Y') }}
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#detailsCard{{ $offre->id }}">
                                                <i class="fe-info"></i>
                                            </button>
                                            <a href="{{ route('get_update_offre', $offre->id) }}" class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $offre->id }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                            @if ($offre->status == 0)
                                                <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#activateCard{{ $offre->id }}">
                                                    <i class="fe-check"></i>
                                                </button>
                                            @endif
                                            @if ($offre->status == 1)
                                                <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#endCard{{ $offre->id }}">
                                                    <i class="fe-x-circle"></i>
                                                </button>
                                            @endif

                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $offre->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer cette offre?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('delete_offre', $offre->id) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="activateCard{{ $offre->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Activation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr d'activer cette offre?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('activer_offre', $offre->id) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="endCard{{ $offre->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Clôture</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de clôturer cette offre?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('cloturer_offre', $offre->id) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="detailsCard{{ $offre->id }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel{{ $offre->id }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title" id="myLargeModalLabel{{ $offre->id }}">
                                                        Détails</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        <strong class="">Libelle:</strong>
                                                        {{ $offre->libelle_appel }}
                                                        <hr>
                                                        <strong class="">Reference:</strong> {{ $offre->reference }}
                                                        <hr>
                                                        <strong class="">Pays:</strong> {{ $offre->nom_pays }}
                                                        <hr>
                                                        <strong class="">Date publication:</strong>
                                                        {{ $offre->date_publication }}
                                                        <hr>
                                                        <strong class="">Date cloture:</strong>
                                                        {{ $offre->date_cloture }}
                                                        <hr>
                                                        <strong class="">Personne à contacter:</strong>
                                                        {{ $offre->contact }}
                                                        <hr>
                                                        <strong class="">Source:</strong> {{ $offre->source }}
                                                        <hr>
                                                        <strong class="">Description:</strong>
                                                        {{ $offre->description }}
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
