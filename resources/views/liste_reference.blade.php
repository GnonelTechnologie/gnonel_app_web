@extends('layouts.back_layout')
@section('title')
    Liste des références techniques
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
                            <li class="breadcrumb-item active">Liste des références techniques</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des références techniques</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des références techniques</h4>
                        {{-- <div class="row">
                            <a class="btn btn-primary offset-9 col-lg-3" href="/admin/lessons/add">
                                <i class="fa fa-plus"></i> AJOUTER UN CHAPITRE
                            </a>
                        </div> --}}
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    {{-- <td>Index</td> --}}
                                    <td>Libelle</td>
                                    <td>Pays</td>
                                    <td>Statut</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($references as $reference)
                                    <tr>
                                        {{-- <td>
                                            @if ($reference->numeroreference != null)
                                                {{ $reference->numeroreference }}
                                            @endif
                                        </td> --}}
                                        <td>{{ Str::limit($reference->libelle_marche, 70) }}</td>
                                        <td>{{ $reference->paysau }}</td>
                                        <td>
                                            @if ($reference->status == 0)
                                                <div class="btn btn-warning">En attente</div>
                                            @endif

                                            @if ($reference->status == 1)
                                                <div class="btn btn-success">Publiée</div>
                                            @endif

                                            @if ($reference->status == 2)
                                                <div class="btn btn-danger">Rejetée</div>
                                            @endif
                                        </td>
                                        <td>
                                            <button class="btn btn-secondary" type="button" data-bs-toggle="modal"
                                                data-bs-target="#detailsCard{{ $reference->idreference }}">
                                                <i class="fe-info"></i>
                                            </button>
                                            <button class="btn btn-success" type="button" data-bs-toggle="modal"
                                                data-bs-target="#activateCard{{ $reference->idreference }}">
                                                <i class="fe-check"></i>
                                            </button>
                                            <button class="btn btn-warning" type="button" data-bs-toggle="modal"
                                                data-bs-target="#rejectCard{{ $reference->idreference }}">
                                                <i class="fe-x-circle"></i>
                                            </button>
                                            <a href="{{ route('get_update_reference', $reference->idreference) }}"
                                                class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $reference->idreference }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $reference->idreference }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer cette référence?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('delete_reference', $reference->idreference) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="activateCard{{ $reference->idreference }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Validation</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de valider cette référence?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('valider_reference', $reference->idreference) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="rejectCard{{ $reference->idreference }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Rejet</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de rejeter cette référence?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ route('rejeter_reference', $reference->idreference) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="modal fade" id="detailsCard{{ $reference->idreference }}" tabindex="-1"
                                        role="dialog" aria-labelledby="myLargeModalLabel{{ $reference->idreference }}"
                                        aria-hidden="true">
                                        <div class="modal-dialog modal-lg">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title"
                                                        id="myLargeModalLabel{{ $reference->idreference }}">
                                                        Détails</h4>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>
                                                        <strong class="">Index: </strong>
                                                        @if ($reference->numeroreference != null)
                                                            {{ $reference->numeroreference }}
                                                        @endif
                                                        <hr>
                                                        <strong>Libellé: </strong>
                                                        {{ $reference->libelle_marche }}
                                                        <hr>
                                                        <strong>Numéro de contrat: </strong>
                                                        {{ $reference->reference_marche }}
                                                        <hr>
                                                        <strong>Type: </strong>
                                                        {{ $reference->nom_categorie }}
                                                        <hr>
                                                        <strong>Montant: </strong>
                                                        {{ $reference->montant }}
                                                        <hr>
                                                        <strong>Autorité: </strong>
                                                        {{ $reference->autorite_contractante }}
                                                        <hr>
                                                        <strong>Pays de l'auorité: </strong>
                                                        {{ $reference->paysop }}
                                                        <hr>
                                                        <strong>Titulaire du Marché: </strong>
                                                        {{ $reference->operateur }}
                                                        <hr>
                                                        <strong>Année d’exécution: </strong>
                                                        {{ $reference->annee_execution }}
                                                        <hr>
                                                        <strong>Sous-traitance par: </strong>
                                                        {{ $reference->sous_traitance }}
                                                        <hr>
                                                        <strong>En groupement avec: </strong>
                                                        {{ $reference->groupement }}
                                                        <hr>
                                                        <strong>Consultant pour le compte de: </strong>
                                                        {{ $reference->compte }}
                                                        <hr>
                                                        <strong>Piece jointe: </strong>
                                                        @if ($reference->preuve_execution != null)
                                                            <a
                                                                href="{{ asset('images/uploads/' . $reference->preuve_execution) }}">Voir</a>
                                                        @endif
                                                        <hr>
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
