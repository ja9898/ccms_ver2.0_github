<?php
//http://blog.techwheels.net/send-email-from-localhost-wamp-server-using-sendmail/ BEST PAGE FOR SENDING EMAIL 
//FROM LOCALHOST WAMP TO ANY EMAIL ADDRESS

//$amount=$_POST['amount'];
echo $letter_format=$_POST['letter_format'];
echo $customer_email = $_POST['customer_email'];

$to       = "reply@yourcloudcampus.com";
$Bcc	= $customer_email;
$subject  = 'YCC-Teacher absent Email';
$message  = $letter_format;
$headers  = 'From: yourcloudcampus.management' . "\r\n" .
            'Reply-To: reply@yourcloudcampus.com' . "\r\n" .
			"Bcc:$Bcc\r\n" .
            'MIME-Version: 1.0' . "\r\n" .
            'Content-type: text/html; charset=iso-8859-1' . "\r\n" .
            'X-Mailer: PHP/' . phpversion();
if(mail($to, $subject, $message, $headers))
{
    echo '1';
}
else
{
    echo '0';
}
?>