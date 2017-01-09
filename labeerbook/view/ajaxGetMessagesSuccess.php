<?php 
	$allMessages = $context->getSessionAttribute("messages");

	foreach ($allMessages as $message) {

?>


<div id = "message" >

	<div id = "messAccueil" class = "row" >
		<div class = "col-xs-3">
			<div id="img-profil-container">
	        <img id="img-profil" class="img img-responsive" src="static/img/user-1.png">
	        <img id="img-profil-biere" class="img img-responsive" src="static/img/beer-1.png">
	    </div>
		</div>

		<div class = "col-xs-9" >
			<b><?php echo $message->emetteur->identifiant; ?> : </b><br>
			<?php echo $message->post->texte; ?>
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



<?php } ?>

