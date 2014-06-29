<div class="secure_right">

<h3><?php echo $project->projectName; ?></h3>

<table id="wages">
<tr>
	<th class="w100">Person</th>
	<th class="w100">Dato</th>
	<th class="w80">Fra kl.</th>
	<th class="w80">Til kl.</th>
	<th class="w80">Timer.</th>
	<th class="w280">Beskrivelse</th>
	<th class="w30"></th>
	<th class="w20"></th>
</tr>
</table>

<table id="newWage">
<tr id="0" class="<?php echo $project->projectId; ?>">
	<td class="w100">
		<select class="w80">
			<option value="Andreas">Andreas</option>
			<option value="Thomas">Thomas</option>
		</select>
	</td>
	<td class="w100">
		<input class="w74" type="text" />
	</td>
	<td class="w80">
		<input class="w54" type="text" />
	</td>
	<td class="w80">
		<input class="w54" type="text" />
	</td>
	<td class="w80">
		<input class="w54" type="text" readonly="readonly" />
	</td>
	<td class="w280">
		<input class="w234" type="text" />
	</td>
	<td class="w30 img">
		<img src="../view/img/v.png" width="17" onclick="saveWage(this.parentNode.parentNode);" />
	</td>
</tr>
</table>

<script type="text/javascript">
	request('getWage.php', ['projectId'], ['<?php echo $project->projectId; ?>'], buildWages);
</script>

</div>
