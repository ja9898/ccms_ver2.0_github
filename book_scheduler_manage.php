<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 

getStudentFilter();
getTeacherFilter();
getAgentFilter();
getStartTimeFilter();
if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==15)
{
// class amt_start_range is used NOT to enter the CHARACTERS in the textbox using jquery
echo getInput_number('','start_range','amt_start_range','Amt Start Range');
?>&nbsp;&nbsp;&nbsp;<?
// class amt_end_range is used NOT to enter the CHARACTERS in the textbox using jquery
echo getInput_number('','end_range','amt_end_range','Amt End Range');
} ?></div>
<div style="float:left">
<?php
getPlanFilter();
getShiftFilter();
getCourseFilter();
getStatusFilter_with_makeover();
getFilterSubmit();
//echo "<label style='color:red; font-weight:bold'>NOTE: Don't consider ABSENT ALERT for MAKE OVER classes - <u>Take the Load</u></label>";
?></div>
<br>
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>ID</b></th>";  
//echo "<th class='specalt'><b>Contact No.</b></th>"; 
echo "<th class='specalt'><b>Ext ID OLD</b></th>";
echo "<th class='specalt'><b>Extension ID</b></th>"; 
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'>Country</th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
//echo "<th class='specalt'><b>Absent Alert</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>";
echo "<th class='specalt'><b>Priority</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>"; 
//echo "<th class='specalt'><b>Dues - USD</b></th>"; 
echo "<th class='specalt'><b>Dues - Original</b></th>"; 
//echo "<th class='specalt'><b>Currency</b></th>"; 
//echo "<th class='specalt'><b>Currency Value</b></th>"; 
echo "<th class='specalt'><b>Skype ID</b></th>"; 
echo "<th class='specalt'><b>USERNAME</b></th>"; 
echo "<th class='specalt'><b>PASSWORD</b></th>"; 
echo "<th class='specalt'><b>Parent</b></th>"; 
echo "<th class='specalt'><b>Zero Reference</b></th>"; 
echo "<th class='specalt'><b>Grade</b></th>"; 
echo "<th class='specalt'><b>Syllabus</b></th>";
echo "<th class='specalt'><b>Recording link</b></th>"; 
echo "<th class='specalt' colspan=9><b>Actions</b></th>"; 
//
echo "<th class='specalt'><b>Actual / SignUp Amount</b></th>";
echo "<th class='specalt'><b>Invoice / Original Amount</b></th>";
echo "<th class='specalt'><b>Total Received</b></th>";
echo "<th class='specalt'><b>Fee</b></th>";
echo "<th class='specalt'><b>Discount</b></th>";
echo "<th class='specalt'><b>Actual / SignUp Amount USD</b></th>";
echo "<th class='specalt'><b>Invoice / Original Amount USD</b></th>";
echo "<th class='specalt'><b>Total Received USD</b></th>";
echo "<th class='specalt'><b>Fee USD</b></th>";
echo "<th class='specalt'><b>Discount USD</b></th>";
//
echo "<th class='specalt'><b>Status</b></th>";
//echo "<th class='specalt'><b>Accept</b></th>";
//echo "<th class='specalt'><b>Reject</b></th>"; 
echo "<th class='specalt'><b>Accept/Reject ACTION BY</b></th>"; 
echo "</tr>"; 
if($_SESSION['userType']==5 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ) )
{
	$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and campus_schedule.std_status!='4'  and campus_schedule.std_status!='7' and status_freeze=0 and status_dead=0 and status_transfertolhr=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues'); 
}


//MANAGE SCHEDULE AND FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher();
}

else if($_SESSION['userType']==9 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_agent();
}

else if($_SESSION['userType']==13)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_quran_readonly();
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==15 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher_main();
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==16 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_agent_main();
}

//	NEWLY ADDED - QC Permissions 03-07-18
else if($_SESSION['userType']==18 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	$result = getResultResource_qc();
}

//SHOWING ALL THE TRIALS< REGULARS AND MAKEOVERS IN MANAGE SCHEDULE
else if(   ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 )  ){
//$_SESSION['userType']!=5 && $_SESSION['userType']!=8 && $_SESSION['userType']!=9 && $_SESSION['userType']!=15 &&
//$_SESSION['userType']!=16
	//$result = getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status!="3" and status_dead=0',"",",campus_students.firstName as name,campus_students.std_status as std_status",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id ","order by startTime asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues,campus_schedule.id');
	$result = getResultResource_superadmin();
	
	}
else
{
	echo "<br>";echo "<br>";echo "<br>";echo "<br>";
	echo "<div  style='color:red; font-size:16px; position:relative;'>Apply proper filters</div>";
}

//One month range for ABSENT ALERT	
$curr_systemdate = mysql_real_escape_string($_LIST['systemdate']);
$sub_date = mysql_real_escape_string(date('Y-m-d', strtotime(nl2br( $curr_systemdate). ' - 30 days')));	
//Adding this for PRIORITY
$systemdate = systemDate();
//Get 1 USA/CAD/AUS/GBP/NZD/SGD to usd rate from db
$sql_original_currency="SELECT * FROM campus_currency WHERE id = 473";
$row_original_currency = mysql_fetch_array(mysql_query($sql_original_currency));
//Arrays for the Amount sum
$cad_amt=array();
$usd_amt=array();

$rowcount = mysql_num_rows($result);	
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rowcount." &nbsp;&nbsp;&nbsp;</div><br></b>";
while($row = mysql_fetch_array($result)){ 
$query="select `campus_students`.id as stu_id , `campus_students`.extId_old ,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline, `campus_students`.username , `campus_students`.password , `campus_students`.parentId ,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
////////////////////////////
//REALLY IMPORTANT LINK
//http://stackoverflow.com/questions/14192205/count-number-of-items-in-a-row-in-mysql

//*******Following query is to count REGULAR students that are more than 3 time ABSENT in campus_attendance_student.php
//*******USED WITHIN MANAGE SCHEDULE query
//NOTE: Commenting on Mr.Shehzad request 21-11-2013
/*$new_sql = "SELECT campus_attendance_student.id,campus_attendance_student.studentID as c_a_s_stdID,
campus_attendance_student.teacherID,campus_attendance_student.classStartTime,campus_attendance_student.startTime,
campus_attendance_student.date,campus_attendance_student.std_status,
SUM(campus_attendance_student.status = 0) as sta,campus_attendance_student.comments,campus_attendance_student.lessonDetails 
FROM  campus_attendance_student 
WHERE campus_attendance_student.studentID='".$row['studentID']."' and 
	campus_attendance_student.status = 0 and 
	date BETWEEN '".$sub_date."' AND '".$curr_systemdate."' and 
	campus_attendance_student.std_status=2 
	GROUP BY campus_attendance_student.studentID";
$new_sql_result = mysql_query($new_sql);
$new_sql_result_rows = mysql_fetch_array($new_sql_result);*/
////////////////////////////
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
if($_SESSION['userType']==8 || $_SESSION['userType']==15 || $_SESSION['userType']==18)
{
	echo "<td valign='top'>" .nl2br($row['sch_id']). "</td>";
	$usd_amt[$row['sch_id']] = $row['dues'];
	//$usd_amt[$row['sch_id']] = $row['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
}
else
{
	echo "<td valign='top'>" .nl2br($row['id']). "</td>";
	$usd_amt[$row['id']] = $row['dues'];
	//$usd_amt[$row['id']] = $row['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
}

if($_SESSION['userType']!=12 && $_SESSION['userType']!=13)
{
	/*echo "<td valign='top'>";
	if(!empty($rows['phone'])){

	echo "[" . nl2br( $rows['phone'] )."]";
	}
	if(!empty($rows['mobile'])){
	echo " <br>[".nl2br( $$rows['mobile'] )."]";
	}
	if(!empty($$rows['landline'])){
	echo "<br>[".nl2br( $rows['landline'] ) . "]";
	}
	echo "</td>";*/
}
else
{
	//echo "<td valign='top'>N/A</td>";
}
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".$rows['extId_old']."' target=_blank >" . $rows['extId_old'] . "</a></td>";
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $rows['stu_id']))."' target=_blank >" . getextID(nl2br( $rows['stu_id'])) . "</a></td>";
//echo "<td valign='top'>" . nl2br( $row['users_id']) . "</td>";  

$days = (strtotime($systemdate) - strtotime(nl2br( $row['duedate']))) / (60 * 60 * 24);

echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $rows['countryID']),'country'). "</td>";   
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>";  
//BEST EXAMPLE TO JOIN 2 TABLES FOR UPDATING THE RECORD IN THE OTHER TABLE WHICH HAS THE PRIMARY KEY
//http://stackoverflow.com/questions/9957171/how-to-join-two-tables-in-an-update-statement
//http://stackoverflow.com/questions/4840833/mysql-add-12-hours-to-a-time-field
//Following condition of startDate is added so that schedule with startDate less than systemDate must be shown
if($row['startDate']>$systemdate && $_SESSION['userType']==8)
{
	echo "<td valign='top' style='color:RED; font-weight:bold'>Schedule will be activated after the given date - " . nl2br( $row['startDate']) . "</td>";
}
else
{
	echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";
}
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  

//NOTE: Commenting on Mr.Shehzad request 21-11-2013
/*echo "<td valign='top'>" . nl2br( $new_sql_result_rows['c_a_s_stdID']) . "</td>";*/
/*if(nl2br( $new_sql_result_rows['sta'])>3)
{
echo "<td valign='top' style='color:red; font-weight:bold'>" . "<a href=class_details.php?id={$row['studentID']} style='color:red; font-weight:bold'>" . showStudents_class_details(nl2br( $new_sql_result_rows['c_a_s_stdID'])) . "</a></td>";  
}
else
{
echo "<td valign='top' style='color:green; font-weight:bold'>". "<a href=class_details.php?id={$row['studentID']} style='color:green; font-weight:bold'>" . showStudents_class_details(nl2br( $new_sql_result_rows['c_a_s_stdID'])) . "</a></td>";  
}*/

echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" .showUser( nl2br( $row['teacherID'])) . "</td>"; 
echo "<td valign='top'>" .getData(nl2br( $row['statussch']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";  
if($days>=16)
{
	echo "<td valign='top'>Normal</td>";
}
else
{
	echo "<td valign='top' style='color:red; font-weight:bold'>Special</td>";
}  
echo "<td valign='top'>" . showUser( nl2br( $row['agentId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>"; 
echo "<td valign='top'>" . $row['dues_original'] . "</td>";
if($_SESSION['userType']==2)
{
	echo "<td valign='top'>NA</td>";
	echo "<td valign='top'>NA</td>";
	echo "<td valign='top'>NA</td>";
	echo "<td valign='top'>NA</td>";
}
else
{
	echo "<td valign='top'>" . nl2br( $row['skypetext']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $rows['username']) . "</td>";
	echo "<td valign='top'>" . nl2br( $rows['password']) . "</td>";
	echo "<td valign='top'>" . getparentname(nl2br( $rows['parentId'])) . "</td>";
	if($row['zeroPaidReferenceId']!=0){
	echo "<td valign='top' style='color:blue'><b>" . showUser(nl2br( $row['zeroPaidReferenceId'])) . "</b></td>"; 
	}else{
	echo "<td valign='top'></td>";
	} 	
	echo "<td valign='top'>" . nl2br( $row['grade']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['syllabus']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['record_link']) . "</td>";	
}
if($_SESSION['userType']==8 || $_SESSION['userType']==15 || $_SESSION['userType']==18)
{
		echo "<td valign='top'><a class=button href=student_attandance_manual_absent.php?id={$row['sch_id']}>Mark Absent</a></td>";
		echo "<td valign='top'><a class=button target='_blank' href=book_scheduler_comments_general.php?id={$row['sch_id']}>Comments</a></td>";
		echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['sch_id']}>Edit</a></td>
		<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead_message.php?id={$row['sch_id']}>Dead</a></td>";
		//if($_SESSION['userId']==625 || $_SESSION['userId']==221){
			echo "<td valign='top'><a class=button href=book_scheduler_freeze.php?id={$row['sch_id']}&student_id={$row['studentID']}>Freeze</a></td>";
		//}
		if($row['statussch']=='1')
		{
		echo "<td><a  class=button href=make_regular_ver2.php?id={$row['studentID']}&schedule={$row['sch_id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&agentId={$row['agentId']}&startTime={$row['startTime']}>Make Regular</a></td> ";
		}
		echo "<td valign='top'><a class=button target='_blank' href=book_scheduler_edit_grade_syllabus.php?id={$row['sch_id']}>Edit GR-SY</a></td>";
}

else if($_SESSION['userType']==10 || $_SESSION['userType']==9 || $_SESSION['userType']==16)
{
		echo "<td valign='top'><a class=button target='_blank' href=book_scheduler_comments_general.php?id={$row['id']}>Comments</a></td>";
		echo "<td valign='top'><a class=button href=book_scheduler_edit_ATL_trial_only.php?id={$row['id']}&status={$row['statussch']}>Edit</a></td>
		<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead_message.php?id={$row['id']}>Dead</a></td>";
		if($row['statussch']=='1')
		{
		echo "<td><a  class=button href=make_regular_ver2.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&agentId={$row['agentId']}&startTime={$row['startTime']}>Make Regular</a></td> ";
		}
}

else
{
	echo "<td><a onclick=\"return confirm('Are you sure you want to mark this record as MAKEOVER - It might duplciate?')\" class=button href=book_scheduler_makeover_class.php?id={$row['id']}>MakeOver DUP</a></td>";
	echo "<td valign='top'><a class=button href=student_attandance_manual_absent.php?id={$row['id']}>Mark Absent</a></td>";
	echo "<td valign='top'><a class=button target='_blank' href=book_scheduler_comments_general.php?id={$row['id']}>Comments</a></td>";	
	//For ICC Agent so that he/she can RESHCHEDULE the Trial only********************************Remove later
	if($_SESSION['userId']==609)
	{
		echo "<td valign='top'><a class=button href=book_scheduler_edit_ATL_trial_only.php?id={$row['id']}&status={$row['statussch']}>Edit</a></td></td>";
	}
	else{
		echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['id']}>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=book_scheduler_delete.php?id={$row['id']}>Delete</a></td>";
	}
	///////////////////////////////////////////////////////////************************************
	
	if($_SESSION['userId']==195 && $row['statussch']!='2')
	{
		echo "<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead.php?id={$row['id']}&studentID={$row['studentID']}&std_status={$row['statussch']}>Dead</a></td>";
	}
	else if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userId']==60 || $_SESSION['userId']==195)
	{
		echo "<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead.php?id={$row['id']}&studentID={$row['studentID']}&std_status={$row['statussch']}>Dead</a></td>";		
	}
	else if($_SESSION['userId']==411 || $_SESSION['userId']==126)
	{
		echo "<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead_message.php?id={$row['id']}>Dead</a></td>";
	}
	else
	{
		echo "<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=#>N/A</a></td>";
	}
	if($row['statussch']=='1')
	{
		echo "<td valign='top'><a class=button >N/A</a></td>";
	}
	else
	{
		if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227 || $_SESSION['userId']==411 || $_SESSION['userId']==195 || $_SESSION['userId']==126)
		{
			echo "<td valign='top'><a class=button href=book_scheduler_freeze.php?id={$row['id']}&student_id={$row['studentID']}>Freeze</a></td>";
			echo "<td valign='top'><a class=button href=book_scheduler_transfertolhr.php?id={$row['id']}>Transfer TO LHR</a></td>";
			echo "<td valign='top'><a class=button target='_blank' href=book_scheduler_edit_grade_syllabus.php?id={$row['id']}>Edit GR-SY</a></td>";
		}
		else
		{
			echo "<td><a class=button href=#>N/A</a></td>";
		}
	}
	if($row['statussch']=='1')
	{
		echo "<td><a  class=button href=make_regular_ver2.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&agentId={$row['agentId']}&startTime={$row['startTime']}>Make Regular</a></td> ";
	} 
	if($row['statussch']=='2'){
	
	echo "<td valign='top'>" . $row['dues_amountDefaultNew'] . "</td>";
	echo "<td valign='top'>" . $row['dues_amountOriginalNew'] . "</td>";
	echo "<td valign='top'>" . $row['dues_totalReceivedNew'] . "</td>";
	echo "<td valign='top'>" . $row['dues_feeDeductNew'] . "</td>";
	echo "<td valign='top'>" . $row['dues_discountNew'] . "</td>";
	
	echo "<td valign='top'>" . $row['dues_amountDefaultNew_Usd'] . "</td>";
	echo "<td valign='top'>" . $row['dues_amountOriginalNew_Usd'] . "</td>";
	echo "<td valign='top'>" . $row['dues_totalReceivedNew_Usd'] . "</td>";
	echo "<td valign='top'>" . $row['dues_feeDeductNew_Usd'] . "</td>";
	echo "<td valign='top'>" . $row['dues_discountNew_Usd'] . "</td>";
	if($row['statusPendRejAccpt']==1){
	echo "<td valign='top' style='color:green; font-weight:bold'>" . getData(nl2br( $row['statusPendRejAccpt']),'statusPendRejAccptAry'). "</td>";
	}
	else if($row['statusPendRejAccpt']==2){
	echo "<td valign='top' style='color:red; font-weight:bold'>" . getData(nl2br( $row['statusPendRejAccpt']),'statusPendRejAccptAry'). "</td>";	
	}
	else{
	echo "<td valign='top'>" . getData(nl2br( $row['statusPendRejAccpt']),'statusPendRejAccptAry'). "</td>";	
	}
	//echo "<td ><a class=button href=transaction_new_ver2_approve.php?id={$row['id']} target='_blank'>Accept</a></td> ";
	//echo "<td ><a class=button href=transaction_new_ver2_reject.php?id={$row['id']} target='_blank'>Reject</a></td>";
	echo "<td valign='top'>" . 	showUser( nl2br( $row['statusPendRejAccpt_User'])). "</td>";
	}
}
echo "</tr>"; 
}
echo "<tr>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'>Sum </td>";  
	echo "<td valign='top'><b>$" . nl2br( array_sum($usd_amt)) . "</td>"; 
echo "</tr>"; 
echo "</table>"; 
echo "<a href=book_scheduler_new.php class=button>New Row</a>"; 
include('include/footer.php');
?>