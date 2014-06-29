<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<?php

session_start();

if (!$_SESSION['auth']) {
	header('Location: ../view/index.php');
	exit;
}

if (isset($_GET['date'])) {
	$date = $_GET['date'];
}
else {
	$date = '0.' . date('Y');
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
<link type="text/css" media="print" rel="stylesheet" href="../view/css/print.css" />
<script type="text/javascript" src="../script/utils.js"></script>
<!-- <script type="text/javascript" src="../script/jquery.js"></script> -->
</head>
<body>
<div id="container">

<div id="content">

<a class="edit no-print" href="#" onclick="print();">Skriv ut</a>
<br />
<br />

<h3><?php echo $date; ?></h3>

<table id="wages">
<tr>
	<th class="w100">Person</th>
	<th class="w100">Dato</th>
	<th class="w80">Fra kl.</th>
	<th class="w80">Til kl.</th>
	<th class="w80">Timer.</th>
	<th class="w280">Beskrivelse</th>
</tr>
</table>

</div>

<script type="text/javascript">
	request('getWage.php', ['date'], ['<?php echo $date; ?>'], printWages);
</script>

</div>

</body>
</html>