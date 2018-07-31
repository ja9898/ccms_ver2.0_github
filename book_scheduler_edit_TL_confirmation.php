<? 
include('config.php');
include('include/header.php'); 

if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userId']==411 || $_SESSION['userId']==195 || $_SESSION['userId']==347 || $_SESSION['userId']==625 || $_SESSION['userId']==221)
{
//Following code is checking whether the -confirm_TL_submitted- variable is been sent to the SELF PAGE(SELF POST)
// and then it checks whether the ID of the SCHEDULE has been sent properly to the SELF PAGE
$confirm_TL_submitted =  $_GET['confirm_TL_submitted'];
if (isset($confirm_TL_submitted) && $confirm_TL_submitted!=0) { 
$sql_confirmed = "UPDATE `campus_schedule` SET  `edit_sch_TL_confirm` = '0' WHERE `id` = '$confirm_TL_submitted'"; 
mysql_query($sql_confirmed) or die(mysql_error());
echo "<script>alert('Schedule Confirmed-Click O.K.');</script>";
} 
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"></div>
<div style="float:left"></div>
<br>
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>ID</b></th>";  
//echo "<th class='specalt'><b>Contact No.</b></th>";
echo "<th class='specalt'><b>TTL</b></th>";
echo "<th class='specalt'><b>MAIN TTL</b></th>"; 
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'>Country</th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
//echo "<th class='specalt'><b>Absent Alert</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher Old</b></th>";
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>";
echo "<th class='specalt'><b>Priority</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>"; 
echo "<th class='specalt'><b>Skype ID</b></th>"; 


echo "<th class='specalt' colspan=7><b>Actions</b></th>";  
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());

if($_SESSION['userType']==5)
{
	$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and campus_schedule.std_status!='4' and status_freeze=0 and status_dead=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues'); 
}


//MANAGE SCHEDULE AND FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher_edit_confirm();
}

else if($_SESSION['userType']==9)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_agent();
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==15)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher_main_edit_confirm();
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==16)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_agent_main();
}

//SHOWING ALL THE TRIALS< REGULARS AND MAKEOVERS IN MANAGE SCHEDULE
else{
	//$result = getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status!="3" and status_dead=0',"",",campus_students.firstName as name,campus_students.std_status as std_status",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id ","order by startTime asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues,campus_schedule.id');
	
	$result = getResultResource_superadmin_edit_confirm();
	
	}


//One month range for ABSENT ALERT	
$curr_systemdate = mysql_real_escape_string($_LIST['systemdate']);
$sub_date = mysql_real_escape_string(date('Y-m-d', strtotime(nl2br( $curr_systemdate). ' - 30 days')));

	
//Adding this for PRIORITY
$systemdate = systemDate();

$rowcount = mysql_num_rows($result);	
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rowcount." &nbsp;&nbsp;&nbsp;</div><br></b>";
while($row = mysql_fetch_array($result)){ 
$query="select `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);


foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
if($_SESSION['userType']==8 || $_SESSION['userType']==15)
{
	echo "<td valign='top'>" .nl2br($row['sch_id']). "</td>";
}
else
{
	echo "<td valign='top'>" .nl2br($row['id']). "</td>";
}

/*if($_SESSION['userType']!=12 && $_SESSION['userType']!=13)
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
}*/
$days = (strtotime($systemdate) - strtotime(nl2br( $row['duedate']))) / (60 * 60 * 24);
echo "<td valign='top' style='color:green; font-weight:bold'>" .showUser( nl2br( $row['LeadId'])) . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'>" .showUser( nl2br( $row['main_LeadId'])) . "</td>";
echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $rows['countryID']),'country'). "</td>";   
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>"; 
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID_old'])) . "</td>";   
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
echo "<td valign='top'>" . nl2br( $row['skypetext']) . "</td>"; 

  
if($_SESSION['userType']==8 || $_SESSION['userType']==15)
{
		echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['sch_id']}>Reject</a></td>";
		echo "<td valign='top'><a  class=button href=book_scheduler_edit_TL_confirmation.php?confirm_TL_submitted={$row['sch_id']}>Confirm</a></td>";
		?>
		<!--<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

			<td valign='top'><a onclick="return confirm('Are you sure you want to mark this record Dead?')" type='submit' class='button' value="<?php echo stripslashes($row['sch_id']); ?>">Confirm</a></td>
			<td valign='top'><input type='submit' class="button" value='Confirm' /><input type='hidden' value="<?php echo stripslashes($row['sch_id']); ?>" name='confirm_TL_submitted' /> </td>
		
		</form>-->
		<?
}

else if($_SESSION['userType']==10 || $_SESSION['userType']==9 || $_SESSION['userType']==16)
{

		echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['id']}>Reject</a></td>";
		echo "<td valign='top'><a class=button href=book_scheduler_edit_TL_confirmation.php?confirm_TL_submitted={$row['id']}>Confirm</a></td>";
}

else
{
	echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['id']}>Reject</a></td>";
	echo "<td valign='top'><a class=button href=book_scheduler_edit_TL_confirmation.php?confirm_TL_submitted={$row['id']}>Confirm</a></td>"; 
}
echo "</tr>"; 
} 
echo "</table>"; 
}
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}
include('include/footer.php');
?>