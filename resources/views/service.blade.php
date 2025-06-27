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
  background-color: #000;
  color: #fff;
  padding: 3px 6px;
}

input {
  margin: 0.4rem;
}
.a{
  text-decoration: none;
  color: white;
}
.a:hover{
  text-decoration: none;
  color: white;
}

</style>
<div style="width: 100%;height: 600px;border-bottom: 4px solid;margin-top: -55px;border-color:#3fa46a;border-bottom-right-radius:350px;background-image:url('{{ asset('assets/img/Gnonel_image(9).png') }}');background-size: cover;padding-top: 45px;background-position: -6px;    background-size: 85%;" class="bg-primary">
            <center>
              <div style="margin: 20px;background-color:#3ccefa;width: 350px;height: 150px;    padding: 48PX;opacity: 0.7;margin-top:200px;border-radius: 10px; ">
               <span style="margin-bottom: 35px"><h1 style="color: white;">Nos Services</h1></span>
              </div>
            </center>          
</div>
</br></br>   
<center><span style="color: #3fa46a;margin-top:100px">Choisissez votre plan</span></center>
              <center><h1 style="color: #1b87fa;">Profitez de nombreux avantages</h1></center>
                </br>
   <div style="width: 100%;background-color: white;">
  <div class="container">     
 
      <div class="row" style="padding: 20px">
    <div class="col-lg-3">
    <div style="width: 200px;border:2px solid;border-radius: 7px;border-color:#1b87fa;background-color:#3fa46a;height: 255px"> 
      <center><img  src="{{ asset('assets/img/icone_gnonel(15).svg') }}"></center>
      <center><h5 style="color: white">Les formules Business</h5></center>
      <center>Spécialement conçue pour les opérateurs économiques qui souhaitent soumissionner aux appels à concurrence</center>
    </div>
    </div>
    <div class="col-lg-3">
      <div style="width: 200px;border:2px solid;border-radius: 7px;border-color:#1b87fa;height: 255px;"> 
      <center><img  src="{{ asset('assets/img/icone_gnonel(10).svg') }}"></center>
      <center><h5 style="color: #3fa46a">Les Formules PRO</h5></center>
      <center>Les formules PRO sont conçues pour les professionnels (Spécialistes de la Passation des Marchés)</center>
    </div> 
    </div>
    <div class="col-lg-3">
    <div style="width: 200px;border:2px solid;border-radius: 7px;border-color:#1b87fa;height: 255px">  
      <center><img  src="{{ asset('assets/img/icone_gnonel(13).svg') }}"></center>
      <center><h5 style="color: #3fa46a">Les Formules MIX</h5></center>
      <center>Formules idéales pour les grandes entreprises. Elles combinent les avantages des formules business et ceux des formules PRO. </center>
    </div> 
    </div>
    <div class="col-lg-3"> 
      <div style="width: 200px;border:2px solid;border-radius: 7px;border-color:#1b87fa;height: 255px";height: 255px> 
      <center><img  src="{{ asset('assets/img/icone_gnonel(12).svg') }}"></center>
      <center><h5 style="color: #3fa46a">Les Options</h5></center>
      <center>gnonel vous offre des options pour compléter votre offre de base « déjà intéressante.»</center>
    </div> 
    </div>

      </div>
  </div>
  </div> 
<div class="container" style="margin-top: 60px">
  <div class="row">
    <div id="business" style="border-bottom: 4px solid;border-bottom-color:#3fa46a;margin-bottom:25px;width: 99%;margin-left:10px ">
      <span style="color: #1b87fa;"><h1>Les Formules Business</h1></span>
    </div>
    </br></br>
    <div style="margin-bottom: 20px">
 Elles sont conçues pour les opérateurs économiques qui participent aux appels à concurrence lancés par le secteur public, les grandes entreprises et les institutions, …
Choisissez une de ses formules qui vous convient et vous mettrez en valeur votre véritable expérience dans l’exécution des marchés dans votre secteur d’activité.

    </div>
    <div class="col-lg-6">
      <div style="background-color : #1b87fa;">
      <span style="color: white"><h1>Les avantages</h1></span>
    </div>
     <div style="background-color :white;padding-bottom: 20PX;margin-top: -10PX;padding-right: 25PX;padding-top: 15px;border-radius: 8px;height:500px;" class="shadow-sm p-3 mb-5">

      <ul>
        <li>Les références techniques de votre entreprise sont désormais consultables au bon endroit et à tout moment par les acheteurs publics et institutionnels ;</li>
        <li>Renforcer votre crédibilité vis-à-vis des acheteurs publics et institutionnels ;</li>
        <li>Vous pouvez consulter la totalité des publications des appels d’offre dans plusieurs pays ;</li>
        <li>Augmenter la visibilité de votre entreprise à travers une communication ciblée.</li>
      </ul>
     <div>
       *En version locale, vos publications de références techniques sont consultables par les acheteurs publics et institutionnels de votre pays.<br>
**En version internationale, vos publications de références techniques sont consultables par les acheteurs publics et institutionnels de votre pays et à l’international.
     </div> 
     <button class="btn btn-primary" style="margin-left:15px;margin-top: 20px"><a href="{{route('choix_abonnement')}}" class="a">S'abonner</a></button>
    </div>

    </div>
   
    <div class="col-lg-6" >
       <br><br>
      <div  style="width: 100%;background-image: url('{{ asset('assets/img/Gnonel_image(10).png') }}');margin-left: -50px;border-radius: 40px;border:solid 2px;border-color:#3fa46a;background-position: center;background-size: contain;height: 400px">
     </div>
    </div>
  </div>
</div>






<div class="container" style="margin-top: 60px">
  <div class="row">
    <div id="Pro" style="border-bottom: 4px solid;border-bottom-color:#3fa46a;margin-bottom:25px;width: 99%;margin-left:10px ">
      <span style="color: #1b87fa;"><h1>Les formules PRO</h1></span>
    </div>
    </br></br>
    <div style="margin-bottom: 20px">
 Finies les recherches interminables sur les capacités techniques (références techniques) des soumissionnaires. Les formules PRO sont conçues pour les professionnels (Spécialistes de la Passation des Marchés) au sein des Autorités Contractantes. Grace à cette formule, vous pouvez accéder directement aux références techniques des milliers d’opérateurs économiques.

    </div>
  <div class="col-lg-6" >
       <br><br>
      <div  style="width: 100%;background-image: url('{{ asset('assets/img/Gnonel_image(12).png') }}');margin-left:30px;border-radius: 40px;border:solid 2px;border-color:#3fa46a;background-size: cover;height: 400px;position: absolute;z-index: 100">
     </div>
    </div>
    <div class="col-lg-6">
      <div style="background-color : #1b87fa;">
      <span style="color: white"><h1>Les avantages</h1></span>
    </div>
     <div style="background-color :white;padding-bottom: 20PX;margin-top: -10PX;padding-left: 37PX!important;padding-top: 15px;border-radius: 8px;height:500px" class="shadow-sm p-3 mb-5">

      <ul>
        <li>Avec le relevé de références techniques, vous gagnez un temps considérable lors des consultations des opérateurs économiques ;</li>
        <li>Vous avez l’assurance sur l’authenticité des références techniques des soumissionnaires ;</li>
        <li>Vous disposez de meilleures informations sur les soumissionnaires ;</li>
        <li>Vous pouvez consulter la totalité des publications d’appels d’offre dans plusieurs pays.</li>
      </ul>
     <div>

      *En version locale, vous pouvez consulter les références techniques des soumissionnaires de votre pays.<br>
**En version internationale en plus des références techniques de votre pays, vous pouvez consulter les références techniques des soumissionnaires hors de votre pays.
     </div> 
     <button class="btn btn-primary" style="margin-left:15px;margin-top: 20px"><a href="{{route('choix_abonnement')}}" class="a">S'abonner</a></button>
    </div>

    </div>
    
  </div>
</div>










<div class="container" style="margin-top: 60px">
  <div class="row">
    <div id="Premium" style="border-bottom: 4px solid;border-bottom-color:#3fa46a;margin-bottom:25px;width: 99%;margin-left:10px ">
      <span style="color: #1b87fa;"><h1>Les Formules MIX</h1></span>
    </div>
    </br></br>
    <div style="margin-bottom: 20px">
Elles sont disponibles en version locale et internationale. Formules idéales pour les grandes entreprises qui participent aux appels à concurrence en tant que soumissionnaire mais également procèdent aux appels à concurrence pour leurs propres acquisitions. 

    </div>
    <div class="col-lg-6">
      <div style="background-color : #1b87fa;">
      <span style="color: white"><h1>Les avantages</h1></span>
    </div>
     <div style="background-color :white;padding-bottom: 20PX;margin-top: -10PX;padding-right: 25PX;padding-top: 15px;border-radius: 8px;height:500px" class="shadow-sm p-3 mb-5">

      <ul>
        <li>Consulter directement et en toute sérénité, les références techniques des soumissionnaires locaux comme internationaux ;</li>
        <li>Gagner du temps lors des travaux de consultation et d’analyse des offres ;</li>
        <li>Valoriser vos expériences acquises dans l’exécution des marchés ;</li>
        <li>Augmenter votre crédibilité vis-à-vis des autorités contractantes ;</li>
        <li>Accroitre la visibilité de la société.</li>
      </ul>
     <div>
*En version locale, vos publications de références techniques sont consultables par les autorités contractantes de votre pays et en retour vous pourrez consulter les publications de références techniques des opérateurs économiques de votre payss<br>
**En version internationale, vos publications de références techniques seront visibles par les autorités contractantes de votre pays et hors de votre pays. Vous accéderez en retour aux références techniques des opérateurs économiques de votre pays et hors de votre pays.

     </div> 
     <button class="btn btn-primary" style="margin-left:15px;margin-top: 20px"><a href="{{route('choix_abonnement')}}" class="a">S'abonner</a></button>
    </div>

    </div>
     <div class="col-lg-6" >
       <br><br>
      <div  style="width: 100%;background-image: url('{{ asset('assets/img/Gnonel_image(9).png') }}');margin-left: -50px;border-radius: 40px;border:solid 2px;border-color:#3fa46a;background-position: center;background-size: contain;height: 400px">
     </div>
    </div>
  </div>
</div>













<div class="container" style="margin-top: 60px">
  <div class="row">
    <div style="border-bottom: 4px solid;border-bottom-color:#3fa46a;margin-bottom:25px;width: 99%;margin-left:10px ">
      <span style="color: #1b87fa;"><h1>Les options</h1></span>
    </div>
    </br></br>
    <div style="margin-bottom: 20px">
 Il est mis à votre disposition, des options pour compléter vos fonctionnalités de base déjà intéressantes. Pour profiter de ces options vous devez être abonné à une des formules de base proposées. Il s’agit des options d’accès à la vitrine des spécifications techniques.
    </div>
  <div class="col-lg-6" >
       <br><br>
      <div  style="width: 100%;background-image: url('{{ asset('assets/img/Gnonel_image(10).png') }}');margin-left:30px;border-radius: 40px;border:solid 2px;border-color:#3fa46a;background-size: cover;height: 400px;position: absolute;z-index: 100">
     </div>
    </div>
    <div class="col-lg-6">
      <div style="background-color : #1b87fa;">
      <span style="color: white"><h1>Les avantages</h1></span>
    </div>
     <div style="background-color :white;padding-bottom: 20PX;margin-top: -10PX;padding-left: 37PX!important;padding-top: 15px;border-radius: 8px;height:500px" class="shadow-sm p-3 mb-5">

      <ul>
        <li>Permettre aux acteurs de la passation des marchés de retrouver rapidement des spécifications techniques déjà réalisées par d’autres acteurs et l’adapter à son cas ;</li>
        <li>Donner la chance aux consultants et aux SPM de monétiser les spécifications techniques que ces derniers auront mis en ligne;</li>
        <li>De faciliter la rédaction des cahiers de charge à travers les spécifications techniques mises en ligne. </li>
      </ul>
     <div>
     </div> 
     <button class="btn btn-primary" style="margin-left:15px;margin-top: 20px"><a href="{{route('choix_abonnement')}}" class="a">S'abonner</a></button>
    </div>

    </div>
    
  </div>
</div>






            <br><br>
            <br><br>
    </div>
@endsection
@section('script')
		<script>

		</script>
@endsection		
