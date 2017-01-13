<?php
    $c = $context->getSessionAttribute("chatMessage");

    // Le dossier avec les uploads se trouve dans une classe de configuration
    $AVATAR_FOLDER = config::AVATAR_FOLDER;

    // Image à utiliser si la photo n'est pas trouvé. On récupère une photo aléatoire
    $imgOnError = "static/img/def-avatars/user (" . ($c->emetteur->id % 15) . ").png";
?>

<div class="chat-photo">
    <img class="img" src="<?php echo $AVATAR_FOLDER . "/" . $c->emetteur->avatar; ?>"
        alt="Image de profil de l'ami"
        onerror="this.onerror=null; this.src='<?php echo $imgOnError; ?>';">
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
