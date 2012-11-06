<?php
	date_default_timezone_set('America/Sao_Paulo');

	$id = $_GET['id'];
	require('db/connect_to_db.php');

	$sql = "SELECT * FROM confirm WHERE validator = '$id'";

	$query = mysql_query($sql, $conn) or 
		die(mysql_error());

	$pcarray = mysql_fetch_array($query);

	if (!is_array($pcarray)) 
	{
		echo "Oops! Nothing to confirm. Please contact your administrator";
		exit;
	}

	$to = $pcarray["to_email"];
	$toname = $pcarray["toname"];
	$from = $pcarray["from_email"];
	$fromname = $pcarray["fromname"];
	$bcc = $pcarray["bcc_email"];
	$cc = $pcarray["cc_email"];
	$subject = $pcarray["subject"];
	$postcard = $pcarray["postcard"];
	$messagebody = $pcarray["message"];
	$boundary = "==MP_Bound_xyccr948x==";
	$headers = "MIME-Version: 1.0\r\n";
	$headers .= "Content-type: multipart/alternative; boundary=\”$boundary\"\r\n";
	if (!$cc == "") 
	{
		$headers .= "CC: " . $cc . "\r\n";
	}
	if (!$bcc == "") 
	{
		$headers .= "BCC: " . $bcc . "\r\n";
	}
	$headers .= "From: " . $from . "\r\n";

	$html_msg .= "<center>";
	$html_msg .= "<table width=\"500\" border=0 cellpadding=\"4\">";
	$html_msg .= "<tr><td>Greetings, $toname!";
	$html_msg .= "</td></tr><tr><td>";
	$html_msg .= "$fromname has sent you a postcard today.<br>Enjoy!";
	$html_msg .= "</td></tr><tr><td align=\"center\">";
	$html_msg .= "<img src=\"$postcard\" border=\"0\">";
	$html_msg .= "</td></tr><tr><td align=center>";
	$html_msg .= $messagebody . "\n";
	$html_msg .= "</td></tr></table></center>";
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

?>

<html>
	<head>
		<title>Postcard Sent!</title>
	</head>
<body>
<?php
	if ($mailsent) 
	{
		echo "Congrats! The following message has been sent: <br><br>";
		echo "<b>To:</b> $to<br>";
		echo "<b>From:</b> $from<br>";
		echo "<b>Subject:</b> $subject<br>";
		echo "<b>Message:</b><br>";
		echo $html_msg;
	} else 
	{
		echo "There was an error...";
	}
?>
</body>
</html>