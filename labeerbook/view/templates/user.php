<?php
	/*//*//*/
		Auteur : Q.CASTILLO
	/*//*//*/
	$userTemplate = $context->getSessionAttribute("userTemplate");
?>

<div id="userList" class = "row">

	  <div class="col-xs-2">
	  	 <img id="img-profil" src="static/img/profil.png">
	  </div>
	  
	  <div class="col-xs-5">
		<h3><?php echo "<b><a href="?action=viewProfil"> " . $userTemplate->identifiant . "</a></b> <br>"; ?></h3>
	  </div>
	  
	  <div class="col-xs-5" style ="text-align:right;">
	    <h3>
	      En ligne
	      <svg xmlns="http://www.w3.org/2000/svg" style="height: 20px; width: 20px;">
	        <circle cx="10" cy="10" r="10" fill="green" />
	      </svg>
	    </h3>
	  </div>
	  <!--<div class="hidden-xs col-sm-3" style=""></div> -->

</div>


