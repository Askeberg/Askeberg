<?php

session_start();

require_once("../model/MySql.php");
require_once("../model/Auth.php");

if (!isset($_POST['submit'])) {
	header('Location: ../view/index.php');
}
else if ($_POST['submit'] == 'Login' && $link = Db::connect()) {
	$auth = new Auth("../view/index.php", "../view/prosjekter.php", $_POST['key'], $link);
	$auth->setValidated($link);
	$auth->authenticate();
	Table::createTables($link);
	$link->close();
}
else {
	$_SESSION['auth'] = false;
	header('Location: ../view/index.php');
}

?>
