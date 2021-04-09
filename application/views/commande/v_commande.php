<div class="row">
      <div class="col-md-8" >
                  <div class="alert alert-success" id="div-message">
                      <a href="#" class="alert-link">xxxxxxxxxxxxxxxxx</a>.
                   </div>
      </div> 
</div>


    <div class="row">

<!-- Client      -->
        <div class="col-md-6">
<!--  Rechercher Client      -->
             <div class="row">
                        <div class="col-md-12">
                                            <div class="panel panel-color panel-primary">
                                                <div class="panel-heading"> 
                                                    <h3 class="panel-title">Recherche Client</h3> 
                                                </div> 
                                                <div class="panel-body"> 
                                                <form role="form" id="form-recherche">
                                                        <div class="form-group">
                                                            <label for="exampleInputEmail1">Client</label>
                                                           <div class="form-group">
                                                             <label for=""></label>
                                                             <select class="form-control select2" name="client-id" id="client-id">
                                                            <option value="0"></option>
                                                             <?php    
                                                              foreach($all_data_client as  $value ){
                                                               ?>
                                                              <option value="<?=$value->id ?>"><?=$value->prenom .' '.$value->nom.' '.$value->telephone ?></option>
                                                              <?php
                                                              
                                                              }
                                                              ?>
                                                             </select>
                                                           </div>
                                                        </div>
                                                 </form>       
                                                </div> 
                                            </div>
                        </div>
           </div>
<!--  Enregistrer Client      -->
               <div class="row">
                            <div class="col-md-12">
                                            <div class="panel panel-color panel-primary">
                                                <div class="panel-heading"> 
                                                    <h3 class="panel-title">Nouveau Client</h3> 
                                                </div> 
                                                <div class="panel-body"> 
                                                <form  role="form" id="form-client" method="post" action="<?php echo site_url(array("C_Commande","saveClient"));?>">
                                                     <input type="hidden"  id="id-client" name="id-client"/>
                                                       <div class="form-group">
                                                            <label for="nom">Nom</label>
                                                            <input type="text" class="form-control" id="nom" name="nom" placeholder="Entrer le Nom">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="prenom">Prenom</label>
                                                            <input type="text" class="form-control" id="prenom" name="prenom" placeholder="Entrer le Prenom">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="telephone">Telephone</label>
                                                            <input type="text" class="form-control" id="telephone" name="telephone" placeholder="Entrer le Telephone">
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="email">Email </label>
                                                            <input type="email" class="form-control" id="email" name="email" placeholder="Entrer l'Email">
                                                        </div>

                                                        <div class="form-group"> 
                                                             <label for="adresse">Adresse</label>
                                                             <textarea class="form-control" name="adresse" id="adresse" rows="3" placeholder="Entrer l'Adresse">
                                                             </textarea>
                                                           
                                                        </div>
                                            
                                            <button type="submit" id="btn-save-client" class="btn btn-primary waves-effect waves-light pull-right">Enregistrer</button>
                                        </form>
                                                </div> 
                                            </div>
                             </div>

               </div>

        </div>
     <!-- Commande     -->
        <div class="col-md-6">
           <div class="row">

                           <div class="col-md-12">
                                            <div class="panel panel-color panel-primary">
                                                <div class="panel-heading"> 
                                                    <h3 class="panel-title">Nouvelle Commande</h3> 
                                                </div> 
                                                <div class="panel-body"> 
                                                <form class="form-inline" role="form" id="form-commande">
                                                        <div class="form-group">
                                                            <label class="sr-only" for="numero">Numero</label>
                                                            <input type="text" class="form-control" name="numero" id="numero" placeholder="Entrer le Numero">
                                                        </div>
                                                        
                                                        <div class="form-group m-l-10">
                                                            <label class="sr-only" for="date">Date</label>
                                                            <input type="date" class="form-control" name="date" id="date" placeholder="Entrer la Date">
                                                        </div>
                                                        <br><br>
                                                          <input type='hidden'  id="details-id-article" name="details-id-article"/>
                                                            
                                                              <div class="form-group col-md-6">
                                                                    <label for="">Reference</label>
                                                                            <select class="form-control select2" name="article-id" id="article-id">
                                                                                            <option value="0"></option>
                                                                                                <?php    
                                                                                            foreach($all_data_article as  $value ){
                                                                                            ?>
                                                                                            <option value="<?=$value->id ?>"><?=$value->reference .' '.$value->libelle ?></option>
                                                                                            <?php
                                                                                            
                                                                                            }
                                                                                            ?>
                                                                            </select>
                                                          
                                                             </div>
                                                             <br><br> <br><br>
                                                             <div class="form-group">
                                                            <label class="sr-only" for="libelle"></label>
                                                            <input type="text" class="form-control" disabled name="libelle" id="libelle" placeholder="Libelle">
                                                           </div>
                                                        
                                                          <div class="form-group m-l-10">
                                                            <label class="sr-only" for="pu"></label>
                                                            <input type="text" class="form-control" disabled name="pu" id="pu" placeholder="Unitaire">
                                                          </div>
                                                          <div class="form-group m-l-10">
                                                            <label class="sr-only" for="qtestock"></label>
                                                            <input type="text" class="form-control" disabled name="qtestock" id="qtestock" placeholder="Qte en Stock">
                                                          </div>
                                                          <br><br> 
                                                           <div class="form-group m-l-10">
                                                            <label class="sr-only" for="qtecom"></label>
                                                            <input type="number" class="form-control" name="qtecom" id="qtecom" placeholder="Entrer la Qte Commandée">
                                                          </div>
                                                          <button type="button" id="btn-add-article" class="btn btn-success waves-effect waves-light m-l-10">Ajouter</button>
                                           
                                              </form>
                                              <br><br> 
                                                   <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>Article</th>
                                                            <th>Pu</th>
                                                            <th>Qte Commandée</th>
                                                            <th></th>
                                                            

                                                        </tr>
                                                    </thead>
                                                    <tbody id='tbody-details'>
                                                    </tbody>
                                                    </table>
                                                    <br>
                                                    <button type="submit" id="btn-save-cmde" class="btn btn-primary waves-effect waves-light m-l-10 pull-right">Enregistrer</button>
                                                </div> 
                                            </div>
                             </div>
            </div>
            </div>
        
    </div>


<script>
  $(document).ready(function(){
   
    $('#datatable').dataTable();

   $("#div-message").hide();
 // Select2
               jQuery(".select2").select2({
                    width: '100%'
                });

$("#form-client").on("submit",function(){

  $.ajax({
      url:$(this).attr('action'),
      type:$(this).attr('method'),
      data:$(this).serialize(),
      dataType:"json",
      success:function(data){
        if(data.statut=="succes"){
            $("#id-client").val(data.id)
            //Effacer les Champ du Formulaire
             $("#form-client :input ").not("#id-client").each(function(){
                    $(this).val("");
            }); 

            $("#div-message").text(data.message)
            $("#div-message").show();
        }
      },
      complete:function(){
       
    },
    error:function(){

    }

  });

  return false;
});

//A la Selection d'un Client
$('#client-id').on("change",function(){
    var id_client= $(this).val();
    $("#id-client").val(id_client)
})


//A la Selection d'un Article 

$('#article-id').on("change",function(){
    var id_article= $(this).val();
    $.post("<?php echo site_url(array("C_Stock","getRecordArticle"));?>",
    {"id":id_article},
    function(data){
        $("#details-id-article").val(data.id)
        $("#libelle").val(data.libelle)
        $("#pu").val(data.pu)
        $("#qtestock").val(data.qtestock)
    },
    "json");
   
})

//Ajout Article dans la Table
var arr_details_cmde=[];
$("#btn-add-article").on("click",function(){
var trouve=searchArticle(
                        $("#details-id-article").val(), 
                        $("#qtecom").val());
if(arr_details_cmde.length==0)$("#tbody-details").empty();                       
if(trouve==false){
   article={
   "id": $("#details-id-article").val(),
   'qtecom':  $("#qtecom").val(),
   'pu':$("#pu").val() ,
   'libelle':$("#libelle").val()
   } 
  
   arr_details_cmde.push(article);
}
     generateTableHtml();
});

//Recheche de l'article dans le Tableau Details Commande
function searchArticle(idArticle,qteCom){
    var trouve=false;

    $.each(arr_details_cmde,function(key,value){
        if(value.id==idArticle) {
            trouve=true;
            value.qtecom= Number.parseInt(value.qtecom)+ Number.parseInt(qteCom)
        }
    });
      return trouve;
}

//Generation des Lignes de table Html

function generateTableHtml(){  
   var tr="";
   $("#tbody-details").empty();
    $.each(arr_details_cmde,function(key,value){ 
        tr=tr+"<tr><td>"+ value.libelle +"</td><td>"+value.pu+"</td><td>"+ value.qtecom +"</td><td><button data-id='1' type='button' class='btn btn-danger waves-effect waves-light btn-delete'><i class='fa fa-trash-o'></i></button></td></tr>" 
     });
     $("#tbody-details").append(tr);
}


$("#btn-save-cmde").on("click",function(){

  data_post={
      "numero":$("#numero").val(),
      "date":$("#date").val(),
      "client_id":$("#id-client").val(),
      "details":JSON.stringify(arr_details_cmde) 
  }

    $.post("<?php echo site_url(array("C_Commande","saveCommande"));?>",
    data_post,
    function(data){
        if(data.statut=="succes"){
            $("#form-commande")[0].reset();
            $("#form-recherche")[0].reset();
            $("#form-client")[0].reset();
            $("#tbody-details").empty();
            $("#div-message").text(data.message)
            $("#div-message").show();

        }else{
            var li=""
           $.each(data.message,function(key,value){
                  li=li+"<li>"+value+"</li>";
           } );
            $("#div-message").html("<ul>"+li+"</ul>")
            $("#div-message").show();


        }
           
    },
    "json");
    return false;

})

});




</script>