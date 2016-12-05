
<?php
	/*//*//*/
		Auteur : Q.CASTILLO
	/*//*//*/
    $users = $context->getSessionAttribute("users");
    
    echo "<u>Liste des users : </u><br/>";
    foreach ($users as $user) {
        
        
        $context->setSessionAttribute("userTemplate", $user);
        include("$nameApp/view/templates/user.php");
        
    }
?>
