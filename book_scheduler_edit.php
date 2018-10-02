<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id'];

//NEWLY ADDED
$status_old_freeze = (int) $_GET['status_old_freeze'];
$status_old_from_lhr = (int) $_GET['status_old_from_lhr'];
/////////////

$slot=makeSlot($id); 
$_POST['scheduleEdit']=$id;
if (isset($_POST['submitted'])) { 

$operator_name = showUser( nl2br( $_SESSION['userId']));

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG //GETTING PRE_VALUE
$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$edit_schedule_pre="Course:".getData( nl2br( $row_status_pre['courseID']),'course').",Teacher:".showUser( nl2br( $row_status_pre['teacherID'])).",Student:". showStudents(nl2br( $row_status_pre['studentID']))
				.",BKDATE:".nl2br( $row_status_pre['dateBooked']).",Class Days:".getData(nl2br( $row_status_pre['classType']),'plan').",Status:".getData(nl2br( $row_status_pre['std_status']),'stdStatusmo-list')
				.",SDATE:".prepareDate($row_status_pre['startDate']).",EDATE:".prepareDate($row_status_pre['endDate']).",SUDATE:".prepareDate($row_status_pre['duedate']).",PAYDATE:".prepareDate($row_status_pre['paydate'])
				.",Amount:".nl2br( $row_status_pre['dues'])
				.",START_TIME:".nl2br( $row_status_pre['startTime']).",END_TIME:".nl2br( $row_status_pre['endTime'])
				.",Ref:".showUser(nl2br( $row_status_pre['reference']));
///////////////////////////////////////////////////////
// Checking if the Current and old teacher are the same during edit schedule-		USE IT LATER
if($row_status_pre['teacherID']==$_POST['teacherID'])
{
	$old_new_teacher = $row_status_pre['teacherID_old'];
}
else
{
	$old_new_teacher = $row_status_pre['teacherID'];
}
				
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
if(!isset($_POST['teacherID']))
{
	$_POST['teacherID']=$_POST['prevteacherID'];
	} 
if(!empty($_POST['teacherID']) && !empty($_POST['studentID']) && !empty($_POST['slotDuration']) && ($_POST['slotDuration']>0) && !empty($_POST['courseID']) && checkSchedule($_POST,$id) ){
	$paktime = $_LIST['time'][$_POST['paktime']];
	$_POST['endTime']=makeTime($paktime,$_POST['slotDuration']);
	
	//Following is to check that same student, same time and same class type MUST NOT be rescheduled
	//with same OR diff teacher
	$check_student="SELECT * FROM campus_schedule 
					WHERE studentID='".$_POST['studentID']."' 
					and startTime<='".$paktime."' and endTime>'".$paktime."' 
					and (std_status!=3 and status_dead!=1 and std_status!=4 and status_freeze!=1) and id!='".$id."' 
					and ".getClassTypeSchedule($_POST['classType']);
	$result_check_student = mysql_query($check_student);
	$rowcount_check_student = mysql_num_rows($result_check_student);
	if($rowcount_check_student>=1)
	{
	getMessages('error_check_student');
	}
	else
	{
	if(isset($_GET['id']) && isset($_GET['status_old_from_lhr'])){ from_transfertolhr_schedule($id,'2',$status_old_from_lhr); }
	if(isset($_GET['id']) && isset($_GET['status_old_freeze'])){ 
		//Get previous values for log
		/////////////////////////////////////////////////////// FOR USER LOG
		$row_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
		$unfreeze_schedule_pre="Course:".getData( nl2br( $row_pre['courseID']),'course').",Teacher:".showUser( nl2br( $row_pre['teacherID'])).",Student:". showStudents(nl2br( $row_pre['studentID']))
						.",BKDATE:".nl2br( $row_pre['dateBooked']).",Class Days:".getData(nl2br( $row_pre['classType']),'plan').",Status:".getData(nl2br( $row_pre['std_status']),'stdStatusmo-list')
						.",Amount:".nl2br( $row_pre['dues'])
						.",Freeze_date:".nl2br( $row_pre['freeze_date']);
		/////////////////////////////////////////////////////// 
		//Get new values for log
		/////////////////////////////////////////////////////// FOR USER LOG
		$row_new = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
		$unfreeze_schedule_new="Course:".getData( nl2br( $_POST['courseID']),'course').",Teacher:".showUser( nl2br( $_POST['teacherID'])).",Student:". showStudents(nl2br( $_POST['studentID']))
						.",BKDATE:".nl2br( $row_new['dateBooked']).",Class Days:".getData(nl2br( $_POST['classType']),'plan').",Status:".getData(nl2br('2'),'stdStatusmo-list')
						.",Amount:".nl2br( $row_new['dues'])
						.",UnFreeze_date:".date('Y-m-d');
		/////////////////////////////////////////////////////// 
	unfreeze_schedule($id,'2',$status_old_freeze); user_log( $_SERVER['PHP_SELF'] , "UNFREEZE_SCHEDULE" , $unfreeze_schedule_pre ,$unfreeze_schedule_new, "UNFREEZE");
	//<<<<<<<<<<<<<<<<<<<< Adding code to update PAYDATE day with system date
	$sql_paydate = mysql_fetch_array (mysql_query("SELECT * FROM campus_schedule WHERE id='".$id."' ")) or die(mysql_error());
	$paydate=$sql_paydate['paydate'];
	$paydate_day = date('d');
	$paydate_month = date('m', strtotime( $paydate));
	$paydate_year = date('Y', strtotime( $paydate));
	$paydate_output = $paydate_year."-".$paydate_month."-".$paydate_day;
	$sql="update campus_schedule set 
	paydate='".$paydate_year."-".$paydate_month."-".$paydate_day."',
	unfreeze_date='".date('Y-m-d')."', 
	std_status=2,std_status_old='".$status_old_freeze."',status_freeze=0  where `id`='".$id."'";
	mysql_query($sql) or die(mysql_error());
	/////////////////////////////////////////////////////////////////////
	}
	//Conditions on PAYDATE for unfreeze and normal editing
	if(isset($_GET['status_old_freeze'])){
		$paydate=$paydate_output;
	}
	if(!isset($_GET['status_old_freeze'])){
		$paydate=prepareDate($_POST['paydate']);
	}
//Adding OPERATOR NAME for comments_reschedule DURING EDITING	
$sql = "UPDATE `campus_schedule` SET  `courseID` =  '{$_POST['courseID']}',`startTime` =  '".$paktime."' , `agentId` =  '{$_POST['agentId']}', `endTime` =  '{$_POST['endTime']}' ,  `startDate` =  '".prepareDate($_POST['startDate'])."' , `endDate` =  '".prepareDate($_POST['endDate'])."' ,`duedate` =  '".prepareDate($_POST['duedate'])."' ,`paydate` =  '".$paydate."' ,`dues` =  '".$_POST['dues']."'  ,  `teacherID` =  '{$_POST['teacherID']}' ,  `studentID` =  '{$_POST['studentID']}' ,   `classType` =  '{$_POST['classType']}' ,`comments`='{$_POST['comments']}' , `comments_reschedule` = '\r\nOperator:{$operator_name} - Comments : {$_POST['comments_reschedule']}' ,`teacherID_old` = '".$old_new_teacher."' , `reference` = '{$_POST['reference']}' , `zeroPaidReferenceId` = '{$_POST['zeroPaidReferenceId']}' , `management_comm_Id` = '{$_POST['management_comm_Id']}' , `edit_sch_TL_confirm` = '1' , `skypeid` = '{$_POST['skypeid']}', `skypetext` = '{$_POST['skypetext']}'  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 

/*if( $row_status_pre['skypeid']==$_POST['skypeid'] && ($_POST['skypeid']!='' || $_POST['skypeid']!='0'))
{
	skypeStatus($_POST['skypeid'],'2');
	skypeStatus($_POST['skypeid'],'1');
}
else if($row_status_pre['skypeid']!=$_POST['skypeid'] && ($_POST['skypeid']!='' || $_POST['skypeid']!='0'))
{
	skypeStatus($_POST['skypeid'],'1');
	skypeStatus($row_status_pre['skypeid'],'3');
}
else
{

}*/


/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG //PUTTING-INSERTING NEW_VALUE
$row_status_new = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$edit_schedule_new="Course:".getData( nl2br( $_POST['courseID']),'course').",Teacher:".showUser( nl2br( $_POST['teacherID'])).",Student:". showStudents(nl2br( $_POST['studentID']))
				.",BKDATE:".nl2br( $row_status_pre['dateBooked']).",Class Days:".getData(nl2br( $_POST['classType']),'plan').",Status:".getData(nl2br( $row_status_new['std_status']),'stdStatusmo-list')
				.",SDATE:".prepareDate($_POST['startDate']).",EDATE:".prepareDate($_POST['endDate']).",SUDATE:".prepareDate($_POST['duedate']).",PAYDATE:".prepareDate($_POST['paydate'])
				.",Amount:".nl2br( $_POST['dues'])
				.",START_TIME:".nl2br( $paktime).",END_TIME:".nl2br( $_POST['endTime'])
				.",Ref:".showUser(nl2br( $_POST['reference']));
user_log( $_SERVER['PHP_SELF'] , "EDIT_SCHEDULE" , $edit_schedule_pre ,$edit_schedule_new);

///////////////////////////////////////////////////////

getMessages('edit');
}
}
else
{
getMessages('error');
}
} 

$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' ")); 
$comments = $row['comments'];
$comments = stripslashes($comments);
$comments = str_replace("rn","\r\n",$comments);

$comments_reschedule = $row['comments_reschedule'];
$comments_reschedule = stripslashes($comments_reschedule);
$comments_reschedule = str_replace("rn","\r\n",$comments_reschedule);

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
<form action='' method='POST' onsubmit="return mandatory_fields_edit_schedule_no_pacific_time(this);">
<div id="label">Student:</div><div id="field"><?php echo getDataList(stripslashes($row['studentID']),'studentID',4,$_SESSION['userId']);?> </div> 
<!--<div id="label">Zone:</div><div id="field"><?php //echo getList("",'zoneID','zones','','toZoneTime','zonetime');?> </div> 
<div id="label">StartTime:</div><div id="field"><div id="zonetime"><?php //echo getList("",'startTime','time','Start Time','toPakTime','paktime');?> </div></div> -->
<div id="label">Pakistan Time:</div><div id="field">
<select name="paktime" id="paktime" ><option value=""></option><option value="0" selected="selected">Select  </option><option value="1">00:00</option><option value="2">00:30</option><option value="3">01:00</option><option value="4">01:30</option><option value="5">02:00</option><option value="6">02:30</option><option value="7">03:00</option><option value="8">03:30</option><option value="9">04:00</option><option value="10">04:30</option><option value="11">05:00</option><option value="12">05:30</option><option value="13">06:00</option><option value="14">06:30</option><option value="15">07:00</option><option value="16">07:30</option><option value="17">08:00</option><option value="18">08:30</option><option value="19">09:00</option><option value="20">09:30</option><option value="21">10:00</option><option value="22">10:30</option><option value="23">11:00</option><option value="24">11:30</option><option value="25">12:00</option><option value="26">12:30</option><option value="27">13:00</option><option value="28">13:30</option><option value="29">14:00</option><option value="30">14:30</option><option value="31">15:00</option><option value="32">15:30</option><option value="33">16:00</option><option value="34">16:30</option><option value="35">17:00</option><option value="36">17:30</option><option value="37">18:00</option><option value="38">18:30</option><option value="39">19:00</option><option value="40">19:30</option><option value="41">20:00</option><option value="42">20:30</option><option value="43">21:00</option><option value="44">21:30</option><option value="45">22:00</option><option value="46">22:30</option><option value="47">23:00</option><option value="48">23:30</option></select>
<label>Old Pakistan time:<?php echo stripslashes($row['startTime']); ?> </label>
</div> 
<div id="label">Start Date:</div><div id="field"><input type="text" class="flexy_datepicker_input"  name="startDate"  id="startDate" value="<?php echo stripslashes($row['startDate']); ?>" /></div>
<div id="label">End Date:</div><div id="field"><input type="text" class="flexy_datepicker_input"  name="endDate"  id="endDate" value="<?php echo stripslashes($row['endDate']); ?>" /></div>
<div id="label">Class Duration:</div><div id="field"><select id="slotDuration" name="slotDuration"><option value="0">Select Duration</option><option value="1" <?php if($slot=='1'){?> selected="selected" <?php } ?>>30 Mins</option><option value="2" <?php if($slot=='2'){?> selected="selected" <?php } ?>>60 Mins</option><option value="3" <?php if($slot=='3'){?> selected="selected" <?php } ?>>90 Mins</option></select></div> 
<!--IF SuperAdmin logs in then show getDataList on change, ELSE show simple getDataList-->
<div id="label">Agent:</div><div id="field">
<?php if($_SESSION['userType']==1){ 
echo getDataList_agent_onchange(stripslashes($row['agentId']),'agentId',5);}
else {
echo getDataList(stripslashes($row['agentId']),'agentId',5);}
?> </div> 
<!---->

<div id="label">Course:</div><div id="field"><?php echo getList(stripslashes($row['courseID']),'courseID','course');?> </div>
<div id="label">Class Plan:</div><div id="field"><?php echo getList(stripslashes($row['classType']),'classType','plan','Select Class Type','availableTeacher','availableTeachers');?></div> 
<div id="label">Teacher:</div><div id="field"><div id="availableTeachers"></div>&nbsp;
<input type="hidden"  name="prevteacherID"  id="prevteacherID" value="<?php echo stripslashes($row['teacherID']); ?>" />
<?php echo showUser(stripslashes($row['teacherID']));?> </div>

<div id="label">Signin Date:</div><div id="field"><input type="text" name="duedate" id="duedate" readonly="readonly" value="<?php echo stripslashes($row['duedate']); ?>" /></div>
<div id="label">Paying/Recurring Date:</div><div id="field"><input type="text" name="paydate" id="paydate" readonly="readonly" value="<?php echo stripslashes($row['paydate']); ?>" /></div>
<div id="label">Total Dues:</div><div id="field"><input type="text"  name="dues" id="dues" readonly="readonly" value="<?php echo stripslashes($row['dues']); ?>" /></div>

<div id="label">Reference:</div><div id="field" name=""><?php echo getDataList_reference(stripslashes($row['reference']),'reference','',''); ?> </div>
<div id="label">Zero Paid Reference:</div><div id="field" name=""><?php echo getDataList_reference(stripslashes($row['zeroPaidReferenceId']),'zeroPaidReferenceId','',''); ?> </div>
<!-- SKYPE ID list - Commenting for NOW-->
<!--<div id="label">Skypeid:</div><div id="field"><?php //echo getTableList_skype(stripslashes($row['skypeid']),'skypeid','campus_skype','Skyp ID\'s')?> </div>-->
<div id="label">Skype_TEXT</div><div id="field"><input type="text" name="skypetext" id="skypetext"  value="<?php echo stripslashes($row['skypetext']); ?>" /></div>


<div id="label">Comments For Teacher:</div><div id="field"><textarea name='comments'><?php echo $comments;?></textarea></div>  
 
<div id="label">Comments For Re-Schedule:</div><div id="field"><textarea name='comments_reschedule' class="comments_reschedule" required></textarea></div>  

<div id="label">Comments Submitted(READ ONLY):</div><div id="field"><textarea name='comments_reschedule_readonly' readonly="readonly"><?php echo $comments_reschedule;?></textarea></div> 

<? if($_SESSION['userType']==1) {?>
<div id="label">Management Comm:</div><div id="field" name=""><?php echo getDataList_management_commision(stripslashes($row['management_comm_Id']),'management_comm_Id','1,8,9,15,16',''); ?> </div>
<? } ?>
 
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? } 
include('include/footer.php');?> 
