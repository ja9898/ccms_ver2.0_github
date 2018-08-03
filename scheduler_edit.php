<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
//Super-Imposing to see if the condition on LIST TIMING id works
/* if(($_SESSION['userType']==9 || $_SESSION['userId']==195 || $_SESSION['userId']==227 || $_SESSION['userId']==48) && ($_SESSION['userId']!=226 || $_SESSION['userId']!=8) && ($_GET['id']==117 || $_GET['id']==32 || $_GET['id']==72 || $_GET['id']==165 || $_GET['id']==142 || $_GET['id']==154 || $_GET['id']==33 || $_GET['id']==152 || $_GET['id']==96 || $_GET['id']==189 || $_GET['id']==15)){
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}
else
{ */
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) {
echo $_POST['group_value']; 
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_timing` WHERE `id` = '$id' "));
$edit_teacher_schedule_pre="ID:".nl2br( $row_status_pre['id']).",Teacher:".showUser( nl2br( $row_status_pre['teacherID'])).",Sun:".nl2br( $row_status_pre['sun']).",Mon:". nl2br( $row_status_pre['mon']).",Tue:".nl2br( $row_status_pre['tue'])
				.",Wed:".nl2br( $row_status_pre['wed']).",Thur:".nl2br( $row_status_pre['thu']).",Fri:".nl2br( $row_status_pre['fri']).",Sat:".nl2br( $row_status_pre['sat']).",StartTime:".getData(nl2br( $row_status_pre['startTime']),'time')
				.",EndTime:".getData(nl2br( $row_status_pre['endTime']),'time').",Group:".nl2br($row_status_pre['group_value']);
///////////////////////////////////////////////////////

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 

$sql = "UPDATE `campus_timing` SET  `sun` =  '{$_POST['sun']}' ,  `mon` =  '{$_POST['mon']}' ,  `tue` =  '{$_POST['tue']}' ,  `wed` =  '{$_POST['wed']}' ,  `thu` =  '{$_POST['thu']}' ,  `fri` =  '{$_POST['fri']}' ,  `sat` =  '{$_POST['sat']}' ,  `startTime` =  '{$_POST['startTime']}' ,  `endTime` =  '{$_POST['endTime']}' ,  `breakStart` =  '{$_POST['breakStart']}' ,  `breakEnd` =  '{$_POST['breakEnd']}' ,  `teacherID` =  '{$_POST['teacherID']}'  ,  `group_value` =  '{$_POST['group_value']}'  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG

$edit_teacher_schedule_new="Teacher:".showUser( nl2br( $_POST['teacherID'])).",Sun:".nl2br( $_POST['sun']).",Mon:". nl2br( $_POST['mon']).",Tue:".nl2br( $_POST['tue'])
				.",Wed:".nl2br( $_POST['wed']).",Thur:".nl2br( $_POST['thu']).",Fri:".nl2br( $_POST['fri']).",Sat:".nl2br( $_POST['sat']).",StartTime:".getData(nl2br( $_POST['startTime']),'time')
				.",EndTime:".getData(nl2br( $_POST['endTime']),'time').",Group:".nl2br($_POST['group_value']);
				user_log( $_SERVER['PHP_SELF'] , "EDIT_TEACHER_SCHEDULE" , $edit_teacher_schedule_pre ,$edit_teacher_schedule_new);
///////////////////////////////////////////////////////

getMessages('edit');
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_timing` WHERE `id` = '$id' ")); 

?>

<form action='' method='POST'>  
<div id="label">Sunday:</div><div id="field"><?php echo getCheckbox(stripslashes($row['sun']),'sun');?></div> 
<div id="label">Monday:</div><div id="field"><?php echo getCheckbox(stripslashes($row['mon']),'mon');?> </div> 
<div id="label">Tuesday:</div><div id="field"><?php echo getCheckbox(stripslashes($row['tue']),'tue');?> </div> 
<div id="label">Wednesday:</div><div id="field"><?php echo getCheckbox(stripslashes($row['wed']),'wed');?> </div> 
<div id="label">Thursday:</div><div id="field"><?php echo getCheckbox(stripslashes($row['thu']),'thu');?> </div> 
<div id="label">Friday:</div><div id="field"><?php echo getCheckbox(stripslashes($row['fri']),'fri');?> </div> 
<div id="label">Saturday:</div><div id="field"><?php echo getCheckbox(stripslashes($row['sat']),'sat');?> </div> 
<div id="label">Start Time:</div><div id="field"><?php echo getList(stripslashes($row['startTime']),'startTime','time','Start Time');?></div> 
<div id="label">End Time:</div><div id="field"><?php echo getList(stripslashes($row['endTime']),'endTime','time','End Time');?> </div> 
<div id="label">Teacher:</div><div id="field"><?php echo getDataList(stripslashes($row['teacherID']),'teacherID',3);?> </div> 
<!--If userType is Teacher TL, Then group_value is readonly-->
<?php if($_SESSION['userType']==8) { ?>	
<div id="label">Group:</div><div id="field">
<input type="text" name="group_value" id="group_value" readonly="readonly" value="<?php echo stripslashes($row['group_value']);  ?>" /> </div>
<!--Else userType is other THAN Teacher TL, Then group_value is editable-->
<?php } else { ?> 
<div id="label">Group:</div><div id="field">
<input type="text" name="group_value" id="group_value" value="<?php echo stripslashes($row['group_value']);  ?>" /> </div>
<?php } ?>
<div id="label"></div><div id="field"><input type='submit' class="button" value='Edit Row' /><input type='hidden' value='1' name='submitted'/> </div>
</form> 
<? } /* } */
include('include/footer.php');?> 
