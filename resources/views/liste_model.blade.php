@extends('layouts.app')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Modèle type</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste des modèls</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Nouveau modèl</h4>
                        </div>
                        <form method="POST" action="{{ route('add_model') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label for="libelle">Libelle</label>
                                    <input type="text" class="form-control @error('libelle') is-invalid @enderror"
                                        name="libelle" value="{{ old('libelle') }}" id="libelle">
                                    @error('libelle')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="fichier">Fichier</label>
                                    <input type="file" class="form-control @error('fichier') is-invalid @enderror"
                                        name="fichier" value="{{ old('fichier') }}" id="fichier">
                                    @error('fichier')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-right">
                                <button class="btn btn-primary" type="submit">Valider</button>
                                <button class="btn btn-danger" type="reset">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Liste des modèls</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>Libelle</th>
                                        <th>Lien</th>
                                        <th>Created At</th>
                                        <th>Action</th>
                                    </tr>
                                    @foreach ($models as $model)
                                        <tr>
                                            <td>{{ $model->libelle_modele }}</td>
                                            <td><a
                                                    href="/dev/storage/{{ $model->lien_download }}">https://lien-de-téléchargement/</a>
                                            </td>
                                            <td>{{ $model->created_at }}</td>
                                            <!-- <td>
                                @if ($model->status == 0)
    <div class="badge badge-danger">Inactive</div>
    @endif

                                @if ($model->status == 1)
    <div class="badge badge-success">Active</div>
    @endif
                            </td> -->
                                            <td>
                                                <div class="table-links">
                                                    <a href="{{ route('get_update_model', $model->id) }}">
                                                        <li class="bullet"></li>Modifier
                                                    </a><br>
                                                    <a href="{{ route('delete_model', $model->id) }}"
                                                        onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément')">
                                                        <li class="bullet"></li>Supprimer
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    {{ $models->links() }}
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    @if (Session::has('update_ok'))
        <script>
            alert('Model modifié avec succès')
        </script>
    @endif
    @if (Session::has('delete_ok'))
        <script>
            alert('Model supprimé avec succès')
        </script>
    @endif
@endsection
