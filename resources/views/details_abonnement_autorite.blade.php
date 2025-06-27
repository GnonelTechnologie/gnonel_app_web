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
		  <h5 class="display-5"><b>FORMULE « PRO »</b></h5>
		</div>	
		<div class="container">
		    <div>
		        <p>Fini les recherches interminables dans les offres techniques en papier lors de l’analyse des offres. Cette formule (disponible en version nationale ACL et internationale ACI) est conçue pour les acteurs de la passation des Marchés au sein des Autorités Contractantes. Elle vous permet d’accéder directement à la liste des références techniques de vos soumissionnaires pour mieux comparer les soumissionnaires.
				Fini également les doutes sur l’authenticité des références techniques des soumissionnaires car les Relevés de REFERENCES TECHNIQUES sont vérifiés et « certifiés ».
				Souscrire à cette formule et profiter des avantages ci-après :
				<p>
		        <ul>
		            <li>Gagner du temps lors de l’analyse des offres en accédant directement au RELEVE DE REFERENCES TECHNIQUES des soumissionnaires nationaux et internationaux ;</li>
		            <li>L’assurance sur l’authenticité des références techniques des soumissionnaires ;</li>
		            <li>Recevoir des Newsletter sur toutes les publications des appels à concurrence.</li>
		        </ul>
		        <br>
		        <p>En version nationale, vous pourrez visualiser toutes les publications des références techniques des milliers d’opérateurs économiques exerçant dans votre pays.</p>
		        <p>En version internationale, vous pourrez visualiser toutes les publications des références techniques des milliers d’opérateurs économiques exerçant dans votre pays et hors de votre pays.</p>
		    </div>
		    <button class="btn float-right m-1" type="submit" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'><b>Retour</b></button>
            <button class="btn float-right m-1" type="submit" style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'><b>S'abonner</b></button>
            <br>
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
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="{{ asset('assets_recherche/css/jquery-3.2.1.slim.min.js') }}"></script>
		<script src="{{ asset('assets_recherche/css/popper.min.js') }}"></script>
		<script src="{{ asset('assets_recherche/css/bootstrap.min.js') }}"></script>
	</body>
</html>