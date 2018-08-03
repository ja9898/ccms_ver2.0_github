<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 
//getTeacherFilter();
?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
</div>
<br><br>
<div style="float:left">
<?php
getFilterSubmit();
?></div>
<br>

</form>
</div>
<?
if(isset($_POST['search-submit']))
{
//TRAILS ONLY
echo "<table  border=0 id='table_liquid' cellspacing=0 >";
echo "<tr>"; 
echo "<th class='specalt'><b>Student Name</b></th>"; 
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>Booked Date</b></th>"; 
echo "<th class='specalt'><b>Status</b></th>"; 
echo "</tr>"; 

if($_SESSION['userType']==5)
{
	//$_sql.=" Where agent_id='".$_SESSION['userId']."'";
	//$result = getResultResource('campus_schedule',$_POST," agent_id='".$_SESSION['userId']."'","","","","");
}

else
{
	$sql_trial=("SELECT * FROM campus_schedule WHERE campus_schedule.std_status = 1");
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql_trial.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."' ";
	}
	$result=mysql_query($sql_trial);
}
$rowcount = mysql_num_rows($result);	
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rowcount." &nbsp;&nbsp;&nbsp;</div><br></b>";
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['agentId'])) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dateBooked']) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatus') . "</td>";
echo "</tr>"; 
} 
echo "</table>"; 











//Table for SHOWUP TRIALS
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
//Signup	***************************
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Trial count</b></th>"; 
echo "<th class='specalt'><b>Teachers</b></th>";
echo "<th class='specalt'><b>student</b></th>"; 
echo "<th class='specalt'><b>bookdate</b></th>"; 
echo "<th class='specalt'><b>show up trial[student]</b></th>"; 
echo "<th class='specalt'><b>Signup Amt(CAD)</b></th>"; 
echo "<th class='specalt'><b>Signup Amt(USD)</b></th>"; 
//echo "<th class='specalt'><b>Signup Commision</b></th>"; 
echo "</tr>"; 
	

//Following arrays added for trials
$total_trial_schedule=array();

$total_trial_showup_cnt_array=array();
$total_signup_amount_sum_array=array();

//Following query is written to get the TEACHERS names in one GO and pass it to the following WHILE LOOP
$total_trial_cnt="SELECT * FROM capmus_users WHERE user_type=5 and status=1";
	
	//FROM Date and TO Date
	$fd = prepareDate($_POST['fromDate']);
	$td = prepareDate($_POST['toDate']);
	$sch_id_count=1;
	
	//Get 1 cad to usd rate from db
	$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
	$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
	$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	//Arrays for the Amount sum
	$usd_amt=array();
	
	$result_total_trial_cnt=mysql_query($total_trial_cnt);
	while($row_total_trial_cnt = mysql_fetch_array($result_total_trial_cnt)){
	//search how to count present only once in mysql and check it against other table? on GOOGLE
	//http://stackoverflow.com/questions/14180997/select-a-value-from-mysql-database-only-in-case-it-exists-only-once
	//http://stackoverflow.com/questions/10239390/select-countid-from-one-table-where-that-id-is-present-in-another-table-mysql
	//VERY USEFUL QUERIES FOR DISTINCT
	//how to get the first value in DISTINCT in mysql-search tomorrow
		//campus_attendance_student.teacherID='".$row_total_trial_cnt['id']."' and 
		
		$trial_pre_then_reg="SELECT  
		campus_schedule.id as sch_id,
		campus_schedule.std_status_old as sch_status_old,
		count(DISTINCT campus_schedule.studentID) as cam_stu_id,
		count(campus_schedule.std_status) as cam_stu_status,
		campus_schedule.courseID,
		campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,
		campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,
		SUM(DISTINCT campus_schedule.dues) as dues_cnt_trial_to_regular,
		campus_attendance_student.id as sa_id,
		campus_attendance_student.studentID as sa_sid,
		campus_attendance_student.teacherID as sa_tid,
		campus_attendance_student.startTime as sa_st,
		campus_attendance_student.courseID as sa_cid,
		campus_attendance_student.classType as sa_CT,
		campus_attendance_student.std_status as sa_SS,
		campus_attendance_student.status as sa_S,
		campus_attendance_student.date as sa_date 
		FROM campus_schedule 
		INNER JOIN campus_attendance_student ON 
		campus_schedule.id=campus_attendance_student.schedule_id and 
		campus_schedule.agentId='".$row_total_trial_cnt['id']."' and 
		campus_attendance_student.std_status=1 AND
		campus_attendance_student.status=1 and 
		campus_schedule.status=1 and 
		campus_schedule.teacherID!=0 and 
		campus_schedule.studentID=campus_attendance_student.studentID ";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$trial_pre_then_reg.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'
			and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."' ";
		}
		$trial_pre_then_reg.="  GROUP BY campus_schedule.agentId,campus_schedule.teacherID  
		ORDER BY campus_schedule.teacherID 
		 ";
		//campus_schedule.teacherID 
		$trial_pre_then_reg = mysql_query($trial_pre_then_reg) or trigger_error(mysql_error());
		while($row_trial_pre_then_reg = mysql_fetch_array($trial_pre_then_reg))
		{
		echo "<tr>";
			echo "<td valign='top'>" . showUser(nl2br( $row_trial_pre_then_reg['agentId'])) . "</td>";
			echo "<td valign='top'> " . $total_trial_schedule[$sch_id_count] = $row_trial_pre_then_reg['cam_stu_status'] . "</td>";
			echo "<td valign='top'>" . "<a href=schedule_with_teamlead_commision.php?signup_id={$row_trial_pre_then_reg['sa_tid']}&fromdate={$fd}&todate={$td} target='_blank'>" . showUser(nl2br( $row_trial_pre_then_reg['sa_tid'])) . "</td>";
			echo "<td valign='top'>" . showStudents(nl2br( $row_trial_pre_then_reg['sa_sid'])) . "</td>";			
			echo "<td valign='top'>" . $row_trial_pre_then_reg['dateBooked'] . "</td>";
			echo "<td valign='top'> " . $total_trial_showup_cnt_array[$sch_id_count] = $row_trial_pre_then_reg['cam_stu_id'] . "</td>";
			echo "<td valign='top'> " . $total_signup_amount_sum_array[$sch_id_count] = $row_trial_pre_then_reg['dues_cnt_trial_to_regular'] . "</td>";
			echo "<td valign='top'> " . $usd_amt[$sch_id_count] = round($row_trial_pre_then_reg['dues_cnt_trial_to_regular']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'],2) . "</td>";
			///echo "<td valign='top'> " . $total_signup_commision_sum_array[$sch_id_count] = (($total_signup_amount_sum_array[$sch_id_count]) / 90) * (500) . "</td>";		
		$sch_id_count=$sch_id_count+1;
		}
		echo "</tr>";
	}
echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red;'><b>" . nl2br( array_sum($total_trial_showup_cnt_array)) . "</td>";
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($total_signup_amount_sum_array)) . "</td>";   
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($usd_amt)) . "</td>";   
echo "</tr>";
echo "</table>"; 










//<<<<<<<<<<<<<<<<<<< SIGNUP PORTION >>>>>>>>>>>>>>>>>>>
//Table for SIGNUPS
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
//Signup	***************************
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Student Signup Count - CCMS</b></th>"; 
echo "<th class='specalt'><b>Signup Amt(CAD)</b></th>";
echo "<th class='specalt'><b>Signup Amt(USD)</b></th>";
echo "</tr>"; 


$total_signup_amount_sum_array_current_date=array();
$total_signup_amount_sum_array_till_date=array();	
$total_signup_count=array();	

//Number of Sign Ups at 90 dollars
$total_signup_at_90=array();
$result_of_total_signup_at_90=array();

	//FROM Date and TO Date
	$fd = prepareDate($_POST['fromDate']);
	$td = prepareDate($_POST['toDate']);
	$sch_id_count=1;
	//Arrays for the Amount sum
	$usd_amt=array();

	//search how to count present only once in mysql and check it against other table? on GOOGLE
	//http://stackoverflow.com/questions/14180997/select-a-value-from-mysql-database-only-in-case-it-exists-only-once
	//http://stackoverflow.com/questions/10239390/select-countid-from-one-table-where-that-id-is-present-in-another-table-mysql
	//VERY USEFUL QUERIES FOR DISTINCT
	
	//how to get the first value in DISTINCT in mysql-search tomorrow
		$agent_comm_signup="SELECT  
		campus_schedule.id as sch_id,campus_schedule.std_status,
		campus_schedule.std_status_old,
		count(campus_schedule.studentID) as cam_stu_id,campus_schedule.courseID,
		campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,
		campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,
		SUM(campus_schedule.dues) as dues_cnt_comm_signup_till_date  
		FROM campus_schedule 
		WHERE campus_schedule.`status`=1 ";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$agent_comm_signup.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		$agent_comm_signup.="  GROUP BY campus_schedule.agentId
		HAVING (campus_schedule.status_dead=0 AND campus_schedule.std_status_old=1 AND campus_schedule.std_status=2) OR (campus_schedule.status_dead=1 AND campus_schedule.std_status_old=2 AND campus_schedule.std_status=3)";

		$result_agent_comm_signup = mysql_query($agent_comm_signup) or trigger_error(mysql_error());
		while($row_agent_comm_signup = mysql_fetch_array($result_agent_comm_signup))
		{
		echo "<tr>";
			echo "<td valign='top'>" . "<a href=schedule_with_teamlead_commision.php?agentId={$row_agent_comm_signup['agentId']}&fromdate={$fd}&todate={$td} target='_blank'>" . showUser(nl2br( $row_agent_comm_signup['agentId'])) . "</td>";
			//Number of Signups accoridng to CCMS students
			echo "<td valign='top'> " . $total_signup_count[$sch_id_count] = $row_agent_comm_signup['cam_stu_id'] . "</td>";
			
			//echo "<td valign='top'> " . $total_signup_amount_sum_array_current_date[$sch_id_count] = $row_agent_comm_signup['dues_cnt_comm_signup_curr_date'] . "</td>";
			echo "<td valign='top'> " . $total_signup_amount_sum_array_till_date[$sch_id_count] = $row_agent_comm_signup['dues_cnt_comm_signup_till_date'] . "</td>";
			echo "<td valign='top'> " . $usd_amt[$sch_id_count] = round($row_agent_comm_signup['dues_cnt_comm_signup_till_date']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'],2) . "</td>";
			
		$sch_id_count=$sch_id_count+1;
		
		echo "</tr>";
		}
echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red;'><b>" . nl2br( array_sum($total_signup_count)) . "</td>";
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($total_signup_amount_sum_array_till_date)) . "</td>";   
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($usd_amt)) . "</td>";   
echo "</tr>";
echo "</table>";







}
include('include/footer.php');
?>