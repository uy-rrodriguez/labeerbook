<?php
	/*//*//*/
		Auteur : Q.CASTILLO (TP 3)
        Modifications finales : R.RODRIGUEZ (TP 4)
	/*//*//*/

	$userTemplate = $context->getSessionAttribute("userTemplate");

    // Le dossier avec les uploads se trouve dans une classe de configuration
    $AVATAR_FOLDER = config::AVATAR_FOLDER;

    // Image à utiliser si la photo n'est pas trouvé. On récupère une photo aléatoire
    $imgOnError = "static/img/def-avatars/user (" . ($userTemplate->id % 15) . ").png";
?>

<div class="item-liste-amis col-xs-6 col-sm-4 col-md-6">
    <a href="?action=showProfile&idProfile=<?php echo $userTemplate->id; ?>">
        <div class="row">

            <div class="col-xs-12">
                <img class="img img-responsive"
                    src="<?php echo $AVATAR_FOLDER . "/" . $userTemplate->avatar; ?>"
                    alt="Image de profil de l'utilisateur"
                    onerror="this.onerror=null; this.src='<?php echo $imgOnError; ?>';">
            </div>

            <div class="col-xs-12 text-center div-id-ami">
                <?php echo $userTemplate->identifiant; ?>
            </div>
        </div>
    </a>
</div>


