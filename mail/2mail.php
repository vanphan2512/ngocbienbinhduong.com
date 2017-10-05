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
   //$to = "ghoshbuki@gmail.com";
   $subject = "This is subject";
   $message = "<b>This is HTML message.</b>";
   $message .= "<h1>This is headline.</h1>";
   $header = "From:".$from."\r\n";
   $header = "Cc:2012sudipta.ghosh@gmail.com  \r\n";
   $header .= "MIME-Version: 1.0\r\n";
   $header .= "Content-type: text/html\r\n";
   $retval = mail ($to,$subject,$message,$header);
   if( $retval == true )
   {
      echo "Message sent successfully...";
   }
   else
   {
     // echo "Message could not be sent...";
   }
?>
</body>
</html>