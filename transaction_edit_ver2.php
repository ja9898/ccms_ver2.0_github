<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id'];
$studentID=$_GET['studentID'];
$crs=$_GET['crs']; 
$classType=$_GET['classType'];
$schedule_id=$_GET['schedule_id'];

$teacherID = $_GET['teacherID'];

if (isset($_POST['submitted'])) { 




if(!empty($_POST['studentID']) && !empty($_POST['teacherID']) ){
	
$sql = "UPDATE `campus_transaction` SET  `teacherID` =  '".$_POST['teacherID']."' WHERE `id` = '$id' "; 
//, `status_dead` =  '".$_POST['status_dead']."' , `dead_date` =  '".$_POST['dead_date']."' , `comments_dead` =  '".$_POST['comments_dead']."'
mysql_query($sql) or die(mysql_error()); 


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
<div id="label">Student:</div><div id="field"><?php echo getDataList(stripslashes($_GET['studentID']),'studentID',4);?> </div>
<div id="label">Course:</div><div id="field"><?php echo getData($_GET['crs'],'course');//getScheduleList(stripslashes($_GET['crs']));?> </div>
<div id="label">Class Plan:</div><div id="field"><?php echo getData($_GET['classType'],'plan');?></div>

<div id="label">Schedule ID:</div><div id="field"><input type="text"  name="schedule_id"  id="schedule_id" value="<?php echo stripslashes($_GET['schedule_id']); ?>" readonly="readonly" /></div>

<div id="label">teacher:</div><div id="field"><?php echo getDataList(stripslashes($_GET['teacherID']),'teacherID',3);?> </div> 


<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? } 
include('include/footer.php');?> 
