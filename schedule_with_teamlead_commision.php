<?php 
include('config.php'); 
include('include/header.php');
$id_from_commision = $_GET['id'];

$signup_id_from_commision = $_GET['signup_id'];

//Agent ID from agent_commision_signup.php	//NEWLY ADDED 11-09-14
$id_of_agent_from_agent_comm_signup = $_GET['agentId'];
//////////////////////////////////////////////////////////////////

//Agent ID from agent_commision_signup.php	//NEWLY ADDED 12-09-14
$id_of_management_from_management_comm_signup = $_GET['management_id'];
//////////////////////////////////////////////////////////////////


$fromdate=$_GET['fromdate'];
$todate=$_GET['todate'];

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<?php
getStudentFilter();
getTeacherFilter();
getTeacherFilterLead();
getStartTimeFilter();
getPlanFilter();
getFilterSubmit();
?>
<br><br>
</div>
</form>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";
//echo "<th class='specalt'><b>Days</b></th>";
echo "<th class='specalt'><b>Contact No.</b></th>";

echo "<th class='specalt'><b>Email</b></th>";
echo "<th class='specalt'><b>CHECK Box</b></th>";
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'>Country</th>"; 
echo "<th class='specalt'><b>Start time</b></th>";
echo "<th class='specalt'><b>Start Date</b></th>";
echo "<th class='specalt'><b>Teacher Name</b></th>"; 
echo "<th class='specalt'><b>Student Name</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Team Lead Name</b></th>";  
//echo "<th class='specalt'><b>Team Lead ID</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>"; 
echo "<th class='specalt'><b>Status(Old)</b></th>"; 
echo "<th class='specalt'><b>Status(Current)</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>";
echo "<th class='specalt'><b>Comments</b></th>";

//echo "<th class='specalt' colspan=3><b>Actions</b></th>"; 
echo "</tr>"; 



//Following TEACHER FILTER will work with the classType to send the EMAILS IN BULK
//http://stackoverflow.com/questions/3709560/mysql-join-three-tables // Bridge Table query weblink
if($_POST['search-teacher-id']!=0)	//	-	FOR SuperAdmin	//WITH BRIDGE TABLE   -- SEARCH TEACHER WITH TEAMLEAD
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID,campus_schedule.startDate,campus_schedule.agentId,campus_schedule.comments,
	campus_students.id as s_id,campus_students.email as s_email,campus_students.mobile as s_mobile,campus_students.phone as s_phone,campus_students.landline as s_landline,campus_students.countryID as s_country 
	FROM capmus_users 
	INNER JOIN campus_schedule ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 
	INNER JOIN campus_students ON campus_schedule.studentID=campus_students.id and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.std_status!=4 and campus_schedule.teacherID!=0";
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$result.=" and  ".getClassTypeSchedule($_POST['classType']);
	}
	$result.=" ORDER BY campus_schedule.teacherID ";
	
	//$result = schedule_with_teamlead();
	$result=mysql_query($result);
	teamlead_count_teacher();
}

else if($_POST['search-student-id']!=0)	//	-	FOR SuperAdmin	//WITH BRIDGE TABLE   -- SEARCH STUDENT WITH TEACHER and TEAMLEAD
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID,campus_schedule.startDate,campus_schedule.agentId,campus_schedule.comments,
	campus_students.id as s_id,campus_students.email as s_email,campus_students.mobile as s_mobile,campus_students.phone as s_phone,campus_students.landline as s_landline,campus_students.countryID as s_country 
	FROM capmus_users 
	INNER JOIN campus_schedule ON capmus_users.id=campus_schedule.teacherID and campus_schedule.studentID='".$_POST['search-student-id']."' and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 
	INNER JOIN campus_students ON campus_schedule.studentID='".$_POST['search-student-id']."' and campus_students.id='".$_POST['search-student-id']."' and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 
	ORDER BY campus_schedule.teacherID";
	
	//$result = schedule_with_teamlead();
	$result=mysql_query($result);
	teamlead_count_teacher();
}

//Following TEACHER TEAMLEAD FILTER will work with the startTime and ClassType
else if($_POST['search-teacher-id2']!=0)	//	-	FOR SuperAdmin	//WITH BRIDGE TABLE   -- SEARCH TEACHER WITH TEAMLEAD
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID,campus_schedule.startDate,campus_schedule.agentId,campus_schedule.comments,
	campus_students.id as s_id,campus_students.email as s_email,campus_students.mobile as s_mobile,campus_students.phone as s_phone,campus_students.landline as s_landline,campus_students.countryID as s_country 
	FROM capmus_users 
	INNER JOIN campus_schedule ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 
	INNER JOIN campus_students ON campus_schedule.studentID=campus_students.id and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 ";
	
	if(isset($_POST['startTime']) && !empty($_POST['startTime']))
	{
		$result.= " and campus_schedule.startTime= '".$_LIST['time'][$_POST['startTime']]."'";
	}
	if(isset($_POST['classType']) && !empty($_POST['classType']))
	{
		$result.=" and  ".getClassTypeSchedule($_POST['classType']);
	}
	$result.=" ORDER BY campus_schedule.teacherID ";
	
	//$result = schedule_with_teamlead();
	$result=mysql_query($result);
	teamlead_count_teacher();
}

//The following will work when the ID is sent from COMMISION_RECURRING_SIGNUP.PHP
//FOR RECURRING
else if(isset($id_from_commision))
{
	$ref_query="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID,campus_schedule.startDate,campus_schedule.agentId,campus_schedule.comments,campus_schedule.reference  
	FROM campus_schedule WHERE reference='".$id_from_commision."' 
	and duedate>='".$fromdate."' and duedate<='".$todate."' and status=1";
	$result=mysql_query($ref_query);
}

//The following will work when the ID is sent from COMMISION_RECURRING_SIGNUP.PHP	
//FOR SIGNUP-Trial to Present
else if(isset($signup_id_from_commision))
{
	echo $ref_query="SELECT 
		campus_schedule.id as sch_id,campus_schedule.std_status as sch_status,campus_schedule.std_status_old as sch_status_old,
		campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,campus_schedule.dues as dues,
		campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
		campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
		campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
		FROM campus_schedule 
		INNER JOIN campus_attendance_student ON 
		campus_attendance_student.teacherID='".$signup_id_from_commision."' and 
		campus_schedule.id=campus_attendance_student.schedule_id and 
		campus_attendance_student.std_status=1 and campus_attendance_student.status=1 and 
		campus_schedule.status=1 and 
		campus_schedule.teacherID!=0  
		and duedate>='".$fromdate."' and duedate<='".$todate."' ";
		/*
		echo $ref_query="SELECT 
		campus_schedule.id as sch_id,campus_schedule.std_status as sch_status,campus_schedule.std_status_old as sch_status_old,
		campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,campus_schedule.dues as dues,
		campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
		campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
		campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
		FROM campus_schedule 
		INNER JOIN campus_attendance_student ON 
		campus_attendance_student.teacherID='".$signup_id_from_commision."' and 
		campus_schedule.id=campus_attendance_student.schedule_id and 
		campus_schedule.std_status_old=1 and campus_attendance_student.std_status=1 and campus_attendance_student.status=1 and 
		campus_schedule.status=1 and campus_schedule.status_dead=0 and 
		campus_schedule.teacherID!=0 and campus_schedule.std_status=2  
		and duedate>='".$fromdate."' and duedate<='".$todate."' ";
		*/
	$result=mysql_query($ref_query);
}

//The following will work when the ID is sent from AGENT_COMMISION_SIGNUP.PHP
else if(isset($id_of_agent_from_agent_comm_signup))
{
	$ref_query="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID,campus_schedule.startDate,campus_schedule.agentId,campus_schedule.comments,campus_schedule.reference  
	FROM campus_schedule WHERE agentId='".$id_of_agent_from_agent_comm_signup."' 
	and duedate>='".$fromdate."' and duedate<='".$todate."' and status=1";
	$result=mysql_query($ref_query);
}

//The following will work when the ID is sent from MANAGEMENT_COMMISION_SIGNUP.PHP
else if(isset($id_of_management_from_management_comm_signup))
{
	$ref_query="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID,campus_schedule.startDate,campus_schedule.agentId,campus_schedule.comments,campus_schedule.reference  
	FROM campus_schedule WHERE management_comm_Id='".$id_of_management_from_management_comm_signup."' 
	and duedate>='".$fromdate."' and duedate<='".$todate."' and status=1";
	$result=mysql_query($ref_query);
}

else	//	-	FOR SuperAdmin	//WITH BRIDGE TABLE
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID,campus_schedule.startDate,campus_schedule.agentId,campus_schedule.comments,
	campus_students.id as s_id,campus_students.email as s_email,campus_students.mobile as s_mobile,campus_students.phone as s_phone,campus_students.landline as s_landline,campus_students.countryID as s_country 
	FROM capmus_users 
	INNER JOIN campus_schedule ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 
	INNER JOIN campus_students ON campus_schedule.studentID=campus_students.id and campus_schedule.status=1 and status_dead=0 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 
	ORDER BY campus_schedule.teacherID";
	//campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID 
	//FROM capmus_users 
	//INNER JOIN campus_schedule 
	//ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and campus_schedule.status=1 and campus_schedule.std_status!=3 and campus_schedule.teacherID!=0";
	$result=mysql_query($result);
	teamlead_count_teacher();
}

while($row = mysql_fetch_array($result)){ 
$sum=$row['dues'];
$sum_dues[$row['sch_id']]=$sum;
//Array for EMAILS
$email=$row['s_email'];
$emails[$row['sch_id']]=$email;
//foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
if($row['std_status']==4)
{
	echo "<tr style='font-weight:bold'>";
	echo "<td valign='top'>" . nl2br( $row['sch_id']) . "</td>";
	echo "<td valign='top'>";
	if(!empty($row['s_phone'])){

	echo "[" . nl2br( $row['s_phone'] )."]";
	}
	if(!empty($row['s_mobile'])){
	echo " <br>[".nl2br( $row['s_mobile'] )."]";
	}
	if(!empty($$rows['s_landline'])){
	echo "<br>[".nl2br( $row['s_landline'] ) . "]";
	}
	echo "</td>";  
	//echo "<td valign='top'>" . nl2br( $row['duedays']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['s_email']) . "</td>"; 
	echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['s_country']),'country'). "</td>";   
	echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['firstName']) . " " . nl2br( $row['lastName']) . "</td>";  
	echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>"; 
	echo "<td valign='top'>" .showUser( nl2br( $row['agentId'])) . "</td>"; 
	echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>"; 
	//echo "<td valign='top'>" . nl2br( $row['LeadId']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['std_status_old']),'stdStatusmo-list') . "</td>"; 
	echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 
	echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['comments']) . "</td>";
	//echo "<td valign='top'>" . nl2br( $row['s_email']) . "</td>"; 
	echo "</tr>"; 
}
else
{
	echo "<tr>";
	echo "<td valign='top'>" . nl2br( $row['sch_id']) . "</td>";
	echo "<td valign='top'>";
	if(!empty($row['s_phone'])){

	echo "[" . nl2br( $row['s_phone'] )."]";
	}
	if(!empty($row['s_mobile'])){
	echo " <br>[".nl2br( $row['s_mobile'] )."]";
	}
	if(!empty($$rows['s_landline'])){
	echo "<br>[".nl2br( $row['s_landline'] ) . "]";
	}
	echo "</td>";  
	//echo "<td valign='top'><a onclick=\"return confirm('Are you sure you want to SEND EMAIL to this Record?')\" class=button href=#?id={$row['id']}>Delete</a></td>";
	if($_SESSION['userType']==1)	//This IF is to show LETTER columns to SUPERADMIN
	{
	?>
	
	<?
	}
	//echo "<td valign='top'>" . nl2br( $row['duedays']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['s_email']) . "</td>"; 
	echo "<td valign='top'>" . getCheckbox_email_select( $_POST[$row['studentID']],$row['studentID'],'email_select[]') . "</td>"; 
	echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['s_country']),'country'). "</td>";   
	echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['firstName']) . " " . nl2br( $row['lastName']) . "</td>";  
	echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>"; 
	echo "<td valign='top'>" .showUser( nl2br( $row['agentId'])) . "</td>"; 
	echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>"; 
	//echo "<td valign='top'>" . nl2br( $row['LeadId']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['std_status_old']),'stdStatusmo-list') . "</td>"; 
	echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 
	echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['comments']) . "</td>";
	echo "</tr>"; 	
	$teacher_name = nl2br( $row['firstName']) . " " . nl2br( $row['lastName']);
}
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
echo "<td valign='top'>Sum </td>";  
  
echo "<td valign='top'><b>$" . array_sum($sum_dues)  . "</td>";  
echo "<td valign='top'></td>";

 
echo "</table>";  
?>

<?php include('include/footer.php');?>