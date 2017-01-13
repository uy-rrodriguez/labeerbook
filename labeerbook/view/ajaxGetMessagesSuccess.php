<div class="row titre-contenu">Messages reçus</div>


<?php
	$allMessages = $context->getSessionAttribute("messages");

    // Le dossier avec les uploads se trouve dans une classe de configuration
    $AVATAR_FOLDER = config::AVATAR_FOLDER;


	foreach ($allMessages as $message) {
        $context->setSessionAttribute("profilMessage", $message);
        include("templates/message.php");
    }
?>

