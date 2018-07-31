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


//Table for SIGNUPS
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
//Signup	***************************
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Student Signup Count - CCMS</b></th>"; 
echo "<th class='specalt'><b>Signup Amt</b></th>"; 
echo "<th class='specalt'><b>Signup Count at 90 Dollars</b></th>"; 
echo "<th class='specalt'><b>Result</b></th>"; 
echo "</tr>"; 


$total_signup_sum_array=array();
$total_signup_amount_sum_array=array();	
$total_signup_commision_sum_array=array();	

//Number of Sign Ups at 90 dollars
$total_signup_at_90=array();
$result_of_total_signup_at_90=array();

	//FROM Date and TO Date
	$fd = prepareDate($_POST['fromDate']);
	$td = prepareDate($_POST['toDate']);
	$sch_id_count=1;


	//search how to count present only once in mysql and check it against other table? on GOOGLE
	//http://stackoverflow.com/questions/14180997/select-a-value-from-mysql-database-only-in-case-it-exists-only-once
	//http://stackoverflow.com/questions/10239390/select-countid-from-one-table-where-that-id-is-present-in-another-table-mysql
	//VERY USEFUL QUERIES FOR DISTINCT
	
	//how to get the first value in DISTINCT in mysql-search tomorrow
		$agent_comm_signup="SELECT  
		campus_schedule.id as sch_id,campus_schedule.std_status,campus_schedule.std_status_old,
		count(campus_schedule.studentID) as cam_stu_id,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,SUM(campus_schedule.dues) as dues_cnt_comm_signup 
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
			echo "<td valign='top'> " . $total_signup_sum_array[$sch_id_count] = $row_agent_comm_signup['cam_stu_id'] . "</td>";
			echo "<td valign='top'> " . $total_signup_amount_sum_array[$sch_id_count] = $row_agent_comm_signup['dues_cnt_comm_signup'] . "</td>";
			
			//Number of signups at the signup amount of 90
			echo "<td valign='top'> " . $total_signup_at_90[$sch_id_count] = number_format(($row_agent_comm_signup['dues_cnt_comm_signup']/90),2) . "</td>";		
			
			
			//!!!!!!!!!!!!!!!!!!! 1 - 8
			if($total_signup_at_90[$sch_id_count]<=8)
			{
				$result_of_total_signup_at_90[$sch_id_count] = $total_signup_at_90[$sch_id_count] * 2500;
				
				//COMMISSION
				echo "<td valign='top'> " . $result_of_total_signup_at_90[$sch_id_count] . "</td>";		
			}
			//!!!!!!!!!!!!!!!!!!! >8 - <=15			
			if($total_signup_at_90[$sch_id_count]>8 && $total_signup_at_90[$sch_id_count]<=15)
			{
				$cap_8 = 8;$cap_15 = 15;
				//1 to 8 range, Multiply 2500 by 8 anyway
				$first_cap8_multiply = $cap_8 * 2500;//*****
				//Subtract 8 from total signup
				$get_cap_15_su_minus_cap_8 = $total_signup_at_90[$sch_id_count]-8;
				//Result that comes under 8 to 15 range, Multiply 3000 by $get_cap_15_su_minus_cap_8 anyway
				$RESULT_get_cap_15_su_minus_cap_8 = $get_cap_15_su_minus_cap_8 * 3000;//******
				
				//COMMISSION
				$result_of_total_signup_at_90[$sch_id_count] = $first_cap8_multiply + $RESULT_get_cap_15_su_minus_cap_8;
				echo "<td valign='top'> " . $result_of_total_signup_at_90[$sch_id_count] . "</td>";
			}
			//!!!!!!!!!!!!!!!!!!! >15
			if($total_signup_at_90[$sch_id_count]>15)
			{
				$cap_8 = 8;$cap_15 = 15;
				//1 to 8 range, Multiply 2500 by 8 anyway
				$first_cap8_multiply = $cap_8 * 2500;//**************
				//Subtract 8 from 15 to get the range for 3000
				$range_8_to_15 = $cap_15 - 8.01;
				$second_cap15_multiply= $range_8_to_15 * 3000;//**************
				//Subtract 15 above to get the range for 6000
				$range_15_above = $total_signup_at_90[$sch_id_count] - 15;
				$third_cap15_above = $range_15_above * 6000;//**************
				
				//
				$RESULT_all_sum = $first_cap8_multiply + $second_cap15_multiply + $third_cap15_above;
				$result_of_total_signup_at_90[$sch_id_count] = $RESULT_all_sum ;
				echo "<td valign='top'> " . $result_of_total_signup_at_90[$sch_id_count] . "</td>";
			}
			
		$sch_id_count=$sch_id_count+1;
		
		echo "</tr>";
		}
echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red;'><b>" . nl2br( array_sum($total_signup_sum_array)) . "</td>";
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($total_signup_amount_sum_array)) . "</td>";   
echo "<td valign='top' style='color:red;'><b>" . nl2br( array_sum($total_signup_at_90)) . "</td>";   
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($result_of_total_signup_at_90)) . "</td>";   
echo "</tr>";
echo "</table>"; 
}
include('include/footer.php');
?>