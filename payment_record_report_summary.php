<? 
include('config.php'); 
include('include/header.php');
if(isset($_POST['submit']))
{
	
	$fromDate=date('d',strtotime($_POST['fromDate']));
	
	$fromMonth=date('n',$_POST['fromDate']);
	//$toMonth=date('n',$_POST['toDate']);
	$toDate=date('d',strtotime($_POST['toDate']));
	if(!empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
//campus_schedule.duedate=campus_transaction.dateRecieved and
		$sql_summary = " SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	SUM(campus_transaction.amount) as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original   
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and campus_schedule.duedate!=campus_transaction.date  
	and  
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' ";	
	$sql_summary.="  GROUP BY campus_transaction.LeadId ";
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
	campus_transaction.amount_original as amounttran_original  
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
	
	//MAIN TEAMLEAD QUERY
	$sql_MTTL=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and campus_schedule.duedate=campus_transaction.date and 
	campus_transaction.main_LeadId=506 and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' ";

	
}
}

?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
//NEWLY ADDED
//echo "<br><br><br>";
//echo "<label style='color:green'>Checkbox to ACTIVATE SUMMARY TABLE</label>";
//echo getCheckbox($_POST['prr_summary'],'prr_summary');
?>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php //if($_SESSION['userType']==1 || $_SESSION['userType']==15) { getTeacherFilterLead_main(); getTeacherFilterLead(); echo getList('','paymentMode','paymentMode'); } ?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
<br /><br />
</div>


<?php
// Detailed PAYMENT RECORD REPORT Table						//OLD TABLE of Payment record report
/*echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'>ID</th>"; 
echo "<th class='specalt' style='color:blue'>Current Month DUE DATE</th>"; 
echo "<th class='specalt'>Received Date</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Signup Amount</th>";
echo "<th class='specalt'>GBP Amount</th>";
echo "<th class='specalt'>Original Amount</th>";
echo "<th class='specalt'>Currency</th>";
echo "<th class='specalt'>Transaction ID</th>";
echo "<th class='specalt'>Method</th>";
echo "<th class='specalt'>Operator</th>"; 
echo "<th class='specalt'>Comments</th>"; 
echo "<th class='specalt'>Teacher</th>"; 
echo "<th class='specalt'>Teamlead</th>"; 
echo "<th class='specalt'>Main Teamlead</th>"; 
echo "<th class='specalt'>Sender</th>"; 
echo "<th class='specalt'>Email</th>"; 
echo "<th class='specalt'>Actions</th>";
echo "</tr>";*/

$amount=array();
$recieved=array();
$recieved_with_tran_id=array();

$pending =array();
$signups =array();

$gbp =array();
$original =array();
if(isset($_POST['submit']))
{
	$result = mysql_query($sql) or trigger_error(mysql_error()); 
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
	$signup_check=1;
	$countresult=$row['amount'];
	$countmonthsql="select amount as amounttran_not_main,date,dateRecieved,operator,id FROM campus_transaction where date BETWEEN '".nl2br(prepareDate($_POST['fromDate']))."' AND '".nl2br(prepareDate($_POST['toDate']))."' and studentID=".$row['studentID']." and schedule_id=".$row['id']." and id=".$row['tran_id']." "; 
	$countmonthesult=mysql_query($countmonthsql);
	$countmonthesult=mysql_fetch_assoc($countmonthesult);
	$amount[$row['id']]=$countresult;
	//DUE DATE(Signup DATE) - Month and Year
	$duedate_month = date('m', strtotime(nl2br($row['due_date'])));
	$duedate_year = date('Y', strtotime(nl2br($row['due_date'])));
	
	//DUE DATE(Signup DATE) - Month and Year
	$dateRec_month = date('m', strtotime(nl2br($countmonthesult['dateRecieved'])));
	$dateRec_year = date('Y', strtotime(nl2br($countmonthesult['dateRecieved'])));
	if(($row['due_date']>=nl2br(prepareDate($_POST['fromDate'])) && $row['due_date']<=nl2br(prepareDate($_POST['toDate']))) && $row['due_date']==$countmonthesult['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
	{
		$signups[$row['id']]=$row['amount'];
		$signup_check=0;
	}
	else
	{
		//$signup_check==1;
	}

	if(!empty($countresult) && ($countmonthesult['date']>=nl2br(prepareDate($_POST['fromDate'])) && $countmonthesult['date']<=nl2br(prepareDate($_POST['toDate']))) && $signup_check==1)
	{
		$recieved[$row['tran_id']]=$row['amounttran'];
		$recieved_with_tran_id[$row['tran_id']]=$row['amounttran'];
	}
	/*echo "<tr>";  
	echo "<td valign='top'>" . nl2br( $row['tran_id']). "</td>"; 
	echo "<td valign='top' style='color:blue; font-weight:bold'>" . nl2br( $row['maxdate_rec']). "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['date_rec_cam_tran']). "</td>"; 
	echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
	echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";
	echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";	
	echo "<td valign='top'>$" . nl2br( $row['amounttran_gbp']) . "</td>";
	echo "<td valign='top'>$" . nl2br( $row['amounttran_original']) . "</td>";
	echo "<td valign='top'>" .  getData(nl2br( $row['currency_array']),'currency') . "</td>";
	echo "<td valign='top'>" .  nl2br( $row['transactionID']) . "</td>";
	echo "<td valign='top'>" .  getData(nl2br( $row['method_array']),'paymentMode') . "</td>";
	echo "<td valign='top'>" . 	showUser(nl2br( $row['tran_op'])). "</td>"; 
	echo "<td valign='top'>" . 	nl2br( $row['comments']). "</td>"; 
	echo "<td valign='top'>" . 	showUser(nl2br( $row['teacherID'])). "</td>"; 
	echo "<td valign='top'>" . 	showUser(nl2br( $row['LeadId'])). "</td>";
	echo "<td valign='top'>" . 	showUser(nl2br( $row['main_LeadId'])). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['sender_name']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['email']). "</td>";
	echo "</tr>"; */

}
}
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";  
echo "<td valign='top'>TOTAL RECURRING(Received Sum) </td>";
echo "<td valign='top'>TOTAL SIGNUPS(Signup Sum) </td>";
echo "<td style='color:green;' valign='top'>TOTAL SUM</td>";
echo "</tr>";
echo "<tr>";  
echo "<td valign='top'><b>$" . $recurr = nl2br( array_sum($recieved)) . "</td>";
echo "<td valign='top'><b>$" . $SU = nl2br( array_sum($signups)) . "</td>"; 
echo "<td style='color:green;' valign='top'>".($recurr + $SU)."</td>";  
echo "</tr>";
if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227 || $_SESSION['userId']==1 || $_SESSION['userId']==52)
{
//	echo "<tr>";  
//	echo "<td valign='top'>Sum Actual</td>";  
//	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($recieved_with_tran_id)) . "</td>";  
//	echo "<td valign='top'></td>"; 
//	echo "</tr>";
}
echo "</table>";
////////////////////////////////////////////////////////////////////////////////////////////////






//MAIN TEACHER TEAMLEAD DAY id fixed, for $sql_MTTL and to calculate DAY SIGNUPS
$amount_MTTL=array();
$recieved=array();
$recieved_with_tran_id=array();
//NEWLY ADDED// 06-09-14
$recieved_MTTL=array();
$recieved_with_tran_id_MTTL=array();
$pending =array();
$day_signups_MTTL =array();
////////////////////////
$gbp =array();
$original =array();
if(isset($_POST['submit']))
{
	$result_MTTL = mysql_query($sql_MTTL) or trigger_error(mysql_error()); 
	while($row_MTTL = mysql_fetch_array($result_MTTL)){ 
	//foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
	$signup_check=1;
	$countresult_MTTL=$row_MTTL['amount'];
	$countmonthsql_MTTL="select amount as amounttran_not_main,date,operator,id FROM campus_transaction where date BETWEEN '".nl2br(prepareDate($_POST['fromDate']))."' AND '".nl2br(prepareDate($_POST['toDate']))."' and studentID=".$row_MTTL['studentID']." and schedule_id=".$row_MTTL['id']." "; 
	$countmonthesult_MTTL=mysql_query($countmonthsql_MTTL);
	$countmonthesult_MTTL=mysql_fetch_assoc($countmonthesult_MTTL);
	$amount_MTTL[$row_MTTL['id']]=$countresult_MTTL;
	if(($row_MTTL['due_date']>=nl2br(prepareDate($_POST['fromDate'])) && $row_MTTL['due_date']<=nl2br(prepareDate($_POST['toDate']))) && $row_MTTL['due_date']==$countmonthesult_MTTL['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult_MTTL))
	{
		$day_signups_MTTL[$row_MTTL['id']]=$row_MTTL['amount'];
		$signup_check=0;
	}
	else
	{
		//$signup_check==1;
	}

	if(!empty($countresult_MTTL) && ($countmonthesult_MTTL['date']>=nl2br(prepareDate($_POST['fromDate'])) && $countmonthesult_MTTL['date']<=nl2br(prepareDate($_POST['toDate']))) && $signup_check==1)
	{
		$recieved_MTTL[$row_MTTL['tran_id']]=$row_MTTL['amounttran'];
		$recieved_with_tran_id_MTTL[$row_MTTL['tran_id']]=$row_MTTL['amounttran'];
	}
	/*echo "<tr>";  
	echo "<td valign='top'>" . nl2br( $row['tran_id']). "</td>"; 
	echo "<td valign='top' style='color:blue; font-weight:bold'>" . nl2br( $row['maxdate_rec']). "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['date_rec_cam_tran']). "</td>"; 
	echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
	echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";
	echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";	
	echo "<td valign='top'>$" . nl2br( $row['amounttran_gbp']) . "</td>";
	echo "<td valign='top'>$" . nl2br( $row['amounttran_original']) . "</td>";
	echo "<td valign='top'>" .  getData(nl2br( $row['currency_array']),'currency') . "</td>";
	echo "<td valign='top'>" .  nl2br( $row['transactionID']) . "</td>";
	echo "<td valign='top'>" .  getData(nl2br( $row['method_array']),'paymentMode') . "</td>";
	echo "<td valign='top'>" . 	showUser(nl2br( $row['tran_op'])). "</td>"; 
	echo "<td valign='top'>" . 	nl2br( $row['comments']). "</td>"; 
	echo "<td valign='top'>" . 	showUser(nl2br( $row['teacherID'])). "</td>"; 
	echo "<td valign='top'>" . 	showUser(nl2br( $row['LeadId'])). "</td>";
	echo "<td valign='top'>" . 	showUser(nl2br( $row['main_LeadId'])). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['sender_name']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['email']). "</td>";
	echo "</tr>"; */

}
}
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";  
//echo "<td valign='top'>Received Sum </td>";
echo "<td valign='top'><b>Day Signup</b></td>";
echo "<td valign='top'><b>Night Signup</b></td>";
echo "</tr>";
echo "<tr>";  
//echo "<td valign='top'><b>$" . $recurr = nl2br( array_sum($recieved)) . "</td>";
echo "<td valign='top'><b>$" . $DAY_SU_MTTL = nl2br( array_sum($day_signups_MTTL)) . "</td>"; 
echo "<td valign='top'><b>$" . $NIGHT_SU_MTTL = $SU - $DAY_SU_MTTL . "</td>"; 

//echo "<td style='color:green;' valign='top'>".($recurr + $SU)."</td>";  
echo "</tr>";


echo "</table>";
////////////////////////////////////////////////////////////////////////////////////////////////


















//SUMMARY PAYMENT RECORD REPORT TABLE///////////// //NEWLY ADDED///////////// SUMMARY 06-09-2014 
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Teamlead</th>"; 
echo "<th class='specalt'>Recieved Amount</th>"; 
echo "</tr>";
$amount=array();
$recieved=array();
$recieved_with_tran_id=array();
//NEWLY ADDED// 06-09-14
$recieved_TL=array();
$recieved_with_tran_id_TL=array();
//////////////
$pending =array();
$signups_TL =array();

$gbp =array();
$original =array();
if(isset($_POST['submit']))
{
	$result_summary = mysql_query($sql_summary) or trigger_error(mysql_error()); 
	/*$row_count=mysql_num_rows($result);	//Required for number of rows counted/effected/returned*/
	while($row_summary = mysql_fetch_array($result_summary)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
	$signup_check=1;
	$countresult_summary=$row_summary['amount'];

	$countmonthsql_summary="select amount as amounttran_not_main,date,dateRecieved,operator,id FROM campus_transaction where date BETWEEN '".nl2br(prepareDate($_POST['fromDate']))."' AND '".nl2br(prepareDate($_POST['toDate']))."' and studentID=".$row_summary['studentID']." and schedule_id=".$row_summary['id']."  and id=".$row_summary['tran_id']."  "; 
	$countmonthesult_summary=mysql_query($countmonthsql_summary);
	$countmonthesult_summary=mysql_fetch_assoc($countmonthesult_summary);
	$amount[$row_summary['id']]=$countresult_summary;
	//DUE DATE(Signup DATE) - Month and Year
	$duedate_month = date('m', strtotime(nl2br($row_summary['due_date'])));
	$duedate_year = date('Y', strtotime(nl2br($row_summary['due_date'])));
	
	//DUE DATE(Signup DATE) - Month and Year
	$dateRec_month = date('m', strtotime(nl2br($countmonthesult_summary['dateRecieved'])));
	$dateRec_year = date('Y', strtotime(nl2br($countmonthesult_summary['dateRecieved'])));
	if(($row_summary['due_date']>=nl2br(prepareDate($_POST['fromDate'])) && $row_summary['due_date']<=nl2br(prepareDate($_POST['toDate']))) && $row_summary['due_date']==$countmonthesult_summary['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
	{
		$signups_TL[$row_summary['id']]=$row_summary['amount'];
		$signup_check=0;
	}
	else
	{
		//$signup_check==1;
	}

	if(!empty($countresult_summary) && ($countmonthesult_summary['date']>=nl2br(prepareDate($_POST['fromDate'])) && $countmonthesult_summary['date']<=nl2br(prepareDate($_POST['toDate']))) && $signup_check==1)
	{
		$recieved_TL[$row_summary['tran_id']]=$row_summary['amounttran'];//oldly used
		$recieved_with_tran_id_TL[$row_summary['tran_id']]=$row_summary['amounttran'];
	}
	echo "<tr>";  	
	echo "<td valign='top'><b>" . 	showUser(nl2br( $row_summary['LeadId'])). "<b></td>";
	echo "<td valign='top'>$" . nl2br( $recieved_TL[$row_summary['tran_id']]) . "</td>";
	echo "</tr>"; 
}
}
//COMMENTING the old sum of RECURRING ONLY
/*
echo "<tr>";  
echo "<td valign='top'>Sum </td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($recieved_TL)) . "</td>";  
echo "</tr>";
*/
if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227 || $_SESSION['userId']==1 || $_SESSION['userId']==52)
{
	echo "<tr>";  
	echo "<td valign='top'>Sum Actual</td>";  
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($recieved_with_tran_id_TL)) . "</td>";  
	echo "</tr>";
		echo "<tr>";  
	echo "<td valign='top'>Sum Actual 2</td>";  
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br($recurr) . "</td>";  
	echo "</tr>";
}
echo "</table>";

include('include/footer.php');?>