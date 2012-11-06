<?php

	$conn = mysql_connect("localhost", "root", "")
		or die("Could not connect: " . mysql_error());
	
	mysql_select_db("postcard", $conn)
		or die(mysql_error());

?>