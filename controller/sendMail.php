<?php

$from_name = $_POST['name'];
$from_email = $_POST['email'];
$content = $_POST['content'];

$to = 'post@askeberg.no';
$subject = 'Webskjema fra ' . $from_name . ' (' . $from_email . ')';
$msg = $content;
$headers = "From: webskjema@askeberg.no\r\n";
$headers .= "Content-Type: text/plain; charset=UTF-8\r\n";

mail($to, $subject, $msg, $headers);

header("location: ../view/email_sendt.php");

?>
