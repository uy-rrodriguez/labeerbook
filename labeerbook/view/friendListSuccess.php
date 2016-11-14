<?php
	$friends = $context->getSessionAttribute("friends");
?>

	<div class="row">

<?php
	foreach( $friends as $f) {
?> 
	<div class="col-xs-12 " >
		<div class="col-xs-4 noBorder">
			<img class="img-profil-miniature" src="static/img/profil.png">
		</div>

		<div class="col-xs-4 noBorder">
			<?php echo $f->identifiant ?>
		</div>

		<div class="col-xs-4 noBorder">
			<svg xmlns="http://www.w3.org/2000/svg" style="height:25px;width:25px;">
			<circle cx="12.5" cy="12.5" r="10" fill="green" />
			</svg>
		</div>
	</div>
<?php
	}
?> 
 
	</div>
