<html>
<head>
<title>Mail Sent!</title>
</head>
<body>
<?php
$to = $_POST["to"];
$from = $_POST["from"];
$cc = $_POST["cc"];
$bcc = $_POST["bcc"];
$subject = $_POST["subject"];
$messagebody = $_POST["message"];
$boundary = "==MP_Bound_xyccr948x==";

$headers .= "Content-type: multipart/alternative; boundary=\”$boundary\"\r\n";
$headers .= "CC: " . $cc . "\r\n";
$headers .= "BCC: " . $bcc . "\r\n";
$headers .= "From: " . $from . "\r\n";

$message = "This is a Multipart Message in MIME format\n";
$message .= "--$boundary\n";
$message .= "Content-type: text/html; charset=iso-8859-1\n";
$message .= "Content-Transfer-Encoding: 7bit\n\n";
$message .= $messagebody . "\n";
$message .= "--$boundary\n";
$message .= "Content-Type: text/plain; charset=\”iso-8859-1\"\n";
$message .= "Content-Transfer-Encoding: 7bit\n\n";
$message .= $messagebody . "\n";
$message .= "--$boundary--";


$mailsent = mail($to, $subject, $message, $headers);
if ($mailsent) {
echo "Congrats! The following message has been sent: <br><br>";
echo "<b>To:</b> $to<br>";
echo "<b>From:</b> $from<br>";
echo "<b>Subject:</b> $subject<br>";
echo "<b>Message:</b><br>";
echo $message;
} else {
echo "There was an error...";
}
?>
</body>
</html>