<?php
	$friends = $context->getSessionAttribute("friends");
?>

	<div class="row">

<?php
	foreach( $friends as $f) {
?> 
	<div class="col-xs-6">
		<?php echo $f->identifiant ?>
	</div>
<?php
	}
?> 
 
	</div>
