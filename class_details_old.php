<? 
include('config.php'); 
include('include/header.php'); 
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
getStudentFilter();
getTeacherFilter();
getStartTimeFilter();
getClassStatusFilter();

getTeacherFilterLead();

?>
&nbsp;&nbsp;
<div id="time">
<?php
echo getInput(stripslashes($_POST['date']),'date','class=flexy_datepicker_input');
?>
</div>
<?php 
getFilterSubmit();

//NEWLY ADDED on 17-05-2014
echo "<br><br><br>";
echo "<label style='color:red; font-weight:bold'>Check the box to activate Teacher Teamlead filter</label>";
echo getCheckbox($_POST['ttl_check'],'ttl_check');
?>
</form>
</div>
<? echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Id</th>"; 
echo "<th class='specalt'>Sch Id</th>"; 
echo "<th class='specalt'>StudentID</th>"; 
echo "<th class='specalt'>TeacherID</th>"; 
echo "<th class='specalt'>LeadID</th>"; 
echo "<th class='specalt'>StartTime</th>"; 
echo "<th class='specalt'>ClassStartTime</th>"; 
echo "<th class='specalt'>ClassEndTime</th>"; 
echo "<th class='specalt'>Class Duration</th>"; 
echo "<th class='specalt'>Date</th>"; 
echo "<th class='specalt'>Class Status(T-R-M-TEST)</th>"; 
echo "<th class='specalt'>Status</th>"; 
echo "<th class='specalt'>Comments</th>"; 
echo "<th class='specalt'>LessonDetails</th>"; 
//Download link for the IMAGE OF TEACHER's LAST LECTURE
echo "<th class='specalt'><b>Download file</b></th>"; 


echo "</tr>"; 
//$result = mysql_query("SELECT * FROM `campus_attendance_student_old`") or trigger_error(mysql_error()); 
if(isset($_GET['id'])){
	
	$_POST['search-student-id']=$_GET['id'];
	$_POST['search-submit']='';
	}
	
if(isset($_POST['ttl_check']))
{
	$sql="SELECT capmus_users.id as user_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_attendance_student_old.id,campus_attendance_student_old.schedule_id,campus_attendance_student_old.studentID,campus_attendance_student_old.teacherID,
		campus_attendance_student_old.startTime,campus_attendance_student_old.endTime,campus_attendance_student_old.courseID,campus_attendance_student_old.classType,
		campus_attendance_student_old.classStartTime,campus_attendance_student_old.comments,campus_attendance_student_old.lessonDetails,
		campus_attendance_student_old.std_status,campus_attendance_student_old.status,campus_attendance_student_old.date,
		campus_attendance_student_old.lecture_image_filepath 
		FROM capmus_users 
		INNER JOIN campus_attendance_student_old ON 
		capmus_users.id=campus_attendance_student_old.teacherID ";
		if($_POST['search-teacher-id']!=0)
		{
			$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' and campus_attendance_student_old.teacherID='".$_POST['search-teacher-id']."'";
		}
		if(isset($_POST['search-teacher-id2']))
		{
			$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."'";
		}
		if(isset($_POST['date']))
		{
			$sql.=" and campus_attendance_student_old.date='".prepareDate($_POST['date'])."' ";
		}
		$sql.=" ORDER BY campus_attendance_student_old.teacherID";
		//echo $sql;
	$result = mysql_query($sql);
}	
	
else	
{
	$result = getResultResource('campus_attendance_student_old',$_POST,'1');  
}

if($_SESSION['userType']==5)
{
	//$_sql.=" Where agent_id='".$_SESSION['userId']."'";
	$result = getResultResource('campus_students',$_POST," agent_id='".$_SESSION['userId']."'");
}

while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['schedule_id']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID']),'3') . "</td>";  
echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row['LeadId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['classStartTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>";
if(nl2br( $row['endTime'])=='' || nl2br( $row['endTime'])==NULL)
{
	$class_duration='--/--/--';
	echo "<td valign='top' style='color:blue; font-weight:bold'>" . $class_duration . "</td>";
}
else
{
	//Subtracting STARTTIME from ENDTIME
	$class_duration =  round(abs(strtotime(nl2br( $row['endTime'])) - strtotime(nl2br( $row['classStartTime']))));
	$class_duration = gmdate('H:i:s',$class_duration);
	echo "<td valign='top' style='color:blue; font-weight:bold'>" . $class_duration . "</td>";
}
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['status']),'class_status') . "</td>";  
echo "<td valign='top'>" . htmlentities(nl2br( $row['comments'])) . "</td>";  
echo "<td valign='top'>" . strip_tags(nl2br( $row['lessonDetails'])) . "</td>";  
//Download link for the IMAGE OF TEACHER's LAST LECTURE
	if(!empty($row['lecture_image_filepath']))
	{
	echo "<td valign='top'><a href='". nl2br( $row['lecture_image_filepath'])."' target=_blank>" . DOWNLOAD . "</a></td>";
	}
	else
	{
	echo "<td valign='top'><a href=#>" . NOFILE . "</a></td>";
	}

echo "</tr>"; 
} 
echo "</table>"; 

include('include/footer.php');?>