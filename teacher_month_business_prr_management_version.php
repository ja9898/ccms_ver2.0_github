<? 
include('config.php'); 
include('include/header.php');

?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;<?php if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==12) { echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input'); }?>&nbsp;&nbsp;
<?php if($_SESSION['userType']==1 || $_SESSION['userType']==15 || $_SESSION['userType']==6 || $_SESSION['userType']==8 || $_SESSION['userType']==12) { 
//getTeacherFilterLead_main(); 
getTeacherFilterLead(); 
getTeacherFilter();
} ?>
&nbsp;&nbsp;
<? if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==12) { ?> 
<input type="submit" class="button" name="submit" value="Filter">
<? } ?> 
</form>
<br /><br />
</div>

<? 

	//Get 1 cad to usd rate from db
	$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
	$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
	$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];

	date("F", strtotime("-3 months"));
	date("F", strtotime("-2 months"));
	date("F", strtotime("-1 months"));
	
	$first_month_number = date("m", strtotime("-3 months"));
	$second_month_number = date("m", strtotime("-2 months"));
	$third_month_number = date("m", strtotime("-1 months"));
	
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
	
	//MONTH START-END/////////////////////////////////////////////////////////////////////////////////////
	//MONTH START DATE
	$current_date = '01';
	$current_month = date('m');
	$current_year = date('Y');
	echo "<b>MONTH START:</b>";
	echo $MONTH_START_DATE = $current_year."-".$current_month."-".$current_date;echo "<br>";
	//////////////////
	//MONTH END DATE
	echo "<b>MONTH END:&nbsp;&nbsp;&nbsp;</b>";
	echo $MONTH_END_DATE  = date('Y-m-t');echo "<br>";echo "<br>";
if(isset($_POST['submit']) && $_POST['fromDate']!='' && $_POST['toDate']!='')		//if $_POST['submit'] start
{
	$sql_business_first=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,
	campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,
	month(campus_transaction.date) AS date_rec_cam_tran_month,
	campus_transaction.studentID as cnt_recurr_stu_business,
	campus_transaction.amount as amounttran_business,
	campus_transaction.amount_usd_simple as amounttran_usd_simple,
	campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,
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
	campus_transaction.date!='' and campus_transaction.campus IS NULL
	";
//	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and  

	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0 && $_SESSION['userType']!=8)
	{
		$sql_business_first.=" and campus_transaction.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-main']!=0)
	{
		//$sql_business_first.=" and campus_transaction.main_LeadId='".$_POST['search-teacher-main']."' ";
	}
	if(isset($_POST['submit']) && $_POST['paymentMode']!=0)
	{
		//$sql_business_first.=" and campus_transaction.method_array='".$_POST['paymentMode']."' ";
	}
	if($_SESSION['userType']==3 && $_SESSION['userId']!=0)
	{
		$sql_business_first.=" and campus_transaction.teacherID='".$_SESSION['userId']."' 
		and 
		campus_transaction.date BETWEEN '".$MONTH_START_DATE."' AND '".$MONTH_END_DATE."' ";
	}
	if($_POST['search-teacher-id']!=0)
	{
		$sql_business_first.=" and campus_transaction.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
	{
		//$sql_business_first.=" and campus_transaction.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['fromDate']!=0 && $_POST['toDate']!=0)
	{
		$sql_business_first.=" and campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' ";
	}
	if($_POST['recurr_signup']!=0)
	{
		/* if($_POST['recurr_signup']==2)
		$sql_business_first.=" and campus_transaction.campus=1 ";
		if($_POST['recurr_signup']==1)
		$sql_business_first.=" and campus_transaction.campus IS NULL "; */
	}
	//$sql_business_first.=" GROUP BY  campus_transaction.teacherID ORDER BY SUM(campus_transaction.amount) desc";
	
	// Show the SALARY+COMMISION to TEAMLEADs of their TEAM ONLY	//NEWLY ADDED 11-03-2017
	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0 && $_SESSION['userType']==8)
	{
		$sql_business_first.=" and campus_transaction.LeadId='".$_SESSION['userId']."' ";
	}
	////////////////////////////////////////////////////////////
	$sql_business_first.=" ORDER BY  campus_transaction.teacherID";
	
	$sql_business_result_first = mysql_query($sql_business_first);
	
	$total_business_amount_sum_array_first_usd_simple=array();		//NEWLY ADDED 18-01-17	


$month_name_from = date("F", strtotime(prepareDate($_POST['fromDate'])));
$month_name_to = date("F", strtotime(prepareDate($_POST['toDate'])));
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
if($month_name_from==$month_name_to)
echo "<th class='specalt' colspan=8 align='center'>Month:<b>".$month_name_from."</b></th>"; 
else
echo "<th class='specalt' colspan=8 style='color:red'><b>Select proper month filter</b></th>"; 
echo "</tr>";
echo "<tr>"; 
echo "<th class='specalt'>Teamlead</th>"; 
echo "<th class='specalt'>Teacher</th>";
echo "<th class='specalt'>Student</th>"; 
echo "<th class='specalt' style='color:blue'>Current Month DUE DATE</th>"; 
echo "<th class='specalt'>Received Date</th>"; 
echo "<th class='specalt' style='color:red;'>Recieved Amount (USD)</th>"; 
echo "<th class='specalt' style='color:red;'>PAK RS</th>"; 
//echo "<th class='specalt' style='color:red;'>Basic Salary</th>"; 
echo "</tr>";

while($row_sql_business_first = mysql_fetch_array($sql_business_result_first))
{

	//Basic salary START
	if($_SESSION['userType']==3 && $_SESSION['userId']!=0){
	$sql_basic_salary="SELECT * FROM capmus_users WHERE id='".$_SESSION['userId']."' ";
	}
	if($_SESSION['userType']==1){//$_POST['search-teacher-id']!=0
	$sql_basic_salary="SELECT * FROM capmus_users WHERE id!=0 ";
		/* if($_POST['search-teacher-id']!=0)
		{ */
			$sql_basic_salary.=" and id='".$row_sql_business_first['teacherID']."' ";
		/* } */
		/* if($_POST['search-teacher-id2']!=0)
		{ */
			$sql_basic_salary.=" and LeadId='".$row_sql_business_first['LeadId']."' ";
		/* } */
		//echo $sql_basic_salary;
	}
	$result_basic_salary = mysql_query($sql_basic_salary);
	$row_basic_salary = mysql_fetch_array($result_basic_salary);
	/* while($row_basic_salary = mysql_fetch_array($result_basic_salary))
	{ */
/* 	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	echo "<tr>"; 
	echo "<th class='specalt'>Basic Salary</th>";  */
	//echo "<td valign='top'>" . $basic_salary = $row_basic_salary['basic_salary'] . "</td>";
/* 	echo "</tr>";
	echo "</table>"; */
	//Basic salary END
	/* } */

echo "<tr>";
echo "<td valign='top'>" . showUser( nl2br( $row_sql_business_first['LeadId'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row_sql_business_first['teacherID'])) . "</td>";
echo "<td valign='top'>" . showStudents( nl2br( $row_sql_business_first['cnt_recurr_stu_business'])) . "</td>";
echo "<td valign='top' style='color:blue; font-weight:bold'>" . nl2br( $row_sql_business_first['maxdate_rec']). "</td>"; 
echo "<td valign='top'>" . nl2br( $row_sql_business_first['date_rec_cam_tran']). "</td>";

//USD amounts SIMPLE		//NEWLY ADDED 18-01-17
echo "<td valign='top'>$ " . $usd_convert_simple = round($row_sql_business_first['amounttran_usd_simple'],2) . "</td>";
//USD to PAK RUPEES 
echo "<td valign='top'>" . $PAK_convert_simple = (25 * $usd_convert_simple) . "</td>";
//basic salary //Commenting for management
//echo "<td valign='top'>" . $basic_salary = $row_basic_salary['basic_salary'] . "</td>";

//USD amounts SIMPLE - SUM
$total_business_amount_sum_array_first_usd_simple[$row_sql_business_first['tran_id']] = $usd_convert_simple;
echo "</tr>"; 
}

	echo "<tr>";  
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	//echo "<td valign='top'>Sum Actual</td>";  
	echo "<td valign='top' style='color:red; font-weight:bold'><b>$" . $amount_usd_simple_total = nl2br( array_sum($total_business_amount_sum_array_first_usd_simple)) . "</td>";  
	echo "<td valign='top' style='color:green; font-weight:bold'><b>Rs: " . $pak_converted_recurring = 25 * $amount_usd_simple_total . "</td>";  
	echo "</tr>";
echo "</table>";

//TOTAL START
echo "<table border=0 id='table_liquid' cellspacing=0>"; 
echo "<tr>"; 
echo "<th class='' style='background-color:green;font-size:20px'>Total</th>"; 
if($_SESSION['userType']==3){
echo "<td valign='top' style='font-size:20px; color:black'>" . $TOTAL = $pak_converted_recurring + $basic_salary . "</td>";
}
if($_SESSION['userType']==1){
echo "<td valign='top' style='font-size:20px; color:black'>" . $TOTAL = $pak_converted_recurring . "</td>";
}
echo "</tr>";
echo "</table>";
//TOTAL END

} //	if $_POST['submit'] end
include('include/footer.php');?>