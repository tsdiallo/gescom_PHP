
<?php echo $header;?>
    <body>
        <div class="wrapper-page">
            <div class="panel panel-color panel-primary panel-pages">
                <div class="panel-heading bg-img"> 
                    <div class="bg-overlay"></div>
                    <h3 class="text-center m-t-10 text-white"> Bienvenue à <strong>Gescom</strong> </h3>
                </div> 


                <div class="panel-body">
                <form class="form-horizontal m-t-20" method="post" action="<?php echo site_url(array('Welcome','seconnecter')); ?>">
                    
                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg" name="login" type="text" required="" placeholder="Entrer le Login">
                        </div>
                    </div>

                    <div class="form-group">
                        <div class="col-xs-12">
                            <input class="form-control input-lg"  name="pwd" type="password" required="" placeholder="Entrer le Password">
                        </div>
                    </div>

                    <div class="form-group text-center m-t-40">
                        <div class="col-xs-12">
                            <button class="btn btn-primary btn-lg w-lg waves-effect waves-light" type="submit">Log In</button>
                        </div>
                    </div>

                </form>
                   <?php  if(isset($error_state)  && $error_state=="true" )  {  ?>
                  <div class="row">
                  <div class="alert alert-danger">
                      <a href="#" class="alert-link">Login ou Mot de Passe incorrect</a>.
                   </div>
                  </div>
                  <?php
                  } ?>

                </div>                                 
                
            </div>
        </div>

<?php echo $footer;?>
