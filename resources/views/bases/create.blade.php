@extends('layouts.back_layout')
@section('title')
    @if (isset($base))
        Modifier un fournisseur à ma base
    @else
        Ajouter un fournisseur à ma base
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
                                @if (isset($base))
                                    Modifier un fournisseur à ma base
                                @else
                                    Ajouter un fournisseur à ma base
                                @endif
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">
                        @if (isset($base))
                            Modifier un fournisseur à ma base
                        @else
                            Ajouter un fournisseur à ma base
                        @endif
                    </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                @if (isset($base))
                    <?php 
                $oper= \Illuminate\Support\Facades\ DB::table('operateurs')->where('id',$base->operateur_id)->first();
                  $zone=Illuminate\Support\Facades\ DB::table('zones')->where('id',$oper->zone_id)->first();
                     ?>
                    <form method="post" class="card-body" action="{{ route('basefournisseurs.update', $base->id) }}">
                        {{ method_field('put') }}
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="me-sm-3">
                                            <select class="form-select my-1 my-lg-0" name="pays" required id="pays">
                                                <option value="0" disabled="true" selected="true">--- Selectionner pays
                                                    ---
                                                </option>
                                                @foreach ($pays as $pay)
                                                    <option value="{{ $pay->id }}"
                                                        {{ $oper->id_pays == $pay->id ? 'selected' : '' }}>
                                                        {{ $pay->nom_pays }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="me-sm-3">
                                            <select class="form-select  my-1 my-lg-0" name="structure" required
                                                id="structure">
                                                <option value="{{ $oper->id }}" selected="true">
                                                    {{ $oper->raison_social }}
                                                </option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-6 col-sm-6 col-md-3">
                                        <div class="me-3">
                                            <input type="search" class="form-control my-1 my-lg-0" id="numerorccm"
                                                name="numerorccm" placeholder="Numéro RCCM" value="{{ $base->numerorccm }}">
                                        </div>
                                    </div> --}}
                                    <div class="col-6 col-sm-6 col-md-2">
                                        <div class="text-lg-start my-1 my-lg-0">
                                            <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                    class="mdi mdi-filter me-1"></i>
                                                Modifier</button>
                                        </div>
                                    </div><!-- end col-->
                                </div> <!-- end row -->
                            </div>
                        </div> <!-- end card -->
                    </form>
                @else
                    <form method="post" class="card-body" action="{{ route('basefournisseurs.store') }}">
                        @csrf
                        <div class="card">
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-12 col-sm-6 col-md-4">
                                        <div class="me-sm-3">
                                            <select class="form-select my-1 my-lg-0" name="pays" required id="pays">
                                                <option value="0" disabled="true" selected="true">--- Selectionner pays
                                                    ---
                                                </option>
                                                @foreach ($pays as $pay)
                                                    <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-12 col-sm-6 col-md-3">
                                        <div class="me-sm-3">
                                            <select class="form-select  my-1 my-lg-0" name="structure" required
                                                id="structure">
                                                <option value="0" disabled="true" selected="true">--- Sélectionner la
                                                    structure (abonné) ---</option>
                                            </select>
                                        </div>
                                    </div>
                                    {{-- <div class="col-6 col-sm-6 col-md-3">
                                        <div class="me-3">
                                            <input type="search" class="form-control my-1 my-lg-0" id="numerorccm"
                                                name="numerorccm" placeholder="Numéro RCCM">
                                        </div>
                                    </div> --}}
                                    <div class="col-6 col-sm-6 col-md-2">
                                        <div class="text-lg-start my-1 my-lg-0">
                                            <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                    class="mdi mdi-filter me-1"></i>
                                                Ajouter</button>
                                        </div>
                                    </div><!-- end col-->
                                </div> <!-- end row -->
                            </div>
                        </div> <!-- end card -->
                    </form>
                @endif
            </div> <!-- end col-->
        </div>
        <!-- end row-->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Liste des fournisseurs</h4>
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <td>Nom de l'entreprise</td>
                                    <td>Secteur d'activité</td>
                                    <td>telephone</td>
                                    <td>Pays</td>
                                    {{-- <td>Numéro RCCM</td> --}}
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($bases as $base)
                                    <tr>
                                        <?php
                                        $oper = \Illuminate\Support\Facades\DB::table('operateurs')->where('id', $base->operateur_id)->first();
                                        $sect = null;
                                        $pays = null;
                                        if ($oper != null) {
                                            $sect = Illuminate\Support\Facades\DB::table('secteuractivite')->where('idsecteuractivite', $oper->secteuractivite_id)->first();
                                            $pays = Illuminate\Support\Facades\DB::table('pays')->where('id', $oper->id_pays)->first();
                                        }
                                        
                                        ?>
                                        @if ($oper != null)
                                            <td>
                                                @if ($oper != null)
                                                    {{ $oper->raison_social }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($sect != null)
                                                    {{ $sect->libellesecteuractivite }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($oper != null)
                                                    {{ $oper->des_operateur }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($pays != null)
                                                    {{ $pays->nom_pays }}
                                                @endif
                                            </td>
                                            {{-- <td>
                                                {{ $base->numerorccm }}
                                            </td> --}}
                                            <td>
                                                <a href="{{ route('basefournisseurs.edit', $base->id) }}"
                                                    class="btn btn-info">
                                                    <i class="fe-edit"></i>
                                                </a>
                                                <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                    data-bs-target="#deleteCard{{ $base->id }}">
                                                    <i class="fe-trash"></i>
                                                </button>
                                                <div class="modal fade" id="deleteCard{{ $base->id }}" tabindex="-1"
                                                    role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                    <div class="modal-dialog" role="document">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <h5 class="modal-title" id="exampleModalLabel">Suppression
                                                                </h5>
                                                                <button type="button" class="btn-close"
                                                                    data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p>Etes-vous sûr de supprimer cette base de fournisseur?</p>
                                                            </div>
                                                            <div class="modal-footer bg-whitesmoke br">
                                                                <button type="button" class="btn btn-danger"
                                                                    style="color:white;"
                                                                    data-bs-dismiss="modal">Fermer</button>
                                                                <a href="{{ url('delete/basefournisseurs', $base->id) }}"
                                                                    class="btn btn-success">
                                                                    Oui</a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        @else
                                            <td colspan="6">
                                                Aucune donnée
                                            </td>
                                        @endif

                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
        <!-- end row-->
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $("#typeautorite, #typeoperateur").on('change', function() {
                var i = document.querySelector('input[name="type"]:checked').value
                if (i === 1) {
                    $("#zone").prop('disabled', false);
                } else {
                    $("#zone").prop('disabled', true);
                }
            })

            $(document).on('change', '#pays, #typeautorite, #typeoperateur', function() {

                // var idpays=$(this).val();
                var idpays = document.getElementById("pays").value;

                //alert("hi")
                var div = $(this).parent();
                var op = " ";

                $.ajax({

                    type: 'get',
                    url: '{!! URL::to('ajaxgetoperateur_jfe') !!}',
                    data: {
                        'pays': idpays
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
