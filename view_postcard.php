<?php
$id = $_GET['id'];
require('db/connect_to_db.php');

$sql = "SELECT * FROM confirm WHERE validator = '$id'";

$query = mysql_query($sql, $conn) 
	or die(mysql_error());

$pcarray = mysql_fetch_array($query);

// $path = "http://" . $_SERVER[‘SERVER_NAME’] . strrev(strstr(strrev($_SERVER[‘PHP_SELF’]),”/”));
$path = "http://" . $_SERVER['SERVER_NAME'] . "/php/Postcard/images/";

if (!is_array($pcarray)) 
{
	echo "Oops! Can’t find a postcard. Please contact your administrator.";
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
$html_msg .= "<table width=\"500\" border=0 cellpadding=\"4\">";
$html_msg .= "<tr><td>Greetings, $toname!";
$html_msg .= "</td></tr><tr><td>";
$html_msg .= "$fromname has sent you a postcard today.<br>Enjoy!";
$html_msg .= "</td></tr><tr><td align=\"center\">";
$html_msg .= "<img src=\”$postcard\" border=\"0\">";
$html_msg .= "</td></tr><tr><td align=center>";
$html_msg .= $messagebody . "\n";
$html_msg .= "</td></tr></table>";

echo <<<EOD
<html>
<head>
<title>Viewing postcard for $toname</title>
</head>
<body>
$html_msg
</body>
</html>
EOD;
?>