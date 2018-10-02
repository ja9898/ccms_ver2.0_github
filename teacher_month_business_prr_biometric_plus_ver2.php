<? 
include('config.php'); 
include('include/header.php');

?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;<?php if($_SESSION['userType']==1 || $_SESSION['userType']==3 || $_SESSION['userType']==6 || $_SESSION['userType']==11 || $_SESSION['userType']==8) { echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input'); }?>&nbsp;&nbsp;
<?php if($_SESSION['userType']==1 || $_SESSION['userType']==15 || $_SESSION['userType']==6 || $_SESSION['userType']==8 || $_SESSION['userType']==11) { getTeacherFilterLead_main(); getTeacherFilterLead(); getTeacherFilter();  } ?>
&nbsp;&nbsp;
<? if($_SESSION['userType']==1 || $_SESSION['userType']==3 || $_SESSION['userType']==6 || $_SESSION['userType']==11 || $_SESSION['userType']==8) { ?> 
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
	$current_month_name = date("F");echo "<br>";
	
	$first_month_number = date("m", strtotime("-3 months"));
	$second_month_number = date("m", strtotime("-2 months"));
	$third_month_number = date("m", strtotime("-1 months"));
	$current_month_number = date("m");
	
	
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
if(isset($_POST['submit']))		//if $_POST['submit'] start
{
	$sql_business_first=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,
	campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,
	month(campus_transaction.date) AS date_rec_cam_tran_month,
	count(campus_transaction.studentID) as cnt_recurr_stu_business,
	SUM(campus_transaction.amount) as amounttran_business,
	SUM(campus_transaction.amount_usd_simple) as amounttran_usd_simple,
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

	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
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
		$fromDate_strtotime=strtotime(prepareDate($_POST['fromDate']));
		$FEBfirst_strtotime=strtotime('2017-02-01');
		if(prepareDate($_POST['fromDate'])!='' && prepareDate($_POST['toDate'])!='' &&  
		$fromDate_strtotime>=$FEBfirst_strtotime)
		$sql_business_first.=" and campus_transaction.teacherID='".$_SESSION['userId']."' 
		and  
		campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' ";
		//campus_transaction.date BETWEEN '".$MONTH_START_DATE."' AND '".$MONTH_END_DATE."'";
		else
		{
			echo "<br>";echo "<br>";echo "<br>";echo "<br>";
			echo "<div  style='color:red; font-size:16px; position:relative;'>Apply proper filters</div>";
			break;
		}
	}
	if($_POST['search-teacher-id']!=0)
	{
		$sql_business_first.=" and campus_transaction.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
	{
		//$sql_business_first.=" and campus_transaction.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['fromDate']!=0 && $_POST['toDate']!=0 && $_SESSION['userType']!=3)
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
	$sql_business_first.=" GROUP BY  campus_transaction.teacherID ORDER BY SUM(campus_transaction.amount) desc";
	
	$sql_business_result_first = mysql_query($sql_business_first);
	
	$total_business_amount_sum_array_first_usd_simple=array();		//NEWLY ADDED 18-01-17	


$month_name_from = date("F", strtotime(prepareDate($_POST['fromDate'])));
$month_name_to = date("F", strtotime(prepareDate($_POST['toDate'])));
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
if($month_name_from==$month_name_to)
echo "<th class='specalt' colspan=5 align='center'>Month:<b>".$current_month_name."</b></th>"; 
else
echo "<th class='specalt' colspan=5 style='color:red'><b>Select proper month filter</b></th>"; 
echo "</tr>";
echo "<tr>"; 
echo "<th class='specalt'>Teamlead</th>"; 
echo "<th class='specalt'>Teacher</th>";
//echo "<th class='specalt' style='color:red;'>Recieved Amount (USD)</th>"; 
echo "<th class='specalt' style='color:red;'>PAK RS</th>"; 
echo "<th class='specalt' style='color:red;'>Basic Salary</th>"; 
echo "</tr>";

while($row_sql_business_first = mysql_fetch_array($sql_business_result_first))
{

	//Basic salary START
	if($_SESSION['userType']==3 && $_SESSION['userId']!=0){
	$sql_basic_salary="SELECT * FROM capmus_users WHERE id='".$_SESSION['userId']."' ";
	}
	if($_SESSION['userType']==1 || $_SESSION['userType']==6 || $_SESSION['userType']==11 || $_SESSION['userType']==8){//$_POST['search-teacher-id']!=0
	$sql_basic_salary="SELECT * FROM capmus_users WHERE id!=0 ";
		/* if($_POST['search-teacher-id']!=0)
		{ */
			$sql_basic_salary.=" and id='".$row_sql_business_first['teacherID']."' ";
		/* } */
		/* if($_POST['search-teacher-id2']!=0)
		{ */
			//$sql_basic_salary.=" and LeadId='".$row_sql_business_first['LeadId']."' ";
		/* } */
		//echo $sql_basic_salary;
	}
	$result_basic_salary = mysql_query($sql_basic_salary);
	$row_basic_salary = mysql_fetch_array($result_basic_salary);
	//Basic salary END


echo "<tr>";
echo "<td valign='top'>" . showUser( nl2br( $row_sql_business_first['LeadId'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row_sql_business_first['teacherID'])) . "</td>";
//USD amounts SIMPLE		//NEWLY ADDED 18-01-17
$usd_convert_simple = round($row_sql_business_first['amounttran_usd_simple'],2);
//USD to PAK RUPEES 
echo "<td valign='top'>" . $PAK_convert_simple = (25 * $usd_convert_simple) . "</td>";
//basic salary
echo "<td valign='top'>" . $basic_salary = $row_basic_salary['basic_salary'] . "</td>";

//USD amounts SIMPLE - SUM
$total_business_amount_sum_array_first_usd_simple[$row_sql_business_first['tran_id']] = $usd_convert_simple;
echo "</tr>"; 
}

	echo "<tr>";  
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	//echo "<td valign='top'>Sum Actual</td>";  
	$amount_usd_simple_total = nl2br( array_sum($total_business_amount_sum_array_first_usd_simple));  
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
if($_SESSION['userType']==1 || $_SESSION['userType']==6 || $_SESSION['userType']==11 || $_SESSION['userType']==8){
echo "<td valign='top' style='font-size:20px; color:black'>" . $TOTAL = $pak_converted_recurring . "</td>";
}
echo "</tr>";
echo "</table>";
//TOTAL END





/*>>>>>>>>>>>>>>>>>>> ATTENDANCE CODE is as following - START <<<<<<<<<<<<<<<<<<<<< */
if(isset($_POST['submit']))		//if $_POST['submit'] start
{
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt' colspan=2>Actions</th>";
//echo "<th class='specalt'><b>id</b></th>";  
//echo "<th class='specalt' style='color:RED;'><b>biometricId</b></th>"; 
echo "<th class='specalt'><b>Teamlead</b></th>"; 
echo "<th class='specalt'><b>Name</b></th>"; 
echo "<th class='specalt'><b>date</b></th>";
echo "<th class='specalt'><b>onDuty</b></th>"; 
echo "<th class='specalt'><b>offDuty</b></th>"; 
echo "<th class='specalt'><b>clockIn</b></th>"; 
echo "<th class='specalt'><b>clockOut</b></th>"; 
//echo "<th class='specalt'><b>TS-Output_CI</b></th>"; 
//echo "<th class='specalt'><b>TS-Output_CO</b></th>"; 
//echo "<th class='specalt'><b>H:M:S</b></th>"; 
echo "<th class='specalt'><b>Output</b></th>"; 
echo "<th class='specalt'><b>LATE COMMENTS</b></th>"; 
echo "<th class='specalt'><b>EARLY COMMENTS</b></th>";
echo "<th class='specalt'><b>P/A</b></th>"; 
//echo "<th class='specalt'><b>late</b></th>"; 
//echo "<th class='specalt'><b>early</b></th>"; 
//echo "<th class='specalt'><b>Absent Alert</b></th>"; 
//echo "<th class='specalt'><b>absent</b></th>";
//echo "<th class='specalt'><b>exception</b></th>"; 
echo "<th class='specalt'><b>department</b></th>";
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());
if($_SESSION['userType']==3 && ($_SESSION['emp_shift']==1 || $_SESSION['emp_shift']==2) && $_SESSION['designationID']!=17)
{
	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName, 
	capmus_users.LeadId 
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId 
	AND capmus_users.id='".$_SESSION['userId']."' ";
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
	}
	$result=mysql_query($sql) or die(mysql_error());
}

//MANAGE SCHEDULE AND FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8)
{
	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName,
	capmus_users.LeadId  	
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId 
	AND capmus_users.LeadId='".$_SESSION['userId']."' ";
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
	}
	$result=mysql_query($sql) or die(mysql_error());
}

else if($_SESSION['userType']==9)
{
	
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==15)
{
	
}

//	NEWLY ADDED - ADMIN
else if($_SESSION['userType']==2)
{
	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName,
	capmus_users.LeadId  
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId";
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['search-teacher-id2']!=0)
	{
		$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
	}
	$result=mysql_query($sql) or die(mysql_error());
}



//SHOWING ALL THE TRIALS< REGULARS AND MAKEOVERS IN MANAGE SCHEDULE
if($_SESSION['userType']==1 || $_SESSION['userType']==11 || $_SESSION['userType']==18 || $_SESSION['userType']==17 || ($_SESSION['userType']==3 && $_SESSION['designationID']==17 || $_SESSION['userType']==8 || $_SESSION['userType']==6) ){
	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName,
	capmus_users.LeadId  
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId";
	if($_SESSION['userType']==3 && $_SESSION['userId']!=0)
	{
		$sql.=" and capmus_users.id='".$_SESSION['userId']."' ";
	}
	else
	{
		if($_POST['search-teacher-id']!=0)
		{
			$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' ";
		}
		if($_POST['search-teacher-id2']!=0)
		{
			$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
		}
		$sql.="ORDER by date ASC";
		$result=mysql_query($sql) or die(mysql_error());	
		}
	}
	$row_count = mysql_num_rows($result);
/****************** Variables Initialization ***************/	//Intialization
$total_PRESENT_count=0;

$late_PLUS_earlyOut_count=0;
$late_PLUS_earlyOut_count_output=0;

$shortLeave_count=0;
$shortLeave_count_output=0;

$shortLeave_count_DUTY_HOURS=0;
$shortLeave_count_DUTY_HOURS_output=0;
/**********************************************************/
while($row = mysql_fetch_array($result)){ 
	//Query code for SHORT LEAVE APP checking		//START
	//echo "SELECT * FROM campus_empshort_leave WHERE empId = '".$row['user_id']."' and leaveApplied = '".$row['date']."' ";
	$short_leave_app_result = mysql_query("SELECT * FROM campus_empshort_leave WHERE empId = '".$row['user_id']."' and leaveApplied = '".$row['date']."' ") or trigger_error(mysql_error());
	//ROW COUNT
	$rowcount_short_leave_app = mysql_num_rows($short_leave_app_result);
	//Query code for SHORT LEAVE APP checking		//END	
echo "<tr>";  
if($_SESSION['userType']==1 || $_SESSION['userType']==11){
echo "<td valign='top'><a class=button href=biometric_edit_HR_ver1.php?id={$row['emp_att_id']}&userId={$row['user_id']}>Edit</a></td>"; 
	if($_SESSION['userType']==1 && $_SESSION['userId']==159){
	echo "<td valign='top'><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=biometric_delete.php?id={$row['emp_att_id']}>Delete</a></td>";
	}
	else{
	echo "<td valign='top'><a class=button href=#>NA</a></td>";
	}
}else{ 
echo "<td valign='top'><a class=button href=#>NA</a></td>";
echo "<td valign='top'><a class=button href=#>NA</a></td>";
}
//echo "<td valign='top'>" .nl2br($row['emp_att_id']). "</td>";
//echo "<td valign='top'>" . nl2br( $row['biometricId']) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>"; 
echo "<td valign='top'>" . showUser(nl2br( $row['user_id'])) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";

///////////// ON DUTY <<<<<<<<<<<<<<<<<<<<<<
echo "<td valign='top'>" . nl2br( $row['onDuty']) . "</td>"; 
//////////////////////////////ALL BELOW is for LATE  ////////////////////////////////	START
//Adding 10 minutes[in seconds within onDuty time]
$onDuty = strtotime(nl2br( $row['onDuty']));
$ten_min_onDuty = 600; //600 secs is equal to 10 mins
$onDuty_plus_10min = $onDuty + $ten_min_onDuty;
//Adding 1 hour in onDuty time for Short leave COND
$_1hr = 3600; //3600 secs is equal to 1 hr 		//1 Hour
$_4hrs = 14400; //14400 secs is equal to 4 hrs	//4 Hours
$onDuty_plus_1hr = $onDuty + $_1hr;		//Late and Short Leave Late Condition
$onDuty_plus_4hrs = $onDuty + $_4hrs;	//Full Leave Condition
/////////////////////////////////////////////////

///////////// OFF DUTY <<<<<<<<<<<<<<<<<<<<<<
echo "<td valign='top'>" . nl2br( $row['offDuty']) . "</td>";
//Subtracting 10 minutes[in seconds within offDuty time]	//In case of Mon,Tue,Wed,Thur,Fri <<<<<<<<<< offDuty
$offDuty = strtotime(nl2br( $row['offDuty']));
$ten_min_offDuty = 600; //600 secs is equal to 10 mins
$offDuty_minus_10min = $offDuty - $ten_min_offDuty; //Mon,Tue,Wed,Thur,Fri CONDITION

//Calculating 1 hr 10 min							//In case of Sat <<<<<<<<<< offDuty
$ten_min_offDuty = 600; //600 secs is equal to 10 mins
$_1hr = 3600;	//3600 secs is equal to 1 hr 		//1 Hour
$_1hr_10min = $ten_min_offDuty + $_1hr;
$offDuty_minus_1hr_10min = $offDuty - $_1hr_10min; 	//SAT CONDITION 

$offDuty_minus_1hr = $offDuty - $_1hr;				// For Short Leave Early

/////////////////////////////////////////////////


if($row['clockIn']==''){ echo "<td valign='top' style='color:RED;'>NOT CLOCKED IN</td>"; } 
else{ echo "<td valign='top'>" . nl2br( $row['clockIn']) . "</td>"; }
if($row['clockOut']==''){ echo "<td valign='top' style='color:RED;'>NOT CLOCKED OUT</td>"; }
else{ echo "<td valign='top'>" . nl2br( $row['clockOut']) . "</td>"; }
//echo "<td valign='top'>" . $TS_CI = strtotime(nl2br( $row['clockIn'])) . "</td>"; //TS is timestamp
//echo "<td valign='top'>" . $TS_CO = strtotime(nl2br( $row['clockOut'])) . "</td>";//TS is timestamp
$TS_CI = strtotime(nl2br( $row['clockIn'])) . "</td>"; //TS is timestamp
$TS_CO = strtotime(nl2br( $row['clockOut'])) . "</td>";//TS is timestamp
//Custom HOURS and MINUTES calculations	<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	$Output = $TS_CO  - $TS_CI ;
	$secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;
    
	// extract hours
	$hourSeconds = $Output % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);
    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);
	//Calculation manually for NIGHT SHIFT timings i.e 23:00 to 08:00 OR 22:00 to 07:00 // TO DO - Remaining
	if($hours<0 && $Output<0)
	{
		$Output=$Output+86400;
	}
	if($minutes<0)
	{
		$minutes=$minutes+60;
		//$hours=$hours-1;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////
//LATE  - START
//echo "<td valign='top' style='color:green; font-weight:bold;'>" . $hours .":". $minutes . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold;'>" . gmdate("H:i", $Output)."[". $Output ."]" . "</td>";
if($row['clockIn']=='')
{ 
	echo "<td valign='top' style='color:RED;'>NOT CLOCKED IN 
	<span style='color:BLUE;'>[SHORT LEAVE COUNTED]</span>
	</td>";
	$shortLeave_count=$shortLeave_count+1;
	$shortLeave_count_MOD= $shortLeave_count % 2;
	if($shortLeave_count_MOD==0)
	{
		$shortLeave_count_output=$shortLeave_count_output+1;
	}
} 
else 
{
	//General Late Condition >10 min AND <=1hr
	if($TS_CI>$onDuty_plus_10min && $TS_CI<=$onDuty_plus_1hr)
	{
		$late = $TS_CI - $onDuty;
		// extract hours
		$hourSeconds_late = $late % $secondsInADay;
		$hours_late = floor($hourSeconds_late / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_late = $hourSeconds_late % $secondsInAnHour;
		$minutes_late = floor($minuteSeconds_late / $secondsInAMinute);
		echo "<td valign='top' style='color:brown; font-weight:bold;'>LATE-" . $hours_late .":". $minutes_late."min". "</td>";
		//4 LATE COUNT PLUS 4 EARLYOUT COUNT
		$late_PLUS_earlyOut_count=$late_PLUS_earlyOut_count+1;
		$late_PLUS_earlyOut_count_MOD=$late_PLUS_earlyOut_count % 4;
		if($late_PLUS_earlyOut_count_MOD==0)
		{
			$late_PLUS_earlyOut_count_output=$late_PLUS_earlyOut_count_output+1;
		}
	}
	//SHOT LEAVE CONDITIONS - >10 min AND >1hr AND <4hrs
	else if($TS_CI>$onDuty_plus_10min && $TS_CI>$onDuty_plus_1hr && $TS_CI<$onDuty_plus_4hrs)
	{
		$late = $TS_CI - $onDuty;
		// extract hours
		$hourSeconds_late = $late % $secondsInADay;
		$hours_late = floor($hourSeconds_late / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_late = $hourSeconds_late % $secondsInAnHour;
		$minutes_late = floor($minuteSeconds_late / $secondsInAMinute);
		echo "<td valign='top' style='color:purple; font-weight:bold;'>SHORT LEAVE of 0" . $hours_late .":". $minutes_late ."min". "</td>";
		$shortLeave_count=$shortLeave_count+1;
		$shortLeave_count_MOD= $shortLeave_count % 2;
		if($shortLeave_count_MOD==0)
		{
			$shortLeave_count_output=$shortLeave_count_output+1;
		}
	}
	//FULL LEAVE CONDITIONS - >10 min AND >1hr AND >=4hrs
	else if($TS_CI>$onDuty_plus_10min && $TS_CI>$onDuty_plus_1hr && $TS_CI>=$onDuty_plus_4hrs)
	{
		$late = $TS_CI - $onDuty;
		// extract hours
		$hourSeconds_late = $late % $secondsInADay;
		$hours_late = floor($hourSeconds_late / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_late = $hourSeconds_late % $secondsInAnHour;
		$minutes_late = floor($minuteSeconds_late / $secondsInAMinute);
		//Added for those whose onDuty time is 00:00 and their clockIn is less 		//NEWLY ADDED //24-06-16
		//than 00:00 meaning 23:50 or 23:30 etc 			// START
		if($hours_late=='23')
		{
			$hours_late = 00;
			echo "<td valign='top' style='color:green; font-weight:bold;'>BEFORE TIME</td>";
		}
		else {
		echo "<td valign='top' style='color:red; font-weight:bold;'>FULL LEAVE of " . $hours_late .":". $minutes_late ."min". "</td>";
		}
		//Added for those whose onDuty time is 00:00 and their clockIn is less 
		//than 00:00 meaning 23:50 or 23:30 etc 			// END
	}
	
	else
	{
		echo "<td valign='top' style='color:green; font-weight:bold;'>NOT LATE</td>";
	}
}
//LATE - END
////////////////////////////////ALL is for LATE//////////////////////////////////////	END 

//EARLY  - START
if($row['clockOut']=='')
{
	echo "<td valign='top' style='color:RED;'>NOT CLOCKED OUT "?> <?php 
	//Short Leave Applied START 
	if($rowcount_short_leave_app>=1 ) { echo "<label style='color:GREEN;'>[SHORT LEAVE APPLIED]
										<span style='color:BLUE;'>[SHORT LEAVE COUNTED]</span>
										</label>"; } 
	else { echo "<label style='color:GREY;'>[SHORT LEAVE NOT APPLIED]
				<span style='color:BLUE;'>[SHORT LEAVE COUNTED]</span>
	</label>"; } "</td>";
	$shortLeave_count=$shortLeave_count+1;
	$shortLeave_count_MOD= $shortLeave_count % 2;
	if($shortLeave_count_MOD==0)
	{
		$shortLeave_count_output=$shortLeave_count_output+1;
	}
	//Short Leave Applied END
}
else 
{
	if($TS_CO>=$offDuty_minus_10min)
	{
		echo "<td valign='top' style='color:green; font-weight:bold;'>NO EARLYOUT</td>";
	}

	else
	{
		//Calculating the day of SATURDAY , And Grace time is 1 hr 10 min
		$date1 = prepareDate($_POST['fromDate']);
		$date2 = prepareDate($_POST['toDate']);
			$time1 = strtotime($date1);
			$time2 = strtotime($date2);
			$TS_emp_date = strtotime($row['date']);
		//$days = 1; 
		//while($time1 < $time2) { 
		$chk = date('D', $TS_emp_date); # Actual date conversion 
		if($chk == 'Sat' && $TS_CO>=$offDuty_minus_1hr_10min && $TS_CO<$offDuty){
			$early = $offDuty - $TS_CO;
			// extract hours
			$hourSeconds_early = $early % $secondsInADay;
			$hours_early = floor($hourSeconds_early / $secondsInAnHour);
			// extract minutes
			$minuteSeconds_early = $hourSeconds_early % $secondsInAnHour;
			$minutes_early = floor($minuteSeconds_early / $secondsInAMinute);
			echo "<td valign='top' style='color:orange; font-weight:bold;'>NO EARLYOUT</td>";
		}
		
		//} 
		//$days;
		
		
		else{
		//EarlyOut
		if($TS_CO<$offDuty_minus_10min && $TS_CO<$offDuty && $TS_CO>=$offDuty_minus_1hr){
		$early = $offDuty - $TS_CO;
		// extract hours
		$hourSeconds_early = $early % $secondsInADay;
		$hours_early = floor($hourSeconds_early / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_early = $hourSeconds_early % $secondsInAnHour;
		$minutes_early = floor($minuteSeconds_early / $secondsInAMinute);
		echo "<td valign='top' style='color:red; font-weight:bold;'>EarlyOut-0".$hours_early.":".$minutes_early."min"."</td>";
			//4 LATE COUNT PLUS 4 EARLYOUT COUNT
			$late_PLUS_earlyOut_count=$late_PLUS_earlyOut_count+1;
			$late_PLUS_earlyOut_count_MOD=$late_PLUS_earlyOut_count % 4;
			if($late_PLUS_earlyOut_count_MOD==0)
			{
				$late_PLUS_earlyOut_count_output=$late_PLUS_earlyOut_count_output+1;
			}
		}
		//SHORT LEAVE EarlyOut
		else if($TS_CO<$offDuty_minus_10min && $TS_CO<$offDuty && $TS_CO<$offDuty_minus_1hr){
		$early = $offDuty - $TS_CO;
		// extract hours
		$hourSeconds_early = $early % $secondsInADay;
		$hours_early = floor($hourSeconds_early / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_early = $hourSeconds_early % $secondsInAnHour;
		$minutes_early = floor($minuteSeconds_early / $secondsInAMinute);
		echo "<td valign='top' style='color:purple; font-weight:bold;'>SHORT LEAVE of 0".$hours_early.":".$minutes_early."min"."</td>";
			$shortLeave_count=$shortLeave_count+1;
			$shortLeave_count_MOD= $shortLeave_count % 2;
			if($shortLeave_count_MOD==0)
			{
				$shortLeave_count_output=$shortLeave_count_output+1;
			}
		}
		
		else{
			echo "<td valign='top' style='color:red; font-weight:bold;'>NONE</td>";
		}
		}
	}
}
//EARLY - END

//Present/Absent START
$_5hrs = 18000;
$_8hrs = 28800;
												
if($row['clockIn']=='' && $row['clockOut']=='')
{ 
echo "<td valign='top' style='background-color:RED;'>A</td>"; 
} 
else
{
	//Checking working hours  -  a)>=8 present b)>=5 and <8 SHRT L c)<5 absent
		echo "<td valign='top' style='background-color:GREEN;'>P</td>";
		/***************COUNTING PRESENTS******************/	//Start
		$total_PRESENT_count=$total_PRESENT_count+1;
		/***************COUNTING PRESENTS******************/	//End
}
//Present/Absent END





//if($row['clockIn']==''){ echo "<td valign='top'>" . nl2br( $row['late']) . "</td>"; }
//else { echo "<td valign='top' style='color:RED;'>" . nl2br( $row['late']) . "</td>"; }
//echo "<td valign='top'>" . nl2br( $row['early']) . "</td>"; 
//echo "<td valign='top'>" . nl2br( $row['absent']) . "</td>"; 
//echo "<td valign='top'>" . nl2br( $row['exception']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['department']) . "</td>"; 
echo "</tr>"; 
} 
echo "</table>";

/**********No of Days in a month**********/ //START
$fromMonth=date('n',strtotime($_POST['fromDate']));
$toMonth=date('n',strtotime($_POST['toDate']));
	if($fromMonth==$toMonth){
		$NO_OF_DAYS_in_a_month = date('t');
		echo $NO_OF_DAYS_in_a_month=cal_days_in_month(CAL_GREGORIAN,$fromMonth,date('Y'));
	}
/**********No of Days in a month**********/ //END

	/****************** SUNDAYS HOLIDAYS COUNT ********************/	//START
	$fromDate_ccms = prepareDate($_POST['fromDate']);
	$toDate_ccms = prepareDate($_POST['toDate']);
	//$toDate = date('Y-m-d', strtotime($toDate . ' + 1 days'));echo "<br>";

	$date1 = $fromDate_ccms; 
	$date2 = $toDate_ccms; 
	//$date2 = date('t-m-Y'); 

	# Do some checks here for valid dates and to make sure date1 is less than date2 

	# Time strings 
	$time1 = strtotime($date1); 
	$time2 = strtotime($date2); 

	$sunday_count = 0; 
	while($time1 <= $time2) { 
	   ////<><><> echo "DAY:".
	   $chk = date('D', $time1); # Actual date conversion 
	   if($chk == 'Sun') 
		  $sunday_count++;

	   $time1 += 86400; # Add a day 
	} 

	$sunday_count;
	/****************** SUNDAYS HOLIDAYS COUNT ********************/	//END

/*********** Table for TOTAL PRESENT COUNT,SUNDAYS COUNT, MONTH ADJUSTMENTS**************/
echo "<table  border=1 id='' cellspacing=0 >"; 
/*********Total Present Count output ***********/		//START
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Total Present Count : </td>";
echo "<td style='color:green; font-weight:bold'>".$total_PRESENT_count."</td>";
echo "</tr>";
/*********Total Present Count output ***********/		//END
/********** Sundays Count **********/ //START
//echo "<div style='margin-top:20px'>";
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Sundays Count:</td>";
echo "<td style='color:green; font-weight:bold'>".$sunday_count."</td>";
echo "</tr>";
/********** Sundays Count **********/ //END
/********** Adjustment of 30 days **********/ //START
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Adjustment Value:</td>";
echo "<td style='color:green; font-weight:bold'>(30 - ".$NO_OF_DAYS_in_a_month.") = ".($adjustment_value = 30 - $NO_OF_DAYS_in_a_month)."</td>";
echo "</tr>";
/********** Adjustment of 30 days **********/ //END
/********** Casual Leave **********/ //START
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Casual Leave:</td>";
	$sql_leave_app_CL = "SELECT * 
	FROM campus_empleave WHERE LeaveType=2 AND GMApprove=1 ";
	if($_SESSION['userType']==3)
	{	
		$sql_leave_app_CL.= " and EmpId = '".$_SESSION['userId']."' "; 
	}
	else
	{
		$sql_leave_app_CL.= " and EmpId = '".$_POST['search-teacher-id']."' "; 
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql_leave_app_CL.=" and (LeaveStartDate >= '".prepareDate($_POST['fromDate'])."' AND LeaveEndDate <= '".prepareDate($_POST['toDate'])."' )";
	}
		$sql_leave_app_CL.=" and month(campus_empleave.LeaveApplied)= '".$fromMonth."' ";
	$result_leave_app_CL = mysql_query($sql_leave_app_CL);
	$rowcount_leave_app_CL = mysql_num_rows($result_leave_app_CL);	//ROW COUNT
	$row_leave_app_CL =  mysql_fetch_array($result_leave_app_CL);
	/* while($row_leave_app_CL =  mysql_fetch_array($result_leave_app_CL)){
	} */
	
//Applied but NOT APPROVED by GM
if($row_leave_app_CL['GMApprove']!=1){
$rowcount_leave_app_CL = 0;
echo "<td style='color:BLUE; font-weight:bold'>".$rowcount_leave_app_CL."(NOT APPROVED)</td>";
}
//NOT APPLIED at all
else if($rowcount_leave_app_CL==0){
$rowcount_leave_app_CL = 0;
echo "<td style='color:RED; font-weight:bold'>".$rowcount_leave_app_CL."(NOT APPLIED)</td>";
}
//Applied AND APPROVED by GM
else if($row_leave_app_CL['GMApprove']==1 && $rowcount_leave_app_CL>=1){
echo "<td style='color:green; font-weight:bold'>".$rowcount_leave_app_CL."(APPROVED BY GM)</td>";
}
echo "</tr>";
/********** Casual Leave **********/ //END
echo "<br>";
/********** Sick Leave **********/ //START
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Sick Leave:</td>";
	$sql_leave_app_SickLeave = "SELECT * 
	FROM campus_empleave WHERE LeaveType=1 AND GMApprove=1";
	if($_SESSION['userType']==3)
	{	
		$sql_leave_app_SickLeave.= " and EmpId = '".$_SESSION['userId']."' "; 
	}
	else
	{
		$sql_leave_app_SickLeave.= " and EmpId = '".$_POST['search-teacher-id']."' "; 
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql_leave_app_SickLeave.=" and (LeaveStartDate >= '".prepareDate($_POST['fromDate'])."' AND LeaveEndDate <= '".prepareDate($_POST['toDate'])."' )";
	}
		$sql_leave_app_SickLeave.=" and month(campus_empleave.LeaveApplied)= '".$fromMonth."' ";
	$result_leave_app_SickLeave = mysql_query($sql_leave_app_SickLeave);
	//$row_leave_app_SickLeave =  mysql_fetch_array($result_leave_app_SickLeave);
	$days_count_SickLeave=0;
	while($row_leave_app_SickLeave =  mysql_fetch_assoc($result_leave_app_SickLeave)){
	//Sick leave days count
	if($row_leave_app_SickLeave['GMApprove']==1){
	$days_count_SickLeave = $days_count_SickLeave+$row_leave_app_SickLeave['NoOfDays'];
	}
	$rowcount_leave_app_SickLeave = mysql_num_rows($result_leave_app_SickLeave);	//ROW COUNT
	
	//Applied but NOT APPROVED by GM
	if($row_leave_app_SickLeave['GMApprove']!=1 && $rowcount_leave_app_SickLeave>=1){
	$days_count_SickLeave=0;
	//echo "<td style='color:BLUE; font-weight:bold'>".$days_count_SickLeave."(NOT APPROVED BY GM)</td>";
	} 
	//NOT APPLIED at all
	else if($rowcount_leave_app_SickLeave==0){
	$rowcount_leave_app_SickLeave = 0;
	$days_count_SickLeave=0;
	//echo "<td style='color:green; font-weight:bold'>Sick Leave:</td>";
	//echo "<td style='color:RED; font-weight:bold'>".$days_count_SickLeave."(NOT APPLIED)</td>";
	}
	//Applied AND APPROVED by GM
	else if($row_leave_app_SickLeave['GMApprove']==1 && $rowcount_leave_app_SickLeave>=1){
	//echo "<td style='color:green; font-weight:bold'>Sick Leave:</td>";
	//echo "<td style='color:green; font-weight:bold'>".$days_count_SickLeave."(APPROVED BY GM)</td>";
	}
}
if($days_count_SickLeave==0){
	echo "<td style='color:RED; font-weight:bold'>".$days_count_SickLeave."(NOT APPROVED)</td>";
}
else{
	echo "<td style='color:green; font-weight:bold'>".$days_count_SickLeave."(APPROVED BY GM)</td>";
}	
echo "</tr>";
/********** Sick Leave **********/ //END

echo "</table>";
/*********** Table for TOTAL PRESENT COUNT,SUNDAYS COUNT, MONTH ADJUSTMENTS**************/ //END

/*********** Table for latePLUSearlyOut,shortLeave DEDUCTIONS **************/	//START
echo "<table  border=1 id='' cellspacing=0 >"; 
/********** late_count_output **********/ //START
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Late PLUS EarlyOut Count(4 Late/Early = 1 day deduction):</td>";
echo "<td style='color:green; font-weight:bold'>".$late_PLUS_earlyOut_count_output."</td>";
echo "</tr>";
/********** late_count_output **********/ //END
/********** earlyOut_count_output **********/ //START
/* echo "<tr>";
echo "<td style='color:green; font-weight:bold'>EarlyOut Count(4 EarlyOut = 1 day deduction):</td>";
echo "<td style='color:green; font-weight:bold'>".$earlyOut_count_output."</td>";
echo "</tr>"; */
/********** earlyOut_count_output **********/ //END
/********** shortLeave_count **********/ //START
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Short Leave Count(2 SHRT LVS = 1 day deduction):</td>";
echo "<td style='color:green; font-weight:bold'>".$shortLeave_count_output."</td>";
echo "</tr>";
/********** shortLeave_count **********/ //END
/********** shortLeave_count_DUTY_HOURS **********/ //START
/* echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Short Leave Count DUTY HOURS(2 = 1 day deduction):</td>";
echo "<td style='color:green; font-weight:bold'>".$shortLeave_count_DUTY_HOURS_output."</td>";
echo "</tr>"; */
/********** shortLeave_count_DUTY_HOURS **********/ //END

/********** TOTAL_PRESENT_DAYS**********/ //START
echo "<tr>";
echo "<td style='color:RED; font-weight:bold'>TOTAL PRESENT DAYS - SUM:</td>";
$TOTAL_PRESENT_DAYS = $total_PRESENT_count+$sunday_count+($adjustment_value);
$TOTAL_PRESENT_DAYS = $TOTAL_PRESENT_DAYS + ($rowcount_leave_app_CL + $days_count_SickLeave);
$TOTAL_PRESENT_DAYS = $TOTAL_PRESENT_DAYS - ($late_PLUS_earlyOut_count_output+$shortLeave_count_output+$shortLeave_count_DUTY_HOURS_output);
echo "<td style='color:RED; font-weight:bold'>".$TOTAL_PRESENT_DAYS."</td>";
echo "</tr>";
/********** TOTAL_PRESENT_DAYS  **********/ //END

echo "</table>";
/*********** Table for late,earlyOut,shortLeave DEDUCTIONS **************/	//END




//REMOVED
/****** Table for Basic Salary, Student Commision, Total present days *******/	//START
/*********** Table for Basic Salary, Student Commision, Total present days **************/	//END





echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>Name</b></th>"; 
echo "<th class='specalt'><b>Start/End date</b></th>";
echo "<th class='specalt'><b>Leave Applied</b></th>";
echo "<th class='specalt'><b>Leave Type</b></th>"; 
echo "<th class='specalt'><b>DAYS</b></th>";
echo "<th class='specalt'><b>Gm Approve</b></th>";
echo "</tr>"; 
//Query code for LEAVE APP checking		//START
	$sql_leave_app = "SELECT * 
	FROM campus_empleave ";
	
	if($_SESSION['userType']==3)
	{	
		$sql_leave_app.= "WHERE EmpId = '".$_SESSION['userId']."' "; 
	}
	else
	{
		$sql_leave_app.= "WHERE EmpId = '".$_POST['search-teacher-id']."' "; 
	}
	
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql_leave_app.=" and (LeaveStartDate >= '".prepareDate($_POST['fromDate'])."' AND LeaveEndDate <= '".prepareDate($_POST['toDate'])."' )";
	}
//Query code for LEAVE APP checking		//END
	$leave_app_result = mysql_query($sql_leave_app);
	//ROW COUNT
	$rowcount_leave_app = mysql_num_rows($leave_app_result);
	while($row_leave_app_result =  mysql_fetch_array($leave_app_result)){
	echo "<tr>";
		echo "<td valign='top' style='background-color:RED;'>" . showUser( nl2br( $row_leave_app_result['EmpID'])) . "</td>";
		echo "<td valign='top' style='background-color:RED;'>[" . nl2br( $row_leave_app_result['LeaveStartDate']) ."]-[". nl2br( $row_leave_app_result['LeaveEndDate']) . "]</td>";  
		echo "<td valign='top' style='background-color:RED;'>" . nl2br( $row_leave_app_result['LeaveApplied']) ."</td>";  
		echo "<td valign='top' style='background-color:RED;'>" . getData(nl2br( $row_leave_app_result['LeaveType']),'LeaveType') . "</td>";
		echo "<td valign='top' style='background-color:RED;'>" . nl2br( $row_leave_app_result['NoOfDays']) . "</td>";
		echo "<td valign='top' style='background-color:RED;'>" . nl2br( $row_leave_app_result['GMApprove']) . "</td>";
	echo "</tr>";
	}
echo "</table>";
} //	if $_POST['submit'] end
/*>>>>>>>>>>>>>>>>>>> ATTENDANCE CODE is as following - END <<<<<<<<<<<<<<<<<<<<< */







/*>>>>>>>>>>>>>>>>>>> TRIAL COMMISION 10% & 20% - START <<<<<<<<<<<<<<<<<<<<< */
 //NO CONDITION ON REGULAR STUDENTS TRANSACTION, all include, regular, dead, freeze
 	$sql_TRIAL_COMM=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
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
	campus_transaction.accounts_chk,campus_transaction.accounts_comment,
	campus_transaction.agent_comm,campus_transaction.teacher_comm,campus_transaction.cardSave_ccv_code,
	campus_transaction.amount_usd_simple,
	campus_transaction.datetime_now_accounts,campus_transaction.bank_payment_image_filepath  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and 
	campus_transaction.date!='' 
	and campus_transaction.campus=1 ";
	if(isset($_POST['submit']) && $_SESSION['userType']==3)
	{	
		$sql_TRIAL_COMM.= " and campus_transaction.teacher_comm='".$_SESSION['userId']."' "; 
	}
	else
	{
		if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
		{
			$sql_TRIAL_COMM.=" and campus_transaction.LeadId='".$_POST['search-teacher-id2']."' ";
		}
		if(isset($_POST['submit']) && $_POST['search-teacher-main']!=0)
		{
			$sql_TRIAL_COMM.=" and campus_transaction.main_LeadId='".$_POST['search-teacher-main']."' ";
		}
		if(isset($_POST['submit']) && $_POST['paymentMode']!=0)
		{
			$sql_TRIAL_COMM.=" and campus_transaction.method_array='".$_POST['paymentMode']."' ";
		}
		if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
		{
			$sql_TRIAL_COMM.=" and campus_transaction.teacher_comm='".$_POST['search-teacher-id']."' ";
		}
	}
	$result_TRIAL_COMM = mysql_query($sql_TRIAL_COMM) or trigger_error(mysql_error()); 
	//<><><>
	$row_count_TRIAL_COMM=mysql_num_rows($result_TRIAL_COMM);echo "<br>";
	$signups_usd_with_tran_id =array();
	/*$row_count=mysql_num_rows($result);	//Required for number of rows counted/effected/returned*/
	while($row_TRIAL_COMM = mysql_fetch_array($result_TRIAL_COMM)){
		echo 'TRIAL COMM VALUES:'.$signups_usd_with_tran_id[$row_TRIAL_COMM['tran_id']]=$row_TRIAL_COMM['amount_usd_simple'];echo "<br>";
	}

	$sql_REFERENCE_COMM=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
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
	campus_transaction.accounts_chk,campus_transaction.accounts_comment,
	campus_transaction.agent_comm,campus_transaction.teacher_comm,campus_transaction.cardSave_ccv_code,
	campus_transaction.amount_usd_simple,
	campus_transaction.datetime_now_accounts,campus_transaction.bank_payment_image_filepath  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and 
	campus_transaction.date!='' 
	and campus_transaction.campus=1 ";
	if(isset($_POST['submit']) && $_SESSION['userType']==3)
	{	
		$sql_REFERENCE_COMM.= " and campus_transaction.agent_comm='".$_SESSION['userId']."' "; 
	}
	else
	{
		if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
		{
			$sql_REFERENCE_COMM.=" and campus_transaction.agent_comm='".$_POST['search-teacher-id']."' ";
		}
	}
	$result_REFERENCE_COMM = mysql_query($sql_REFERENCE_COMM) or trigger_error(mysql_error()); 
	//<><><>
	$row_count_REFERENCE_COMM=mysql_num_rows($result_REFERENCE_COMM);echo "<br>";
	$signups_usd_with_tran_id_REFERENCE =array();
	/*$row_count=mysql_num_rows($result);	//Required for number of rows counted/effected/returned*/
	while($row_REFERENCE_COMM = mysql_fetch_array($result_REFERENCE_COMM)){
		echo 'REFERENCE COMM VALUES:'.$signups_usd_with_tran_id_REFERENCE[$row_REFERENCE_COMM['tran_id']]=$row_REFERENCE_COMM['amount_usd_simple'];echo "<br>";
	}
	
	
//DEAD COUNT - START
	if(isset($_POST['submit']) && $_SESSION['userType']==3)
	{
		$_POST['search-teacher-id']=$_SESSION['userId'];
	}
	$sql_DEAD=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,
	capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,
	campus_schedule.dead_date,campus_schedule.confirm_dead_date,campus_schedule.std_status_old,
	campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,
	campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,
	campus_schedule.teacherID_old,campus_schedule.dead_reason 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id='".$_POST['search-teacher-id']."' and 
	campus_schedule.teacherID='".$_POST['search-teacher-id']."' and
	campus_schedule.std_status = 3 and 
	campus_schedule.std_status_old = 2 and  
	DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and 
	DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."' ");
	//MAIN TEACHER TEAMLEAD
	if(isset($_POST['search-teacher-main']) && !empty($_POST['search-teacher-main']))
	{
		$sql_DEAD.= " and capmus_users.main_LeadId=".$_POST['search-teacher-main'];
	}
	//TEACHER TEAMLEAD(NOT MAIN)
	if($_POST['search-teacher-id2']!=0 && !empty($_POST['search-teacher-id2']))
	{
		$sql_DEAD.= " and capmus_users.LeadId=".$_POST['search-teacher-id2'];
	}
	$result_DEAD = mysql_query($sql_DEAD) or trigger_error(mysql_error());
	//<><><>
	$row_count_DEAD=mysql_num_rows($result_DEAD);echo "<br>";
//DEAD COUNT - END

//PENDING AMOUNT COUNT - START
	$fromDate=date('d',strtotime($_POST['fromDate']));
	//echo "<br>";
	$fromMonth=date('n',strtotime($_POST['fromDate']));
	//echo "<br>";
	$fromYear=date('Y',strtotime($_POST['fromDate']));
	//echo "<br>";
	
	$fromdaysss=date('t',strtotime($_POST['fromDate']));
	//echo "<br>";
	//echo "<br>";
	
	$toDate=date('d',strtotime($_POST['toDate']));
	//echo "<br>";
	$toMonth=date('n',strtotime($_POST['toDate']));
	//echo "<br>";
	//Added for FEB dates of 30th and 31st/////////////////////////////
	/* if($toMonth==02 && $fromMonth==02 && $fromDate>=01 && $toDate<=29) //USE IT LATER
	{
		echo "F1**".$fromDate=date('d',strtotime($_POST['fromDate']));
		echo "F2**".$toDate=31;
		echo "F3**".$toMonth=02;
	} */
	$toYear=date('Y',strtotime($_POST['toDate']));
	//echo "<br>";
	//echo "<br>";
	
	//Current year and the current month is NOT JAN
	//echo "pre mon";
	$curr_mon_sub_one = date('n')-1;
	//echo "<br>";
	//Current year and the current month is JAN
	//echo "if curr month is JAN and pre mon will be DEC(12) not 0-with pre year ***";
	if($curr_mon_sub_one==0)
	{
		$curr_mon_sub_one=12;
		//echo "<br>";
	}

	//echo "curr mon";
	$curr_mon = date('n');
	//echo "<br>";
	
	//Current year and the current month is NOT DEC
	//echo "next mon-without next year condition";
	$curr_mon_add_one = date('n')+1;
	//echo "<br>";
	//echo "<br>";
	//echo "<br>";
	
	$curr_year_minus_one = date('Y')-1;
	//echo "<br>";
	//Current year and the current month is DEC
	//echo "if curr month is DEC and next mon will be JAN(1) not 13-with next year ***";
	if($curr_mon_add_one==13)
	{
		$curr_mon_add_one=1;
		//echo "<br>";
	}
	//echo "<br>";
	
	
//Pre month + Pre month
if($toMonth == $fromMonth && $toMonth==$curr_mon_sub_one && $fromMonth==$curr_mon_sub_one)
{
		if($_SESSION['userType']==3 || $_SESSION['userType']==1 || $_SESSION['userType']==11 || $_SESSION['userType']==8 || $_SESSION['userType']==6)
		{
			if($fromDate <= $toDate)
			{
//NOT IS USE, ALMOST OBSOLETE
$sql_show_pending="SELECT * 
FROM campus_teachers_pre_pending 
WHERE campus_teachers_pre_pending.teacherID='".$_POST['search-teacher-id']."' and 
campus_teachers_pre_pending.date='2017-06-30 15:45:00' ";
$result_show_pending = mysql_query($sql_show_pending) or trigger_error(mysql_error());
//<><><>
$row_count_show_pending=mysql_num_rows($result_show_pending);echo "<br>";



			}
		}
	
//PREVIOUS MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the PREVIOUS MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
echo "<div align='center' style='color:red; font-size:16px'>PREVIOUS MONTH PENDINGS</div>";
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'><b>Ext ID OLD</b></th>";
echo "<th class='specalt'>EXT ID</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Class Details</th>";
echo "<th class='specalt'>Teacher Name</th>";
echo "<th class='specalt'>TL Name</th>";
echo "<th class='specalt'>Country</th>";
echo "<th class='specalt'>Cousre</th>"; 
echo "<th class='specalt'>Pending Amount-USD</th>";
//echo "<th class='specalt'>Pending Amount-USD</th>"; 
//echo "<th class='specalt' style='color:blue; font-weight:bold'>Original Amount</th>"; 
echo "</tr>";

$amount_pre=array();
$recieved_pre=array();
$pending_pre =array();

$pending_pre_2nd_array =array();

$signups_pre =array();
$discount_pre =array();

$pending_usd_convert_pre=array();


if(isset($_POST['submit']))
{
	$result_pre = mysql_query($sql_pre) or trigger_error(mysql_error()); 
	while($row_pre = mysql_fetch_array($result_show_pending)){ 
				$pending_pre[$row_pre['id']]=$row_pre['pending_cad'];
				$pending_pre_2nd_array[$row_pre['id']]=$row_pre['pending_usd'];
				echo "<tr>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>" . nl2br( $row_pre['paydayz'])  . "</td>";
				echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".$query_country_result_pre['extId_old']."' target=_blank >" . $query_country_result_pre['extId_old'] . "</a></td>";
				echo "<td valign='top' style='color:green; font-weight:bold'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row_pre['studentID']))."' target=_blank >" . getextID(nl2br( $row_pre['studentID'])) . "</a></td>";
				if($five_days_red>5)
				{
					echo "<td valign='top' >" . "<a  style='color:RED; font-weight:bold' href=transaction_paymentdue_month_per_student_report.php?id={$row_pre['studentID']}>" . showStudents(nl2br( $row_pre['studentID'])) . "</a></td>";  
				}
				else
				{
					echo "<td valign='top'>" . "<a href=transaction_paymentdue_month_per_student_report.php?id={$row_pre['studentID']}>" . showStudents(nl2br( $row_pre['studentID'])) . "</a></td>";
				}
				echo "<td valign='top' style='color:green; font-weight:bold'>" . "<a href=class_details_classes_count.php?id={$row_pre['studentID']}&paydate_pre={$row_pre['paydayz']} target='_blank'>Class Details</a></td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row_pre['teacherID'])) . "</td>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser( nl2br( $row_pre['LeadId'])) . "</td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . getData(nl2br( $row_pre['countryID']),'country'). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showCourse(nl2br( $row_pre['courseID'])). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>$" . nl2br( $pending_pre[$row_pre['id']]) . "</td>";  
				//from CAD to USD Conversion/////////////////////////////////////////////////////////////
				//echo "<td valign='top' style='color:green; font-weight:bold'>$" . $pending_usd_convert_pre[$row_pre['id']] =  $pending_pre_2nd_array[$row_pre['id']] . "</td>";
				//echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result_pre['amount_original']  . "</td>";
				echo "</tr>";
	}
	
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
 echo "<td valign='top'>Sum </td>";   
echo "<td valign='top'><b>$" . $pending_pre_2nd_array_TOTAL_SUM = nl2br( array_sum($pending_pre)) . "</td>"; 
//echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($pending_usd_convert_pre)) . "</td>";
echo "</tr>";
echo "</table>";
}
//PENDING AMOUNT COUNT - END



//NEW PENDING	//START
//todate to check against the pre month pening, adding 1 day in todate as the cron job runs 
//on 1st of month, so getting the values of pre month pending
$todate_pre_check = date('Y-m-d', strtotime($toDate_ccms . " +1 day"));echo "<br>";
$fromdate_pre_check = $todate_pre_check." 04:00:00";
$todate_pre_check = $todate_pre_check." 04:10:00";

if(isset($_POST['submit']) && $_SESSION['userType']==3)
{
	$_POST['search-teacher-id']=$_SESSION['userId'];
}
//<><><>
$sql_new_pending = "SELECT id,SUM(pending_usd) as pending_usd 
FROM `campus_teachers_pre_pending` 
WHERE teacherID='".$_POST['search-teacher-id']."' AND 
`date` BETWEEN '".$fromdate_pre_check."' AND '".$todate_pre_check."' ";

/* echo $sql_new_pending = "SELECT id,SUM(pending_usd) as pending_usd 
FROM `campus_teachers_pre_pending` 
WHERE (date BETWEEN '2017-10-01 04:00:00' AND '2017-10-01 04:10:00' AND `teacherID`='812') "; */
$result_new_pending = mysql_query($sql_new_pending) or trigger_error(mysql_error());
$row_count_new_pending=mysql_num_rows($result_new_pending);
while($row = mysql_fetch_array($result_new_pending)){ 
echo $previous_pending = $row['pending_usd'];
}
//NEW PENDING	//END



//CURRENT AMOUNT COUNT - START
//curr month + curr month
if($toMonth == $fromMonth && $fromMonth==$curr_mon && $toMonth==$curr_mon && !empty($_POST['toDate'])){
	//Added for FEB dates of 30th and 31st/////////////////////////////
	/* if($toMonth==02 && $fromMonth==02 && $fromDate>=01 && $toDate<=29) USE IT LATER
	{
		echo "HA1".$fromDate=date('d',strtotime($_POST['fromDate']));
		echo "HA2".$toDate=31;
		echo "HA3".$fromdaysss=31;
		echo "HA4".$toMonth=02;
	}
	else
	{ */
		$toDate=date('d',strtotime($_POST['toDate']));
	/* } */
	//////////////////////////////////////////////////////////////////
				if($fromDate <= $toDate)
				{	
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID='".$_POST['search-teacher-id']."' and
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
				}

//CURRENT MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the CURRENT MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

echo "<div align='center' style='color:red; font-size:16px'>CURRENT MONTH PENDINGS</div>";

echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'>EXT ID old</th>";
echo "<th class='specalt'>EXT ID</th>";
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Class details</th>";
echo "<th class='specalt'>Class details-PD to PD</th>";
echo "<th class='specalt'>Teacher Name</th>";
echo "<th class='specalt'>TL Name</th>";
echo "<th class='specalt'>Country</th>";
echo "<th class='specalt'>Cousre</th>";
//echo "<th class='specalt'>Total Amount</th>"; 
//echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Pending Amount-USD</th>"; 
//echo "<th class='specalt'>Pending Amount-USD</th>";  
//echo "<th class='specalt' style='color:blue; font-weight:bold'>Original Amount</th>"; 
//echo "<th class='specalt'>Signup Amount</th>";
//echo "<th class='specalt'>Discount</th>";
//echo "<th class='specalt'>SignUp Date</th>";
//echo "<th class='specalt'>Paying Date</th>";
//echo "<th class='specalt'>Received Date</th>"; 
//echo "<th class='specalt'>Current Month Due date</th>"; 
echo "</tr>";

$amount=array();
$recieved=array();
$pending =array();
$signups =array();
$discount =array();
$pending_usd_convert=array();

if(isset($_POST['submit']))
{
	$unique_array_id=1;
	$result = mysql_query($sql) or trigger_error(mysql_error()); 
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


	$countresult=$row['amount'];
	//echo "<br>";
	$amount[$row['id']]=$countresult;

	//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses



		$countmonthsql="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".date('n')."' and year(dateRecieved)='".date('Y')."' and studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
		$countmonthesult=mysql_query($countmonthsql) or die(mysql_error());
		$countmonthesult=mysql_fetch_assoc($countmonthesult);

		$amount[$row['id']]=$countresult;
		$recieved[$row['id']]=$countmonthesult['amounttran'];
		$pending[$unique_array_id]=$countresult-$countmonthesult['amounttran']-$countmonthesult['discount_tran'];
		if($pending[$unique_array_id]<0 || $pending[$unique_array_id]<10)
		{
		$pending[$unique_array_id]=0;
		}
		$discount[$row['id']] = $countmonthesult['discount_tran'];


		/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

		$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row['studentID']." and year(dateRecieved)='".date('Y')."' and schedule_id=".$row['id'].""; 
		$maxdate_rec_result=mysql_query($maxdate_rec) or die(mysql_error());
		$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);

	/////////////GETTING COUNTRY//////////////// NEWLY ADDED
	$query_country="SELECT `campus_students`.id as stu_id,countryID,extId,extId_old FROM campus_students where id=".$row['studentID']." "; 
	$query_country_result=mysql_query($query_country) or die(mysql_error());
	$query_country_result=mysql_fetch_assoc($query_country_result);
	
	//For ORIGINAL AMOUNT[amount_original] - Also added 1 in var [$date_subtracted_amount_original] 
	//& [$date_subtracted] so that we must have current month(date('n')) and last 2 months(date('n')-2) in QUERY
	$sql_amt_ori="select amount_original FROM campus_transaction where (month(dateRecieved)>='".($date_subtracted_amount_original+1)."' AND month(dateRecieved)<='".($date_subtracted+1)."')  and year(dateRecieved)='".$year_subtracted."' and studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
	$sql_amt_ori_result=mysql_query($sql_amt_ori) or die(mysql_error());
	$sql_amt_ori_result=mysql_fetch_assoc($sql_amt_ori_result);
	
	//Previous month signup between 25 to 30/31st, And now its paying date is next month's 1 to 10th,THEN
	//It must not be shown in current month pending
	$paydate_strtotime = strtotime($row['pay_date']);
	$duedate_strtotime = strtotime($row['due_date']);
	$days_paydate_minus_duedate_secs = strtotime($row['pay_date']) - strtotime($row['due_date']);
	$days_paydate_minus_duedate_days = floor($days_paydate_minus_duedate_secs/(60*60*24));
	$paydate_month = date("m",strtotime($row['pay_date']));
	$duedate_month = date("m",strtotime($row['due_date']));
	$paydate_year = date("Y",strtotime($row['pay_date']));
	$duedate_year = date("Y",strtotime($row['due_date']));
	//USEE FOLLOWING for testing for PREVIOUS MONTH later >>>>>>>>>>>>>>>>>IMPORTANT<<<<<<<<<<<<<<<<<<<<
	/* if($paydate_strtotime>$duedate_strtotime && $days_paydate_minus_duedate_days<=10 && $paydate_month==date('n'))
	{
	echo "GREEN-STUDENT:".showStudents($row['studentID'])."---DAYS:".$days_paydate_minus_duedate_days."month:".$paydate_month;
	}
	else
	{
	echo "RED-STUDENT:".showStudents($row['studentID'])."---".$days_paydate_minus_duedate_days;
	}
	echo "<br><br>"; */
		//echo $studentname = showStudents(nl2br( $row['studentID']));
		//echo $pending = nl2br( $pending[$unique_array_id]);echo "<br>";

		if($row['month']==date('n') && $row['year']==date('Y'))
		{
		$signups[$row['id']]=$countresult;
		}
		
		
		if($pending[$unique_array_id] >=10 && ($signups[$row['id']]==''))
		{
			//Previous month signup between 25 to 30/31st, And now its paying date is next month's 1 to 10th,THEN
			//It must not be shown in current month pending
			if($paydate_strtotime>=$duedate_strtotime && $days_paydate_minus_duedate_days<=10 && $paydate_month==date('n') && $paydate_month!=$duedate_month && $paydate_year==date('Y'))
			{
				//$pending[$unique_array_id]=0;
				 echo "<tr>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>" . nl2br( $row['paydayz'])  . "</td>";
				echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row['studentID']))."' target=_blank >" . getextID(nl2br( $row['studentID'])) . "</a></td>";			
				if($five_days_red>5)
				{
					echo "<td valign='top'>" .  "<a  style='color:RED; font-weight:bold' href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
				}
				else
				{
					echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";
				}
				echo "<td valign='top'>" . "<a href=class_details_classes_count.php?id={$row['studentID']}&paydate={$row['paydayz']} target='_blank'>Class Details</a></td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showCourse(nl2br( $row['courseID'])). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>$" . nl2br( $pending[$unique_array_id]) . "</td>";  
				 //from CAD to USD Conversion/////////////////////////////////////////////////////////////
				//echo "<td valign='top' style='color:green; font-weight:bold'>$" . $pending_usd_convert[$unique_array_id] =  round($pending[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
				//echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result['amount_original']  . "</td>";
				echo "</tr>"; 
			}
			else
			{
				echo "<tr>";  
				echo "<td valign='top'>" . nl2br( $row['paydayz'])  . "</td>";
				echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".$query_country_result['extId_old']."' target=_blank >" . $query_country_result['extId_old'] . "</a></td>";
				echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row['studentID']))."' target=_blank >" . getextID(nl2br( $row['studentID'])) . "</a></td>";
				if($five_days_red>5)
				{
					echo "<td valign='top'>" .  "<a  style='color:RED; font-weight:bold' href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
				}
				else
				{
					echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";
				}
				echo "<td valign='top'>" . "<a href=class_details_classes_count.php?id={$row['studentID']}&paydate={$row['paydayz']} target='_blank'>Class Details</a></td>";
				
				// Adjust this later 		// NEWLY ADDED 29-04-16
				echo "<td valign='top'>" . "<a href=class_details_classes_count_days_cal_paydate_to_paydate.php?id={$row['studentID']}&paydate={$row['paydayz']}&courseID={$row['courseID']} target='_blank' style='color:blue; font-weight:bold'>Class Details-PayDate TO PayDate</a></td>";				
				//
				
				echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
				echo "<td valign='top'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
				echo "<td valign='top'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
				echo "<td valign='top'>" . showCourse(nl2br( $row['courseID'])). "</td>"; 
				echo "<td valign='top'>$" . nl2br( $pending[$unique_array_id]) . "</td>";  
				//from CAD to USD Conversion/////////////////////////////////////////////////////////////
				//echo "<td valign='top'>$" . $pending_usd_convert[$unique_array_id] =  round($pending[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
				//echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result['amount_original']  . "</td>";
				echo "</tr>"; 
			}		
		}
		$unique_array_id = $unique_array_id + 1;
	}
}//END of if($_POST['submit'])CURRENT PENDING

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
 echo "<td valign='top'>Sum </td>";  
//echo "<td valign='top'><b>$" . nl2br( array_sum($amount))  . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
echo "<td valign='top'><b>$" . $pending_curr_TOTAL_SUM = nl2br( array_sum($pending)) . "</td>"; 
//echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($pending_usd_convert)) . "</td>"; 
//echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($discount)) . "</td>";   
echo "</tr>";
echo "</table>";
}
//CURRENT AMOUNT COUNT - END



/****** If Quran Subject, DEAD - PENDING - LEAVE = 0, then trial commision 20% *******/	//START
$result_TRIAL_COMM = mysql_query($sql_TRIAL_COMM) or trigger_error(mysql_error());
$signups_usd_with_tran_id =array();
//Quran subjects array values
$quran_subjects = array(11,28,29,30,31);
/////////////////////////////

//ALL LEAVES COUNT
$ALL_leaves = ($rowcount_leave_app_CL+$days_count_SickLeave+$late_PLUS_earlyOut_count_output+
$shortLeave_count_output);

//DEAD COUNT
$row_count_DEAD;

//PENDING COUNT and SUM
//Pre month + Pre month
if($toMonth == $fromMonth && $toMonth==$curr_mon_sub_one && $fromMonth==$curr_mon_sub_one)
{
//echo "PEND:".$ALL_pending = $pending_pre_2nd_array_TOTAL_SUM;echo "<br>";
$ALL_pending_previous = $previous_pending;echo "<br>";
}
//curr month + curr month
if($toMonth == $fromMonth && $fromMonth==$curr_mon && $toMonth==$curr_mon && !empty($_POST['toDate']))
{
$ALL_pending = $pending_curr_TOTAL_SUM;echo "<br>";
}

while($row_TRIAL_COMM = mysql_fetch_array($result_TRIAL_COMM)){
$signups_usd_with_tran_id[$row_TRIAL_COMM['tran_id']]=$row_TRIAL_COMM['amount_usd_simple'];
	echo $course = $row_TRIAL_COMM['courseID'];echo "<br>";
}

if(in_array($course,$quran_subjects))
	{
		$all_subjects_are_quran=1;
	}
	else
	{
		$all_subjects_are_quran=0;
	}

//<><><>
$all_subjects_are_quran;echo "<br>";
echo "<br>";
/****** Table for DEAD COUNT=0, PENDING=0, LEAVES=0 *******/	//START
echo "<table  border=1 id='' cellspacing=0 >"; 
echo "<tr>";
echo "<td colspan=2 style='color:blue; font-weight:bold; font-size:20px'>DEAD - PENDING - LEAVES</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Dead Count:</td>";
echo "<td style='color:green; font-weight:bold'>" . $row_count_DEAD . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Pre Pending - USD:</td>";
echo "<td style='color:green; font-weight:bold'>" . $ALL_pending_previous . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Curr Pending - CAD:</td>";
echo "<td style='color:green; font-weight:bold'>" . $ALL_pending . "</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Leaves:</td>";
echo "<td style='color:green; font-weight:bold'>" . $ALL_leaves . "</td>";
echo "</tr>";
echo "</table>";
/****** Table for DEAD COUNT=0, PENDING=0, LEAVES=0 *******/	//END

$check_the_array_of_quran=in_array($row_TRIAL_COMM['courseID'],$quran_subjects);
		////<><><>
		//echo "Match not found-Calculate 10%";
		/****** Table for trial commision 10% *******/	//START
		echo "<table  border=1 id='' cellspacing=0 >"; 
		echo "<tr>";
		echo "<td colspan=2 style='color:blue; font-weight:bold'>TRIAL COMMISION</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='color:green; font-weight:bold'>Trail Commision-USD<span style='font-size:20px;color:RED'>(10% COMM)</span>:</td>";
		echo "<td style='color:green; font-weight:bold'>$" . $trial_comm_usd = nl2br(round(array_sum($signups_usd_with_tran_id),2)) . "</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='color:green; font-weight:bold'>Trail Commision-PAK:</td>";
		$trial_comm_pak = (($trial_comm_usd * (10/100)) *100);
		echo "<td style='color:green; font-weight:bold'>Rs." . $trial_comm_pak . "</td>";
		echo "</tr>";
		echo "</table>";
		/****** Table for trial commision 10% *******/	//END
	

	/****** Table for REFERENCE commision 40% *******/	//START
	echo "<table  border=1 id='' cellspacing=0 >"; 
	echo "<tr>";
	echo "<td colspan=2 style='color:blue; font-weight:bold'>REFERENCE COMMISION</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td style='color:green; font-weight:bold'>REFERENCE Commision-USD<span style='font-size:20px;color:BLUE'>(40% COMM)</span>:</td>";
	echo "<td style='color:green; font-weight:bold'>$" . $REFERENCE_comm_usd = nl2br(round(array_sum($signups_usd_with_tran_id_REFERENCE),2)) . "</td>";
	echo "</tr>";
	echo "<tr>";
	echo "<td style='color:green; font-weight:bold'>REFERENCE Commision-PAK:</td>";
	$REFERENCE_comm_pak = (($REFERENCE_comm_usd * (40/100)) *100);
	echo "<td style='color:green; font-weight:bold'>Rs." . $REFERENCE_comm_pak . "</td>";
	echo "</tr>";
	echo "</table>";
	/****** Table for REFERENCE commision 40% *******/	//END
	

	
	
/****** Arrears *******/	//START
	$sql_arrears="SELECT id,SUM(arrears_amount) as arrears_amount_sum,empID,comments,date  
	FROM campus_emp_arrears 
	WHERE  empID='".$_POST['search-teacher-id']."' AND 
	date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' ";
	$result_arrears=mysql_query($sql_arrears) or die(mysql_error());
	$row_arrears=mysql_fetch_assoc($result_arrears) or die(mysql_error());
	
	$arrears_amount = $row_arrears['arrears_amount_sum'];
/****** Arrears *******/	//END

/****** GIFT and FINE *******/	//START
	$sql_gift_fine="SELECT id,SUM(gift_amount) as gift_amount_sum,SUM(fine_amount) as fine_amount_sum,
	empID,comments,date 
	FROM campus_emp_gift_fine 
	WHERE  empID='".$_POST['search-teacher-id']."' AND 
	date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' ";
	$result_gift_fine=mysql_query($sql_gift_fine) or die(mysql_error());
	$row_gift_fine=mysql_fetch_assoc($result_gift_fine) or die(mysql_error());
	
	$gift_amount = $row_gift_fine['gift_amount_sum'];
	$fine_amount = $row_gift_fine['fine_amount_sum'];
/****** GIFT and FINE *******/	//END


	/****** Table for REFERENCE 1500 RS *******/	//START
		if($toMonth == $fromMonth && $toMonth==$curr_mon_sub_one && $fromMonth==$curr_mon_sub_one)
		{
		//echo "PEND:".$ALL_pending = $pending_pre_2nd_array_TOTAL_SUM;echo "<br>";
		$OVERALL_pending = $previous_pending;echo "<br>";
		}
		//curr month + curr month
		if($toMonth == $fromMonth && $fromMonth==$curr_mon && $toMonth==$curr_mon && !empty($_POST['toDate']))
		{
		$OVERALL_pending = $pending_curr_TOTAL_SUM;echo "<br>";
		}
	if ($row_count_DEAD==0 && $OVERALL_pending==0 && $ALL_leaves==0 && $TOTAL_PRESENT_DAYS==30)
	{
		/* echo "<table  border=1 id='' cellspacing=0 >"; 
		echo "<tr>";
		echo "<td colspan=2 style='color:blue; font-weight:bold'>1500 Rs Addition</td>";
		echo "</tr>";
		echo "<tr>";
		echo "<td style='color:green; font-weight:bold'>Addition<span style='font-size:20px;color:green'>(1500RS)</span>:</td>"; */
		$fifteen_hundred = 1500;
/* 		echo "</tr>";
		echo "</table>"; */
	}
	else
	{
		$fifteen_hundred=0;
	}
	/****** Table for REFERENCE 1500 RS *******/	//END
	

/****** Table for Basic Salary, Student Commision, Total present days *******/	//START
echo "<table  border=1 id='' cellspacing=0 >"; 
echo "<tr>";
echo "<td colspan=2 style='color:blue; font-weight:bold'>OVERALL CALCULATIONS</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Basic Salary</td>";
echo "<td style='color:green; font-weight:bold'>".$basic_salary."</td>";
echo "</tr>";
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Recurring Commision</td>";
echo "<td style='color:green; font-weight:bold'>".$pak_converted_recurring."</td>";
echo "</tr>";

//TRIAL / DEMO COMMISION
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Demo Commision</td>";
echo "<td style='color:green; font-weight:bold'>".$trial_comm_pak."</td>";
echo "</tr>";

//REFERENCE COMMISION
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Reference Commision</td>";
echo "<td style='color:green; font-weight:bold'>".$REFERENCE_comm_pak."</td>";
echo "</tr>";

//TOTAL SALARY PART1	
echo "<tr>";
echo "<td style='color:RED; font-weight:bold'>GROSS SALARY:</td>";
$TOTAL_SALARY_PART1 = $basic_salary+$pak_converted_recurring;
echo "<td style='color:RED; font-weight:bold'>".$TOTAL_SALARY_PART1."</td>";
echo "</tr>";
//TOTAL SALARY PART1 FINAL
echo "<tr>";
echo "<td style='color:RED; font-weight:bold'>NET SALARY:</td>";
//$TOTAL_SALARY_PART1_FINAL = (Total salary/30) * No of working days	//Formula **<<??
$TOTAL_SALARY_PART1_FINAL = (($TOTAL_SALARY_PART1/30) * $TOTAL_PRESENT_DAYS);
echo "<td style='color:RED; font-weight:bold'>".$TOTAL_SALARY_PART1_FINAL."</td>";
echo "</tr>";

//ARREARS
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Arrears</td>";
echo "<td style='color:green; font-weight:bold'>".$arrears_amount."</td>";
echo "</tr>";

//GIFT
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Gift</td>";
echo "<td style='color:green; font-weight:bold'>".$gift_amount."</td>";

//FINE
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Fine</td>";
echo "<td style='color:green; font-weight:bold'>".$fine_amount."</td>";

//Punctuality and consistency bonus
echo "<tr>";
echo "<td style='color:green; font-weight:bold'>Punctuality and consistency bonus</td>";
echo "<td style='color:green; font-weight:bold'>".$fifteen_hundred."</td>";

//Final Salary
echo "<tr>";
echo "<td style='color:blue; font-weight:bold'>Final Salary</td>";
echo "<td style='color:blue; font-weight:bold'>".$final_salary = ($TOTAL_SALARY_PART1_FINAL+$arrears_amount+$gift_amount+$fifteen_hundred) - ($fine_amount)."</td>";

echo "</tr>";
echo "</table>";
/*********** Table for Basic Salary, Student Commision, Total present days **************/	//END



/****** If Quran Subject, DEAD - PENDING - LEAVE = 0, then trial commision 20% *******/	//END


/*>>>>>>>>>>>>>>>>>>> TRIAL COMMISION 10% & 20% - END <<<<<<<<<<<<<<<<<<<<< */






} //	if $_POST['submit'] end
include('include/footer.php');?>