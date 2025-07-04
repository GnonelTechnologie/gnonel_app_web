@extends('layouts.appwelcom')
@section('titre')
Gnonel - Appels d'offres
@endsection
@section('content')
 <section class="py-5">
            <div class="container px-4 px-lg-5 my-1">
				<!-- <div class="row my-3">
					<h4 class="font-weight-light"><b>Recherche</b></h4>
					<small id="emailHelp" class="form-text text-muted">Résultat de votre recherche, <a href="{{ route('welcome') }}"><b>Toutes Les Offres</b></a></small>
				</div> -->
                <div class="row gx-4 gx-lg-5 align-items-center">
					<div class="col-md-12 mt-3">
						<center><div style="background-color: #1b87fa"><h4><b>APPELS A CONCCURENCE EN COURS</b></h4></div></center>
					</div>
                    <div class="col-md-12 mt-3">
                    	<center>
                    		<select class="form-control" id="pays" name="pays" required style="width: 35%">
									    <option value="" selected="true">--- Sélectionner le pays ---</option>
										@foreach($pays as $pay)
											<option value="{{$pay->id}}" <?php if($pay->id == $data['pays']){ $paysselectionne = $pay->nom_pays?> selected <?php } ?>>{{$pay->nom_pays}}</option>
										@endforeach
									</select>
                    	 </center>
                    	 <div class="col-md-12 mt-3">
                    	 	<center>
                    	 		<input type="text" class="form-control" id="search-offre" placeholder="Rechercher un appel d'offres, une autorité ou une catégorie..." style="width: 50%">
                    	 	</center>
                    	 </div>
						<table id="example" class="table table-bordered" style="width:100%;">
							<thead>
								<tr style="background-color:#1b87fa">
									<th>N°</th>
									<th>Intitulé de l'offre</th>
									<th>Autorité Contractante</th>
									<th>Date publication</th>
									<th>Date de clôture</th>
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
            
             var table = $('#example').DataTable(); 

             // Autocomplétion pour les appels d'offres
             $("#search-offre").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('autocomplete.offres') }}",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.value + ' - ' + item.raison_social + ' (' + item.nom_categorie + ')',
                                    value: item.value,
                                    id: item.id
                                };
                            }));
                        }
                    });
                },
                minLength: 2,
                select: function(event, ui) {
                    // Rediriger vers les détails de l'offre
                    window.location.href = "{{ url('Details') }}/" + ui.item.id;
                }
             });

             // Autocomplétion pour les opérateurs
             $("#search-operateur").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('autocomplete.operateurs') }}",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.value + ' - ' + item.nom_pays,
                                    value: item.value,
                                    id: item.id
                                };
                            }));
                        }
                    });
                },
                minLength: 2
             });

             // Autocomplétion pour les autorités
             $("#search-autorite").autocomplete({
                source: function(request, response) {
                    $.ajax({
                        url: "{{ route('autocomplete.autorites') }}",
                        dataType: "json",
                        data: {
                            term: request.term
                        },
                        success: function(data) {
                            response($.map(data, function(item) {
                                return {
                                    label: item.value + ' - ' + item.nom_pays,
                                    value: item.value,
                                    id: item.id
                                };
                            }));
                        }
                    });
                },
                minLength: 2
             });

             // Autocomplétion pour les références
             $("#search-reference").autocomplete({
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
                    // Rediriger vers les détails de la référence
                    window.location.href = "{{ url('view/detailsreference') }}/" + ui.item.id;
                }
             });
            
$("#pays").on("change",function () {
	$.ajax({
                type: 'get',
                url: "{{ url('search-offre') }}/"+$("#pays option:selected").val(),
                success: function(response) {
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