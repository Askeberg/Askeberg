<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php session_start(); ?>
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
<!-- <script type="text/javascript" src="../controller/utils.js"></script> -->
<!-- <script type="text/javascript" src="../controller/jquery.js"></script> -->
</head>
<body>
<div id="container">

<div id="header">

<div id="logo">

<a href="../view/index.php"><img src="../view/img/logo.png" height="50" /></a>

</div>

<ul>
	<li><a href="../view/index.php">Forside</a></li>
	<li><a href="../view/om_oss.php">Om oss</a></li>
	<li><a href="../view/kontakt_oss.php">Kontakt oss</a></li>
</ul>

<div id="login">
<form name="login" action="../controller/login.php" method="post">
<h5 class="invalid"><?php if (isset($_SESSION['info'])) echo $_SESSION['info'][0]; ?></h5>
<input name="key" type="password" />
<input name="submit" type="submit" value="Login" />
</form>
</div>

</div>
