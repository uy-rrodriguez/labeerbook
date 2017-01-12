<?php
	/*//*//*/
		Auteur : R.RODRIGUEZ
	/*//*//*/

    $chats = $context->getSessionAttribute("lastChats");

    foreach ($chats as $c) {
        $context->setSessionAttribute("chatMessage", $c);
?>

        <div class="chat-message chat-nouveau">
            <?php include("templates/chatMessage.php"); ?>
        </div>

<?php
    }
?>
