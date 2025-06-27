@extends('layouts.appwelcom')
@section('titre')
Abonnement
@endsection
@section('content')
<style type="text/css">
  
.card-custom {
  overflow: hidden;
  min-height: 350px;
  box-shadow: 0 0 15px rgba(10, 10, 10, 0.3);
}

.card-custom-img {
  height: 100px;
  min-height: 100px;
  background-repeat: no-repeat;
  background-size: cover;
  background-position: center;
  border-color: inherit;
}

/* First border-left-width setting is a fallback */

legend {
  background-color:#3fa46a;
  color: #fff;
  padding: 3px 6px;
}
input {
  margin: 0.4rem;
}

</style>
<div style="width: 100%;height: 600px;border-bottom: 4px solid;margin-top: -59px;border-color:#3fa46a;border-bottom-right-radius:350px;background-image:url('{{ asset('assets/img/Gnonel_image(11).png') }}');background-size: cover;padding-top: 45px;background-position: -65px; " class="bg-primary">
       @if(session()->has('message'))
          <div class="container" style="z-index: 1000">
            <div class="row">
              <div class=" col-lg-12 bg-warning" id="message" style="height: 50px;font-size: 15px;border-radius: 10px">
                 <center><span style="margin-top: 12px;color: white;font-size: 28px"><b>{{session()->get('message')}}</b></span> </center>
              </div>
            </div>
          </div>
       @endif
            <center>
              <div style="margin: 20px;background-color:#3ccefa;width: 350px;height: 150px;    padding: 48PX;opacity: 0.7;margin-top:200px;border-radius: 10px; ">
               <span style="margin-bottom: 35px"><h1 style="color: white;">Nos Tarifs</h1></span>
              </div>
            </center>          
</div>
</br></br>
<?php 

if(isset($_GET['affiliation'])){
  session_start();
  $_SESSION['affiliation']=$_GET['affiliation'];
}
?>
<div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
		  <p>Veuillez choisir une formule d’abonnement et profiter de nombreux avantages</p>
      <p style="font-size: 15px;">Pour la sécurité de vos paiements, les transactions sont soumises à la norme internationale PCI-DSS et le protocole de sécurité 3D Secure de CINETPAY</p>
		</div>
   
		<div class="container">
      <div class="row">    
        <hr> 
        @foreach($categories as $categorie)
        <div class="col-lg-6 ">  
          <fieldset >
           <legend class="font-weight-bold" style="width: 97%;">{{$categorie->libelle}}</legend>
           <div class="row" style="margin-bottom: 30px">
            @foreach(\Illuminate\Support\Facades\ DB::table('abonnement')->where('categorie',$categorie->id)->get() as $abonnement) 
            <div class="col-lg-6 categorie" style="margin-right:-15px"> 
<div class="card card-custom bg-white border-white border-0" style="height: 100px;border-radius:20px ">
              <div class="card-custom-img" style="background-color: #0c43cc;color: white;padding: 10px"><div class="card-custom-avatar" style="padding-left:10px;font-weight: 400px;font-size: 25px;">
                <span style="font-size:14px">Tarif annuel</span><br>
                <b style="color: white" class="font-weight-bold" style="font-size:16PX;FLOAT: RIGHT;">{{number_format($abonnement->prix, 0, '.', ' ')}}{{$abonnement->monnaie}}</b>
              </div>
            </div>
              
              <div class="card-body" style="overflow-y: auto">
                <h4 >{{$abonnement->libelle}}</h4>
                <p class="card-text" style="font-size: 10px">{{$abonnement->description}}</p>
              </div>
              <div class="card-footer" style="padding: 6px;position: absolute;BOTTOM: 2PX;width: 100%;">
                <a href="{{ route('nos_service') }}" class="btn btn-primary">Voir avantage</a>
                <a href="{{ route('creer_abonne',$abonnement->libelle) }}" class="btn btn-outline-primary">S'abonner</a>
              </div>
            </div>
                
           </div>
           @endforeach
           </div>
           <div class="card-columns">
            
            </div>
            </fieldset>
        </div>  
        @endforeach
      </div>
       </div>
  
    
   
       
 
 
  
		 
@endsection
@section('script')
		<script>

		</script>
@endsection		
