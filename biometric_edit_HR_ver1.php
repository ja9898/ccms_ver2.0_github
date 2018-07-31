<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 

$id = (int) $_GET['id']; 
$user_id = (int) $_GET['userId']; 
if (isset($_POST['submitted'])) {
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 

$sql = "UPDATE `campus_attendance_employee` SET  
`onDuty` =  '{$_POST['onDuty']}' ,  
`offDuty` =  '{$_POST['offDuty']}' 
WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 


getMessages('edit');
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_attendance_employee` WHERE `id` = '$id' ")); 

?>

<form action='' method='POST'>  
<div id="label">Teacher Name:</div><div id="field"><label name='teacher-readonly'><?php echo showUser($user_id); ?> </label></div>
<div id="label">Date:</div><div id="field"><input type='text' name='date' value='<?php echo $row['date']; ?>' readonly='readonly'/> </div>
<div id="label">onDuty:</div><div id="field"><?php echo getInput(stripslashes($row['onDuty']),'onDuty','')?></div> 
<div id="label">offDuty:</div><div id="field"><?php echo getInput(stripslashes($row['offDuty']),'offDuty','')?> </div> 
<!--If userType is Teacher TL, Then group_value is readonly-->

<div id="label"></div><div id="field"><input type='submit' class="button" value='Edit Row' /><input type='hidden' value='1' name='submitted'/> </div>
</form> 
<? } /* } */
include('include/footer.php');?> 
