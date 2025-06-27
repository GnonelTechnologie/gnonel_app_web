@extends('layouts.app')

@section('content')
    <?php
    $i = 1;
    ?>
    <style type="text/css">
        #example_filter {
            width: fit-content;
            float: inline-end;
        }
    </style>
    <section class="section">
        <div class="section-header">
            <h1>Dashboard</h1>
        </div>
        <h2 class="section-title">Mes spécifications</h2>
        <br>
        <div class="row">
            <div class="col-12 col-md-12 col-lg-12">
                <div class="card" style="padding: 15px;">
                    <div class="">
                        <div class="table-responsive">
                            <table class="table table-bordered" id="example" style="width: 100%">
                                <thead>
                                    <tr style="background-color : #4169E1; font-weight: bold; color: #FFFFFF;">
                                        <td>#</td>
                                        <td>Catégorie</td>
                                        <td>Lien</td>
                                        <td>Pays</td>
                                        <td>Status</td>
                                        <td>Action</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($specs as $spec)
                                        <tr>
                                            <td>{{ $i++ }}</td>
                                            <td>{{ \Illuminate\Support\Facades\DB::table('categories')->where('id', '=', $spec->categorie_id)->first()->nom_categorie }}
                                            </td>
                                            <td><a href="{{ asset('images/uploads/' . $spec->lien) }}">Voir pièce
                                                    jointe</a>
                                            </td>
                                            <td>Pays</td>
                                            <td>Status</td>
                                            <td>
                                                <div class="table-links">
                                                    <a href="{{ route('specifications.edit', $spec->id) }}">
                                                        <li class="bullet"></li>Modifier
                                                    </a><br>
                                                    <a href="{{ url('delete/specifications', $spec->id) }}"
                                                        onclick="return confirm('Êtes-vous sûr de bien vouloir supprimer cet élément')">
                                                        <li class="bullet"></li>Supprimer
                                                    </a>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    @if (Session::has('update_ok'))
        <!-- <script>
            alert('Pays modifié avec succès')
        </script> -->
    @endif
    @if (Session::has('delete_ok'))
        <script>
            alert('Spécification supprimé avec succès')
        </script>
    @endif
@endsection
