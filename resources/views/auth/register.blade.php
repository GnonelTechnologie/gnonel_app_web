@extends('layouts.auth_layout')
@section('title')
    Inscription
@endsection
@section('content')
    <div class="col-md-8 col-lg-8 col-xl-6">
        <div class="card bg-pattern">

            <div class="card-body p-4">
                <div class="text-center w-75 m-auto">
                    <div class="auth-logo">
                        <a href="/" class="logo logo-dark text-center">
                            <span class="logo-lg">
                                <img src="/frontoffice/images/logo.png" alt="" height="50">
                            </span>
                        </a>

                        <a href="/" class="logo logo-light text-center">
                            <span class="logo-lg">
                                <img src="/frontoffice/images/logo.png" alt="" height="22">
                            </span>
                        </a>
                    </div>
                    <p class="text-muted mb-4 mt-3">Créer un compte maintenant pour profiter de nos services.</p>
                </div>


                <form action="{{ route('register') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="name" class="form-label">Nom et Prénoms</label>
                                <input class="form-control @error('name') is-invalid @enderror" value="{{ old('name') }}"
                                    type="text" name="name" id="name" required
                                    placeholder="Tapez votre nom complet" autofocus autocomplete="name">
                                @error('name')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="emailaddress" class="form-label">Email</label>
                                <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                                    type="email" name="email" id="emailaddress" required
                                    placeholder="Tapez votre adresse email" autocomplete="email">
                                @error('email')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="password" class="form-label">
                                    Mot de passe
                                </label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password" class="form-control" name="password"
                                        placeholder="Tapez votre mot de passe" required autocomplete="new-password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                                @error('password')
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $message }}</strong>
                                    </span>
                                @enderror
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">
                                    Confirmation
                                </label>
                                <div class="input-group input-group-merge">
                                    <input type="password" id="password-confirm" class="form-control"
                                        name="password_confirmation" placeholder="Tapez votre mot de passe" required
                                        autocomplete="new-password">
                                    <div class="input-group-text" data-password="false">
                                        <span class="password-eye"></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    {{-- <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="password-confirm" class="form-label">
                                    Choisir le pays
                                </label>
                                <div class="input-group input-group-merge">
                                    <select class="form-control" name="pays" required>
                                        <option value="0" disabled="true" selected="true">--- Sélectionner le pays ---
                                        </option>
                                        @foreach (getAllPays() as $pay)
                                            <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                        </div>
                    </div> --}}
                    <hr>
                    <h5>Informations d'opérateur économique</h5>
                    <br>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="nomop" class="form-label">Nom/raison sociale</label>
                                <input class="form-control" id="nomop" type="text" name="nomop" required
                                    placeholder="">
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="sector" class="form-label">Secteur d'activité</label>
                                <select class="form-control" id="sector" name="secteur" required>
                                    <option value="" disabled="true" selected="true">--- Sélectionner ---
                                    </option>
                                    @foreach (getSecteurActivites() as $secteur_activite)
                                        <option value="{{ $secteur_activite->idsecteuractivite }}">
                                            {{ $secteur_activite->libellesecteuractivite }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="pays" class="form-label">Pays</label>
                                <select class="form-control" id="pays" name="paysop" required>
                                    <option value="" disabled="true" selected="true">--- Sélectionner ---
                                    </option>
                                    @foreach (getAllPays() as $pay)
                                        <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-lg-6">
                            <div class="mb-3">
                                <label for="rccm" class="form-label">Numéro RCCM</label>
                                <input class="form-control" id="rccm" name="numop" type="text" required
                                    placeholder="">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="mb-3">
                                <label for="phone" class="form-label">Téléphone</label>
                                <input class="form-control" id="phone" name="autreop" type="text"
                                    placeholder="">
                            </div>
                        </div>
                    </div>

                    <div class="text-center d-grid">
                        <button class="btn btn-primary" type="submit">S'inscrire</button>
                    </div>

                </form>

                <div class="text-center mt-3">
                    <p class="text-black-50">Avez-vous déjà un compte? <a href="{{ route('login') }}"
                            class="text-black ms-1"><b>Connectez-vous</b></a></p>
                </div>

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

    </div> <!-- end col -->
@endsection
