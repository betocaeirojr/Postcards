<html>
	<head>
	<title>HTML Mail Sent!</title>
	</head>
<body>
<?php
date_default_timezone_set('America/Sao_Paulo');

$to = $_POST["to"];
$toname = $_POST["toname"];

$cc = $_POST["cc"];
$bcc = $_POST["bcc"];

$from = $_POST["from"];
$fromname = $_POST["fromname"];

$subject = $_POST["subject"];

if (!empty($_POST["postcard"])) 
{
	foreach($_POST["postcard"] as $value) 
	{
		$postcard = $value;
	}
}

$messagebody = $_POST["message"];

$boundary = "==MP_Bound_xyccr948x==";
$headers = "MIME-Version: 1.0\r\n";
$headers .= "Content-type: multipart/alternative; boundary=\"$boundary\"\r\n";
$headers .= "From: no-reply@postcardorama.com\r\n";

$html_msg = "<center>";
$html_msg .= "<table width=\"500\" border=0 cellpadding=\"4\">";
$html_msg .= "<tr><td>Greetings, $toname!";
$html_msg .= "</td></tr><tr><td>";
$html_msg .= "$fromname has sent you a postcard today.<br>Enjoy!";
$html_msg .= "</td></tr><tr><td align=\"center\">";
$html_msg .= "<img src=\"$postcard\" border=\"0\">";
$html_msg .= "</td></tr><tr><td align=center>";
$html_msg .= $messagebody . "\n";
$html_msg .= "</td></tr></table></center>";

$temp = gettimeofday();

$msec = (int) $temp["usec"];
$msgid = md5(time() . $msec);

require('db/connect_to_db.php');

$sql = 	"INSERT INTO confirm (validator, to_email, toname, from_email, " 				.
		"fromname, bcc_email, cc_email, subject, postcard, message) " 					.
		"VALUES ('$msgid', '$to', '$toname', '$from', " 								.
				"'$fromname', '$bcc', '$cc', '$subject', '$postcard', '$messagebody' )";

$query = mysql_query($sql, $conn) 
	or die(mysql_error());

$confirmsubject = "Please Confirm your postcard";

$confirmmessage = "Hello " . $fromname . ",\n\n";
$confirmmessage .= "Please click on the link below to confirm that " .
					"you would like to send this postcard:\n\n";
$confirmmessage .= $html_msg . "\n\n";
$confirmmessage .= "<a href=\"confirm.php" .
					"?id=$msgid\">Click here to confirm</a>";
$textconfirm = "Hello " . $fromname . ",\n\n";
$textconfirm .= "Please visit the following URL to confirm your postcard:\n\n";

$textconfirm .= "confirm.php?id=$msgid";

$message = "This is a Multipart Message in MIME format\n";
$message .= "--$boundary\n";
$message .= "Content-type: text/html; charset=iso-8859-1\n";
$message .= "Content-Transfer-Encoding: 7bit\n\n";
$message .= $confirmmessage . "\n";
$message .= "--$boundary\n";
$message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
$message .= "Content-Transfer-Encoding: 7bit\n\n";
$message .= $textconfirm . "\n";
$message .= "--$boundary--";

$mailsent = mail($from, $confirmsubject, $message, $headers);
if ($mailsent) 
{
	echo "Here is the postcard you wish to send.<br>";
	echo "A confirmation e-mail has been sent to $from.<br>";
	echo "Open your e-mail and click on the link to confirm that you would like to send this postcard to 
	$toname.<br><br>";
	echo "<b>Subject:</b> $subject<br>";
	echo "<b>Message:</b><br>";
	echo $html_msg;
} else 
{
	echo "There was an error sending the email.";
}
?>
</body>
</html>