<!doctype html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

		<!-- Bootstrap CSS -->
		<link rel="icon" href="{{ asset('assets/img/logo.png') }}">
		<link rel="stylesheet" href="{{ asset('assets_recherche/css/bootstrap.min.css') }}">
		
		<title>Hello, world!</title>
	</head>
	<body>
        <div class="d-flex flex-column flex-md-row align-items-center p-3 px-md-4 mb-3 bg-white border-bottom box-shadow">
		  <h5 class="my-0 mr-md-auto font-weight-normal">
			<img class="mb-2" src="{{ asset('assets/img/logo.png') }}" alt="" width="25" height="25">
			Gnonel
		  </h5>
		  <nav class="my-5 my-md-0 mr-md-3">
			<a class="p-2 text-dark" aria-current="page" href="/dev">Accueil</a>
			<a class="p-2 text-dark" href="/dev/#offre">Appels d'Offres</a>
			@guest
			    <a class="p-2 text-dark" href="{{ route('login') }}">S'authentifier</a>
			    @if (Route::has('register'))
                                    <a class="p-2 text-dark" href="{{ route('choix_abonnement') }}">S'Abonner</a>
                           @endif
			   @else
                    <a class="p-2 text-dark dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="{{ route('home') }}">Mon Compte</a></li>
                            <li><a class="dropdown-item" href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                                document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </li>
                        </ul>

			@endguest
			<a class="p-2 text-dark" aria-current="page" href="{{ route('details_all_abonnement') }}">Comment-ça-marche</a>
		  </nav>
	    </div>
		<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
		  <h5 class="display-5">OFFRE GNONEL</h5>
		  <p>Faites le choix de l'offre qui vous convient</p>
		</div>
		<div class="container">
        <div class="modal fade" id="AbonnementModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Modal d'enégistrement -->
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                <div class="modal-body">
                <h5 class="modal-title" id="exampleModalLabel" style='color:#3232cc'>Information d'abonnement</h5>
				<hr style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff' data-toggle="modal" data-target=".bd-example-modal-lg">
                <form method="POST" action="{{ route('souscription') }}">
                    @csrf

                    <div class="form-group">

                        <label for="name">Nom et Prénoms</label>
                        <input id="name" type="text" class="form-control @error('name') is-invalid @enderror" name="name" value="{{ old('name') }}" required autocomplete="name" autofocus>
                        @error('name')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="email">{{ __('E-Mail Address') }}</label>
                        <input id="email" type="email" class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required autocomplete="email">

                        @error('email')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pays de référence</label>
                        <select class="form-control" name="pays" required>
                            <option value="0" disabled="true" selected="true">--- Sélectionner le pays ---</option>
                            @foreach($pays as $pay)
                                <option value="{{$pay->id}}">{{$pay->nom_pays}}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group ">
                        <label for="password">Mot de passe</label>
                        <input id="password" type="password" class="form-control @error('password') is-invalid @enderror" name="password" required autocomplete="new-password">

                        @error('password')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>

                    <div class="form-group">
                        <label for="password-confirm" >Confirmer le mot de passe</label>
                        <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required autocomplete="new-password">
                        
                    </div>

                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Pannier</label>
                        <select class="form-control" id="abonnement" name="abonnement">
                            @foreach($abonnements as $abonnement)
                                <option value="{{$abonnement->id}}">{{$abonnement->prix}} {{$abonnement->monnaie}} - {{$abonnement->libelle}}</option>
                            @endforeach
                        </select>
                    </div>

                    <button type="submit" class="btn btn-sm mt-3" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'>Envoyer</button>
                    <button class="btn btn-danger btn-sm mt-3" data-dismiss="modal" aria-label="Close">Annuler <span aria-hidden="true">&times;</span></button>
                </form>
                </div>
                </div>
            </div>
        </div>   
        <!-- Modal d'enégistrement -->
		<div class="card-deck mb-3 text-center row">
		<div class="card mb-4" style="max-width: 540px;">
		  <div class="row no-gutters">
			<div class="col-md-4">
			  <img src="{{ asset('assets/img/offreap.png') }}" class="card-img" alt="...">
			</div>
			<div class="col-md-8">
			  <div class="card-body">
				<h5 class="card-title">Soumissionnaires</h5>
                <b class="card-text"> 6 500 FCFA/An - Local</b>
                <b class="card-text">10 000 FCFA/An - International</b>
				<!--<p class="card-text"></p>-->
				<p class="card-text"><small class="text-muted">Abonnement à jour</small></p>
				<a type="button" href="{{ route('details_abonnement_soumissionnaires') }}" class="btn btn-sm" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'><b>Détails</b></a>
				<button type="button" class="btn btn-sm" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff' data-toggle="modal" data-target="#AbonnementModal"><b>S'abonner</b></button>
			  </div>
			</div>
		  </div>
		</div>
		<div class="card mb-4" style="max-width: 540px;">
		  <div class="row no-gutters">
			<div class="col-md-4">
			  <img src="{{ asset('assets/img/offreap.png') }}" class="card-img" alt="...">
			</div>
			<div class="col-md-8">
			  <div class="card-body">
				<h5 class="card-title">Autorité Contractantes</h5>
                <b class="card-text"> 6 500 FCFA/An - Local</b>
                <b class="card-text">10 000 FCFA/An - International</b>
				<!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
				<p class="card-text"><small class="text-muted">Abonnement à jour</small></p>
				<a type="button" href="{{ route('details_abonnement_autorite') }}" class="btn btn-sm" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'><b>Détails</b></a>
				<button type="button" class="btn btn-sm" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff' data-toggle="modal" data-target="#AbonnementModal"><b>S'abonner</b></button>
			  </div>
			</div>
		  </div>
		</div>
      </div>
	  <div class="card-deck mb-3 text-center row">
		<div class="card mb-4" style="max-width: 540px;">
		  <div class="row no-gutters">
			<div class="col-md-4">
			  <img src="{{ asset('assets/img/offreap.png') }}" class="card-img" alt="...">
			</div>
			<div class="col-md-8">
			  <div class="card-body">
				<h5 class="card-title">Mixte</h5>
                <b class="card-text">10 000 FCFA/An - Local</b>
                <b class="card-text">15 000 FCFA/An - International</b>
				<!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
				<p class="card-text"><small class="text-muted">Abonnement à jour</small></p>
				<a type="button" href="{{ route('details_abonnement_mixte') }}" class="btn btn-sm" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'><b>Détails</b></a>
				<button type="button" class="btn btn-sm" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff' data-toggle="modal" data-target="#AbonnementModal"><b>S'abonner</b></button>
			  </div>
			</div>
		  </div>
		</div>
		<div class="card mb-4" style="max-width: 540px;">
		  <div class="row no-gutters">
			<div class="col-md-4">
			  <img src="{{ asset('assets/img/offreap.png') }}" class="card-img" alt="...">
			</div>
			<div class="col-md-8">
			  <div class="card-body">
				<h5 class="card-title">Public</h5>
                <b class="card-text">0 FCFA/An - Local</b>
                <b class="card-text">0 FCFA/An - International</b>
				<!--<p class="card-text">This is a wider card with supporting text below as a natural lead-in to additional content. This content is a little bit longer.</p>-->
				<p class="card-text"><small class="text-muted">Abonnement à jour</small></p>
				<a type="button" href="{{ route('details_all_abonnement') }}" class="btn btn-sm" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'><b>Détails</b></a>
				<button type="button" class="btn btn-sm" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff' data-toggle="modal" data-target="#AbonnementModal"><b>S'abonner</b></button>
			  </div>
			</div>
		  </div>
		</div>
      </div>			
            <footer class="pt-4 my-md-5 pt-md-5 border-top">
				<div class="row">
				  <div class="col-12 col-md">
					<img class="mb-2" src="{{ asset('assets/img/logo.png') }}" alt="" width="50" height="50">
					<small class="d-block mb-3 text-muted">ï¿½ 2022</small>
				  </div>
				  <div class="col-6 col-md">
					<h5>Features</h5>
					<ul class="list-unstyled text-small">
					  <li><a class="text-muted" href="#">Cool stuff</a></li>
					  <li><a class="text-muted" href="#">Random feature</a></li>
					  <li><a class="text-muted" href="#">Team feature</a></li>
					  <li><a class="text-muted" href="#">Stuff for developers</a></li>
					  <li><a class="text-muted" href="#">Another one</a></li>
					  <li><a class="text-muted" href="#">Last time</a></li>
					</ul>
				  </div>
				  <div class="col-6 col-md">
					<h5>Resources</h5>
					<ul class="list-unstyled text-small">
					  <li><a class="text-muted" href="#">Resource</a></li>
					  <li><a class="text-muted" href="#">Resource name</a></li>
					  <li><a class="text-muted" href="#">Another resource</a></li>
					  <li><a class="text-muted" href="#">Final resource</a></li>
					</ul>
				  </div>
				  <div class="col-6 col-md">
					<h5>About</h5>
					<ul class="list-unstyled text-small">
					  <li><a class="text-muted" href="#">Team</a></li>
					  <li><a class="text-muted" href="#">Locations</a></li>
					  <li><a class="text-muted" href="#">Privacy</a></li>
					  <li><a class="text-muted" href="#">Terms</a></li>
					</ul>
				  </div>
				</div>
			</footer>
		</div>
		@if ($errors->has('email'))
			<p>{{ $errors->first('email') }}</p>
		@endif
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="{{ asset('assets_recherche/css/jquery-3.2.1.slim.min.js') }}"></script>
		<script src="{{ asset('assets_recherche/css/popper.min.js') }}"></script>
		<script src="{{ asset('assets_recherche/css/bootstrap.min.js') }}"></script>
	</body>
</html>