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
echo "<th class='specalt'><b>Management</b></th>"; 
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
	//and campus_schedule.management_comm_Id!='' and campus_schedule.management_comm_Id!=0
	//HAVING (campus_schedule.status_dead=0 AND campus_schedule.std_status_old=1 AND campus_schedule.std_status=2) OR (campus_schedule.status_dead=1 AND campus_schedule.std_status_old=2 AND campus_schedule.std_status=3)
		$management_comm_signup="SELECT  
		campus_schedule.id as sch_id,campus_schedule.std_status,campus_schedule.std_status_old,
		count(campus_schedule.studentID) as cam_stu_id,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,campus_schedule.management_comm_Id,
		SUM(campus_schedule.dues) as dues_cnt_comm_signup    
		FROM campus_schedule 
		WHERE campus_schedule.`status`=1 ";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$management_comm_signup.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		$management_comm_signup.="  GROUP BY campus_schedule.management_comm_Id  
		HAVING (campus_schedule.status_dead=0 AND campus_schedule.std_status_old=1 AND campus_schedule.std_status=2) OR (campus_schedule.status_dead=1 AND campus_schedule.std_status_old=2 AND campus_schedule.std_status=3)";

		$result_management_comm_signup = mysql_query($management_comm_signup) or trigger_error(mysql_error());
				echo $num_of_rows = mysql_num_rows($result_management_comm_signup);echo "<br>";
		while($row_management_comm_signup = mysql_fetch_array($result_management_comm_signup))
		{
		echo "<tr>";
			echo "<td valign='top'>" . "<a href=schedule_with_teamlead_commision.php?management_id={$row_management_comm_signup['management_comm_Id']}&fromdate={$fd}&todate={$td} target='_blank'>" . showUser(nl2br( $row_management_comm_signup['management_comm_Id'])) . "</td>";
			//Number of Signups accoridng to CCMS students
			echo "<td valign='top'> " . $total_signup_sum_array[$sch_id_count] = $row_management_comm_signup['cam_stu_id'] . "</td>";
			echo "<td valign='top'> " . $total_signup_amount_sum_array[$sch_id_count] = $row_management_comm_signup['dues_cnt_comm_signup'] . "</td>";
			//Number of signups at the signup amount of 90
			echo "<td valign='top'> " . $total_signup_at_90[$sch_id_count] = number_format(($row_management_comm_signup['dues_cnt_comm_signup']/90),2) . "</td>";		
				$result_of_total_signup_at_90[$sch_id_count] = $total_signup_at_90[$sch_id_count] * 1000;
			//COMMISSION
			echo "<td valign='top'> " . $result_of_total_signup_at_90[$sch_id_count] . "</td>";		
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