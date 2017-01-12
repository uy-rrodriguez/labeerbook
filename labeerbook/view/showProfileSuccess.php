<?php
	$userProfile = $context->getSessionAttribute("userProfile");
    $messagesProfile = $context->getSessionAttribute("messagesProfile");

	foreach ($messagesProfile as $m) {
?>
        <div id="message">

            <div id="messAccueil" class="row">
                <div class = "col-xs-3">
                    <div id="img-profil-container">
                    <img id="img-profil" class="img img-responsive" src="static/img/user-1.png">
                    <img id="img-profil-biere" class="img img-responsive" src="static/img/beer-1.png">
                </div>
                </div>

                <div class = "col-xs-9" >
                    <b><?php echo $m->emetteur->identifiant; ?> : </b><br>
                    <?php echo $m->post->texte; ?>
                </div>
            </div>


            <div id="shareLike" class ="row">
                <div class="col-xs-12">
                    Partager
                    <img href="" src="static/img/share.png">
                    <img href="" src="static/img/like.png">
                </div>
            </div>

        </div>

<?php
    }
?>

