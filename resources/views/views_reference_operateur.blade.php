<!doctype html>
<html lang="fr">
	<head>
		<!-- Required meta tags -->
		<meta charset="UTF-8">
		<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        
        <link rel="icon" href="{{ asset('assets/img/logo.png') }}">
		<!-- Bootstrap CSS -->
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
			<a class="p-2 text-dark" href="#">Features</a>
			<a class="p-2 text-dark" href="#">Enterprise</a>
			<a class="p-2 text-dark" href="#">Support</a>
			<a class="p-2 text-dark" href="#">Pricing</a>
		  </nav>
		  <a class="btn btn-outline-primary" href="#">Sign up</a>
		</div>
		<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
		  <h5 class="display-5">PROFIL GNONEL</h5>
		  <p><b>SOCIETE FOLLY SARL GN1_100001</b></p>
		  <p><b>MES REFERENCES TECHNIQUES</b></p>
		</div>
		<div class="container">
			<div class="my-5">
				<h6>Année : 2022 <span class="badge badge-primary float-right"> <span class="badge badge-light">10</span></span></h6>
				<table class="table table-bordered">
				  <thead>
					<tr>
					  <th scope="col">REF MARCHES</th>
					  <th scope="col">LIBELLES</th>
					  <th scope="col">AUTORITE CONTRACTANTE</th>
					  <!--<th scope="col">EXECUTION</th>-->
					  <th scope="col"></th>
					</tr>
				  </thead>
				  <tbody>
					<tr>
					  <th scope="row">00144555</th>
					  <td>Livraison de 500 tablette</td>
					  <td>TOGOCEL</td>
					  <td>OUI</td>
					  <td><a href="{{ route('details_reference') }}"><img class="" src="{{ asset('assets/img/icone_next.png') }}" alt="" width="25" height="25"></a></td>
					</tr>
					<tr>
					  <th scope="row">0015465456</th>
					  <td>Livraison des matériels informatiques : Les ordinateurs Livraison des matériels informatiques : Les ordinateurs</td>
					  <td>PRIMATURE - TOGO</td>
					  <td>OUI</td>
					  <td><a href="{{ route('details_reference') }}"><img class="" src="{{ asset('assets/img/icone_next.png') }}" alt="" width="25" height="25"></a></td>
					</tr>
					<tr>
					  <th scope="row">005545/855</th>
					  <td>Livraison de 500 tablette</td>
					  <td>TOGOCEL</td>
					  <td>OUI</td>
					  <td><a href="{{ route('details_reference') }}"><img class="" src="{{ asset('assets/img/icone_next.png') }}" alt="" width="25" height="25"></a></td>
					</tr>
					<tr>
					  <th scope="row">007/6465</th>
					  <td>Livraison de 500 tablette</td>
					  <td>TOGOCEL</td>
					  <td>OUI</td>
					  <td><a href="{{ route('details_reference') }}"><img class="" src="{{ asset('assets/img/icone_next.png') }}" alt="" width="25" height="25"></a></td>
					</tr>
					<tr>
					  <th scope="row">00154554545</th>
					  <td>Livraison de 500 tablette Livraison de 500 tabletteLivraison de 500 tablette</td>
					  <td>TOGOCEL</td>
					  <td>OUI</td>
					  <td><a href="{{ route('details_reference') }}"><img class="" src="{{ asset('assets/img/icone_next.png') }}" alt="" width="25" height="25"></a></td>
					</tr>
				  </tbody>
				</table>
			</div>
			<nav aria-label="Page navigation example">
			  <ul class="pagination">
				<li class="page-item">
				  <a class="page-link" href="#" aria-label="Previous">
					<span aria-hidden="true">&laquo;</span>
					<span class="sr-only">Previous</span>
				  </a>
				</li>
				<li class="page-item"><a class="page-link" href="#">1</a></li>
				<li class="page-item"><a class="page-link" href="#">2</a></li>
				<li class="page-item"><a class="page-link" href="#">3</a></li>
				<li class="page-item">
				  <a class="page-link" href="#" aria-label="Next">
					<span aria-hidden="true">&raquo;</span>
					<span class="sr-only">Next</span>
				  </a>
				</li>
			  </ul>
			</nav>
			<footer class="pt-4 my-md-5 pt-md-5 border-top">
				<div class="row">
				  <div class="col-12 col-md">
					<img class="mb-2" src="./Pricing example for Bootstrap_files/logo.png" alt="" width="50" height="50">
					<small class="d-block mb-3 text-muted">© 2022</small>
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
		<!-- Optional JavaScript -->
		<!-- jQuery first, then Popper.js, then Bootstrap JS -->
		<script src="{{ asset('assets_recherche/css/jquery-3.2.1.slim.min.js') }}"></script>
		<script src="{{ asset('assets_recherche/css/popper.min.js') }}"></script>
		<script src="{{ asset('assets_recherche/css/bootstrap.min.js') }}"></script>
	</body>
</html>