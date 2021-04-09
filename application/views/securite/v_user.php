<div class="row">
    <div class="col-md-8" >
        <div class="alert alert-success" id="div-message">
            <a href="#" class="alert-link">Erreur</a>
        </div>
    </div> 
</div>

<div class="row">
    <div class="col-md-4">
        <div class="panel panel-color panel-primary">

            <div class="panel-heading"> 
                <h3 class="panel-title">Nouveau Admin</h3> 
            </div> 

            <div class="panel-body"> 
                <form  role="form" id="form-user" method="post" action="<?php echo site_url(array("C_Securite", "saveUser")); ?>">
                <input type="hidden" class="form-control" id="id" name="id">     
                    <div class="form-group">
                        <label for="nom">Nom</label>
                        <input type="text" class="form-control" style="border:1px solid #317EEB" required="" id="nom" name="nom" placeholder="Entrer le Nom">
                    </div>

                    <div class="form-group">
                        <label for="prenom">Prenom</label>
                        <input type="text" class="form-control" style="border:1px solid #317EEB" required="" id="prenom" name="prenom" placeholder="Entrer le Prenom">
                    </div>

                    <div class="form-group">
                        <label for="telephone">Login</label>
                        <input type="text" class="form-control" style="border:1px solid #317EEB" required="" id="login" name="login" placeholder="Entrer le Login">
                    </div>

                    <div class="form-group">
                        <label for="email">Mot de Passe</label>
                        <input type="password" class="form-control" style="border:1px solid #317EEB" required="" id="pwd" name="pwd" placeholder="Mot de Passe">
                    </div>
                    
                    <div class="form-group">
                        <label for="email">Confirmer Mot de Passe</label>
                        <input type="password" class="form-control" style="border:1px solid #317EEB" required="" id="pwd2" name="pwd2" placeholder="Confirmer Mot de Passe">
                    </div>

                    <div class="form-group">
                                <label for="">Profil</label>
                                <select class="form-control select2" style="border:1px solid #317EEB" required="" name="id_profil" id="id_profil">
                                    <option value="0"></option>
                                    <?php    
                                    foreach($listeProfil as  $value ){
                                    ?>
                                    <option value="<?=$value->id ?>"><?=$value->nom ?></option>
                                    <?php
                                    }
                                    ?>
                                </select>
                            </div>
                    <button type="submit" id="btn-save-admin" class="btn btn-primary waves-effect waves-light pull-right">Enregistrer</button>
                </form>
            </div> 
        </div>
    </div>

    <div class="col-md-8">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h3 class="panel-title">Les utilisateurs</h3>
            </div>

            <div class="panel-body"> 
                <table id="datatable" class="table table-striped table-bordered">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Prénom</th>
                            <th>Nom</th>
                            <th>Login</th>
                            <th>Profil</th>
                        </tr>
                    </thead>
                    <tbody id='tbody-details'>
                        <?php
                            foreach($listeUser as $user){
                        ?>
                        <tr>
                            <th><?= $user->id ?></th>
                            <th><?= $user->prenom ?></th>
                            <th><?= $user->nom ?></th>
                            <th><?= $user->login ?></th>
                            <?php
                            foreach($listeProfil as $pro){
                                if($user->id_profil==$pro->id){?>
                            <th><?=$pro->nom?></th>
                            <?php 
                            }
                            }
                            ?>
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
        $("#div-message").hide();

        $("#form-user").on("submit",function(){
   
            $.ajax({
                url: $(this).attr("action"),
                data: {
                    "nom":$("#nom").val(),
                    "prenom":$("#prenom").val(),
                    "login":$("#login").val(),
                    "pwd":$("#pwd").val(),
                    "pwd2":$("#pwd2").val(),
                    "profil":$("#id_profil").val()
                },
                type: 'post',
                dataType:"json",

                // La fonction à apeller si la requête aboutie
                success: function (data) {
                    if(data.statut=="succes"){
                        alert("enregistrement effectué");
                    }else {
                        alert("enregistrement non effectué");
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
    });

</script>
