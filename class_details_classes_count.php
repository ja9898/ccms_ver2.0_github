<? 
include('config.php'); 
include('include/header.php'); 

//NEWLY ADDED
$student_id = $_GET['id']; 		//Passed from pending report overall
if($_GET['paydate_pre']!="" && isset($_GET['paydate_pre']))
{
$paydate_pre = $_GET['paydate_pre'];
}
else
{
$paydate = $_GET['paydate'];	//Passed from pending report overall
}
////////////

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
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
echo "<th class='specalt'>Grade</th>"; 
echo "<th class='specalt'>LessonDetails</th>"; 
//Download link for the IMAGE OF TEACHER's LAST LECTURE
echo "<th class='specalt'><b>Download file</b></th>"; 


echo "</tr>"; 
//$result = mysql_query("SELECT * FROM `campus_attendance_student`") or trigger_error(mysql_error()); 

//if(isset($_POST['search-submit']))
//{

if(isset($_GET['id'])){
	
	$_POST['search-student-id']=$_GET['id'];
	$_POST['search-submit']='';
	}
	
if(isset($_POST['ttl_check']))
{
	$sql="SELECT capmus_users.id as user_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_attendance_student.id,campus_attendance_student.schedule_id,campus_attendance_student.studentID,campus_attendance_student.teacherID,
		campus_attendance_student.startTime,campus_attendance_student.endTime,campus_attendance_student.courseID,campus_attendance_student.classType,
		campus_attendance_student.classStartTime,campus_attendance_student.comments,campus_attendance_student.lessonDetails,
		campus_attendance_student.std_status,campus_attendance_student.status,campus_attendance_student.date,
		campus_attendance_student.lecture_image_filepath 
		FROM capmus_users 
		INNER JOIN campus_attendance_student ON 
		capmus_users.id=campus_attendance_student.teacherID ";
		if($_POST['search-teacher-id']!=0)
		{
			$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' and campus_attendance_student.teacherID='".$_POST['search-teacher-id']."'";
		}
		if(isset($_POST['search-teacher-id2']))
		{
			$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."'";
		}
		if(isset($_POST['search-student-id']) &&  $_POST['search-student-id']!='')
		{
			$sql.=" and campus_attendance_student.studentID='".$_POST['search-student-id']."' ";
		}
		if(isset($_POST['fromDate']) && isset($_POST['toDate']))
		{
			$sql.=" and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."' ";
		}
		$sql.=" ORDER BY campus_attendance_student.teacherID";
		//echo $sql;
	$result = mysql_query($sql);
}	
	
else	
{
	//PREVIOUS MONTH PAYDATE
	if($paydate_pre!="" && isset($paydate_pre))
	{
		
		$fromDate_NEW=date('Y')."-".(date('m')-1)."-".$paydate_pre;
		$fromDate_NEW=date_create($fromDate_NEW);
		//1 month will be subtracted from current month
		$fromDate_NEW = date_sub($fromDate_NEW,date_interval_create_from_date_string("30 days"));
		echo $fromDate_NEW = date_format($fromDate_NEW,"Y-m-d");echo "<br>";
		echo $toDate_NEW=date('Y')."-".(date('m')-1)."-".$paydate_pre;echo "<br>";
	}
	//CURRENT MONTH PAYDATE
	if($paydate!="" && isset($paydate))
	{
		$fromDate_NEW=date('Y')."-".date('m')."-".$paydate;
		$fromDate_NEW=date_create($fromDate_NEW);
		//1 month will be subtracted from current month
		$fromDate_NEW = date_sub($fromDate_NEW,date_interval_create_from_date_string("30 days"));
		echo $fromDate_NEW = date_format($fromDate_NEW,"Y-m-d");echo "<br>";
		echo $toDate_NEW=date('Y')."-".date('m')."-".$paydate;echo "<br>";
	}
	
	//$result = getResultResource('campus_attendance_student',$_POST,'1');  
	$sql="SELECT 
		campus_attendance_student.id,campus_attendance_student.schedule_id,campus_attendance_student.studentID,campus_attendance_student.teacherID,
		campus_attendance_student.startTime,campus_attendance_student.endTime,campus_attendance_student.courseID,campus_attendance_student.classType,
		campus_attendance_student.classStartTime,campus_attendance_student.comments,campus_attendance_student.lessonDetails,
		campus_attendance_student.std_status,campus_attendance_student.status,campus_attendance_student.date,
		campus_attendance_student.lecture_image_filepath 
		FROM campus_attendance_student WHERE 
		campus_attendance_student.studentID='".$student_id."' ";
		if($fromDate_NEW!="" && $toDate_NEW!="")
		{
			$sql.=" and campus_attendance_student.date>= '".prepareDate($fromDate_NEW)."' and campus_attendance_student.date<= '".prepareDate($toDate_NEW)."'";
		}
		//echo $sql;
		$result = mysql_query($sql);
		count_present_absent_classes($student_id,$fromDate_NEW,$toDate_NEW);
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
echo "<td valign='top'>" . nl2br( $row['grade']) . "</td>";
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
//}
echo "</table>"; 

include('include/footer.php');?>