<?php
    $userMessages = $context->getSessionAttribute("userMessages");
    $messages = $context->getSessionAttribute("messages");

    echo "Message du user (destinataire) : " . $userMessages->nom;
    echo " " . $userMessages->prenom;
    echo " " . $userMessages->identifiant;
    echo " " . $userMessages->date_de_naissance;
    echo "<br><br>";

    for ($messages as $mes) {
        echo "--> " . $mes->post->texte;
        echo " (écrit par " . $mes->emetteur->identifiant;
        echo " à destination de " . $mes->destinataire->identifiant;
        echo " , le parent étant " . $mes->parent->identifiant . ")";
        echo "<br>";
    }
?>
