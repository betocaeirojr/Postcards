<?php
	require 'class.SimpleMail.php';
	$postcard = new SimpleMail();
	if ($postcard->send("betocaeirojr@gmail.com","Quick message test", "This is a test using SimpleMail::send!")) 
	{
		echo "Quick message sent successfully!";
	}
?>