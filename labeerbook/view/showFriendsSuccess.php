<?php
	/*//*//*/
		Auteur : Q.CASTILLO
	/*//*//*/
   $friends = $context->getSessionAttribute("friends");
    
    echo "<u>Liste des amis : </u><br/>";
    foreach ($friends as $user) {
        echo "<li>";
        
        $context->setSessionAttribute("userTemplate", $user);
        include("$nameApp/view/templates/user.php");
        
        echo "</li>";
    }
?>
