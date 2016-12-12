<?php
	// On démarre le stockage de toute sortie dans un buffer (prints, warnings, etc.)
	ob_start();

	// Activation de l'affichage d'erreurs
	error_reporting(E_ALL);
	ini_set("display_errors", true);

	// Nom de l'application
	$nameApp = "labeerbook";

	// Inclusion des classes et librairies
	require_once 'lib/core.php';
	require_once $nameApp.'/controller/mainController.php';


	// Action par défaut
	$action = "none";

	if(key_exists("action", $_REQUEST))
		$action =  $_REQUEST['action'];

	session_start();

	$context = context::getInstance();
	$context->init($nameApp);

	$resAction = $context->executeAction($action, $_REQUEST);

	$reponseHTTP = array();

	// Traitement des erreurs et des réponses du controlleur
	if ($resAction === false) {
		$reponseHTTP["code"] = 500;
		$reponseHTTP["data"] = "Une grave erreur s'est produite, il est probable que l'action "
								. $action . " n'existe pas...";
	}

	// Si l'action a bien été exécutée, on va toujours recevoir du code JSON comme résultat
	else {
		if ($resAction === context::SUCCESS) {
			$reponseHTTP["code"] = 200;
			$reponseHTTP["data"] = eval("include('$nameApp/view/$action" . context::SUCCESS . ".php');");
		}

		elseif ($resAction === context::ERROR) {
			$reponseHTTP["code"] = 400;
			$reponseHTTP["data"] = eval("include('$nameApp/view/$action" . context::ERROR . ".php');");
		}

		else {
			$reponseHTTP["code"] = 200;
			$reponseHTTP["data"] = $resAction;
		}
	}

	// On change le code HTTP de la réponse
	http_response_code($reponseHTTP["code"]);

	// On stocke tout ce qui aurait pu être imprimé dans la réponse (prints, warnings, etc)
	// dans une variable que l'on ajoute comme attribut de l'objet JSON à renvoyer.
	$reponseHTTP["extra"] = ob_get_clean();

	// Fermeture du buffer de sortie
	ob_end_clean();

	// Affichage du code JSON dans la réponse
	echo json_encode($reponseHTTP);
?>
