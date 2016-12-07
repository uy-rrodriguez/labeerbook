<?php
	/*//*//*/
		Auteur : R.RODRIGUEZ
        Description :
            Affiche une bulle, si on clique sur la bulle on affiche une fenetre de chat.
	/*//*//*/
    /*
	$chatTemplate = $context->getSessionAttribute("chatTemplate");
	echo "<b>" . $chatTemplate->post->texte . "</b>";
	echo ", créé par <b>" . $chatTemplate->emetteur->identifiant . "</b>";
	echo ", le <b>" . $chatTemplate->post->date->format("d/m/Y H:i") . "</b>";
	echo ".";
    */
?>

<div id="chat" class="draggable NON-minimise maximise container hidden-xs">
    <div id="bulle" class="row">
        <span>
            Chat
        </span>
        <svg xmlns="http://www.w3.org/2000/svg" style="height:10px;width:10px;">
            <circle cx="5" cy="5" r="5" fill="green" />
        </svg>
    </div>

    <div id="chat-contenu" class="row">
        <div class="chat-message container-fluid">
            <div class="chat-message-contenu row">
                <div class="chat-photo col-sm-3">
                    <img class="img img-responsive full-width" src="static/img/profil.png">
                </div>
                <div class="chat-nom col-sm-8">Pepito</div>
                <div class="chat-texte col-sm-8">
                    Ceci est un message de pepito...
                </div>
            </div>
        </div>
    </div>
</div>
