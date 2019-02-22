<?php
//get config file with database login details
require_once('config.php');
//get bootstrap class that creates the controller.
require_once('classes/Bootstrap.php');
require_once('classes/Controller.php');
require_once('classes/Model.php');
require_once('classes/Db.php');
require_once('classes/Bind.php');
require_once('controllers/home.php');
require_once('models/home.php');

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->create_controller();

if($controller){
	$controller->execute_action();
}

