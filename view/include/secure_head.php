<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

session_start();

if (!$_SESSION['auth']) {
	header('Location: ../view/index.php');
	exit;
}

?>
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="en" lang="en">
<head>
<meta http-equiv="cache-control" content="no-cache" />
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
<meta http-equiv="content-language" content="no" />
<meta name="author" content="Askeberg AS" />
<meta name="viewport" content="width=910, initial-scale=0.60, minimum-scale=0.5, maximum-scale=10" />
<title>Askeberg AS</title>
<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Oxygen" />
<link type="text/css" media="screen" rel="stylesheet" href="../view/css/style.css" />
<link type="text/css" media="screen" rel="stylesheet" href="../view/css/secure_style.css" />
<script type="text/javascript" src="../script/utils.js"></script>
<!-- <script type="text/javascript" src="../script/jquery.js"></script> -->
</head>
<body>
<div id="container">

<div id="header">

<div id="logo">

<a href="../view/index.php"><img src="../view/img/logo.png" height="50" /></a>

</div>

<ul>
	<li><a href="../view/timelister.php">Timelister</a></li>
	<li><a href="../view/prosjekter.php">Prosjekter</a></li>
	<li><a href="../view/prosjekt.php">Nytt prosjekt</a></li>
</ul>

<div id="login">
<form name="form" action="../controller/login.php" method="post">
<input name="submit" type="submit" value="Logout" />
</form>
</div>

</div>
