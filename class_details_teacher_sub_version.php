<? 
include('config.php'); 
include('include/header.php'); 
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
//getTeacherFilter();
//getStartTimeFilter();
//getClassStatusFilter();

?>
&nbsp;&nbsp;
<div id="time">
<?php
//echo getInput(stripslashes($_POST['date']),'date','class=flexy_datepicker_input');
?>
</div>
<?php 
//getFilterSubmit();
?>
</form>
</div>
<? echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Id</th>"; 
echo "<th class='specalt'>StudentID</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Dua</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Prayer</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Kalima</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Lesson</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Surah</th>"; 
echo "<th class='specalt' color:red; font-weight:bold;>Verse(From-To)</th>";
echo "<th class='specalt'>TeacherID</th>"; 
echo "<th class='specalt'>Grade</th>"; 
echo "<th class='specalt'>StartTime</th>"; 
echo "<th class='specalt'>ClassStartTime</th>"; 
echo "<th class='specalt'>Date</th>"; 
echo "<th class='specalt'>Class Status(T-R-M-TEST)</th>"; 
echo "<th class='specalt'>Status</th>"; 
echo "<th class='specalt'>Comments</th>"; 
echo "<th class='specalt'>LessonDetails</th>"; 
echo "<th class='specalt'>Comments for Management</th>"; 
//Download link for the IMAGE OF TEACHER's LAST LECTURE
echo "<th class='specalt'><b>Download file</b></th>"; 

echo "</tr>"; 
//$result = mysql_query("SELECT * FROM `campus_attendance_student`") or trigger_error(mysql_error()); 
if(isset($_GET['id'])){
	
	$_POST['search-student-id']=$_GET['id'];
	$_POST['search-submit']='';
	$result =getResultResource('campus_attendance_student',$_POST,'1'); 
	}
if(isset($_GET['teacherID_tea_tri_sta'])){
	
	$_POST['search-teacher-id']=$_GET['teacherID_tea_tri_sta'];
	$_POST['search-submit']='';
	$fromdate=$_GET['fromdate'];
	$todate=$_GET['todate'];
	$sql="SELECT * FROM `campus_attendance_student` 
							WHERE teacherID='".$_GET['teacherID_tea_tri_sta']."' 
							and std_status=1 
							and date>='".$fromdate."' and date<='".$todate."'";
	$result = mysql_query($sql) or trigger_error(mysql_error()); 
	}

	
//$result =getResultResource('campus_attendance_student',$_POST,'1');  

if($_SESSION['userType']==5)
{
	//$_sql.=" Where agent_id='".$_SESSION['userId']."'";
	$result = getResultResource('campus_students',$_POST," agent_id='".$_SESSION['userId']."'");
}

while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>"; 
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
 
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID']),'3') . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['grade']) . "</td>";   
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['classStartTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['status']),'class_status') . "</td>";  
echo "<td valign='top'>" . htmlentities(nl2br( $row['comments'])) . "</td>";  
echo "<td valign='top'>" . strip_tags(nl2br( $row['lessonDetails'])) . "</td>";
echo "<td valign='top'>" . $row['extra_comments'] . "</td>";
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