<?php
	require 'class.SimpleMail.php';
	$postcard = new SimpleMail();
	$postcard->to = "acaeiro@teckler.com";
	$postcard->subject = "Testing HTML email";
	$postcard->htmlbody = "This is a test using HTML email!";
	$postcard->send_html = TRUE;
	$postcard->send_text = FALSE;
	if ($postcard->send()) {
		echo "HTML email sent successfully!";
	}
?>