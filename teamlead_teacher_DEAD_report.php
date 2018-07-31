<?php 
include('config.php'); 
include('include/header.php');

echo "<label style='color:red; font-weight:bold'>NOTE: Proper results will be shown after 6th Nov 2013 due to the development of the MAIN TEACHER TEAMLEAD task</label>";
	
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>

&nbsp;&nbsp;
<?php //echo getInput(stripslashes($_POST['fromDate-day']),'fromDate-day','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php// echo getInput(stripslashes($_POST['toDate-day']),'toDate-day','class=flexy_datepicker_input');?>


<?php
//getStudentFilter();
//getTeamLeadTeacherFilter();
//getAgentFilter();
//getStatusFilter();

getStatusFilter_with_makeover();
getTeacherFilterLead();
getTeacherFilter();
?>
<br><br>
<?php
getTeacherFilterLead_main();
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Dead - Regular</b></th>"; 
echo "<th class='specalt'><b>Dead - Trial</b></th>"; 
echo "<th class='specalt'><b>Dead - Make Over</b></th>"; 
echo "</tr>"; 
echo "<tr>"; 
echo "<td class='specalt'><b>".getCheckbox($_POST['stdStatus_deadReg'],'stdStatus_deadReg')."</b></td>"; 
echo "<td class='specalt'><b>".getCheckbox($_POST['stdStatus_deadTrl'],'stdStatus_deadTrl')."</b></td>"; 
echo "<td class='specalt'><b>".getCheckbox($_POST['stdStatus_deadMO'],'stdStatus_deadMO')."</b></td>"; 
echo "</tr>";
echo "</table>";
getFilterSubmit();
//NEWLY ADDED
echo "<br><br><br>";
echo "<label style='color:green'>Old Teacher Dropdown List ( Apply Dead Filter ):</label>";
echo getDataList_active_deactive_teachers(stripslashes($_POST['teacher_old']),'teacher_old',3);

//NEWLY ADDED on 17-05-2014
echo "<br><br><br>";
echo "<label style='color:green'>Checkbox to get Confirm DEAD DATE SCHEDULES</label>";
echo getCheckbox($_POST['stdStatus_confirmdead'],'stdStatus_confirmdead');
?>
<br><br>
</div>
</form>
<?
//////////////////////////////////////////////////////
$lead_id_array=array('454','76','347','704','707',''); 
//This is manual method, No need to make array of TEACHER TEAMLEADS, Just match the teachers and 
//GROUP BY capmus_users.LeadId
/////////////////////////////////////////////////////
$fromDate='2015-08-01'; //<<< Change the DATES FILTER for REGULAR-DEAD LATER	fromDate
$toDate='2016-01-11';	//<<< Change the DATES FILTER for REGULAR-DEAD LATER	toDate
$std_status=3;
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Main Team Lead Name</b></th>";  
echo "<th class='specalt'><b>Team Lead Name</b></th>";  
echo "<th class='specalt'><b>Dues CAD</b></th>";
echo "<th class='specalt'><b>Dues USD</b></th>";
echo "<th class='specalt'><b>Status(Old)</b></th>"; 
echo "<th class='specalt'><b>Status(Current)</b></th>"; 
echo "</tr>"; 

	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,
	campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,
	SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,
	campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.dead_reason 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID ");
	
	//TEACHER TEAMLEAD(NOT MAIN)//$_POST['search-teacher-id2']!=0 && !empty($_POST['search-teacher-id2'])
	if($LeadId!=0)
	{
		//$sql.= " and capmus_users.LeadId=".$LeadId;
	}
	
	//STUDENT STATUS - current(which will be dead)
	if($std_status!='' && $std_status==3)
	{
		$sql.= " and campus_schedule.std_status_old = 2 and campus_schedule.std_status = ".$std_status;
	}
	//STUDENT STATUS - Applying condition on old
		if(isset($_POST['stdStatus_deadReg']) && !empty($_POST['stdStatus_deadReg']))
		{
			$sql.= " and campus_schedule.std_status_old = 2 ";
		}
	
	if($fromDate!="" && $toDate!="" && $std_status==3)
	{
		$sql.=" and DATE(campus_schedule.confirm_dead_date)>= '".$fromDate."' and 
		DATE(campus_schedule.confirm_dead_date)<= '".$toDate."'";
	}

	$sql.="  and campus_schedule.status=1 and campus_schedule.teacherID!=0 
	GROUP BY capmus_users.LeadId   
	ORDER BY campus_schedule.confirm_dead_date ASC";
	//echo $sql;
	$result=mysql_query($sql) or trigger_error(mysql_error());

$rows_count = mysql_num_rows($result);
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rows_count." &nbsp;&nbsp;&nbsp;</div><br></b>";

while($row = mysql_fetch_array($result)){ 
//Getting student number
$query="select `campus_students`.id as stu_id,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
////////////////////////
$sum=$row['dues'];
$sum_dues[$row['sch_id']]=$sum;

echo "<tr>";  
echo "<td valign='top' style='color:red; font-weight:bold'>" . showUser(nl2br( $row['main_LeadId'])) . "</td>"; 
echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row['LeadId'])) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";
	//Get 1 cad to usd rate from db
	$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency  ";
	if($_POST['stdStatus']==2) { $sql_1cad_to_dollar_rate_USDval.=" WHERE date ='".$row['paydate']."' "; }
	else if($_POST['stdStatus']==3) { $sql_1cad_to_dollar_rate_USDval.=" WHERE date ='".$row['dead_date']."' "; }
	else { $sql_1cad_to_dollar_rate_USDval.=" WHERE id = (SELECT MAX(id) FROM campus_currency) "; }
	$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
	$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	if($row_1cad_to_dollar_rate_USDval['1_cad_to_usd']=='')
	{
		//Get 1 cad to usd rate from db
		$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
		$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
		$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	} 
	//DUES USD
	echo "<td valign='top'>" . $sum_usd_result = round($row['dues'] * $row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
	$sum_usd=$sum_usd_result ;
	$sum_dues_usd[$row['sch_id']]=$sum_usd;
echo "<td valign='top'>" . getData(nl2br( $row['std_status_old']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 
echo "</tr>"; 
}
echo "<tr>";  
echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum </td>";  
echo "<td valign='top'><b>$" . array_sum($sum_dues)  . "</td>";  
echo "<td valign='top'><b>$" . array_sum($sum_dues_usd)  . "</td>";   
echo "<td valign='top'></td>";
echo "</tr>";
echo "<tr>";  
echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum/90 </td>";  
echo "<td valign='top'><b>$" . array_sum($sum_dues)/90  . "</td>";  
echo "<td valign='top'><b>$" . array_sum($sum_dues_usd)/90  . "</td>";  
echo "<td valign='top'></td>";
echo "</tr>"; 
echo "</table>"; 

?>
<?php include('include/footer.php');?>