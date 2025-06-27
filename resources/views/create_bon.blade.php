@extends('layouts.back_layout')

@section('content')
    <section class="section">
        <div class="section-header">
            <h1>Bon de commande</h1>
            <div class="section-header-breadcrumb">
                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>
                <div class="breadcrumb-item"><a href="#">Components</a></div>
                <div class="breadcrumb-item">Table</div>
            </div>
        </div>

        <div class="section-body">
            <h2 class="section-title">Liste des bon de commande</h2>
            <p class="section-lead">Example of some Bootstrap table components.</p>

            <div class="row">
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <div class="card-header">
                            <h4>Nouveau Bon de commande</h4>
                        </div>
                        <form method="POST" action="{{ route('add_bon') }}" enctype="multipart/form-data">
                            @csrf
                            <div class="card-body">
                                <div class="form-group">
                                    <label>Opérateur</label>
                                    <select class="form-control" name="operateur" required>
                                        @foreach ($operateurs as $operateur)
                                            <option value="{{ $operateur->id }}">{{ $operateur->name }} -
                                                {{ $operateur->num_fiscal }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label>Autorité</label>
                                    <select class="form-control" name="autorite" required>
                                        @foreach ($autoritecontractantes as $autoritecontractante)
                                            <option value="{{ $autoritecontractante->id }}">
                                                {{ $autoritecontractante->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                    <label for="montant">Montant</label>
                                    <input type="text" class="form-control @error('montant') is-invalid @enderror"
                                        name="montant" value="{{ old('montant') }}" id="montant">
                                    @error('montant')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="image">Fichier image</label>
                                    <input type="file" class="form-control @error('image') is-invalid @enderror"
                                        name="image" value="{{ old('image') }}" id="image">
                                    @error('image')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                                <div class="form-group">
                                    <label for="video">Fichier vidéo</label>
                                    <input type="file" class="form-control @error('video') is-invalid @enderror"
                                        name="video" value="{{ old('video') }}" id="video">
                                    @error('video')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>
                            <div class="card-footer text-end">
                                <button class="btn btn-primary" type="submit">Valider</button>
                                <button class="btn btn-danger" type="reset">Annuler</button>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-12 col-md-6 col-lg-8">
                    <div class="card">
                        <div class="card-header">
                            <h4>Liste des bon de commande</h4>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered table-md">
                                    <tr>
                                        <th>#</th>
                                        <th>Opérateur</th>
                                        <th>Autorité</th>
                                        <th>Libelle</th>
                                        <th>Montant</th>
                                        <th>Image</th>
                                        <th>Video</th>
                                        <th>Action</th>
                                    </tr>
                                    <tr>
                                        <td>1</td>
                                        <td>Libelle fkjjdhdh</td>
                                        <td>ActiveX</td>
                                        <td>Mistere</td>
                                        <td>150000 fcfa</td>
                                        <td><a href="#">Lien</a></td>
                                        <td><a href="#">Lien</a></td>
                                        <td>
                                            <div class="table-links">
                                                <a href="#">
                                                    <li class="bullet"></li>Modifier
                                                </a><br>
                                                <a href="#"
                                                    onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément')">
                                                    <li class="bullet"></li>Supprimer
                                                </a>
                                            </div>
                                        </td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                        <div class="card-footer text-right">
                            <nav class="d-inline-block">
                                <ul class="pagination mb-0">
                                    <li class="page-item disabled">
                                        <a class="page-link" href="#" tabindex="-1"><i
                                                class="fas fa-chevron-left"></i></a>
                                    </li>
                                    <li class="page-item active"><a class="page-link" href="#">1 <span
                                                class="sr-only">(current)</span></a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#">2</a>
                                    </li>
                                    <li class="page-item"><a class="page-link" href="#">3</a></li>
                                    <li class="page-item">
                                        <a class="page-link" href="#"><i class="fas fa-chevron-right"></i></a>
                                    </li>
                                </ul>
                            </nav>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection
