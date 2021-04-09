
 <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des Commandes A Livrer</h3>
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
                            foreach($all_data as $commande){
                                ?>
                                <tr>
                                    <td><?=$commande->id?></td>
                                    <td><?=$commande->date?></td>
                                    <td><?=$commande->montant?></td>
                                    <td><?=$commande->nom?> <?=$commande->prenom?></td>
                                    <td>
                                        <input id="checkbox3" type="checkbox">
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


<script type="text/javascript">
    
</script>