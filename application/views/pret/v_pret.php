        
    <div class="col-md-7"  style="margin-left:230px;">
        <div class="row">
            <div class="col-md-12" >
                <div class="panel panel-color panel-primary" style="padding:10px" >

                    <div class="panel-heading"> 
                        <h3 class="panel-title">Pret</h3> 
                    </div> 

                    <div class="panel-body"> 
                        <form class="" role="form" id="form-pret">
                        
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="date">Date</label>
                                <input type="text" readOnly  style="border:1px solid #317EEB"  class="form-control" name="date" id="date" value="<?=date("d/m/Y") ?>">
                            </div>

                            <div class="form-group col-md-6">
                                <label class="sr-only" for="numero" >Date retour</label>
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="<?=date("d/m/Y") ?>" name="dateR" id="dateR" >
                            </div>
                              
                            <div class="form-group col-md-6">
                                <label for="">Emprunteur</label>
                                <select class="form-control select2" style="border:1px solid #317EEB" required="" name="id_emp" id="id_emp">
                                    <option value="0"></option>
                                    <?php    $i=0;
                                    foreach($listeEmp as  $value ){
                                        foreach($listePret as $values){
                                            if($values->codeEmprunteur == $value->codeBarre && $values->etat == "Non retourné"){
                                                $i=1;
                                            }
                                        }
                                        if($i==0){
                                    ?>
                                        <option value="<?=$value->id ?>"><?=$value->prenom ?> <?=$value->nom ?></option>
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
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="" name="prenom" id="prenom" placeholder="Prenom" >
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="numero" >Nom</label>
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="" name="nom" id="nom" placeholder="Nom">
                            </div>

                            <div class="form-group col-md-6" style="height:65px; width:100px;">
                            </div>

                            <div class="form-group col-md-6" style="margin-left:-100px">
                                <label for="">Exemplaire</label>
                                <select class="form-control select2" style="border:1px solid #317EEB" required="" name="id_exe" id="id_exe">
                                    <option value="0"></option>
                                    <?php    
                                    foreach($listeExe as  $value ){
                                        foreach($listeOuv as  $values ){
                                        if(($value->id_ouvrage == $values->id) && $value->etat != "Usé" && $value->etat != "Emprunté" && $value->etat != "Perdu" && $value->etat != "Remplacé"){
                                        ?>
                                            <option value="<?=$value->id ?>"><?=$values->titre?> <?=$value->codeBarre?> </option>
                                        <?php
                                            }
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6" style="height:65px; width:100px;">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="numero" >Titre</label>
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="" name="titre" id="titre" placeholder="Titre">
                            </div>
                            
                            <div class="form-group col-md-6">
                                <label class="sr-only" for="numero" >Auteur</label>
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="" name="auteur" id="auteur" placeholder="Auteur">
                            </div>

                            <div class="form-group col-md-6">
                                <button type="button" id="btn-add-ex" class="btn btn-primary waves-effect waves-light m-l-10">Ajouter</button>
                            </div>



                            <div class="form-group col-md-6">
                                <input type='hidden'  id="codeEmp" name="codeEmp"/>
                                <input type='hidden'  id="codeExe" name="codeExe"/>
                            </div>

                        </form>
                    </div>


                    <table id="datatable" class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Code barre</th>
                                <th>Exemplaire</th>
                            </tr>
                        </thead>
                        <tbody id='tbody-details'>

                        </tbody>
                    </table>

                    <br>

                    <button style="margin-top:20px;" type="submit" id="btn-save-pret" class="btn btn-primary waves-effect waves-light m-l-10 pull-right">Enregistrer</button>
               
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

//A LA SELECTION DUN EXEMPLAIRE
$('#id_exe').on("change",function(){
    var id_exe=$(this).val();
    $.post("<?php echo site_url(array("C_Achat","getRecordExe"));?>",{"id":id_exe},function(data){
    $("#codeExe").val(data.codeBarre)
    
    $.post("<?php echo site_url(array("C_Achat","getRecordOuv"));?>",{"id":data.id},function(datas){
    $("#titre").val(datas.titre),
    $("#auteur").val(datas.auteur)
    }, "json");

    }, "json");

})
//A LA SELECTION DUN EMPRUNTEUR
$('#id_emp').on("change",function(){
    var id_emp=$(this).val();
    $.post("<?php echo site_url(array("C_Inscription","getRecordEmp"));?>",{"id":id_emp},function(data){
    $("#codeEmp").val(data.codeBarre),
    $("#prenom").val(data.prenom),
    $("#nom").val(data.nom)
    }, "json")

})

//Ajout ouvrage dans la Table
var arr_details_pret=[];
var i = 0;
$("#btn-add-ex").on("click",function(){

if(arr_details_pret.length==0) $("#tbody-details").empty();      
        exe={
            "id": $("#id_exe").val(),
            'codeBarre':  $("#codeExe").val(),
            'titre':$("#titre").val()
        }
        if(arr_details_pret.length < 3){
            $.each(arr_details_pret,function(key,value){ 
                if(value.titre==exe.titre){value.codeBarre=exe.codeBarre; value.id=exe.id; i=1;}
            });
            if(i!=1){
                arr_details_pret.push(exe);
            }
        }

     generateTableHtml();  
});

//Generation des Lignes de table Html

function generateTableHtml(){
   var tr="";
   $("#tbody-details").empty();
    $.each(arr_details_pret,function(key,value){ 
        tr=tr+"<tr><td>"+ value.codeBarre +"</td><td>"+value.titre+"</td></tr>" 
     });
     $("#tbody-details").append(tr);
}


$("#btn-save-pret").on("click",function(){

    data_post={
        "dateR":$("#dateR").val(),
        "date":$("#date").val(),
        "codeEmp":$("#codeEmp").val()
    }

    $.post("<?php echo site_url(array("C_Pret","savePret"));?>",
    data_post,
    function(data){
            $.post("<?php echo site_url(array("C_Pret","saveDetailsPret"));?>",
            {   "id":data.id,
                "details":JSON.stringify(arr_details_pret)},
                    function(datas){
                        if(datas.statut=="succes"){
                            $("#form-pret")[0].reset();
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
    
    },
    "json");
     return false;
})

       
});

</script>