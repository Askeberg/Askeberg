<?php
include 'include/secure_head.php';

require_once('../model/MySql.php');

require_once('../model/Project.php');

require_once('../model/Wage.php');

$link = Db::connect();

$projects = Project::getProjects($link);

if (isset($_GET['projectId'])) {
	$project = Project::getProjectById($_GET['projectId'], $link);
}
else {
	$project = false;
}

if (isset($_GET['month']) && isset($_GET['year'])) {
	$month = $_GET['month'];
	$year = $_GET['year'];
	$date = $month . '.' . $year;
}
else {
	$month = date('m');
	$year = date('Y');
	$date = false;
}

?>

<div id="content">


<div class="secure_left">

<h5>Måned År</h5>
<form name="chooseDate" action="timelister.php" method="get">
<input name="month" class="w40" type="text" value="<?php echo $month; ?>" />
<input name="year" class="w60" type="text" value="<?php echo $year; ?>" />
<input type="submit" value="Se" />
</form>

<br />
<br />

<table id="projects" class="link">
<tr>
	<th>Prosjekter:</th>
</tr>
<?php
if ($projects) {
	foreach ($projects as $listProject) {
		echo '<tr onclick="location.href=\'timelister.php?projectId=' . $listProject->projectId . '\'"><td>' . $listProject->projectName . '</td></tr>' . "\n";
	}
}
?>
</table>

</div>

<?php
if ($project) {
	include 'include/timeliste_project.php';
}
else if ($date) {
	include 'include/timeliste_date.php';
}
else {
?>
<div class="secure_right">

<h3>Velg prosjekt for å legge inn timer.</h3>
<p>Interne/ufakturerbare timer kan legges på prosjektet som heter "Ufakturerbart".
<br />
Dersom dette prosjektet ikke finnes så kan det opprettes.</p>

</div>
<?php
}
$link->close();
?>

</div>

</div>

<script type="text/javascript">
	
</script>
</body>
</html>