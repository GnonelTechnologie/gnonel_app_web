@extends('layouts.back_layout')
@section('title')
    Liste des utilisateurs
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
                            <li class="breadcrumb-item active">Liste des utilisateurs(Opérateurs/Autorités) actifs</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des utilisateurs(Opérateurs/Autorités) actifs</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des utilisateurs(Opérateurs/Autorités) actifs</h4>
                        {{-- <div class="row">
                            <a class="btn btn-primary offset-9 col-lg-3" href="/admin/lessons/add">
                                <i class="fa fa-plus"></i> AJOUTER UN CHAPITRE
                            </a>
                        </div> --}}
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Nom</th>
                                    <th>Prenom</th>
                                    <th>Email</th>
                                    <th>Formule d'abonnement</th>
                                    <th>Date souscription</th>
                                    <th>Date fin abonnement</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <th>{{ $user->prenom }}</th>
                                        <td>{{ $user->email }}</td>
                                        <td>
                                            @if (\Illuminate\Support\Facades\DB::table('abonnement')->where('id', $user->idabonnement)->first() != null)
                                                {{ \Illuminate\Support\Facades\DB::table('abonnement')->where('id', $user->idabonnement)->first()->libelle }}
                                            @else
                                                Formule a été supprimé
                                            @endif

                                        </td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y') }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->date_fin)->format('d/m/Y') }}</td>
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
