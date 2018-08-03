<? 
include('config.php');
include('include/header.php');
 
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_callbacks` WHERE `id` = '$id' "));
$edit_callback_pre="Name:".nl2br( $row_status_pre['name']).",
Agent:".showUser( nl2br( $row_status_pre['agentId'])).",
Contact:". nl2br($row_status_pre['contact']).",
otherDetails:".$row_status_pre['otherDetails'];
///////////////////////////////////////////////////////

$sql = "UPDATE `campus_callbacks` SET   `name` =  '{$_POST['name']}' ,  `contact` =  '{$_POST['contact']}' ,  `otherDetails` =  '{$_POST['otherDetails']}'";
if($_SESSION['userType']==5)
{
	$sql.=" , agentId='".$_SESSION['userId']."'";
}
else{
	$sql.=" ,  agentId='".$_POST['agentId']."'";
}
$sql.="   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$edit_callback_new="Name:".nl2br($_POST['name']).",
Agent:".showUser( nl2br( $_POST['agentId'])).",
Contact:". nl2br($_POST['contact']).",
otherDetails:".$_POST['otherDetails'];				
				user_log( $_SERVER['PHP_SELF'] , "EDIT_CALLBACK" , $edit_callback_pre ,$edit_callback_new);
///////////////////////////////////////////////////////

getMessages('edit');  
} 
if($_SESSION['userType']==5)
{
	$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_callbacks` WHERE `id` = '$id' and  agentId='".$_SESSION['userId']."'")); 
}
else{
	
	$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_callbacks` WHERE `id` = '$id' ")); 
}

?>



<form action='' method='POST'> 
<div id="label">Name:</div><div id="field"><input type="text" name='name' value="<?= stripslashes($row['name']) ?>" /></div>
<div id="label">Contact:</div><div id="field"><input type="text" name='contact' value="<?= stripslashes($row['contact']) ?>" /></div>
<? if($_SESSION['userType']!=5)
{?>
<div id="label">Agent:</div><div id="field"><?php echo getDataList(stripslashes($row['agentId']),'agentId',5);?> </div> 

<? }?>
<div id="label">Details:</div><div id="field"><br /><textarea name='otherDetails'><?= stripslashes($row['otherDetails']) ?></textarea> </div>
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class=button /><input type='hidden' value='1' name='submitted' /> </div>
</form> 

<? } 
include('include/footer.php');
?>?> 
