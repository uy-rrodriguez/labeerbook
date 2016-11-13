<?php
	/*//*//*/
		Auteur : R.RODRIGUEZ
	/*//*//*/

    $chats = $context->getSessionAttribute("chats");
    $lastChat = $context->getSessionAttribute("lastChat");
    
    if ($lastChat != NULL) {
        echo "<u>Le dernier chat à arriver est : </u><br/>";
        echo "<img src='static/img/cat_ninja_w.png'>";
        
        $context->setSessionAttribute("chatTemplate", $lastChat);
        include("$nameApp/view/templates/chat.php");
        
        echo "<br><br>";
    }

    echo "<u>Liste de chats : </u><br/>";
    foreach ($chats as $chat) {
        echo "<li>";
        echo "<img src='static/img/cat_ninja.png'>";
        
        $context->setSessionAttribute("chatTemplate", $chat);
        include("$nameApp/view/templates/chat.php");
        
        echo "</li>";
    }
?>

<!-- Icons from https://www.iconfinder.com/iconsets/brands-outlined-1 -->