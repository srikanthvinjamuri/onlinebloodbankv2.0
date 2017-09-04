<?php

include_once("ViaNettSMS.php");
include_once("actionindex.php");
// Declare variables.
    $Username = 'sushma.shetti.24@gmail.com';
    $Password = 'jebkw';
    $MsgSender = 'sushma';
//     $b=$_POST['phone'];
//    console.log($_POST['phone']);
    $DestinationAddress =+918801203800;
    $Message = 'Thank you for showing interest to donate blood your UserId : ';

// Create ViaNettSMS object with params $Username and $Password
$ViaNettSMS = new ViaNettSMS($Username, $Password);
try
{
	// Send SMS through the HTTP API
	$Result = $ViaNettSMS->SendSMS($MsgSender, $DestinationAddress, $Message);
	// Check result object returned and give response to end user according to success or not.
	if ($Result->Success == true)
		$Message = "Message successfully sent!";
	else
		$Message = "Error occured while sending SMS<br />Errorcode: " . $Result->ErrorCode . "<br />Errormessage: " . $Result->ErrorMessage;
}
catch (Exception $e)
{
	//Error occured while connecting to server.
	$Message = $e->getMessage();
}

?>

<html>
	<head>
		<title>ViaNettSMS Example</title>
	</head>
	<body>
<?php
echo "			<p><strong>SMS Result</strong><br />Status: $Message</p>";
?>
	</body>
</html>
