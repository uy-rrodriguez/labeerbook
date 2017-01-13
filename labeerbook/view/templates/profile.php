<?php
    /*//*//*/
        Auteur : R.RODRIGUEZ
        Description :
	    	Template pour afficher le profil d'un utilisateur.
    /*//*//*/

    $userProfile = $context->getSessionAttribute("userProfile");


    // Le dossier avec les uploads se trouve dans une classe de configuration
    $AVATAR_FOLDER = config::AVATAR_FOLDER;

    // Image à utiliser si la photo n'est pas trouvé. On récupère une photo aléatoire
    $imgOnError = "static/img/def-avatars/user (" . ($userProfile->id % 15) . ").png";
?>


  <div class="col-xs-12 col-sm-4 col-md-3">
    <div id="img-profil-container">
        <img id="img-profil" class="img" alt="Image de profil de l'utilisateur"
            src="<?php echo $AVATAR_FOLDER . "/" . $c->emetteur->avatar; ?>"
            onerror="this.onerror=null; this.src='<?php echo $imgOnError; ?>';">

        <img id="img-profil-biere" class="img" src="static/img/beer-1.png">
    </div>
  </div>

  <div class="col-xs-12 col-sm-5 col-md-6">
    <h2><?php echo $userProfile->identifiant; ?></h2>
    <h3><?php echo $userProfile->prenom . " " . $userProfile->nom; ?></h3>

    <blockquote>
        <p><?php echo ($userProfile->statut != "" ? $userProfile->statut : "sans status"); ?></p>
    </blockquote>

    <!-- Formulaire envoie de message a ce profil -->
    <div class="form-wrapper">
        <div class="form-titre"></div>
        <form method="post" id="formProfile" action="#">
            <div class="form-group container-fluid">
                <div class="row">
                    <div class="col-xs-12 col-sm-8">
                        <textarea class="form-control" name="message" placeholder="Écrire un message dans ce mur"></textarea>
                    </div>
                    <div class="col-xs-12 col-sm-4">
                        <button type="button" class="btn btn-default btn-lg" >Poster</button>
                    </div>
                </div>
            </div>
        </form>
    </div>

  </div>
  <div class="hidden-xs col-sm-3" style=""></div>

