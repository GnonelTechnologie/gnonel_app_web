@extends('layouts.auth_layout')
@section('title')
    Mot de passe oublié
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
                    <p class="text-muted mb-4 mt-3">Nous vous enverrons un
                        mail contenant les instructions pour réinitialiser votre mot de passe.</p>
                </div>


                <form action="{{ route('sendEmailPass') }}" method="POST">
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

                    <div class="text-center d-grid">
                        <button class="btn btn-primary" type="submit"> Réinitialiser </button>
                    </div>

                </form>

                <div class="text-center mt-3">
                    <p class="text-black-50">Avez-vous un compte? <a href="{{ route('login') }}"
                            class="text-black ms-1"><b>Connectez-vous</b></a></p>
                </div>

            </div> <!-- end card-body -->
        </div>
        <!-- end card -->

    </div> <!-- end col -->
@endsection
