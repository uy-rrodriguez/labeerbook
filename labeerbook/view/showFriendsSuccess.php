<?php
	/*//*//*/
		Auteur : Q.CASTILLO (TP 3)
        Modifications finales : R.RODRIGUEZ (TP 4)
	/*//*//*/

    $friends = $context->getSessionAttribute("friends");
?>

<h3>Les amis</h3>
<div id="liste-users" class="container-fluid">

<?php
    foreach ($friends as $f) {
        $context->setSessionAttribute("userTemplate", $f);
        include("$nameApp/view/templates/user.php");
    }
?>

</div>
