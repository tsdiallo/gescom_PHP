<div class="row">
    <div class="col-md-4">
        <button type="button" id="btn-add" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#panel-modal">Ajouter</button>
    </div>
    <div class="col-md-8" >
        <div class="alert alert-success" id="div-message">
            <a href="#" class="alert-link"> aaaaaaaaaaaaaaaa</a>
        </div>
    </div>
</div>


 <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">

            <div class="panel-heading">
                <h3 class="panel-title">Liste Profils</h3>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table catlist table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listeProfil as $value) {                                           
                                ?>
                                <tr>
                                    <td><?=$value->id?></td>
                                    <td><?=$value->nom?></td>  
                                    <td>
                                        <button data-id="<?=$value->id?>" data-nom="<?=$value->nom?>" type="button"class="btn btn-warning waves-effect waves-light btn-edit" data-toggle="modal" data-target="#panel-modal"><i class="fa fa-edit"></i></button>
                                        <button data-id="<?=$value->id?>"type="button"data-toggle="modal" class="btn btn-danger waves-effect waves-light btn-delete "><i class="fa fa-trash-o"></i></button>
                                    </td>
                                </tr> 
                            <?php } ?>   
                                                                                    
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>        
</div>


<div id="panel-modal" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content p-0 b-0">

            <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h3 class="panel-title" id="h3_panel-title">Panel Primary</h3> 
                </div> 

                <div class="panel-body"> 
                    <form role="form" id="form" method="post" action="<?php echo site_url(array("C_Securite","saveProfil"));?>" >
                        <input type="hidden" name="id" id="id">
                        <div class="form-group" >
                            <label for="exampleInputEmail1">Nom</label>
                            <input type="text" style="border:1px solid #317EEB" name="nom" required="" class="form-control" id="nom" placeholder="Enter Un Nom">
                        </div>
                        <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Enregistrer</button>
                    </form>
                </div> 
                
            </div>
        </div>
    </div>
</div>


<script type="text/javascript">
            $(document).ready(function() {
                //cacher alert Message apres traitement
                $("#div-message").hide();
                
// ouvrir le formulaire d'ajout
                $("#btn-add").on("click",function(){
                    $("#h3_panel-title").empty().text("Ajout d'un profil");
                });  
                // evenement de click du bouton modification    

                $(".btn-edit").on("click",function(){
                    var id=$(this).data("id");
                    var nom=$(this).data("nom");
                    $("#id").val(id);
                    $("#nom").val(nom);
                    $("#h3_panel-title").empty().text("Modifier un profil");

                });
                //ajout insertion modification
                $("#form").on("submit",function(){
   
                   $.ajax({
                        url: $(this).attr("action"),
                        data: {
                            "id":$("#id").val(),
                            "nom":$("#nom").val()

                        },
                        type: 'post',
                        dataType:"json",

                                // La fonction à apeller si la requête aboutie
                                success: function (data) {
                                    if(data.statut=="succes"){
                                        alert("enregistrement effectué");

                                    }else{
                                        alert("enregistrement non effectué");
                                    }
                                },
                                complete :function(data){
                                },
                                // La fonction à appeler si la requête n'a pas abouti
                                error: function() {
                                    
                                }

                    });
                    
                   $("#panel-modal").modal('hide');
                   return false;
                     });

        // evenement de click du bouton modification    

        $(".btn-edit").on("click",function(){
            var id=$(this).data("id");
            var nom=$(this).data("nom");
            $("#id").val(id);
            $("#nom").val(nom);
            $("#h3_panel-title").empty().text("Modifier un profil");

        });

                     //suppression

                    $('.btn-delete').on("click",function(){
                        var result=confirm(" yes to delete");
                        if(result==true){

                        var id=$(this).data("id");

                        $.post("<?php echo site_url(array("C_Securite","deletePro"));?>",{"id":id},function(data){
                            if(data.statut=="succes"){
                                $("#div-message").text(data.message);
                                $("#div-message").show();
                            }

                        });
                        }

            });
                });
        </script>