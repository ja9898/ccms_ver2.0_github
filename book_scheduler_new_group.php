<? 
include('config.php'); 
include('include/header.php');
//NICE STACKOVERFLOW LINKS FOR TIMEZONE IN PHP
//	1)http://stackoverflow.com/questions/2329467/how-do-i-get-the-local-system-time-in-php	BEST LINK
//	2)http://stackoverflow.com/questions/5610665/php-default-timezone
//	3)http://php.net/manual/en/function.strtotime.php		//strtotime				

//$time_in_24_hour_format  = DATE("H:i", STRTOTIME("1:30 pm"));
//echo $time_in_24_hour_format;
//echo "<br>";
/*echo $current_time = date("H:i");



//CHECKING PAKISTAN TIME MUST BE BETWEEN 21:00 and 07:00		working fine(Also make a condition for morning scheduling)
if (isset($_POST['submitted'])) {
	if($current_time>='21:00' || $current_time<='07:00')
	{
		if($_POST['startTime']>='21:00' || $_POST['startTime']<='07:00')
		{
			echo "<script>alert('Successful :  Selected time is in Range')</script>";
		}
		else
		{
			echo "<script>alert('UnSuccessful :  Selected time OUT OF RANGE')</script>";
		}
	}
	else
	echo "<script>alert('Day time')</script>";
}
else
{
echo "<script>alert('Not Submitted')</script>";
}*/



//Restricting access for everyone except SUPERADMINS(Junaid and faheem)
if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userId']==48 || $_SESSION['userId']==195 || $_SESSION['userId']==2015)
{

if (isset($_POST['submitted'])) {

//CHECKING DUPLICATE SCHEDULE and AVOIDANCE		working fine
/*echo $duplicate_schedule1 = "SELECT * 
FROM campus_schedule WHERE 
(startTime='".$_POST['startTime']."' and teacherID='".$_POST['teacherID']."' and studentID='".$_POST['search-student-id2']."' and ".getClassTypeSchedule($_POST['classType']).") OR 
(startTime='".$_POST['startTime']."' and teacherID='".$_POST['teacherID']."' and ".getClassTypeSchedule($_POST['classType']).") OR 
(startTime='".$_POST['startTime']."' and studentID='".$_POST['search-student-id2']."' and ".getClassTypeSchedule($_POST['classType']).")";
$duplicate_schedule_result1 = mysql_query($duplicate_schedule1);

//$duplicate_schedule2 = "SELECT * FROM campus_schedule WHERE startTime='".$_POST['startTime']."' and teacherID='".$_POST['teacherID']."' and classType='".$_POST['classType']."'";
//$duplicate_schedule_result2 = mysql_query($duplicate_schedule2);

//$duplicate_schedule3 = "SELECT * FROM campus_schedule WHERE startTime='".$_POST['startTime']."' and studentID='".$_POST['studentID']."' and classType='".$_POST['classType']."'";
//$duplicate_schedule_result3 = mysql_query($duplicate_schedule3);


if(mysql_num_rows($duplicate_schedule_result1) >= 1)
{
	
	echo "<script>alert('Schedule Duplication Found - UNSUCCESSFUL')</script>";
	//while($rowcount=mysql_fetch_array($duplicate_schedule_result1))
	//{
	//	echo "<td valign='top'>" . showStudents(nl2br( $rowcount['studentID'])) . " has multiple schedules</td>";
	//}
	getMessages('error');
}
else
{
echo "<script>alert('NO DUPLICATION - SUCCESSFUL')</script>";


//echo $duplicate_schedule_result1."<br>";
//echo mysql_num_rows($duplicate_schedule_result1)."<br><br><br><br>";

//echo $duplicate_schedule_result2."<br>";
//echo mysql_num_rows($duplicate_schedule_result2)."<br><br><br><br>";

//echo $duplicate_schedule_result3."<br>";
//echo mysql_num_rows($duplicate_schedule_result3)."<br><br><br><br>";

//echo $_POST['startTime']."<br>";
//echo $_POST['teacherID']."<br>";
//echo $_POST['search-student-id2']."<br>";
//echo $_POST['classType']."<br>";
//echo getClassTypeSchedule($_POST['classType']);*/



foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$startDate=date('y-m-d');
$endDate=date('y-m-d',strtotime($_LIST['courseDuration'][$_POST['courseID']]." months"));
if($_SESSION['userType']=='5' or $_SESSION['userType']=='9'){
$agent_id=$_SESSION['userId'];
}
else
{
	$agent_id=0;
}


$stdsta_id = 1;

	if(isset($_POST['stdStatusmoID']))
	{
		$stdsta_id="5";
	}


if(!empty($_POST['teacherID']) && !empty($_POST['search-student-id2']) && !empty($_POST['slotDuration']) && ($_POST['slotDuration']>0) && !empty($_POST['courseID']) && !empty($_POST['group_value']))
{
 $_POST['endTime']=makeTime($_POST['startTime'],$_POST['slotDuration']);
 $sql = "INSERT INTO `campus_schedule` (`courseID`, `startTime` ,  `endTime` ,  `startDate` ,  `endDate` ,  `teacherID` ,  `studentID`, `dateBooked` ,  `classType` ,  `status` , `agentId` ,`comments`,`std_status` ) VALUES(  '{$_POST['courseID']}','{$_POST['startTime']}' ,  '{$_POST['endTime']}' ,  '".prepareDate($_POST['startDate'])."' ,  '".$endDate."' ,  '{$_POST['teacherID']}' ,  '{$_POST['search-student-id2']}'  ,  '".date('Y-m-d')."' ,  '{$_POST['classType']}' ,  '{$_POST['status']}' ,  '{$agent_id}','{$_POST['comments']}','{$stdsta_id}' ) "; 
mysql_query($sql) or die(mysql_error()); 


 /////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
 //echo getData( nl2br( $_POST['courseID']),'courseID')."<br>";
 // echo $add_user="'{$_POST['courseID']}', '{$_POST['teacherID']}' ,  '{$_POST['studentID']}' ,  '{$_POST['classType']}' ,  '{$_POST['status']}' ,  '{$agent_id}','{$_POST['comments']}','{$stdsta_id}'";
 //$get_last_record=("SELECT    * 
//FROM      campus_schedule 
//ORDER BY  id DESC 
//LIMIT     1;");
//$result = mysql_query($get_last_record) or trigger_error(mysql_error()); 
//while($row = mysql_fetch_array($result)){ 
	//$id,$courseID,$teacherID ,$studentID,$dateBooked , $classType , $status ,$agentId ,$comments,$std_status;
	$add_schedule="Course:".getData( nl2br( $_POST['courseID']),'course').",Teacher:".showUser( nl2br( $_POST['teacherID'])).",Student:". showStudents(nl2br( $_POST['search-student-id2']))
				.",BKDATE:".date('Y-m-d').",Class Days:".getData(nl2br( $_POST['classType']),'plan').",Status:".getData(nl2br( $stdsta_id),'stdStatusmo-list').",Person:".
				$_SESSION['userName']
				.",SDATE:".prepareDate($_POST['startDate']).",EDATE:".prepareDate($_POST['endDate']).",SUDATE:".prepareDate($_POST['duedate']).",Amount:".nl2br( $_POST['dues']);
//}
 //echo $add_schedule;
 user_log( $_SERVER['PHP_SELF'] , "ADD_SCHEDULE_GROUP" , $_SESSION['userId'] ,$add_schedule);
 ///////////////////////////////////////////////////////

 
getMessages('add');
}
else
{  
getMessages('error');
}
//}//END OF PAKISTAN TIME CHECK 
//else
//{
//echo "<script>alert('Successful :  Selected time OUT OF RANGE')</script>";
//}

}
?>

<form action='' method='POST'>

<div id="label">Student:</div><div id="field_sch_new"><div id="filter"><?php getStudentFilter_new_schedule();?></div> </div> 

<!--<div id="label">Student:</div><div id="field"><?php //echo getDataList($_POST['studentID'],'studentID',4,$_SESSION['userId']);?> </div> -->
<div id="label">Zone:</div><div id="field"><?php echo getList($_POST['zoneID'],'zoneID','zones','','toZoneTime','zonetime');?> </div> 

<div id="label">StartTime:</div><div id="field"><div id="zonetime" onchange="javascript: changetextfunction()"><?php echo getList('','startTime','time','Start Time','toPakTime','paktime');?> </div></div> 
<div id="label">Pakistan Time:</div><div id="field"><input type="text"  name="startTime" readonly="readonly" id="paktime" required value="<?php echo $_POST['startTime']; ?>" /></div> 
<div id="label">Start Date:</div><div id="field"><input type="text"  name="startDate"  id="startDate" required value="<?php echo $_POST['startDate']; ?>"  class="flexy_datepicker_input"/></div>
<div id="label">Class Duration:</div><div id="field"><select id="slotDuration" name="slotDuration"><option value="0">Select Duration</option><option value="1">30 Mins</option><option value="2">60 Mins</option><option value="3">90 Mins</option></select></div> 
<div id="label">Course:</div><div id="field"><?php echo getList($_POST['courseID'],'courseID','course');?> </div>
<div id="label">Class Plan:</div><div id="field"><?php echo getList($_POST['classType'],'classType','plan','Select Class Type','availableTeacherGROUP','availableTeachersGROUP');?></div> 
<div id="label">Teacher:</div><div id="field"><div id="availableTeachersGROUP">&nbsp;</div> </div> 
<!--<div id="label">Make Over:</div><div id="field" style="color:red"><?php //echo getCheckbox($_POST['stdStatusmoID'],'stdStatusmoID'); ?>(Leave empty for Trial class - Select Make over for Make Over Class)</div>-->
<!-- Following GROUP checkbox has been added for schedules overlapping, special requirement for GROUP CLASSES -->
<div id="label">Group:</div><div id="field" style="color:green"><?php echo getCheckbox($_POST['group_value'],'group_value'); ?>(Check the box for GROUP CLASS)</div>
<div id="label">Comments For Teacher:</div><div id="field"><textarea name='comments' required></textarea></div>  
 
<div id="label"></div><div id="field"><input type='submit' value='Add Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 

<? 
}
else
{
echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}
include('include/footer.php'); ?>