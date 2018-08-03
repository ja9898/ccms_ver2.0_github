<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) {

$row_sql_ref = mysql_fetch_array(mysql_query("SELECT * FROM campus_students WHERE id='".$_POST['search-student-id2']."'"));

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$startDate=date('y-m-d');
$endDate=date('y-m-d',strtotime($_LIST['courseDuration'][$_POST['courseID']]." months"));
if($_SESSION['userType']=='5'){
$agent_id=$_SESSION['userId'];
}
//Fixing ID in case of EMP SHIFT and USERTYPE
else if($_SESSION['emp_shift']==1 && $_SESSION['userType']!='5')
{
	$agent_id=193;
}
else
{
	$agent_id=192;
}


$stdsta_id = 1;
	if(isset($_POST['stdStatusmoID']))
	{
		$stdsta_id="5";
	}
	if(isset($_POST['stdStatusTestID']))
	{
		$stdsta_id="6";
	}


if(!empty($_POST['teacherID']) && !empty($_POST['search-student-id2']) && !empty($_POST['slotDuration']) && ($_POST['slotDuration']>0) && !empty($_POST['courseID']) && checkSchedule($_POST))
{
 $paktime = $_LIST['time'][$_POST['paktime']];
 $_POST['endTime']=makeTime($paktime,$_POST['slotDuration']);
 $systemdate = systemDate();
 	//Following is to check that same student, same time and same class type MUST NOT be rescheduled
	//with same OR diff teacher
	$check_student="SELECT * FROM campus_schedule 
					WHERE studentID='".$_POST['search-student-id2']."'  
					and startTime<='".$paktime."' and endTime>'".$paktime."' 
					and std_status!=3 and std_status!=4 and status_dead!=1  
					and ".getClassTypeSchedule($_POST['classType']);
	$result_check_student = mysql_query($check_student);
	$rowcount_check_student = mysql_num_rows($result_check_student);
	if($rowcount_check_student>=1)
	{
	getMessages('error_check_student');
	}
	else
	{
 $sql = "INSERT INTO `campus_schedule` (`courseID`, `startTime` ,  `endTime` ,  `startDate` ,  `endDate` ,  `teacherID` ,  `studentID`, `dateBooked` ,  `classType` ,  `status` , `agentId` ,`comments`,`std_status` , `reference`, `skypetext`) VALUES(  '{$_POST['courseID']}', '".$paktime."' ,  '{$_POST['endTime']}' ,  '".prepareDate($_POST['startDate'])."' ,  '".$endDate."' ,  '{$_POST['teacherID']}' ,  '{$_POST['search-student-id2']}'  ,  '".$systemdate."' ,  '{$_POST['classType']}' ,  '{$_POST['status']}' ,  '{$agent_id}','{$_POST['comments']}','{$stdsta_id}' , '".$row_sql_ref['reference']."' , '{$_POST['skypetext']}' ) "; 
mysql_query($sql) or die(mysql_error()); 


 /////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
	$add_schedule="Course:".getData( nl2br( $_POST['courseID']),'course').",Teacher:".showUser( nl2br( $_POST['teacherID'])).",Student:". showStudents(nl2br( $_POST['search-student-id2']))
				.",BKDATE:".date('Y-m-d').",Class Days:".getData(nl2br( $_POST['classType']),'plan').",Status:".getData(nl2br( $stdsta_id),'stdStatusmo-list').",Person:".
				$_SESSION['userName']
				.",SDATE:".prepareDate($_POST['startDate']).",EDATE:".prepareDate($_POST['endDate']).",SUDATE:".prepareDate($_POST['duedate']).",Amount:".nl2br( $_POST['dues'])
				.",Ref:".showUser(nl2br( $row_sql_ref['reference']));
 user_log( $_SERVER['PHP_SELF'] , "ADD_SCHEDULE" , $_SESSION['userId'] ,$add_schedule);
 ///////////////////////////////////////////////////////
getMessages('add');
}
}
else
	{  
		getMessages('error');
	}
}
?>

<form action='' method='POST'>

<div id="label">Student:</div><div id="field_sch_new"><div id="filter"><?php getStudentFilter_new_schedule();?></div> </div> 
<div id="label">Email and Phone:</div><div id="field"><div id="" name="">
		<label  name="EmailPhonediv" id="EmailPhonediv">
        NO VALUE</label>
	</div></div>
<div id="label"></div><div id="field"><a href="#" type='button' value="View Email" class="button" onclick="showemailphone();" >View Email and Phone</a> </div>
<!--<div id="label">Student:</div><div id="field"><?php //echo getDataList($_POST['studentID'],'studentID',4,$_SESSION['userId']);?> </div> -->
<!--<div id="label">Zone:</div><div id="field"><?php //echo getList($_POST['zoneID'],'zoneID','zones','','toZoneTime','zonetime');?> </div> -->
<!--<div id="label">StartTime:</div><div id="field"><div id="zonetime" onchange="javascript: changetextfunction()"><?php //echo getList('','startTime','time','Start Time','toPakTime','paktime');?> </div></div>--> 
<div id="label">Pakistan Time:</div><div id="field">
<?php //echo getList('','paktime','time','','changetextfunction',''); //Working but not in use?>
<select name="paktime" id="paktime" onchange="javascript: changetextfunction()"><option value=""></option><option value="0" selected="selected">Select  </option><option value="1">00:00</option><option value="2">00:30</option><option value="3">01:00</option><option value="4">01:30</option><option value="5">02:00</option><option value="6">02:30</option><option value="7">03:00</option><option value="8">03:30</option><option value="9">04:00</option><option value="10">04:30</option><option value="11">05:00</option><option value="12">05:30</option><option value="13">06:00</option><option value="14">06:30</option><option value="15">07:00</option><option value="16">07:30</option><option value="17">08:00</option><option value="18">08:30</option><option value="19">09:00</option><option value="20">09:30</option><option value="21">10:00</option><option value="22">10:30</option><option value="23">11:00</option><option value="24">11:30</option><option value="25">12:00</option><option value="26">12:30</option><option value="27">13:00</option><option value="28">13:30</option><option value="29">14:00</option><option value="30">14:30</option><option value="31">15:00</option><option value="32">15:30</option><option value="33">16:00</option><option value="34">16:30</option><option value="35">17:00</option><option value="36">17:30</option><option value="37">18:00</option><option value="38">18:30</option><option value="39">19:00</option><option value="40">19:30</option><option value="41">20:00</option><option value="42">20:30</option><option value="43">21:00</option><option value="44">21:30</option><option value="45">22:00</option><option value="46">22:30</option><option value="47">23:00</option><option value="48">23:30</option></select>
</div> 
<div id="label">Start Date:</div><div id="field"><input type="text"  name="startDate"  id="startDate" required value="<?php echo $_POST['startDate']; ?>"  class="flexy_datepicker_input"/></div>
<div id="label">Class Duration:</div><div id="field"><select id="slotDuration" name="slotDuration"><option value="0">Select Duration</option><option value="1">30 Mins</option><option value="2">60 Mins</option><option value="3">90 Mins</option></select></div> 
<div id="label">Course:</div><div id="field"><?php echo getList($_POST['courseID'],'courseID','course');?> </div>
<div id="label">Class Plan:</div><div id="field"><?php echo getList($_POST['classType'],'classType','plan','Select Class Type','availableTeacher','availableTeachers');?></div> 
<div id="label">Teacher:</div><div id="field"><div id="availableTeachers">&nbsp;</div> </div> 
<div id="label">Make Over:</div><div id="field" style="color:red"><?php echo getCheckbox($_POST['stdStatusmoID'],'stdStatusmoID'); ?>(Leave empty for Trial class - Select Make over for Make Over Class)</div>
<div id="label">Test Class:</div><div id="field" style="color:blue"><?php echo getCheckbox($_POST['stdStatusTestID'],'stdStatusTestID'); ?>(Leave empty for Trial class - Select Test for Test Class)</div>
<!-- Adding SKYPE Text here-->
<div id="label">Skype_TEXT</div><div id="field"><input type="text" name="skypetext" id="skypetext"  required /></div>
<div id="label">Comments For Teacher:</div><div id="field"><textarea name='comments' required></textarea></div>  
<div id="label"></div><div id="field"><input type='submit' value='Add Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 

<? include('include/footer.php'); ?>