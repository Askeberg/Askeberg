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
else if (isset($_GET['date'])) {
	$month = explode('.', $_GET['date'])[0];
	$year = explode('.', $_GET['date'])[1];
	
	if ($month) {
		$fromDate = mktime(0, 0, 1, $month, 1, $year);
		$toDate = mktime(23, 59, 59, $month + 1, 0, $year);
	}
	else {
		$fromDate = mktime(0, 0, 1, 1, 1, $year);
		$toDate = mktime(23, 59, 59, 1, 0, $year + 1);
	}
	
	$wages = Wage::getWagesByDate($fromDate, $toDate, $link);
	echo json_encode($wages);
}

$link->close();

?>
