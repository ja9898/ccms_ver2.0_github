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
	
	<div style="float:left">
	<?php
	getTeacherFilterLead();
	getFilterSubmit();
	?>
	</div>
</form>
</div>
<?

	
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
					$sql_curr_till_date_pend_old=" Select capmus_users.id as users_id,capmus_users.LeadId,
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
					
					//MAIN QUERY
					$sql_curr_till_date_pend=
					"SELECT capmus_users.id as users_id,capmus_users.LeadId, 
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					month(campus_schedule.paydate) AS paymonth,
					year(campus_schedule.paydate) AS payyear,
					sum(campus_schedule.dues) as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,
					campus_schedule.teacherID,
					campus_schedule.comments_reminder,
					campus_schedule.date_reminder,
					campus_schedule.`status`
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 ";
					if($_POST['search-teacher-id2']!=0){
						$sql_curr_till_date_pend.=" and capmus_users.LeadId=".$_POST['search-teacher-id2']." ";
					}
					$sql_curr_till_date_pend.="and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 
					GROUP BY day(campus_schedule.paydate)  
					order by paydayz ASC";
	}

//CURRENT MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the CURRENT MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

//echo "<div align='center' style='color:red; font-size:16px'>CURRENT MONTH PENDINGS</div>";
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Days</th>";  
echo "<th class='specalt'>Pending-USD</th>"; 
echo "<th class='specalt'>Received-USD</th>";
echo "<th class='specalt'>Remaining-USD</th>";
echo "<th class='specalt'>Balance</th>"; 
echo "</tr>";

$amount=array();
$recieved=array();
$recieved_usd=array();
$pending =array();
$signups =array();
$signups_usd =array();
$discount =array();
$pending_usd_convert=array();
$balance = 0;
/* if(isset($_POST['submit']))
{ */
	$sql_USD_to_CAD="SELECT * FROM campus_currency WHERE id=433";
	$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_USD_to_CAD));
	$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	
	$unique_array_id=1;
	$result = mysql_query($sql_curr_till_date_pend) or trigger_error(mysql_error()); 
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


	$countresult=$row['amount'];
	$amount[$row['id']]=$countresult;

	//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses


		//SIGNUP
		$countmonthsql="select sum(amount_usd_simple) as amounttran_usd_simple,sum(amount) as amounttran,sum(discount_tran) as discount_tran FROM campus_transaction where month(date)='".date('m')."' and year(date)='".date('Y')."' and campus_transaction.campus=1 and day(campus_transaction.date)='".$row['paydayz']."' ";
		if($_POST['search-teacher-id2']!=0){
			$countmonthsql.=" and campus_transaction.LeadId='".$_POST['search-teacher-id2']."' ";;
		}
		$countmonthsql.="GROUP BY day(campus_transaction.date)"; 
		$countmonthesult=mysql_query($countmonthsql) or die(mysql_error());
		$countmonthesult=mysql_fetch_assoc($countmonthesult);
		$signups_usd[$unique_array_id]=$countmonthesult['amounttran_usd_simple'];
		
		//RECURRING
		$sql_recurr="select id as id_recurr,sum(amount_usd_simple) as amounttran_recurr_usd_simple,sum(amount) as amounttran_recurr,sum(discount_tran) as discount_tran_recurr FROM campus_transaction where month(dateRecieved)='".date('m')."' and year(dateRecieved)='".date('Y')."' and campus_transaction.campus IS NULL and day(campus_transaction.dateRecieved)='".$row['paydayz']."' ";
		if($_POST['search-teacher-id2']!=0){
			$sql_recurr.=" and campus_transaction.LeadId='".$_POST['search-teacher-id2']."' ";;
		}
		$sql_recurr.="GROUP BY day(campus_transaction.dateRecieved)"; 
		$sql_recurr_result=mysql_query($sql_recurr) or die(mysql_error());
		$row_sql_recurr_result=mysql_fetch_assoc($sql_recurr_result);
		//echo "recurr:".$row_sql_recurr_result['amounttran_recurr'];echo "<br>";echo "<br>";
		$recieved_usd[$unique_array_id]=$row_sql_recurr_result['amounttran_recurr_usd_simple'];

		$amount[$row['id']]=$countresult;
		$recieved[$row['id']]=$row_sql_recurr_result['amounttran_recurr'];
		$pending[$unique_array_id]=$countresult-$countmonthesult['amounttran']-$countmonthesult['discount_tran'];
		$signups[$unique_array_id]=$countmonthesult['amounttran'];
		
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
	$query_country="SELECT `campus_students`.id as stu_id,countryID,extId,extId_old,parentId FROM campus_students where id=".$row['studentID']." "; 
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
		if($row['month']==date('n') && $row['year']==date('Y'))
		{
		//echo "SU**:".$signups[$row['id']]=$countresult;
		}
		
		
		if($pending[$unique_array_id] >=10 && ($signups[$row['id']]==''))
		{
			//Previous month signup between 25 to 30/31st, And now its paying date is next month's 1 to 10th,THEN
			//It must not be shown in current month pending
			if($paydate_strtotime>=$duedate_strtotime && $days_paydate_minus_duedate_days<=10 && $paydate_month==date('n') && $paydate_month!=$duedate_month && $paydate_year==date('Y'))
			{
				//$pending[$unique_array_id]=0;
				 echo "<tr>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>123---" . nl2br( $row['paydayz'])  . "</td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . nl2br( $row['amount'])  . "</td>";
				
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
				echo "<td valign='top'><a style='color:orange; font-weight:bold' href=book_scheduler_manage_PARENT_pending_report_OVERALL.php?parentId={$query_country_result['parentId']}>" . getparentname(nl2br( $query_country_result['parentId'])). "</a></td>";
				echo "<td valign='top'>" . "<a href=class_details_classes_count.php?id={$row['studentID']}&paydate={$row['paydayz']} target='_blank'>Class Details</a></td>";
				echo "<td valign='top'>" . "<a href=class_details_classes_count_days_cal_paydate_to_paydate.php?id={$row['studentID']}&paydate={$row['paydayz']}&courseID={$row['courseID']} target='_blank' style='color:blue; font-weight:bold'>Class Details-PayDate TO PayDate</a></td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>" . showCourse(nl2br( $row['courseID'])). "</td>"; 
				echo "<td valign='top' style='color:green; font-weight:bold'>$" . nl2br( $pending[$unique_array_id]) . "</td>";  
				 //from CAD to USD Conversion/////////////////////////////////////////////////////////////
				 echo "<td valign='top' style='color:green; font-weight:bold'>$" . $pending_usd_convert[$unique_array_id] =  round($pending[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
				echo "<td valign='top' style='color:blue; font-weight:bold'>" . $sql_amt_ori_result['amount_original']  . "</td>";
				//td for the modal
				echo "<td valign='top'>"?> 
				<button id="myBtn" onclick='modal_window_box(<?php echo $row['id'];  ?>)' class='button' style='background-color:skyblue'>Reminder</button>
				<? "</td>";
				
				if($row['comments_reminder']){
				echo "<td valign='top' id='idReminder_".$row['id']."'><div class='tooltip' align='center'>".date($row['date_reminder'])." <img src='images/info-512.png' width=20px height=20px /><span class='tooltiptext'>" . $row['comments_reminder'] ."<br> @ <b>" .$row['date_reminder'] ."</b></span>  </td>";
				}else{
					echo "<td valign='top' id='idReminder_".$row['id']."'>&nbsp</td>";
				}
				echo "</tr>"; 
			}
			else
			{
				echo "<tr>";  
				echo "<td valign='top'>" . nl2br( $row['paydayz']) . "</td>";

				round($pending[$unique_array_id],2);  
				//from CAD to USD Conversion/////////////////////////////////////////////////////////////
				//$pending_usd_convert[$unique_array_id] =  round($pending[$unique_array_id]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'],2) ;

				//echo "<td valign='top'>$" . round($signups[$unique_array_id],2) . "</td>"; 
				//echo "<td valign='top'>$" . round($signups_usd[$unique_array_id],2) . "</td>"; 
				
				//Pending USD After signup subtraction 
				echo "<td valign='top'>$" . $total_pending[$unique_array_id] = round($pending[$unique_array_id] - $signups_usd[$unique_array_id],2) . "</td>"; 
				
				//Received USD 
				echo "<td valign='top'>$" . $total_received[$unique_array_id] = round($recieved_usd[$unique_array_id],2) . "</td>";  
				
				//Remaining = Pending - / minus Received USD
				//$balance;
				echo "<td valign='top'>$" . $total_remaining[$unique_array_id] = round($total_pending[$unique_array_id] - $total_received[$unique_array_id],2) . "</td>";  
				
				echo "<td valign='top'>$" . $balance = $balance+$total_remaining[$unique_array_id] . "</td>";  
				

				echo "</tr>"; 
			}		
		}
		$unique_array_id = $unique_array_id + 1;
	}
	
/* } *///END of if($_POST['submit'])CURRENT PENDING

echo "<tr>";  
echo "<td valign='top'>Sum </td>";  
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($total_pending)) . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($total_received)) . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($total_remaining)) . "</td>"; 
//echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($discount)) . "</td>";   
echo "</tr>";
echo "</table>";

	///////////////////////////////////////////////////////////// Total PENDING TILL DATE - END	
include('include/footer.php');
?>