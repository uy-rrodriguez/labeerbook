<?php
	/*//*//*/
		Auteur : R.RODRIGUEZ
	/*//*//*/

	$chatTemplate = $context->getSessionAttribute("chatTemplate");
	echo "<b>" . $chatTemplate->post->texte . "</b>";
	echo ", créé par <b>" . $chatTemplate->emetteur->identifiant . "</b>";
	echo ", le <b>" . $chatTemplate->post->date->format("d/m/Y H:i") . "</b>";
	echo ".";
?>