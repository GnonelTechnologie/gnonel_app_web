@extends('layouts.appuser')
@section('titre')
Gnonel - Appels d'offres
@endsection
@section('content')
<section class="section">
    <div class="section-header">
    <h1>Dashboard</h1>
    </div>
    <h2 class="section-title"> Détails appel d'offre</h2>
   <div class="container px-4 px-lg-5 my-5" style="background-color: white;padding-top: 20px;padding-bottom: 20px;">

                <div class="row gx-4 gx-lg-5 align-items-center">
                    <!--<div class="col-md-3"><img class="card-img-top mb-5 mb-md-0" src="{{ asset('assets/assetclient/appel_offre_cnudst-1.png') }}" alt="..." /></div>-->
                    <div class="col-lg-12">
                        <div class="fs-5 my-2">
                            <center><span><h4><B></B></h4></span></center>
                        </div><br>

                      <div style="background-color:#1b87fa;color: white;">
                     <h5 style="margin-top:10px">{{$offres[0]->libelle_appel}} </h2>
                     </div>
                     <br>
                        <table class="table table-bordered" style="width:100%">
                            <tbody>
                                 
                                <tr style="background-color: #1b87fa;">
                                    <th style="color:white;">Rubrique</th>
                                    <th style="color:white;">Détails</th>
                                </tr>
                                <tr>
                                    <td>Numéro appel d’offre :</td>
                                    <td>{{$offres[0]->reference}}</td>
                                </tr>
                                <tr>
                                    <td>Autorité Contractante :</td>
                                    <td>{{$offres[0]->raison_social}}</td>
                                </tr>
                                <tr>
                                    <td>Pays</td>
                                    <td>{{$offres[0]->nom_pays}}</td>
                                </tr>
                                <tr>
                                    <td>Date de publication</td>
                                    <td>
                                        <?php $datep = new DateTime($offres[0]->date_publication) ?>
                                        {{$datep->format('d-m-Y')}}
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Date de cloture</td>
                                    <td>
                                        <?php $datep = new DateTime($offres[0]->date_cloture) ?>
                                        {{$datep->format('d-m-Y h:i:s')}}
                                        
                                    </td>
                                </tr>
                                <tr>
                                    <td>Source</td>
                                    <td>{{$offres[0]->source}}</td>
                                </tr>
                                <tr>
                                    <td>Personne a contacter</td>
                                    <td>{{$offres[0]->contact}}</td>
                                </tr>
                                <tr>
                                    <td>Autre information</td>
                                    <td>{{$offres[0]->description}}</td>
                                </tr>
                            <tbody>
                        </table>
                        <!-- <div class="d-flex">
                            <button class="btn btn-outline-dark flex-shrink-0" type="button">
                                <i class="bi-cart-fill me-1"></i>
                                Voir Le Fichier Joint
                            </button>
                        </div> -->
                    </div>
                </div>
            </div>
            </section>
@endsection
@section('script')
    <script>

    </script>
@endsection
