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
                            <li class="breadcrumb-item active">Liste des utilisateurs</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Liste des utilisateurs</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des utilisateurs (Opérateurs/Autorités et autres)</h4>
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
                                    <th>Type User</th>
                                    <th>Email</th>
                                    <th>Compte créé le</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($users as $user)
                                    <tr>
                                        <td>{{ $user->name }}</td>
                                        <td>
                                            @if ($user->type_user == 0)
                                                <div class="btn btn-primary">Administrateur</div>
                                            @elseif($user->type_user == 3)
                                                <div class="btn btn-primary">Membre</div>
                                            @elseif($user->type_user == 4)
                                                <div class="btn btn-primary">Opérateur économique</div>
                                            @elseif($user->type_user == 5)
                                                <div class="btn btn-primary">Membre</div>
                                            @endif
                                        </td>
                                        <td>{{ $user->email }}</td>
                                        <td>{{ \Carbon\Carbon::parse($user->created_at)->format('d/m/Y H:i') }}</td>
                                        <td>
                                            @if ($user->status == 0)
                                                <div class="btn btn-danger">Inactive</div>
                                            @endif

                                            @if ($user->status == 1)
                                                <div class="btn btn-success">Active</div>
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
