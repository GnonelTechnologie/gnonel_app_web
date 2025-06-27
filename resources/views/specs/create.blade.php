@extends('layouts.back_layout')
@section('title')
    @if (isset($spec))
        Modifier une spécification
    @else
        Publier une spécification
    @endif
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
                            <li class="breadcrumb-item active">
                                @if (isset($spec))
                                    Modifier une spécification
                                @else
                                    Publier une spécification
                                @endif
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">
                        @if (isset($spec))
                            Modifier une spécification
                        @else
                            Publier une spécification
                        @endif
                    </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="row m-0">
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card m-0">
                                    @if (isset($spec))
                                        <?php
                                        $categorieold = \Illuminate\Support\Facades\DB::table('categories')->where('id', $spec->categorie_id)->first();
                                        $paysold = \Illuminate\Support\Facades\DB::table('pays')->where('id', $spec->pays_id)->first();
                                        ?>
                                        <form method="post" class="card-body"
                                            action="{{ route('specifications.update', $spec->id) }}"
                                            enctype="multipart/form-data">
                                            {{ method_field('put') }}
                                            @csrf
                                            <div class="form-group mt-3">
                                                <label>Nom de l’article</label>
                                                <input type="text" name="libelle" value="{{ $spec->libelle }}"
                                                    class="form-control">
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Contexte d’utilisation </label>
                                                <textarea name="contexte" class="form-control">{{ $spec->contexte }}</textarea>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Catégorie</label>
                                                <select class="form-control" name="categorie" required>
                                                    <option value="{{ $categorieold->id }}">
                                                        {{ $categorieold->nom_categorie }}</option>
                                                    @foreach ($categories as $categorie)
                                                        @if ($categorieold->id != $categorie->id)
                                                            <option value="{{ $categorie->id }}">
                                                                {{ $categorie->nom_categorie }}
                                                            </option>
                                                        @endif
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group mt-3">
                                                <label>Pièce jointe</label>
                                                <input type="file" name="fichier" class="form-control">
                                            </div>
                                            <br><br>
                                            <input type="reset" value="Annuler" class="btn btn-danger"
                                                style="float: right;">
                                            <input type="submit" value="Valider" class="btn btn-info"
                                                style="float: right;margin-right: 10px;">
                                        </form>
                                    @else
                                        <form method="post" class="card-body"
                                            action="{{ Auth::user()->role == 'user' ? route('specifications.store') : route('specifications.store_admin') }}"
                                            enctype="multipart/form-data">
                                            @csrf
                                            <div class="form-group">
                                                <label>Nom de l’article</label>
                                                <input type="text" name="libelle" class="form-control">
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label>contexte d’utilisation </label>
                                                <textarea name="contexte" class="form-control"></textarea>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label>Catégorie</label>
                                                <select class="form-control" name="categorie" required>
                                                    @foreach ($categories as $categorie)
                                                        <option value="{{ $categorie->id }}">
                                                            {{ $categorie->nom_categorie }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <br>
                                            <div class="form-group">
                                                <label>Pièce jointe</label>
                                                <input type="file" name="fichier" class="form-control">
                                            </div>
                                            <br><br>
                                            <input type="reset" value="Annuler" class="btn btn-danger"
                                                style="float: right;">
                                            <input type="submit" value="Publier" class="btn btn-info"
                                                style="float: right;margin-right: 10px;">
                                        </form>
                                    @endif
                                </div>
                            </div>
                        </div>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {
            $("#typeautorite, #typeoperateur").on('change', function() {
                var i = document.querySelector('input[name="type"]:checked').value
                if (i === 'oui') {
                    $("#zone").prop('disabled', false);
                } else {
                    $("#zone").prop('disabled', true);
                }
            })

            $(document).on('change', '#pays,#zone, #typeautorite, #typeoperateur', function() {

                // var idpays=$(this).val();
                var idpays = document.getElementById("pays").value;
                var zone = document.getElementById("zone").value;
                var type = document.querySelector('input[name="type"]:checked').value;
                //alert("hi")
                var div = $(this).parent();
                var op = " ";


                $.ajax({

                    type: 'get',
                    url: '{!! URL::to('ajaxgetoperateur_jfe') !!}',
                    data: {
                        'pays': idpays,
                        'type': type,
                        'zone': zone
                    },
                    dataType: 'json',
                    success: function(data) {
                        //console.log('success');

                        //console.log(data);

                        //op+='<option value="0" disabled="true" selected="true">--- Préselectionner le pays ---</option>';

                        for (var i = 0; i < data.length; i++) {
                            op += '<option value="' + data[i].id + '">' + data[i]
                                .raison_social + '</option>';
                        }

                        if (data.length == 0) {
                            op =
                                '<option value="0" disabled="true" selected="true">Aucune information</option>';
                        }

                        document.getElementById("structure").innerHTML = op;

                        console.log(op);


                    },
                    error: function() {
                        console.log('error');
                    }
                });
            });
        });
    </script>
@endsection
