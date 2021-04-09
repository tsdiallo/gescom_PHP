<div class="col-md-12">
<div class="row">
    <div class="col-md-4">
        <button type="button" id="btn-add1" class="btn btn-primary waves-effect waves-light" data-toggle="modal" data-target="#panel-modal1">Ajouter editeur</button>
    </div>
</div>
<!-- </div> -->


 <div class="row">
    <div class="col-md-12">
        <div class="panel panel-primary">

            <div class="panel-heading">
                <h3 class="panel-title">Liste des Editeurs</h3>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Nom</th>
                                    <th>Email</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listeEdit as $value) {                                           
                                ?>
                                <tr>
                                    <td><?=$value->id?></td>
                                    <td><?=$value->nom?></td>
                                    <td><?=$value->email?></td>              
                                    <td>
                                    <button data-id="<?=$value->id?>" data-nom="<?=$value->nom?>" data-email="<?=$value->email?>" type="button"class="btn btn-warning waves-effect waves-light  btn-edit1" data-toggle="modal" data-target="#panel-modal1"><i class="fa fa-edit"> </i></button>
                                    <button  data-id="<?=$value->id?>"type="button"data-toggle="modal" class="btn btn-danger waves-effect waves-light btn-delete1 "><i class="fa fa-trash-o"></i></button>
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
</div>

 <div id="panel-modal1" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-primary">
                <div class="panel-heading"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h3 class="panel-title" id="h3_panel-title1">Nouvel Editeur</h3> 
                </div> 

                <div class="panel-body"> 
                    <form role="form" id="form-editeur" method="post" action="<?php echo site_url(array("C_Achat","saveEdit"));?>" >
                        <input type="hidden" name="id1" id="id1">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Nom</label>
                            <input type="text" name="nom" style="border:1px solid #317EEB" class="form-control" id="nom" required="" placeholder="Enter Un Nom">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Email</label>
                            <input type="email" name="email" style="border:1px solid #317EEB" class="form-control" required="" id="email" placeholder="Entrez Un Email">
                        </div>

                        <button type="submit" class="btn btn-primary waves-effect waves-light pull-right">Enregistrer</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>
</div>

<div class="col-md-12">
<div class="row">
    <div class="col-md-4">
        <button type="button" id="btn-add2" class="btn btn-success waves-effect waves-light" data-toggle="modal" data-target="#panel-modal2">Ajouter ouvrage</button>
    </div>
</div>
<!-- </div> -->


 <div class="row">
    <div class="col-md-12">
        <div class="panel panel-success">

            <div class="panel-heading">
                <h3 class="panel-title   text-white">Liste des Ouvrages</h3>
            </div>

            <div class="panel-body">
                <div class="row">
                    <div class="col-md-12 col-sm-12 col-xs-12">
                        <table id="datatable" class="table table-striped table-bordered">
                            <thead>
                                <tr>
                                    <th>Id</th>
                                    <th>Titre</th>
                                    <th>Auteur</th>
                                    <th>Resume</th>
                                    <th>Mots</th>
                                    <th>Options</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($listeOuv as $value) {                                           
                                ?>
                                <tr>
                                    <td><?=$value->id?></td>
                                    <td><?=$value->titre?></td>
                                    <td><?=$value->auteur?></td> 
                                    <td><?=$value->resume?></td>
                                    <td><?=$value->mots?></td>              
                                    <td>
                                    <button data-id="<?=$value->id?>" data-auteur="<?=$value->auteur?>" data-resume="<?=$value->resume?>" data-titre="<?=$value->titre?>" data-mots="<?=$value->mots?>"  type="button"class="btn btn-warning waves-effect waves-light  btn-edit2" data-toggle="modal" data-target="#panel-modal2"><i class="fa fa-edit"> </i></button>
                                    <button  data-id="<?=$value->id?>"type="button"data-toggle="modal" class="btn btn-danger waves-effect waves-light btn-delete2 "><i class="fa fa-trash-o"></i></button>
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
</div>


<div id="panel-modal2" class="modal fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true" style="display: none">
    <div class="modal-dialog">
        <div class="modal-content p-0 b-0">
            <div class="panel panel-color panel-success">
                <div class="panel-heading"> 
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button> 
                    <h3 class="panel-title" id="h3_panel-title2">Nouvel Ouvrage</h3> 
                </div> 

                <div class="panel-body"> 
                    <form role="form" id="form-ouvrage" method="post" action="<?php echo site_url(array("C_Achat","saveOuv"));?>" >
                        <input type="hidden" name="id2" id="id2">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Titre</label>
                            <input type="text" name="titre" style="border:1px solid #33B86C" class="form-control" id="titre" required="" placeholder="Enter Un Titre">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Auteur</label>
                            <input type="text" name="auteur" style="border:1px solid #33B86C" class="form-control" id="auteur" required="" placeholder="Entrez Un Auteur">
                        </div>

                        <div class="form-group">
                            <label for="exampleInputEmail1">Resume</label>
                            <input type="text" name="resume" style="border:1px solid #33B86C" class="form-control" required="" id="resume" placeholder="Entrez Un Resume">
                        </div>
                        
                        <div class="form-group">
                            <label for="exampleInputEmail1">Mots cles</label>
                            <textarea  class="form-control" style="border:1px solid #33B86C" id="mots" name="mots" required="" rows=4 cols=40 placeholder="Entrez Mots Cles"></textarea>
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
        $("#btn-add1").on("click",function(){
            $("#h3_panel-title1").empty().text("Ajout d'un editeur");
        });  
        // ouvrir le formulaire d'ajout
        $("#btn-add2").on("click",function(){
            $("#h3_panel-title2").empty().text("Ajout d'un ouvrage");
        }); 

        // evenement de click du bouton modification    
        $(".btn-edit1").on("click",function(){
                $("#id1").val($(this).data("id"))                                  
                $("#nom").val($(this).data("nom"))                                  
                $("#email").val($(this).data("email"))     

            $("#h3_panel-title1").empty().text("Modification d'un editeur");

        });

        // evenement de click du bouton modification    
        $(".btn-edit2").on("click",function(){
            //recupere l'element selectionne
                $("#id2").val($(this).data("id"))                                  
                $("#auteur").val($(this).data("auteur"))                                  
                $("#resume").val($(this).data("resume"))                            
                $("#titre").val($(this).data("titre"))                                  
                $("#mots").val($(this).data("mots"))  

            $("#h3_panel-title2").empty().text("Modification d'un ouvrage");

        });

        //ajout insertion modification
        $("#form-editeur").on("submit",function(){
            $.ajax({
                url: $(this).attr("action"),
                data:$(this).serialize(),
                type: 'post',
                dataType:"json",

                        // La fonction à apeller si la requête aboutie
                        success: function (data) {
                            if(data.statut=="succes"){
                                $("#div-message").text(data.message);
                                $("#div-message").show();
                                $("#form-editeur")[0].reset();

                            }
                        },
                        complete :function(data){
                        },
                        // La fonction à appeler si la requête n'a pas abouti
                        error: function() {
                            
                        }

            });
            
            $("#panel-modal1").modal('hide');
            return false;
                });
                //suppression

            $('.btn-delete1').on("click",function(){
                var result=confirm("OK pour supprimer");
                if(result==true){

                var id=$(this).data("id");

                $.post("<?php echo site_url(array("C_Achat","deleteEdit"));?>",{"id":id},function(data){
                    if(data.statut=="succes"){
                        $("#div-message").text(data.message);
                        $("#div-message").show();
                        }

                });
                }

            })

            
        //ajout insertion modification
        $("#form-ouvrage").on("submit",function(){
            $.ajax({
                url: $(this).attr("action"),
                data:$(this).serialize(),
                type: 'post',
                dataType:"json",

                        // La fonction à apeller si la requête aboutie
                        success: function (data) {
                            if(data.statut=="succes"){
                                $("#div-message").text(data.message);
                                $("#div-message").show();
                                $("#form-ouvrage")[0].reset();

                            }
                        },
                        complete :function(data){
                        },
                        // La fonction à appeler si la requête n'a pas abouti
                        error: function() {
                            
                        }

            });
            
            $("#panel-modal2").modal('hide');
            return false;
                });
                //suppression

            $('.btn-delete2').on("click",function(){
                var result=confirm("OK pour supprimer");
                if(result==true){

                var id=$(this).data("id");

                $.post("<?php echo site_url(array("C_Achat","deleteOuv"));?>",{"id":id},function(data){
                    if(data.statut=="succes"){
                        $("#div-message").text(data.message);
                        $("#div-message").show();
                            }

                });
                }

            })
            // Select2
            jQuery(".select2").select2({
                    width: '100%'
                });
                });
                
</script>