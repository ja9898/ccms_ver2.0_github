<?php 
require 'class.phpmailer.php';
require 'class.smtp.php';
$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = 'smtp';
$mail->SMTPAuth = true;
$mail->Host = 'smtp.gmail.com'; // "ssl://smtp.gmail.com" didn't worked
$mail->Port = 465;
$mail->SMTPSecure = 'ssl';
// or try these settings (worked on XAMPP and WAMP):
// $mail->Port = 587;
// $mail->SMTPSecure = 'tls';
echo $letter_format=$_POST['letter_format'];
echo $customer_email = $_POST['customer_email'];
 
$mail->Username = "yccbizsheet@gmail.com";
$mail->Password = "getheavy123";
 
$mail->IsHTML(true); // if you are going to send HTML formatted emails
$mail->SingleTo = true; // if you want to send a same email to multiple users. multiple emails will be sent one-by-one.
 
$mail->From = "yccbizsheet@gmail.com";
$mail->FromName = "CCMS";
 
$mail->addAddress("junaid.abbas86@hotmail.com","Junaid Hotmail Address");
$mail->addAddress("junaid9898@yahoo.com","Junaid yahoo address");
$mail->addAddress("faheem@yourcloudcampus.com","Faheem Email");
 
//$mail->addCC("junaid9898@yahoo.com","User 3");
//$mail->addBCC("user.4@in.com","User 4");
 
$mail->Subject = "Business Sheet - Email From CCMS ";
$mail->Body = $letter_format;
 
if(!$mail->Send())
    echo "Message was not sent <br />PHPMailer Error: " . $mail->ErrorInfo;
else
    echo "Message has been sent";
	
/*	
	//BEST LINK EVER TO SEND EMAIL FROM WAMP SERVER-localhost
	//http://stackoverflow.com/questions/23528450/how-to-send-email-from-localhost-wamp-by-php
	require 'PHPMailerAutoload.php'; //Your path to PHPMailer's directory
$Mail = new PHPMailer();
$Mail->IsSMTP(); // Use SMTP
$Mail->Host        = "smtp.gmail.com"; // Sets SMTP server for gmail
$Mail->SMTPDebug   = 0; // 2 to enable SMTP debug information
$Mail->SMTPAuth    = TRUE; // enable SMTP authentication
$Mail->SMTPSecure  = "tls"; //Secure conection
$Mail->Port        = 587; // set the SMTP port to gmail's port
$Mail->Username    = 'junaidabbas2012@gmail.com'; // gmail account username
$Mail->Password    = 'heavymetal123abc'; // gmail account password
$Mail->Priority    = 1; // Highest priority - Email priority (1 = High, 3 = Normal, 5 =   low)
$Mail->CharSet     = 'UTF-8';
$Mail->Encoding    = '8bit';
$Mail->Subject     = 'Mail test';
$Mail->ContentType = 'text/html; charset=utf-8\r\n';
$Mail->From        = 'test2@gmail.com'; //Your email adress (Gmail overwrites it anyway)
$Mail->FromName    = 'Test';
$Mail->WordWrap    = 900; // RFC 2822 Compliant for Max 998 characters per line

$Mail->addAddress('junaid9898@yahoo.com'); // To: test1@gmail.com
$Mail->isHTML( TRUE );
$Mail->Body    = '<b>This is a test mail-AGAIN TEST BODY</b>';
$Mail->AltBody = 'This is a test mail-ALT BODY';
$Mail->Send();
$Mail->SmtpClose();

if(!$Mail->send()) {
echo 'Message could not be sent.';
echo 'Mailer Error: ' . $Mail->ErrorInfo;
exit;
}

echo 'Message has been sent';*/
	
	
?>