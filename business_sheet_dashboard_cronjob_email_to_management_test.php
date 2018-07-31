<?php 
//include('config.php');
//include('include/header.php'); 
$database="testnew";
$username="root";
$password="";
/*$r = mysql_connect('localhost',$username,$password);
if (!$r) {
    echo "Could not connect to server\n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Connection established\n"; 
}*/

$link = mysql_connect('localhost', $username, $password);
if (!$link) {
    die('Not connected : ' . mysql_error());
}
else {
    echo "Connection established\n"; 
}
if (! mysql_select_db($database) ) {
    die ('Can\'t use cloud_new1 : ' . mysql_error());
}

$system_date = systemDate();

$curr_date = date('Y-m-d');



if($system_date==$curr_date)
fwrite(STDOUT, "Hello User\n");
else
{ echo "Failed"; 
	fwrite(STDOUT, "UnSuccessful\n");
	exit(0);}
//$sql_user="SELECT * FROM capmus_users WHERE id=$key_id";
//$result = mysql_query($sql_user) or die(mysql_error());
//$row = mysql_fetch_array($result);
//$userID=$row['id'];

$result_insert=insert_in_campus_users();
if($result_insert==1){
	//fwrite(STDOUT, "Press Any key to continue-Successful\n");
	print "Successful";
}
else
{
	//fwrite(STDOUT, "Press Any key to continue-UnSuccessful\n");
	print "UnSuccessful";
}

   function systemDate(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time($todayDate); //Change date into time
  $timeAfterOneHour = $currentTime-9*60*60;

  //return date("Y-m-d H:i:s",$timeAfterOneHour);
  return date("Y-m-d",$timeAfterOneHour);
  
  }

  function systemDateTime(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time($todayDate); //Change date into time
  $timeAfterOneHour = $currentTime-9*60*60;

  return date("Y-m-d H:i:s",$timeAfterOneHour);
  //return date("Y-m-d",$timeAfterOneHour);
  
  }

function insert_in_campus_users()
{
$sql = "INSERT INTO `capmus_users` (   `username` ,  `password` ,  `firstName` ,   `lastName`  ) VALUES(    'EMAIL TEST-1' ,  '123' ,  'EMAIL TEST-1'  ,  'EMAIL TEST-1'  ) "; 
mysql_query($sql) or die(mysql_error());
return 1;
}

		
?>
