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

/*echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>student </b></th>";  
echo "<th class='specalt'><b>name</b></th>"; 
echo "<th class='specalt'><b>teacher</b></th>"; 
echo "<th class='specalt'><b>Status</b></th>";
echo "<th class='specalt'>Count</th>"; */
 
 
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());

if($_SESSION['userType']==5)
{
	$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and status_dead=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues'); 
}


//Following query is to count REGULAR students that are more than 3 time ABSENT in campus_attendance_student.php
//Commenting for now
/*
echo $curr_systemdate = $_LIST['systemdate'];
echo "<br>";
echo $sub_date = date('Y-m-d', strtotime(nl2br( $curr_systemdate). ' - 30 days'));

$new_sql = "SELECT 
campus_attendance_student.id,campus_attendance_student.studentID as c_a_s_stdID,campus_attendance_student.teacherID,
campus_attendance_student.classStartTime,campus_attendance_student.startTime,campus_attendance_student.date,campus_attendance_student.std_status,
SUM(campus_attendance_student.status = 0) as sta,campus_attendance_student.comments,campus_attendance_student.lessonDetails  

    FROM campus_attendance_student 
	WHERE  campus_attendance_student.status = 0  and 
	date BETWEEN '".$sub_date."' AND '".$curr_systemdate."' and 
	campus_attendance_student.std_status=2 
	GROUP BY campus_attendance_student.studentID";
	
$new_sql_result = mysql_query($new_sql);


		
while($new_row = mysql_fetch_array($new_sql_result)){
echo "<tr>";  
  
echo "<td valign='top'>" . nl2br( $new_row['c_a_s_stdID']) . "</td>";
if(nl2br( $new_row['sta'])>3)
{
echo "<td valign='top' style='color:red; font-weight:bold'>". "<a href=class_details.php?id={$new_row['c_a_s_stdID']} style='color:red; font-weight:bold'>" . showStudents(nl2br( $new_row['c_a_s_stdID'])) . "</a></td>";  
}
else
{
echo "<td valign='top' style='color:green; font-weight:bold'>". "<a href=class_details.php?id={$new_row['c_a_s_stdID']} style='color:green; font-weight:bold'>" . showStudents(nl2br( $new_row['c_a_s_stdID'])) . "</a></td>";  
}
echo "<td valign='top'>" .showUser( nl2br( $new_row['teacherID'])) . "</td>"; 
if(nl2br( $new_row['sta'])>3)
{
	echo "<td valign='top' style='color:red; font-weight:bold'>Absent Alert</td>";
}
else
{
	echo "<td valign='top' style='color:green; font-weight:bold'>Absent Normal</td>";
} 
echo "<td valign='top'>" .nl2br( $new_row['sta']). "</td>"; 


echo "</tr>"; 
} 
echo "</table>"; 
*/
?>













<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>ID</b></th>";  
echo "<th class='specalt'><b>Contact No.</b></th>"; 
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'>Country</th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>";
echo "<th class='specalt'><b>Priority</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>";

//echo "<th class='specalt'><b>student </b></th>";  
echo "<th class='specalt'><b>name</b></th>"; 
//echo "<th class='specalt'><b>teacher</b></th>"; 
//echo "<th class='specalt'>Absent Status</th>"; 
//echo "<th class='specalt'>Absent Count</th>"; 
 

//echo "<th class='specalt' colspan=4><b>Actions</b></th>";  

echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());

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

else if($_SESSION['userType']==13)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_quran_readonly();
}


//SHOWING ALL THE TRIALS< REGULARS AND MAKEOVERS IN MANAGE SCHEDULE
else{
	//$result = getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status!="3" and status_dead=0',"",",campus_students.firstName as name,campus_students.std_status as std_status",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id ","order by startTime asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues,campus_schedule.id');
	
	$result = getResultResource_superadmin();
	
	}


//One month range for ABSENT ALERT
$curr_systemdate = mysql_real_escape_string($_LIST['systemdate']);
$sub_date = mysql_real_escape_string(date('Y-m-d', strtotime(nl2br( $curr_systemdate). ' - 30 days')));

	
//Adding this for PRIORITY
$systemdate = systemDate();
$rowcount = mysql_num_rows($result);	
while($row = mysql_fetch_array($result)){
$query="select `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);


////////////////////////////
//REALLY IMPORTANT LINK
//http://stackoverflow.com/questions/14192205/count-number-of-items-in-a-row-in-mysql

//*******Following query is to count REGULAR students that are more than 3 time ABSENT in campus_attendance_student.php
//*******USED WITHIN MANAGE SCHEDULE query
$new_sql = "SELECT campus_attendance_student.id,campus_attendance_student.studentID as c_a_s_stdID,
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
$new_sql_result_rows = mysql_fetch_array($new_sql_result);
////////////////////////////




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

if($_SESSION['userType']!=12 && $_SESSION['userType']!=13)
{
	echo "<td valign='top'>";
	if(!empty($rows['phone'])){

	echo "[" . nl2br( $rows['phone'] )."]";
	}
	if(!empty($rows['mobile'])){
	echo " <br>[".nl2br( $$rows['mobile'] )."]";
	}
	if(!empty($$rows['landline'])){
	echo "<br>[".nl2br( $rows['landline'] ) . "]";
	}
	echo "</td>";
}
else
{
	echo "<td valign='top'>N/A</td>";
}
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
echo "<td valign='top'>" .showUser( nl2br( $row['agentId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>"; 


//FOLLOWING IS TO DISPLAY THE 
/*echo "<td valign='top'>" . nl2br( $new_sql_result_rows['c_a_s_stdID']) . "</td>";*/
if(nl2br( $new_sql_result_rows['sta'])>3)
{
echo "<td valign='top' style='color:red; font-weight:bold'>" . "<a href=class_details.php?id={$row['studentID']} style='color:red; font-weight:bold'>" . showStudents_class_details(nl2br( $new_sql_result_rows['c_a_s_stdID'])) . "</a></td>";  
}
else
{
echo "<td valign='top' style='color:green; font-weight:bold'>". "<a href=class_details.php?id={$row['studentID']} style='color:green; font-weight:bold'>" . showStudents_class_details(nl2br( $new_sql_result_rows['c_a_s_stdID'])) . "</a></td>";  
}
/*echo "<td valign='top'>" .showUser( nl2br( $new_sql_result_rows['teacherID'])) . "</td>"; 
if(nl2br( $new_sql_result_rows['sta'])>3)
{
	echo "<td valign='top' style='color:red; font-weight:bold'>Absent Alert</td>";
}
else
{
	echo "<td valign='top' style='color:green; font-weight:bold'>Absent Normal</td>";
}
echo "<td valign='top'>" .nl2br( $new_sql_result_rows['sta']). "</td>"; 
*/

  
/*if($_SESSION['userType']==8)
{
	//if($_SESSION['userId']==203)
	//{
	//echo "<td valign='top'><a class=button>N/A</a></td>";
	//}
	//else
	//{
		echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['sch_id']}>Edit</a></td>
		<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead_message.php?id={$row['sch_id']}>Dead</a></td>";
		if($row['statussch']=='1')
		{
		echo "<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['sch_id']}&crs={$row['courseID']}&classType={$row['classType']}&startTime={$row['startTime']}>Make Regular</a></td> ";
		}
	//}
}

else if($_SESSION['userType']==10 || $_SESSION['userType']==9)
{
	if($_SESSION['userId']==263)
	{
	echo "<td valign='top'><a class=button>N/A</a></td>";
	}
	else
	{
		echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['id']}>Edit</a></td>
		<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead_message.php?id={$row['id']}>Dead</a></td>";
		if($row['statussch']=='1')
		{
		echo "<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&startTime={$row['startTime']}>Make Regular</a></td> ";
		}
	}
}

else
{
	echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['id']}>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=book_scheduler_delete.php?id={$row['id']}>Delete</a></td>
	<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead.php?id={$row['id']}>Dead</a></td>";
	if($row['statussch']=='1')
	{
		echo "<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&startTime={$row['startTime']}>Make Regular</a></td> ";
	} 
}*/
/*if($row['statussch']=='1'){

echo "
<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['id']}>Make Regular</a></td> ";} */
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=book_scheduler_new.php class=button>New Row</a>"; 
include('include/footer.php');
?>