
<?php
	/*//*//*/
		Auteur : Q.CASTILLO
	/*//*//*/
    $users = $context->getSessionAttribute("users");
    
    echo "<u>Liste des users : </u><br/>";
    foreach ($users as $user) {
        echo "<li>";
        
        $context->setSessionAttribute("chatTemplate", $user);
        include("$nameApp/view/templates/chat.php");
        
        echo "</li>";
    }
?>
