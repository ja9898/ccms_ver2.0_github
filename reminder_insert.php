<?php
$comments_reminder = $_REQUEST["comments_reminder"]; 
$date_reminder = $_REQUEST["date_reminder"];
$employee_id = $_REQUEST["employee_id"];

 $sql = "UPDATE campus_schedule   
           SET comments_reminder='$comments_reminder',   
           date_reminder='$date_reminder'	  
           WHERE id='".$employee_id."' ";

//You need create a database connection
$dbhost = 'localhost';
$dbuser = 'root';
$dbpass = '';

$conn = mysql_connect($dbhost, $dbuser, $dbpass);
if(! $conn ){
   //die('Could not connect: ' . mysql_error());
   die(json_encode("0"));
}
mysql_select_db('testnew');
$retval = mysql_query( $sql, $conn );
if(! $retval ) {
   //die('Could not update data: ' . mysql_error());
   die(json_encode("0"));
}
mysql_close($conn);

die(json_encode("1"));

?>