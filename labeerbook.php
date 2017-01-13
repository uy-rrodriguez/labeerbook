<?php

error_reporting(E_ALL);
ini_set("display_errors", true);


// Avant tout, on inclut la configuration de certaines constantes
include_once("config.php");


//nom de l'application
$nameApp = "labeerbook";

// Inclusion des classes et librairies
require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';

session_start();

$context = context::getInstance();
$context->init($nameApp);


// Action par défaut
$action = "login";

// Contrôl d'accès
if(key_exists("action", $_REQUEST) && $context->getSessionAttribute("user") !== null)
	$action =  $_REQUEST['action'];


$view=$context->executeAction($action, $_REQUEST);

//traitement des erreurs de bases, reste a traiter les erreurs d'inclusion
if($view===false){
	echo "Une grave erreur s'est produite, il est probable que l'action ".$action." n'existe pas...";
	die;
}

//inclusion du layout qui va lui meme inclure le template view
elseif ($view!=context::NONE) {
	$template_view=$nameApp."/view/".$action.$view.".php";

    if ($action == "login" && $view == context::ERROR)
	    include($nameApp."/view/layout_login.php");
    else
        include($nameApp."/view/".$context->getLayout().".php");
}

?>
