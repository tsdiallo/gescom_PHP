
 <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des Commandes Avec Qte Livrees</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
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
                            foreach($all_data_fact as $facture){
                                ?>
                                <tr>
                                    <td><?=$facture->id?></td>
                                    <td><?=$facture->date?></td>
                                    <td><?=$facture->montant?></td>
                                    <td><?=$facture->nom?> <?=$facture->prenom?></td>
                                    <td>
                                    <button type="button" class="btn btn-success waves-effect waves-light" ><i class=""></i>Rediger</button>
                                    <button type="button" class="btn btn-purple waves-effect waves-light" ><i class=""></i>Editer</button>
                                    <button type="button" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#panel-modal"><i class=""></i>Details</button>
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
                    <h3 class="panel-title" id="h3_pannel-title">Facture</h3>
                </div>
                <div class="panel-body">
                <div class="row">
                    <div class="col-md-6">
                        <h5>LOUM</h5>
                        <h5>Senegal, Dakar</h5>
                        <h5>Telephone : 77XXY00UU</h5>
                    </div>
                    <div class="col-md-6">
                        <h5>Date : 03/10/2018</h5>
                        <h5>Reference : #123456</h5>
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
                            <tbody>
                            <?php
                            for($i=1;$i<6;$i++){
                                ?>
                                <tr>
                                    <td>XXProd</td>
                                    <td>2$</td>
                                    <td>10</td>
                                    <td>5</td>
                                    <td>4$</td>

                                </tr>
                            <?php
                            }
                            ?>
                            </tbody>
                        </table>
                   </form>
                   <h4 class="" style="margin-left:65%">Total : 4$</h2>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<script type="text/javascript">
    
</script>