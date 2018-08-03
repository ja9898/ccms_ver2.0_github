<? 
include('config.php'); 
include('include/header.php');

/*if(isset($_POST['submit']))
{
	
	$fromDate=date('d',strtotime($_POST['fromDate']));
	
	$fromMonth=date('n',$_POST['fromDate']);
	//$toMonth=date('n',$_POST['toDate']);
	$toDate=date('d',strtotime($_POST['toDate']));
	if($fromDate < $toDate && !empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	     
		 
		  $sql=" Select campus_schedule.id,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
campus_schedule.dues as amount,
campus_schedule.studentID,

campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and day(campus_schedule.duedate) BETWEEN ".$fromDate." AND ".$toDate."
 order by dayz DESC";
 
}
	elseif(!empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	      $sql=" Select campus_schedule.id,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
campus_schedule.dues as amount,
campus_schedule.studentID,

campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and day(campus_schedule.duedate) not BETWEEN ".$fromDate." AND ".$toDate."
 order by dayz DESC";
	}else
	if(!empty($_POST['toDate'])){
		
		  $sql=" Select campus_schedule.id,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
campus_schedule.dues as amount,
campus_schedule.studentID,

campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and day(campus_schedule.duedate) =  ".$fromDate."
 order by dayz DESC"; 

		}
	
}*/
if(isset($_POST['submit']) && !empty($_POST['fromDate']) && !empty($_POST['toDate']))
{
//DUEDATE IS NOT USED, //In Following query , condition was on DUEDATE, Now it is on PAYDATE(05-07-2013)
$fromDate=date('d',strtotime($_POST['fromDate']));
$toDate=date('d',strtotime($_POST['toDate']));

	if($_SESSION['userType']==8)
	{
		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,
		campus_schedule.id,campus_schedule.duedate,campus_schedule.paydate,
		day(campus_schedule.duedate) AS dddayz,
		month(campus_schedule.duedate) AS ddmonth,
		year(campus_schedule.duedate) AS ddyear,
		day(campus_schedule.paydate) AS pddayz,
		month(campus_schedule.paydate) AS pdmonth,
		year(campus_schedule.paydate) AS pdyear,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.teacherID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.`status`
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=2 and 
		campus_schedule.teacherID!=0 and campus_schedule.`status` =1 and std_status!=3 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
		order by dddayz DESC";
	}
	
	//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
	else if($_SESSION['userType']==15)
	{
		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_schedule.id,campus_schedule.duedate,campus_schedule.paydate,
		day(campus_schedule.duedate) AS dddayz,
		month(campus_schedule.duedate) AS ddmonth,
		year(campus_schedule.duedate) AS ddyear,
		day(campus_schedule.paydate) AS pddayz,
		month(campus_schedule.paydate) AS pdmonth,
		year(campus_schedule.paydate) AS pdyear,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.teacherID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.`status`
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=2 and 
		campus_schedule.teacherID!=0 and campus_schedule.`status` =1 and std_status!=3 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
		order by dddayz DESC";
	}

	else
	{

		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,
		campus_schedule.id,campus_schedule.duedate,campus_schedule.paydate,
		day(campus_schedule.duedate) AS dddayz,
		month(campus_schedule.duedate) AS ddmonth,
		year(campus_schedule.duedate) AS ddyear,
		day(campus_schedule.paydate) AS pddayz,
		month(campus_schedule.paydate) AS pdmonth,
		year(campus_schedule.paydate) AS pdyear,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.teacherID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.`status`
		FROM campus_schedule 
		INNER JOIN 
		capmus_users 
		ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=2 and campus_schedule.`status`=1 and std_status!=3 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
		order by dddayz DESC";
	}
}
else
{
//DUEDATE IS NOT USED, //In Following query , condition was on DUEDATE, Now it is on PAYDATE(05-07-2013)

	if($_SESSION['userType']==8)
	{
		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,
		campus_schedule.id,campus_schedule.duedate,campus_schedule.paydate,
		day(campus_schedule.duedate) AS dddayz,
		month(campus_schedule.duedate) AS ddmonth,
		year(campus_schedule.duedate) AS ddyear,
		day(campus_schedule.paydate) AS pddayz,
		month(campus_schedule.paydate) AS pdmonth,
		year(campus_schedule.paydate) AS pdyear,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.teacherID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.`status`
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and 
		campus_schedule.std_status=2 and campus_schedule.`status` =1 
		order by dddayz DESC";
	}
	//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
	else if($_SESSION['userType']==15)
	{
		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_schedule.id,campus_schedule.duedate,campus_schedule.paydate,
		day(campus_schedule.duedate) AS dddayz,
		month(campus_schedule.duedate) AS ddmonth,
		year(campus_schedule.duedate) AS ddyear,
		day(campus_schedule.paydate) AS pddayz,
		month(campus_schedule.paydate) AS pdmonth,
		year(campus_schedule.paydate) AS pdyear,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.teacherID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.`status`
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and 
		campus_schedule.std_status=2 and campus_schedule.`status` =1 
		order by dddayz DESC";
	}
	else
	{
		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,
		campus_schedule.id,campus_schedule.duedate,campus_schedule.paydate,
		day(campus_schedule.duedate) AS dddayz,
		month(campus_schedule.duedate) AS ddmonth,
		year(campus_schedule.duedate) AS ddyear,
		day(campus_schedule.paydate) AS pddayz,
		month(campus_schedule.paydate) AS pdmonth,
		year(campus_schedule.paydate) AS pdyear,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.teacherID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.`status`
		FROM campus_schedule 
		INNER JOIN 
		capmus_users 
		ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=2 and campus_schedule.`status` =1 
		order by dddayz DESC";
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
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
<br /><br />
</div>

<? 
//PAYMENT PROBLEM
//////////////////////////////////
$td=date("Y-m-d");
$tdd=date("d");//echo " todays date month<br>";
$tdm=date("m");//echo " todays date month<br>";
$tdd=intval($tdd);//echo " todays date month-int<br>";
$tdm=intval($tdm);//echo " todays date month-int<br>";

//echo "<br><br>";
//////////////////////////////////
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>TL Name</th>";
echo "<th class='specalt'>Teacher</th>";
echo "<th class='specalt'>Amount</th>";
echo "<th class='specalt'>Email</th>";
echo "<th class='specalt'>SIGNUP DATE</th>";
echo "<th class='specalt'>PAY DATE</th>"; 
echo "<th class='specalt'>Year-Month-Date(CURRENT/MAX MONTH DUE DATE)</th>"; 
echo "<th class='specalt'>Received Date</th>"; 
echo "<th class='specalt'>Payment Due</th>"; 
echo "<th class='specalt'>Actions</th>";

echo "</tr>";
$amount=array();
$recieved=array();
$pending =array();
$signups =array();


$result = mysql_query($sql) or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


$countresult=$row['amount'];

 /*$countmonthsql="select sum(amount) as amount,
day(campus_transaction.dateRecieved) AS drday,
month(campus_transaction.dateRecieved) AS drmonth,
year(campus_transaction.dateRecieved) AS dryear 
FROM campus_transaction where studentID=".$row['studentID']." and courseID=".$row['id']."";*/
/*day(maxdate) as drday,
month(maxdate) as drmonth,
year(maxdate) as dryear*/

//QUERY FOR PAYMENT MAXIMUM DATE RECEIVED and MAXIMUM DATE RECEIVED SEPARATE//
$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran,
MAX(day(dateRecieved)) as drday_m,
MAX(month(dateRecieved)) as drmonth_m,
MAX(year(dateRecieved)) as dryear_m 
FROM campus_transaction where studentID=".$row['studentID']." and schedule_id=".$row['id']."";
$maxdate_rec_result = mysql_query($maxdate_rec);
$maxdate_rec_result = mysql_fetch_assoc($maxdate_rec_result);

//echo nl2br($result_m['maxdate']);


/////////////GETTING COUNTRY//////////////// NEWLY ADDED

$query_email="SELECT * FROM campus_students where id=".$row['studentID']." "; 
$email_result=mysql_query($query_email);
$email_result=mysql_fetch_assoc($email_result);


//$countmonthesult=mysql_query($countmonthsql) or die(mysql_error());
//$countmonthesult=mysql_fetch_array($countmonthesult);
//$amount[$row['id']]=$countresult;
//$recieved[$row['id']]=$countmonthesult['amount'];
//$pending[$row['id']]=$countresult-$countmonthesult['amount'];

$mon_pay_left = paymentdue($tdd,$tdm,nl2br($row['pddayz']),nl2br($row['pdmonth']),nl2br($row['pdyear']),date('d', strtotime( nl2br($maxdate_rec_result['maxdate_rec']))),date('m', strtotime( nl2br($maxdate_rec_result['maxdate_rec']))),date('Y', strtotime( nl2br($maxdate_rec_result['maxdate_rec']))));

//$mon_pay_left_d_done = paymentdue_done($tdd,$tdm,nl2br($row['dddayz']),nl2br($row['ddmonth']),nl2br($row['ddyear']),nl2br( $maxdate_rec_result['drday_m']),nl2br( $maxdate_rec_result['drmonth_m']),nl2br( $maxdate_rec_result['dryear_m']));
//if($row['ddmonth']==date('n'))
//{
//$signups[$row['id']]=$countresult;
//}

echo "<tr>";  
echo "<td valign='top'>" . "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
echo "<td valign='top'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['amount']) . "</a></td>";  
echo "<td valign='top'>-</a></td>";  
//FOLLOWING DUE DATE  WAS USED PREVIOUSLY
//echo "<td valign='top'>" . nl2br( $row['dddayz'])." - ".nl2br( $row['ddmonth'])." - ".nl2br( $row['ddyear']) . "</td>";
echo "<td valign='top' style='color:red; font-weight:bold'>" . nl2br( $row['duedate']). "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'>" . nl2br( $row['paydate']). "</td>";

//echo "<td valign='top'>" . nl2br( $countmonthesult['drday'])." - ".nl2br( $countmonthesult['drmonth'])." - ".nl2br( $countmonthesult['dryear']). "</td>";

//FOLLOWING DATE RECEIVED MAXIMUM WAS USED PREVIOUSLY BUT CAUSING PROBLEM BECAUSE I WAS EXTRACTING MAX DAY< MONTH< YEAR SEPARTATELY
//echo "<td valign='top'>" . nl2br( $maxdate_rec_result['drday_m'])." - ".nl2br( $maxdate_rec_result['drmonth_m'])." - ".nl2br( $maxdate_rec_result['dryear_m']) . "</td>";
echo "<td valign='top'>" . nl2br( $maxdate_rec_result['maxdate_rec']). "</td>";
echo "<td valign='top'>" . nl2br( $maxdate_rec_result['date_rec_cam_tran']). "</td>";


echo "<td valign='top'>" .$mon_pay_left. " month's payment left </td>";

//echo "<td valign='top'>" .$mon_pay_left_d_done. " th month payment done </td>";

//echo "<td valign='top'>$" . nl2br( $amount[$row['id']])  . "</td>";  
//echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";  
//echo "<td valign='top'>$" . nl2br( $pending[$row['id']]) . "</td>";  
//echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";
echo "<td ><a class=button href=transaction_paymentdue_month_new.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&due_date={$row['duedate']}&pay_date={$row['paydate']}&startTime={$row['startTime']}>Pay Old Due</a>&nbsp;&nbsp;</td> ";
echo "</tr>"; 


//***************************************************************************************************************
//CODE USED IN paymentdue FUNCTION
// WEBSITE for separating DAY MONTH YEAR FROM THE DATE EXTRACTED FROM THE DATABASE
//http://stackoverflow.com/questions/2935110/problem-to-get-date-month-year-separately-from-database-in-php-file
/*echo 'Day' . date('d', strtotime( nl2br($maxdate_rec_result['maxdate_rec'])))."<br>";
echo 'Month' . date('m', strtotime( nl2br($maxdate_rec_result['maxdate_rec'])))."<br>";
echo 'Year' . date('Y', strtotime( nl2br($maxdate_rec_result['maxdate_rec'])))."<br>";
echo nl2br( $maxdate_rec_result['maxdate_rec'])."<br>";*/
//***************************************************************************************************************
}


//echo "<tr>";  
//echo "<td valign='top'> </td>";
//echo "<td valign='top'>Sum </td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($amount))  . "</td>";  
//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
//echo "<td valign='top'><b>$" . nl2br( array_sum($pending)) . "</td>"; 
//echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";   
//echo "<td valign='top'></td>";

 
echo "</tr>";

echo "</table>";

echo "<a href='#' class=button>New Row</a>"; 
include('include/footer.php');?>