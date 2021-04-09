<div class="row"> 
    <div class="col-md-5" >
        <div class="row">
            <div class="col-md-12" >
                <div class="panel panel-color panel-primary" style="padding:10px" >

                    <div class="panel-heading"> 
                        <h3 class="panel-title">Retour pret</h3> 
                    </div> 

                    <div class="panel-body"> 
                        <form class="" role="form" id="form-rpret">
                        
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="date">Date retour</label>
                                <input type="text" readOnly  style="border:1px solid #317EEB"  class="form-control" name="date" id="date" value="<?=date("d/m/Y") ?>">
                            </div>
                              
                            <div class="form-group col-md-6" style="height:40px; width:100px;">
                            </div>

                            <div class="form-group col-md-6">
                                <label for="">Emprunteur</label>
                                <select class="form-control select2" style="border:1px solid #317EEB" required="" name="id_emp" id="id_emp">
                                    <option value="0"></option>
                                    <?php    
                                    foreach($listeEmp as  $value ){
                                        $i=0;
                                        foreach($listePret as $pre){
                                            if($pre->etat == "Non retourné" && $pre->codeEmprunteur==$value->codeBarre){
                                                $i=1;
                                            }
                                        }
                                        if($i==1){
                                    ?>
                                        <option value="<?=$value->codeBarre?>"><?=$value->prenom ?> <?=$value->nom ?></option>
                                    <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div class="form-group col-md-6" style="height:65px; width:100px;">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="sr-only" for="numero" >Prenom</label>
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="" name="prenom" id="prenom" placeholder="Prenom emprunteur">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="numero" >Nom</label>
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="" name="nom" id="nom" placeholder="Nom emprunteur">
                            </div>


                            <div class="form-group col-md-6">
                                <label class="sr-only" for="numero" >Date pret</label>
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="" name="datep" id="datep" placeholder="Date pret" >
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="numero" >Date retour pret</label>
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="" name="daterp" id="daterp" placeholder="Date retour pret">
                            </div>

                            <div class="form-group col-md-6">
                                <input type='hidden'  id="codeEmp" name="codeEmp"/>
                                <input type='hidden'  id="id_pret" name="id_pret"/>
                            </div>

                        </form>
                    </div>


                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Code barre</th>
                                <th>Exemplaire</th>
                                <th>Etat</th>
                            </tr>
                        </thead>
                        <tbody id='tbody-details'>

                        </tbody>
                    </table>

                    <br>

                    <button style="margin-top:20px;" type="submit" id="btn-save-rpret" class="btn btn-primary waves-effect waves-light m-l-10 pull-right">Enregistrer</button>
               
                </div> 
            </div>
        </div>
    </div>

    <div class="col-md-7">
    <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Emprunteur</th>
                            <th>Date pret</th>
                            <th>Date retour</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                            foreach($listePret as $pre){
                                if($pre->etat == "Non retourné"){
                        ?>
                        <tr>
                            <th><?= $pre->codeEmprunteur ?></th>
                            <th><?= $pre->date ?></th>
                            <th><?= $pre->dateretour ?></th>
                                    <td>
                                        <button data-id="<?=$value->id?>"  type="button"class="btn btn-warning waves-effect waves-light btn-relance" data-toggle="modal" data-target="#panel-modal">Relance</button>
                                        <button data-id="<?=$value->id?>"type="button" class="btn btn-danger waves-effect waves-light btn-courrier " data-toggle="modal" data-target="#panel-modal">Remboursement</button>
                                    </td>
                        </tr>
                        <?php
                                }
                            }
                        ?>

                    </tbody>
                </table>
    </div>

</div>
<script>
    $(document).ready(function() {
$("#div-message").hide();

 // Select2
 jQuery(".select2").select2({
        width: '100%'
    });

var arr_details_pre=[];
var arr_details_pret=[];
var detp = <?php echo json_encode($listeDetp)?>;
var ex = <?php echo json_encode($listeExe)?>;
var pre = <?php echo json_encode($listePret)?>;
var ou = <?php echo json_encode($listeOuv)?>;
//A LA SELECTION DUN EMPRUNTEUR
$('#id_emp').on("change",function(){
    var id_emp=$(this).val();

    $.post("<?php echo site_url(array("C_RPret","getRecordPret"));?>",{"id":id_emp},function(data){
        $.post("<?php echo site_url(array("C_RPret","getRecordEmp"));?>",{"code":data.codeEmprunteur},function(datas){
            $("#codeEmp").val(data.codeEmprunteur),
            $("#id_pret").val(data.id),
            $("#datep").val(data.date),
            $("#daterp").val(data.dateretour)

            $("#prenom").val(datas.prenom),
            $("#nom").val(datas.nom)
        }, "json");

    }, "json");

    
    $.each(pre,function(key,value){
        if(value.codeEmprunteur==id_emp && value.etat=="Non retourné") {
            $.each(detp,function(key,values){
                if(values.id_pret==value.id){
                    exe={
                        'id':values.id,
                        'titre':values.titre,
                        "codeBarre": values.codeBarre
                    }
                    arr_details_pret.push(exe);
                }
            });
        }
        });
    generateTableHtml();

})

//Generation des Lignes de table Html

function generateTableHtml(){
   var tr="";
   $("#tbody-details").empty();
    $.each(arr_details_pret,function(key,value){
        tr=tr+"<tr><td>"+ value.codeBarre +"</td><td>"+value.titre+"</td><td><select class='form-control select2' name='id_etat' id='id_etat"+ value.id +"'><option value='Bon etat'>Bon etat</option><option value='Usé'>Usé</option><option value='Perdu'>Perdu</option></select></td></tr>"
     });
     $("#tbody-details").append(tr);
}


$("#btn-save-rpret").on("click",function(){
    $.each(arr_details_pret,function(key,values){
        exe={
                'etat':$("#id_etat"+values.id).val(),
                'titre':values.titre,
                "codeBarre": values.codeBarre
            }
                    arr_details_pre.push(exe);
    });

    data_post={
        "id_pret":$("#id_pret").val(),
    }
    $.post("<?php echo site_url(array("C_RPret","getRecordPret1"));?>",
    data_post,
    function(data){
        if(data.id!=0){
        $.post("<?php echo site_url(array("C_RPret","updatePret"));?>",
            {"id":data.id, "codeEmprunteur":data.codeEmprunteur, "date":data.date, "dateretour":data.dateretour},
                function(dat){
        if(dat.statut=="succes"){
            da={"details":JSON.stringify(arr_details_pre)}
        $.post("<?php echo site_url(array("C_RPret","saveRPret"));?>",
        da,
        function(datas){

        if(datas.statut=="succes"){
            $("#form-rpret")[0].reset();
            $("#id_emp").val("")   
            $("#id_exe").val("")
            $("#codeEmp").val("")   
            $("#codeExe").val("")
            $("#auteur").val("")
            $("#titre").val("")
            $("#nom").val("")
            $("#prenom").val("")
            $("#tbody-details").empty();
            alert("Enregistrement effectué");
        }else{
            alert("Enregistrement non effectué");
        }
           
           
    },
    "json");

        }else{
            alert("Pret non modifié")
        }
           
    },
    "json");

        }else{
            alert("Pret non trouvé")
        }

    },
    "json");
     return false;
})

       
});

</script>