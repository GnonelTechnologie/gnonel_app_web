@extends('layouts.auth_layout')
@section('title')
    Connexion
@endsection
@section('content')
    <div class="col-md-8 col-lg-6 col-xl-4">
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
                    <p class="text-muted mb-4 mt-3">Entrez votre adresse email et votre mot de passe pour accéder à votre
                        compte.</p>
                </div>


                <form action="{{ route('login') }}" method="POST">
                    {{ csrf_field() }}
                    <div class="mb-3">
                        <label for="emailaddress" class="form-label">Email</label>
                        <input class="form-control @error('email') is-invalid @enderror" value="{{ old('email') }}"
                            type="email" name="email" id="emailaddress" required placeholder="Tapez votre adresse email"
                            autofocus>
                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label d-block">
                            Mot de passe
                            <a href="/reinitialisation" class="text-black ms-1 float-end">Mot de passe oublié?</a>
                        </label>
                        <div class="input-group input-group-merge">
                            <input type="password" id="password" class="form-control" name="password"
                                placeholder="Tapez votre mot de passe" required>
                            <div class="input-group-text" data-password="false">
                                <span class="password-eye"></span>
                            </div>
                        </div>
                        <div class="invalid-feedback">
                            Veuillez saisir votre mot de passe
                        </div>
                    </div>

                    <div class="mb-3">
                        <div class="form-check">
                            <input type="checkbox" class="form-check-input" id="checkbox-signin" checked>
                            <label class="form-check-label" for="checkbox-signin">Se rappeler de moi</label>
                        </div>
                    </div>

                    <div class="text-center d-grid">
                        <button class="btn btn-primary" type="submit"> Se Connecter </button>
                    </div>

                </form>

                <div class="text-center mt-3">
                    <p class="text-black-50">Vous n'avez pas de compte? <a href="{{ route('register') }}"
                            class="text-black ms-1"><b>S'inscrire gratuitement</b></a></p>
                </div>

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

    </div> <!-- end col -->
@endsection
