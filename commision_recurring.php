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




//Table for Recurring Paid students
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 

//Recurring PAID students	***************************
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>Total Recurr stu</b></th>"; 
echo "<th class='specalt'><b>Amount</b></th>"; 
echo "<th class='specalt'><b>5%-3%-0%</b></th>"; 
echo "<th class='specalt'><b>% Amount($)</b></th>"; 
echo "<th class='specalt'><b>% Amount(RS)-Recurring</b></th>";
echo "</tr>"; 
//Array for Recurring Paid students

	
$total_regular_sum_array=array();
$total_amount_sum_array=array();

//SUBARRAYS
$total_dollar_percentage_sum_array=array();
$total_rs_percentage_sum_array=array();

$total_recurr_paid_amount_commision_RUPEES_SUM=array();

	/*$sql_recurr_paid_stu=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,count(campus_schedule.studentID) as cnt_regular_for_recurr,
	campus_schedule.courseID,campus_schedule.teacherID,
	campus_schedule.classType,campus_schedule.`status`,campus_schedule.`status_dead`,
	campus_schedule.std_status,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	SUM(campus_transaction.amount) as amounttran_sum,
	campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.teacherID as tran_tID 
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id and  
	campus_schedule.std_status=2 and 
	campus_transaction.teacherID=campus_schedule.teacherID and 
	campus_schedule.duedate!=campus_transaction.date and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!=''";
	echo $sql_recurr_paid_stu.="  GROUP BY campus_transaction.teacherID,campus_schedule.std_status ";*/
	
	/*$sql_recurr_paid_stu=" SELECT count(campus_transaction.studentID) as cnt_regular_for_recurr,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,
	SUM(campus_transaction.amount) as amounttran_sum,
	campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.teacherID as tran_tID 
	FROM campus_transaction 
	WHERE campus_transaction.dateRecieved!=campus_transaction.date and  
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!=''";
	$sql_recurr_paid_stu.="  GROUP BY campus_transaction.teacherID";*/
	
	$sql_recurr_paid_stu=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,
	campus_schedule.courseID,campus_schedule.teacherID,
	campus_schedule.classType,campus_schedule.`status`,campus_schedule.`status_dead`,
	campus_schedule.std_status,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,count(campus_transaction.studentID) as cnt_regular_for_recurr,
	SUM(campus_transaction.amount) as amounttran_sum,
	campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.teacherID as tran_tID 
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and 
	campus_schedule.id=campus_transaction.schedule_id and  
	campus_schedule.duedate!=campus_transaction.date and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!=''";
	$sql_recurr_paid_stu.="  GROUP BY campus_transaction.teacherID ";
	
$result_sql_recurr_paid_stu = mysql_query($sql_recurr_paid_stu);
// Following while and the conditions inside it are for RECURRING PAID STUDENTS(similar to PAYMENT RECORD REPORT)
while($row_sql_recurr_paid_stu = mysql_fetch_array($result_sql_recurr_paid_stu))
	{
	$total_regular_sum_array[$row_sql_recurr_paid_stu['tran_id']] = $row_sql_recurr_paid_stu['cnt_regular_for_recurr'];
	$total_amount_sum_array[$row_sql_recurr_paid_stu['tran_id']] = $row_sql_recurr_paid_stu['amounttran_sum'];
		echo "<tr>";
		echo "<td valign='top'>" . showUser(nl2br( $row_sql_recurr_paid_stu['tran_tID'])) . "</td>";
		echo "<td valign='top'>" . $row_sql_recurr_paid_stu['cnt_regular_for_recurr'] . "</td>";
		echo "<td valign='top'>$ " . $row_sql_recurr_paid_stu['amounttran_sum'] . "</td>";
		
		//**************CELL FOR THE 5 - 3 - 0 % **************
		if(($row_sql_recurr_paid_stu['cnt_regular_for_recurr'] >=10) && ($row_sql_recurr_paid_stu['cnt_regular_for_recurr']<12))
		{
			// 3 % commision if recurring paid students is >=10 and less than 12
			echo "<td valign='top'>" . $total_recurr_paid_amount_commision_percentage =  (3). "%</td>";
		}
		if($row_sql_recurr_paid_stu['cnt_regular_for_recurr'] >= 12)
		{
			// 5 % commision if recurring paid students is >=12
			echo "<td valign='top'>" . $total_recurr_paid_amount_commision_percentage = (5). "%</td>";
		}
		if($row_sql_recurr_paid_stu['cnt_regular_for_recurr'] < 10)
		{
			// NO commision of RECURR PAID STUDENTS
			echo "<td valign='top'>" . $total_recurr_paid_amount_commision_percentage = (0) . "%</td>";
		}
		
		//**************CELL for the % AMOUNT related to 5% - 3% - 0% IN DOLLARS **************
		if(($row_sql_recurr_paid_stu['cnt_regular_for_recurr'] >=10) && ($row_sql_recurr_paid_stu['cnt_regular_for_recurr']<12))
		{
			// 3 % commision if recurring paid students is >=10 and less than 12
			echo "<td valign='top'>$" . $total_recurr_paid_amount_commision_DOLLAR = ($row_sql_recurr_paid_stu['amounttran_sum'])* (3/100). "</td>";
		}
		if($row_sql_recurr_paid_stu['cnt_regular_for_recurr'] >= 12)
		{
			// 5 % commision if recurring paid students is >=12
			echo "<td valign='top'>$" . $total_recurr_paid_amount_commision_DOLLAR = ($row_sql_recurr_paid_stu['amounttran_sum'])* (5/100). "</td>";
		}
		if($row_sql_recurr_paid_stu['cnt_regular_for_recurr'] < 10)
		{
			// NO commision of RECURR PAID STUDENTS
			echo "<td valign='top'>$" . $total_recurr_paid_amount_commision_DOLLAR = ($row_sql_recurr_paid_stu['amounttran_sum'])* (0) . "</td>";
		}
		
		//**************CELL for the % AMOUNT related to 5% - 3% - 0% IN RUPEES  **************
		if(($row_sql_recurr_paid_stu['cnt_regular_for_recurr'] >=10) && ($row_sql_recurr_paid_stu['cnt_regular_for_recurr']<12))
		{
			// 3 % commision if recurring paid students is >=10 and less than 12
			echo "<td valign='top'>Rs. " . $total_recurr_paid_amount_commision_Rs = ($row_sql_recurr_paid_stu['amounttran_sum'])* (3/100) * ($_POST['exchange_rate']). "</td>";
		}
		if($row_sql_recurr_paid_stu['cnt_regular_for_recurr'] >= 12)
		{
			// 5 % commision if recurring paid students is >=12
			echo "<td valign='top'>Rs. " . $total_recurr_paid_amount_commision_Rs = ($row_sql_recurr_paid_stu['amounttran_sum'])* (5/100) * ($_POST['exchange_rate']). "</td>";
		}
		if($row_sql_recurr_paid_stu['cnt_regular_for_recurr'] < 10)
		{
			// NO commision of RECURR PAID STUDENTS
			echo "<td valign='top'>Rs. " . $total_recurr_paid_amount_commision_Rs = ($row_sql_recurr_paid_stu['amounttran_sum'])* (0) * ($_POST['exchange_rate']) . "</td>";
		}
		$total_dollar_percentage_sum_array[$row_sql_recurr_paid_stu['tran_id']]=$total_recurr_paid_amount_commision_DOLLAR;
		$total_rs_percentage_sum_array[$row_sql_recurr_paid_stu['tran_id']]=$total_recurr_paid_amount_commision_Rs;
		echo "</tr>"; 	
	}
echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red;'><b>" . nl2br( array_sum($total_regular_sum_array)) . "</td>";
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($total_amount_sum_array)) . "</td>";   
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($total_dollar_percentage_sum_array)) . "</td>";
echo "<td valign='top' style='color:red;'><b>Rs. " . nl2br( array_sum($total_rs_percentage_sum_array)) . "</td>";
echo "</tr>";
echo "</table>"; 
}


include('include/footer.php');
?>