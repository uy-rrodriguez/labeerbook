
<?php
	/*//*//*/
		Auteur : Q.CASTILLO
	/*//*//*/
    $users = $context->getSessionAttribute("users");
    
    echo "<u>Liste des users : </u><br/>";
    foreach ($users as $user) {
        echo "<li>";
        
        $context->setSessionAttribute("userTemplate", $user);
        include("$nameApp/view/templates/user.php");
        
        echo "</li>";
    }
?>
