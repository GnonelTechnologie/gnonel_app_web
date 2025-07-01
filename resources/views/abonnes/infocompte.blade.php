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
                        <h4 class="header-title">Modifier mes informations</h4>
                        <form method="POST" action="{{ route('profil.update') }}">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Nom</label>
                                    <input type="text" name="name" class="form-control" value="{{ old('name', Auth::user()->name) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Prénom</label>
                                    <input type="text" name="prenom" class="form-control" value="{{ old('prenom', Auth::user()->prenom) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Téléphone</label>
                                    <input type="text" name="telephone" class="form-control" value="{{ old('telephone', Auth::user()->telephone) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Email</label>
                                    <input type="email" name="email" class="form-control" value="{{ old('email', Auth::user()->email) }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Structure</label>
                                    <input type="text" name="structure" class="form-control" value="{{ old('structure', isset($operateur->raison_social) ? $operateur->raison_social : '') }}">
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Enregistrer</button>
                        </form>
                        <hr>
                        <h4 class="header-title mt-4">Mes informations</h4>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <tbody>
                                <tr>
                                    <td style="width: 20%">Nom</td>
                                    <td>{{ Auth::user()->name }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Prénom</td>
                                    <td>{{ Auth::user()->prenom }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 20%">Téléphone</td>
                                    <td>{{ Auth::user()->telephone }}</td>
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
                                    <td>{{ Auth::user()->email }}</td>
                                </tr>

                                <tr>
                                    <td style="width: 20%">Date creation compte</td>
                                    <td>{{ \Carbon\Carbon::parse(Auth::user()->created_at)->format('d/m/Y') }}
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
