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


//action par défaut
$action = "login";

if(key_exists("action", $_REQUEST))
	$action =  $_REQUEST['action'];

session_start();

$context = context::getInstance();
$context->init($nameApp);


$response = $context->executeAction($action, $_REQUEST);

// Inclusion de la vue par rapport a la reponse de l'action du controleur
if ($response === context::SUCCESS || $response === context::ERROR) {
	$view = $nameApp."/view/".$action.$response.".php";
    include($view);
}

else {
    echo $response;
}
?>
