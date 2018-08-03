<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id'];
$slot=makeSlot($id); 
$_POST['scheduleEdit']=$id;
if (isset($_POST['submitted'])) { 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG //GETTING PRE_VALUE
$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$edit_schedule_ver2_pre="Teacher:".showUser( nl2br( $row_status_pre['teacherID'])).",Student:". showStudents(nl2br( $row_status_pre['studentID']))
					.",SkypeTEXT:".nl2br( $row_status_pre['skypetext']);
///////////////////////////////////////////////////////

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
if(!isset($_POST['teacherID']))
{
	$_POST['teacherID']=$_POST['prevteacherID'];
	} 
if(!empty($_POST['teacherID']) && !empty($_POST['studentID'])  ){
	
$sql = "UPDATE `campus_schedule` SET  `skypetext` =  '".$_POST['skypetext']."'   WHERE `id` = '$id' "; 
//, `status_dead` =  '".$_POST['status_dead']."' , `dead_date` =  '".$_POST['dead_date']."' , `comments_dead` =  '".$_POST['comments_dead']."'
mysql_query($sql) or die(mysql_error()); 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG //GETTING PRE_VALUE
$edit_schedule_ver2_new="Teacher:".showUser( nl2br( $_POST['teacherID'])).",Student:". showStudents(nl2br( $_POST['studentID']))
					.",SkypeText:".nl2br( $_POST['skypetext']);
user_log( $_SERVER['PHP_SELF'] , "SKYPE_EDIT_SCHEDULE_VER2" , $edit_schedule_ver2_pre ,$edit_schedule_ver2_new);

///////////////////////////////////////////////////////


getMessages('edit');
}
else
{
getMessages('error');
}
} 

$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' ")); 


?>

 
 
<!--<form action='' method='POST'> 
<div id="label">StartTime:</div><div id="field"><?php //echo getList(stripslashes($row['startTime']),'startTime','time','Start Time');?> </div> 
<div id="label">EndTime:</div><div id="field"><?php //echo getList(stripslashes($row['endTime']),'endTime','time','Start Time');?> </div> 
<div id="label">StartDate:</div><div id="field"><?php //echo getInput(stripslashes($row['startDate']),'startDate','class=flexy_datepicker_input');?></div> 
<div id="label">EndDate:</div><div id="field"><?php //echo getInput(stripslashes($row['endDate']),'endDate','class=flexy_datepicker_input');?> </div> 
<div id="label">TeacherID:</div><div id="field"><?php //echo getDataList(stripslashes($row['teacherID']),'teacherID',3);?> </div> 
<div id="label">StudentID:</div><div id="field"><?php //echo getDataList(stripslashes($row['studentID']),'studentID',4);?> </div>   
<div id="label">ClassType:</div><div id="field"><?php //echo getList(stripslashes($row['classType']),'classType','plan','Select Class Type');?></div> 
<div id="label">Status:</div><div id="field"><?php //echo getList(stripslashes($row['status']),'status','status','');?> </div> 
<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
</form> -->
<form action='' method='POST'>
<div id="label">Student:</div><div id="field"><?php echo getDataList(stripslashes($row['studentID']),'studentID',4,$_SESSION['userId_bas']);?> </div> 
<div id="label">Teacher:</div><div id="field"><div id="availableTeachers"></div>&nbsp;
<input type="hidden"  name="prevteacherID"  id="prevteacherID" value="<?php echo stripslashes($row['teacherID']); ?>" />
<?php echo showUser(stripslashes($row['teacherID']));?> </div>
<div id="label">Skype_TEXT:</div><div id="field"><input type="text"  name="skypetext"  id="skypetext"  value="<?php echo $row['skypetext']; ?>" /></div>
<div id="label">StartTime(ReadOnly):</div><div id="field"><input type="text"  name="startTime"  id="startTime" readonly="readonly" value="<?php echo stripslashes($row['startTime']); ?>" /></div>
<div id="label">EndTime(ReadOnly):</div><div id="field"><input type="text"  name="endTime"  id="endTime" readonly="readonly" value="<?php echo stripslashes($row['endTime']); ?>" /></div>
<!--<div id="label">Status Dead:</div><div id="field"><input type="text" name="status_dead" id="status_dead" value="<?php //echo stripslashes($row['status_dead']); ?>" /></div>
<div id="label">Dead Date:</div><div id="field"><input type="text" class="" name="dead_date" id="dead_date" value="<?php //echo stripslashes($row['dead_date']); ?>" /></div>
<div id="label">Dead comments:</div><div id="field"><input type="text" name="comments_dead" id="comments_dead" value="<?php //echo stripslashes($row['comments_dead']); ?>" /></div>-->


<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? } 
include('include/footer.php');?> 
