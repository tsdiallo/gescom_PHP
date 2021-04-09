<div class="row" style="margin-bottom: 10px;    margin-left: 1.5px">
   <div class="col-md-4">
       <button type="button" id="btn-add" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#panel-modal">Ajouter</button>
   </div>
      <div class="col-md-8" >
                  <div class="alert alert-success" id="div-message">
                      <a href="#" class="alert-link">xxxxxxxxxxxxxxxxx</a>.
                   </div>
      </div>

</div>
 <div class="row">
                            <div class="col-md-12">
                                <div class="panel panel-default">
                                    <div class="panel-heading">
                                        <h3 class="panel-title">Liste des Catégorie</h3>
                                    </div>
                                    <div class="panel-body">
                                        <div class="row">
                                            <div class="col-md-12 col-sm-12 col-xs-12">
                                                <table id="datatable" class="table table-striped table-bordered">
                                                    <thead>
                                                        <tr>
                                                            <th>ID</th>
                                                            <th>Libelle</th>
                                                            <th></th>

                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                    <?php

                                                    foreach($all_data as  $value ){
                                                      ?>
                                                        <tr>
                                                            <td><?=$value->id?></td>
                                                            <td><?=$value->libelle?></td>
                                                            <td>
                                                            <button   data-id="<?=$value->id?>" data-libelle="<?=$value->libelle?>" type="button" class="btn btn-warning waves-effect waves-light  btn-edit" data-toggle="modal" data-target="#panel-modal"><i class="fa fa-edit"></i></button>
                                                            <button    data-id="<?=$value->id?>"  type="button" class="btn btn-danger waves-effect waves-light btn-delete" ><i class="fa fa-trash-o"></i></button>
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
                                                            <h3 class="panel-title" id="h3_pannel-title">Panel Primary</h3>
                                                        </div>
                                                        <div class="panel-body" >
                                                        <form role="form" id="form" method="post" action="<?php echo site_url(array("C_Stock","save")); ?>">
                                                           <input type="hidden" name="id"  id="id">
                                                           <div class="form-group">
                                                          <label for="exampleInputEmail1">Libelle</label>
                                                          <input type="text" name="libelle" class="form-control" id="libelle" placeholder="Enter Un Libelle">
                                            </div>


                                            <button type="submit" class="btn btn-success waves-effect waves-light pull-right">Enregistrer</button>
                                        </form>
                                                        </div>
                                                    </div>
                                                </div><!-- /.modal-content -->
                                            </div><!-- /.modal-dialog -->
                                        </div><!-- /.modal -->



                                        <script type="text/javascript">
            $(document).ready(function() {
                $('#datatable').dataTable();
//Cacher alert Message apres traitement
               $("#div-message").hide();
 //Ouvrir le Formulaire d'ajout
                $("#btn-add").on("click",function(){
                      $("#h3_pannel-title").empty().text("Ajout d'une Catégorie");
                });
  //Au clique du Bouton de Modification              
                $(".btn-edit").on("click",function(){
                    var id=$(this).data("id");
                    var libelle=$(this).data("libelle");
                    $("#id").val(id);
                    $("#libelle").val(libelle);

                      $("#h3_pannel-title").empty().text("Modification d'une Catégorie");
                });

//Insertion et la Modification

          $("#form").on("submit",function(){
              $.ajax({

               url:  $(this).attr("action"),
               data:{
                   "id":$("#id").val(),
                   "libelle":$("#libelle").val()
               },
               type:'post',
               dataType:"json",

               success: function (data) {
                 if(data.statut=="succes"){
                    $("#div-message").text(data.message);
                    $("#div-message").show();
                    $("#form")[0].reset();
                 }
                },
              complete :function(data){
             },

             error: function() {

            }
     });

                   $("#panel-modal").modal('hide');
                   return false;
                });
 //Suppression

        $('.btn-delete').on("click",function(){
             var result = confirm("Voulez vous Supprimer cette Catégorie");
             if(result==true){
                  var id=$(this).data("id");
                 $.post("<?php echo site_url(array("C_Stock","deleteCat")); ?>",{"id":id},function(data){
                 if(data.statut=="succes"){
                    $("#div-message").text(data.message);
                    $("#div-message").show();
                }
            });
             }
           

        })
           
           
            } );

        </script>