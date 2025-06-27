@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>User</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="{{ route('home') }}">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="{{ route('liste_offre') }}">Offres</a></div>
                <div class="breadcrumb-item"><a href="{{ route('liste_autorite') }}">Autorité</a></div>
                <div class="breadcrumb-item"><a href="{{ route('liste_operateur') }}">Opérateurs</a></div>
                <div class="breadcrumb-item">Utilisateurs</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste des utilisateurs</h2>
            <!--<p class="section-lead">Example of some Bootstrap table components.</p>-->

            <div class="row">
                <div class="col-12 col-md-6 col-lg-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Simple Table</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom</th>
                                        <th>Type User</th>
                                        <th>Email</th>
                                        <th>Created At</th>
                                        <th>Status</th>
                                        <th>Action</th>
                                    </tr>
                                    <?php $countline = 0; ?>
                                    @foreach ($users as $user)
                                        <tr>
                                            <td>{{ $countline = $countline + 1 }}</td>
                                            <td>{{ $user->name }}</td>
                                            <td>{{ $user->type_user }}</td>
                                            <td>{{ $user->email }}</td>
                                            <td>{{ $user->created_at }}</td>
                                            <td>
                                                @if ($user->status == 0)
                                                    <div class="badge badge-danger">Inactive</div>
                                                @endif

                                                @if ($user->status == 1)
                                                    <div class="badge badge-success">Active</div>
                                                @endif
                                            </td>
                                            <td><a href="#" class="btn btn-secondary">Detail</a></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    {{ $users->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
