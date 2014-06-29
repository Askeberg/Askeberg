<?php

session_start();

if (!$_SESSION['auth']) {
	header('Location: ../view/index.php');
	exit;
}

require_once('../model/MySql.php');

require_once('../model/Wage.php');

$link = Db::connect();

if ($_GET['event'] == "deleteAll") {
	Wage::deleteAllFromDb($_GET['projectId'], $link);
}

else if ($_GET['event'] == "delete") {
	Wage::deleteFromDb($_GET['wageId'], $link);
}
else {
	$wage = new Wage($_GET['wageId'], $_GET['projectId'], $_GET['person'],
			strtotime($_GET['date'] . ' ' . $_GET['start']),
			strtotime($_GET['date'] . ' ' . $_GET['end']),
			$_GET['description']);
	
	$wage->addToDb($link);
	echo json_encode($wage);
}

$link->close();

?>
