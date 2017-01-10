<?php
	/*//*//*/
		Auteur : R.RODRIGUEZ
	/*//*//*/

    $chats = $context->getSessionAttribute("lastChats");
?>
<?php foreach ($chats as $c) : ?>
    <div class="chat-message chat-nouveau">
        <div class="chat-photo">
            <img class="img" src="static/img/user-1.png">
        </div>
        <div class="chat-message-contenu">
            <div class="chat-entete">
                <span class="chat-nom">
                    <?php echo strip_tags($c->emetteur->identifiant, FILTER_SANITIZE_STRING); ?>
                </span>
                <span class="chat-date">
                    <?php echo $c->post->date->format('d/m/Y H:i'); ?>
                </span>
            </div>
            <div class="chat-texte">
                <pre><?php echo strip_tags($c->post->texte, FILTER_SANITIZE_STRING); ?></pre>
            </div>
        </div>
    </div>
<?php endforeach; ?>
