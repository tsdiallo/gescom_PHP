<div class="row">
	<div class="col-md-12">
		<div class="panel panel-default">
			<div class="panel-heading">
				<h3 class="panel-title">Liste des Commandes</h3>
			</div>
			<div class="panel-body">
				<div class="row">
					<div class="col-md-12 col-sm-12 col-xs-12">
						<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Numéro</th>
									<th>Date</th>
									<th>Montant</th>
									<th>Client</th>
									<th></th>
								</tr>
							</thead>                        
							<tbody>
							<?php
							foreach($all_data_commande as $commande){
								?>
								<tr>
									<td><?=$commande->id?></td>
									<td><?=$commande->date?></td>
									<td><?=$commande->montant?></td>
									<td><?=$commande->client_id?></td>
									<td>
									<button value="<?=$commande->id?>" type="button" class="btn btn-danger btn-pLiv waves-effect waves-light" id="btn-livrer" data-toggle="modal" data-target="#panel-modal"><i class=""></i>Pas livré</button>
									</td>

								</tr>
							<?php
							}
							?>
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>
</div> <!-- End Row -->

 <div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
	<div class="modal-dialog">
		<div class="modal-content p-0 b-0">
			<div class="panel panel-color panel-primary">
				<div class="panel-heading"> 
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
					<h3 class="panel-title" id="h3_pannel-title">Modifier livraison</h3>
				</div>
				<div class="panel-body">
				<div class="row">
					<div class="col-md-6">
						<h5 id="nomPrenomCli"></h5>
						<h5 id="adresseCli"></h5>
						<h5 id="telCli"></h5>
					</div>
					<div class="col-md-6">
						<h5 id="dateCom"></h5>
						<h5 id="numCom"></h5>
					</div>
				</div> <br>
				<form role="form">
							<table id="datatable" class="table table-striped table-bordered">
							<thead>
								<tr>
									<th>Produit</th>
									<th>PU</th>
									<th>Qte Com</th>
									<th>Qte Livree</th>
									<th>Montant</th>
								</tr>
							</thead>                        
							<tbody id="tbody-details">
							</tbody>
						</table>
				   </form>
				   <h4 class="" style="margin-left:65%">Total : <span id="total">0</span>
						<input type="hidden" id="hiddenTotal" name="montant" value="0">
				   </h2>
				   <button type="button" class="btn btn-success pull-right">Modifier</button> 
				</div>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<script type="text/javascript" >
	function qteComInitial(data, libelle){
		var qteCom = 0;
		$.each(data,function(key,value){
			if(value.libelle==libelle) {
				qteCom = value.qtecom;
			}
		});
		return qteCom;
	}

	$(document).ready(function() {
		$('#datatable').dataTable();
		$(".btn-pLiv").on("click",function(event) {
			//return true;
			var idCom = $(event.currentTarget).val();
			$.post("<?php echo site_url(array("C_Stock","showDetails"));?>",
			{"id":idCom},
			function(data){
				//console.table(data);
				//return true;
				$("#nomPrenomCli")[0].innerText = data[0].prenom + ' ' + data[0].nom;
				$("#adresseCli")[0].innerText = data[0].adresse;
				$("#telCli")[0].innerText = data[0].telephone;
				$("#dateCom")[0].innerText = data[0].date;
				$("#numCom")[0].innerText = data[0].numero;

				var tr="";
				$("#tbody-details").empty();
				$.each(data,function(key,value){
				tr+=`
					<tr>
						<td>${value.libelle}</td>
						<td>${value.pu}</td>
						<td>${value.qtecom}<input type="hidden" value="${value.qtecom}" id="hiddenQteCom" /></td>
						<td>
							<input type="number" value="0" max="${value.qtecom}" class="form-control qteliv" name="qteliv" placeholder="Quantite livree">
						</td>
						<td class="montant">0</td>
					</tr>
				`
				});
				$("#tbody-details").append(tr);

				
				$(".qteliv").on('change', function(){
					var inputLiv = $(this);
					var pu = Number(inputLiv[0].parentNode.previousElementSibling.previousElementSibling.innerText);
					var mnt = pu * $(inputLiv).val();
					var tdMontant = inputLiv[0].parentNode.nextElementSibling;
					var spanTotal = $("#total")[0];
					var total = 0;
					var tdQteCom = inputLiv[0].parentNode.previousElementSibling;
					var qteCom = qteComInitial(data, inputLiv[0].parentNode.previousElementSibling.previousElementSibling.previousElementSibling.innerText);
					console.log(qteCom);

					tdMontant.innerText = mnt;

					$(".montant").each((key, value) => {
						total += Number(value.innerText);
					});
					tdQteCom.innerText = qteCom - $(inputLiv).val();
					spanTotal.innerText = total;
				})
			},
			"json");
		});
	});
</script>