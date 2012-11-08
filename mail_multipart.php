<?php
	require 'class.SimpleMail.php';
	$postcard = new SimpleMail();
	$postcard->to = "betocaeirojr@gmail.com";
	$postcard->from = "acaeiro@teckler.com";
	//$postcard->cc = “ccaddress@yourhost.com”;
	//$postcard->bcc = “bccaddress@yourhost.com”;
	$postcard->subject = "Testing Multipart email";
	$postcard->body = "This is the text part of the email!";
	$postcard->htmlbody = "This is the HTML part of the email!";
	$postcard->send_html = TRUE;
	if ($postcard->send()) 
	{
		echo "Multipart email sent successfully!";
	}
?>