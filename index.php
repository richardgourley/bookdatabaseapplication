<?php
//get config file with database login details
require_once('config.php');
//get bootstrap class that creates the controller.
require_once('classes/bootstrap.php');

$bootstrap = new Bootstrap($_GET);
$controller = $bootstrap->create_controller();

if($controller){
	$controller->execute_action();
}

