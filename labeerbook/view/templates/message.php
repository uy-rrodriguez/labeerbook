<?php
    $m = $context->getSessionAttribute("profilMessage");

    // Le dossier avec les uploads se trouve dans une classe de configuration
    $AVATAR_FOLDER = config::AVATAR_FOLDER;

    // Hack pour les messages qui n'ont pas assigné un émetteur
    $emetteur = $m->emetteur;
    if (! $emetteur) {
        $emetteur = new utilisateur();
        $emetteur->id = 0;
        $emetteur->identifiant = "sans identifiant";
        $emetteur->avatar = "";
    }


    $avatar = $AVATAR_FOLDER . "/" . $emetteur->avatar;

    // Image à utiliser si la photo n'est pas trouvé. On récupère une photo aléatoire
    $imgOnError = "static/img/def-avatars/user (" . ($emetteur->id % 15) . ").png";
?>

        <div class="row message">
            <div class="col-xs-3 msg-photo">
                <img class="img" src="<?php echo $avatar; ?>"
                    alt="Image de profil de l'émetteur"
                    onerror="this.onerror=null; this.src='<?php echo $imgOnError; ?>';">
            </div>

            <div class="col-xs-9 msg-contenu">
                <div class="msg-emetteur">
                    <?php echo $emetteur->identifiant; ?>
                    <span class="message-date">
                        <?php echo $m->post->date->format('d/m/Y H:i'); ?>
                    </span>
                </div>
                <div class="msg-texte">
                    <pre><?php echo strip_tags($m->post->texte, FILTER_SANITIZE_STRING); ?></pre>
                </div>
            </div>

            <div class="msg-share-like">
                <div  class="btn btn-default msg-btn msg-share" onclick="share(<?php echo $m->id; ?>)">
                    Partager <img href="" src="static/img/share.png">
                </div>
                <div class="btn btn-default msg-btn msg-like" onclick="addLike(<?php echo $m->id; ?>, this)">
                    <span><?php echo ($m->aime != "" ? $m->aime : 0); ?></span>
                    <img href="" src="static/img/like.png">
                </div>
            </div>
        </div>
