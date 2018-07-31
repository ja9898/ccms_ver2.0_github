<? 
include('config.php');
include('include/header.php'); 
//BEST LINKS to Calculate days in a month excluding SAT and Sun
//1)http://board.phpbuilder.com/showthread.php?10341190-Date-function-counting-days-in-a-month-that-excludes-saturdays-and-sundays
//2)https://daveismyname.com/show-working-days-of-a-month-excluding-weekends-with-php-bp#.VPTDBXyUeXU
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
<?php //if($_SESSION['userType']==1){ getTeacherFilter(); }?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?

 ?></div>
<div style="float:left">
<?
//echo "<label style='color:red; font-weight:bold'>NOTE: Don't consider ABSENT ALERT for MAKE OVER classes - <u>Take the Load</u></label>";
?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
</div>
<br><br>
</form>
</div>
<?
$total_target_amount_array=array();
$total_rec_amount_array=array();
$per_day_TTL=array();
$per_day_ATL=array();

	/////////////****************** PER DAY CALCULATION CODE ********************///////////////////////
	$toDate = prepareDate($_POST['toDate']);echo "<br>";
	$toDate = date('Y-m-d', strtotime($toDate . ' + 1 days'));echo "<br>";

	$date1 = $toDate; 
	$date2 = date('Y-m-t'); 
	//$date2 = date('t-m-Y'); 

	# Do some checks here for valid dates and to make sure date1 is less than date2 

	# Time strings 
	$time1 = strtotime($date1); echo "<br>";
	$time2 = strtotime($date2); echo "<br>";

	$days = 1; 
	while($time1 < $time2) { 
	   $chk = date('D', $time1); # Actual date conversion 
	   if($chk != 'Sun') 
		  $days++;

	   $time1 += 86400; # Add a day 
	} 

	$days;
	//echo ' days between '.$date1.' and '.$date2;
	/////////////************************************ \********************///////////////////////
	
	
	//Target Amount SUM - TEACHER TEAMLEADS
	$sql_target_amount_sum="SELECT user_type,fromDate,SUM(amount) as target_amount_sum FROM campus_target_table WHERE LeadId!=0 AND user_type=8 AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND '".date('m',strtotime($_POST['toDate']))."' = month(campus_target_table.fromDate)) and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."'AND '".date('Y',strtotime($_POST['toDate']))."' = year(campus_target_table.fromDate)) and campus_target_table.fromDate!='' ";
	$result_target_amount_sum=mysql_query($sql_target_amount_sum) or die(mysql_error());
	echo "<tr>";
		while($row_target_amount_sum = mysql_fetch_array($result_target_amount_sum)){ 
		//$total_target_amount_array[$row_target_amount_sum['id']] = $row_target_amount_sum['amount'];
		$target_amount_sum_REC = $row_target_amount_sum['target_amount_sum'];
	}
	
	//Received Amount SUM - TEACHER TEAMLEADS
	$sql_rec_amount_sum="SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime, 
	campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	SUM(campus_transaction.amount) as rec_amount_sum,
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and campus_schedule.duedate!=campus_transaction.date 
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.LeadId AND campus_target_table.user_type=8 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' ";
	$result_rec_amount_sum=mysql_query($sql_rec_amount_sum) or die(mysql_error());
		while($row_rec_amount_sum = mysql_fetch_array($result_rec_amount_sum)){ 
		$rec_amount_sum = $row_rec_amount_sum['rec_amount_sum'];
	}
	$remaining_amount_sumORresult = $target_amount_sum_REC - $rec_amount_sum;
	$per_day_TTL_TOTAL ;
	
	
//Received Amount SUM, Individual TEACHER TEAMLEAD WISE- TEACHER TEAMLEADS
$sql="SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime, 
	campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	SUM(campus_transaction.amount) as amount_converted,
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and campus_schedule.duedate!=campus_transaction.date 
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.LeadId AND campus_target_table.user_type=8 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' 
	GROUP BY campus_transaction.LeadId  ORDER BY  campus_target_table.LeadId ASC";
	$result=mysql_query($sql) or die(mysql_error());
	while($row = mysql_fetch_array($result)){ 
  
showUser(nl2br( $row['LeadId'])); 
$row['amount'];
$row['amount_converted'];
$remaining = ($row['amount'] - $row['amount_converted']);
$per_day_TTL[$row['tran_id']] = $remaining/$days;

} 
//PER DAY TTL
$per_day_TTL_TOTAL = array_sum($per_day_TTL);




//Target Amount SUM - AGENT TEAMLEADS
	$sql_target_amount_sum="SELECT user_type,fromDate,SUM(amount) as target_amount_sum FROM campus_target_table WHERE LeadId!=0 AND user_type=16 AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND '".date('m',strtotime($_POST['toDate']))."' = month(campus_target_table.fromDate)) and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."'AND '".date('Y',strtotime($_POST['toDate']))."' = year(campus_target_table.fromDate)) and campus_target_table.fromDate!='' ";
	$result_target_amount_sum=mysql_query($sql_target_amount_sum) or die(mysql_error());
	echo "<tr>";
		while($row_target_amount_sum = mysql_fetch_array($result_target_amount_sum)){ 
		//$total_target_amount_array[$row_target_amount_sum['id']] = $row_target_amount_sum['amount'];
		$target_amount_sum_SU = $row_target_amount_sum['target_amount_sum'];
	}
	
	//SignUp Amount SUM - AGENT TEAMLEADS
	$sql_SU_amount_sum="SELECT campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as SU_amount_sum,
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type 
	FROM campus_transaction 
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.main_agentLeadId AND 
	campus_target_table.user_type=16 AND campus_transaction.campus=1 AND 
	campus_transaction.courseID!=27 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' ";
	$result_SU_amount_sum=mysql_query($sql_SU_amount_sum) or die(mysql_error());
		while($row_SU_amount_sum = mysql_fetch_array($result_SU_amount_sum)){ 
		$SU_amount_sum = $row_SU_amount_sum['SU_amount_sum'] ;
	}
	$SU_amount_sumORresult = $target_amount_sum_SU - $SU_amount_sum;
	$per_day_ATL_TOTAL;



	//SignUp Amount SUM, Individual Agent TEAMLEAD WISE - AGENT TEAMLEADS 
	$day_night_new="SELECT campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as amount_converted_SU,
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type 
	FROM campus_transaction 
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.main_agentLeadId AND 
	campus_target_table.user_type=16 AND campus_transaction.campus=1 AND 
	campus_transaction.courseID!=27 AND  
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' 
	GROUP BY campus_target_table.LeadId ORDER BY  campus_target_table.LeadId ASC";
	$result_day_night_new=mysql_query($day_night_new) or die(mysql_error());	
	while($row_day_night_new = mysql_fetch_array($result_day_night_new)){ 

showUser(nl2br( $row_day_night_new['main_agentLeadId']));
$row_day_night_new['amount'];
$row_day_night_new['amount_converted_SU'];
$remaining_day_night_new = ($row_day_night_new['amount'] - $row_day_night_new['amount_converted_SU']);
$per_day_ATL[$row_day_night_new['tran_id']] = $remaining_day_night_new/$days;

	}
//PER DAY ATL

$per_day_ATL_TOTAL = array_sum($per_day_ATL);
	
	
//LAHORE
//echo "***************************************";
$day_night_new="SELECT campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as amount_converted_SU_LHR, 
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type 
	FROM campus_transaction 
	
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.campus AND 
	campus_transaction.campus=2 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' 
	
	GROUP BY campus_transaction.campus  ORDER BY  campus_transaction.campus ASC ";
	$result_day_night_new=mysql_query($day_night_new) or die(mysql_error());	
//echo "***************************************";
while($row_day_night_new = mysql_fetch_array($result_day_night_new)){ 
getData(nl2br( $row_day_night_new['campus']),'campus');
$LHR_total = $row_day_night_new['amount'];
$LHR_rec = $row_day_night_new['amount_converted_SU_LHR'];
}
$remaining_LHR_total = $LHR_total - $LHR_rec;

//ASSIGNMENTS 
$assignments="SELECT campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as amount_converted_assignments  
	FROM campus_transaction 
	WHERE 
	campus_transaction.courseID=27 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!=''  
	GROUP BY campus_transaction.courseID  ";
	$result_assignments=mysql_query($assignments) or die(mysql_error());	
while($row_assignments = mysql_fetch_array($result_assignments)){ 

$assignments_total = $row_assignments['amount_converted_assignments'];

}

//TOTAL SUMS
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'></th>";  
echo "<th class='specalt' style='color:RED;'><b>Total Amount</b></th>"; 
echo "<th class='specalt' style='color:RED;'><b>Received Amount</b></th>"; 
echo "<th class='specalt' style='color:RED;'><b>Remaining</b></th>";
echo "<th class='specalt' style='color:RED;'></th>";
echo "</tr>";

echo "<tr>";  
echo "<td valign='top'></td>";
echo "<td valign='top' style='background-color:yellow'>" . $total = $target_amount_sum_REC+$target_amount_sum_SU+$LHR_total . "</td>";
echo "<td valign='top' style='background-color:yellow'>" . $Received = $rec_amount_sum+$SU_amount_sum+$LHR_rec  +  ($assignments_total) . "</td>";
echo "<td valign='top' style='background-color:yellow'>" . $Remaining = $total - $Received . "</td>";
echo "<td valign='top'></td>";//$remaining_amount_sumORresult+$SU_amount_sumORresult
echo "</tr>";
echo "</table>";


















//RECEIVED/RECURRING PORTION
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>Teamlead</b></th>";  
echo "<th class='specalt' style='color:RED;'><b>Target Amount</b></th>"; 
echo "<th class='specalt' style='color:RED;'><b>Received Amount</b></th>"; 
echo "<th class='specalt' style='color:RED;'><b>Remaining</b></th>";
echo "<th class='specalt' style='color:RED;'><b>Per Day</b></th>"; 
echo "</tr>"; 
	
if($_SESSION['userType']==1){
	//Target Amount SUM - TEACHER TEAMLEADS
	$sql_target_amount_sum="SELECT user_type,fromDate,SUM(amount) as target_amount_sum FROM campus_target_table WHERE LeadId!=0 AND user_type=8 AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND '".date('m',strtotime($_POST['toDate']))."' = month(campus_target_table.fromDate)) and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."'AND '".date('Y',strtotime($_POST['toDate']))."' = year(campus_target_table.fromDate)) and campus_target_table.fromDate!='' ";
	$result_target_amount_sum=mysql_query($sql_target_amount_sum) or die(mysql_error());
	echo "<tr>";
		while($row_target_amount_sum = mysql_fetch_array($result_target_amount_sum)){ 
		//$total_target_amount_array[$row_target_amount_sum['id']] = $row_target_amount_sum['amount'];
		echo "<td valign='top'> </td>";
		echo "<td valign='top' style='background-color:yellow'>" . $target_amount_sum_REC = $row_target_amount_sum['target_amount_sum']  . "</td>";
	}
	
	//Received Amount SUM - TEACHER TEAMLEADS
	$sql_rec_amount_sum="SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime, 
	campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	SUM(campus_transaction.amount) as rec_amount_sum,
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and campus_schedule.duedate!=campus_transaction.date 
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.LeadId AND campus_target_table.user_type=8 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' ";
	$result_rec_amount_sum=mysql_query($sql_rec_amount_sum) or die(mysql_error());
		while($row_rec_amount_sum = mysql_fetch_array($result_rec_amount_sum)){ 
		echo "<td valign='top' style='background-color:yellow'>" . $rec_amount_sum = $row_rec_amount_sum['rec_amount_sum']  . "</td>";
	}
	echo "<td valign='top' style='background-color:yellow'>" . $remaining_amount_sumORresult = $target_amount_sum_REC - $rec_amount_sum  . "</td>";
	echo "<td valign='top' style='background-color:yellow'>" . $per_day_TTL_TOTAL . " </td>";
	echo "</tr>";
	
	
	
	
	//Received Amount SUM, Individual TEACHER TEAMLEAD WISE- TEACHER TEAMLEADS
	$sql="SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime, 
	campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	SUM(campus_transaction.amount) as amount_converted,
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and campus_schedule.duedate!=campus_transaction.date 
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.LeadId AND campus_target_table.user_type=8 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' 
	GROUP BY campus_transaction.LeadId  ORDER BY  campus_target_table.LeadId ASC";
	$result=mysql_query($sql) or die(mysql_error());	
	}
	
	/////////////****************** PER DAY CALCULATION CODE ********************///////////////////////
	$toDate = prepareDate($_POST['toDate']);echo "<br>";
	$toDate = date('Y-m-d', strtotime($toDate . ' + 1 days'));echo "<br>";

	$date1 = $toDate; 
	$date2 = '2015-04-30'; 
	//$date2 = date('t-m-Y'); 

	# Do some checks here for valid dates and to make sure date1 is less than date2 

	# Time strings 
	$time1 = strtotime($date1); echo "<br>";
	$time2 = strtotime($date2); echo "<br>";

	$days = 1; 
	while($time1 < $time2) { 
	   $chk = date('D', $time1); # Actual date conversion 
	   if($chk != 'Sun') 
		  $days++;

	   $time1 += 86400; # Add a day 
	} 

	$days;
	//echo ' days between '.$date1.' and '.$date2;
	/////////////************************************ \********************///////////////////////

//while($row = mysql_fetch_array($result)){ 
//echo $row['tran_id'];echo "----";echo $row['id'];echo "<br>";


while($row = mysql_fetch_array($result)){ 
echo "<tr>";  
echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>";
echo "<td valign='top' style='color:GREEN;'>" . $row['amount'] . "</td>";
echo "<td valign='top' style='color:GREEN;'>" . $row['amount_converted'] . "</td>";
echo "<td valign='top' style='color:GREEN;'>" . $remaining = ($row['amount'] - $row['amount_converted']) . "</td>";
echo "<td valign='top' style='color:GREEN;'>" . $per_day_TTL[$row['tran_id']] = $remaining/$days . "</td>";
echo "</tr>"; 
} 
//PER DAY TTL
//echo "<tr>";  
//echo "<td valign='top'></td>";
//echo "<td valign='top'></td>";
//echo "<td valign='top'></td>";
//echo "<td valign='top'></td>";
//echo "<td valign='top'>" . $per_day_TTL_TOTAL = array_sum($per_day_TTL) . "</td>";
//echo "</tr>"; 
echo "</table>";


//SIGN UP PORTION
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>SIGNUP - Teamlead</b></th>";  
echo "<th class='specalt' style='color:RED;'><b>SIGNUP - Target Amount</b></th>"; 
echo "<th class='specalt' style='color:RED;'><b>SIGNUP - Received Amount</b></th>"; 
echo "<th class='specalt' style='color:RED;'><b>Remaining</b></th>";
echo "<th class='specalt' style='color:RED;'><b>Per Day</b></th>"; 
echo "</tr>"; 

	//Target Amount SUM - AGENT TEAMLEADS
	$sql_target_amount_sum="SELECT user_type,fromDate,SUM(amount) as target_amount_sum FROM campus_target_table WHERE LeadId!=0 AND user_type=16 AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND '".date('m',strtotime($_POST['toDate']))."' = month(campus_target_table.fromDate)) and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."'AND '".date('Y',strtotime($_POST['toDate']))."' = year(campus_target_table.fromDate)) and campus_target_table.fromDate!='' ";
	$result_target_amount_sum=mysql_query($sql_target_amount_sum) or die(mysql_error());
	echo "<tr>";
		while($row_target_amount_sum = mysql_fetch_array($result_target_amount_sum)){ 
		//$total_target_amount_array[$row_target_amount_sum['id']] = $row_target_amount_sum['amount'];
		echo "<td valign='top'> </td>";
		echo "<td valign='top' style='background-color:yellow'>" . $target_amount_sum_SU = $row_target_amount_sum['target_amount_sum']+$LHR_total  . "</td>";
	}
	
	//SignUp Amount SUM - AGENT TEAMLEADS
	$sql_SU_amount_sum="SELECT campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as SU_amount_sum,
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type 
	FROM campus_transaction 
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.main_agentLeadId AND 
	campus_target_table.user_type=16 AND campus_transaction.campus=1 AND 
	campus_transaction.courseID!=27 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' ";
	$result_SU_amount_sum=mysql_query($sql_SU_amount_sum) or die(mysql_error());
		while($row_SU_amount_sum = mysql_fetch_array($result_SU_amount_sum)){ 
		echo "<td valign='top' style='background-color:yellow'>" . $SU_amount_sum = $row_SU_amount_sum['SU_amount_sum']+$LHR_rec  +  ($assignments_total) . "</td>";
	}
	echo "<td valign='top' style='background-color:yellow'>" . $SU_amount_sumORresult = $target_amount_sum_SU - $SU_amount_sum  . "</td>";
	echo "<td valign='top' style='background-color:yellow'>" . $per_day_ATL_TOTAL . "</td>";
	echo "</tr>";

	
	//SignUp Amount SUM, Individual Agent TEAMLEAD WISE - AGENT TEAMLEADS 
	$day_night_new="SELECT campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as amount_converted_SU,
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type 
	FROM campus_transaction 
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.main_agentLeadId AND 
	campus_target_table.user_type=16 AND campus_transaction.campus=1 AND 
	campus_transaction.courseID!=27 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' 
	GROUP BY campus_target_table.LeadId ORDER BY  campus_target_table.LeadId ASC";
	$result_day_night_new=mysql_query($day_night_new) or die(mysql_error());	
	while($row_day_night_new = mysql_fetch_array($result_day_night_new)){ 
	echo "<tr>";  
	echo "<td valign='top'>" . showUser(nl2br( $row_day_night_new['main_agentLeadId'])) . "</td>";
	echo "<td valign='top' style='color:GREEN;'>" . $row_day_night_new['amount'] . "</td>";
	echo "<td valign='top' style='color:GREEN;'>" . $row_day_night_new['amount_converted_SU'] . "</td>";
	echo "<td valign='top' style='color:GREEN;'>" . $remaining_day_night_new = ($row_day_night_new['amount'] - $row_day_night_new['amount_converted_SU']) . "</td>";
	echo "<td valign='top' style='color:GREEN;'>" . $per_day_ATL[$row_day_night_new['tran_id']] = $remaining_day_night_new/$days . "</td>";
	echo "</tr>"; 
	} 

//LAHORE
//echo "***************************************";
$day_night_new="SELECT campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amount_original_sum,
	campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	SUM(campus_transaction.amount) as amount_converted_SU_LHR, 
	campus_target_table.id as ctt_id,campus_target_table.LeadId,campus_target_table.amount, 
	campus_target_table.fromDate,campus_target_table.toDate,campus_target_table.user_type 
	FROM campus_transaction 
	
	INNER JOIN campus_target_table ON 
	campus_target_table.LeadId = campus_transaction.campus AND 
	campus_transaction.campus=2 AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' AND 
	(month(campus_target_table.fromDate) = '".date('m',strtotime($_POST['fromDate']))."' AND  month(campus_target_table.toDate) = '".date('m',strtotime($_POST['toDate']))."') and 
	(year(campus_target_table.fromDate) = '".date('Y',strtotime($_POST['fromDate']))."' AND year(campus_target_table.toDate) = '".date('Y',strtotime($_POST['toDate']))."') and campus_target_table.fromDate!='' 
	
	GROUP BY campus_transaction.campus  ORDER BY  campus_transaction.campus ASC ";
	$result_day_night_new=mysql_query($day_night_new) or die(mysql_error());	
//echo "***************************************";
while($row_day_night_new = mysql_fetch_array($result_day_night_new)){ 
echo "<tr>";  
echo "<td valign='top' >" .  getData(nl2br( $row_day_night_new['campus']),'campus') . "</td>";
echo "<td valign='top' style='background-color:yellow'>" . $LHR_total = $row_day_night_new['amount'] . "</td>";
echo "<td valign='top' style='background-color:yellow'>" . $LHR_rec = $row_day_night_new['amount_converted_SU_LHR'] . "</td>";
echo "<td valign='top' style='background-color:yellow'>" . $remaining_LHR_total = $LHR_total - $LHR_rec . "</td>";
echo "<td valign='top' style='background-color:yellow'>" . $per_day_LHR= $remaining_LHR_total/$days .  "</td>";
echo "</tr>"; 
} 



//PER DAY ATL
//echo "<tr>";  
//echo "<td valign='top'></td>";
//echo "<td valign='top'></td>";
//echo "<td valign='top'></td>";
//echo "<td valign='top'></td>";
//echo "<td valign='top'>" . array_sum($per_day_ATL) . "</td>";
//echo "</tr>"; 
echo "</table>";

/*
echo $day_night_old_with_campus_sch = "SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,
campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,
SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,
campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.agentId 
FROM capmus_users 
INNER JOIN campus_schedule 
ON campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'  and campus_schedule.std_status='2' 
and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 
GROUP BY capmus_users.LeadId "; 
$result_day_night_old_with_campus_sch=mysql_query($day_night_old_with_campus_sch);
while($row_day_night_old_with_campus_sch = mysql_fetch_array($result_day_night_old_with_campus_sch)){
echo "<td valign='top' style='color:GREEN;'>" . showUser(nl2br( $row_day_night_old_with_campus_sch['LeadId'])) . "</td>";
echo "<td valign='top' style='color:GREEN;'>" . $row_day_night_old_with_campus_sch['dues'] . "</td>";
}
*/

//Assignments table
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
 
echo "<th class='specalt' style='color:RED;'><b>Assignments</b></th>"; 
echo "<th class='specalt' style='color:RED;'><b>Assignments - Received Amount</b></th>"; 
echo "</tr>"; 

echo "<tr>";  
echo "<td valign='top' style='background-color:yellow'>Assignments</td>";
echo "<td valign='top' style='background-color:yellow'>" . ($assignments_total) . "</td>";
echo "</tr>";
echo "</table>";

//Payment Method Amounts
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'>Method</th>";
echo "<th class='specalt'>Amount Sum</th>";
echo "</tr>"; 
$sql_payment_method=" SELECT 
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original,campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId ,
	SUM(campus_transaction.amount) as amount_converted  
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` = 1  and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' 
	GROUP BY campus_transaction.method_array ";
	$result_payment_method = mysql_query($sql_payment_method) or trigger_error(mysql_error());
	while($row_payment_method = mysql_fetch_array($result_payment_method)){ 
		echo "<tr>";  
		echo "<td valign='top'>" .  getData(nl2br( $row_payment_method['method_array']),'paymentMode') . "</td>";
		echo "<td valign='top'>" .  nl2br( $row_payment_method['amount_converted']) . "</td>";
		echo "</tr>";
	}


//Missing Record/Payments ??????????????????????????????????????????????????????
$total_tranId_count_array=array();
$total_amount_sum_array=array();

echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>Paypal Date</b></th>";
echo "<th class='specalt'><b>Tran Date</b></th>";
echo "<th class='specalt'><b>Tran ID Count</b></th>";
//TEACHER TEAMLEAD Commented for now  
//echo "<th class='specalt'><b>Teamlead</b></th>";  
echo "<th class='specalt' style='color:RED;'><b>Amount</b></th>"; 
echo "<th class='specalt'><b>time</b></th>"; 
echo "<th class='specalt'><b>timezone</b></th>"; 
echo "<th class='specalt'>currency</th>"; 
echo "<th class='specalt'>gross</th>"; 
echo "<th class='specalt'>fromemail</th>";
echo "<th class='specalt'>TRANSACTED</th>";
echo "<th class='specalt'>PAYPAL</th>";
echo "</tr>"; 

if($_SESSION['userType']==1){
	//count(DISTINCT campus_transaction.transactionID) as tranId_count,
	//SUM(campus_transaction.amount_original)
	//campus_transaction_paypal.transactionId=campus_transaction.transactionID
	//campus_transaction_paypal.transactionId LIKE CONCAT('%', campus_transaction.transactionID, '%')
	//GROUP BY campus_transaction_paypal.fromemail 
	
	//DATE-Add later
	//(campus_transaction_paypal.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."') and 
	
	$sql="SELECT 
	campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	SUM(campus_transaction.amount_original) as amount_original_sum,
	campus_transaction_paypal.id,campus_transaction_paypal.transactionId as tranId_paypal,campus_transaction_paypal.gross, 
	campus_transaction_paypal.fromemail,campus_transaction_paypal.currency,
	campus_transaction_paypal.date as paypal_date 	
	FROM campus_transaction
	RIGHT OUTER JOIN campus_transaction_paypal ON 
	campus_transaction_paypal.fromemail = campus_transaction.email AND 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and 
	campus_transaction_paypal.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and 
	
	campus_transaction.date!='' 
	GROUP BY campus_transaction.email  ORDER BY  campus_transaction_paypal.date ASC";
	$result=mysql_query($sql) or die(mysql_error());	
	}

while($row = mysql_fetch_array($result)){ 
//echo $row['tran_id'];echo "----";echo $row['id'];echo "<br>";
echo "<tr>";  
//if($row['amount_original_sum']=='')
//{
//echo "<td valign='top'>" . $total_tranId_count_array[$row['tran_id']] = $row['tranId_count'] . "</td>";
echo "<td valign='top'>" . $row['paypal_date'] . "</td>";
echo "<td valign='top'>" . $row['date_rec_cam_tran'] . "</td>";
echo "<td valign='top'>" . $row['tranId_count'] . "</td>";
//TEACHER TEAMLEAD Commented for now
//echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>";

if($row['amount_original_sum']>=$row['gross'])
echo "<td valign='top' style='color:GREEN;'>" . $row['amount_original_sum'] . "</td>";
else
echo "<td valign='top' style='color:RED;'>" . $row['amount_original_sum'] . "</td>";
echo "<td valign='top'>" . nl2br( $row['time']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['timezone']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['currency']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['gross']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['fromemail']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['tranId_transaction']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['tranId_paypal']) . "</td>";
echo "</tr>"; 
//}
}

echo "</table>";










//TOTAL SUMS
/* echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'></th>";  
echo "<th class='specalt' style='color:RED;'><b>Total Amount</b></th>"; 
echo "<th class='specalt' style='color:RED;'><b>Received Amount</b></th>"; 
echo "<th class='specalt' style='color:RED;'><b>Remaining</b></th>";
echo "<th class='specalt' style='color:RED;'></th>";
echo "</tr>";

echo "<tr>";  
echo "<td valign='top'></td>";
echo "<td valign='top'>" . $total = $target_amount_sum_REC+$target_amount_sum_SU . "</td>";
echo "<td valign='top'>" . $Received = $rec_amount_sum+$SU_amount_sum. "</td>";
echo "<td valign='top'>" . $Remaining = $remaining_amount_sumORresult+$SU_amount_sumORresult . "</td>";
echo "<td valign='top'></td>";
echo "</tr>";
echo "</table>"; */


include('include/footer.php');
?>