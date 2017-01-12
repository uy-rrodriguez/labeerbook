<?php
	/*//*//*/
		Auteur : R.RODRIGUEZ
	/*//*//*/

    $chats = $context->getSessionAttribute("chats");

    foreach ($chats as $c) {
        $context->setSessionAttribute("chatMessage", $c);
?>

        <div class="chat-message">
            <?php include("templates/chatMessage.php"); ?>
        </div>

<?php
    }
?>
