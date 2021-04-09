<div class="row">

    <!-- Commande     -->
    <div class="col-md-7" id="com">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-color panel-primary" style="padding:10px">

                    <div class="panel-heading"> 
                        <h3 class="panel-title" id="azer">Nouvelle Commande</h3> 
                    </div> 

                    <div class="panel-body"> 
                        <form class="" role="form" id="form-commande">
                            <div class="form-group col-md-6   azer">
                                <label for="numero" >Numero</label>
                                <input type="text" style="border:1px solid #317EEB" class="form-control" disabled value="<?php $code=bin2hex(random_bytes(3)); echo 'BC '.$code.' '.date('d').' '.date('y') ?>" name="numero" id="numero" placeholder="Entrer le Numero">
                            </div>
                            
                            <div class="form-group col-md-6   azer   date1">
                                <label for="date">Date</label>
                                <input type="text" readOnly  style="border:1px solid #317EEB;"  class="form-control" name="date" id="date" value="<?=date("d/m/Y") ?>">
                            </div>
                                
                            <div class="form-group col-md-6   azer">
                                <label for="">Editeur</label>
                                <select class="form-control select2 " style="border:1px solid #317EEB" required="" name="id_edit" id="id_edit">
                                    <option value="0"></option>
                                    <?php    
                                    foreach($listeEdit as  $value ){
                                    ?>
                                    <option value="<?=$value->id ?>"><?=$value->nom ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                                
                            <div id="azer" class="form-group col-md-6   azer" style="height:65px; width:100px;">
                            </div>
                            
                            <div class="form-group col-md-6   azer   date1">
                                <label for="">Ouvrage</label>
                                <select class="form-control select2" style="border:1px solid #317EEB" required="" name="id_ouv" id="id_ouv">
                                    <option value="0"></option>
                                    <?php    
                                    foreach($listeOuv as  $value ){
                                    ?>
                                    <option value="<?=$value->id ?>"><?=$value->titre ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                            
                            <div id="azer" class="form-group col-md-6" style="height:65px; width:100px;">
                            </div>

                            <div class="form-group col-md-6" id="azer">
                            <label for="">Quantite commande</label>
                                <input type="number" required="" style="border:1px solid #317EEB" class="form-control" name="qtecom" id="qtecom" placeholder="Entrer la Qte Commandée">
                            </div>

                            <div id="azer" class="form-group col-md-6" style="height:10px; width:100px;">
                            </div>

                            <div class="form-group col-md-6">
                                <button type="button" id="btn-add-ouvr" class="btn btn-primary waves-effect waves-light m-l-10">Ajouter</button>
                            </div>

                            <div class="form-group col-md-6">
                                <input type='hidden'  id="details-id-ouv" name="details-id-ouv"/>
                            </div>

                            <div class="form-group col-md-6">
                                <input type='hidden'  id="titre" name="titre"/>
                            </div>
                                <input type='hidden'  id="id_edi" name="id_edi"/>
                        </form>
                    </div>

                    <br><br> 

                    <table id="datatable" class="table table-striped table-bordered   tab">
                        <thead>
                            <tr>
                                <th class="text-center">Id</th>
                                <th class="text-center">Ouvrage</th>
                                <th class="text-center a">Quantite</th>
                            </tr>
                        </thead>
                        <tbody id='tbody-details'>

                        </tbody>
                    </table>

                    <br>
                    <button type="submit" style="margin-top:20px;" onclick="" id="btn-save-cmde" class="btn btn-primary waves-effect waves-light m-l-10 pull-right   aze">Enregistrer</button>
                    <div class="form-group" id="azer" >
                <button onclick="window.print(); return false;" style="margin-top: 20px;" type="submit" name="btn_submit" value="btn_imprimer" class="btn btn-primary">Imprimer</button>
            </div>
                </div> 
            </div>
        </div>
    </div>

    
    <!-- Commande     -->
    <div class="col-md-5" id="azer">
        <div class="row">

            <div class="col-md-12">
                <div class="panel panel-color panel-success" style="padding:10px">

                    <div class="panel-heading"> 
                        <h3 class="panel-title">Nouvel editeur</h3> 
                    </div> 

                    <div class="panel-body"> 
                        <form class="" role="form" id="form-edit" method="post" action="<?php echo site_url(array("C_Achat","saveEdit"));?>">
                        <input type="hidden" class="form-control" id="id-edit" name="id-edit"> 
                            <div class="form-group ">
                                <label for="">Nom</label>
                                <input type="text" class="form-control" style="border:1px solid #33B86C" required="" id="nom" name="nom" placeholder="Entrer nom">
                            </div>
                            
                            <div class="form-group ">
                                <label for="">Email</label>
                                <input type="email" class="form-control" style="border:1px solid #33B86C" required="" id="email" name="email" placeholder="Entrer email">
                            </div>

                            <div class="form-group ">
                                <button type="submit" id="btn-add-edit" class="btn btn-success waves-effect waves-light m-l-10">Ajouter</button>
                            </div>

                        </form>
                    </div>
                </div> 
            </div>
            
            <div class="col-md-12">
                <div class="panel panel-color panel-success" style="padding:10px">

                    <div class="panel-heading"> 
                        <h3 class="panel-title">Nouvel ouvrage</h3> 
                    </div> 

                    <div class="panel-body"> 
                        <form class="" role="form" id="form-ouv" method="post" action="<?php echo site_url(array("C_Achat","saveOuv"));?>">
                        <input type="hidden" class="form-control" id="id-ouv" name="id-ouv"> 
                            <div class="form-group ">
                                <label for="">Titre</label>
                                <input type="text" class="form-control" style="border:1px solid #33B86C" required="" id="titre" name="titre" placeholder="Entrer titre">
                            </div>
                            
                            <div class="form-group ">
                                <label for="">Auteur</label>
                                <input type="text" class="form-control" style="border:1px solid #33B86C" required="" id="auteur" name="auteur" placeholder="Entrer auteur">
                            </div>
                            <input type="hidden" class="form-control" id="resume" name="resume">
                            <input type="hidden" class="form-control" id="mots" name="mots">
                            
                            <div class="form-group ">
                                <button type="submit" id="btn-add-ouv" class="btn btn-success waves-effect waves-light m-l-10">Ajouter</button>
                            </div>
                            
                        </form>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>

<style>
    @media print {
        #azer{
            display: none;
        }
        .aze{
            display: none;
        }
        #com{
            display: block;
            width: 700px;
            margin-left: 150px;
        }
        #btn-add-ouvr{
            display:none;
        }
        .azer{
            width:200px;
        }
        .date{
            margin-left:300px;
            margin-top:-75px;
        }
        .date1{
            margin-left:600px;
            margin-top:-75px;
        }
        .tab{
            margin-left:100px;
            margin-top:-50px;
            border:2px solid black;
        }
        .a{
            padding-left:-15px;
            padding-right:-15px
        }

    }

</style>


<script>
    $(document).ready(function() {

$("#div-message").hide();

 // Select2
 jQuery(".select2").select2({
                    width: '100%'
       });
$("#form-edit").on("submit",function(){
    $.ajax({
        url: $(this).attr("action"),
        data:$(this).serialize(),
        type: $(this).attr("method"),
        dataType:"json",


         success: function (data) {
            if(data.statut=="succes"){
                $("#id_edit").val(data.id)
                $("#form-edit :input").not("#id-edit").each(function(){
                    $(this).val("");
    
                });

            $("#div-message").text(data.message);
               $("#div-message").show();

                }
               },

                complete :function(data){
                   },
                   // La fonction à appeler si la requête n'a pas abouti
                    error: function() {
                                    
                   }
    });
    return false;
});

$('#id-edit').on("change",function(){
    var idedit=$(this).val();
    $("#id_edit").val(idedit)
})


$("#form-ouv").on("submit",function(){
    $.ajax({
        url: $(this).attr("action"),
        data:$(this).serialize(),
        type: $(this).attr("method"),
        dataType:"json",


         success: function (data) {
            if(data.statut=="succes"){
                $("#id-ouv").val(data.id)
                $("#form-ouv :input").not("#id-ouv").each(function(){
                    $(this).val("");
                });

            $("#div-message").text(data.message);
               $("#div-message").show();

                }
               },

                complete: function(data){
                   },
                   // La fonction à appeler si la requête n'a pas abouti
                    error: function() {
                                    
                   }
    });
    return false;
});

$('#id-ouv').on("change",function(){
    var idouv=$(this).val();
    $("#id_ouv").val(idouv)
})


//A LA SELECTION DUN OUVRAGE
$('#id_ouv').on("change",function(){
    var id_ou=$(this).val();
    $.post("<?php echo site_url(array("C_Achat","getRecordOuve"));?>",{"id":id_ou},function(data){
    $("#details-id-ouv").val(id_ou)
    $("#titre").val(data.titre)
    }, "json")

})
//A LA SELECTION DUN EDITEUR
$('#id_edit').on("change",function(){
    var id_edit=$(this).val();
    $("#id_edi").val(id_edit)

})

//Ajout ouvrage dans la Table
var arr_details_cmde=[];
$("#btn-add-ouvr").on("click",function(){
var trouve=searchOuv(
                        $("#details-id-ouv").val(), 
                        $("#qtecom").val());
if(arr_details_cmde.length==0) $("#tbody-details").empty();                       
if(trouve==false){
        ouv={
            "id": $("#details-id-ouv").val(),
            'qtecom':  $("#qtecom").val(),
            'titre':$("#titre").val()
        }
        arr_details_cmde.push(ouv);
}
     generateTableHtml(); 
     $("#qtecom").val("")   
     $("#id_ouv").val("")
});

///Recheche de l'article dans le Tableau Details Commande
function searchOuv(idOuv,qtecom){
    var trouve=false;

    $.each(arr_details_cmde,function(key,value){
        if(value.id==idOuv) {
            trouve=true;
            value.qtecom= Number.parseInt(value.qtecom)+ Number.parseInt(qtecom)
        }
    });
      return trouve;
}
//Generation des Lignes de table Html

function generateTableHtml(){
   var tr="";
   $("#tbody-details").empty();
    $.each(arr_details_cmde,function(key,value){ 
        tr=tr+"<tr><td class='text-center'>"+ value.id +"</td><td class='text-center'>"+value.titre +"</td><td class='text-center'>"+value.qtecom +"</td></tr>" 
     });
     $("#tbody-details").append(tr);
     $("#id_ouv").val("")
}


$("#btn-save-cmde").on("click",function(){

    data_post={
        "numero":$("#numero").val(),
        "date":$("#date").val(),
        "id_edit":$("#id_edi").val(),
        "details":JSON.stringify(arr_details_cmde)
    }

    $.post("<?php echo site_url(array("C_Achat","saveCommande"));?>",
    data_post,
    function(data){
        if(data.statut=="succes"){
            alert("Enregistrement effectué")
        }else{
            alert("Enregistrement non effectué")
        }
           
    },
    "json");
            $("#form-commande")[0].reset();
            $("#qtecom").val("")   
            $("#id_ouv").val("")
            $("#id_edit").val("")
            $("#form-edit")[0].reset();
            $("#form-ouv")[0].reset();
            $("#tbody-details").empty();
     return false;
})

});

</script>
          