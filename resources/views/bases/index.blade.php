@extends('layouts.back_layout')
@section('title')
    Recherche de fournisseurs
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
                                Recherche de fournisseurs
                            </li>
                        </ol>
                    </div>
                    <h4 class="page-title">
                        Recherche de fournisseurs
                    </h4>
                </div>
            </div>
        </div>
        <!-- end page title -->

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <form onsubmit="return searchReference(event);">
                            <div class="row">
                                <div class="col-12 col-sm-6 col-md-5">
                                    <div class="me-sm-3">
                                        <select class="form-select my-1 my-lg-0" name="pays" required id="pays">
                                            <option value="" disabled="true" selected="true">--- Selectionner pays
                                                ---
                                            </option>
                                            @foreach ($pays as $pay)
                                                <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-5">
                                    <div class="me-3">
                                        <input type="search" required class="form-control my-1 my-lg-0" id="reference"
                                            name="reference" placeholder="Rechercher une référence technique">
                                    </div>
                                </div>
                                <div class="col-6 col-sm-6 col-md-2">
                                    <div class="text-lg-start my-1 my-lg-0">
                                        <button type="submit" class="btn btn-success waves-effect waves-light"><i
                                                class="mdi mdi-filter me-1"></i>
                                            Rechercher</button>
                                    </div>
                                </div><!-- end col-->
                            </div> <!-- end row -->
                        </form>

                    </div>
                </div> <!-- end card -->
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
                                    <td style="width:50%">Reference technique</td>
                                    <td style="width:30%">Opérateur économique</td>
                                    {{-- <td>Gnonel ID</td> --}}
                                </tr>
                            </thead>
                            <tbody>
                                <td></td>
                                <td></td>
                                {{-- <td></td> --}}
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

            window.searchReference = function(event) {
                event.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "{{ url('references/recherche') }}",
                    data: {
                        '_token': '{{ csrf_token() }}',
                        'pays': $('#pays').val(),
                        'reference': $('#reference').val()
                    },
                    dataType: 'json',
                    success: function(response) {
                        console.log(response);
                        // table.$("tr").remove();
                        var table = $('#datatable-buttons').DataTable({
                            "destroy": true,
                            "ordering": false
                        });
                        table.rows().remove().draw();
                        var data = response;
                        var tr = '';
                        if (data.length > 0) {
                            for (var i = 0; i < response.length; i++) {
                                //var id = data[i].idreference;
                                var operateur = data[i].operateur;
                                var gnonelid = '';
                                if (data[i].gnonelid != null) {
                                    gnonelid = data[i].gnonelid;
                                }
                                var pays_id = data[i].pays_id;
                                var operateur_id = data[i].operateur_id;
                                console.log(operateur_id);
                                var link = "/view/selectoperateur?operateur_id=" + operateur_id +
                                    "&pays_id=" + pays_id;

                                var reference = data[i].libelle_marche;
                                tr += '<tr style="cursor:pointer;">';
                                tr += '<td style="cursor:pointer;width:70%">' + (reference.length >
                                        100 ? reference.substring(0, 100) + '...' : reference) +
                                    '</td>';
                                tr +=
                                    '<td style="cursor:pointer;width:30%" onclick="document.location=\'' +
                                    link + '\'">' + operateur + '</td>';
                                tr += '</tr>';
                            }
                            table.rows.add($(tr)).draw();


                        } else {}
                    }
                });

                return false;
            }

        });
    </script>
@endsection
