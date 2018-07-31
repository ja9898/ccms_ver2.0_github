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
getStartTimeFilter();
if($_SESSION['userType']==1)
{
// class amt_start_range is used NOT to enter the CHARACTERS in the textbox using jquery
echo getInput_number('','start_range','amt_start_range','Amt Start Range');
?>&nbsp;&nbsp;&nbsp;<?
// class amt_end_range is used NOT to enter the CHARACTERS in the textbox using jquery
echo getInput_number('','end_range','amt_end_range','Amt End Range');
} ?></div>
<div style="float:left">
<?php
getPlanFilter();
getShiftFilter();
getCourseFilter();
getStatusFilter_with_makeover();
?></div>
<br>
<div style="float:left">
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
</div>
<div style="float:left">
<?php
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
echo "<th class='specalt'><b>Freeze Date</b></th>"; 
echo "<th class='specalt'><b>Freeze comments</b></th>";
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>";
echo "<th class='specalt'><b>Priority</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Dues CAD</b></th>"; 
echo "<th class='specalt'><b>Dues USD</b></th>"; 
echo "<th class='specalt'><b>Comments</b></th>"; 
echo "<th class='specalt'><b>Recording link</b></th>"; 
echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
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

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
/* else if($_SESSION['userType']==15)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead_teacher_main();
} */

//SHOWING ALL THE TRIALS< REGULARS AND MAKEOVERS IN MANAGE SCHEDULE
else{
	//$result = getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status!="3" and status_dead=0',"",",campus_students.firstName as name,campus_students.std_status as std_status",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id ","order by startTime asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues,campus_schedule.id');
	
	$sql_freeze = "SELECT * FROM campus_schedule WHERE 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.status_freeze=1 and campus_schedule.std_status=4 and 
	campus_schedule.std_status!=3";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql_freeze.=" and campus_schedule.freeze_date>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.freeze_date<= '".prepareDate($_POST['toDate'])."'";
		}
	}


//One month range for ABSENT ALERT	
$curr_systemdate = mysql_real_escape_string($_LIST['systemdate']);

	
//Adding this for PRIORITY
$systemdate = systemDate();
$result = mysql_query($sql_freeze);
$rowcount = mysql_num_rows($result);	
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rowcount." &nbsp;&nbsp;&nbsp;</div><br></b>";
while($row = mysql_fetch_array($result)){ 
$query="select `campus_students`.extId , `campus_students`.extId_old , `campus_students`.id  , `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
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

if($_SESSION['userType']!=12 && $_SESSION['userType']!=13)
{
/* 	echo "<td valign='top'>";
	if(!empty($rows['phone'])){

	echo "[" . nl2br( $rows['phone'] )."]";
	}
	if(!empty($rows['mobile'])){
	echo " <br>[".nl2br( $$rows['mobile'] )."]";
	}
	if(!empty($$rows['landline'])){
	echo "<br>[".nl2br( $rows['landline'] ) . "]";
	}
	echo "</td>"; */
}
else
{
	//echo "<td valign='top'>N/A</td>";	
}
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".$rows['extId_old']."' target=_blank >" . $rows['extId_old'] . "</a></td>";
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $rows['id']))."' target=_blank >" . getextID(nl2br( $rows['id'])) . "</a></td>";
//echo "<td valign='top'>" . nl2br( $row['users_id']) . "</td>";  

$days = (strtotime($systemdate) - strtotime(nl2br( $row['duedate']))) / (60 * 60 * 24);

echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $rows['countryID']),'country'). "</td>";   
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
echo "<td valign='top' style='color:green; font-weight:bold'>" . nl2br( $row['freeze_date']) . "</td>"; 
echo "<td valign='top' style='color:green; font-weight:bold'>" . nl2br( $row['comments_freeze']) . "</td>"; 
 
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" .showUser( nl2br( $row['teacherID'])) . "</td>"; 
echo "<td valign='top'>" .getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 
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
$sum=$row['dues'];
$sum_dues[$row['id']]=$sum;
//Dues USD
	//Get 1 cad to usd rate from db
	$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
	$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
	$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	echo "<td valign='top'>" . $sum_usd_result = round($row['dues'] * $row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
$sum_usd=$sum_usd_result ;
$sum_dues_usd[$row['id']]=$sum_usd;
//

$comments = $row['comments'];
$comments = stripslashes($comments);
$comments = str_replace("rn","\r\n",$comments);
if($_SESSION['userType']==2){
echo "<td valign='top'>NA</td>";
}else{
echo "<td valign='top'>" . $comments . "</td>";
}
echo "<td valign='top'>" . nl2br( $row['record_link_freeze']) . "</td>";
if($_SESSION['userType']==1 || $_SESSION['userType']==15)
{
	echo "<td valign='top'><a class=button href=book_scheduler_unfreeze.php?id={$row['id']}>Un-Freeze</a></td>";
	echo "<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead.php?id={$row['id']}>Dead</a></td>";
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
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum </td>";  
echo "<td valign='top'><b>$" . array_sum($sum_dues)  . "</td>";
echo "<td valign='top'><b>$" . array_sum($sum_dues_usd)  . "</td>";    
echo "<td valign='top'></td>";
echo "</tr>";
 
echo "</table>"; 

include('include/footer.php');
?>