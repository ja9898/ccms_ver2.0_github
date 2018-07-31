<? 
include('config.php');
include('include/header.php');
?>
<form action='<?php echo $_SERVER['PHP_SELF']?>' method='post'>
<?php 
if($_SESSION['userType']!=3) { ?>



<?php echo getDataList(stripslashes($_POST['teacher']),'teacher',3);}?>


<select name='days[]'  >
<option>Select Days</option>
<option <?php if(isset($_POST['days']) && in_array("Monday",$_POST['days'])){ echo "selected='selected'";}?>>Monday</option>
<option <?php if(isset($_POST['days']) && in_array("Tuesday",$_POST['days'])){ echo "selected='selected'";}?>>Tuesday</option>
<option <?php if(isset($_POST['days']) && in_array("Wednesday",$_POST['days'])){ echo "selected='selected'";}?>>Wednesday</option>
<option <?php if(isset($_POST['days']) && in_array("Thursday",$_POST['days'])){ echo "selected='selected'";}?>>Thursday</option>
<option <?php if(isset($_POST['days']) && in_array("Friday",$_POST['days'])){ echo "selected='selected'";}?>>Friday</option>
<option <?php if(isset($_POST['days']) && in_array("Saturday",$_POST['days'])){ echo "selected='selected'";}?>>Saturday</option>
<option <?php if(isset($_POST['days']) && in_array("Sunday",$_POST['days'])){ echo "selected='selected'";}?>>Sunday</option>
</select>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['classDate']),'classDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;<input type="submit" class="button" value="Show Classes">
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
</form><br /><br /><br />

<? 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
if($_SESSION['userType']!=3)
{
	echo "<th class='specalt'><b>Pay date</b></th>"; 
}
echo "<th class='specalt'><b>Recurring(Y/N)</b></th>"; 
 
echo "<th class='specalt'><b>Course</b></th>"; 
echo "<th class='specalt'><b>Report submit</b></th>"; 
echo "<th class='specalt'><b>Skype ID</b></th>";
echo "<th class='specalt'><b>Status</b></th>";  
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>Comments</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>"; 
echo "<th class='specalt'><b>File</b></th>"; 
echo "<th class='specalt'><b>Action</b></th>"; 
if($_SESSION['userType']==1)
{
echo "<th class='specalt'><b>Download file</b></th>"; 
}


//echo "<th class='specalt' colspan=1><b>Actions</b></th>";  
echo "</tr>";
echo $systemdate = systemDate();
echo "<br>";
echo $systemdate_day = date('d', strtotime(nl2br($systemdate)));
echo "<br>";
echo $five_days_ahead = date('Y-m-d', strtotime(nl2br($systemdate). ' + 5 days'));
echo "<br>";
echo $five_days_ahead_day = date('d', strtotime(nl2br($systemdate). ' + 5 days'));
echo "<br>";
echo "******";

if(!isset($_POST['days'])){
	$_POST['days'][0]='Monday';
	}
if(!isset($_POST['classDate'])){
	$_POST['classDate']=date('Y-m-d');
	
	}
if($_SESSION['userType']==3) {
	

$result=mysql_query("SELECT campus_schedule.id,campus_schedule.duedate as due_date,campus_schedule.paydate,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,year(campus_schedule.duedate) AS year,
	day(campus_schedule.paydate) AS payday,month(campus_schedule.paydate) AS paymonth,year(campus_schedule.paydate) AS payyear,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,
	campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.startTime,campus_schedule.endTime,
	campus_schedule.startDate,campus_schedule.endDate,campus_schedule.comments  
	FROM campus_schedule 
	where status=1 and `campus_schedule`.std_status!=3 and campus_schedule.status_freeze=0 and `campus_schedule`.std_status!=4 and teacherID='".$_SESSION['userId']."' 
	and classType in (".getPlan($_POST['days'][0]).") order by `campus_schedule`.startTime asc") 
	or trigger_error(mysql_error());

}
else{

//$result = mysql_query("SELECT `campus_schedule`.*  FROM `campus_schedule` where status=1 and `campus_schedule`.std_status!=3 and teacherID='".$_POST['teacher']."' and classType in (".getPlan($_POST['days'][0]).") and startDate<='".prepareDate($_POST['classDate'])."' and endDate>='".prepareDate($_POST['classDate'])."' order by `campus_schedule`.startTime asc") or trigger_error(mysql_error());
$result=mysql_query("SELECT campus_schedule.id,campus_schedule.duedate as due_date,campus_schedule.paydate,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,year(campus_schedule.duedate) AS year,
	day(campus_schedule.paydate) AS payday,month(campus_schedule.paydate) AS paymonth,year(campus_schedule.paydate) AS payyear,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,
	campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.startTime,campus_schedule.endTime,
	campus_schedule.startDate,campus_schedule.endDate,campus_schedule.comments,
	campus_schedule.assessment_filepath 
	FROM campus_schedule 
	where status=1 and `campus_schedule`.std_status!=3 and campus_schedule.status_freeze=0 and `campus_schedule`.std_status!=4 and teacherID='".$_POST['teacher']."' 
	and classType in (".getPlan($_POST['days'][0]).") order by `campus_schedule`.startTime asc") 
	or trigger_error(mysql_error());

}
	$recieved = array();
	$recieved_with_tran_id = array();
	$signups = array();
	$amount = array();
	$pending_2nd_tbl = array();
	
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
echo "<tr>"; 
if($_SESSION['userType']!=3)
{
	echo "<td valign='top'>" . nl2br( $row['payday']) . "</td>"; 
}
if($row['std_status']==1 || $row['std_status']==5 || $row['std_status']==6)
{
	echo "<td valign='top'></td>";  
}
else
{
	//echo "<td valign='top'>" . nl2br( $row['payday']) . "</td>"; 
}

		$signup_check=1;
		$countresult=$row['amount'];
		
		if($_SESSION['userType']==3) {
			//COMMENTING FOLLOWING FOR LOOP THROUGH  e.g FROMDATE=26-11-2013 to TODATE=25-12-2013, NOT current month date('n')
			//$countmonthsql="select amount as amounttran_not_main,date as date_rec,dateRecieved as curr_month_date_rec,discount_tran,month(date) as daterec_month,year(date) as daterec_year,operator,id FROM campus_transaction where month(dateRecieved)='".date('n')."' and studentID=".$row['studentID']." and schedule_id=".$row['id']." and teacherID='".$_SESSION['userId']."' "; 
			$countmonthsql="select amount as amounttran_not_main,date as date_rec,dateRecieved as curr_month_date_rec,discount_tran,month(date) as daterec_month,year(date) as daterec_year,operator,id FROM campus_transaction where dateRecieved BETWEEN '".prepareDate($_POST['classDate'])."' and '".prepareDate($_POST['toDate'])."' and studentID=".$row['studentID']." and schedule_id=".$row['id']." and teacherID='".$_SESSION['userId']."' "; 
			
			$countmonthesult=mysql_query($countmonthsql);
			$countmonthesult=mysql_fetch_assoc($countmonthesult);
		}
		else
		{
			//COMMENTING FOLLOWING FOR LOOP THROUGH  e.g FROMDATE=26-11-2013 to TODATE=25-12-2013, NOT current month date('n')
			//$countmonthsql="select amount as amounttran_not_main,date as date_rec,dateRecieved as curr_month_date_rec,discount_tran,month(date) as daterec_month,year(date) as daterec_year,operator,id FROM campus_transaction where month(dateRecieved)='".date('n')."' and studentID=".$row['studentID']." and schedule_id=".$row['id']." and teacherID='".$_POST['teacher']."' "; 
			$countmonthsql="select amount as amounttran_not_main,date as date_rec,dateRecieved as curr_month_date_rec,discount_tran,month(date) as daterec_month,year(date) as daterec_year,operator,id FROM campus_transaction where dateRecieved BETWEEN '".prepareDate($_POST['classDate'])."' and '".prepareDate($_POST['toDate'])."' and studentID=".$row['studentID']." and schedule_id=".$row['id']." and teacherID='".$_POST['teacher']."' "; 
			
			$countmonthesult=mysql_query($countmonthsql);
			$countmonthesult=mysql_fetch_assoc($countmonthesult);
		}
		$amount[$row['id']]=$countresult;
		$pending_2nd_tbl[$countmonthesult['id']]=$countresult-$countmonthesult['amounttran_not_main']-$countmonthesult['discount_tran'];

		
		//This is simply signup during current month
		if(/*($row['due_date']==nl2br(prepareDate($_POST['classDate']))nl2br(prepareDate($_POST['fromDate'])) && $row['due_date']<=nl2br(prepareDate($_POST['toDate']))) && */ $row['due_date']==$countmonthesult['date_rec']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult))
		{
		$signups[$row['id']]=$row['amount'];
		$signup_check=0;
		echo "<td valign='top'>*</td>";
		}

		if(!empty($countresult) && ($countmonthesult['daterec_month']<=date('n') && $countmonthesult['daterec_year']==date('Y')) && $signup_check==1)
		{
		$recieved[$row['id']]=$row['amounttran'];//oldly used
		//Array for Recurring Paid students
		$total_recurr_paid_stu_array[$row['tran_id']]=$row['amounttran'];
		//Row count for recurring paid students counting
		$row_count_recurr_paid_stu = $row_count_recurr_paid_stu +1;
		//Recurring PAID AMOUNT
		if($countmonthesult['amounttran_not_main']>0)
		{
			//Following condition is for MAKEOVER - As makeover has no recurring or paydate
			if($row['std_status']==1 || $row['std_status']==5 || $row['std_status']==6)
			{
				echo "<td valign='top'></td>";  
			}
			else
			{
				//echo "<td valign='top'>" . $countmonthesult['amounttran_not_main'] ." </td>";
				echo "<td valign='top' style='color:green; font-weight:bold'>PAID</td>";
			}
		}
		if($countmonthesult['amounttran_not_main']==0 && $pending_2nd_tbl[$countmonthesult['id']]==0)
		{
			echo "<td valign='top'>PAID with ZERO</td>";
		}
		//Recurring PAID WITH ZERO or DEAD
		//if($countmonthesult['amounttran_not_main']==0)
		//{
		//	echo "<td valign='top'>PAID WITH ZERO AND/OR DEAD</td>";
		//}
			
		}
		//If PENDING is not ZERO, show NO(means pending not paid)
		if($pending_2nd_tbl[$countmonthesult['id']]>0)
		{
			//Following condition is for MAKEOVER - As makeover has no recurring or paydate
			if($row['std_status']==1 || $row['std_status']==5 || $row['std_status']==6)
			{
				echo "<td valign='top'></td>";  
			}
			else if(($row['payday'] >= $systemdate_day) && ($row['payday'] <= $seven_days_ahead_day))
			{
				echo "<td valign='top'>DUE</td>";  
			}
			else if(($pending_2nd_tbl[$countmonthesult['id']]>0) && ($row['payday']<$systemdate_day))
			{
				echo "<td valign='top'>PENDING</td>";
			}
			else
			{
				echo "<td valign='top'>-</td>";
			}
		}
	//}//END of INNER while loop

 
echo "<td valign='top'>" . getData(nl2br( $row['courseID']),'course') . "</td>"; 

//Actual PAY DATE
echo "Actual - ".$pay_DATE = date('Y-m-d', strtotime(nl2br($row['paydate'])));
echo "<br>";
/////////////////
//Adding 15 days in PAY DATE
echo $pay_DATE_plus_15 = date('Y-m-d', strtotime(nl2br($pay_DATE). ' + 15 days'));
echo "<br>";
////////////////
//CONVERTING PAY DATE PLUS 15(DATE) with current MONTH and YEAR
$paydate_date_curr_plus_15 = date('d', strtotime( nl2br($pay_DATE_plus_15)));	
$current_month_curr_plus_15 = date('m');									
$current_year_curr_plus_15 = date('Y');									
echo "CURR-PAYDATE PLUS 15:".$complete_curr_paydate_plus_15 = date('Y-m-d', strtotime( $current_year_curr_plus_15."-".$current_month_curr_plus_15."-".$paydate_date_curr_plus_15));
///////////////////////////////////////////
//Subtracting PAY DATE and PAY DATE PLUS 15 to get 15 DAYS 
echo "SUBTARCT 15:".$complete_curr_paydate_sub_15 = abs(strtotime($pay_DATE) - strtotime($pay_DATE_plus_15));
$years   = floor($complete_curr_paydate_sub_15 / (365*60*60*24)); 
$months  = floor(($complete_curr_paydate_sub_15 - $years * 365*60*60*24) / (30*60*60*24)); 
echo "-DAYS:";
echo $days_15    = floor(($complete_curr_paydate_sub_15 - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));
//////////////////////////////////////

//CONVERTING PAY DATE PLUS 5(DATE) with current MONTH and YEAR
echo "<br>";
echo "<br>";
$paydate_date_curr_plus_5 = date('d', strtotime( nl2br($complete_curr_paydate_plus_15)));	
$current_month_curr_plus_5 = date('m');									
$current_year_curr_plus_5 = date('Y');									
echo "CURR-PAYDATE PLUS 5:".$complete_curr_paydate_plus_5 = date('Y-m-d', strtotime( $current_year_curr_plus_5."-".$current_month_curr_plus_5."-".$paydate_date_curr_plus_5. ' + 5 days'));

echo "<br>";
echo "<br>";


//Subtracting PAY DATE PLUS 5 and PAY DATE PLUS 15 to get 5 DAYS
echo "SUBTARCT 5:".$complete_curr_paydate_sub_5 = abs(strtotime( $complete_curr_paydate_plus_5) - strtotime($complete_curr_paydate_plus_15));
$years   = floor($complete_curr_paydate_sub_5 / (365*60*60*24)); 
$months  = floor(($complete_curr_paydate_sub_5 - $years * 365*60*60*24) / (30*60*60*24)); 
echo "-DAYS:";
echo $days_5    = floor(($complete_curr_paydate_sub_5 - $years * 365*60*60*24 - $months*30*60*60*24)/ (60*60*24));




if(($pay_DATE!='1970-01-01') && ($days_15 == 15) && ($days_5 == 5) && ($systemdate >= $complete_curr_paydate_plus_15	) && ($systemdate <= $complete_curr_paydate_plus_5	))
{
	echo "<td valign='top' class='myDiv'>PENDING REPORT</td>";	
}
else if(($pay_DATE!='1970-01-01') && ($days_15 == 15) && ($days_5 == 5) && ($systemdate >= $complete_curr_paydate_plus_15))
{
	echo "<td valign='top' class='myDivblue'>PENDING REPORT</td>";	
}
 
else
{
	echo "<td valign='top' class=''>NOT TO SUBMIT YET</td>";
}

echo "<td valign='top'>" . getSkypeID(nl2br( $row['studentID'])) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>";   
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";   
//Following student ID is sent to class_details_teacher_sub_version.php NOT TO CLASS_DETAILS.PHP for security reasons
echo "<td valign='top'>" .  "<a href=class_details_teacher_sub_version.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>"; 
//////////////////////////
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['comments']) . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";
?>
<form action='daily_scheduler_assessment_success.php' enctype="multipart/form-data" method='post'>
<td valign='top'><input name="assessment_file_new" type="file" /></td>
<td valign='top'>
<!--<input name='upload_file_button' type='submit' value='UPLOAD FILE' class='button'>-->
<input name='upload_file_button' type='submit' class='button' value='UPLOAD FILE'>
</td>
<input type='hidden' value='<? echo $row['id'];?>' name='id_assessment' /> 
</form>
<?
if($_SESSION['userType']==1)
{
	if(!empty($row['assessment_filepath']))
	{
	echo "<td valign='top'><a href='". nl2br( $row['assessment_filepath'])."'>" . DOWNLOAD . "</a></td>";
	}
	else
	{
	echo "<td valign='top'><a href=#>" . NOFILE . "</a></td>";
	}
}  
echo "</tr>"; 
} 
echo "</table>"; 
include('include/footer.php');
?>