@extends('layouts.back_layout')
@section('title')
    Vitrine des spécifications techniques
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
                            <li class="breadcrumb-item active">Vitrine des spécifications techniques</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Vitrine des spécifications techniques</h4>
                </div>
            </div>
        </div>
        <div class="row mb-1">
            <div class="col-12">
                <div class="alert alert-danger">Veuillez lire le contexte d'utilisation pour un meilleur usage. En cas de
                    besoin, vous pouvez apporter des modifications selon votre votre propre contexte.</div>
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-4">
                                <div class="me-sm-3">
                                    <select class="form-select my-1 my-lg-0" name="pays" required id="pays">
                                        <option value="0" disabled="true" selected="true">--- Selectionner pays ---
                                        </option>
                                        @foreach ($pays as $pay)
                                            <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="me-sm-3">
                                    <select class="form-select my-1 my-lg-0" name="categorie" id="categorie" required>
                                        <option value="0" disabled="true" selected="true">--- Selectionner catégorie
                                            ---</option>
                                        @foreach ($categories as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-3">
                                <div class="me-3">
                                    <input type="search" class="form-control my-1 my-lg-0" id="recherche" name="recherche"
                                        placeholder="Mot clé...">
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="text-lg-start my-1 my-lg-0">
                                    <button id="filtrer" type="button"
                                        class="btn btn-success waves-effect waves-light"><i class="mdi mdi-filter me-1"></i>
                                        Filtrer</button>
                                </div>
                            </div><!-- end col-->
                        </div> <!-- end row -->
                    </div>
                </div> <!-- end card -->
            </div> <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row" id="toadd">
            @foreach ($specs as $spe)
                <div class="col-md-6 col-lg-4 col-xl-3">
                    <div class="card product-box">
                        <div class="card-body">
                            <div class="product-action">
                                <a href="{{ asset('images/uploads/' . $spe->lien) }}"
                                    class="btn btn-success btn-xs waves-effect waves-light"><i class="mdi mdi-download"></i>
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
                                                <a style="color: black" target="_blank"
                                                    data-bs-container="#tooltip-container{{ $spe->id }}"
                                                    data-bs-toggle="tooltip" data-bs-placement="top"
                                                    title="{{ $spe->contexte }}">
                                                    {{ $spe->libelle }} <span class="fa fa-info-circle"></span>
                                                </a>
                                            </div>
                                        </h5>
                                    </div>
                                </div> <!-- end row -->
                            </div> <!-- end product info-->
                        </div>
                    </div> <!-- end card-->
                </div> <!-- end col-->
            @endforeach

        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-12">
                {{ $specs->links() }}
                {{-- <ul class="pagination pagination-rounded justify-content-end mb-3">
                    <li class="page-item">
                        <a class="page-link" href="javascript: void(0);" aria-label="Previous">
                            <span aria-hidden="true">«</span>
                            <span class="visually-hidden">Previous</span>
                        </a>
                    </li>
                    <li class="page-item active"><a class="page-link" href="javascript: void(0);">1</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">2</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">3</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">4</a></li>
                    <li class="page-item"><a class="page-link" href="javascript: void(0);">5</a></li>
                    <li class="page-item">
                        <a class="page-link" href="javascript: void(0);" aria-label="Next">
                            <span aria-hidden="true">»</span>
                            <span class="visually-hidden">Next</span>
                        </a>
                    </li>
                </ul> --}}
            </div> <!-- end col-->
        </div>
    </div>
@endsection
@section('script')
    <script>
        $(document).ready(function() {

            $("#filtrer").on("click", function() {
                var row = $('#toadd');
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
                                                    ${libelle} <span class="fa fa-info-circle"></span>
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
                                // '<div class="col-lg-3" style="margin-bottom:50px"><label style="color:#1b87fa">' +
                                // libelle +
                                // '</label><img src="{{ asset('assets/img/spec.png') }}" style="border: 1px solid;border-color: #1b87fa;height:250px;"><button class="spec" style="color:#1b87fa;margin-top:3px;background-color:white;border-color: #3fa46a;float: right;"><a href="{{ asset('images/uploads/') }}/' +
                                // lien + '">Télécharger</a></button></div>';
                            }
                            row.append(col);
                        } else {
                            col +=
                                '<div class="col-lg-12 spec text-center" style="margin-bottom:50px"><label style="color:#1b87fa;font-size:22px;">Pas de données</label></div>';
                            row.append(col);

                        }
                    }
                });
            })



        });
    </script>
@endsection
