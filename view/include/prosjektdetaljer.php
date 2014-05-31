<?php

$status = null;

if ($project->approved) $status[] = 'Godkjent';
if ($project->started) $status[] = 'Startet';
if ($project->finished) $status[] = 'Ferdig';
if ($project->delivered) $status[] = 'Levert';
if ($project->billed) $status[] = 'Fakturert';

?>
<div id="edit" class="secure_right">

<a href="prosjekt.php?projectId=<?php echo $project->projectId; ?>">Rediger</a>

</div>

<div class="secure_right">

<h3><?php echo $project->projectName; ?></h3>

<table>
<tr>
	<th class="w140">Kunde</th>
	<td><?php echo $project->customer; ?></td>
</tr>
<tr>
	<th>Kontaktperson</th>
	<td><?php echo $project->contact; ?></td>
</tr>
<tr>
	<th>Deadline</th>
	<td><?php if ($project->deadline) echo date('d.m.Y', $project->deadline); else echo 0; ?></td>
</tr>
<tr>
	<th>Antatt timer</th>
	<td><?php echo $project->estimatedHours; ?></td>
</tr>
<tr>
	<th>Timepris</th>
	<td><?php echo $project->priceHour; ?></td>
</tr>
<tr>
	<th>Fastpris</th>
	<td><?php echo $project->priceTot; ?></td>
</tr>
<tr>
	<th>Deltakere</th>
	<td><?php echo $project->participants; ?></td>
</tr>
<tr>
	<th>Github</th>
	<td><a href="http://github.com/Askeberg/<?php echo $project->github; ?>" target="_blank"><?php echo $project->github; ?></a></td>
</tr>
<tr>
	<th>Status</th>
	<td><?php if ($status) echo implode(', ', $status); ?></td>
</tr>
</table>

<p><?php echo str_replace("\n", '<br />', $project->description); ?></p>

<br />

<table class="link">
<tr>
	<th class="w100">Filnavn</th>
	<th class="w100">Dato</th>
	<th class="w60">Type</th>
	<th>Beskrivelse</th>
</tr>
<tr>
	<td>Krav</td>
	<td>20.05.2014</td>
	<td>pdf</td>
	<td>Kravdokument 1</td>
</tr>
<tr>
	<td>Krav</td>
	<td>20.05.2014</td>
	<td>pdf</td>
	<td>Omhandler kravene fra Hokksund</td>
</tr>
<tr>
	<td>Krav</td>
	<td>20.05.2014</td>
	<td>pdf</td>
	<td>Omhandler kravene fra Hokksund</td>
</tr>
</table>

</div>
