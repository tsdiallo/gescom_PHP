<div class="row">
    <div class="col-md-3">
        <div class="panel panel-color panel-primary">

            <div class="panel-heading"> 
                <h3 class="panel-title">Nouveau conseiller</h3> 
            </div> 

            <div class="panel-body"> 
                <form  role="form" id="form-emp" method="post" action="<?php echo site_url(array("C_Inscription", "saveEmp")); ?>">
                <input type="hidden" class="form-control" id="id" name="id">      
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" required="" id="nom" name="nom" placeholder="Entrer nom">
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" class="form-control" id="prenom" required="" name="prenom" placeholder="Entrer prenom">
                    </div>

                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="mail" class="form-control" id="email" name="email" required="" placeholder="Entrer email">
                    </div>

                    <button type="submit" id="btn-save-con" class="btn btn-primary waves-effect waves-light pull-right">Enregistrer</button>
                </form>
            </div> 
        </div>
    </div>

    <div class="col-md-9">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Les Emprunteurs</h3>
            </div>

            <div class="panel-body"> 
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Email</th>
                            <th>Adresse</th>
                            <th>Option</th>
                        </tr>
                    </thead>
                    <tbody id='tbody-details'>
                        <?php
                            foreach($listeEmp as $emp){
                        ?>
                        <tr>
                            <th><?= $emp->prenom ?></th>
                            <th><?= $emp->nom ?></th>
                            <th><?= $emp->email ?></th>
                            <th><?= $emp->adresse ?></th>
                                    <td>
                                        <button data-id="<?=$emp->id?>"  type="button"class="btn btn-warning waves-effect waves-light btn-edit" data-toggle="modal" data-target="#panel-modal"><i class="fa fa-edit"></i></button>
                                        <button data-id="<?=$emp->id?>"type="button"data-toggle="modal" class="btn btn-danger waves-effect waves-light btn-delete "><i class="fa fa-trash-o"></i></button>
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

<script>
$(document).ready(function() {
        $("#form-emp").on("submit",function(){
   
            $.ajax({
                url: $(this).attr("action"),
                data: {
                    "id":$("#id").val(),
                    "nom":$("#nom").val(),
                    "prenom":$("#prenom").val(),
                    "adresse":$("#adresse").val(),
                    "email":$("#email").val(),
                },
                type: 'post',
                dataType:"json",

                // La fonction à apeller si la requête aboutie
                success: function (data) {
                    if(data.statut=="succes"){
                        $("#form-emp :input").each(function(){
                            $(this).val("");
                        });
                        alert("Enregistrement effectué");

                    }else{
                        alert("Enregistrement non effectué");
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


            $(".btn-edit").on("click",function(){
            var id=$(this).data("id");

            //recupere l'element selectionne
            $.post("<?php echo site_url(array("C_Inscription","getRecordEmp"));?>",{"id":id},function(data){
                $("#id").val(data.id)                                  
                $("#nom").val(data.nom)                                  
                $("#prenom").val(data.prenom)                                  
                $("#adresse").val(data.adresse)                                  
                $("#email").val(data.email)                                  
                });


            });
            
            //suppression

            $('.btn-delete').on("click",function(){
                        var result=confirm(" yes to delete");
                        if(result==true){

                        var id=$(this).data("id");

                        $.post("<?php echo site_url(array("C_Inscription","deleteEmp"));?>",{"id":id},function(data){
                            if(data.statut=="succes"){
                                $("#div-message").text(data.message);
                                $("#div-message").show();
                            }

                        });
                        }

            });
    });

</script>
