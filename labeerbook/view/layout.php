<?php
    error_reporting(E_ALL);
    ini_set("display_errors", true);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
	<meta charset="utf-8">
	<title>Ton appli !</title>

</head>
<body>
    <?php include($nameApp."/view/bandeau.php"); ?>

	<?php include($template_view); ?>
</body>
</html>
