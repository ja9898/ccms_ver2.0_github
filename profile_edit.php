<? 
include('config.php'); 
include('include/header.php');
if (isset($_SESSION['userId'])) { 
$id = (int) $_SESSION['userId']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `capmus_users` SET    `username` =  '{$_POST['username']}'  ,  `firstName` =  '{$_POST['firstName']}' ,  `middleName` =  '{$_POST['middleName']}' ,  `lastName` =  '{$_POST['lastName']}' ,  `fatherName` =  '{$_POST['fatherName']}' ,  `email` =  '{$_POST['email']}' ,  `gender` =  '{$_POST['gender']}' ,   `phone` =  '{$_POST['phone']}' ,  `alt_phone` =  '{$_POST['alt_phone']}' ,  `nic` =  '{$_POST['nic']}' ,    `countryId` =  '{$_POST['countryId']}' ,  `address` =  '{$_POST['address']}'    WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');

} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `capmus_users` WHERE `id` = '$id' ")); 
?>
<form action='' method='POST' id="new_entry"> 
<div id="label">Username:</div><div id="field"><input type='text' name='username' readonly="readonly" value='<?= stripslashes($row['username']) ?>' /></div>  
<div id="label">FirstName:</div><div id="field"><input type='text' name='firstName' value='<?= stripslashes($row['firstName']) ?>' /></div> 
<div id="label">MiddleName:</div><div id="field"><input type='text' name='middleName' value='<?= stripslashes($row['middleName']) ?>' /></div> 
<div id="label">LastName:</div><div id="field"><input type='text' name='lastName' value='<?= stripslashes($row['lastName']) ?>' /></div> 
<div id="label">FatherName:</div><div id="field"><input type='text' name='fatherName' value='<?= stripslashes($row['fatherName']) ?>' /></div> 
<div id="label">Email:</div><div id="field"><input type='text' name='email' value='<?= stripslashes($row['email']) ?>' /></div> 
<div id="label">Gender:</div><div id="field"><?php echo getList(stripslashes($row['gender']),'gender','gender');?></div> 
<div id="label">Phone:</div><div id="field"><input type='text' name='phone' value='<?= stripslashes($row['phone']) ?>' /></div> 
<div id="label">Alt Phone:</div><div id="field"><input type='text' name='alt_phone' value='<?= stripslashes($row['alt_phone']) ?>' /></div>  
<div id="label">Nic:</div><div id="field"><input type='text' name='nic' value='<?= stripslashes($row['nic']) ?>' /></div>  
<div id="label">Country:</div><div id="field"><?php echo getList(stripslashes($row['countryId']),'countryId','country');?> </div> 
<div id="label">Address:</div><div id="field"><textarea name='address'><?= stripslashes($row['address']) ?></textarea> </div>
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /><input type='hidden' value='<?php $_GET['id']?>' name='id' /> </div>
</form> 
<? } 
include('include/footer.php');?> 
