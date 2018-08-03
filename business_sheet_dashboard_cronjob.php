<?php
///////////////////////////////////////////////////**********************************************Making separate session_start and session variables
//session_start();
//include('include/function-inc.php'); 
$database="testnew";
$username="root";
$password="";
/*$r = mysql_connect('localhost',$username,$password);
if (!$r) {
    echo "Could not connect to server\n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Connection established\n"; 
}*/

$link = mysql_connect('localhost', $username, $password);
if (!$link) {
    die('Not connected : ' . mysql_error());
}
else {
    echo "Connection established\n"; 
}
if (! mysql_select_db($database) ) {
    die ('Can\'t use cloud_new1 : ' . mysql_error());
}
$systemdatetime = systemDateTime();
$systemdatetime = strtotime($systemdatetime) + 18000; // Add 5 hour
$systemdatetime = date('Y-m-d H:i:s', $systemdatetime); // Back to string
echo $systemdatetime=date("Y-m-d",strtotime($systemdatetime));

$curr_datetime = date('Y-m-d H:i:s');
$curr_datetime = strtotime($curr_datetime) + 18000; // Add 5 hour
$curr_datetime = date('Y-m-d H:i:s', $curr_datetime); // Back to string
echo $curr_datetime=date("Y-m-d",strtotime($curr_datetime));


//fwrite(STDOUT, "Enter Key:");
//$key_id = fgets(STDIN);

if($curr_datetime==$systemdatetime)
fwrite(STDOUT, "Hello User\n");
else
{ echo "Failed"; 
	fwrite(STDOUT, "UnSuccessful\n");
	exit(0);}
//$sql_user="SELECT * FROM capmus_users WHERE id=$key_id";
//$result = mysql_query($sql_user) or die(mysql_error());
//$row = mysql_fetch_array($result);
//$userID=$row['id'];

$result_insert = getResultResource_all_calculations();
if($result_insert==1){
	//fwrite(STDOUT, "Press Any key to continue-Successful\n");
	print "Successful";
}
else
{
	//fwrite(STDOUT, "Press Any key to continue-UnSuccessful\n");
	print "UnSuccessful";
}

   function systemDate(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time($todayDate); //Change date into time
  $timeAfterOneHour = $currentTime-9*60*60;

  //return date("Y-m-d H:i:s",$timeAfterOneHour);
  return date("Y-m-d",$timeAfterOneHour);
  
  }

  function systemDateTime(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time($todayDate); //Change date into time
  $timeAfterOneHour = $currentTime-9*60*60;

  return date("Y-m-d H:i:s",$timeAfterOneHour);
  //return date("Y-m-d",$timeAfterOneHour);
  
  }

function getResultResource_all_calculations()
{



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
	
	
	
	///////////////////////////////////////////////////////////// Dead Regular student - START
	//'First Date    = ' . date('Y-m-01') . '<br />';
    //'Last Date     = ' . date('Y-m-t')  . '<br />';
	echo "<br>";
	echo "<br>";
	echo "<br>";
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
				$recieved_with_zero[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount'];
				$recieved_with_zero_tran_id[$row_Total_Recurr_Rec['tran_id']]=$row_Total_Recurr_Rec['amount'];
			}
		}
	
	}
	$recurr = nl2br( array_sum($recieved));
	$SU = nl2br( array_sum($signups)); 
	
	$recurr_with_zero = nl2br( array_sum($recieved_with_zero));
	
	//$total_income_in_this_month_overall = $recurr + $SU;  
	//////////////////////////////////////////////// Total Recurr Received amount of Current Month - END

	//LAHORE SIGNUP AMOPUNT|||||||||||||||||||||||**************????????????????????????????????????
	///////////////////////////////////////////////////////////// LAHORE SIGNUP- START
	$sql_Lahore_SU="SELECT id,SUM(dues) as SU_lhr_amount,status  
	FROM campus_schedule 
	WHERE agentId=565 and status=1 and 
	campus_schedule.duedate>='".$fromDate_ccms."' and campus_schedule.duedate<= '".$toDate_ccms."' ";
	$result_Lahore_SU = mysql_query($sql_Lahore_SU);
	while($row_Lahore_SU=mysql_fetch_array($result_Lahore_SU))
	{
		$SU_lhr=$row_Lahore_SU['SU_lhr_amount'];
	}
	///////////////////////////////////////////////////////////// LAHORE SIGNUP - END
	
	///////////////////////////////////////////////////////////// Total income in this month - START
	$SU_rwp = $SU - $SU_lhr;
	$total_income_in_this_month_overall = ($recurr + $SU_rwp);  
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
	
	$fromDate_ccms = date('Y-m-01', strtotime($systemdate));
	$toDate_ccms = date('Y-m-t', strtotime($systemdate));
	$fromDate = strtotime($fromDate_ccms);
	$toDate = strtotime($toDate_ccms);
	$per_day_signup_DAYS = $toDate - $fromDate;
	//echo "<br>";
	$per_day_signup_DAYS = floor($per_day_signup_DAYS/(60*60*24));echo "<br>";
	
	////////////////////////////////////////////////////////////// Per Day SIGNUP - END
	
	
	
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
	
	
	
	
	
	
	//3rd table QUERIES			//COUNTING TODAYS Trial/Signup/Dead Reg/Freeze/Trial Dead
	///////////////////////////////////////////////////////////// trial day,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_trial_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_trial_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=506 
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
	ON capmus_users.main_LeadId!=506 and campus_schedule.agentId!=565 
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
	WHERE campus_schedule.agentId=565 
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
	$sql_signup_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_signup_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=506 
	and campus_schedule.duedate>='".$todays_date."' and campus_schedule.duedate<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	
	$result_signup_day = mysql_query($sql_signup_day);
	while($row_signup_day=mysql_fetch_array($result_signup_day))
	{
		$signup_day=$row_signup_day['sch_id_signup_day'];
	}
	////////////////////////////////////////////////////////////// signup day,count- END
	///////////////////////////////////////////////////////////// signup night,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_signup_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_signup_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=506 and campus_schedule.agentId!=565 
	and campus_schedule.duedate>='".$todays_date."' and campus_schedule.duedate<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_signup_night = mysql_query($sql_signup_night);
	while($row_signup_night=mysql_fetch_array($result_signup_night))
	{
		$signup_night=$row_signup_night['sch_id_signup_night'];
	}
	////////////////////////////////////////////////////////////// signup night,count- END
	///////////////////////////////////////////////////////////// signup YCC LAHORE,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_signup_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_signup_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 
	and campus_schedule.duedate>='".$todays_date."' and campus_schedule.duedate<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_signup_ycc_lhr = mysql_query($sql_signup_ycc_lhr);
	while($row_signup_ycc_lhr=mysql_fetch_array($result_signup_ycc_lhr))
	{
		$signup_ycc_lhr=$row_signup_ycc_lhr['sch_id_signup_ycc_lhr'];
	}
	////////////////////////////////////////////////////////////// signup YCC LAHORE,count- END
	
	
	///////////////////////////////////////////////////////////// Dead Regular day,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Reg_cnt_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_reg_cnt_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=506 and campus_schedule.std_status_old=2 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Reg_cnt_day = mysql_query($sql_DEAD_Reg_cnt_day);
	while($row_DEAD_Reg_cnt_day=mysql_fetch_array($result_DEAD_Reg_cnt_day))
	{
		$DEAD_Reg_cnt_day=$row_DEAD_Reg_cnt_day['sch_id_dead_reg_cnt_day'];
	}
	////////////////////////////////////////////////////////////// Dead Regular day,count - END
	///////////////////////////////////////////////////////////// Dead Regular night,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Reg_cnt_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_reg_cnt_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=506 and campus_schedule.agentId!=565 
	and campus_schedule.std_status_old=2 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	$result_DEAD_Reg_cnt_night = mysql_query($sql_DEAD_Reg_cnt_night);
	while($row_DEAD_Reg_cnt_night=mysql_fetch_array($result_DEAD_Reg_cnt_night))
	{
		$DEAD_Reg_cnt_night=$row_DEAD_Reg_cnt_night['sch_id_dead_reg_cnt_night'];
	}
	////////////////////////////////////////////////////////////// Dead Regular night,count - END
	///////////////////////////////////////////////////////////// Dead Regular ycc lahore,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Reg_cnt_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_DEAD_Reg_cnt_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 
	and campus_schedule.std_status_old=2 AND campus_schedule.std_status=3 
	and DATE(campus_schedule.confirm_dead_date)>='".$todays_date."' and DATE(campus_schedule.confirm_dead_date)<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_DEAD_Reg_cnt_ycc_lhr = mysql_query($sql_DEAD_Reg_cnt_ycc_lhr);
	while($row_DEAD_Reg_cnt_ycc_lhr=mysql_fetch_array($result_DEAD_Reg_cnt_ycc_lhr))
	{
		$DEAD_Reg_cnt_ycc_lhr=$row_DEAD_Reg_cnt_ycc_lhr['sch_id_DEAD_Reg_cnt_ycc_lhr'];
	}
	////////////////////////////////////////////////////////////// Dead Regular ycc lahore,count - END
	
	
	///////////////////////////////////////////////////////////// FREEZE day,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_freeze_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_freeze_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=506 
	and campus_schedule.freeze_date>='".$todays_date."' and campus_schedule.freeze_date<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_freeze_day = mysql_query($sql_freeze_day);
	while($row_freeze_day=mysql_fetch_array($result_freeze_day))
	{
		$freeze_day=$row_freeze_day['sch_id_freeze_day'];
	}
	////////////////////////////////////////////////////////////// FREEZE day,count- END
	///////////////////////////////////////////////////////////// FREEZE night,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_freeze_night="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_freeze_night,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId!=506 and campus_schedule.agentId!=565 
	and campus_schedule.freeze_date>='".$todays_date."' and campus_schedule.freeze_date<='".$todays_date."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_freeze_night = mysql_query($sql_freeze_night);
	while($row_freeze_night=mysql_fetch_array($result_freeze_night))
	{
		$freeze_night=$row_freeze_night['sch_id_freeze_night'];
	}
	////////////////////////////////////////////////////////////// FREEZE night,count- END
	///////////////////////////////////////////////////////////// FREEZE YCC LAHORE,count- START
    $systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_freeze_ycc_lhr="SELECT count(campus_schedule.id) as sch_id_freeze_ycc_lhr,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM campus_schedule 
	WHERE campus_schedule.agentId=565 
	and campus_schedule.freeze_date>='".$todays_date."' and campus_schedule.freeze_date<='".$todays_date."' 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_freeze_ycc_lhr = mysql_query($sql_freeze_ycc_lhr);
	while($row_freeze_ycc_lhr=mysql_fetch_array($result_freeze_ycc_lhr))
	{
		$freeze_ycc_lhr=$row_freeze_ycc_lhr['sch_id_freeze_ycc_lhr'];
	}
	////////////////////////////////////////////////////////////// FREEZE YCC LAHORE,count- END
	
	
	///////////////////////////////////////////////////////////// Dead Trial day,count - START
	$systemdate = systemDate();
	$todays_date = $systemdate;	
	$sql_DEAD_Trl_cnt_day="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,count(campus_schedule.id) as sch_id_dead_trl_cnt_day,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId=506 and campus_schedule.std_status_old=1 AND campus_schedule.std_status=3 
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
	ON capmus_users.main_LeadId!=506 and campus_schedule.agentId!=565 
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
	
	
	
	//1st table for the BUSINESS SHEET start - 
	$paying_amount_variable = array_sum($paying_amount);
	///////////////////////////////////// PAYING AMOUNT, result - end
	
	///////////////////////////////////// Dead Regular student, result - start
	$DEAD_Reg;
	(($DEAD_Reg / $paying_amount_variable)*100) ;
	
	///////////////////////////////////// Dead Regular student, result - end
	
	///////////////////////////////////// Total Recurr Received amount of Current Month, result - start
	$recurr;
	$SU_rwp = ceil($SU_rwp);
	//Total SU minus Total Dead, GREEN/RED
	$total_SU_minus_total_DEAD = $SU_rwp - $DEAD_Reg;
	if($total_SU_minus_total_DEAD<0)
	$SU_lhr = ceil($SU_lhr);
	///////////////////////////////////// Total Recurr Received amount of Current Month, result - end
	
	///////////////////////////////////// Total income in this month, result - start
	$total_income_in_this_month_overall = ceil($total_income_in_this_month_overall);
	///////////////////////////////////// Total income in this month, result - end
	
	///////////////////////////////////// Total pending till date, result - start
	$pre_month_pending ."(PRE) + ". $current_month_pending ."(1st - to date)";
	$current_curr_month_pending."(1st - 30th)";
	///////////////////////////////////// Total pending till date, result - end
	
	
	
	//2nd Table - FOr overall calculations - 
	//a) Total Recurr b) Advance c) Zero paid d) freeze amt e) Dead regular amt
	///////////////////////////////////// Total DEAD REGULAR - PERCENTAGE %, result - start
$total_recurr_curr_month = ($paying_amount_variable - ($SU_rwp+$SU_lhr));

$advance = $total_recurr_curr_month - $current_curr_month_pending;

$zero_paid = $recurr_with_zero;

$recurr = $recurr;

$receivable = $current_curr_month_pending;

$freeze_amount = $freeze_amount;

$DEAD_Reg = $DEAD_Reg;
	echo "\nPLEASE WAIT 6 SECONDS MORE\n";
	sleep(1);
	sleep(1);
	sleep(1);
	sleep(1);
	sleep(1);
	sleep(1);
	
	///////////////////////////////////// Total pending till date, result - end

if($curr_datetime==$systemdatetime)
{
/*fwrite(STDOUT, "Enter username:\n");
$name = fgets(STDIN);
fwrite(STDOUT, "Enter password:\n");
echo $pass = fgets(STDIN);*/
/*if($name=="Junaid")
{
	echo "1st Condition Successful";
}
else
{
	echo "1st Condition Failed";
	exit(0);
}*/
echo "1st Condition Successful\n";
sleep(1);
sleep(1);
sleep(1);
sleep(1);

	
$total_recurr=$total_recurr_curr_month;
$advance=$advance;
$zero_paid = $zero_paid;
$recurr = $recurr;
$receivable = $receivable;
$freeze_amount = $freeze_amount;
$DEAD_Reg = $DEAD_Reg;
$pre_month_pending = $pre_month_pending;

//Adding Hours in DATE TIME format using strtotime
echo "\nCCMS DATETIME\n";
echo $systemdatetime = systemDateTime();
$systemdatetime = strtotime($systemdatetime) + 18000; // Add 5 hour
$systemdatetime = date('Y-m-d H:i:s', $systemdatetime); // Back to string
echo $systemdatetime;
echo "\nCURRENT DATETIME\n";
echo $curr_datetime = date('Y-m-d H:i:s');
$curr_datetime = strtotime($curr_datetime) + 18000; // Add 5 hour
$curr_datetime = date('Y-m-d H:i:s', $curr_datetime); // Back to string
echo $curr_datetime;
echo "\n";

//echo $systemdate = systemDate();

//http://www.webeditorsnotes.com/2012/04/six-steps-to-make-wamp-run-automatically-on-system-start-up-2/
	$sql = "INSERT INTO `campus_business` (`total_recurr`, `advance` , `zero_paid` , `recurr_received` ,  `receivable` , `freeze` , `dead_regular`, `pre_month_pending` ,`operator` , `ccms_datetime` , `curr_datetime` ) VALUES(  '$total_recurr','$advance' , '$zero_paid' , '$recurr' ,  '$receivable' ,  '$freeze_amount' ,  '$DEAD_Reg'  ,  '$pre_month_pending' , '159' , '".$systemdatetime."' , '".$curr_datetime."' ) "; 
	mysql_query($sql) or die(mysql_error()); 
	return 1;
}	
//}
return 0;
}
?>