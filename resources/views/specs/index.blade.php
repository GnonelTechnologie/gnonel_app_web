@extends('layouts.back_layout')
@section('title')
    Mes spécifications
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
                            <li class="breadcrumb-item active">Mes spécifications</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Mes spécifications</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des spécifications</h4>
                        {{-- <div class="row">
                            <a class="btn btn-primary offset-9 col-lg-3" href="/admin/lessons/add">
                                <i class="fa fa-plus"></i> AJOUTER UN CHAPITRE
                            </a>
                        </div> --}}
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    {{-- <td>Catégorie</td> --}}
                                    {{-- <td>Lien</td> --}}
                                    <td>Nom de l’article</td>
                                    <td>Contexte d’utilisation</td>
                                    <td>Pays</td>
                                    <td>Status</td>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($specs as $spec)
                                    <tr>
                                        {{-- <td>{{ \Illuminate\Support\Facades\DB::table('categories')->where('id', '=', $spec->categorie_id)->first()->nom_categorie }}
                                        </td> --}}
                                        {{-- <td><a href="{{ asset('public/images/uploads/' . $spec->lien) }}">Voir pièce
                                                jointe</a>
                                        </td> --}}
                                        <td>{{ $spec->libelle }}</td>
                                        <td>{{ $spec->contexte }}</td>
                                        <td>{{ \Illuminate\Support\Facades\DB::table('pays')->where('id', '=', $spec->pays_id)->first()->nom_pays }}
                                        </td>
                                        <td>
                                            @if ($spec->status == 0)
                                                <div class="btn btn-warning">En attente</div>
                                            @endif

                                            @if ($spec->status == 1)
                                                <div class="btn btn-success">Publiée</div>
                                            @endif

                                            @if ($spec->status == 2)
                                                <div class="btn btn-danger">Rejetée</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('specifications.edit', $spec->id) }}" class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $spec->id }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $spec->id }}" tabindex="-1" role="dialog"
                                        aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer cette spécification?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ url('delete/specifications', $spec->id) }}"
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
