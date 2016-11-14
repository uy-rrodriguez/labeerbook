<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

	<title>La Beer Book</title>
	
	<link rel="stylesheet" type="text/css" href="style.css">
	<link href="static/bootstrap-3.3.7-dist/css/bootstrap.min.css" rel="stylesheet">


</head>

<body>
    <?php include($nameApp."/view/bandeau.php"); ?>

	<div id="contenu" style="position: relative;">
		<?php include($template_view); ?>
	</div>

	 <div class="jumbotron text-center">
	  <h1>My First Bootstrap Page</h1>
	  <p>Resize this responsive page to see the effect!</p>
	</div>
	<div class="container">
	  <div class="row">
	    <div class="col-sm-4">
	      <h3>Column 1</h3>
	      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
	      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
	    </div>
	    <div class="col-sm-4">
	      <h3>Column 2</h3>
	      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
	      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
	    </div>
	    <div class="col-sm-4">
	      <h3>Column 3</h3>
	      <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit...</p>
	      <p>Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris...</p>
	    </div>
	  </div>
	</div>



	<!-- Scripts -->
	<script type="text/javascript" src="static/js/jquery-3.1.1.min.js"></script>
	<!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="static/bootstrap-3.3.7-dist/js/bootstrap.min.js"></script>

	<script type="text/javascript" src="static/js/ajax.js"></script>
</body>
</html>
