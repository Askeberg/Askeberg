<div id="edit" class="secure_right">

<a href="../controller/timeliste_excel.php?date=<?php echo $date; ?>" target="_blank">Last ned som Excel dokument</a>
<a href="timeliste_print.php?date=<?php echo $date; ?>" target="_blank">Utskriftsvennlig side</a>

</div>

<div class="secure_right">

<h3><?php echo $date; ?></h3>

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

<script type="text/javascript">
	request('getWage.php', ['date'], ['<?php echo $date; ?>'], buildWages);
</script>

</div>
