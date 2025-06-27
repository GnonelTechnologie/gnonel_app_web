@extends('layouts.back_layout')
@section('title')
    Détails Référence technique
@endsection
@section('content')
    <?php
    $autorite = \Illuminate\Support\Facades\DB::table('autoritecontractantes')->join('pays', 'pays.id', '=', 'autoritecontractantes.id_pays')->where('autoritecontractantes.id', $reference->autorite_contractante)->first();
    $operateur = \Illuminate\Support\Facades\DB::table('operateurs')->join('pays', 'pays.id', '=', 'operateurs.id_pays')->where('operateurs.id', $reference->operateur)->first();
    
    ?>
    <div class="container-fluid">
        <!-- start page title -->
        <div class="row">
            <div class="col-12">
                <div class="page-title-box">
                    <div class="page-title-right">
                        <ol class="breadcrumb m-0">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Accueil</a></li>
                            <li class="breadcrumb-item"><a href="{{ route('selectoperateur') }}">Relévés de références
                                    techniques</a>
                            </li>
                            <li class="breadcrumb-item active">Détails Référence technique</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Détails Référence technique</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Détails Référence</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead>
                                <tr class="bg-primary">
                                    <th style="width:30%;color:white;">Rubrique</th>
                                    <th style="color:white;">Détails</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td style="width: 25%"><b>Index</b></td>
                                    <td>{{ $reference->numeroreference }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>Numero de marché/ contrat</b></td>
                                    <td>{{ $reference->idreference }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>Date du contrat</b></td>
                                    <td>
                                        @if ($reference->date_contrat != null)
                                            <?php $datep = new DateTime($reference->date_contrat); ?>
                                            {{ $datep->format('d-m-Y h:i:s') }}
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>Libellé contrat</b></td>
                                    <td>

                                        {{ $reference->libelle_marche }}
                                    </td>
                                </tr>
                                @if ($reference->show_amount == 1)
                                    <tr>
                                        <td style="width: 25%"><b>Montant du marché</b></td>
                                        <td>

                                            {{ number_format($reference->montant, 0, ',', ' ') }}
                                        </td>
                                    </tr>
                                @endif
                                <tr>
                                    <td style="width: 25%"><b>Pays de l'autorité contractante</b></td>
                                    <td>{{ $autorite->nom_pays }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>Autorité contractante</b></td>
                                    <td>{{ $autorite->raison_social }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>Type de marché</b></td>
                                    <td>
                                        <?php
                                        $type = \Illuminate\Support\Facades\DB::table('categories')->where('id', $reference->type_marche)->first();
                                        ?>
                                        @if ($type != null)
                                            {{ $type->nom_categorie }}
                                        @endif

                                    </td>
                                </tr>

                                <tr>
                                    <td style="width: 25%"><b>Pays du titulaire du marché:</b></td>
                                    <td>{{ $operateur->nom_pays }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b> Titulaire du marché</b></td>
                                    <td>{{ $operateur->raison_social }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>Année d'execution</b></td>
                                    <td>{{ $reference->annee_execution }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>Sous traitance par</b></td>
                                    <td>{{ $reference->sous_traitance }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>En groupement avec</b></td>
                                    <td>{{ $reference->groupement }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>Consultant pour le compte de</b></td>
                                    <td>{{ $reference->compte }}</td>
                                </tr>
                                <tr>
                                    <td style="width: 25%"><b>Preuve d'exécution</b></td>

                                    <td>
                                        @if ($reference->preuve_execution != null)
                                            <a href="{{ asset('images/uploads/' . $reference->preuve_execution) }}">Voir
                                                pièce jointe</a>
                                        @endif
                                    </td>
                                </tr>
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
@endsection
