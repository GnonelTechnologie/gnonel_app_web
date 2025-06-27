@extends('layouts.appwelcom')
@section('titre')
    Gnonel - Operateur
@endsection
@section('content')
    <div class="pricing-header px-3 py-3 pt-md-5 pb-md-4 mx-auto text-center">
        <p><b>MON PORTEFEUILLE DE REFERENCES TECHNIQUES</b></p>
    </div>
    <div class="container">
        <div>
            <div class="row"></div>
            <hr>
            <div class="row" style="font-size: 20px;font-weight: 200px ">
                <div class="col-lg">Active({{ $valide }})</div>
                <div class="col-lg">En cours({{ $att }})</div>
            </div>
            <hr>
            <!--
         <p>
         <a>Année : 2020</a>
         </p>
        -->

            <div>
                <table id="example" class="table table-bordered" style="width:100%;">
                    <thead>
                        <tr style="background-color: #1b87fa;">
                            <th scope="col">INDEX</th>
                            <th scope="col">NUMERO CONTRAT</th>
                            <th scope="col">LIBELLES</th>
                            <th scope="col">AUTORITE CONTRACTANTE</th>
                            <th scope="col">ANNEE</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($references as $reference)
                            <tr style="cursor: pointer;"
                                onclick="document.location='{{ route('detailsreference', $reference->idreference) }}'">
                                <tD>
                                    @if ($reference->numeroreference != null)
                                        {{ $reference->numeroreference }}
                                    @endif
                                </td>
                                <tD>{{ $reference->reference_marche }}</td>
                                <td>{{ $reference->libelle_marche }}</td>
                                <td>{{ \Illuminate\Support\Facades\DB::table('autoritecontractantes')->where('id', $reference->autorite_contractante)->first()->raison_social }}
                                </td>
                                <td>{{ $reference->annee_execution }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    @endsection
    @section('script')
        <script></script>
    @endsection
