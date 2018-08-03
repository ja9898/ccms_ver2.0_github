<? 
include('config.php');
include('include/header.php'); 
if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userId']==48 || $_SESSION['userId']==195 || $_SESSION['userId']==2015)
{
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 

getStudentFilter();
getTeacherFilter();
getAgentFilter();
getStartTimeFilter(); ?></div>
<div style="float:left">
<?php
getPlanFilter();
getShiftFilter();
getCourseFilter();
getStatusFilter_with_makeover();
getFilterSubmit();
?></div>
<br>
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>ID</b></th>";  
//echo "<th class='specalt'><b>Contact No.</b></th>"; 
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'>Country</th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>"; 
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>";
echo "<th class='specalt'><b>Priority</b></th>";
echo "<th class='specalt' colspan=4><b>Actions</b></th>";  
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());

//******	Restricting access for everyone except SUPERADMINS(Junaid,faheem and Ahmad)	******
if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userId']==48 || $_SESSION['userId']==195)
{
if($_SESSION['userType']==5)
{
	$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and status_dead=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues'); 
}


//MANAGE SCHEDULE AND FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher();
}

else if($_SESSION['userType']==9)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_agent();
}


// FILTER FOR STUDENT STATUS and CLASS TYPE
/*else if(isset($_POST['search-submit']) && isset($_POST['classType']) && $_POST['stdStatus']!="" && $_POST['stdStatus']!=0 && $_POST['classType']!=0)
{
	//$result=mysql_query($select_sta_query);
	$result = getResultResource($_table='campus_schedule',$_post="",$_where="campus_schedule.std_status='".$_POST['stdStatus']."' and campus_schedule.classType='".$_POST['classType']."' and status=1 and campus_schedule.std_status!='3' and status_dead=0",$join='',$joinFields=',campus_students.firstName as name,campus_students.std_status as std_status',$joinWhere='',$joinselect="left JOIN campus_students ON campus_schedule.studentID=campus_students.id",$orderby="order by name asc",$_fields="campus_schedule.std_status as statussch,campus_schedule.dues as dues");
	//$check=0;
}


//FILTER FOR STUDENT STATUS ONLY
else if(isset($_POST['search-submit']) && $_POST['stdStatus']!="" && $_POST['stdStatus']!=0)
{
	//$result=mysql_query($select_sta_query);
	$result = getResultResource($_table='campus_schedule',$_post="",$_where="campus_schedule.std_status='".$_POST['stdStatus']."' and status=1 and campus_schedule.std_status!='3' and status_dead=0",$join='',$joinFields=',campus_students.firstName as name,campus_students.std_status as std_status',$joinWhere='',$joinselect="left JOIN campus_students ON campus_schedule.studentID=campus_students.id",$orderby="order by name asc",$_fields="campus_schedule.std_status as statussch,campus_schedule.dues as dues");
	//$check=0;
}*/

//SHOWING ALL THE TRIALS< REGULARS AND MAKEOVERS IN MANAGE SCHEDULE
else{
	//$result = getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status!="3" and status_dead=0',"",",campus_students.firstName as name,campus_students.std_status as std_status",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id ","order by startTime asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues,campus_schedule.id');
	
	$result = getResultResource_superadmin();
	
	}
}

//Adding this for PRIORITY
$systemdate = systemDate();

$rowcount = mysql_num_rows($result);	
while($row = mysql_fetch_array($result)){ 
$query="select `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
if($_SESSION['userType']==8)
{
	echo "<td valign='top'>" .nl2br($row['sch_id']). "</td>";
}
else
{
	echo "<td valign='top'>" .nl2br($row['id']). "</td>";
}

/* echo "<td valign='top'>";
if(!empty($rows['phone'])){

echo "[" . nl2br( $rows['phone'] )."]";
}
if(!empty($rows['mobile'])){
echo " <br>[".nl2br( $$rows['mobile'] )."]";
}
if(!empty($$rows['landline'])){
echo "<br>[".nl2br( $rows['landline'] ) . "]";
}
echo "</td>";   */
//echo "<td valign='top'>" . nl2br( $row['users_id']) . "</td>";  
$days = (strtotime($systemdate) - strtotime(nl2br( $row['duedate']))) / (60 * 60 * 24);
echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $rows['countryID']),'country'). "</td>";   
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>";  
//BEST EXAMPLE TO JOIN 2 TABLES FOR UPDATING THE RECORD IN THE OTHER TABLE WHICH HAS THE PRIMARY KEY
//http://stackoverflow.com/questions/9957171/how-to-join-two-tables-in-an-update-statement
//http://stackoverflow.com/questions/4840833/mysql-add-12-hours-to-a-time-field
echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" .showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top'>" .showUser( nl2br( $row['agentId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";  
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

	echo "<td valign='top'><a class=button href=book_scheduler_edit_group.php?id={$row['id']}>Edit</a></td>";

echo "</tr>"; 
} 
echo "</table>"; 
}
else
{
echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}
//echo "<a href=book_scheduler_new.php class=button>New Row</a>"; 
include('include/footer.php');
?>