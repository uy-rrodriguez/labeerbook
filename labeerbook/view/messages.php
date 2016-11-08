<div id="msg-erreur" style="color:red;">
    <?php
        if ($context->getSessionAttribute("msgErreur") != NULL)
            echo $context->getSessionAttribute("msgErreur");
        $context->setSessionAttribute("msgErreur", NULL);
    ?>
</div>

<div id="msg-info" style="color:darkkhaki;">
    <?php
        if ($context->getSessionAttribute("msgInfo") != NULL)
            echo $context->getSessionAttribute("msgInfo");
        $context->setSessionAttribute("msgInfo", NULL);
    ?>
</div>
