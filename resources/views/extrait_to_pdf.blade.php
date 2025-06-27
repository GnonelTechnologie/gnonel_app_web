<br><br>
<?php $i = 0; ?>
<div style="text-align: right">Date: {{ date('d/m/Y') }}</div>
<span style="font-size:15px">EXTRAIT DE REFERENCES TECHNIQUE ($entreprise->raison_sociale)</span>
<br>
<table border="0.5">
    <thead>
        <tr style="background-color: #1b87fa;">
            <th style="color: white;display: none;">Id</th>
            <th style="color: white;">Ref Marchés</th>
            <th style="color: white;">Libellé</th>
            <th style="color: white;">Autorité contractante</th>
            <th style="color: white;">Année</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($references as $reference)
            <tr>
                <tD style="display: none;">{{ $reference->idreference }}</td>
                <tD>{{ $reference->reference_marche }}</td>
                <td>{{ $reference->libelle_marche }}</td>
                <td>{{ \Illuminate\Support\Facades\DB::table('autoritecontractantes')->where('id', $reference->autorite_contractante)->first()->raison_social }}
                </td>
                <td>{{ $reference->annee_execution }}</td>
            </tr>
        @endforeach
    </tbody>
</table>
