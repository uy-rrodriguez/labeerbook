<?php
  
error_reporting(E_ALL & E_WARNING);
ini_set("display_errors", true);


//nom de l'application
$nameApp = "labeerbook";

// Inclusion des classes et librairies
require_once 'lib/core.php';
require_once $nameApp.'/controller/mainController.php';


//action par défaut
$action = "login";

if(key_exists("action", $_REQUEST))
	$action =  $_REQUEST['action'];

session_start();

$context = context::getInstance();
$context->init($nameApp);

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
