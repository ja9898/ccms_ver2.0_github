<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `campus_skype` SET  `skype` =  '{$_POST['skype']}' ,  `password` =  '{$_POST['password']}' ,  `status` =  '{$_POST['status']}'   WHERE `id` = '{$_POST['id']}' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit'); 
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_skype` WHERE `id` = '$id' ")); 
?>

<form action='' method='POST'> 
<div id="label">Skype:</div><div id="field"><?php echo getInput(stripslashes($row['skype']),'skype');?></div>
<div id="label">Password:</div><div id="field"><?php echo getInput(stripslashes($row['password']),'password');?></div>
<div id="label">Status:</div><div id="field"><?php echo getList(stripslashes($row['status']) ,'status','skype_status')?> </div>
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /><input type='hidden'  name='id' value="<?php echo $row['id'] ?>"/> </div>
</form> 
<? } include('include/footer.php');?> 
