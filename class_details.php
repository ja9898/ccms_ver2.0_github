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
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
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
echo "<th class='specalt'>Grade</th>"; 
echo "<th class='specalt'>LessonDetails</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Dua</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Prayer</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Kalima</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Lesson</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Surah</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Verse(From-To)</th>";
//Download link for the IMAGE OF TEACHER's LAST LECTURE
echo "<th class='specalt'><b>Download file</b></th>";
echo "<th class='specalt'><b>Zoom link</b></th>";
echo "</tr>"; 
//$result = mysql_query("SELECT * FROM `campus_attendance_student`") or trigger_error(mysql_error()); 

if(isset($_POST['search-submit']))
{

if(isset($_GET['id'])){
	
	$_POST['search-student-id']=$_GET['id'];
	$_POST['search-submit']='';
	}
	
else if(isset($_POST['ttl_check']))
{
	$sql="SELECT capmus_users.id as user_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_attendance_student.id,campus_attendance_student.schedule_id,campus_attendance_student.studentID,campus_attendance_student.teacherID,
		campus_attendance_student.startTime,campus_attendance_student.endTime,campus_attendance_student.courseID,campus_attendance_student.classType,
		campus_attendance_student.classStartTime,campus_attendance_student.comments,campus_attendance_student.lessonDetails,
		campus_attendance_student.std_status,campus_attendance_student.status,campus_attendance_student.date,
		campus_attendance_student.lecture_image_filepath,
		campus_attendance_student.dua,campus_attendance_student.prayer,campus_attendance_student.kalima,
		campus_attendance_student.lesson,campus_attendance_student.surah,
		campus_attendance_student.verseFrom,campus_attendance_student.verseTo,campus_attendance_student.record_link 
		FROM capmus_users 
		INNER JOIN campus_attendance_student ON 
		capmus_users.id=campus_attendance_student.teacherID ";
		//		campus_attendance_student.status!=0 and 
		if($_POST['search-teacher-id']!=0 && $_POST['search-teacher-id']!='')
		{
			$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' and campus_attendance_student.teacherID='".$_POST['search-teacher-id']."'";
		}
		if(isset($_POST['search-teacher-id2']) && $_POST['search-teacher-id2']!='' )
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
		$sql.=" ORDER BY campus_attendance_student.date ASC";
		//echo $sql;
	$result = mysql_query($sql);
}	
	
else	
{
	//$result = getResultResource('campus_attendance_student',$_POST,'1');  
	$sql="SELECT capmus_users.id as user_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
	campus_attendance_student.id,campus_attendance_student.schedule_id,campus_attendance_student.studentID,campus_attendance_student.teacherID,
	campus_attendance_student.startTime,campus_attendance_student.endTime,campus_attendance_student.courseID,campus_attendance_student.classType,
	campus_attendance_student.classStartTime,campus_attendance_student.comments,campus_attendance_student.lessonDetails,
	campus_attendance_student.std_status,campus_attendance_student.status,campus_attendance_student.date,
	campus_attendance_student.lecture_image_filepath,
	campus_attendance_student.dua,campus_attendance_student.prayer,campus_attendance_student.kalima,
	campus_attendance_student.lesson,campus_attendance_student.surah,
	campus_attendance_student.verseFrom,campus_attendance_student.verseTo,campus_attendance_student.record_link 
	FROM capmus_users 
	INNER JOIN campus_attendance_student ON 
	capmus_users.id=campus_attendance_student.teacherID ";
	//		campus_attendance_student.status!=0 and 
	if($_POST['search-teacher-id']!=0 && $_POST['search-teacher-id']!='')
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' and campus_attendance_student.teacherID='".$_POST['search-teacher-id']."'";
	}
	if(isset($_POST['search-teacher-id2']) && $_POST['search-teacher-id2']!='' )
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
	$sql.=" ORDER BY campus_attendance_student.date ASC";
	//echo $sql;
	$result = mysql_query($sql);
}

if($_SESSION['userType']==5)
{
	//$_sql.=" Where agent_id='".$_SESSION['userId']."'";
	$result = getResultResource('campus_students',$_POST," agent_id='".$_SESSION['userId']."'");
}
$rowcount = mysql_num_rows($result);	
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rowcount." &nbsp;&nbsp;&nbsp;</div><br></b>";
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
	$endTime = strtotime($row['endTime']);
	$classStartTime = strtotime($row['classStartTime']);
	if($endTime<$classStartTime)
	{
		$class_duration =  round(abs(strtotime(nl2br( $row['endTime'])) - strtotime(nl2br( $row['classStartTime']))));
		$class_duration = gmdate('H:i:s',$class_duration);
		$class_duration = round(abs(strtotime($class_duration)));
		$_24_hr_time = round(abs(strtotime('23:59:59')));
		$cal_time = $_24_hr_time - $class_duration;
		$class_duration = gmdate('H:i:s',$cal_time);
	}
	else
	{
		$class_duration =  round(abs(strtotime(nl2br( $row['endTime'])) - strtotime(nl2br( $row['classStartTime']))));
		$class_duration = gmdate('H:i:s',$class_duration);
	}
	echo "<td valign='top' style='color:blue; font-weight:bold'>" . $class_duration . "</td>";
}
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['status']),'class_status') . "</td>";    
echo "<td valign='top'>" . htmlentities(nl2br( $row['comments'])) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['grade']) . "</td>";
echo "<td valign='top'>" . strip_tags(nl2br( $row['lessonDetails'])) . "</td>"; 

//DUA
$row_dua=mysql_fetch_array(mysql_query("select * from campus_dua WHERE id='".$row['dua']."' ORDER BY id ASC"));
echo "<td valign='top' style='color:red; font-weight:bold;'>" . nl2br( $row_dua['dua']) . "</td>";
//Prayer
$row_prayer=mysql_fetch_array(mysql_query("select * from campus_prayer WHERE id='".$row['prayer']."' ORDER BY id ASC"));
echo "<td valign='top' style='color:red; font-weight:bold;'>" . nl2br( $row_prayer['name']) ."-Description:" . nl2br( $row_prayer['description']) . "</td>";
//Kalima
echo "<td valign='top' style='color:red; font-weight:bold;'>" . nl2br( $row['kalima']) . "</td>";
//Lesson
$row_lesson=mysql_fetch_array(mysql_query("select * from campus_syllabus WHERE id='".$row['lesson']."' ORDER BY id ASC"));
echo "<td valign='top' style='color:red; font-weight:bold;'>Lesson:" . nl2br( $row_lesson['lessonName']) ."-". nl2br( $row_lesson['arabicName']) . "</td>";
//Surah
$row_surah=mysql_fetch_array(mysql_query("select * from campus_surah WHERE id='".$row['surah']."' ORDER BY id ASC"));
echo "<td valign='top' style='color:red; font-weight:bold;'>" . nl2br( $row_surah['level']) . "</td>";
//Verse From-TO
echo "<td valign='top' style='color:red; font-weight:bold;'>" . nl2br( $row['verseFrom']). "-" . nl2br( $row['verseTo']) . "</td>";
 
 
//Download link for the IMAGE OF TEACHER's LAST LECTURE
	if(!empty($row['lecture_image_filepath']))
	{
	echo "<td valign='top'><a href='". nl2br( $row['lecture_image_filepath'])."' target=_blank>" . DOWNLOAD . "</a></td>";
	}
	else
	{
	echo "<td valign='top'><a href=#>" . NOFILE . "</a></td>";
	}
echo "<td valign='top' style='color:LightSkyBlue; font-weight:bold;'>" . nl2br( $row['record_link']) . "</td>";
echo "</tr>"; 
} 
}
echo "</table>"; 

include('include/footer.php');?>