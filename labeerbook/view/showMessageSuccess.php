<?php
    $userMessages = $context->getSessionAttribute("userMessages");
    $messages = $userMessages->messages;

    echo "Messages du user : " . $userMessages->nom;
    echo " " . $userMessages->prenom;
    echo " (identifiant : " . $userMessages->identifiant;
    echo ", naissance : " . $userMessages->date_de_naissance->format('d-m-Y');
    echo ")<br><br>";

    foreach ($messages as $mes) {
        echo "--> " . $mes->post->texte;
        echo " (écrit par " . $userMessages->identifiant;
        echo " à destination de " . $mes->destinataire->identifiant;
        echo " , le parent étant " . $mes->parent->identifiant . ")";
        echo "<br>";
    }
?>
