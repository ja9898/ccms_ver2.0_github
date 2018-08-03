<?php // connect to db
session_start();
$link = mysql_connect('localhost', 'root', 'getheavy123abc');
if (!$link) {
    die('Not connected : ' . mysql_error());
}
if (! mysql_select_db('testnew') ) {
    die ('Can\'t use cloud_new1 : ' . mysql_error());
}
function CheckLogin($user,$pass){
//Following is for employee LOGIN
$user=mysql_real_escape_string($user);
$pass=mysql_real_escape_string($pass);
$sql="Select * from capmus_users where username='$user' and password='".md5($pass)."' and status=1";
$result=mysql_query($sql);
$_rowCount=mysql_num_rows($result);
if($_rowCount){
$_row=mysql_fetch_assoc($result);
$_SESSION['userName']=$_row['firstName']." ".$_row['lastName'];
$_SESSION['userType']=$_row['user_type'];
$_SESSION['userId']=$_row['id'];
$_SESSION['loggedIn']=1;
$_SESSION['userip']=$_SERVER['REMOTE_ADDR'];
$_SESSION['emp_shift']=$_row['empShift'];
//Added for Teachers.HOD		//NEWLY ADDED 09-05-16
$_SESSION['designationID']=$_row['designationID'];
$_SESSION['voice_id']=$_row['voice_id'];
}
return $_rowCount;
}?>