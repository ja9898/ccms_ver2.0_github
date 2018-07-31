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

?>
&nbsp;&nbsp;
<div id="time">
<?php
echo getInput(stripslashes($_POST['date']),'date','class=flexy_datepicker_input');
?>
</div>
<?php 
getFilterSubmit();
?>
</form>
</div>
<? echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Id</th>"; 
echo "<th class='specalt'>StudentID</th>"; 
echo "<th class='specalt'>TeacherID</th>"; 
echo "<th class='specalt'>StartTime</th>"; 
echo "<th class='specalt'>ClassStartTime</th>"; 
echo "<th class='specalt'>Date</th>"; 
echo "<th class='specalt'>Class Status(T-R-M-TEST)</th>"; 
echo "<th class='specalt'>Status</th>"; 
echo "<th class='specalt'>Comments</th>"; 
echo "<th class='specalt'>LessonDetails</th>"; 
echo "</tr>"; 

if(isset($_POST['search-submit']))
{

//$result = mysql_query("SELECT * FROM `campus_attendance_student`") or trigger_error(mysql_error()); 
if(isset($_GET['id'])){
	
	$_POST['search-student-id']=$_GET['id'];
	$_POST['search-submit']='';
	}
	
$result =getResultResource('campus_attendance_student',$_POST,'1');  


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
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID']),'3') . "</td>";  
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['classStartTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['status']),'class_status') . "</td>";  
echo "<td valign='top'>" . htmlentities(nl2br( $row['comments'])) . "</td>";  
echo "<td valign='top'>" . strip_tags(nl2br( $row['lessonDetails'])) . "</td>";  

echo "</tr>"; 
} 
}
echo "</table>"; 

include('include/footer.php');?>