@extends('layouts.back_layout')
@section('title')
    Recapitulatif des recommandation non extrait
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
                            <li class="breadcrumb-item active">Recapitulatif des recommandation non extrait</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Recapitulatif des recommandations non extrait</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        {{-- <div class="row">
                            <a class="btn btn-primary offset-9 col-lg-3" href="/admin/lessons/add">
                                <i class="fa fa-plus"></i> AJOUTER UN CHAPITRE
                            </a>
                        </div> --}}
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>Date </td>
                                    <td>Recommandeur</td>
                                    <td>Numéro</td>
                                    <td>Lien</td>
                                    <td>Montant abonnement</td>
                                    <td>Montant réduction</td>
                                    <td>Recommandé</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recommandes as $recom)
                                    <?php
                                    $user = \Illuminate\Support\Facades\DB::table('users')->where('id', $recom->user_id)->first();
                                    $souscription = \Illuminate\Support\Facades\DB::table('souscriptions')->where('idsouscription', $recom->souscription_id)->first();
                                    $iduser = null;
                                    if ($souscription != null) {
                                        $iduser = \Illuminate\Support\Facades\DB::table('users')->where('id', $souscription->iduser)->first();
                                    }
                                    
                                    ?>
                                    <tr>
                                        <td>
                                            @if ($user != null)
                                                {{ $user->created_at }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user != null)
                                                {{ $user->email }}
                                            @endif
                                        </td>
                                        <td>
                                            @if ($user != null)
                                                {{ $user->telephone }}
                                            @endif
                                        </td>
                                        <td>
                                            <div class="button-list" id="tooltip-container">
                                                <a href="{{ $recom->lien }}" class="btn btn-secondary" target="_blank"
                                                    data-bs-container="#tooltip-container" data-bs-toggle="tooltip"
                                                    data-bs-placement="top" title="{{ $recom->lien }}">Voir
                                                </a>
                                            </div>

                                        </td>
                                        <td>{{ $souscription != null ? $souscription->montant_finale_apaye : '--' }}</td>
                                        <td>{{ $souscription != null ? $souscription->frais_bonus : '--' }}</td>

                                        <td>
                                            @if ($iduser != null)
                                                {{ $iduser->email }}
                                            @endif
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
@endsection
