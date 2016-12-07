<div id="bandeau-msg" class="NON-msg-flotante">
    <div style="padding: 5px;">
<?php
        if ($context->getSessionAttribute("msgErreur") != NULL) {
?>
	        <div id="msg-erreur" class="alert alert-danger alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $context->getSessionAttribute("msgErreur"); ?>
            </div>
<?php
        }

        if ($context->getSessionAttribute("msgInfo") != NULL) {
?>
	        <div id="msg-erreur" class="alert alert-success alert-dismissible">
                <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
                <?php echo $context->getSessionAttribute("msgInfo"); ?>
            </div>
<?php
        }

        $context->setSessionAttribute("msgErreur", NULL);
        $context->setSessionAttribute("msgInfo", NULL);
?>

    </div>
</div>

<script>
    /*
    setTimeout(function() {
        $('#msg-erreur').hide(300);
        $('#msg-info').hide(300);
    }, 5000);
    */
</script>
