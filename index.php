<?php
	session_start();
	require_once('View.class.php');
	require_once('Model.class.php');
	require_once('Controller.class.php');
	include('config/setup.php');
	include("config/database.php");

	$dsn = $DB_DSN . ';dbname=' . $DB_NAME;
	$user_db = new PDO($dsn, $DB_USER, $DB_PASSWORD);
	$user_db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

	$view = new View();
	$model = new Model($user_db);
	$controller = new Controller($model);

	if (array_key_exists("action", $_POST) && array_key_exists("controller", $_POST))
	{
		$result = $controller->execute();
		$view->redirect($result);
	}
	else if (array_key_exists("action", $_GET))
		$view->output("access", "signout");
	else if (isset($_SESSION['login']))
		$view->redirect(true);
	else
		$view->output("access", "login");
?>