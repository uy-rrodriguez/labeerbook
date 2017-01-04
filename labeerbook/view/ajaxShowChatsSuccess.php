<?php
	/*//*//*/
		Auteur : R.RODRIGUEZ
	/*//*//*/

    $chats = $context->getSessionAttribute("chats");
?>
<?php foreach ($chats as $c) : ?>
    <div class="chat-message">
        <div class="chat-photo">
            <img class="img" src="static/img/user-1.png">
        </div>
        <div class="chat-message-contenu">
            <div class="chat-nom"><?php echo strip_tags($c->emetteur->identifiant, FILTER_SANITIZE_STRING); ?></div>
            <div class="chat-texte">
                <pre><?php echo strip_tags($c->post->texte, FILTER_SANITIZE_STRING); ?></pre>
            </div>
        </div>
    </div>
<?php endforeach; ?>
