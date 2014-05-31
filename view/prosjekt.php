<?php
include 'include/secure_head.php';

require_once('../model/MySql.php');

require_once('../model/Project.php');

$link = Db::connect();

$projects = Project::getProjects($link);

if (isset($_GET['projectId'])) {
	if (!$project = Project::getProjectById($_GET['projectId'], $link)) {
		$project = new Project(0, '', '', '');
	}
}
else {
	$project = new Project(0, '', '', '');
}

$link->close();
?>

<div id="content">


<div class="secure_left">

<table id="projects" class="link">
<tr>
	<th>Prosjektnavn</th>
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

<div class="secure_right">

<form name="form" action="../controller/saveProject.php" method="post">

<table>
<tr>
	<th class="w160">Prosjektnavn <p class="inline invalid">(påkrevd)</p></th>
	<td><input name="projectName" type="text" value="<?php echo $project->projectName; ?>" /></td>
</tr>
<tr>
	<th>Kunde</th>
	<td><input name="customer" type="text" value="<?php echo $project->customer; ?>" /></td>
</tr>
<tr>
	<th>Kontaktperson</th>
	<td><input name="contact" type="text" value="<?php echo $project->contact; ?>" /></td>
</tr>
<tr>
	<th>Deadline <p class="inline invalid">(dd.mm.yyyy)</p></th>
	<td><input name="deadline" type="text"
		value="<?php if ($project->deadline) echo date('d.m.Y', $project->deadline); else echo 0 ?>" /></td>
</tr>
<tr>
	<th>Antatt timer</th>
	<td><input name="estimatedHours" type="text" value="<?php echo $project->estimatedHours; ?>" /></td>
</tr>
<tr>
	<th>Timepris <p class="inline">(800 eks. mva.)</p></th>
	<td><input name="priceHour" type="text" value="<?php echo $project->priceHour; ?>" /></td>
</tr>
<tr>
	<th>Fastpris</th>
	<td><input name="priceTot" type="text" value="<?php echo $project->priceTot; ?>" /></td>
</tr>
<tr>
	<th>Deltakere</th>
	<td><input name="participants" type="text" value="<?php echo $project->participants; ?>" /></td>
</tr>
<tr>
	<th>Github</th>
	<td><input name="github" type="text" value="<?php echo $project->github; ?>" /></td>
</tr>
<tr>
	<th>Beskrivelse</th>
	<td><textarea name="description"><?php echo $project->description; ?></textarea></td>
</tr>
</table>

<label><input name="approved" type="checkbox" value="1"
		<?php if ($project->approved) echo 'checked'; ?> /> Godkjent</label>
<label><input name="started" type="checkbox" value="1"
		<?php if ($project->started) echo 'checked'; ?> /> Startet</label>
<label><input name="finished" type="checkbox" value="1"
		<?php if ($project->finished) echo 'checked'; ?> /> Ferdig</label>
<label><input name="delivered" type="checkbox" value="1"
		<?php if ($project->delivered) echo 'checked'; ?> /> Levert</label>
<label><input name="billed" type="checkbox" value="1"
		<?php if ($project->billed) echo 'checked'; ?> /> Fakturert</label>

<br />
<br />
<br />

<input name="projectId" type="hidden" value="<?php echo $project->projectId; ?>" />

<input name="submit" type="submit" value="Lagre" />
<?php
if ($project->projectId) {
	echo
'<input name="submit" type="submit" value="Slett" />
<p class="inline invalid">Husk at også filer slettes permanent</p>';
}

?>

</form>

</div>

</div>

</div>

<script type="text/javascript">
	
</script>
</body>
</html>