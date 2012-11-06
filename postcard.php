<html>
	<head>
		<title>Enter E-mail Data</title>
	</head>
<body>
<form name="theform" method="post" action="sendconf.php">
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
		<td>From:</td>
		<td><input type="text" name="fromname" size="30"></td>
		<td>e-mail:</td>
		<td><input type="text" name="from" size="40"></td>
	</tr>
	
	<tr bgcolor="#CCCCCC">
		<td>Cc:</td>
		<td><input type="text" name="cc" size="40"></td>
		<td>Bcc:</td>
		<td><input type="text" name="bcc" size="40"></td>
	</tr>

	<tr>
		<td colspan="2">Choose a Postcard:
			<select name="postcard[]" onchange="changepostcard(this.value)">
			<?php
				include("db/connect_to_db.php");
				
				mysql_select_db("postcard");
				
				$sql = "SELECT * FROM images ORDER BY img_desc";
				
				$images = mysql_query($sql, $conn) 
					or die(mysql_error());
				
				$iloop = 0;
				while ($imagearray = mysql_fetch_array($images)) 
				{
					$iloop++;
					$iurl = $imagearray['img_url'];
					$idesc = $imagearray['img_desc'];
					if ($iloop == 1) 
					{
						echo "<option selected value=\"$iurl\">$idesc</option>\n";
						$image_url = $imagearray['img_url'];
					} else 
					{
						echo "<option value=\"$iurl\">$idesc</option>\n";
					}
				}
			?>
			</select><br>
		</td>
		<td>Subject:</td>
		<td><input type="text" name="subject" size="40"></td>
	</tr>
	
	<tr>
		<td colspan="2"><img src="<?php echo($image_url)?>" width=320 height=240 border=0 id="postcard"></td>
		<td valign="top">&nbsp;</td>
		<td align="right">
		<textarea cols="30" rows="12" name="message">Enter your message here</textarea>
		<input type="submit" value="Send">
		<input type="reset" value="Reset the form">
		</td>
	</tr>

</table>
</center>
</form>
<script language="Javascript">
function changepostcard(imgurl) 
{
	window.document.theform.postcard.src = imgurl;
}
</script>
</body>
</html>