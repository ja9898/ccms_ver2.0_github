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

<div id="label">CAD to PKR(Enter exchange rate):</div>
<div id="field"><input name="exchange_rate" type="number" id="exchange_rate"  /></div> 

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


//Table for SIGNUPS
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
//Signup	***************************
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>Signup</b></th>"; 
echo "<th class='specalt'><b>Signup Amt</b></th>"; 
echo "<th class='specalt'><b>Signup Commision</b></th>"; 
echo "</tr>"; 



$total_signup_sum_array=array();
$total_signup_amount_sum_array=array();	
$total_signup_commision_sum_array=array();	
//Following query is written to get the TEACHERS names in one GO and pass it to the following WHILE LOOP
$total_trial_cnt="SELECT * FROM capmus_users WHERE user_type=3";
	
	//FROM Date and TO Date
	$fd = prepareDate($_POST['fromDate']);
	$td = prepareDate($_POST['toDate']);
	$sch_id_count=1;

	$result_total_trial_cnt=mysql_query($total_trial_cnt);
	while($row_total_trial_cnt = mysql_fetch_array($result_total_trial_cnt)){
	//search how to count present only once in mysql and check it against other table? on GOOGLE
	//http://stackoverflow.com/questions/14180997/select-a-value-from-mysql-database-only-in-case-it-exists-only-once
	//http://stackoverflow.com/questions/10239390/select-countid-from-one-table-where-that-id-is-present-in-another-table-mysql
	//VERY USEFUL QUERIES FOR DISTINCT
	
	//how to get the first value in DISTINCT in mysql-search tomorrow
		$trial_pre_then_reg="SELECT  
		campus_schedule.id as sch_id,campus_schedule.std_status as sch_status,campus_schedule.std_status_old as sch_status_old,
		count(DISTINCT campus_schedule.studentID) as cam_stu_id,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,SUM(DISTINCT campus_schedule.dues) as dues_cnt_trial_to_regular,
		campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
		campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
		campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
		FROM campus_schedule 
		INNER JOIN campus_attendance_student ON 
		campus_attendance_student.teacherID='".$row_total_trial_cnt['id']."' and 
		campus_schedule.id=campus_attendance_student.schedule_id and 
		campus_attendance_student.std_status=1 and campus_attendance_student.status=1 and 
		campus_schedule.status=1 and 
		campus_schedule.teacherID!=0 and campus_schedule.studentID=campus_attendance_student.studentID ";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$trial_pre_then_reg.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		$trial_pre_then_reg.="  GROUP BY campus_schedule.teacherID ORDER BY campus_schedule.teacherID";

		/*
		$trial_pre_then_reg="SELECT  
		campus_schedule.id as sch_id,campus_schedule.std_status as sch_status,campus_schedule.std_status_old as sch_status_old,
		count(DISTINCT campus_schedule.studentID) as cam_stu_id,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,SUM(DISTINCT campus_schedule.dues) as dues_cnt_trial_to_regular,
		campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
		campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
		campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
		FROM campus_schedule 
		INNER JOIN campus_attendance_student ON 
		campus_attendance_student.teacherID='".$row_total_trial_cnt['id']."' and 
		campus_schedule.id=campus_attendance_student.schedule_id and 
		campus_schedule.std_status_old=1 and campus_attendance_student.std_status=1 and campus_attendance_student.status=1 and 
		campus_schedule.status=1 and campus_schedule.status_dead=0 and 
		campus_schedule.teacherID!=0 and campus_schedule.std_status=2 and campus_schedule.studentID=campus_attendance_student.studentID ";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$trial_pre_then_reg.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		echo $trial_pre_then_reg.="  GROUP BY campus_schedule.teacherID ORDER BY campus_schedule.teacherID";
		*/
		
		$trial_pre_then_reg = mysql_query($trial_pre_then_reg) or trigger_error(mysql_error());
		while($row_trial_pre_then_reg = mysql_fetch_array($trial_pre_then_reg))
		{
		echo "<tr>";
			
			echo "<td valign='top'>" . "<a href=schedule_with_teamlead_commision.php?signup_id={$row_trial_pre_then_reg['sa_tid']}&fromdate={$fd}&todate={$td} target='_blank'>" . showUser(nl2br( $row_trial_pre_then_reg['sa_tid'])) . "</td>";
			//echo "<td valign='top'>" . showUser(nl2br( $row_trial_pre_then_reg['sa_tid'])) . "</td>";
			echo "<td valign='top'> " . $total_signup_sum_array[$sch_id_count] = $row_trial_pre_then_reg['cam_stu_id'] . "</td>";
			echo "<td valign='top'> " . $total_signup_amount_sum_array[$sch_id_count] = $row_trial_pre_then_reg['dues_cnt_trial_to_regular'] . "</td>";
			echo "<td valign='top'> " . $total_signup_commision_sum_array[$sch_id_count] = (($total_signup_amount_sum_array[$sch_id_count]) / 90) * (500) . "</td>";		
		$sch_id_count=$sch_id_count+1;
		}
		echo "</tr>";
	}
echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red;'><b>" . nl2br( array_sum($total_signup_sum_array)) . "</td>";
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($total_signup_amount_sum_array)) . "</td>";   
echo "<td valign='top' style='color:red;'><b>Rs." . nl2br( array_sum($total_signup_commision_sum_array)) . "</td>";   
echo "</tr>";
echo "</table>"; 




}


include('include/footer.php');
?>