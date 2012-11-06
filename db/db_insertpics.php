<?php
	require("connect_to_db.php");

	$sql = "CREATE DATABASE IF NOT EXISTS postcard";
	$success = mysql_query($sql, $conn) or die(mysql_error());

	echo "Database Created...<BR>";
	
	// Select DB
	mysql_select_db("postcard", $conn);
	

	// Starting creating Tables
	$sql = "CREATE TABLE images 
			(id int NOT NULL primary key
			auto_increment, img_url VARCHAR(255) NOT NULL,
			img_desc text)";
	
	$success = mysql_query($sql, $conn) or die(mysql_error());
	
	echo "'images' table created...<BR>";

	$path = "http://" . $_SERVER['SERVER_NAME'] . strrev(strstr(strrev($_SERVER['PHP_SELF']),"/"));

	$imagepath = $path . "php/postcards/images/";

	$imgURL = array('punyearth.gif', 'grebnok.gif', 'sympathy.gif', 'congrats.gif');

	$imgDESC = array('Wish you were here!', 'See you soon!', 'Our Sympathies', 'Congratulations!');

	for ($i=0; $i<4; $i++) 
	{
		$sql = "INSERT INTO images ( images.img_url , images.img_desc )
				VALUES ( '$imagepath$imgURL[$i]', '$imgDESC[$i]')";
		
		$success = mysql_query($sql, $conn) 
			or die(mysql_error());
	}
	echo "Data entered...<BR>"
?>