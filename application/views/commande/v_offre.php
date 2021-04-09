<div class="form-group col-md-3">
    <label for="exampleInputEmail1">Annees</label>
        <div class="form-group">
            <label for=""></label>
                <select class="form-control select2" name="client-id" id="client-id">
                    <option value="0"></option>
                </select>
        </div>
</div>
 <div class="row">
    <div class="col-md-12">
        <div class="panel panel-default">
            <div class="panel-heading">
                <h3 class="panel-title">Liste des Offres</h3>
            </div>
            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Numéro Client</th>
                                    <th>Adresse</th>
                                    <th>Telephone</th>
                                    <th>Offres</th>
                                    <th>Commandes</th>
                                </tr>
                            </thead>                        
                            <tbody>
                            <?php
                            for($i=1;$i<12;$i++){
                                ?>
                                <tr>
                                    <td>152</td>
                                    <td>Dakar</td>
                                    <td>77XXY00UU</td>
                                    <td>Yessay</td>
                                    <td>Sure</td>
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