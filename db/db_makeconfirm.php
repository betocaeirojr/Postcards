<?php
	$conn = mysql_connect("localhost", "root", "");
	mysql_select_db("postcard", $conn);

$sql = <<<EOD
	CREATE TABLE confirm (
	id int NOT NULL PRIMARY KEY AUTO_INCREMENT,
	validator VARCHAR(32) NOT NULL,
	to_email VARCHAR(100) NOT NULL,
	toname VARCHAR(50) NOT NULL,
	from_email VARCHAR(100) NOT NULL,
	fromname VARCHAR(50) NOT NULL,
	bcc_email VARCHAR(100),
	cc_email VARCHAR(100),
	subject VARCHAR(255),
	postcard VARCHAR(255) NOT NULL,
	message text
	)
EOD;
$query = mysql_query($sql, $conn) or die(mysql_error());
echo "Table <i>confirm</i> created."
?>