<?php
    $chats = $context->getSessionAttribute("chats");
    $lastChat = $context->getSessionAttribute("lastChat");

    echo "Le dernier chat à arriver est : " . $lastChat->post->texte;
    echo " nourrit par " . $lastChat->emetteur->identifiant;
    echo ", né le " . $lastChat->post->date;
    echo ". Miaouuu !! <3 <3";
    echo "<br><br>";

    for ($chats as $chat) {
        echo "--> " . $chat->post->texte;
        echo " (nourrit par " . $chat->emetteur->identifiant;
        echo ", né le " . $chat->post->date . ")";
        echo "<br>";
    }
?>
