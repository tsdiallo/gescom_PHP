<div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">

            <div class="panel-heading">
                <h3 class="panel-title">Liste des exemplaires perdus ou usés</h3>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Remplacé</th>
                                    <th>Ouvrage</th>
                                    <th>Etat</th>
                                    <th>Remplaçant</th>
                                </tr>
                            </thead>
                            <tbody id='tbody-details'>
                                <?php
                                foreach ($listeExe as $value) {  
                                    if(($value->etat == "Usé" || $value->etat == "Perdu") && $value->id_remplace == 0){                                         
                                ?>
                                <tr>
                                    <td><input style='width:100%' type='text' readOnly name="<?php echo 'codeBarre'.$value->id?>" class='form-control' id="<?php echo 'codeBarre'.$value->id?>" value="<?=$value->codeBarre?>"></td>

                                    <?php foreach($listeOuv as $values) {
                                        if($values->id == $value->id_ouvrage){?>
                                    <td><input style='width:100%' type='text' readOnly name="<?php echo 'titre'.$value->id?>" class='form-control' id="<?php echo 'titre'.$value->id?>" value="<?=$values->titre?>"></td>
                                        <?php }}?>

                                    <td><input style='width:100%' type='text' readOnly name="<?php echo 'etat'.$value->id?>" class='form-control' id="<?php echo 'etat'.$value->id?>" value="<?=$value->etat?>"></td>  

                                        <td> 
                                    <select class="form-control select2" style="border:1px solid #317EEB" required="" name="<?php echo 'id_remp'.$value->id?>" id="<?php echo 'id_remp'.$value->id?>">
                                    <option value="0"></option>
                                    <?php foreach($listeExe as $val){ 
                                        if($val->etat=="neuf" && $val->id_ouvrage==$value->id_ouvrage){?>
                                    <option value="<?=$val->id ?>"><?=$val->codeBarre ?></option>
                                    <?php
                                    }
                                    }
                                    ?>
                                    </select>
                                    </td>  
                                </tr> 
                            <?php 
                            }
                            }
                             ?>                                                        
                            </tbody>
                        </table>
                        <br>
                    <button type="submit"  onclick="" id="btn-save-ren" class="btn btn-primary waves-effect waves-light m-l-10 pull-right">Enregistrer</button>
                    </div>
                </div>
            </div>

        </div>
    </div>                            
</div>

<script>
    $(document).ready(function() {
$("#div-message").hide();

 // Select2
 jQuery(".select2").select2({
        width: '100%'
    }); 

var arr_details_exe=[];
var exe = <?php echo json_encode($listeExe)?>;
var ou = <?php echo json_encode($listeOuv)?>;


$.each(exe,function(key,values){
    $('#id_remp'+values.id).on("change",function(){
            exe={
                    'id1':values.id,
                    'id2': $('#id_remp'+values.id).val()
            }
            arr_details_exe.push(exe);
    });
});

$("#btn-save-ren").on("click",function(){

    data_post={
        "details":JSON.stringify(arr_details_exe)
    }

    $.post("<?php echo site_url(array("C_Achat","saveRen"));?>",
    data_post,
    function(data){
        if(data.statut=="succes"){
            alert("Enregistrement effectué");
            arr_details_exe.pop();
        }
        else{
            alert("Enregistrement non effectué");
        } 
    },
    "json");
    return false;
    })
      
});

</script>