@extends('layouts.back_layout')
@section('title')
    Extraits des références techniques
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
                            <li class="breadcrumb-item active">Extraits des références techniques</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Extraits des références techniques</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des extraits des références techniques</h4>
                        <div class="row">
                            <button id="ext" class="btn btn-primary offset-9 col-lg-3">
                                <i class="fa fa-download"></i> EXTRAIRE
                            </button>
                        </div>
                        <br>
                        <table id="datatable-buttons" class="table table-striped  w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td></td>
                                    <td>Numéro Contrat</td>
                                    <td>Libellé</td>
                                    <td>Autorité contractante</td>
                                    <td>Année</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($references as $reference)
                                    <tr>
                                        <td>
                                            <input type="checkbox" class="form-check-input sel"
                                                value="{{ $reference->idreference }}">
                                        </td>
                                        <td>
                                            {{ $reference->reference_marche }}</td>
                                        <td>{{ $reference->libelle_marche }}</td>
                                        <td>
                                            {{ \Illuminate\Support\Facades\DB::table('autoritecontractantes')->where('id', $reference->autorite_contractante)->first()->raison_social }}
                                        </td>
                                        <td>{{ $reference->annee_execution }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
    <div class="modal fade modal-no-shadow modal-on-top" id="largeModal" tabindex="-1" role="dialog"
        aria-labelledby="largeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <center>
                        <h5 class="modal-title" id="largeModalLabel" style="text-align: center; display: block;">Extrait de
                            référence
                            technique</h5>
                    </center>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <table id="example2" class="table table-bordered" style="width:100%;">
                        <thead>
                            <tr class="bg-primary text-white">
                                <th scope="col" style="display:none;">ID</th>
                                <th scope="col">Numéro Contrat</th>
                                <th scope="col">Libellé</th>
                                <th scope="col">Autorité contractante</th>
                                <th scope="col">Année</th>
                            </tr>
                        </thead>
                        <tbody>
                        </tbody>
                    </table>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                    <form method="POST" action="{{ route('postextraitmesref') }}">
                        @csrf
                        <input type="hidden" name="idref" id="idref">
                        <button type="submit" style="float: left;" class="btn btn-primary"
                            id="boutonImprimer">Télécharger</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
    <script>
        $(document).ready(function() {

            $("#ext").click(function() {
                $('#example2 tbody').empty();
                $('#datatable-buttons tbody .sel').each(function() {
                    // Vérifier si la case à cocher est cochée
                    if ($(this).is(':checked')) {
                        var nouvelleLigne = $('<tr>');
                        // Afficher les éléments de la ligne correspondante
                        $(this).closest('tr').find('td').each(function() {
                            // Check if first element and get the value of input inside td
                            if ($(this).index() == 0) {
                                nouvelleLigne.append(
                                    $('<td>').text($(this).find('input').val())
                                );
                            } else {
                                nouvelleLigne.append(
                                    $('<td>').text($(this).text())
                                );
                            }

                            nouvelleLigne.find('td:first').hide();

                        });
                        $('#example2 tbody').append(nouvelleLigne);
                    }

                });

                var idref = $('#idref');
                $('#idref').val('');
                $('#example2 tr').each(function() {
                    // Obtenir le premier td de cette ligne
                    var premierTd = $(this).find('td:first');
                    if (premierTd.text() != '') {
                        idref.val(idref.val() + "_" + premierTd.text())
                    }

                    // Faire quelque chose avec le contenu du premier td
                    console.log(premierTd.text());
                });

                $('#largeModal').modal('show');

            });



        });
    </script>
@endsection
