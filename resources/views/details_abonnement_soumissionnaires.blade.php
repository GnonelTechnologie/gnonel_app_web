@extends('layouts.appwelcom')
@section('titre')
Gnonel - Operateur
@endsection
@section('content')
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
		  <p><b>FORMULE {{$abonnement->libelle}}</b></p>
		</div>
		<div class="container">
				    <div>
		        <p>{{$abonnement->description}}</p>
		    </div> 
		    <a href="{{ route('creer_abonne',$abonnement->libelle) }}" class="btn btn-primary float-right">S'abonner</a>
		  <a href="{{ route('details_abonnement',$abonnement->libelle) }}" class="btn btn-primary float-right" style="margin-right: 5px">Retour</a>
         
            <br>
		</div>	
		
@endsection
@section('script')
		<script>
		</script>
@endsection	
