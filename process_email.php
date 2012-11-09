<html>
	<head>
	<title>HTML Mail Sent!</title>
	</head>
<body>
<?php
date_default_timezone_set('America/Sao_Paulo');

// from form field
$to = $_POST["to"];
$toname = $_POST["toname"];

// from hidden fields
$cc = $_POST["cc"];
$from = $_POST["from"];

$subject = $_POST["subject"];

$messagebody = $_POST["message"];

if ((empty($subject)) || (empty($messagebody)) || (empty($to)))
{
	header("location: exec1.php");
	// echo DEBUG
	//echo "<PRE>";
	//print_r($_POST);
	//echo "</PRE>";
	//echo "DEBUG: To: $toname <BR>";
	//echo "DEBUG: To-Email: $to <BR>";
	//echo "DEBUG: From: $from <BR>";
	//echo "DEBUG: CCed: $cc <BR>";
	//echo "DEBUG: Subject: $subject <BR>";
	//echo "DEBUG: Message : $messagebody <BR>";

} else
{
		//echo "DEBUG: To: $toname <BR>";
		//echo "DEBUG: To-Email: $to <BR>";
		//echo "DEBUG: From: $from <BR>";
		//echo "DEBUG: CCed: $cc <BR>";
		//echo "DEBUG: Subject: $subject <BR>";
		//echo "DEBUG: Message : $messagebody <BR>";


	//if (!empty($_POST["postcard"])) 
	//{
	//	foreach($_POST["postcard"] as $value) 
	//	{
	//		$postcard = $value;
	//	}
	//}

	// Message Multipart

	$boundary = "==MP_Bound_xyccr948x==";
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: multipart/alternative; boundary=\"$boundary\"\r\n";
	$headers .= "From: $from\r\n";
	$headers .= "Cc: $cc\r\n";

	$html_msg = "<center>";
	$html_msg .= "<table width=\"500\" border=0 cellpadding=\"4\">";
	$html_msg .= "<tr><td>Greetings, $toname!";
	$html_msg .= "</td></tr><tr><td>";
	//$html_msg .= "$fromname has sent you a postcard today.<br>Enjoy!";
	$html_msg .= "</td></tr><tr><td align=\"center\">";
	//$html_msg .= "<img src=\"$postcard\" border=\"0\">";
	$html_msg .= "</td></tr><tr><td align=center>";
	$html_msg .= $messagebody . "\n";
	$html_msg .= "</td></tr></table></center>";

	/* Code used to send confirmation email
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
	*/

	$message = "This is a Multipart Message in MIME format\n";
	$message .= "--$boundary\n";
	$message .= "Content-type: text/html; charset=iso-8859-1\n";
	$message .= "Content-Transfer-Encoding: 7bit\n\n";
	$message .= $html_msg . "\n";
	$message .= "--$boundary\n";
	$message .= "Content-Type: text/plain; charset=\"iso-8859-1\"\n";
	$message .= "Content-Transfer-Encoding: 7bit\n\n";
	$message .= $messagebody . "\n";
	$message .= "--$boundary--";

	$mailsent = mail($to, $subject, $message, $headers);

	if ($mailsent	) 
	{
		echo "<p>";
		echo "=====================================================<BR>";
		echo "Here is the postcard you wish to send.<br>";
		//echo "A confirmation e-mail has been sent to $from.<br>";
		//echo "Open your e-mail and click on the link to confirm that you would like to send this postcard to 
		//$toname.<br><br>";
		echo "<b>From:</b> $from:<BR>";
		echo "<b>To:</b> $toname ($to) <BR>";
		echo "<b>CCed:</b> $cc <BR>";
		echo "<b>Subject:</b> $subject<br>";
		echo "<b>Message:</b><br>";
		echo $html_msg;
		echo "<BR>Headers: $headers <BR>";
		echo "</p>";
	} else 
	{
		echo "<p>";
		echo "There was an error sending the email.";
		echo "<p>";
	}
}
?>
</body>
</html>