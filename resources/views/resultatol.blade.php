<!DOCTYPE html>
<html lang="fr">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Gnonel - Appels d'offres</title>
        <!-- Favicon-->
        <link rel="icon" type="image/x-icon" href="assets/favicon.ico" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
		    <link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
        <link href="{{ asset('assets/assetclient/css/styles.css') }}" rel="stylesheet" />
    </head>
    <body>
        <!-- Responsive navbar-->
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <div class="container px-5">
                <a class="navbar-brand" href="/"><h4><b>Gnonel</b></h4></a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                        <li class="nav-item"><a class="nav-link active" aria-current="page" href="#!">Accueil</a></li>
                        <li class="nav-item"><a class="nav-link" href="#offre">Appels d'Offres</a></li>
						<li class="nav-item"><a class="nav-link" href="#">Services</a></li>
						@guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">S'authentifier</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">S'enrégistrer</a>
                                </li>
                            @endif
                        @else
							<li class="nav-item dropdown">
								<a class="nav-link dropdown-toggle" id="navbarDropdown" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">{{ Auth::user()->name }}</a>
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
							</li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>
        <!-- Page Content-->
		<!-- Product section-->
        <section class="py-5">
            <div class="container px-4 px-lg-5 my-1">
				<div class="row my-3">
					<h4 class="font-weight-light"><b>Recherche</b></h4>
					<small id="emailHelp" class="form-text text-muted">Résultat de votre recherche, <a href="{{ route('welcome') }}"><b>Toutes Les Offres</b></a></small>
				</div>
                <div class="row gx-4 gx-lg-5 align-items-center">
                    <div class="col-md-12">
						<form method="POST" action="{{ route('recherche') }}">
						@csrf
						<form>
							<div class="row">
								<!-- <div class="col-lg-4">
									<div class="form-group">
									<label for="date_publication">Publication</label>
									<input type="date" class="form-control" id="date_publication" value="{{$data['date_publication']}}" required name="date_publication">
									<small id="emailHelp" class="form-text text-muted">Date de publication.</small>
								  </div>
								</div>
								<div class="col-lg-4">
									<div class="form-group">
									<label for="date_cloture">Cloture</label>
									<input type="date" class="form-control" id="date_cloture" value="{{$data['date_cloture']}}" required name="date_cloture">
									<small id="emailHelp" class="form-text text-muted">Date de cloture.</small>
								  </div>
								</div> -->
								<div class="col-lg-4">
								  <div class="form-group">
								  	<label for="pays">Pays</label>
									<select class="form-control" name="pays" required>
										@foreach($pays as $pay)
											<option value="{{$pay->id}}" <?php if($pay->id == $data['pays']){ ?> selected <?php } ?>>{{$pay->nom_pays}}</option>
										@endforeach
									</select>
									<small id="emailHelp" class="form-text text-muted">Pays d'origine de l'offre.</small>
								  </div>
								</div>
								<!-- <div class="col-lg-4">
									<div class="form-group">
										<label for="categorie">Type d'offre</label>
										<select class="form-control" name="categorie" required>
											@foreach($categories as $categorie)
												<option value="{{$categorie->id}}" <?php if($categorie->id == $data['categorie']){ ?> selected <?php } ?>>{{$categorie->nom_categorie}}</option>
											@endforeach
										</select>
										<small id="emailHelp" class="form-text text-muted">Type d'offre.</small>
									</div>
								</div> -->
								<!-- <div class="col-lg-4">
								  <div class="form-group">
									<label for="exampleInputEmail1">Autorité Contractante</label>
									<select class="form-control" name="autorite">
										@foreach($autoritecontractantes as $autoritecontractante)
											<option value="{{$autoritecontractante->id}}" <?php if($autoritecontractante->id == $data['autorite']){ ?> selected <?php } ?>>{{$autoritecontractante->name}}</option>
										@endforeach
									</select>
									<small id="emailHelp" class="form-text text-muted">Autorité Contractante originaire de l'offre.</small>
								  </div>
								</div> -->
								<div class="col-lg-4">
								  <div class="form-group">
								  <label for="exampleInputEmail1"></label>
									<button type="submit" class="btn btn-primary form-control">CONSULTER</button>
								  </div>
								</div>
							</div>
						</form>
					</div>
                    <div class="col-md-12 mt-3">
						<table id="example" class="table table-bordered" style="width:100%">
							<thead>
								<tr>
									
									<th>Intitulé de l'offre</th>
									<th>Autorité Conctante</th>
									<th>Pays</th>
									<th>Date publication</th>
									<th>Date de clôture</th>
									<th></th>
								</tr>
							</thead>
							<tbody>
								@foreach($offres as $offre)
								<tr>
									<td>{{$offre->libelle_appel}}</td>
									<td>{{$offre->name}}</td>
									<td>{{$offre->nom_pays}}</td>
									<td>
										<?php $datep = new DateTime($offre->date_publication) ?>
										{{$datep->format('d-m-Y')}}
									</td>
									<td>
										<?php $datep = new DateTime($offre->date_cloture) ?>
										{{$datep->format('d-m-Y')}}
									</td>
									<td><a href="{{ route('Details',$offre->id) }}" title="Plus de détails"><img class="img-fluid rounded mb-4 mb-lg-0" src="{{ asset('assets/assetclient/folder-plus.svg') }}" alt="..." /></a></td>
								</tr>
								@endforeach
							<tbody>
							<tfoot>
								<tr>
									
									<th>Intitulé de l'offre</th>
									<th>Autorité Conctante</th>
									<th>Pays</th>
									<th>Date publication</th>
									<th>Date de clôture</th>
									<th></th>
								</tr>
							</tfoot>
						</table>
                    </div>
                </div>
            </div>
        </section>
        <!-- Footer-->
        <footer>
			<hr>
            <div class="container px-4 px-lg-5"><p class="m-0 text-center my-2">Copyright &copy; gnonel.com 2022</p></div>
        </footer>
        <!-- Bootstrap core JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
        <!-- Core theme JS-->
        <script src="{{ asset('assets/assetclient/js/scripts.js') }}"></script>
        <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
        <script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>
        <script>
          $(document).ready(function () {
            $('#example').DataTable();
          });
        </script>
    </body>
</html>