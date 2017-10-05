<html>
<head>
<title>Sending HTML email using PHP</title>
</head>
<body>
<form  method="post">
  TO: <input type="text" name="to"><br>
  FROM: <input type="text" name="from"><br>
  <input type="submit" value="Submit">
</form> 
<?php
	$to=$_REQUEST['to'];
	$from=$_REQUEST['from'];
	if(count($_POST)>1)
	{
		//print_r($_REQUEST);
	}
   
   $subject = "This is a test mail";
   $message = "<b>This is a test message.</b>";
   $headers = "From:TEST MAIL<".$from.">\r\n" .
	$headers  = 'MIME-Version: 1.0' . "\r\n";
	$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n".'X-Mailer: PHP/' . phpversion();	
   
   $retval = mail ($to,$subject,$message,$headers);
   if( $retval == true )
   {
      echo "Message sent successfully...";
   }
   else
   {
      echo "Message could not be sent...";
   }
?>
</body>
</html>