<?php
require_once 'include/head.php';
require_once '../model/MySql.php';

$link = Db::connect();
Table::createTables($link);
$link = null;
?>

<div id="content">


<div class="left">

<h3>Under konstruksjon:</h3>
<p>Ta kontakt med Andreas Askeland for spørsmål: 970 65 043</p>

</div>

<div class="right">

<div class="img">
<!--
<img src="../view/img/mysql.png" width="235" />
<br />
<br />

<img src="../view/img/php.png" width="235" />
<br />
<br />

<img src="../view/img/javascript.png" width="235" />
-->
</div>

</div>


</div>

<?php
include 'include/foot.php';
?>

</div>

<script type="text/javascript">
	
</script>
</body>
</html>