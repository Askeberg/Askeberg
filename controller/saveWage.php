<?php

session_start();

if (!$_SESSION['auth']) {
	header('Location: ../view/index.php');
	exit;
}

require_once('../model/MySql.php');

require_once('../model/Wage.php');

$link = Db::connect();

if ($_GET['submit'] == "delete") {
	Wage::deletFromDb($_GET['wageId'], $link);
}
else {
	$wage = new Wage($_GET['wageId'], $_GET['projectId'], $_GET['person'],
			strtotime($_GET['date'] . ' 12:00'), $_GET['hours'], $_GET['description']);
	
	$wage->addToDb($link);
	echo json_encode($wage);
}

$link->close();

?>
