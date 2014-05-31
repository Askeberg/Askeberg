<?php

session_start();

if (!$_SESSION['auth']) {
	header('Location: ../view/index.php');
	exit;
}

require_once('../model/MySql.php');

require_once('../model/Wage.php');

$link = Db::connect();

if (isset($_GET['projectId'])) {
	$wages = Wage::getWagesByProjectId($_GET['projectId'], $link);
	echo json_encode($wages);
}

$link->close();

?>
