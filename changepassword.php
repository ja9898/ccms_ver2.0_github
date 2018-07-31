<? 
include('config.php'); 
include('include/header.php');
if (isset($_SESSION['userId']) ) { 
$id = (int) $_SESSION['userId']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 

if(($_POST['npassword']!=$_POST['cnpassword']) || empty($_POST['npassword']))
{
getMessages('error');
}
else{
if($_SESSION['studentType']==4)
{
$sql = "UPDATE `campus_students` SET     `password` =  '".$_POST['npassword']."' WHERE `id`='$id' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
}
else{
$sql = "UPDATE `capmus_users` SET     `password` =  '".md5($_POST['npassword'])."' WHERE `id`='$id' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
}
}
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `capmus_users` WHERE `id` = '$id' ")); 

if($_SESSION['userType']==4){
echo "<label style='color:green; font-weight:bold'>**STUDENT CREDENTIALS**</label>";
}
else{
echo "<label style='color:green; font-weight:bold'>**USER CREDENTIALS**</label>";
}
?>
<form action='' method='POST' id="new_entry"> 

<div id="label">Old Password:</div><div id="field"><input type='password' name='password' value='<?= stripslashes($row['password']) ?>' disabled /></div> 
<div id="label">New Password:</div><div id="field"><input type='password' name='npassword' value='' /></div> 
<div id="label">Confirm New Password:</div><div id="field"><input type='password' name='cnpassword' value='' /></div> 

<div id="label"></div><div id="field"><input type='submit' value='Change Password' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<? } 
include('include/footer.php');?> 
