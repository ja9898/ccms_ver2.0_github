<? 
include('config.php');
include('include/header.php');
?>
<? 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
if($_SESSION['userType']==5)
{
	$_POST['agentId']=$_SESSION['userId'];
}

$sql = "INSERT INTO `campus_callbacks` ( `name` ,agentId,  `contact` ,  `otherDetails`  ) VALUES(  '{$_POST['name']}' , '{$_POST['agentId']}',  '{$_POST['contact']}' ,  '{$_POST['otherDetails']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$add_callback="Name:".nl2br( $_POST['name']).",
Agent:".showUser( nl2br( $_POST['agentId'])).",
Contact:". nl2br($_POST['contact']).",
otherDetails:".$_POST['otherDetails'];
user_log( $_SERVER['PHP_SELF'] , "ADD_CALLBACK" , $_SESSION['userId'] ,$add_callback);
///////////////////////////////////////////////////////
getMessages('add'); 
} 
?>

<form action='' method='POST'> 
<div id="label">Name:</div><div id="field"><input type="text" name='name' /></div>
<div id="label">Contact:</div><div id="field"><input type="text" name='contact' /></div>
<?php if($_SESSION['userType']!=5)
{?>
<div id="label">Agent:</div><div id="field"><?php echo getDataList('','agentId',5);?> </div> 
<? } ?>
<div id="label">Details:</div><div id="field"><br /><textarea name='otherDetails'></textarea> </div>
<div id="label"></div><div id="field"><input type='submit' value='Add Row' class=button /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<?
include('include/footer.php');
?>