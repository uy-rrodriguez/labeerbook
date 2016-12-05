<?php
	/*//*//*/
		Auteur : Q.CASTILLO
	/*//*//*/
   $friends = $context->getSessionAttribute("friends");
    
    echo "<h3><u>Liste des amis : </u></h3><br/>";
    foreach ($friends as $user) {
        
        $context->setSessionAttribute("userTemplate", $user);
        include("$nameApp/view/templates/user.php");
        
    }
?>
