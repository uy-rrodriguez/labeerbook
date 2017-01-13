<?php
	$allMessages = $context->getSessionAttribute("messages");

    // Le dossier avec les uploads se trouve dans une classe de configuration
    $AVATAR_FOLDER = config::AVATAR_FOLDER;


	foreach ($allMessages as $message) {

        // Image à utiliser si la photo n'est pas trouvé. On récupère une photo aléatoire
        $imgOnError = "static/img/def-avatars/user (" . ($message->emetteur->id % 15) . ").png";
?>


<div id = "message" >

	<div id = "messAccueil" class = "row" >
		<div class = "col-xs-3">
			<img class="img" src="<?php echo $AVATAR_FOLDER . "/" . $message->emetteur->avatar; ?>"
                alt="Image de profil de l'émetteur"
                onerror="this.onerror=null; this.src='<?php echo $imgOnError; ?>';">
		</div>

		<div class = "col-xs-9" >
			<b><?php echo $message->emetteur->identifiant; ?> : </b><br>
			<?php echo $message->post->texte; ?>
		</div>
	</div>


	<div id="shareLike" class ="row">
		<div class="col-xs-12">
			Partager
			<img href="" src="static/img/share.png">
			<img href="" src="static/img/like.png">
		</div>
	</div>

</div>



<?php } ?>

