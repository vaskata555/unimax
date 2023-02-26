<?php
$to = "vaskata555@abv.bg";
$subject = "HTML email";
ini_set("SMTP","smtp.gmail.com");
ini_set("sendmail_from", "vaskata111@gmail.com");
ini_set("smtp_port", "587");
//ini_set("smtp_port", "25");
$message = "
<html>
<head>
<title>HTML email</title>
</head>
<body>
<p>This email contains HTML Tags!</p>
<table>
<tr>
<th>Firstname</th>
<th>Lastname</th>
</tr>
<tr>
<td>John</td>
<td>Doe</td>
</tr>
</table>
</body>
</html>
";

// Always set content-type when sending HTML email
$headers = "MIME-Version: 1.0" . "\r\n";
$headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";

// More headers
$headers .= 'From: <webmaster@example.com>' . "\r\n";


mail($to,$subject,$message,$headers);
?>