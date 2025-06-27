@extends('layouts.appuser')
@section('titre')
Gnonel - Appels d'offres
@endsection
@section('content')
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
    <h2 class="section-title" style="background-color: #1b87fa;height: 40px;padding-top: 10px;color: white;width: 50%;">APPELS A CONCCURENCE EN COURS</h2>
  <br>
            <div class="container px-4 px-lg-5 my-1" style="background-color: white;padding-top: 20px;padding-bottom: 20px;">
				<!-- <div class="row my-3">
					<h4 class="font-weight-light"><b>Recherche</b></h4>
					<small id="emailHelp" class="form-text text-muted">Résultat de votre recherche, <a href="{{ route('welcome') }}"><b>Toutes Les Offres</b></a></small>
				</div> -->
				<div class="row">
					<div class="col-lg-6"> 

					</div>
					<div class="col-lg-2"></div>
					<div class="col-lg-4"> 

						<select class="form-control" id="pays" name="pays" required>
									    <option value="" selected="true">--- Sélectionner le pays ---</option>
										@foreach($pays as $pay)
											<option value="{{$pay->id}}" <?php if($pay->id == $data['pays']){ $paysselectionne = $pay->nom_pays?> selected <?php } ?>>{{$pay->nom_pays}}</option>
										@endforeach
									</select>
					</div>
				</div>
                <div class="row gx-4 gx-lg-5 align-items-center">
					<div class="col-md-12 mt-3">
						<center><div style="background-color: #1b87fa"><h4><b></b></h4></div></center>
					</div>
                    <div class="col-md-12 mt-3">
                    	<center>
                    		
                    	 </center>
						<table id="example" class="table table-bordered" style="width:100%;">
							<thead>
								<tr style="background-color:#1b87fa">
									<th style="color:white">N°</th>
									<th style="color:white">Intitulé de l'offre</th>
									<th style="color:white">Autorité Contractante</th>
									<th style="color:white">Date publication</th>
									<th style="color:white">Date de clôture</th>
								</tr>
							</thead>
							<tbody>
							<?php $count = 0; ?>
								@foreach($offres as $offre)
								<?php $count = $count + 1; ?>
								<tr style="cursor:pointer" onclick="document.location='{{ route('Details',$offre->id) }}'">
									<td style="cursor:pointer">{{$count}}</td>
									<td style="cursor:pointer">{{$offre->libelle_appel}}</td>
									<td style="cursor:pointer">{{$offre->raison_social}}</td>
									<td style="cursor:pointer">
										
										<?php $datep = new DateTime($offre->date_publication) ?>
										{{$datep->format('d/m/Y')}}
									</td>
									<td>
										
										<?php $datep = new DateTime($offre->date_cloture) ?>
										{{$datep->format('d/m/Y H:m')}}
									</td>
							</tr>
								@endforeach
							<tbody>
						</table>
                    </div>
                </div>
            </div>
        </section>
@endsection
@section('script')
		<script>
      $(document).ready(function () {
           
$("#pays").on("change",function () {
	$.ajax({
                type: 'get',
                url: "{{ url('search-offre') }}/"+$("#pays option:selected").val(),
                success: function(response) {
                 var table = $('#example').DataTable(); 
                    console.log(response.donnes);
                   // table.$("tr").remove();
                    table.rows().remove().draw();
                    var data=response.donnes;
                    var tr = '';
                    if (data.length>0) {
                        for (var i = 0; i < response.donnes.length; i++) {
                        	 var id = data[i].id;
                        var name = data[i].libelle_appel;
                        var autorite = data[i].raison_social;
                        var datep = data[i].date_publication;
                        var datec = data[i].date_cloture;
                        		  tr += '<tr style="cursor:pointer" onclick="detail('+id+')">';
									 tr +='<td style="cursor:pointer">'+(i+1)+'</td>';
									 tr +='<td style="cursor:pointer">'+name+'</td>';
									 tr +='<td style="cursor:pointer">'+autorite+'</td>';
									 tr +='<td style="cursor:pointer">'+moment(datep).format('DD/MM/yyyy');+'</td>';
									 tr +='<td>'+moment(datec).format('DD/MM/yyyy HH:mm');+'</td>';
							 tr += '</tr>';
                        }
                        table.rows.add($(tr)).draw();
                    }
                    else
                    {

                    }
                    /*
                    for (var i = 0; i < response.length; i++) {
                        var id = response[i].id;
                        var name = response[i].name;
                        var email = response[i].email;
                        var phone = response[i].phone;
                        var address = response[i].address;
                        tr += '<tr>';
                        tr += '<td>' + id + '</td>';
                        tr += '<td>' + name + '</td>';
                        tr += '<td>' + email + '</td>';
                        tr += '<td>' + phone + '</td>';
                        tr += '<td>' + address + '</td>';
                        tr += '<td><div class="d-flex">';
                        tr +=
                            '<a href="#viewEmployeeModal" class="m-1 view" data-toggle="modal" onclick=viewEmployee("' +
                            id + '")><i class="fa" data-toggle="tooltip" title="view">&#xf06e;</i></a>';
                        tr +=
                            '<a href="#editEmployeeModal" class="m-1 edit" data-toggle="modal" onclick=viewEmployee("' +
                            id +
                            '")><i class="material-icons" data-toggle="tooltip" title="Edit">&#xE254;</i></a>';
                        tr +=
                            '<a href="#deleteEmployeeModal" class="m-1 delete" data-toggle="modal" onclick=$("#delete_id").val("' +
                            id +
                            '")><i class="material-icons" data-toggle="tooltip" title="Delete">&#xE872;</i></a>';
                        tr += '</div></td>';
                        tr += '</tr>';
                    }
                    $('.loading').hide();
                    $('#employee_data').html(tr);*/
                }
            });
})

detail=function (id) {
	window.location.href="{{ url('Details') }}/"+id;
}

          });
		</script>
@endsection