@extends('layouts.landing')
@section('title')
    Spécifications techniques
@endsection
@section('styles')
    <link href="{{ asset('backoffice/css/config/default/bootstrap_.min.css') }}" rel="stylesheet" type="text/css"
        id="bs-default-stylesheet" />
    <link href="{{ asset('backoffice/css/config/default/app_.min.css') }}" rel="stylesheet" type="text/css"
        id="app-default-stylesheet" />

    <style>
        .pages-intro p {
            margin-top: 15px
        }

        .common-hero {
            background-color: var(--vtc-bg-common-bg2) !important;
        }
    </style>
@endsection
@section('content')
    <hr>
    <div class="team1 mt-1 bg-white mb-4">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 m-auto text-center">
                    <div class="heading1 mt-4">
                        <h2 class="text-anime-style-3">Vitrine des spécifications techniques</h2>
                        <div class="space8"></div>
                        <div class="contact10">
                            <div class="container">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="contact-from px-3 py-3">
                                            <div class="form-area">
                                                <div class="row">
                                                    <div class="col-md-3 mb-3">
                                                        <div class="single-input my-0">
                                                            <select name="pays" class="form-control" required
                                                                id="pays">
                                                                <option value="0" disabled="true" selected="true">
                                                                    --- Selectionner pays ---
                                                                </option>
                                                                @foreach ($pays as $pay)
                                                                    <option value="{{ $pay->id }}">
                                                                        {{ $pay->nom_pays }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4 mb-3">
                                                        <div class="single-input my-0"">
                                                            <select name="categorie" class="form-control" id="categorie"
                                                                required>
                                                                <option value="0" disabled="true" selected="true">
                                                                    --- Selectionner catégorie ---</option>
                                                                @foreach ($categories as $categorie)
                                                                    <option value="{{ $categorie->id }}">
                                                                        {{ $categorie->nom_categorie }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <div class="single-input my-0"">
                                                            <input type="text" placeholder="Mot clé" id="recherche"
                                                                name="recherche">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2 mb-3">
                                                        <div class="single-input my-0"">
                                                            <button class="theme-btn16" onclick="filter()"
                                                                style="background-color: #0d8813" type="button">Filter
                                                                <span><i
                                                                        class="fa-solid fa-arrow-right"></i></span></button>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="space30"></div>
            <div class="row" id="specs">
                @foreach ($specs as $spe)
                    <div class="col-md-6 col-lg-4 col-xl-3">
                        <div class="card product-box">
                            <div class="card-body">
                                <div class="product-action">
                                    <a href="{{ asset('images/uploads/' . $spe->lien) }}"
                                        class="btn btn-success btn-xs waves-effect waves-light"><i
                                            class="mdi mdi-download"></i>
                                        Télécharger</a>
                                </div>

                                <div class="bg-light">
                                    <img src="{{ asset('assets/img/spec.png') }}"" alt="product-pic" class="img-fluid" />
                                </div>

                                <div class="product-info">
                                    <div class="row align-items-center">
                                        <div class="col text-center">
                                            <h5 class="font-16 mt-0">
                                                <div class="button-list" id="tooltip-container{{ $spe->id }}">
                                                    <a href="{{ $spe->contexte }}" style="color: black" target="_blank"
                                                        data-bs-container="#tooltip-container{{ $spe->id }}"
                                                        data-bs-toggle="tooltip" data-bs-placement="top"
                                                        title="{{ $spe->contexte }}">
                                                        {{ $spe->libelle }} <span class="fas fa-info-circle"></span>
                                                    </a>
                                                </div>
                                            </h5>
                                        </div>
                                    </div> <!-- end row -->
                                </div> <!-- end product info-->
                            </div>
                        </div> <!-- end card-->
                    </div>
                @endforeach
            </div>
            <div class="space30"></div>
            <div class="row">
                <div class="col-12 m-auto">
                    <div class="theme-pagination pagination text-center">
                        {{ $specs->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            // Autocomplétion pour les spécifications techniques
            $("#recherche").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('autocomplete.references') }}",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.value + ' - ' + item.raison_social,
                                    value: item.value,
                                    id: item.id
                                };
                            }));
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    // Remplir le champ avec la valeur sélectionnée
                    $(this).val(ui.item.value);
                    return false;
                }
            });
        });

        function filter() {
            var row = $('#specs');
            row.empty();
            $.ajax({
                type: 'post',
                url: "{{ url('filtrerspec') }}",
                data: {
                    'pays': $('#pays').val(),
                    'categorie': $('#categorie').val(),
                    'recherche': $('#recherche').val(),
                    _token: "{{ csrf_token() }}"
                },
                success: function(response) {
                    console.log(response.donnes);

                    var data = response.donnes;
                    var col = '';
                    if (data.length > 0) {
                        for (var i = 0; i < response.donnes.length; i++) {
                            var id = data[i].idreference;
                            var libelle = data[i].libelle;
                            var pays = data[i].nom_pays;
                            var categorie = data[i].nom_categorie;
                            var lien = data[i].lien;
                            var contexte = data[i].contexte;
                            col += `
                                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card product-box">
                        <div class="card-body">
                            <div class="product-action">
                                <a href="/images/uploads/${lien}"
                                    class="btn btn-success btn-xs waves-effect waves-light"><i class="mdi mdi-download"></i>
                                    Télécharger</a>
                            </div>

                            <div class="bg-light">
                                <img src="/assets/img/spec.png" alt="product-pic" class="img-fluid" />
                            </div>

                            <div class="product-info">
                                <div class="row align-items-center">
                                    <div class="col text-center">
                                        <h5 class="font-16 mt-0">
                                            <div class="button-list" id="tooltip-container${id}">
                                                <a style="color: black" target="_blank"
                                                    data-bs-container="#tooltip-container${id}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="${contexte}">
                                                    ${libelle} <span class="fas fa-info-circle"></span>
                                                </a>
                                            </div>
                                        </h5>
                                    </div>
                                </div> <!-- end row -->
                            </div> <!-- end product info-->
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col-->
                                `;
                            // col += `
                        //  <div class="col-lg-3" style="margin-bottom:50px">
                        //     <label style="color:#1b87fa">${libelle}</label>
                        //     <img src="{{ asset('assets/img/spec.png') }}" style="border: 1px solid;border-color: #1b87fa;height:250px;">
                        //     <button class="spec" style="color:#1b87fa;margin-top:3px;background-color:white;border-color: #3fa46a;float: right;">
                        //         <a href="{{ asset('images/uploads/') }}/${libelle}">Télécharger</a></button></div>
                        // `;
                        }
                        row.append(col);
                    } else {
                        col +=
                            '<div class="col-lg-12 text-center mt-4"><label style="color:gray;font-size:22px;">Pas de données</label></div>';
                        row.append(col);

                    }

                }
            });
        }
    </script>
@endsection
