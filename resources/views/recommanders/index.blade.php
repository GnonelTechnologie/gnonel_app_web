@extends('layouts.back_layout')
@section('title')
    Générer un lien de recommandation
@endsection
@section('content')
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item active">Générer un lien de recommandation</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Programme de recommandation GNONEL <button class="btn btn-secondary"
                            type="button" data-bs-toggle="modal" data-bs-target="#infosCard">
                            <i class="fe-info"></i> En savoir plus
                        </button></h4>
                </div>
            </div>
        </div>
        <div class="modal fade" id="infosCard" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
            aria-hidden="true">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Programme de recommandation GNONEL</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">

                        <h6>Recommandez le site gnonel.com et soyez en récompensé.</h6>
                        <p>
                            Le site vous donne la possibilité de recommander ses services à d’autres utilisateurs, à travers
                            un lien de recommandation que vous pouvez générer automatiquement dans votre session. Une
                            initiative qui vise à manifester sa reconnaissance envers les utilisateurs qui contribuent à sa
                            promotion commerciale et à encourager l’entrepreneuriat participatif.
                        </p>
                        <p>
                            N’hésitez donc pas à envoyer des liens de recommandation (usage unique) à vos proches, à vos
                            partenaires d’affaires et recevez vos bonus de récompense automatiquement sur Mobile Money après
                            finalisation de l’abonnement. Chaque lien est à usage unique, valable au sein d’un même pays et
                            expire en 24 h.
                        </p>

                        Avantages : La personne recommandée bénéficie d’une réduction allant jusqu’ 10% sur son abonnement
                        tandis
                        que le recommandeur reçoit son bonus de récompense sur Mobile Money.
                        <br>
                        Comment ça marche ! Le processus est simple :
                        <ol>
                            <li>Dans votre session, Aller dans le menu Paramètres/Recommander ;</li>
                            <li>Cliquer sur Générer un lien de recommandation ;</li>
                            <li>Cliquer sur Copier le lien généré ;</li>
                            <li>Envoyer le lien copié à la personne à qui vous souhaitez recommander le site ;</li>
                            <li>Pour bénéficier de la réduction, la personne recommandée doit cliquer sur le lien reçu
                                pour être dirigée vers la page d’abonnement.</li>
                        </ol>

                    </div>
                    <div class="modal-footer bg-whitesmoke br">
                        <button type="button" class="btn btn-danger" style="color:white;"
                            data-bs-dismiss="modal">Fermer</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Générer un lien de recommandation</h4>
                        <div class="row">
                            <div class="col-lg-8"
                                style="background-color: grey;border: 2px;padding-top: 10px;height: 38px;">
                                <span id="lien" style="color: white;"></span>
                            </div>

                            <div class="col-lg-4">
                                <button class="btn btn-primary" id="generer">Générer lien</button>
                            </div>
                            <br><br>
                            <span>Ce lien de recommandation expire dans 24 heures, et n'est valable qu'au sein d'un même
                                pays.</span>
                        </div>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Recapitulatif des comptes que vous avez recommandés</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>Date</td>
                                    <td>Nom complet</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recoms as $recom)
                                    <?php
                                    $user = \Illuminate\Support\Facades\DB::table('users')->where('id', $recom->user_id)->first();
                                    $souscription = \Illuminate\Support\Facades\DB::table('souscriptions')->where('idsouscription', $recom->souscription_id)->first();
                                    
                                    ?>
                                    @if ($souscription != null)
                                        <?php
                                        $iduser = \Illuminate\Support\Facades\DB::table('users')->where('id', $souscription->iduser)->first();
                                        ?>
                                        <tr>
                                            <td>
                                                @if ($souscription != null)
                                                    {{ $souscription->created_at }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($iduser != null)
                                                    {{ $iduser->name }} {{ $iduser->prenom }}
                                                @endif
                                            </td>
                                        </tr>
                                    @endif
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        //alert('hi')
        let isGenerate = false
        $(document).ready(function() {

            $("#generer").on('click', function() {

                if (isGenerate) {
                    navigator.clipboard.writeText($('#lien').text())
                        .then(() => {
                            alert("Lien copié dans le presse-papiers !");
                        })
                        .catch(err => {
                            console.error("Échec de la copie : ", err);
                        });
                } else {

                    $.ajax({

                        type: 'post',
                        url: "{{ route('recommanders.store') }}",
                        data: {
                            _token: "{{ csrf_token() }}"
                        },
                        dataType: 'json',
                        success: function(data) {
                            //console.log('success');
                            $('#lien').text("")
                            $('#lien').text(data.result.lien)
                            $('#generer').text("Copier le lien")
                            isGenerate = true
                            //console.log(data);
                            //op+='<option value="0" disabled="true" selected="true">--- Préselectionner le pays ---</option>';
                        },
                        error: function() {
                            console.log('error');
                        }
                    });
                }
            });
        });
    </script>
@endsection
