<?php

session_start();

if (!$_SESSION['auth']) {
	header('Location: ../view/index.php');
	exit;
}

require_once('../model/MySql.php');
require_once('../model/Wage.php');
require_once '../model/excel.php';
require_once '../excel/PHPExcel.php';
require_once '../excel/PHPExcel/Writer/Excel2007.php';

$link = Db::connect();

if (isset($_GET['date'])) {
	$date = $_GET['date'];
}
else {
	$date = '0.' . date('Y');
}

$month = explode('.', $date)[0];
$year = explode('.', $date)[1];

if ($month) {
	$fromDate = mktime(0, 0, 1, $month, 1, $year);
	$toDate = mktime(23, 59, 59, $month + 1, 0, $year);
}
else {
	$fromDate = mktime(0, 0, 1, 1, 1, $year);
	$toDate = mktime(23, 59, 59, 1, 0, $year + 1);
}

$wages = Wage::getWagesByDate($fromDate, $toDate, $link);

$link->close();

$currentMonth = 0;
foreach ($wages as $value) {
	if ($currentMonth != date('m', $value->date)) {
		$head['A'] = 'Navn';
		$head['B'] = 'Dato';
		$head['C'] = 'Fra kl.';
		$head['D'] = 'Til kl.';
		$head['E'] = 'Timer';
		$head['F'] = 'Beskrivelse';
		$monthlyWages[date('M', $value->date)][] = null;
		$monthlyWages[date('M', $value->date)][] = $head;
	}
	
	$wage['A'] = $value->person;
	$wage['B'] = date('d.m.Y', $value->start);
	$wage['C'] = date('H:i', $value->start);
	$wage['D'] = date('H:i', $value->end);
	$wage['E'] = round(($value->end - $value->start) / 3600, 2);
	$wage['F'] = $value->description;
	$monthlyWages[date('M', $value->date)][] = $wage;
	
	$currentMonth = date('m', $value->date);
}


header('Content-Description: File Transfer');
header('Content-Type: application/octet-stream');
header('Content-Disposition: attachment; filename=' . date('d.m.Y') . '.xlsx');
header('Content-Transfer-Encoding: binary');
header('Expires: 0');
header('Cache-Control: must-revalidate');
header('Pragma: public');
ob_clean();
flush();

$excel = new Excel2007();
$excel->setProperties('Askeberg', 'Timeliste');
$excel->addData($monthlyWages);
$excel->outputFile();

?>
