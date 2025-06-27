@extends('layouts.back_layout')
@section('title')
    Mon compte
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
                            <li class="breadcrumb-item active">Mon compte</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Mon compte</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Mon compte</h4>
                        {{-- <div class="row">
                            <a class="btn btn-primary offset-9 col-lg-3" href="/admin/lessons/add">
                                <i class="fa fa-plus"></i> AJOUTER UN CHAPITRE
                            </a>
                        </div> --}}
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">Nom</td>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Prénom</td>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->prenom }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Téléphone</td>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->telephone }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Structure</td>
                                    <td>{{ $operateur->raison_social }}</td>
                                </tr>
                                {{-- <tr>
                                    <td style="width: 20%">Gnonel Id</td>
                                    <td>{{ $operateur->gnonelid }}</td>
                                </tr> --}}
                                <tr>
                                    <td style="width: 20%">Pays</td>
                                    <td>{{ $operateur->nom_pays }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Adresse mail</td>
                                    <td>{{ \Illuminate\Support\Facades\Auth::user()->email }}</td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Date creation compte</td>
                                    <td>{{ \Carbon\Carbon::parse(\Illuminate\Support\Facades\Auth::user()->created_at)->format('d/m/Y') }}
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Abonnement souscrit</td>
                                    <td>{{ \App\User::verifabonnement(Auth::user())->libelle }}</td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
@endsection
