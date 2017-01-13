    <div class="row titre-contenu">Messages reçus</div>
    <!--<div class="row"><h2>Messages reçus</h2></div>-->


<?php
    $userProfile = $context->getSessionAttribute("userProfile");
    $messagesProfile = $context->getSessionAttribute("messagesProfile");

	foreach ($messagesProfile as $m) {
        $context->setSessionAttribute("profilMessage", $m);
        include("templates/message.php");
    }
?>

