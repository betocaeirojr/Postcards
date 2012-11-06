<?php
$emailsent = mail("betocaeiroj@gmail.com", "Hello World", "Hi, world. Prepare for our arrival. We’re starving!");

if ($mailsent) 
{
	echo "Congrats! The message has been sent! <br><br>";
} else
{
	echo "There was an error...";
}

?>