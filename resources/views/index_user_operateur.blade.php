@extends('layouts.back_layout')
@section('title')
    Portefeuille de références techniques
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
                            <li class="breadcrumb-item active">Portefeuille de références techniques</li>
                        </ol>
                    </div>
                    <h4 class="page-title">Portefeuille de références techniques</h4>
                </div>
            </div>
        </div>
        <!-- end page title -->
        <div class="row">
            <div class="col-12 mb-3">
                @if ($verif == null && Auth::user()->type_user == 3)
                    <span class="btn btn-warning float-end">
                        Nombre de références restantes : <b>{{ 2 - $references->count() }}</b>
                    </span>
                @endif
            </div>
        </div>

        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-body">
                        <h4 class="header-title">Affichage des références techniques</h4>
                        @if ($canPublish)
                            <div class="row">
                                <button class="btn btn-primary offset-9 col-lg-3" type="button" data-bs-toggle="modal"
                                    data-bs-target="#addTechnicalReferenceModal">
                                    <i class="fa fa-plus"></i> AJOUTER UNE RÉFÉRENCE TECHNIQUE
                                </button>
                            </div>
                        @else
                            <div class="row">
                                <button class="btn btn-primary offset-9 col-lg-3" type="button" data-bs-toggle="modal"
                                    data-bs-target="#cannotAdd">
                                    <i class="fa fa-plus"></i> AJOUTER UNE RÉFÉRENCE TECHNIQUE
                                </button>
                            </div>
                            <div class="modal fade" id="cannotAdd" tabindex="-1" role="dialog"
                                aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="exampleModalLabel">Plus de références</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <p>Pour publier plus de références, merci de vous abonner en <a
                                                    href="{{ route('pricing') }}">cliquant
                                                    ici.</a></p>
                                        </div>
                                        <div class="modal-footer bg-whitesmoke br">

                                            <button type="button" class="btn btn-danger" style="color:white;"
                                                data-bs-dismiss="modal">Fermer</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                        <br>
                        <table id="datatable-buttons" class="table table-striped dt-responsive nowrap w-100">
                            <thead class="bg-primary text-white">
                                <tr>
                                    <th>Numéro Contrat</th>
                                    <th>Libellés</th>
                                    <th>Autorité contractante</th>
                                    <th>Année</th>
                                    <th>Status</th>
                                    <td>Actions</td>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($references as $reference)
                                    <tr>
                                        <td>{{ $reference->reference_marche }}</td>
                                        <td>{{ Str::limit($reference->libelle_marche, 30) }}</td>
                                        <td>{{ Str::limit(\Illuminate\Support\Facades\DB::table('autoritecontractantes')->where('id', $reference->autorite_contractante)->first()->raison_social, 30) }}
                                        </td>
                                        <td>{{ $reference->annee_execution }}</td>
                                        <td>
                                            @if ($reference->status == 0)
                                                <div class="btn btn-warning">En attente</div>
                                            @endif

                                            @if ($reference->status == 1)
                                                <div class="btn btn-success">Publiée</div>
                                            @endif

                                            @if ($reference->status == 2)
                                                <div class="btn btn-danger">Rejetée</div>
                                            @endif
                                        </td>
                                        <td>
                                            <a href="{{ route('editmesref', $reference->idreference) }}"
                                                class="btn btn-info">
                                                <i class="fe-edit"></i>
                                            </a>
                                            <button class="btn btn-danger" type="button" data-bs-toggle="modal"
                                                data-bs-target="#deleteCard{{ $reference->idreference }}">
                                                <i class="fe-trash"></i>
                                            </button>
                                        </td>
                                    </tr>
                                    <div class="modal fade" id="deleteCard{{ $reference->idreference }}" tabindex="-1"
                                        role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                        <div class="modal-dialog" role="document">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="exampleModalLabel">Suppression</h5>
                                                    <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                </div>
                                                <div class="modal-body">
                                                    <p>Etes-vous sûr de supprimer cette référence?</p>
                                                </div>
                                                <div class="modal-footer bg-whitesmoke br">

                                                    <button type="button" class="btn btn-danger" style="color:white;"
                                                        data-bs-dismiss="modal">Fermer</button>
                                                    <a href="{{ url('delete/mes_references', $reference->idreference) }}"
                                                        class="btn btn-success">
                                                        Oui</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div> <!-- end card -->
            </div>
        </div>
    </div>
    <div class="modal fade bd-example-modal-lg" tabindex="-1" id="addTechnicalReferenceModal" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Ajout de reference technique</h5>
                    <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{ route('enreg_reference') }}" enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="titulaire" value="{{ Auth::user()->id }}">
                        <div class="card-body">
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label>Pays de l’autorité Contractante *</label>
                                        <select class="form-control pays" name="pays" required id="pays">
                                            <option value="0" disabled="true" selected="true">--- Selectionner ---
                                            </option>
                                            @if ($verif == null && Auth::user()->type_user == 3)
                                                @foreach ($pays as $pay)
                                                    @if ($pay->id == Auth::user()->pays_id)
                                                        <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                                    @endif
                                                @endforeach
                                            @else
                                                @foreach ($pays as $pay)
                                                    <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="row">
                                        <div class="col-lg-8">
                                            <div class="form-group">
                                                <label>Montant</label>
                                                <input type="number" class="form-control " name="montant"
                                                    id="montant">
                                            </div>
                                        </div>
                                        <div class="col-lg-4">
                                            <div class="form-group">
                                                <label>Afficher</label><br>
                                                <div class="mt-2">
                                                    <input type="radio" value="1" name="show_amount"> Oui
                                                    &nbsp;&nbsp;
                                                    <input type="radio" value="0" name="show_amount" checked> Non
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                            </div>
                            <div class="row">
                                <div class="col">
                                    <label>Autorité contractante *</label>
                                    <div class="form-group" style="display: flex;">

                                        <select class="form-control" style="width: 89%;margin-right: 1%;" name="autorite"
                                            required id="autorite">
                                            <option value="" disabled="true" selected="true">--- Sélectionner
                                            </option>
                                        </select>
                                        <button id="add" class="btn btn-default" data-bs-toggle="modal"
                                            data-bs-target="#myModal2" style="border: 1px solid">+</button>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="annee_execution">Année d'exécution</label>
                                        <select class="form-control" name="annee_execution" required>
                                            <option value="">Sélectionnez une année</option>
                                            @for ($year = date('Y'); $year >= 1990; $year--)
                                                <option>{{ $year }}</option>
                                            @endfor

                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="reference">Numéro Contrat</label>
                                        <input type="text"
                                            class="form-control @error('reference') is-invalid @enderror" name="reference"
                                            value="{{ old('reference') }}" id="source">

                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="sous_traitance">Sous traitance par</label>
                                        <input type="text"
                                            class="form-control @error('sous_traitance') is-invalid @enderror"
                                            name="sous_traitance"
                                            value="{{ old('sous_traitance') ? old('sous_traitance') : 'Aucun' }}"
                                            id="sous_traitance">
                                        @error('sous_traitance')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="date">Date contrat</label>
                                        <input type="date" class="form-control @error('date') is-invalid @enderror"
                                            name="date" value="{{ old('date') }}" id="montant">
                                        @error('date')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="groupement">En groupement avec</label>
                                        <input type="text"
                                            class="form-control @error('groupement') is-invalid @enderror"
                                            name="groupement"
                                            value="{{ old('groupement') ? old('groupement') : 'Aucun' }}"
                                            id="groupement">
                                        @error('groupement')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                            <div class="row">

                                <div class="col">
                                    <div class="form-group">
                                        <label for="marche">Libelle du marché *</label>
                                        <input type="text" class="form-control @error('marche') is-invalid @enderror"
                                            name="marche" value="{{ old('marche') }}" id="marche">
                                        @error('marche')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="compte">Consultant pour le compte de</label>
                                        <input type="text" class="form-control @error('compte') is-invalid @enderror"
                                            name="compte" value="{{ old('compte') ? old('compte') : 'Aucun' }}"
                                            id="compte">
                                        @error('compte')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>

                            </div>
                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label>Type de marché</label>
                                        <select class="form-control" name="type" required>
                                            @foreach ($categories as $categorie)
                                                <option value="{{ $categorie->id }}">{{ $categorie->nom_categorie }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="form-group">
                                        <label for="preuve">Preuve d'execution</label>
                                        <input type="file" class="form-control" name="preuve" id="preuve">
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="card-footer text-end">
                            <button class="btn btn-primary" type="submit">Publier</button>
                            <button class="btn btn-danger" type="button" data-bs-dismiss="modal">Fermer</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="modal fade bd-example1-modal-md border" tabindex="-1" role="dialog"
        aria-labelledby="myLargeModalLabel" aria-hidden="true" id="myModal2">
        <div class="modal-dialog border">
            <div class="modal-content">
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12 ml-auto">
                            <h5 class="modal-title" id="exampleModalLabel" style='color:#3232cc'>Enregistrer autorité
                                contratante</h5>
                            <hr style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'
                                data-bs-toggle="modal" data-bs-target=".bd-example-modal-lg">
                        </div>
                        <div class="col-md-12">
                            <form method="POST" action="{{ route('enreg_autorite') }}">
                                @csrf
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Nom/ raison sociale</label>
                                    <input class="form-control" name="nomaut" type="text" required="true"
                                        placeholder="">
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Pays*</label>
                                    <select class="form-control" name="paysaut">
                                        <option value="0" disabled="true" selected="true">--- Sélectionner le pays
                                            ---</option>
                                        @foreach ($pays as $pay)
                                            <option value="{{ $pay->id }}">{{ $pay->nom_pays }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Type*</label>
                                    <select class="form-control" name="typeaut">
                                        <option value="0" disabled="true" selected="true">--- Sélectionner le type
                                            ---</option>
                                        @foreach ($categorieautorites as $categorie)
                                            <option value="{{ $categorie->id }}">{{ $categorie->libelleCat }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="exampleFormControlSelect1">Télephone</label>
                                    <input class="form-control" name="autreaut" type="text" placeholder="">
                                </div>
                                <button type="submit" class="btn btn-sm mt-3"
                                    style='background-color: #3232cc; border-bottom-color: #3232cc; color:#ffffff'>Envoyer</button>
                                <button class="btn btn-danger btn-sm mt-3" data-bs-dismiss="modal"
                                    aria-label="Close">Annuler <span aria-hidden="true">&times;</span></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
@section('script')
    <script type="text/javascript">
        $(document).ready(function() {

            $(document).on('change', '#pays', function() {

                var idpays = $(this).val();
                var div = $(this).parent();
                var op = " ";

                $.ajax({

                    type: 'get',
                    url: '{!! URL::to('ajaxgetautorite') !!}',
                    data: {
                        'id': idpays
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
                                '<option value="" disabled="true" selected="true">Aucune information</option>';
                        }

                        document.getElementById("autorite").innerHTML = op;


                        //console.log(op);


                    },
                    error: function() {
                        console.log('error');
                    }


                });
            });
        });

        $(document).ready(function() {

            $(document).on('change', '#payst', function() {

                var idpays = $(this).val();
                var div = $(this).parent();
                var opt = " ";

                $.ajax({

                    type: 'get',
                    url: '{!! URL::to('ajaxgetoperateur') !!}',
                    data: {
                        'id': idpays
                    },
                    dataType: 'json',
                    success: function(data) {
                        //console.log('success');

                        //console.log(data);

                        //op+='<option value="0" disabled="true" selected="true">--- Préselectionner le pays ---</option>';

                        for (var i = 0; i < data.length; i++) {
                            opt += '<option value="' + data[i].id + '">' + data[i]
                                .raison_social + '</option>';
                        }

                        if (data.length == 0) {
                            opt =
                                '<option value="" disabled="true" selected="true">Aucune information</option>';
                        }

                        document.getElementById("titulaire").innerHTML = opt;


                    },
                    error: function() {
                        console.log('error');
                    }
                });
            });
        });
    </script>
@endsection
