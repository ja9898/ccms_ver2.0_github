<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 
getStartTimeFilter();
if($_SESSION['userType']==1 || $_SESSION['userType']==8)
{
// class amt_start_range is used NOT to enter the CHARACTERS in the textbox using jquery
echo getInput_number('','start_range','amt_start_range','Amt Start Range');
?>&nbsp;&nbsp;&nbsp;<?
// class amt_end_range is used NOT to enter the CHARACTERS in the textbox using jquery
echo getInput_number('','end_range','amt_end_range','Amt End Range');
} ?></div>
<div style="float:left">
<?php
getCourseFilter();
getParentFilter();
getFilterSubmit();
//echo "<label style='color:red; font-weight:bold'>NOTE: Don't consider ABSENT ALERT for MAKE OVER classes - <u>Take the Load</u></label>";
?></div>
<br>
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>ID</b></th>";  
//echo "<th class='specalt'><b>Contact No.</b></th>"; 
echo "<th class='specalt'><b>Ext ID OLD</b></th>";
echo "<th class='specalt'><b>Extension ID</b></th>"; 
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'>Country</th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
//echo "<th class='specalt'><b>Absent Alert</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>";
echo "<th class='specalt'><b>Priority</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>"; 
echo "<th class='specalt'><b>Dues - USD</b></th>"; 
echo "<th class='specalt'><b>Dues - Original</b></th>"; 
echo "<th class='specalt'><b>Pay Date</b></th>";
echo "<th class='specalt'><b>Currency</b></th>"; 
echo "<th class='specalt'><b>Skype ID</b></th>"; 
echo "<th class='specalt'><b>USERNAME</b></th>"; 
echo "<th class='specalt'><b>PASSWORD</b></th>"; 
echo "<th class='specalt' colspan=8><b>Actions</b></th>";  
echo "</tr>"; 
if($_SESSION['userType']==5 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ) )
{
	$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and campus_schedule.std_status!='4'  and campus_schedule.std_status!='7' and status_freeze=0 and status_dead=0 and status_transfertolhr=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues'); 
}


//MANAGE SCHEDULE AND FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher_main_PARENT();
}

else if($_SESSION['userType']==9 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_agent();
}

else if($_SESSION['userType']==13)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_quran_readonly();
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==15 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 || $_POST['search-parent-id']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher_main_PARENT();
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==16 && ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 ))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_agent_main();
}

//SHOWING ALL THE TRIALS< REGULARS AND MAKEOVERS IN MANAGE SCHEDULE
else if(   ($_POST['search-student-id']!=0  || $_POST['search-teacher-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['classType']!=0 || $_POST['stdStatus']!=0 || $_POST['startTime']!=0 || $_POST['shift']!=0 || $_POST['course']!=0 || $_POST['search-parent-id']!=0 )  ){
	$result = getResultResource_superadmin_PARENT();
	}
else
{
	echo "<br>";echo "<br>";echo "<br>";echo "<br>";
	echo "<div  style='color:red; font-size:16px; position:relative;'>Apply proper filters</div>";
}

//One month range for ABSENT ALERT	
$curr_systemdate = mysql_real_escape_string($_LIST['systemdate']);
$sub_date = mysql_real_escape_string(date('Y-m-d', strtotime(nl2br( $curr_systemdate). ' - 30 days')));	
//Adding this for PRIORITY
$systemdate = systemDate();
//Get 1 cad to usd rate from db
$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
//Arrays for the Amount sum
$cad_amt=array();
$usd_amt=array();
$org_amt=array();

$rowcount = mysql_num_rows($result);	
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rowcount." &nbsp;&nbsp;&nbsp;</div><br></b>";
while($row = mysql_fetch_array($result)){ 
$query="select `campus_students`.id as stu_id , `campus_students`.extId_old ,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline, `campus_students`.username , `campus_students`.password ,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
if($_SESSION['userType']==8 || $_SESSION['userType']==15)
{
	echo "<td valign='top'>" .nl2br($row['id']). "</td>";
	$cad_amt[$row['id']] = $row['dues'];
	$usd_amt[$row['id']] = $row['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	$org_amt[$row['id']] = $row['dues_original'];
}
else
{
	echo "<td valign='top'>" .nl2br($row['id']). "</td>";
	$cad_amt[$row['id']] = $row['dues'];
	$usd_amt[$row['id']] = $row['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	$org_amt[$row['id']] = $row['dues_original'];
}

if($_SESSION['userType']!=12 && $_SESSION['userType']!=13)
{
	/*echo "<td valign='top'>";
	if(!empty($rows['phone'])){

	echo "[" . nl2br( $rows['phone'] )."]";
	}
	if(!empty($rows['mobile'])){
	echo " <br>[".nl2br( $$rows['mobile'] )."]";
	}
	if(!empty($$rows['landline'])){
	echo "<br>[".nl2br( $rows['landline'] ) . "]";
	}
	echo "</td>";*/
}
else
{
	//echo "<td valign='top'>N/A</td>";
}
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".$rows['extId_old']."' target=_blank >" . $rows['extId_old'] . "</a></td>";
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $rows['stu_id']))."' target=_blank >" . getextID(nl2br( $rows['stu_id'])) . "</a></td>";
$days = (strtotime($systemdate) - strtotime(nl2br( $row['duedate']))) / (60 * 60 * 24);
echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $rows['countryID']),'country'). "</td>";   
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>";  
//BEST EXAMPLE TO JOIN 2 TABLES FOR UPDATING THE RECORD IN THE OTHER TABLE WHICH HAS THE PRIMARY KEY
//http://stackoverflow.com/questions/9957171/how-to-join-two-tables-in-an-update-statement
//http://stackoverflow.com/questions/4840833/mysql-add-12-hours-to-a-time-field
//Following condition of startDate is added so that schedule with startDate less than systemDate must be shown
if($row['startDate']>$systemdate && $_SESSION['userType']==8)
{
	echo "<td valign='top' style='color:RED; font-weight:bold'>Schedule will be activated after the given date - " . nl2br( $row['startDate']) . "</td>";
}
else
{
	echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";
}
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['statussch']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";  
if($days>=16)
{
	echo "<td valign='top'>Normal</td>";
}
else
{
	echo "<td valign='top' style='color:red; font-weight:bold'>Special</td>";
}  
echo "<td valign='top'>" . showUser( nl2br( $row['agentId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>"; 
$dues_usd = round($row['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
echo "<td valign='top'>" . $dues_usd . "</td>";
echo "<td valign='top' style='color:blue; font-weight:bold'>" . $row['dues_original'] . "</td>";
echo "<td valign='top' style='color:blue; font-weight:bold'>" . date('d',strtotime($row['paydate'])) . "</td>";
echo "<td valign='top' style='color:blue; font-weight:bold'>" . getData(nl2br( $row['currency_array']),'currency') . "</td>";
echo "<td valign='top'>" . nl2br( $row['skypetext']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $rows['username']) . "</td>";
echo "<td valign='top'>" . nl2br( $rows['password']) . "</td>";
if($_SESSION['userType']==8 || $_SESSION['userType']==15)
{
}

else if($_SESSION['userType']==10 || $_SESSION['userType']==9 || $_SESSION['userType']==16)
{
}

else
{
	
}
echo "</tr>"; 
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
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'>Sum </td>";  
	echo "<td valign='top'><b>$" . nl2br( array_sum($cad_amt)) . "</td>"; 
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" .  round(array_sum($usd_amt)) . "</td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" .  round(array_sum($org_amt)) . "</td>";	
echo "</tr>";
echo "</table>";
include('include/footer.php');
?>