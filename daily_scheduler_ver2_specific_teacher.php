<? 
include('config.php');
include('include/header.php');
?>
<form action='<?php echo $_SERVER['PHP_SELF']?>' method='post'>
<?php 
if($_SESSION['userType']==3) { ?>



<?php echo getDataList_teamlead_dailyschedule(stripslashes($_POST['TeacherTL']),'TeacherTL',8);}?>


<select name='days[]'  >
<option>Select Days</option>
<option <?php if(isset($_POST['days']) && in_array("Monday",$_POST['days'])){ echo "selected='selected'";}?>>Monday</option>
<option <?php if(isset($_POST['days']) && in_array("Tuesday",$_POST['days'])){ echo "selected='selected'";}?>>Tuesday</option>
<option <?php if(isset($_POST['days']) && in_array("Wednesday",$_POST['days'])){ echo "selected='selected'";}?>>Wednesday</option>
<option <?php if(isset($_POST['days']) && in_array("Thursday",$_POST['days'])){ echo "selected='selected'";}?>>Thursday</option>
<option <?php if(isset($_POST['days']) && in_array("Friday",$_POST['days'])){ echo "selected='selected'";}?>>Friday</option>
<option <?php if(isset($_POST['days']) && in_array("Saturday",$_POST['days'])){ echo "selected='selected'";}?>>Saturday</option>
<option <?php if(isset($_POST['days']) && in_array("Sunday",$_POST['days'])){ echo "selected='selected'";}?>>Sunday</option>
</select>&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['classDate']),'classDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;<input type="submit" class="button" value="Show Classes"></form><br /><br /><br />

<? 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Course</b></th>"; 
echo "<th class='specalt'><b>Skype ID</b></th>";
echo "<th class='specalt'><b>Status</b></th>";  
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
echo "<th class='specalt'><b>Time Started</b></th>"; 
 
 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>Comments</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>"; 

echo "<th class='specalt' colspan=1><b>Actions</b></th>";  
echo "</tr>";
$date=date('H:i:s');
echo $date;
$h=date('H');
$m=date('i');
if($m > 29)
{
	$sql="startTime in ('$h:00','$h:30') ";
}
else
{
	$sql="startTime in ('$h:00') ";
}
echo "<br>";

echo $_POST['days'][0];
//echo $_POST['days'][0]=date('l');
echo "<br>";



if(!isset($_POST['classDate'])){
	$_POST['classDate']=date('Y-m-d');
	
	}
if($_SESSION['userType']!=3) {
echo "SELECT `campus_schedule`.*  FROM `campus_schedule` where ".$sql." and status=1 and `campus_schedule`.std_status!=3 and teacherID IN ('".getTeam($_SESSION['userId'])."') and classType in (".getPlan($_POST['days'][0]).")  ";	
$result = mysql_query("SELECT `campus_schedule`.*  FROM `campus_schedule` where ".$sql." and status=1 and `campus_schedule`.std_status!=3 and teacherID IN ('".getTeam($_SESSION['userId'])."') and classType in (".getPlan($_POST['days'][0]).")  ") or trigger_error(mysql_error());
}
else{

echo "<br>";
echo "SELECT `campus_schedule`.* FROM `campus_schedule` where ".$sql." and status=1 and `campus_schedule`.std_status!=3 and teacherID IN ('".getTeam($_POST['TeacherTL'])."') and classType in (".getPlan($_POST['days'][0]).") and startDate<='".prepareDate($_POST['classDate'])."' and endDate>='".prepareDate($_POST['classDate'])."' ";
echo $result = mysql_query("SELECT `campus_schedule`.* FROM `campus_schedule` where ".$sql." and status=1 and `campus_schedule`.std_status!=3 and teacherID IN ('".getTeam($_POST['TeacherTL'])."') and classType in (".getPlan($_POST['days'][0]).") and startDate<='".prepareDate($_POST['classDate'])."' and endDate>='".prepareDate($_POST['classDate'])."' ") or trigger_error(mysql_error());

}
// echo "SELECT `campus_schedule`.*  FROM `campus_schedule` where ".$sql." and status=1 and `campus_schedule`.std_status!=3 and teacherID IN ('".getTeam($_POST['TeacherTL'])."') and classType in (".getPlan($_POST['days'][0]).") and startDate<='".prepareDate($_POST['classDate'])."' and endDate>='".prepareDate($_POST['classDate'])."' ";
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . getData(nl2br( $row['courseID']),'course') . "</td>";  
echo "<td valign='top'>" . getSkypeID(nl2br( $row['studentID'])) . "</td>";
echo "<td valign='top'>" .  getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>";  
  
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>"; 

echo "<td valign='top'>" . nl2br( $row['classStartTime']) . "</td>"; 
 

echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" .showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['comments']) . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";  
  

 
echo "<td valign='top'>";

$_invalid=getClassStatus($row['id'],$_POST['classDate']);
if($_invalid=='2' ){
echo "<a class=button href=student_attandance.php?id={$row['id']}>Start Class</a>";}
else if($_invalid=='-1'){
echo "<a class=button href=student_attandance.php?eid={$row['id']}>End Class</a>";}
echo "</td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=book_scheduler_new.php class=button>New Row</a>"; 
include('include/footer.php');
?>