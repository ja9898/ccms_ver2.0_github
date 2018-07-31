<? 
include('config.php'); 
include('include/header.php');


if(isset($_POST['submit']))
{
	
 //and campus_schedule.std_status=2 
 //NO CONDITION ON REGULAR STUDENTS TRANSACTION, all include, regular, dead, freeze
 	$sql=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original,campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	campus_transaction.accounts_chk  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' ";
	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql.=" and campus_transaction.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-main']!=0)
	{
		$sql.=" and campus_transaction.main_LeadId='".$_POST['search-teacher-main']."' ";
	}
	if(isset($_POST['submit']) && $_POST['paymentMode']!=0)
	{
		$sql.=" and campus_transaction.method_array='".$_POST['paymentMode']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
	{
		$sql.=" and campus_transaction.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['recurr_signup']!=0)
	{
		if($_POST['recurr_signup']==2)
		$sql.=" and campus_transaction.campus=1 ";
		if($_POST['recurr_signup']==1)
		$sql.=" and campus_transaction.campus IS NULL ";
	}
}
 

?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php if($_SESSION['userType']==1 || $_SESSION['userType']==15 || $_SESSION['userType']==6 || $_SESSION['userType']==8) { getTeacherFilterLead_main(); getTeacherFilterLead(); getTeacherFilter();  } ?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
<br /><br />
</div>

<? 

	//Get 1 cad to usd rate from db
	$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
	$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
	$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];

	date("F", strtotime("-3 months"));echo "<br>";
	date("F", strtotime("-2 months"));echo "<br>";
	date("F", strtotime("-1 months"));echo "<br>";
	
	$first_month_number = date("m", strtotime("-3 months"));echo "<br>";
	$second_month_number = date("m", strtotime("-2 months"));echo "<br>";
	$third_month_number = date("m", strtotime("-1 months"));echo "<br>";
	
	//DO USE FOLLOWING LATER - it is useful
	/* 
	if(date("F")=='January')
	{
		$year = date('Y')-1;
	}
	else
	{
		$year = date('Y');
	}
	
	//1st Month
	echo $first_month_number_FROMDATE = $year."-".$first_month_number."-"."01";echo "<br>";
	echo $number_of_days_first_month_number = date('t',strtotime($first_month_number_FROMDATE));echo "<br>";
	echo $first_month_number_TODATE = $year."-".$first_month_number."-".$number_of_days_first_month_number;echo "<br>";
	
	//2nd Month
	echo $second_month_number_FROMDATE = $year."-".$second_month_number."-"."01";echo "<br>";
	echo $number_of_days_second_month_number = date('t',strtotime($second_month_number_FROMDATE));echo "<br>";
	echo $second_month_number_TODATE = $year."-".$second_month_number."-".$number_of_days_second_month_number;echo "<br>";
	
	//3rd Month
	echo $third_month_number_FROMDATE = $year."-".$third_month_number."-"."01";echo "<br>";
	echo $number_of_days_third_month_number = date('t',strtotime($third_month_number_FROMDATE));echo "<br>";
	echo $third_month_number_TODATE = $year."-".$third_month_number."-".$number_of_days_third_month_number;echo "<br>";
	 */
	
	
	$sql_business_first=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,
	campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,
	month(campus_transaction.date) AS date_rec_cam_tran_month,
	count(campus_transaction.studentID) as cnt_recurr_stu_business,
	SUM(campus_transaction.amount) as amounttran_business,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,
	campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,
	campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original,campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	campus_transaction.accounts_chk  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1 and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and  
	campus_transaction.date!='' and campus_transaction.campus IS NULL ";
	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql_business_first.=" and campus_transaction.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-main']!=0)
	{
		$sql_business_first.=" and campus_transaction.main_LeadId='".$_POST['search-teacher-main']."' ";
	}
	if(isset($_POST['submit']) && $_POST['paymentMode']!=0)
	{
		$sql_business_first.=" and campus_transaction.method_array='".$_POST['paymentMode']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
	{
		$sql_business_first.=" and campus_transaction.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['recurr_signup']!=0)
	{
		if($_POST['recurr_signup']==2)
		$sql_business_first.=" and campus_transaction.campus=1 ";
		if($_POST['recurr_signup']==1)
		$sql_business_first.=" and campus_transaction.campus IS NULL ";
	}
	/* if($first_month_number!='')
	{
		$sql_business_first.=" and 
	campus_transaction.date BETWEEN '".prepareDate($first_month_number_FROMDATE)."' AND '".prepareDate($first_month_number_TODATE)."' ";
	} */
	
	$sql_business_first.=" GROUP BY  campus_transaction.teacherID ORDER BY SUM(campus_transaction.amount) desc";
	
	$sql_business_result_first = mysql_query($sql_business_first);
	
	$total_business_amount_sum_array_first_cad=array();
	$total_business_amount_sum_array_first_usd=array();
	

$month_name_from = date("F", strtotime(prepareDate($_POST['fromDate'])));
$month_name_to = date("F", strtotime(prepareDate($_POST['toDate'])));
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
if($month_name_from==$month_name_to)
echo "<th class='specalt' colspan=4 align='center'>Month:<b>".$month_name_from."</b></th>"; 
else
echo "<th class='specalt' colspan=4 style='color:red'><b>Select proper month filter</b></th>"; 
echo "</tr>";
echo "<tr>"; 
echo "<th class='specalt'>Teamlead</th>"; 
echo "<th class='specalt'>Teacher</th>";
echo "<th class='specalt'>Recieved Amount(CAD)</th>"; 
echo "<th class='specalt'>Recieved Amount(USD)</th>"; 
echo "</tr>";

while($row_sql_business_first = mysql_fetch_array($sql_business_result_first))
{
echo "<tr>";
echo "<td valign='top'>" . showUser( nl2br( $row_sql_business_first['LeadId'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row_sql_business_first['teacherID'])) . "</td>";
//CAD amounts
echo "<td valign='top'>$ " . $cad_values = round($row_sql_business_first['amounttran_business'],2) . "</td>";
//USD amounts
echo "<td valign='top'>$ " . $usd_convert = round($row_sql_business_first['amounttran_business']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'],2) . "</td>";
//CAD amounts - SUM
$total_business_amount_sum_array_first_cad[$row_sql_business_first['tran_id']] = $cad_values;
//USD amounts - SUM
$total_business_amount_sum_array_first_usd[$row_sql_business_first['tran_id']] = $usd_convert;
echo "</tr>"; 
}

echo "<tr>";  
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	//echo "<td valign='top'>Sum Actual</td>";  
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($total_business_amount_sum_array_first_cad)) . "</td>";  
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($total_business_amount_sum_array_first_usd)) . "</td>";  
	echo "</tr>";
echo "</table>";
include('include/footer.php');?>

