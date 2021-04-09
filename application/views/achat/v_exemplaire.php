
<div class="row">
    <!-- Commande     -->
    <div class="col-md-7">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-color panel-primary" style="padding:10px">

                    <div class="panel-heading"> 
                        <h3 class="panel-title">Enregistrement exemplaires</h3> 
                    </div> 

                    <div class="panel-body">
                        <form class="" role="form" id="form-commande">
                            <div class="form-group col-md-6">
                                <label for="">Numero commande</label>
                                <select class="form-control select2" style="border:1px solid #317EEB" required="" name="id_com" id="id_com">
                                    <option value="0"></option>
                                    <?php    
                                    foreach($listeCom as  $value ){
                                        if($value->etat == "Pas livree"){
                                    ?>
                                            <option value="<?=$value->id ?>"><?=$value->numero ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                                
                            <div class="form-group col-md-6" style="height:65px; width:100px;">
                            <input type="hidden" name="id_commande" class="form-control" id="id_commande">
                            <input type="hidden" name="id_" class="form-control" id="id_">
                            </div>
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="date">Date</label>
                                <input type="text" value="<?=date("d/m/Y") ?>" readOnly style="border:1px solid #317EEB" class="form-control" name="date" id="date">
                            </div>
                            
                            <div class="form-group col-md-6" style="height:65px; width:100px;">
                            </div>
                            <table id="datatable" class="table table-striped table-bordered">
                                <thead>
                                    <tr>
                                        <th>Ouvrage</th>
                                        <th>valeur</th>
                                        <th>Duree</th>
                                        <th>Quantite livree</th>
                                        <th>Id ouvrage</th>
                                    </tr>
                                </thead>
                                
                                <tbody id='tbody-details'>

                                </tbody>
                            </table>

                            <br>
                            <button type="submit" id="btn-save-liv" class="btn btn-primary waves-effect waves-light m-l-10 pull-right">Enregistrer</button>
                
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
    
    <div class="col-md-12">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Les Exemplaires</h3>
            </div>

            <div class="panel-body"> 
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Code barre</th>
                            <th>Titre</th>
                            <th>Valeur</th>
                            <th>Date</th>
                            <th>Duree</th>
                            <th>Etat</th>
                            <th>Remplaçant</th>
                        </tr>
                    </thead>
                    <tbody id='tbody-details'>
                        <?php
                            foreach($listeExe as $exe){
                        ?>
                        <tr>
                            <th><?= $exe->codeBarre ?></th>
                            <?php
                            foreach($listeOuv as $ouv){
                                if($ouv->id==$exe->id_ouvrage){
                            ?>
                                    <th><?= $ouv->titre ?></th>
                            <?php
                                }
                            }
                            ?>
                            <th><?= $exe->valeur ?></th>
                            <th><?= $exe->date ?></th>
                            <th><?= $exe->duree ?></th>
                            <th><?= $exe->etat ?></th>

                            <th><?= $exe->id_remplace?></th>
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

<script>

    
$(document).ready(function() {
 // Select2
 jQuery(".select2").select2({
                    width: '100%'
       });


//A LA SELECTION DUNE COMMANDE
var arr_details_cmde=[];
var arr_details_ouv=[];
var arr_details_det=[];
var det = <?php echo json_encode($listeDet)?>;
var ou = <?php echo json_encode($listeOuv)?>;
$('#id_com').on("change",function(){
    var tr="";
    var idcom=$(this).val();
    if($("#id_commande").val() == ""){
    $.post("<?php echo site_url(array("C_Achat","getRecordCom"));?>",{"id":idcom},function(data){
    $("#id_commande").val(data.numero)
    }, "json");

    $.each(det,function(key,value){
        if(value.id_commande==idcom) {
            $.each(ou,function(key,values){
                if(values.id==value.id_ouvrage){
                    ouv={
                        "id": values.id,
                        'titre':values.titre,
                    }
                    arr_details_ouv.push(ouv);
                }
            });
        }
        });
    generateTableHtml(); 
}else{
    var tr="";
    var idcom=$(this).val();
   $("#tbody-details").empty();
   $("#id_commande").val("");
   $("#id_com").val("");
   arr_details_ouv.pop();
   
    $.post("<?php echo site_url(array("C_Achat","getRecordCom"));?>",{"id":idcom},function(data){
    $("#id_commande").val(data.numero)
    }, "json");

    $.each(det,function(key,value){
        if(value.id_commande==idcom) {
            $.each(ou,function(key,values){
                if(values.id==value.id_ouvrage){
                    ouv={
                        "id": values.id,
                        'titre':values.titre,
                    }
                    arr_details_ouv.push(ouv);
                }
            });
        }
        });
        generateTableHtml();
}

});

function generateTableHtml(){
   var tr="";
   $("#tbody-details").empty();
        $.each(arr_details_ouv,function(key,values){ 
                 tr=tr+"<tr><td>"+ values.titre +"</td><td><input style='width:100%' type='number' name='valeur"+values.id+"' class='form-control' id='valeur"+values.id+"'></td><td><input type='number' style='width:100%' name='duree"+values.id+"' class='form-control' id='duree"+values.id+"'></td><td><input type='number' style='width:100%' name='qteliv"+values.id+"' class='form-control' id='qteliv"+values.id+"'></td><td>"+values.id+"</td></tr>" 
        });
     $("#tbody-details").append(tr);
}

$("#btn-save-liv").on("click",function(){
    var det = <?php echo json_encode($listeDet)?>;
    var idcom = $("#id_commande").val();
    var id_ = $("#id_").val();
    $.each(arr_details_ouv,function(key,values){
        
    $.each(det,function(key,value){
        if(value.id_ouvrage=values.id){
        var qteliv = $("#qteliv"+values.id).val();
        if(value.qtecom >= qteliv){
        for(i=1; i<=qteliv; i++){
            exe={
                    "id": "",
                    'valeur':$("#valeur"+values.id).val(),
                    "duree": $("#duree"+values.id).val(),
                    "id_ouvrage": values.id,
                    "etat": "neuf",
                    "id_remplace": "",
                    "date": $("#date").val(),
                    "idcom": $("#id_commande").val()
                }
                arr_details_cmde.push(exe);
                deta={
                    "id":value.id,
                    "qteliv":qteliv
                }
                arr_details_det.push(deta);
        }
        }else if(value.qtecom < qteliv){ 
            for(i=1; i<=value.qtecom; i++){
            exe={
                    "id": "",
                    'valeur':$("#valeur"+values.id).val(),
                    "duree": $("#duree"+values.id).val(),
                    "id_ouvrage": values.id,
                    "etat": "neuf",
                    "id_remplace": "",
                    "date": $("#date").val(),
                    "idcom": $("#id_commande").val()
                }
                arr_details_cmde.push(exe);
                deta={
                    "id":value.id,
                    "qteliv":value.qtecom
                }
                arr_details_det.push(deta);
        }

        }
        }
    });

    });
    
    data_post={
        "details":JSON.stringify(arr_details_cmde),
        "detail":JSON.stringify(arr_details_det)
    }
    $.post("<?php echo site_url(array("C_Achat","saveExe"));?>",
    data_post,
    function(data){
        
        $.post("<?php echo site_url(array("C_Achat","updateCom"));?>",
        {"numero":data.numero,
            "id":data.id,
            "date":data.date,
            "id_editeur":data.id_editeur
        },
        function(datas){
        if(datas.statut=="succes"){
            var tr="";
            $("#tbody-details").empty();
            $("#id_commande").val("");
            $("#id_com").val("");
            arr_details_ouv.pop();
            arr_details_cmde.pop();
            alert("Enregistrement effectué");
        }
        else{
            alert("Enregistrement non effectué");
        }
    }, "json");

    },
    "json");
            return false;
    })

});
</script>


