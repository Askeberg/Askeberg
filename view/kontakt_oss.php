<?php
include 'include/head.html';
?>

<div id="content">


<div class="left">

<h3>Skal vi kontakte deg?</h3>
<br />
<form name="form" action="../controller/sendMail.php" method="post">
<p>Navn</p>
<input name="name" type="text" />
<br />
<br />
<p>E-post</p>
<input name="email" type="email" />
<br />
<br />
<p>Kommentar</p>
<textarea name="content"></textarea>
<br />
<br />
<input name="submit" type="submit" value="Send" />
</form>
<br />
<br />

<iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d127857.19856136846!2d10.7297739!3d59.95257110000002!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x46416dfb8fcd3829%3A0xdd28d56d5a6e28e1!2sRolf+E.+Stenersens+all%C3%A9+9!5e0!3m2!1sno!2s!4v1401392933737"
width="400" height="260" frameborder="0" style="border:0"></iframe>

</div>

<div class="right">

<h3>Kontakt oss:</h3>
<br />

<p>Askeberg AS
<br />
Rolf E. Stenersens allé 9
<br />
H0601
<br />
0858 OSLO</p>
<br />

<p>Organisasjonsnummer: 913 628 713</p>
<br />

<p>Telefon: 970 65 043</p>
<br />

<p><a href="mailto:post@askeberg.no">post@askeberg.no</a></p>

</div>


</div>

<?php
include 'include/foot.html';
?>

</div>
j
<script type="text/javascript">
	
</script>
</body>
</html>