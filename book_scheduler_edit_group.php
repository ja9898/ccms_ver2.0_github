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
$edit_schedule_pre="Course:".getData( nl2br( $row_status_pre['courseID']),'course').",Teacher:".showUser( nl2br( $row_status_pre['teacherID'])).",Student:". showStudents(nl2br( $row_status_pre['studentID']))
				.",BKDATE:".nl2br( $row_status_pre['dateBooked']).",Class Days:".getData(nl2br( $row_status_pre['classType']),'plan').",Status:".getData(nl2br( $row_status_pre['std_status']),'stdStatusmo-list')
				.",SDATE:".prepareDate($row_status_pre['startDate']).",EDATE:".prepareDate($row_status_pre['endDate']).",SUDATE:".prepareDate($row_status_pre['duedate']).",PAYDATE:".prepareDate($row_status_pre['paydate'])
				.",Amount:".nl2br( $row_status_pre['dues'])
				.",START_TIME:".nl2br( $row_status_pre['startTime']).",END_TIME:".nl2br( $row_status_pre['endTime']);
///////////////////////////////////////////////////////

				
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
if(!isset($_POST['teacherID']))
{
	$_POST['teacherID']=$_POST['prevteacherID'];
	} 
if(!empty($_POST['teacherID']) && !empty($_POST['studentID']) && !empty($_POST['slotDuration']) && ($_POST['slotDuration']>0) && !empty($_POST['courseID']) && !empty($_POST['group_value']) ){
	$_POST['endTime']=makeTime($_POST['startTime'],$_POST['slotDuration']);
$sql = "UPDATE `campus_schedule` SET  `courseID` =  '{$_POST['courseID']}',`startTime` =  '{$_POST['startTime']}' , `agentId` =  '{$_POST['agentId']}', `endTime` =  '{$_POST['endTime']}' ,  `startDate` =  '".prepareDate($_POST['startDate'])."' , `endDate` =  '".prepareDate($_POST['endDate'])."' ,`duedate` =  '".prepareDate($_POST['duedate'])."' ,`paydate` =  '".prepareDate($_POST['paydate'])."' ,`dues` =  '".$_POST['dues']."'  ,  `teacherID` =  '{$_POST['teacherID']}' ,  `studentID` =  '{$_POST['studentID']}' ,   `classType` =  '{$_POST['classType']}' ,`comments`='{$_POST['comments']}'    WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG //PUTTING-INSERTING NEW_VALUE
$row_status_new = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$edit_schedule_new="Course:".getData( nl2br( $_POST['courseID']),'course').",Teacher:".showUser( nl2br( $_POST['teacherID'])).",Student:". showStudents(nl2br( $_POST['studentID']))
				.",BKDATE:".nl2br( $row_status_pre['dateBooked']).",Class Days:".getData(nl2br( $_POST['classType']),'plan').",Status:".getData(nl2br( $row_status_new['std_status']),'stdStatusmo-list')
				.",SDATE:".prepareDate($_POST['startDate']).",EDATE:".prepareDate($_POST['endDate']).",SUDATE:".prepareDate($_POST['duedate']).",PAYDATE:".prepareDate($_POST['paydate'])
				.",Amount:".nl2br( $_POST['dues'])
				.",START_TIME:".nl2br( $_POST['startTime']).",END_TIME:".nl2br( $_POST['endTime']);
user_log( $_SERVER['PHP_SELF'] , "EDIT_SCHEDULE_GROUP" , $edit_schedule_pre ,$edit_schedule_new);

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
<div id="label">StartTime:</div><div id="field"><?php echo getList(stripslashes($row['startTime']),'startTime','time','Start Time');?> </div> 
<div id="label">EndTime:</div><div id="field"><?php echo getList(stripslashes($row['endTime']),'endTime','time','Start Time');?> </div> 
<div id="label">StartDate:</div><div id="field"><?php echo getInput(stripslashes($row['startDate']),'startDate','class=flexy_datepicker_input');?></div> 
<div id="label">EndDate:</div><div id="field"><?php echo getInput(stripslashes($row['endDate']),'endDate','class=flexy_datepicker_input');?> </div> 
<div id="label">TeacherID:</div><div id="field"><?php echo getDataList(stripslashes($row['teacherID']),'teacherID',3);?> </div> 
<div id="label">StudentID:</div><div id="field"><?php echo getDataList(stripslashes($row['studentID']),'studentID',4);?> </div>   
<div id="label">ClassType:</div><div id="field"><?php echo getList(stripslashes($row['classType']),'classType','plan','Select Class Type');?></div> 
<div id="label">Status:</div><div id="field"><?php echo getList(stripslashes($row['status']),'status','status','');?> </div> 
<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
</form> -->
<form action='' method='POST' onsubmit="return mandatory_fields_edit_schedule(this);">
<div id="label">Student:</div><div id="field"><?php echo getDataList(stripslashes($row['studentID']),'studentID',4,$_SESSION['userId']);?> </div> 
<div id="label">Zone:</div><div id="field"><?php echo getList("",'zoneID','zones','','toZoneTime','zonetime');?> </div> 

<div id="label">StartTime:</div><div id="field"><div id="zonetime"><?php echo getList("",'startTime','time','Start Time','toPakTime','paktime');?> </div></div> 
<div id="label">Pakistan Time:</div><div id="field"><input type="text"  name="startTime" readonly="readonly" id="paktime" value="<?php echo stripslashes($row['startTime']); ?>" /></div> 
<div id="label">Start Date:</div><div id="field"><input type="text" class="flexy_datepicker_input"  name="startDate"  id="startDate" value="<?php echo stripslashes($row['startDate']); ?>" /></div>

<div id="label">End Date:</div><div id="field"><input type="text" class="flexy_datepicker_input"  name="endDate"  id="endDate" value="<?php echo stripslashes($row['endDate']); ?>" /></div>

<div id="label">Class Duration:</div><div id="field"><select id="slotDuration" name="slotDuration"><option value="0">Select Duration</option><option value="1" <?php if($slot=='1'){?> selected="selected" <?php } ?>>30 Mins</option><option value="2" <?php if($slot=='2'){?> selected="selected" <?php } ?>>60 Mins</option><option value="3" <?php if($slot=='3'){?> selected="selected" <?php } ?>>90 Mins</option></select></div> 
<div id="label">Agent:</div><div id="field"><?php echo getDataList(stripslashes($row['agentId']),'agentId',5);?> </div> 
<div id="label">Course:</div><div id="field"><?php echo getList(stripslashes($row['courseID']),'courseID','course');?> </div>
<div id="label">Class Plan:</div><div id="field"><?php echo getList(stripslashes($row['classType']),'classType','plan','Select Class Type','availableTeacherGROUP','availableTeachersGROUP');?></div> 
<div id="label">Teacher:</div><div id="field"><div id="availableTeachersGROUP"></div>&nbsp;
<input type="hidden"  name="prevteacherID"  id="prevteacherID" value="<?php echo stripslashes($row['teacherID']); ?>" />
<?php echo showUser(stripslashes($row['teacherID']));?> </div>

<!-- Following GROUP checkbox has been added for schedules overlapping, special requirement for GROUP CLASSES -->
<div id="label">Group:</div><div id="field" style="color:green"><?php echo getCheckbox($_POST['group_value'],'group_value'); ?>(Check the box for GROUP CLASS)</div>

<div id="label">Signin Date:</div><div id="field"><input type="text" name="duedate" id="duedate" readonly="readonly" value="<?php echo stripslashes($row['duedate']); ?>" /></div>
<div id="label">Paying/Recurring Date:</div><div id="field"><input type="text" name="paydate" id="paydate" readonly="readonly" value="<?php echo stripslashes($row['paydate']); ?>" /></div>
<div id="label">Total Dues:</div><div id="field"><input type="text"  name="dues" id="dues" readonly="readonly" value="<?php echo stripslashes($row['dues']); ?>" /></div>

<div id="label">Comments For Teacher:</div><div id="field"><textarea name='comments'><?php echo stripslashes($row['comments']);?></textarea></div>  
 
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? } 
include('include/footer.php');?> 
