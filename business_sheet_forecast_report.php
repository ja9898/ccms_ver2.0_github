<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
&nbsp;&nbsp;
&nbsp;&nbsp;
</div>
<br><br>

<div style="float:left">
<?php
//getFilterSubmit();
?></div>
<br>

</form>
</div>
<?
//if(isset($_POST['search-submit']))
//{
	$systemdate = systemDate();
	//echo "<label><b>CCMS From/To  Date</b></label>";	
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate_ccms = date('Y-m-t', strtotime($systemdate));
	//echo "<label><b>Server From/To Date</b></label>";
	$fromDate = date('Y-m-01');
	$toDate = date('Y-m-t');	
	
	///////////////////////////////////////////////////////////// PAYING AMOUNT - START
	$paying_amount=array();
 	//Paying Amount: Following query is for paying amount
	$sql_paying_amount="SELECT id,SUM(dues) as paying_amount,std_status,`status` 
			FROM campus_schedule 
			WHERE campus_schedule.std_status=2 ";
	$result_paying_amount = mysql_query($sql_paying_amount); 
	$row_paying_amount = mysql_fetch_assoc($result_paying_amount); 
	
	$paying_amount = $row_paying_amount['paying_amount'];

	////////////////////////////////////////////////////////////// PAYING AMOUNT - END
	
	//THIS IS OBSOLETE XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	///////////////////////////////////////////////////////////// signup current month- START
	$sql_signup="SELECT campus_transaction.id as tran_id_SU,
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
	SUM(campus_transaction.amount_usd_simple) as SU_amount_usd_simple 
	FROM campus_transaction 
	WHERE campus_transaction.campus=1 AND 
	campus_transaction.date BETWEEN '".$fromDate_ccms."' AND '".$toDate_ccms."' and campus_transaction.date!=''  "; 
	$result_signup = mysql_query($sql_signup);
	$row_signup=mysql_fetch_assoc($result_signup);
	
	$signup_current_NOT_IN_USE=round($row_signup['SU_amount_usd_simple'],2);

	////////////////////////////////////////////////////////////// signup day,count- END
	//XXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXXX
	
	///////////////////////////////////////////////////////////// Dead Regular student - START

	$sql_DEAD_Reg=" SELECT id,SUM(dues) as DEAD_Reg_amount,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status='3' AND 
			DATE(campus_schedule.confirm_dead_date)>='".$fromDate_ccms."' and DATE(campus_schedule.confirm_dead_date)<= '".$toDate_ccms."' ";
	$result_DEAD_Reg = mysql_query($sql_DEAD_Reg);
	$row_DEAD_Reg=mysql_fetch_assoc($result_DEAD_Reg);
		
	$DEAD_Reg=$row_DEAD_Reg['DEAD_Reg_amount'];

	////////////////////////////////////////////////////////////// Dead Regular student - END
	
	
	/////////////////////////////////////////////// Total Recurr Received amount of Current Month - START
	$amount=array();
	$recieved=array();
	$recieved_with_tran_id=array();
	$usd_convert_recieved=array();
	$usd_convert_recieved_with_tran_id=array();

	$pending =array();
	$signups =array();
	$usd_convert_signups=array();

	$recieved_usd=array();
	$recieved_usd_with_tran_id=array();
	$signups_usd =array();
	$signups_usd_with_tran_id =array();
	$discount =array();
	
	
	$sql_Total_Recurr_Rec="SELECT campus_schedule.id,campus_schedule.duedate as due_date,
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
	campus_transaction.datetime_now_accounts,campus_transaction.bank_payment_image_filepath,
	campus_transaction.discount_tran,campus_transaction.amount_original_deducted 
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".$fromDate_ccms."' AND '".$toDate_ccms."' and campus_transaction.date!='' ";
	
	$result_Total_Recurr_Rec = mysql_query($sql_Total_Recurr_Rec) or trigger_error(mysql_error());
	while($row_Total_Recurr_Rec=mysql_fetch_array($result_Total_Recurr_Rec))
	{
		$signup_check=1;
		$countresult=$row_Total_Recurr_Rec['amount'];

		$countmonthsql="select amount as amounttran_not_main,date,dateRecieved,operator,id FROM campus_transaction where date BETWEEN '".$fromDate_ccms."' AND '".$toDate_ccms."' and studentID=".$row_Total_Recurr_Rec['studentID']." and schedule_id=".$row_Total_Recurr_Rec['id']." and id=".$row_Total_Recurr_Rec['tran_id']." "; 
		$countmonthesult=mysql_query($countmonthsql);
		$countmonthesult=mysql_fetch_assoc($countmonthesult);
		$amount[$row_Total_Recurr_Rec['id']]=$countresult;
		
		$discount[$row_Total_Recurr_Rec['id']] = $row_Total_Recurr_Rec['discount_tran'];

		//DUE DATE(Signup DATE) - Month and Year
		$duedate_month = date('m', strtotime(nl2br($row_Total_Recurr_Rec['due_date'])));
		$duedate_year = date('Y', strtotime(nl2br($row_Total_Recurr_Rec['due_date'])));
		
		//DUE DATE(Signup DATE) - Month and Year
		$dateRec_month = date('m', strtotime(nl2br($countmonthesult['dateRecieved'])));
		$dateRec_year = date('Y', strtotime(nl2br($countmonthesult['dateRecieved'])));
		
		if(($row_Total_Recurr_Rec['due_date']>=nl2br(prepareDate($fromDate_ccms)) && $row_Total_Recurr_Rec['due_date']<=nl2br(prepareDate($toDate_ccms))) && $row_Total_Recurr_Rec['due_date']==$countmonthesult['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
		{
			if(($row_Total_Recurr_Rec['method_array']==2 || $row_Total_Recurr_Rec['method_array']==3 || $row_Total_Recurr_Rec['method_array']==4 || $row_Total_Recurr_Rec['method_array']==5) && $row_Total_Recurr_Rec['accounts_chk']!=1)
			{
				$signups[$row_Total_Recurr_Rec['id']]=0;
				$signup_check=0;
				$signups_usd[$row_Total_Recurr_Rec['id']]=0;
				$signups_usd_with_tran_id[$row_Total_Recurr_Rec['tran_id']]=0;
			}
			else
			{
				$signups[$row_Total_Recurr_Rec['id']]=$row_Total_Recurr_Rec['amounttran'];
				$signup_check=0;
				$signups_usd[$row_Total_Recurr_Rec['id']]=$row_Total_Recurr_Rec['amount_usd_simple'];
				$signups_usd_with_tran_id[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount_usd_simple'];
			}
		}
		else
		{
		//$signup_check==1;
		}

		if(!empty($countresult) && ($countmonthesult['date']>=nl2br(prepareDate($fromDate_ccms)) && $countmonthesult['date']<=nl2br(prepareDate($toDate_ccms))) && $signup_check==1)
		{
			if(($row_Total_Recurr_Rec['method_array']==2 || $row_Total_Recurr_Rec['method_array']==3 || $row_Total_Recurr_Rec['method_array']==4 || $row_Total_Recurr_Rec['method_array']==5) && $row_Total_Recurr_Rec['accounts_chk']!=1)
			{
				$recieved[$row_Total_Recurr_Rec['id']]=0;//oldly used
				$recieved_with_tran_id[$row_Total_Recurr_Rec['tran_id']]=0;
				$recieved_usd[$row_Total_Recurr_Rec['id']]=0;
				$recieved_usd_with_tran_id[$row_Total_Recurr_Rec['tran_id']]=0;
			}
			else
			{
				$recieved[$row_Total_Recurr_Rec['id']]=$row_Total_Recurr_Rec['amounttran'];//oldly used
				$recieved_with_tran_id[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amounttran'];
				$recieved_usd[$row_Total_Recurr_Rec['id']]=$row_Total_Recurr_Rec['amount_usd_simple'];
				$recieved_usd_with_tran_id[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount_usd_simple'];
			}

		}

		
		$systemdate = systemDate();
		$receivedDate_strtotime = strtotime($row_Total_Recurr_Rec['date_rec_cam_tran']);
		$systemDate_strtotime = strtotime($systemdate);
		


		$recieved[$row_Total_Recurr_Rec['id']];
		$signups[$row_Total_Recurr_Rec['id']];
		$row_Total_Recurr_Rec['amounttran_gbp'];

	
	}
	

	$recurr_received = array_sum($recieved_usd_with_tran_id);
	$signup_current = array_sum($signups_usd_with_tran_id);
	

	//////////////////////////////////////////////// Total Recurr Received amount of Current Month - END

	

	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	//Get last row of currency rates and convert to usd rate from db
/* 	$sql_last_dollar_rate_USDval="SELECT    *
	FROM      campus_currency 
	ORDER BY  id DESC
	LIMIT     1;";
	$row_last_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_last_dollar_rate_USDval));
	$row_last_dollar_rate_USDval['1_cad_to_usd_new']; */
	
	
	//1st table for the BUSINESS SHEET start - 
	//a) Paying amount b) Dead Regular c) Total recurr received d) Signup amount
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	///////////////////////////////////// PAYING AMOUNT, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Expected Recurring</b></th>";
		//CAD to USD conversion***
		$paying_amount_variable_usd = $paying_amount;
		//************************
		
		//Subtracting NEW SIGNUPS from PAYING AMOUNT to have total RECEIVABLE
		$paying_amount_variable_usd = $paying_amount_variable_usd - $signup_current;
		//************************
	echo "<td valign='top'>$ ". $paying_amount_variable = round($paying_amount_variable_usd,2) . "</td>";
	echo "</tr>"; 
	///////////////////////////////////// PAYING AMOUNT, result - end
	
	
	///////////////////////////////////// Dead Regular student, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total DEAD=REGULAR Amount</b></th>";
	echo "<td valign='top'>$ ". $DEAD_Reg_variable =  round($DEAD_Reg,2) . "</td>";
	echo "</tr>";
	///////////////////////////////////// Dead Regular student, result - end
	
	
	///////////////////////////////////// Gross Rec - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Gross Rec</b></th>";
	echo "<td valign='top'>$ ".  $gross_rec = round($paying_amount_variable - $DEAD_Reg_variable,2) . "</td>";
	echo "</tr>";
	///////////////////////////////////// Gross Rec - end
	
	
	///////////////////////////////////// Total Recurr Received amount of Current Month, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Received Amount-Current Month</b></th>";
	echo "<td valign='top'>$ ". $recurr_received ."</td>";
	echo "</tr>";

	///////////////////////////////////// Total Recurr Received amount of Current Month, result - end
	
	///////////////////////////////////// Net Receivable - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Net Receivable</b></th>";
	echo "<td valign='top'>$ ". $net_rec = round($gross_rec - $recurr_received,2) ."</td>";
	echo "</tr>";
	///////////////////////////////////// Net Receivable - end
	
	///////////////////////////////////// Dead Regular student, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<td class='specalt'><b><span style='color:green'>Signup Amount </span></b></td>";
	echo "<td valign='top'><span style='color:green'>$ ". $signup_current . "</span></td>";;
	echo "</tr>";
	///////////////////////////////////// Dead Regular student, result - end
	
	///////////////////////////////////// NEXT MONTH Expected Amount - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>NEXT MONTH Expected Recurring</b></th>";
	echo "<td valign='top'>$ ". $next_month_recurr = round($gross_rec + $signup_current,2) ."</td>";
	echo "</tr>";
	///////////////////////////////////// NEXT MONTH Expected Amount - end
	echo "</table>";

	
	

	?>
	
<form action='' method='POST'>
<?
if($_SESSION['userId']==159 || $_SESSION['userId']==48)
{
$total_recurr=$paying_amount_variable;
$DEAD_Reg = $DEAD_Reg_variable;
$gross_rec = $gross_rec;
$recurr_received = $recurr_received;
$net_rec = $net_rec;
$new_signup = $signup_current;
$next_month_recurr = $next_month_recurr;

$systemdatetime = systemDateTime();
$systemdate = systemDate();
//http://www.webeditorsnotes.com/2012/04/six-steps-to-make-wamp-run-automatically-on-system-start-up-2/
if (isset($_POST['submitted'])) 
{
	echo $sql = "INSERT INTO `campus_business_summary` (`total_recurr`, `recurr_received` , `dead_regular`  ,`gross_rec` ,  `net_rec` , `new_signup` , `next_month_recurr`, `operator` , `ccms_datetime` , `curr_datetime` ) VALUES(  '$total_recurr','$recurr_received' , '$DEAD_Reg'  ,  '$gross_rec ' ,  '$net_rec'  ,  '$new_signup' , '$next_month_recurr' , '".$_SESSION['userId']."' , '".$systemdatetime."' , '".date('Y-m-d H:i:s')."'  ) "; 
	mysql_query($sql) or die(mysql_error()); 
	getMessages('add');
	echo "<script>alert('Click OK to Continue')</script>";
	echo "<script>window.location.href = 'business_sheet_forecast_report.php'</script>";
}
}

else {echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";}

//$string = "total_recurr={$total_recurr_curr_month}&advance={$advance}&zero_paid={$zero_paid}&recurr={$recurr}&receivable={$receivable}&freeze_amount={$freeze_amount}&DEAD_Reg={$DEAD_Reg}&pre_month_pending={$pre_month_pending}";
//urlencode($string);
//echo "<td valign='top'><a class=button href=business_sheet_auto.php?{$string}>Insert Values Manually</a></td>";
//echo "</tr>";
//echo "</table>";
?>
<div id="label"></div><div id="field"><input type='submit' value='Insert Values Manually' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 

</form> 

	
	<?
	
	
	/////////////////////////////////// To send email to MANAGEMENT
	
	//1st table of BUSINESS SHEET
	$business_sheet_forecast_email_to_send = "
	<table border='1' id='' cellspacing=2px > 
	<tr bgcolor=#eceff5>
	<td class='' valign='top'><b>Expected Recurring</b></td>
	<td valign='top'>$ ". $paying_amount_variable ."</td>
	</tr>
	
	
	<tr bgcolor=#eceff5>
	<td><b>Total DEAD=REGULAR Amount </b></td>
	<td valign='top'>$ ". $DEAD_Reg_variable . "</td>
	</tr>
	
	<tr bgcolor=#eceff5>
	<td class=''><b>Gross Rec</b></td>
	<td valign='top'>$ ". $gross_rec ."</td>
	</tr>
	
	<tr bgcolor=#eceff5>
	<td class=''><b>Received Amount-Current Month</b></td>
	<td valign='top'>$ ". $recurr_received ."</td>
	</tr>
	
	
	<tr bgcolor=#eceff5>
	<td class=''><b>Net Receivable</b></td>
	<td valign='top'>$ ". $net_rec ."</td>
	</tr>
	
	<tr bgcolor=#eceff5>
	<td valign='top'><span style='color:green'>Signup Amount</span></td>
	<td valign='top'><span style='color:green'>$ ".  $signup_current . "</span></td>
	</tr>
	
	
	<tr bgcolor=#eceff5>
	<td class=''><b>NEXT MONTH Expected Recurring</b></td>
	<td valign='top'>$ ". $next_month_recurr ."</td>
	</tr>";
	
	
	?>	
	<form action='' method='POST'> 
	<input rows="10" cols="90" id='business_sheet_forecast_email_to_send' name='business_sheet_forecast_email_to_send' readonly="readonly" type='hidden' value="<?php echo $business_sheet_forecast_email_to_send; ?>"/>
	<div id="label"></div><div id="field"><input name="sender" type="button" id="sender" value="Send Email" onclick="javascript: forecast_report_send_email_to_management()" /> </div>
	<div id="ajaxdiv_summary_business_sheet_forecast"></div>
	</form>
	<?
	//echo '<script> send_email_to_management(); </script>';
	//"<br/><span style='color:Orange; font-size:16px'>Email From YOURCLOUDCAMPUS</span>\r\n\r\n <br /><br /><b>Dear Mr.Aaqib</b>\r\n\r\n <br/><br/>Please make the following extension id against the numbers given.\r\n\r\n <br/><br/> Ext ID : <b>".$row_get_extid_number['extId']."</b>  \r\n <br>
	//'".ucfirst($_POST['firstName'])."' <br>
	//'".ucfirst($_POST['lastName'])."' <br>
	//'".showUser(nl2br($_SESSION['userId']))."' <br><br>
	//<b>Phone: '".$_POST['phone']."' </b><br><b>Landline : '".$_POST['landline']."' </b> <br><b>Mobile : '".$_POST['mobile']."' </b> <br /><br /><br />Regards, \r\n <br /><b>YCC(YourCloudCampus Management)</b> <br /><br /><br /><br /><br />";

	
	
	///////////////////////////////////////////////////////////////
	
	
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>id</b></th>";
	echo "<th class='specalt'><b>total_recurr</b></th>";
	echo "<th class='specalt'><b>recurr_received</b></th>";
	echo "<th class='specalt'><b>dead</b></th>";
	echo "<th class='specalt'><b>gross rec</b></th>";
	echo "<th class='specalt'><b>net_rec</b></th>";
	echo "<th class='specalt'><b>new_signup</b></th>";
	echo "<th class='specalt'><b>next_month_recurr</b></th>";
	//echo "<th class='specalt'><b>operator</b></th>";
	//echo "<th class='specalt'><b>ccms_datetime</b></th>";
	//echo "<th class='specalt'><b>curr_datetime</b></th>";
	echo "</tr>"; 
	echo "<tr bgcolor=#FF0000>";
	$sql_output="SELECT * FROM campus_business_summary";
	$result=mysql_query($sql_output);
	while($row_output=mysql_fetch_array($result))
	{
		echo "<td valign='top'><b>". $row_output['id'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['total_recurr'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['recurr_received'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['dead_regular'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['gross_rec'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['net_rec'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['new_signup'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['next_month_recurr'] ."</b></td>";
		//echo "<td valign='top'><b>". $row_output['operator'] ."</b></td>";
		//echo "<td valign='top'><b>". $row_output['ccms_datetime'] ."</b></td>";
		//echo "<td valign='top'><b>". $row_output['curr_datetime'] ."</b></td>";
		echo "</tr>"; 
	}
	echo "</tr>"; 	
	echo "</table>";
//}
include('include/footer.php');
?>