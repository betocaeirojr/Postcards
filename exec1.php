<html>
	<head>
		<title>Enter E-mail Data</title>
	</head>
<body>
<form name="theform" method="post" action="process_email.php">
<center>
<table width="640" border="0" cellpadding="4" cellspacing="0">
	<tr>
		<td colspan="4"><h2>Postcard Sender</h2></td>
	</tr>

	<tr bgcolor="#CCCCCC">
		<td>To:</td>
		<td><input type="text" name="toname" size="30"></td>
		<td>e-mail:</td>
		<td><input type="text" name="to" size="40"></td>
	</tr>
	<tr>
		<td colspan="4"><center><input type="text" name="subject" size="138" value="Messages Subject Here"></center></td>
	</tr>
	<tr>
		<td colspan="4">
			<textarea cols="100" rows="12" name="message">Enter your message here</textarea>
			<center><input type="submit" value="Send">
			<input type="reset" value="Reset the form"></center>
		</td>
	</tr>

	<tr>
		<td colspan="2"><input type=hidden name="from" size="40" value="root@localhost"></td>
		<td colspan="2"><input type=hidden name="cc" size="40" value="acaeiro@teckler.com"></td>
	</tr>

</table>
</center>
</form>
</body>
</html>