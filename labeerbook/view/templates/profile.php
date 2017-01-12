<?php
    /*//*//*/
        Auteur : R.RODRIGUEZ
        Description :
	    	Template pour afficher le profil d'un utilisateur.
    /*//*//*/

    $userProfile = $context->getSessionAttribute("userProfile");

    //$loggedUser = $context->getSessionAttribute("user");
?>


  <div class="col-xs-12 col-sm-4 col-md-3">
    <div id="img-profil-container">
        <img id="img-profil" class="img img-responsive" src="static/img/user-1.png">
        <img id="img-profil-biere" class="img img-responsive" src="static/img/beer-1.png">
    </div>
  </div>

  <div class="col-xs-12 col-sm-5 col-md-6">
    <h2><?php echo $userProfile->identifiant; ?></h2>
    <h3><?php echo $userProfile->prenom . " " . $userProfile->nom; ?></h3>
    <h3>
      Statut : <?php echo $userProfile->statut; ?>
    </h3>

    <!-- Formulaire envoie de message a ce profil -->
    <div>
        <h3>Post</h3>
        <form method="post" id="formProfile" action="#">
            <div class="form-group container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <!--<label for="message">Message à ce profil :</label>-->
                        <textarea class="form-control"  name="message" placeholder="Message à ce profil"></textarea><br>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <button type="button" class="btn btn-default" >Poster</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

  </div>
  <div class="hidden-xs col-sm-3" style=""></div>

