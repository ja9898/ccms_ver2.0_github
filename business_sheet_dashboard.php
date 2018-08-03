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
getFilterSubmit();
?></div>
<br>

</form>
</div>
<?
//if(isset($_POST['search-submit']))
//{
	///////////////////////////////////////////////////////////// PAYING AMOUNT - START
	$paying_amount=array();
	//Paying Amount: Following query is for paying amount
	$sql_paying_amount=" SELECT id,dues as paying_amount,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status=2";
	/////////////////////PAYING AMOUNT QUERY END
	$result_paying_amount = mysql_query($sql_paying_amount);
	while($row_paying_amount=mysql_fetch_array($result_paying_amount))
	{
		$paying_amount[$row_paying_amount['id']]=$row_paying_amount['paying_amount'];
	}
	////////////////////////////////////////////////////////////// PAYING AMOUNT - END
	
	
	//1st COPY of FREEZE STUDENTS, DEAD-REGULAR and this FREEZE amount will be added
	///////////////////////////////////////////////////////////// Freeze students amount - START
	//'First Date    = ' . date('Y-m-01') . '<br />';
    //'Last Date     = ' . date('Y-m-t')  . '<br />';
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate_ccms = date('Y-m-t', strtotime($systemdate));
	$sql_freeze=" SELECT id,SUM(dues) as freeze_amount,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status_old=2 AND std_status=4 AND 
			campus_schedule.freeze_date>='".$fromDate_ccms."' and campus_schedule.freeze_date<= '".$toDate_ccms."' ";
	$result_freeze = mysql_query($sql_freeze);
	while($row_freeze=mysql_fetch_array($result_freeze))
	{
		$freeze_amount=$row_freeze['freeze_amount'];
	}
	////////////////////////////////////////////////////////////// Freeze students amount - END
	
	///////////////////////////////////////////////////////////// Dead Regular student - START
	//'First Date    = ' . date('Y-m-01') . '<br />';
    //'Last Date     = ' . date('Y-m-t')  . '<br />';
	echo "<br>";
	echo "<br>";
	echo "<br>";?>
<div id="label">Current Date:</div><div id="field"><label name='LeaveApplied'><?php echo date('Y-m-d') ?> </label></div>
<div id="label">CCMS Date:</div><div id="field"><label name='LeaveApplied'><?php echo $systemdate = systemDate(); ?> </label></div>
<?
	echo "<label><b>Server From/To Date</b></label>";
	$systemdate = systemDate();
	echo $fromDate = date('Y-m-01');
	echo "<br>";
	echo $toDate = date('Y-m-t');
	echo "<br>";	
	echo "<label><b>CCMS From/To  Date</b></label>";	
	echo $fromDate_ccms = date('Y-m-01', strtotime($systemdate));echo "<br>";
	echo $toDate_ccms = date('Y-m-t', strtotime($systemdate));echo "<br>";
	$sql_DEAD_Reg=" SELECT id,SUM(dues) as DEAD_Reg_amount,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status_old=2 AND std_status=3 AND 
			DATE(campus_schedule.confirm_dead_date)>='".$fromDate_ccms."' and DATE(campus_schedule.confirm_dead_date)<= '".$toDate_ccms."' ";
	$result_DEAD_Reg = mysql_query($sql_DEAD_Reg);
	while($row_DEAD_Reg=mysql_fetch_array($result_DEAD_Reg))
	{
		$DEAD_Reg=$row_DEAD_Reg['DEAD_Reg_amount'];
	}
	////////////////////////////////////////////////////////////// Dead Regular student - END
	
	
	
	/////////////////////////////////////////////// Total Recurr Received amount of Current Month - START
	$amount=array();
	$recieved=array();
	$recieved_with_tran_id=array();
	$signups =array();
	
	//Transacted with 0
	$recieved_with_zero=array();
	$recieved_with_zero_tran_id=array();
	//Transacted with 0 AUTO UNFREEZE ZERO PAID	
	$recieved_with_zero_UNFREEZE_AUTO=array();
	
	
	$sql_Total_Recurr_Rec=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_schedule.agentId,
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
		//DUE DATE(Signup DATE) - Month and Year
		$duedate_month = date('m', strtotime(nl2br($row_Total_Recurr_Rec['due_date'])));
		$duedate_year = date('Y', strtotime(nl2br($row_Total_Recurr_Rec['due_date'])));
		
		//DUE DATE(Signup DATE) - Month and Year
		$dateRec_month = date('m', strtotime(nl2br($countmonthesult['dateRecieved'])));
		$dateRec_year = date('Y', strtotime(nl2br($countmonthesult['dateRecieved'])));
		if(($row_Total_Recurr_Rec['due_date']>=$fromDate_ccms && $row_Total_Recurr_Rec['due_date']<=$toDate_ccms) && $row_Total_Recurr_Rec['due_date']==$countmonthesult['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
		{
			$signups[$row_Total_Recurr_Rec['id']]=$row_Total_Recurr_Rec['amount'];
			$signup_check=0;
		}
		else
		{
			//$signup_check==1;
		}

		if(!empty($countresult) && ($countmonthesult['date']>=$fromDate_ccms && $countmonthesult['date']<=$toDate_ccms) && $signup_check==1)
		{
			$recieved[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amounttran'];
			$recieved_with_tran_id[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amounttran'];
		}
		
		//RECEIVED WITH ZERO 0
		if(!empty($countresult) && ($countmonthesult['date']>=$fromDate_ccms && $countmonthesult['date']<=$toDate_ccms) && $signup_check==1)
		{
			if($row_Total_Recurr_Rec['amounttran']==0)
			{
				if($row_Total_Recurr_Rec['std_status_old']==4 && $row_Total_Recurr_Rec['std_status']==2)
				{
				$recieved_with_zero_UNFREEZE_AUTO[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount'];
				}
				else
				{
				$recieved_with_zero[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount'];
				$recieved_with_zero_tran_id[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount'];
				}
			}
		}
	
	}
	$recurr = nl2br( array_sum($recieved));
	$SU = nl2br( array_sum($signups)); 
	
	$recurr_with_zero = nl2br( array_sum($recieved_with_zero));
	$recurr_with_zero_UNFREEZE_AUTO = nl2br( array_sum($recieved_with_zero_UNFREEZE_AUTO));
	
	//$total_income_in_this_month_overall = $recurr + $SU;  
	//////////////////////////////////////////////// Total Recurr Received amount of Current Month - END

	//LAHORE SIGNUP AMOPUNT|||||||||||||||||||||||**************????????????????????????????????????
	///////////////////////////////////////////////////////////// LAHORE SIGNUP- START
	/* $sql_Lahore_SU="SELECT id,SUM(dues) as SU_lhr_amount,status  
	FROM campus_schedule 
	WHERE agentId=565 and status=1 and 
	campus_schedule.duedate>='".$fromDate_ccms."' and campus_schedule.duedate<= '".$toDate_ccms."' ";
	$result_Lahore_SU = mysql_query($sql_Lahore_SU);
	while($row_Lahore_SU=mysql_fetch_array($result_Lahore_SU))
	{
		$SU_lhr=$row_Lahore_SU['SU_lhr_amount'];
	} */
	//NEW CODE FOR LAHORE using campus-Lahore
	$lahore="SELECT campus_transaction.id as tran_id,
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
	SUM(campus_transaction.amount) as amount_converted_SU_LHR 
	FROM campus_transaction 
	WHERE campus_transaction.campus=2 AND 
	campus_transaction.date BETWEEN '".$fromDate_ccms."' AND '".$toDate_ccms."' and campus_transaction.date!='' 
	GROUP BY campus_transaction.campus  ";
	$result_lahore=mysql_query($lahore) or die(mysql_error());	
	while($row_lahore = mysql_fetch_array($result_lahore)){  
	$campus_lahore = getData(nl2br( $row_lahore['campus']),'campus');
	$SU_lhr = $row_lahore['amount_converted_SU_LHR'];
	} 
	
	///////////////////////////////////////////////////////////// LAHORE SIGNUP - END
	
	///////////////////////////////////////////////////////////// Total income in this month - START
	$SU_rwp = $SU - $SU_lhr;
	$total_income_in_this_month_overall = ($recurr + $SU_rwp + $SU_lhr);  
	///////////////////////////////////////////////////////////// Total income in this month - END
	
	
	///////////////////////////////////////////////////////////// Total PENDING TILL DATE - START
	$curr_mon_sub_one = date('n')-1;echo "<br>";
	
	$curr_mon_sub_one = date('n', strtotime($systemdate . "-1 months"));echo "<br>";
	$fromDate_pre = date('Y')."-".$curr_mon_sub_one."-".date('01');echo "<br>";
	
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate = date('Y-m-t');
	//CCMS From/To  Date</b></label>"
	//$fromDate_pre_ccms=				//USE ccms date AS PREVIOUS MONTH LATER
	//echo $fromDate_ccms = date('Y-m-01', strtotime($systemdate));echo "<br>";
	$toDate_ccms = date('Y-m-t', strtotime($systemdate));
	
	$fromDate=date('d',strtotime($fromDate_pre));
	//echo "<br>";
	$fromMonth=date('n',strtotime($fromDate_pre));
	//echo "<br>";
	$fromYear=date('Y',strtotime($fromDate_pre));
	//echo "<br>";
	
	$fromdaysss=date('t',strtotime($fromDate_pre));
	//echo "<br>";
	//echo "<br>";
	
	$toDate_current_day_ccms = date('d', strtotime($systemdate));
	$toDate_current_day=date('d');//NOT USE DURING THIS TIME
	$toDate_day=date('d',strtotime($toDate_ccms));
	//echo "<br>";
	$toMonth_month=date('n',strtotime($toDate_ccms));
	//echo "<br>";
	$toYear_year=date('Y',strtotime($toDate_ccms));
	//echo "<br>";
	//echo "<br>";
	
	//Current year and the current month is NOT JAN
	//echo "pre mon";
	$curr_mon_sub_one = date('n', strtotime($systemdate . "-1 months"));
	//echo "<br>";
	//Current year and the current month is JAN
	//echo "if curr month is JAN and pre mon will be DEC(12) not 0-with pre year ***";
	if($curr_mon_sub_one==0)
	{
		$curr_mon_sub_one=12;
		//echo "<br>";
	}

	//echo "curr mon";
	$curr_mon = date('n',strtotime($systemdate));
	//echo "<br>";
	
	//Current year and the current month is NOT DEC
	//echo "next mon-without next year condition";
	$curr_mon_add_one = date('n', strtotime($systemdate . "+1 months"));
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
	if($fromDate_ccms < $toDate_ccms && $fromMonth==$curr_mon_sub_one && $toMonth_month==$curr_mon)
	{
	
	//Query for Previous month pending
	$sql_pre_till_date_pend=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					//Query for current month till date pending e.g(1st - 15th OR 20th OR 22nd etc)
					$sql_till_date_pend=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate_current_day_ccms.") 
					order by paydayz DESC";
					
					//Query for current month pending(1st - 30th/31st)
					$sql_curr_till_date_pend=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate_day.") 
					order by paydayz DESC";
	}

	//PREVIOUS MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the PREVIOUS MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
//echo "<div align='center' style='color:red; font-size:16px'>PREVIOUS MONTH PENDINGS</div>";
$amount_pre_till_date_pend=array();
$recieved_pre_till_date_pend=array();
$pending_pre_till_date_pend =array();

$pending_pre_till_date_pend_2nd_array =array();

$signups_pre_till_date_pend =array();
$discount_pre_till_date_pend =array();

	$result_pre_till_date_pend = mysql_query($sql_pre_till_date_pend) or trigger_error(mysql_error()); 
	while($row_pre_till_date_pend = mysql_fetch_array($result_pre_till_date_pend)){ 


	$countresult_pre_till_date_pend=$row_pre_till_date_pend['amount'];

	$date_subtracted = date('n') - 1;
	$date_subtracted  = date('n', strtotime($systemdate . "-1 months"));//NOW ccms date is used
	if($date_subtracted==0)
	{
		$date_subtracted=12;
	}
	$countmonthsql_pre_till_date_pend="select amount as amounttran, discount_tran FROM campus_transaction where month(dateRecieved)='".$date_subtracted."' and year(dateRecieved)='".date('Y')."' and studentID=".$row_pre_till_date_pend['studentID']." and schedule_id=".$row_pre_till_date_pend['id'].""; 
	if($fromMonth==1 && $toMonth==1)	//NEWLY ADDED 10-01-2014
	{
		//$countmonthsql_pre.= " and year(dateRecieved)='".$curr_year_minus_one."' ";
	}

	
	$countmonthesult_pre_till_date_pend=mysql_query($countmonthsql_pre_till_date_pend) or die(mysql_error());
	$countmonthesult_pre_till_date_pend=mysql_fetch_assoc($countmonthesult_pre_till_date_pend);


	$maxdate_rec_pre="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row_pre_till_date_pend['studentID']." and year(dateRecieved)='".date('Y')."' and schedule_id=".$row_pre_till_date_pend['id'].""; 
	$maxdate_rec_result_pre=mysql_query($maxdate_rec_pre) or die(mysql_error());
	$maxdate_rec_result_pre=mysql_fetch_assoc($maxdate_rec_result_pre);

	$amount_pre_till_date_pend[$row_pre_till_date_pend['id']]=$countresult_pre_till_date_pend;
	$recieved_pre_till_date_pend[$row_pre_till_date_pend['id']]=$countmonthesult_pre_till_date_pend['amounttran'];
	$pending_pre_till_date_pend[$row_pre_till_date_pend['id']]=$countresult_pre_till_date_pend-$countmonthesult_pre_till_date_pend['amounttran']-$countmonthesult_pre_till_date_pend['discount_tran'];
	//echo "<br>";
	if(($pending_pre_till_date_pend[$row_pre_till_date_pend['id']]<0) || ($pending_pre_till_date_pend[$row_pre_till_date_pend['id']]>0 && $pending_pre_till_date_pend[$row_pre_till_date_pend['id']]<=9))
	{
		$pending_pre_till_date_pend[$row_pre_till_date_pend['id']]=0;
	}
	else
	{
		$pending_pre_till_date_pend[$row_pre_till_date_pend['id']];
	}
	$discount_pre_till_date_pend[$row_pre_till_date_pend['id']] = $countmonthesult_pre_till_date_pend['discount_tran'];

		if($row_pre_till_date_pend['month']==date('n') && $row_pre_till_date_pend['year']==date('Y'))
		{
		$signups_pre_till_date_pend[$row_pre_till_date_pend['id']]=$countresult_pre_till_date_pend;
		}
		if(($pending_pre_till_date_pend[$row_pre_till_date_pend['id']] >= 10) && ($signups_pre_till_date_pend[$row_pre_till_date_pend['id']]==''))
		{
		$pending_pre_till_date_pend_2nd_array[$row_pre_till_date_pend['id']]=$pending_pre_till_date_pend[$row_pre_till_date_pend['id']];
		$pending_pre_till_date_pend[$row_pre_till_date_pend['id']];  
		}
	}
$pre_month_pending = array_sum($pending_pre_till_date_pend_2nd_array);



//CURRENT MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the CURRENT MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

//echo "<div align='center' style='color:red; font-size:16px'>CURRENT MONTH PENDINGS</div>";


$amount_till_date_pend=array();
$recieved_till_date_pend=array();
$pending_till_date_pend =array();
$signups_till_date_pend =array();
$discount_till_date_pend =array();

	$unique_array_id=1;
	$result_till_date_pend = mysql_query($sql_till_date_pend) or trigger_error(mysql_error()); 
	while($row_till_date_pend = mysql_fetch_array($result_till_date_pend)){ 
	
	$countresult_till_date_pend=$row_till_date_pend['amount'];
	$amount_till_date_pend[$row_till_date_pend['id']]=$countresult_till_date_pend;

		$countmonthsql_till_date_pend="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".date('n')."' and year(dateRecieved)='".date('Y')."' and studentID=".$row_till_date_pend['studentID']." and schedule_id=".$row_till_date_pend['id'].""; 
		$countmonthesult_till_date_pend=mysql_query($countmonthsql_till_date_pend) or die(mysql_error());
		$countmonthesult_till_date_pend=mysql_fetch_assoc($countmonthesult_till_date_pend);

		$amount_till_date_pend[$row_till_date_pend['id']]=$countresult_till_date_pend;
		$recieved_till_date_pend[$row_till_date_pend['id']]=$countmonthesult_till_date_pend['amounttran'];
		$pending_till_date_pend[$unique_array_id]=$countresult_till_date_pend-$countmonthesult_till_date_pend['amounttran']-$countmonthesult_till_date_pend['discount_tran'];
		if($pending_till_date_pend[$unique_array_id]<0 || $pending_till_date_pend[$unique_array_id]<10)
		{
		$pending_till_date_pend[$unique_array_id]=0;
		}
		$discount_till_date_pend[$row_till_date_pend['id']] = $countmonthesult_till_date_pend['discount_tran'];


		/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

		$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row_till_date_pend['studentID']." and year(dateRecieved)='".date('Y')."' and schedule_id=".$row_till_date_pend['id'].""; 
		$maxdate_rec_result=mysql_query($maxdate_rec) or die(mysql_error());
		$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);


		if($row_till_date_pend['month']==date('n') && $row_till_date_pend['year']==date('Y'))
		{
		$signups_till_date_pend[$row_till_date_pend['id']]=$countresult_till_date_pend;
		}
		
		
		if($pending_till_date_pend[$unique_array_id] >=10 && ($signups_till_date_pend[$row['id']]==''))
		{
		$pending_till_date_pend[$unique_array_id];  
		}
		$unique_array_id = $unique_array_id + 1;
	}

$current_month_pending = array_sum($pending_till_date_pend);




//echo "<div align='center' style='color:red; font-size:16px'>WHOLE CURRENT MONTH PENDINGS(1-30)</div>";


$amount_curr_till_date_pend=array();
$recieved_curr_till_date_pend=array();
$pending_curr_till_date_pend =array();
$signups_curr_till_date_pend =array();
$discount_curr_till_date_pend =array();

	$unique_array_id=1;
	$result_curr_till_date_pend = mysql_query($sql_curr_till_date_pend) or trigger_error(mysql_error()); 
	while($row_curr_till_date_pend = mysql_fetch_array($result_curr_till_date_pend)){ 
	
	$countresult_curr_till_date_pend=$row_curr_till_date_pend['amount'];
	$amount_curr_till_date_pend[$row_curr_till_date_pend['id']]=$countresult_curr_till_date_pend;

		$countmonthsql_curr_till_date_pend="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".date('n')."' and year(dateRecieved)='".date('Y')."' and studentID=".$row_curr_till_date_pend['studentID']." and schedule_id=".$row_curr_till_date_pend['id'].""; 
		$countmonthesult_curr_till_date_pend=mysql_query($countmonthsql_curr_till_date_pend) or die(mysql_error());
		$countmonthesult_curr_till_date_pend=mysql_fetch_assoc($countmonthesult_curr_till_date_pend);

		$amount_curr_till_date_pend[$row_curr_till_date_pend['id']]=$countresult_curr_till_date_pend;
		$recieved_curr_till_date_pend[$row_curr_till_date_pend['id']]=$countmonthesult_curr_till_date_pend['amounttran'];
		$pending_curr_till_date_pend[$unique_array_id]=$countresult_curr_till_date_pend-$countmonthesult_curr_till_date_pend['amounttran']-$countmonthesult_curr_till_date_pend['discount_tran'];
		if($pending_curr_till_date_pend[$unique_array_id]<0 || $pending_curr_till_date_pend[$unique_array_id]<10)
		{
		$pending_curr_till_date_pend[$unique_array_id]=0;
		}
		$discount_curr_till_date_pend[$row_curr_till_date_pend['id']] = $countmonthesult_curr_till_date_pend['discount_tran'];


		/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

		$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row_curr_till_date_pend['studentID']." and year(dateRecieved)='".date('Y')."' and schedule_id=".$row_curr_till_date_pend['id'].""; 
		$maxdate_rec_result=mysql_query($maxdate_rec) or die(mysql_error());
		$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);


		if($row_curr_till_date_pend['month']==date('n') && $row_curr_till_date_pend['year']==date('Y'))
		{
		$signups_curr_till_date_pend[$row_curr_till_date_pend['id']]=$countresult_curr_till_date_pend;
		}
		
		
		if($pending_curr_till_date_pend[$unique_array_id] >=10 && ($signups_curr_till_date_pend[$row['id']]==''))
		{
		$pending_curr_till_date_pend[$unique_array_id];  
		}
		$unique_array_id = $unique_array_id + 1;
	}

$current_curr_month_pending = array_sum($pending_curr_till_date_pend);
	
	
	///////////////////////////////////////////////////////////// Total PENDING TILL DATE - END	
	
	
	
	///////////////////////////////////////////////////////////// Per Day SIGNUP - START
	
	/* echo $fromDate_ccms = date('Y-m-01', strtotime($systemdate));echo "<br>";
	echo $toDate_ccms = date('Y-m-t', strtotime($systemdate));echo "<br>";
	echo $fromDate = strtotime($fromDate_ccms);echo "<br>";
	echo $toDate = strtotime($toDate_ccms);echo "<br>";
	echo $per_day_signup_DAYS = $toDate - $fromDate;echo "<br>";
	echo $per_day_signup_DAYS = floor($per_day_signup_DAYS/(60*60*24));echo "<br>";echo "<br>";echo "<br>"; */
	/////////////****************** PER DAY CALCULATION CODE ********************///////////////////////
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate_ccms = $systemdate;
	//$toDate = date('Y-m-d', strtotime($toDate . ' + 1 days'));echo "<br>";

	$date1 = $fromDate_ccms; 
	$date2 = $toDate_ccms; 
	//$date2 = date('t-m-Y'); 

	# Do some checks here for valid dates and to make sure date1 is less than date2 

	# Time strings 
	$time1 = strtotime($date1); 
	$time2 = strtotime($date2); 

	$days = 0; 
	while($time1 <= $time2) { 
	   $chk = date('D', $time1); # Actual date conversion 
	   if($chk != 'Sun') 
		  $days++;

	   $time1 += 86400; # Add a day 
	   $days_per_day_signup_DAYS=$days;
	} 

	//$days_per_day_signup_DAYS=$days;echo "<br>";echo "<br>";echo "<br>";
	//echo ' days between '.$date1.' and '.$date2;
	/////////////************************************ \********************///////////////////////
	////////////////////////////////////////////////////////////// Per Day SIGNUP - END
	
	
	//2nd Copy of FREEZE
	///////////////////////////////////////////////////////////// Freeze students amount - START
	//1st copy of this code is on TOP to add DEAD-REGULAR and the FREEZE students
	//'First Date    = ' . date('Y-m-01') . '<br />';
    //'Last Date     = ' . date('Y-m-t')  . '<br />';
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate_ccms = date('Y-m-t', strtotime($systemdate));
	$sql_freeze=" SELECT id,SUM(dues) as freeze_amount,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status_old=2 AND std_status=4 AND 
			campus_schedule.freeze_date>='".$fromDate_ccms."' and campus_schedule.freeze_date<= '".$toDate_ccms."' ";
	$result_freeze = mysql_query($sql_freeze);
	while($row_freeze=mysql_fetch_array($result_freeze))
	{
		$freeze_amount=$row_freeze['freeze_amount'];
	}
	////////////////////////////////////////////////////////////// Freeze students amount - END
	
	
	
	
	
	
	//3rd table QUERIES			//COUNTING TODAYS Trial/Signup/Dead Reg/Freeze/Trial Dead
	///////////////////////////////////////////////////////////// trial day,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_trial_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_trial_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=506 
	and campus_schedule.std_status=1 
	and campus_schedule.dateBooked>='".$todays_date."' and campus_schedule.dateBooked<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_trial_day = mysql_query($sql_trial_day);
	while($row_trial_day=mysql_fetch_array($result_trial_day))
	{
		$trial_day=$row_trial_day['sch_id_trial_day'];
	}
	////////////////////////////////////////////////////////////// trial day,count- END
	///////////////////////////////////////////////////////////// trial night,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_trial_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_trial_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=506 and campus_schedule.agentId!=565 and campus_schedule.std_status=1 
	and campus_schedule.dateBooked>='".$todays_date."' and campus_schedule.dateBooked<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_trial_night = mysql_query($sql_trial_night);
	while($row_trial_night=mysql_fetch_array($result_trial_night))
	{
		$trial_night=$row_trial_night['sch_id_trial_night'];
	}
	////////////////////////////////////////////////////////////// trial night,count- END
	///////////////////////////////////////////////////////////// trial YCC LAHORE,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_trial_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_trial_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 and campus_schedule.std_status=1 
	and campus_schedule.dateBooked>='".$todays_date."' and campus_schedule.dateBooked<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_trial_ycc_lhr = mysql_query($sql_trial_ycc_lhr);
	while($row_trial_ycc_lhr=mysql_fetch_array($result_trial_ycc_lhr))
	{
		$trial_ycc_lhr=$row_trial_ycc_lhr['sch_id_trial_ycc_lhr'];
	}
	////////////////////////////////////////////////////////////// trial YCC LAHORE,count- END
	
	
	///////////////////////////////////////////////////////////// signup day,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_signup_day="SELECT count(campus_transaction.id) as tran_id_SU_day,
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
	SUM(campus_transaction.amount) as SU_amount_day 
	FROM campus_transaction 
	WHERE campus_transaction.main_agentLeadId=95 AND campus_transaction.campus=1 AND 
	campus_transaction.courseID!=27 AND 
	campus_transaction.date BETWEEN '".$todays_date."' AND '".$todays_date."' and campus_transaction.date!=''  "; 
	$result_signup_day = mysql_query($sql_signup_day);
	while($row_signup_day=mysql_fetch_array($result_signup_day))
	{
		$signup_day=$row_signup_day['tran_id_SU_day'];
	}
	////////////////////////////////////////////////////////////// signup day,count- END
	///////////////////////////////////////////////////////////// signup night,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_signup_night="SELECT count(campus_transaction.id) as tran_id_SU_night,
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
	SUM(campus_transaction.amount) as SU_amount_night 
	FROM campus_transaction 
	WHERE campus_transaction.main_agentLeadId=206 AND campus_transaction.campus=1 AND 
	campus_transaction.date BETWEEN '".$todays_date."' AND '".$todays_date."' and campus_transaction.date!=''  "; 
	$result_signup_night = mysql_query($sql_signup_night);
	while($row_signup_night=mysql_fetch_array($result_signup_night))
	{
		$signup_night=$row_signup_night['tran_id_SU_night'];
	}
	////////////////////////////////////////////////////////////// signup night,count- END
	///////////////////////////////////////////////////////////// signup YCC LAHORE,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_signup_ycc_lhr="SELECT count(campus_transaction.id) as tran_id_SU_lhr,
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
	SUM(campus_transaction.amount) as amount_converted_SU_LHR  
	FROM campus_transaction 
	WHERE campus_transaction.campus AND campus_transaction.campus=2 AND 
	campus_transaction.date BETWEEN '".$todays_date."' AND '".$todays_date."' and campus_transaction.date!='' "; 
	$result_signup_ycc_lhr = mysql_query($sql_signup_ycc_lhr);
	while($row_signup_ycc_lhr=mysql_fetch_array($result_signup_ycc_lhr))
	{
		$signup_ycc_lhr=$row_signup_ycc_lhr['tran_id_SU_lhr'];
	}
	////////////////////////////////////////////////////////////// signup YCC LAHORE,count- END
	
	
	///////////////////////////////////////////////////////////// Dead Regular day,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Reg_cnt_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_reg_cnt_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=95 and campus_schedule.agentId!=565 
	and campus_schedule.std_status_old=2 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Reg_cnt_day = mysql_query($sql_DEAD_Reg_cnt_day);
	while($row_DEAD_Reg_cnt_day=mysql_fetch_array($result_DEAD_Reg_cnt_day))
	{
		$DEAD_Reg_cnt_day=$row_DEAD_Reg_cnt_day['sch_id_dead_reg_cnt_day'];
		$DEAD_Reg_amount_day = $row_DEAD_Reg_cnt_day['dues'];
	}
	////////////////////////////////////////////////////////////// Dead Regular day,count - END
	///////////////////////////////////////////////////////////// Dead Regular night,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Reg_cnt_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_reg_cnt_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=95 and campus_schedule.agentId!=565 
	and campus_schedule.std_status_old=2 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Reg_cnt_night = mysql_query($sql_DEAD_Reg_cnt_night);
	while($row_DEAD_Reg_cnt_night=mysql_fetch_array($result_DEAD_Reg_cnt_night))
	{
		$DEAD_Reg_cnt_night=$row_DEAD_Reg_cnt_night['sch_id_dead_reg_cnt_night'];
		$DEAD_Reg_amount_night = $row_DEAD_Reg_cnt_night['dues'];
	}
	////////////////////////////////////////////////////////////// Dead Regular night,count - END
	///////////////////////////////////////////////////////////// Dead Regular ycc lahore,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Reg_cnt_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_DEAD_Reg_cnt_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 
	and campus_schedule.std_status_old=2 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_DEAD_Reg_cnt_ycc_lhr = mysql_query($sql_DEAD_Reg_cnt_ycc_lhr);
	while($row_DEAD_Reg_cnt_ycc_lhr=mysql_fetch_array($result_DEAD_Reg_cnt_ycc_lhr))
	{
		$DEAD_Reg_cnt_ycc_lhr=$row_DEAD_Reg_cnt_ycc_lhr['sch_id_DEAD_Reg_cnt_ycc_lhr'];
		$DEAD_Reg_amount_ycc_lhr=$row_DEAD_Reg_cnt_ycc_lhr['dues'];		
	}
	////////////////////////////////////////////////////////////// Dead Regular ycc lahore,count - END
	
	
	///////////////////////////////////////////////////////////// FREEZE day,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_freeze_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_freeze_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=95 
	and campus_schedule.freeze_date>='".$todays_date."' and campus_schedule.freeze_date<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_freeze_day = mysql_query($sql_freeze_day);
	while($row_freeze_day=mysql_fetch_array($result_freeze_day))
	{
		$freeze_day=$row_freeze_day['sch_id_freeze_day'];
		$freeze_amount_day=$row_freeze_day['dues'];
	}
	////////////////////////////////////////////////////////////// FREEZE day,count- END
	///////////////////////////////////////////////////////////// FREEZE night,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_freeze_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_freeze_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=95 and campus_schedule.agentId!=565 
	and campus_schedule.freeze_date>='".$todays_date."' and campus_schedule.freeze_date<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_freeze_night = mysql_query($sql_freeze_night);
	while($row_freeze_night=mysql_fetch_array($result_freeze_night))
	{
		$freeze_night=$row_freeze_night['sch_id_freeze_night'];
		$freeze_amount_night=$row_freeze_night['dues'];
	}
	////////////////////////////////////////////////////////////// FREEZE night,count- END
	///////////////////////////////////////////////////////////// FREEZE YCC LAHORE,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_freeze_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_freeze_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 
	and campus_schedule.freeze_date>='".$todays_date."' and campus_schedule.freeze_date<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_freeze_ycc_lhr = mysql_query($sql_freeze_ycc_lhr);
	while($row_freeze_ycc_lhr=mysql_fetch_array($result_freeze_ycc_lhr))
	{
		$freeze_ycc_lhr=$row_freeze_ycc_lhr['sch_id_freeze_ycc_lhr'];
		$freeze_amount_ycc_lhr=$row_freeze_ycc_lhr['dues'];
	}
	////////////////////////////////////////////////////////////// FREEZE YCC LAHORE,count- END
	
	
	///////////////////////////////////////////////////////////// Dead Trial day,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Trl_cnt_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_trl_cnt_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=95 and campus_schedule.std_status_old=1 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Trl_cnt_day = mysql_query($sql_DEAD_Trl_cnt_day);
	while($row_DEAD_Trl_cnt_day=mysql_fetch_array($result_DEAD_Trl_cnt_day))
	{
		$DEAD_Trl_cnt_day=$row_DEAD_Trl_cnt_day['sch_id_dead_trl_cnt_day'];
	}
	////////////////////////////////////////////////////////////// Dead Trial day,count - END
	///////////////////////////////////////////////////////////// Dead Trial night,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Trl_cnt_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_trl_cnt_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=95 and campus_schedule.agentId!=565 
	and campus_schedule.std_status_old=1 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Trl_cnt_night = mysql_query($sql_DEAD_Trl_cnt_night);
	while($row_DEAD_Trl_cnt_night=mysql_fetch_array($result_DEAD_Trl_cnt_night))
	{
		$DEAD_Trl_cnt_night=$row_DEAD_Trl_cnt_night['sch_id_dead_trl_cnt_night'];
	}
	////////////////////////////////////////////////////////////// Dead Trial night,count - END
	///////////////////////////////////////////////////////////// Dead Trial ycc lahore,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Trl_cnt_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_DEAD_Trl_cnt_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 
	and campus_schedule.std_status_old=1 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_DEAD_Trl_cnt_ycc_lhr = mysql_query($sql_DEAD_Trl_cnt_ycc_lhr);
	while($row_DEAD_Trl_cnt_ycc_lhr=mysql_fetch_array($result_DEAD_Trl_cnt_ycc_lhr))
	{
		$DEAD_Trl_cnt_ycc_lhr=$row_DEAD_Trl_cnt_ycc_lhr['sch_id_DEAD_Trl_cnt_ycc_lhr'];
	}
	////////////////////////////////////////////////////////////// Dead Trial ycc lahore,count - END

	
	///////////////////////////////////////////////////////////// Dead Amount - START
	$systemdate = systemDate();
	$todays_date = $systemdate;
	$sql_DEAD_Amt=" SELECT id,SUM(dues) as DEAD_Amt,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE std_status_old=2 AND std_status=3 AND 
			DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<= '".$todays_date."' ";
	$result_DEAD_Amt = mysql_query($sql_DEAD_Amt);
	while($row_DEAD_Amt=mysql_fetch_array($result_DEAD_Amt))
	{
		$DEAD_Amt=$row_DEAD_Amt['DEAD_Amt'];
	}
	////////////////////////////////////////////////////////////// Dead Amount - END
	///////////////////////////////////////////////////////////// Signup Amount - START
	//std_status_old=1 AND std_status=2
	//Cannot check on above condition AS
	//old status as 1(Trial) and cirrent status as 2(Regular) BECASUE
	//What if that same signup GOT DEAD THE SAME DAY
	$systemdate = systemDate();
	$todays_date = $systemdate;
	$sql_Signup_Amt=" SELECT id,SUM(dues) as Signup_Amt,std_status_old,std_status,`status` 
			FROM campus_schedule 
			WHERE  
			campus_schedule.duedate>='".$todays_date."' and campus_schedule.duedate<= '".$todays_date."' ";
	$result_Signup_Amt = mysql_query($sql_Signup_Amt);
	while($row_Signup_Amt=mysql_fetch_array($result_Signup_Amt))
	{
		$Signup_Amt=$row_Signup_Amt['Signup_Amt'];
	}
	////////////////////////////////////////////////////////////// Signup Amount - END
	/////////////////////////////////////////////// TODAY's Recurr Received amount - START
	$todays_date = $systemdate;
	$amount_today=array();
	$recieved_today=array();
	$recieved_with_tran_id_today=array();
	$signups_today =array();
	
	$sql_today_Recurr_Rec=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_schedule.agentId,
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
	campus_transaction.date BETWEEN '".$todays_date."' AND '".$todays_date."' and campus_transaction.date!='' ";
	
	$result_today_Recurr_Rec = mysql_query($sql_today_Recurr_Rec) or trigger_error(mysql_error());
	while($row_today_Recurr_Rec=mysql_fetch_array($result_today_Recurr_Rec))
	{
		$signup_check=1;
		$countresult_today=$row_today_Recurr_Rec['amount'];
		$countmonthsql_today="select amount as amounttran_not_main,date,dateRecieved,operator,id FROM campus_transaction where date BETWEEN '".$todays_date."' AND '".$todays_date."' and studentID=".$row_today_Recurr_Rec['studentID']." and schedule_id=".$row_today_Recurr_Rec['id']." and id=".$row_today_Recurr_Rec['tran_id']." "; 
		$countmonthesult_today=mysql_query($countmonthsql_today);
		$countmonthesult_today=mysql_fetch_assoc($countmonthesult_today);
		$amount[$row_today_Recurr_Rec['id']]=$countresult_today;
		//DUE DATE(Signup DATE) - Month and Year
		$duedate_month = date('m', strtotime(nl2br($row_today_Recurr_Rec['due_date'])));
		$duedate_year = date('Y', strtotime(nl2br($row_today_Recurr_Rec['due_date'])));
		
		//DUE DATE(Signup DATE) - Month and Year
		$dateRec_month = date('m', strtotime(nl2br($countmonthesult_today['dateRecieved'])));
		$dateRec_year = date('Y', strtotime(nl2br($countmonthesult_today['dateRecieved'])));
		if(($row_today_Recurr_Rec['due_date']>=$todays_date && $row_today_Recurr_Rec['due_date']<=$todays_date) && $row_today_Recurr_Rec['due_date']==$countmonthesult_today['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult_today) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
		{
			$signups_today[$row_today_Recurr_Rec['id']]=$row_today_Recurr_Rec['amount'];
			$signup_check=0;
		}
		else
		{
			//$signup_check==1;
		}

		if(!empty($countresult_today) && ($countmonthesult_today['date']>=$todays_date && $countmonthesult['date']<=$todays_date) && $signup_check==1)
		{
			$recieved_today[$row_today_Recurr_Rec['tran_id']]=$row_today_Recurr_Rec['amounttran'];
			$recieved_with_tran_id_today[$row_today_Recurr_Rec['tran_id']]=$row_today_Recurr_Rec['amounttran'];
		}
		
		
	}
	$recurr_today = nl2br( array_sum($recieved_today));
	$SU_today = nl2br( array_sum($signups_today)); 


	//////////////////////////////////////////////// TODAY's Recurr Received amount - END
	
	
	
	
	///////////////////////////////////// ADVANCE NEW, - start
	$current_month=date('m');
	$current_year=date('Y');
	if($current_month==1)
	{ $last_month = 12; }
	else { $last_month = $current_month - 1; }
	
	$last_month_1st_date=date("Y-".$last_month."-01");
	$last_month_last_date = date('t',$last_month);
	$last_month_last_date_final = date($current_year."-".$last_month."-".$last_month_last_date);
	$last_month_fromDate = $last_month_1st_date;
	$last_month_toDate = $last_month_last_date_final;
	
		/////////////////////////////////////////////// TODAY's Recurr Received amount - START
	$todays_date = $systemdate;
	$amount_advance=array();
	$recieved_advance=array();
	$recieved_with_tran_id_advance=array();
	$signups_advance =array();
	
	$sql_advance_Recurr_Rec=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_schedule.agentId,
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
	campus_transaction.date BETWEEN '".$last_month_fromDate."' AND '".$last_month_toDate."' and 
	campus_transaction.dateRecieved BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."' and 
	
	campus_transaction.date!='' ";
	
	$result_advance_Recurr_Rec = mysql_query($sql_advance_Recurr_Rec) or trigger_error(mysql_error());
	while($row_advance_Recurr_Rec=mysql_fetch_array($result_advance_Recurr_Rec))
	{
		$signup_check=1;
		$countresult_advance=$row_advance_Recurr_Rec['amount'];
		$countmonthsql_advance="select amount as amounttran_not_main,date,dateRecieved,operator,id FROM campus_transaction where dateRecieved BETWEEN '".date('Y-m-01')."' AND '".date('Y-m-t')."' and studentID=".$row_advance_Recurr_Rec['studentID']." and schedule_id=".$row_advance_Recurr_Rec['id']." and id=".$row_advance_Recurr_Rec['tran_id']." "; 
		$countmonthesult_advance=mysql_query($countmonthsql_advance);
		$countmonthesult_advance=mysql_fetch_assoc($countmonthesult_advance);
		$amount[$row_advance_Recurr_Rec['id']]=$countresult_advance;
		//DUE DATE(Signup DATE) - Month and Year
		$duedate_month = date('m', strtotime(nl2br($row_advance_Recurr_Rec['due_date'])));
		$duedate_year = date('Y', strtotime(nl2br($row_advance_Recurr_Rec['due_date'])));
		
		//DUE DATE(Signup DATE) - Month and Year
		$dateRec_month = date('m', strtotime(nl2br($countmonthesult_advance['dateRecieved'])));
		$dateRec_year = date('Y', strtotime(nl2br($countmonthesult_advance['dateRecieved'])));
		if(($row_advance_Recurr_Rec['due_date']>=date('Y-m-01') && $row_advance_Recurr_Rec['due_date']<=date('Y-m-t')) && $row_advance_Recurr_Rec['due_date']==$countmonthesult_advance['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult_advance) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
		{
			$signups_advance[$row_advance_Recurr_Rec['id']]=$row_advance_Recurr_Rec['amount'];
			$signup_check=0;
		}
		else
		{
			//$signup_check==1;
		}

		if(!empty($countresult_advance) && ($countmonthesult_advance['dateRecieved']>=date('Y-m-01') && $countmonthesult['dateRecieved']<=date('Y-m-t')) && $signup_check==1)
		{
			$row_advance_Recurr_Rec['amounttran'];
			$recieved_advance[$row_advance_Recurr_Rec['tran_id']]=$row_advance_Recurr_Rec['amounttran'];
			$recieved_with_tran_id_advance[$row_advance_Recurr_Rec['tran_id']]=$row_advance_Recurr_Rec['amounttran'];
		}
		
		
	}
	$recurr_advance = nl2br( array_sum($recieved_advance));
	$SU_advance = nl2br( array_sum($signups_advance)); 


	//////////////////////////////////////////////// TODAY's Recurr Received amount - END

	
	
	
	///////////////////////////////////// ADVANCE NEW, - end
	
	
	
	//1st table for the BUSINESS SHEET start - 
	//a) Paying amount b) Dead Regular c) Total recurr received d) Signup amount
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	///////////////////////////////////// PAYING AMOUNT, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Paying amount</b></th>";
	echo "<td valign='top'>$ ". $paying_amount_variable = array_sum($paying_amount) ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// PAYING AMOUNT, result - end
	
	///////////////////////////////////// Dead Regular student, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total DEAD=REGULAR Amount </b></th>";
	echo "<td valign='top'>$ ". $DEAD_Reg . "</td>";
	echo "<td valign='top'></td>";
	//echo "<td valign='top'>  ". (($deadReg_freeze / $paying_amount_variable)*100) ."(%)</td>";
	echo "</tr>";
	///////////////////////////////////// Dead Regular student, result - end
	///////////////////////////////////// freeze student, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Freeze</b></th>";
	echo "<td valign='top'>$ ".  $freeze_amount . "</td>";
	$deadReg_freeze = $DEAD_Reg + $freeze_amount;
	echo "<td valign='top'></td>";
	echo "<td valign='top'>  ". (($deadReg_freeze / $paying_amount_variable)*100) ."(%)</td>";
	echo "</tr>";
	///////////////////////////////////// freeze student, result - end
	
	
	///////////////////////////////////// Total Recurr Received amount of Current Month, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total Recurring Received Amount-Current Month</b></th>";
	echo "<td valign='top'>$ ". $recurr ."</td>";
	echo "</tr>";
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Signup Amount  RWP + Signup Amount  LHR</b></th>";
	//SU amount RWP
	$SU_rwp = ceil($SU_rwp);
	$SU_lhr = ceil($SU_lhr);
	echo "<td valign='top'>$ ". $SU_rwp ."+". $SU_lhr ."=". ($SU_RWP_LHR = $SU_rwp+$SU_lhr) ."</td>";
	echo "<td valign='top'></td>";
	//Total SU minus Total Dead, GREEN/RED
	$total_SU_minus_total_DEAD = $SU_RWP_LHR - $DEAD_Reg;
	if($total_SU_minus_total_DEAD<0)
	echo "<td valign='top' style='background-color:red; color:black;'>$ ". $total_SU_minus_total_DEAD ."</td>";
	else
	echo "<td valign='top' style='background-color:green; color:black;'>$ ". $total_SU_minus_total_DEAD ."</td>";
	echo "</tr>";
	//NEW ROW, for SIGNUP PER DAY with NEW DAYS CALCULATION, from 1st of month till date DAYS CALCULATION
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'>PER DAY SIGNUP</th>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'>$ ". ($SU_RWP_LHR / $days_per_day_signup_DAYS) ."</td>";
	echo "</tr>";

	//NEW ROW, for SIGNUP PER DAY
	echo "<tr bgcolor=#FF0000>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'></td>";
	echo "<td valign='top'>$ ". ($SU_RWP_LHR / $per_day_signup_DAYS) ."</td>";
	echo "</tr>";
			//***************??????????? LAHORE SIGNUPS ????????????***********************
			//Commenting following for now 09-04-2015
	/* echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Signup Amount  LHR</b></th>";
	echo "<td valign='top'>$ ". $SU_lhr = ceil($SU_lhr) ."</td>";
	echo "</tr>"; */
	///////////////////////////////////// Total Recurr Received amount of Current Month, result - end
	
	///////////////////////////////////// Total income in this month, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total Income in this Month</b></th>";
	echo "<td valign='top'>$ ". $total_income_in_this_month_overall = ceil($total_income_in_this_month_overall) ."</td>";
	echo "</tr>";
	///////////////////////////////////// Total income in this month, result - end
	
	///////////////////////////////////// Total pending till date, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total Pending till date</b></th>";
	echo "<td valign='top'>$ ". $pre_month_pending ."(PRE) + ". $current_month_pending . "(1st - to date)=" . ($pre_month_pending + $current_month_pending) ."</td>";
	echo "<td valign='top'></td>";
	//Commenting following for now 09-04-2015
	//echo "<td valign='top'>$ ".$current_curr_month_pending."(1st - 30th)</td>";
	echo "</tr>";
	///////////////////////////////////// Total pending till date, result - end
	echo "</table>";

	
	//2nd Table - FOr overall calculations - 
	//a) Total Recurr b) Advance c) Zero paid d) freeze amt e) Dead regular amt
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	///////////////////////////////////// Total DEAD REGULAR - PERCENTAGE %, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Total Recurring(Current Month)</b></th>";
	echo "<th class='specalt'><b>ADVANCE</b></th>";
	echo "<th class='specalt'><b>Zero Paid</b></th>";
	echo "<th class='specalt'><b>UNFREEZE AUTO Zero Paid</b></th>";
	echo "<th class='specalt'><b>Recurring Received</b></th>";
	echo "<th class='specalt'><b>Receivable</b></th>";
	echo "<th class='specalt'><b>Freeze</b></th>";
	echo "<th class='specalt'><b>Dead Regular</b></th>";
	echo "</tr>";
	echo "<tr bgcolor=#FF0000>";
	echo "<td valign='top'>$ ". $total_recurr_curr_month = ($paying_amount_variable - ($SU_rwp+$SU_lhr)) ."</td>";

	//This following advance is wrong - so calculating it ABOVE with the name ADVANCE NEW
	//echo "<td valign='top'>$ ". $advance = $total_recurr_curr_month - $current_curr_month_pending ."</td>";
	echo "<td valign='top'>$ ". $recurr_advance ."</td>";
	
	
	echo "<td valign='top'>$ ". $zero_paid = $recurr_with_zero ."</td>";
	echo "<td valign='top'>$ ". $UNFREEZE_AUTO_zero_paid = $recurr_with_zero_UNFREEZE_AUTO ."</td>";
	echo "<td valign='top'>$ ". $recurr = $recurr ."</td>";
	echo "<td valign='top'>$ ". $receivable = $current_curr_month_pending ."</td>";
	echo "<td valign='top'>$ ". $freeze_amount = $freeze_amount ."</td>";
	echo "<td valign='top'>$ ". $DEAD_Reg = $DEAD_Reg ."</td>";
	echo "</tr>";
	///////////////////////////////////// Total pending till date, result - end
	echo "</table>";
	?>
	
<form action='' method='POST'>
<?
if($_SESSION['userId']==159 || $_SESSION['userId']==48)
{
$total_recurr=$total_recurr_curr_month;
$advance=$advance;
$zero_paid = $zero_paid;
$recurr = $recurr;
$receivable = $receivable;
$freeze_amount = $freeze_amount;
$DEAD_Reg = $DEAD_Reg;
$pre_month_pending = $pre_month_pending;

$systemdatetime = systemDateTime();
$systemdate = systemDate();
//http://www.webeditorsnotes.com/2012/04/six-steps-to-make-wamp-run-automatically-on-system-start-up-2/
if (isset($_POST['submitted'])) 
{
	$sql = "INSERT INTO `campus_business` (`total_recurr`, `advance` , `zero_paid` , `recurr_received` ,  `receivable` , `freeze` , `dead_regular`, `pre_month_pending` ,`operator` , `ccms_datetime` , `curr_datetime` ) VALUES(  '$total_recurr','$advance' , '$zero_paid' , '$recurr' ,  '$receivable' ,  '$freeze_amount' ,  '$DEAD_Reg'  ,  '$pre_month_pending' , '".$_SESSION['userId']."' , '".$systemdatetime."' , '".date('Y-m-d H:i:s')."'  ) "; 
	mysql_query($sql) or die(mysql_error()); 
	getMessages('add');
	echo "<script>alert('Click OK to Continue')</script>";
	echo "<script>window.location.href = 'business_sheet_dashboard.php'</script>";
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
	//3rd Table, For counting Trial/Signup/Regular Dead/Freeze/Trial Dead
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	echo "<tr bgcolor=#FF0000>";
	echo "<td valign='top'><b></b></td>";	
	echo "<td valign='top'><b>Total</b></td>";
	echo "<td valign='top'> DAY </td>";
	echo "<td valign='top'> NIGHT </td>";
	echo "<td valign='top'> LAHORE </td>";
	echo "</tr>"; 
	
	/////////////////////////////////////  Trial day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Trials</b></th>";
	echo "<td valign='top'><b>" . $total_trial = $trial_day+$trial_night+$trial_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $trial_day ."</td>";
	echo "<td valign='top'> ". $trial_night ."</td>";
	echo "<td valign='top'> ". $trial_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// Trial day/night/ycc lahore, result - end
	/////////////////////////////////////  Signup day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Signups</b></th>";
	echo "<td valign='top'><b>" . $total_signup = $signup_day+$signup_night+$signup_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $signup_day ."</td>";
	echo "<td valign='top'> ". $signup_night ."</td>";
	echo "<td valign='top'> ". $signup_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// Signup day/night/ycc lahore, result - end
	/////////////////////////////////////  DEAD REGULAR day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Regular Dead</b></th>";
	echo "<td valign='top'><b>" . $total_Dead_Reg= $DEAD_Reg_cnt_day + $DEAD_Reg_cnt_night + $DEAD_Reg_cnt_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $DEAD_Reg_cnt_day ."</td>";
	echo "<td valign='top'> ". $DEAD_Reg_cnt_night ."</td>";
	echo "<td valign='top'> ". $DEAD_Reg_cnt_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// DEAD REGULAR day/night/ycc lahore, result - end
	/////////////////////////////////////  Freeze day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Freeze</b></th>";
	echo "<td valign='top'><b>" . $total_freeze = $freeze_day + $freeze_night + $freeze_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $freeze_day ."</td>";
	echo "<td valign='top'> ". $freeze_night ."</td>";
	echo "<td valign='top'> ". $freeze_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// Freeze day/night/ycc lahore, result - end
	/////////////////////////////////////  DEAD TRIAL day/night/ycc lahore, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Trial Dead</b></th>";
	echo "<td valign='top'><b>" . $total_Dead_Trl = $DEAD_Trl_cnt_day + $DEAD_Trl_cnt_night + $DEAD_Trl_cnt_ycc_lhr . "</b></td>";
	echo "<td valign='top'> ". $DEAD_Trl_cnt_day ."</td>";
	echo "<td valign='top'> ". $DEAD_Trl_cnt_night ."</td>";
	echo "<td valign='top'> ". $DEAD_Trl_cnt_ycc_lhr ."</td>";
	echo "</tr>"; 
	///////////////////////////////////// DEAD TRIAL day/night/ycc lahore, result - end
	
/////////////////////////////////////  Dead Amount, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Dead Amount</b></th>";
	//ADDING day,night and ycc lhr REGULAR DEAD
	$Reg_DEAD_amount = $DEAD_Reg_amount_day+$DEAD_Reg_amount_night+$DEAD_Reg_amount_ycc_lhr;
	//$freeze_amount = $freeze_amount_day+$freeze_amount_night+$freeze_amount_ycc_lhr;
	echo "<td valign='top'><b> $ " . $DEAD_Amt = $DEAD_Amt . "(TEST1)     + $ " . $Reg_DEAD_amount ."(TEST2) </b></td>";
	echo "</tr>"; 
	///////////////////////////////////// Dead Amount, result - end
	
	/////////////////////////////////////  Freeze Amount, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Freeze Amount</b></th>";
	//ADDING day,night and ycc lhr FREEZE
	$freeze_amount = $freeze_amount_day+$freeze_amount_night+$freeze_amount_ycc_lhr;
	echo "<td valign='top'><b> $  " . $freeze_amount . "</b></td>";
	echo "</tr>"; 
	///////////////////////////////////// Freeze Amount, result - end
	
	/////////////////////////////////////  Signup Amount, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Signup Amount</b></th>";
	echo "<td valign='top'><b> $ " . $Signup_Amt = $Signup_Amt . "</b></td>";
	echo "</tr>"; 
	///////////////////////////////////// Signup Amount, result - end
	/////////////////////////////////////  Recurr today, result - start
	echo "<tr bgcolor=#FF0000>";
	echo "<th class='specalt'><b>Recurring amount today(CCMS date)</b></th>";
	echo "<td valign='top'><b> $ " . $recurr_today = $recurr_today . "</b></td>";
	echo "</tr>"; 
	///////////////////////////////////// Recurr today, result - end
	echo "</table>";
	
	
	
	
	/////////////////////////////////// To send email to MANAGEMENT
	
	//1st table of BUSINESS SHEET
	$business_sheet_email_to_send = "
	<table border='1' id='' cellspacing=2px > 
	<tr bgcolor=#eceff5>
	<td class='' valign='top'><b>Paying amount</b></td>
	<td valign='top'>$ ". $paying_amount_variable = array_sum($paying_amount) ."</td></tr>
	
	
	<tr bgcolor=#eceff5>
	<td><b>Total DEAD=REGULAR Amount </b></td>
	<td valign='top'>$ ". $DEAD_Reg . "</td>
	<td valign='top'></td></tr>
	
	<tr bgcolor=#eceff5>
	<td class=''><b>Freeze</b></td>
	<td valign='top'>$ ".  $freeze_amount . "</td>"
	.$deadReg_freeze = $DEAD_Reg + $freeze_amount."
	<td valign='top'></td>
	<td valign='top'>  ". (($deadReg_freeze / $paying_amount_variable)*100) ."(%)</td></tr>
	
	<tr bgcolor=#eceff5>
	<td class=''><b>Total Recurring Received Amount-Current Month</b></td>
	<td valign='top'>$ ". $recurr ."</td></tr>";
	
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class=''><b>Signup Amount  RWP %2B Signup Amount  LHR</b></td>";
	$SU_rwp = ceil($SU_rwp);
	$SU_lhr = ceil($SU_lhr);	
	$business_sheet_email_to_send.="
	<td valign='top'>$ ". $SU_rwp ."%2B". $SU_lhr ."=". ($SU_RWP_LHR = $SU_rwp+$SU_lhr) ."</td>
	<td valign='top'></td>";
	//Total SU minus Total Dead, GREEN/RED
	$total_SU_minus_total_DEAD = $SU_RWP_LHR - $DEAD_Reg;
	if($total_SU_minus_total_DEAD<0)
	$business_sheet_email_to_send.="<td valign='top' style='background-color:red; color:black;'>$ ". $total_SU_minus_total_DEAD ."</td>";
	else
	$business_sheet_email_to_send.="<td valign='top' style='background-color:green; color:black;'>$ ". $total_SU_minus_total_DEAD ."</td></tr>";
	//NEW ROW, for SIGNUP PER DAY with NEW DAYS CALCULATION, from 1st of month till date DAYS CALCULATION
	$business_sheet_email_to_send.="
	<tr bgcolor=#eceff5>
	<td class='specalt'><b>PER DAY SIGNUP</b></td>
	<td valign='top'></td>
	<td valign='top'></td>
	<td valign='top'>$ ". ($SU_RWP_LHR / $days_per_day_signup_DAYS) ."</td></tr>";
	//NEW ROW, for SIGNUP PER DAY
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td valign='top'></td>
	<td valign='top'></td>
	<td valign='top'></td>
	<td valign='top'>$ ". ($SU_RWP_LHR / $per_day_signup_DAYS) ."</td></tr>";
	///////////////////////////////////// Total income in this month, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Total Income in this Month</b></td>
	<td valign='top'>$ ". $total_income_in_this_month_overall = ceil($total_income_in_this_month_overall) ."</td></tr>";
	///////////////////////////////////// Total income in this month, result - end	
	///////////////////////////////////// Total pending till date, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Total Pending till date</b></td>
	<td valign='top'>$ ". $pre_month_pending ."(PRE) %2B ". $current_month_pending . "(1st - to date)=" . ($pre_month_pending + $current_month_pending) ."</td>
	<td valign='top'></td></table>";
	
	$business_sheet_email_to_send.="<br><br><br>"; // New lines for 2nd table
	
	//2nd table of BUSINESS SHEET	
	$business_sheet_email_to_send.="<table border=1 id='table_liquid' cellspacing='2px' >
	<tr bgcolor=#eceff5>
	<th class='specalt'><b>Total Recurring(Current Month)</b></th>
	<th class='specalt'><b>ADVANCE</b></th>
	<th class='specalt'><b>Zero Paid</b></th>
	<th class='specalt'><b>UNFREEZE AUTO Zero Paid</b></th>
	<th class='specalt'><b>Recurring Received</b></th>
	<th class='specalt'><b>Receivable</b></th>
	<th class='specalt'><b>Freeze</b></th>
	<th class='specalt'><b>Dead Regular</b></th></tr>";
	
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td valign='top'>$ ". $total_recurr_curr_month = ($paying_amount_variable - ($SU_rwp+$SU_lhr)) ."</td>
	<td valign='top'>$ ". $recurr_advance ."</td>
	<td valign='top'>$ ". $zero_paid = $recurr_with_zero ."</td>
	<td valign='top'>$ ". $UNFREEZE_AUTO_zero_paid = $recurr_with_zero_UNFREEZE_AUTO ."</td>
	<td valign='top'>$ ". $recurr = $recurr ."</td>
	<td valign='top'>$ ". $receivable = $current_curr_month_pending ."</td>
	<td valign='top'>$ ". $freeze_amount = $freeze_amount ."</td>
	<td valign='top'>$ ". $DEAD_Reg = $DEAD_Reg ."</td></tr></table>";
	
	$business_sheet_email_to_send.="<br><br><br>"; // New lines for 2nd table
	
	//3rd table of BUSINESS SHEET	
	$business_sheet_email_to_send.="<table border=1 id='table_liquid' cellspacing='2px' >
	<tr bgcolor=#eceff5>
	<td valign='top'><b></b></td>
	<td valign='top'><b>Total</b></td>
	<td valign='top'> DAY </td>
	<td valign='top'> NIGHT </td>
	<td valign='top'> LAHORE </td></tr>";
	/////////////////////////////////////  Trial day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Trials</b></td>
	<td valign='top'><b>" . $total_trial = $trial_day+$trial_night+$trial_ycc_lhr . "</b></td>
	<td valign='top'> ". $trial_day ."</td>
	<td valign='top'> ". $trial_night ."</td>
	<td valign='top'> ". $trial_ycc_lhr ."</td></tr>";
	///////////////////////////////////// Trial day/night/ycc lahore, result - end
	/////////////////////////////////////  Signup day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Signups</b></td>
	<td valign='top'><b>" . $total_signup = $signup_day+$signup_night+$signup_ycc_lhr . "</b></td>
	<td valign='top'> ". $signup_day ."</td>
	<td valign='top'> ". $signup_night ."</td>
	<td valign='top'> ". $signup_ycc_lhr ."</td></tr>"; 
	///////////////////////////////////// Signup day/night/ycc lahore, result - end
	/////////////////////////////////////  DEAD REGULAR day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Regular Dead</b></td>
	<td valign='top'><b>" . $total_Dead_Reg= $DEAD_Reg_cnt_day + $DEAD_Reg_cnt_night + $DEAD_Reg_cnt_ycc_lhr . "</b></td>
	<td valign='top'> ". $DEAD_Reg_cnt_day ."</td>
	<td valign='top'> ". $DEAD_Reg_cnt_night ."</td>
	<td valign='top'> ". $DEAD_Reg_cnt_ycc_lhr ."</td></tr>";
	///////////////////////////////////// DEAD REGULAR day/night/ycc lahore, result - end
	/////////////////////////////////////  Freeze day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Freeze</b></td>
	<td valign='top'><b>" . $total_freeze = $freeze_day + $freeze_night + $freeze_ycc_lhr . "</b></td>
	<td valign='top'> ". $freeze_day ."</td>
	<td valign='top'> ". $freeze_night ."</td>
	<td valign='top'> ". $freeze_ycc_lhr ."</td></tr>";
	///////////////////////////////////// Freeze day/night/ycc lahore, result - end
	/////////////////////////////////////  DEAD TRIAL day/night/ycc lahore, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Trial Dead</b></td>
	<td valign='top'><b>" . $total_Dead_Trl = $DEAD_Trl_cnt_day + $DEAD_Trl_cnt_night + $DEAD_Trl_cnt_ycc_lhr . "</b></td>
	<td valign='top'> ". $DEAD_Trl_cnt_day ."</td>
	<td valign='top'> ". $DEAD_Trl_cnt_night ."</td>
	<td valign='top'> ". $DEAD_Trl_cnt_ycc_lhr ."</td></tr>";
	///////////////////////////////////// DEAD TRIAL day/night/ycc lahore, result - end
	
	/////////////////////////////////////  Dead Amount, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Dead Amount</b></td>";
	//ADDING day,night and ycc lhr REGULAR DEAD
	$Reg_DEAD_amount = $DEAD_Reg_amount_day+$DEAD_Reg_amount_night+$DEAD_Reg_amount_ycc_lhr;
	//$freeze_amount = $freeze_amount_day+$freeze_amount_night+$freeze_amount_ycc_lhr;
	$business_sheet_email_to_send.="<td valign='top'> $ " . $Reg_DEAD_amount . "</td></tr>";
	///////////////////////////////////// Dead Amount, result - end
	
	/////////////////////////////////////  Freeze Amount, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Freeze Amount</b></td>";
	//ADDING day,night and ycc lhr FREEZE
	$freeze_amount = $freeze_amount_day+$freeze_amount_night+$freeze_amount_ycc_lhr;
	$business_sheet_email_to_send.="<td valign='top'><b> $  " . $freeze_amount . "</b></td></tr>";
	///////////////////////////////////// Freeze Amount, result - end
	
	/////////////////////////////////////  Signup Amount, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Signup Amount</b></td>
	<td valign='top'><b> $ " . $Signup_Amt = $Signup_Amt . "</b></td></tr>";
	///////////////////////////////////// Signup Amount, result - end
	/////////////////////////////////////  Recurr today, result - start
	$business_sheet_email_to_send.="<tr bgcolor=#eceff5>
	<td class='specalt'><b>Recurring amount today(CCMS date)</b></td>
	<td valign='top'><b> $ " . $recurr_today = $recurr_today . "</b></td></tr>
	</table>";
	
	?>	
	<form action='' method='POST'> 
	<input rows="10" cols="90" id='business_sheet_email_to_send' name='business_sheet_email_to_send' readonly="readonly" type='hidden' value="<?php echo $business_sheet_email_to_send; ?>"/>
	<div id="label"></div><div id="field"><input name="sender" type="button" id="sender" value="Send Email" onclick="javascript: send_email_to_management()" /> </div>
	<div id="ajaxdiv_summary_business_sheet"></div>
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
	echo "<th class='specalt'><b>advance</b></th>";
	echo "<th class='specalt'><b>zero_paid</b></th>";
	echo "<th class='specalt'><b>recurr_received</b></th>";
	echo "<th class='specalt'><b>receivable</b></th>";
	echo "<th class='specalt'><b>freeze</b></th>";
	echo "<th class='specalt'><b>dead_regular</b></th>";
	echo "<th class='specalt'><b>pre_month_pending</b></th>";
	echo "<th class='specalt'><b>operator</b></th>";
	echo "<th class='specalt'><b>ccms_datetime</b></th>";
	echo "<th class='specalt'><b>curr_datetime</b></th>";
	echo "</tr>"; 
	echo "<tr bgcolor=#FF0000>";
	$sql_output="SELECT * FROM campus_business";
	$result=mysql_query($sql_output);
	while($row_output=mysql_fetch_array($result))
	{
		echo "<td valign='top'><b>". $row_output['id'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['total_recurr'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['advance'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['zero_paid'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['recurr_received'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['receivable'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['freeze'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['dead_regular'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['pre_month_pending'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['operator'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['ccms_datetime'] ."</b></td>";
		echo "<td valign='top'><b>". $row_output['curr_datetime'] ."</b></td>";
		echo "</tr>"; 
	}
	echo "</tr>"; 	
	echo "</table>";
//}
include('include/footer.php');
?>