<?php

session_start();

if (!$_SESSION['auth']) {
	header('Location: ../view/index.php');
	exit;
}

require_once('../model/MySql.php');

require_once('../model/Project.php');

$link = Db::connect();

if ($_POST['event'] == "delete") {
	Project::deletFromDb($_POST['projectId'], $link);
	
	header('Location: ../view/prosjekter.php');
}
else {
	if (!isset($_POST['approved'])) $_POST['approved'] = 0;
	if (!isset($_POST['started'])) $_POST['started'] = 0;
	if (!isset($_POST['finished'])) $_POST['finished'] = 0;
	if (!isset($_POST['delivered'])) $_POST['delivered'] = 0;
	if (!isset($_POST['billed'])) $_POST['billed'] = 0;
	
	$project = new Project($_POST['projectId'], $_POST['projectName'], $_POST['customer'], $_POST['contact']);
	$project->deadline = strtotime($_POST['deadline'] . ' 12:00');
	$project->estimatedHours = $_POST['estimatedHours'];
	$project->priceHour = $_POST['priceHour'];
	$project->priceTot = $_POST['priceTot'];
	$project->participants = $_POST['participants'];
	$project->github = $_POST['github'];
	$project->description = $_POST['description'];
	$project->approved = $_POST['approved'];
	$project->started = $_POST['started'];
	$project->finished = $_POST['finished'];
	$project->delivered = $_POST['delivered'];
	$project->billed = $_POST['billed'];
	
	$project->addToDb($link);
	
	header('Location: ../view/prosjekter.php?projectId=' . $project->projectId);
}

$link->close();


/*echo '<pre>';
echo print_r($project);
die;*/

?>
