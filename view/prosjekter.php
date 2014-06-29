<?php
include 'include/secure_head.php';

require_once('../model/MySql.php');

require_once('../model/Project.php');

$link = Db::connect();

$projects = Project::getProjects($link);

$project = null;

if (isset($_GET['projectId'])) {
	$project = Project::getProjectById($_GET['projectId'], $link);
}

$link->close();
?>

<div id="content">


<div class="secure_left">

<table id="projects" class="link">
<tr>
	<th>Prosjekter:</th>
</tr>
<?php
if ($projects) {
	foreach ($projects as $listProject) {
		echo '<tr onclick="location.href=\'prosjekter.php?projectId=' . $listProject->projectId . '\'"><td>' . $listProject->projectName . '</td></tr>' . "\n";
	}
}
?>
</table>

</div>

<?php
if ($project) {
	include 'include/prosjektdetaljer.php';
}
else if ($projects[0]) {
	$project = $projects[0];
	include 'include/prosjektdetaljer.php';
}
else {
?>
<div class="secure_right">

<h3>Det finnes ingen prosjekter å vise.</h3>

</div>
<?php
}
?>

</div>

</div>

<script type="text/javascript">
	
</script>
</body>
</html>