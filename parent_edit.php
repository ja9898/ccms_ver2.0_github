<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) {
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `campus_parent` SET `firstName` =  '{$_POST['firstName']}'  ,  
`lastName` =  '{$_POST['lastName']}' , 
`timeZoneArea` =  '{$_POST['timeZoneArea']}' , 
`timeDifference` =  '{$_POST['timeDifference']}'  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_parent` WHERE `id` = '$id' ")); 
?>
<form action='' method='POST'>  
<div id="label">FirstName:</div><div id="field"><input type='text' name='firstName' value='<?= stripslashes($row['firstName']) ?>' /></div> 
<div id="label">LastName:</div><div id="field"><input type='text' name='lastName' value='<?= stripslashes($row['lastName']) ?>' /></div> 
<div id="label">User Type:</div><div id="field"><?php echo getList(stripslashes($row['timeZoneArea']),'timeZoneArea','timeZoneArea');?> </div> 
<div id="label">Gender:</div><div id="field"><?php echo getList(stripslashes($row['timeDifference']),'timeDifference','timeDifference');?></div> 
<div id="label"></div><div id="field"><input type='submit' class="button" value='Edit Row' /><input type='hidden' value='1' name='submitted'/> </div>
</form> 
<? }
include('include/footer.php');?> 
