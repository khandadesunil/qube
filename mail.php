<?php
function send_smtpEmail($to_add,$subject,$message){
	require 'libs/PHPMailer/PHPMailerAutoload.php';
	$mail             = new PHPMailer();
	$body             = '<html>'.$message.'</html>';
	$body             = eregi_replace("[\]",'',$body);
	$mail->IsSMTP(); // telling the class to use SMTP
	$mail->Host       = "smtp.office365.com"; // SMTP server
	$mail->SMTPDebug  = 0;                     // enables SMTP debug information (for testing) // 1 = errors and messages   // 2 = messages only
	$mail->SMTPAuth   = true;                  // enable SMTP authentication
	$mail->Host       = "smtp.office365.com"; // sets the SMTP server
	$mail->Port       = 587;                    // set the SMTP port for the GMAIL server
	$mail->Username   = "webmaster@qubeservices.in"; // SMTP account username
	$mail->Password   = "Paga2661";        // SMTP account password
	$mail->SMTPSecure = 'tls';
	$mail->SetFrom('webmaster@qubeservices.in', 'Qube Services');
	$mail->AddReplyTo("webmaster@qubeservices.in","Qube Services");
	$mail->Subject    = $subject;
	$mail->AltBody    = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
	$mail->MsgHTML($body);
	$address = $to_add;
	$mail->AddAddress($address);
	if(!$mail->Send()) {
	  return 0;
	} else {
	  return 1;
	}
}

    
?>