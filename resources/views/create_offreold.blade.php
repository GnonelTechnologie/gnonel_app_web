@extends('layouts.app')



@section('content')
    <section class="section">

        <div class="section-header">

            <h1>Gestionaire d'offres</h1>

            <div class="section-header-breadcrumb">

                <div class="breadcrumb-item active"><a href="#">Dashboard</a></div>

                <div class="breadcrumb-item"><a href="#">Forms</a></div>

                <div class="breadcrumb-item">Form Validation</div>

            </div>

        </div>



        <div class="section-body">

            <h2 class="section-title">Nouvelle appel d'offre</h2>

            <p class="section-lead">

                Form validation using default from Bootstrap 4

            </p>



            <div class="row">

                <div class="col-12 col-md-6 col-lg-12">

                    <div class="card">

                        <div class="card-header">

                            <h4>Default Validation</h4>

                        </div>

                        <form method="POST" action="{{ route('add_offre') }}">

                            @csrf

                            <div class="card-body">

                                <div class="row">

                                    <div class="col">

                                        <div class="form-group">

                                            <label for="libelle">libelle de l'appel d'offre</label>

                                            <input type="text"
                                                class="form-control @error('libelle') is-invalid @enderror" name="libelle"
                                                value="{{ old('libelle') }}" id="libelle">

                                            @error('libelle')
                                                <span class="invalid-feedback" role="alert">

                                                    <strong>{{ $message }}</strong>

                                                </span>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col">

                                        <div class="form-group">

                                            <label>Autorité contractante</label>

                                            <select class="form-control" name="autorite" required>

                                                @foreach ($autoritecontractantes as $autoritecontractante)
                                                    <option value="{{ $autoritecontractante->id }}">
                                                        {{ $autoritecontractante->name }}</option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col">

                                        <div class="form-group">

                                            <label>Catégorie</label>

                                            <select class="form-control" name="categorie" required>

                                                @foreach ($categories as $categorie)
                                                    <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}
                                                    </option>
                                                @endforeach

                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col">

                                        <div class="form-group">

                                            <label for="date_publication">Date de publication</label>

                                            <input type="date"
                                                class="form-control @error('date_publication') is-invalid @enderror"
                                                name="date_publication" value="{{ old('date_publication') }}"
                                                id="date_publication">

                                            @error('date_publication')
                                                <span class="invalid-feedback" role="alert">

                                                    <strong>{{ $message }}</strong>

                                                </span>
                                            @enderror

                                        </div>

                                    </div>

                                    <div class="col">

                                        <div class="form-group">

                                            <label for="date_cloture">Date de Clôture</label>

                                            <input type="date"
                                                class="form-control @error('date_cloture') is-invalid @enderror"
                                                name="date_cloture" value="{{ old('date_cloture') }}" id="date_cloture">

                                            @error('date_cloture')
                                                <span class="invalid-feedback" role="alert">

                                                    <strong>{{ $message }}</strong>

                                                </span>
                                            @enderror

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col">

                                        <div class="form-group">

                                            <label for="source">Source</label>

                                            <input type="text" class="form-control @error('source') is-invalid @enderror"
                                                name="source" value="{{ old('source') }}" id="source">

                                            @error('source')
                                                <span class="invalid-feedback" role="alert">

                                                    <strong>{{ $message }}</strong>

                                                </span>
                                            @enderror

                                        </div>

                                    </div>

                                </div>



                                <div class="form-group">

                                    @error('description')
                                        <span class="invalid-feedback" role="alert">

                                            <strong>{{ $message }}</strong>

                                        </span>
                                    @enderror

                                    <label for="description">Description </label>

                                    <textarea id="description" type="text" name="description" style="height: 200px;"
                                        class="form-control @error('image') is-invalid @enderror" value="{{ old('description') }}" id="description"></textarea>



                                </div>



                            </div>

                            <div class="card-footer text-right">

                                <button class="btn btn-primary" type="submit">Valider</button>

                                <button class="btn btn-danger" type="reset">Annuler</button>

                            </div>

                        </form>

                    </div>

                </div>

            </div>

        </div>

    </section>

    @if (Session::has('add_ok'))
        <script>
            alert('Offre enrégistrée')
        </script>
    @endif
@endsection
