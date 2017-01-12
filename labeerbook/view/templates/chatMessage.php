<?php
    $c = $context->getSessionAttribute("chatMessage");
    $AVATAR_FOLDER = "upload/avatar";
?>

<div class="chat-photo">
    <object class="img" type="image/png"
            data="static/img/def-avatars/user (<?php echo ($c->emetteur->id % 15) + 1; ?>).png">
        <img src="<?php echo $AVATAR_FOLDER . "/" . $c->emetteur->avatar; ?>"
            alt="Image de profil de l'ami">
    </object>
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
