<? 
include('config.php'); 
include('include/header.php');
$studentID = (int) $_GET['id'];
if(isset($_POST['submit']))
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
day(campus_schedule.paydate) AS paydayz,
campus_schedule.dues as amount,
campus_schedule.studentID,

campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate."
 order by dayz DESC";
 
}
	elseif(!empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	      $sql=" Select campus_schedule.id,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
day(campus_schedule.paydate) AS paydayz,
campus_schedule.dues as amount,
campus_schedule.studentID,

campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status=2 and day(campus_schedule.paydate) not BETWEEN ".$fromDate." AND ".$toDate."
 order by dayz DESC";
	}else
	if(!empty($_POST['toDate'])){
		
		  $sql=" Select campus_schedule.id,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
day(campus_schedule.paydate) AS paydayz,
campus_schedule.dues as amount,
campus_schedule.studentID,

campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status=2 and day(campus_schedule.paydate) =  ".$fromDate."
 order by dayz DESC"; 

		}
	
}
if(isset($_POST['submit']) && !empty($_POST['fromDate']) && !empty($_POST['toDate']))
{
	$sql="SELECT campus_schedule.id,
day(campus_schedule.duedate) AS dddayz,
month(campus_schedule.duedate) AS ddmonth,
year(campus_schedule.duedate) AS ddyear,
day(campus_schedule.paydate) AS paydayz,

campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.`status`
FROM campus_schedule 
WHERE campus_schedule.std_status=2 and campus_schedule.`status` =1 and campus_schedule.paydate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.paydate<= '".prepareDate($_POST['toDate'])."' 
order by dddayz DESC";
//campus_schedule.std_status!=5 and campus_schedule.std_status!=4 and campus_schedule.std_status!=3 and campus_schedule.std_status!=1
}
else
{
if(isset($_POST['submit']) && $_POST['search-student-id']!="")		//THIS QUERY WILL RUN IF STUDENT FILTERS IS USED
{
	  /*$sql="SELECT campus_schedule.id,
day(campus_schedule.duedate) AS dddayz,
month(campus_schedule.duedate) AS ddmonth,
year(campus_schedule.duedate) AS ddyear,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.`status`
FROM campus_schedule 
WHERE campus_schedule.std_status=2 and campus_schedule.`status` =1 
order by dddayz DESC";
day(campus_transaction.dateRecieved) AS drday,
month(campus_transaction.dateRecieved) AS drmonth,
year(campus_transaction.dateRecieved) AS dryear,*/

//QUERY FOR DATE RECEIVED FROM campus_transaction//
$sql="SELECT campus_transaction.studentID,
campus_transaction.teacherID,
day(campus_transaction.dateRecieved) AS drday,
month(campus_transaction.dateRecieved) AS drmonth,
year(campus_transaction.dateRecieved) AS dryear,
campus_transaction.amount as tran_amount 
FROM campus_transaction 
WHERE campus_transaction.studentID = ".$_POST['search-student-id']." and campus_transaction.dateRecieved!='0000-00-00'";
//campus_schedule.std_status!=5 and campus_schedule.std_status!=4 and campus_schedule.std_status!=3 and campus_schedule.std_status!=1
}
else																//THIS QUERY WILL RUN IF STUDENT id is passsed from transaction_paymenydue_report.php(total payments VER2 IS USED
{
$sql="SELECT campus_transaction.*,
campus_transaction.teacherID,
campus_transaction.amount as tran_amount,
campus_transaction.email as paypal_email_id,
campus_transaction.sender_name  
FROM campus_transaction 
WHERE campus_transaction.studentID = ".$studentID."";

}
}
?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
getStudentFilter();
echo $_POST['search-student-id'];

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
echo "<th class='specalt'>Sch ID</th>";
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Paying person</th>";
echo "<th class='specalt'>Amount</th>";
echo "<th class='specalt'>Email</th>";
echo "<th class='specalt'>Paypal Email</th>";



echo "<th class='specalt'>SIGNUP DATE</th>"; 
//echo "<th class='specalt'>Day-Month-Year(DATE RECEIVED)</th>"; 
echo "<th class='specalt'>CURRENT/MAX MONTH DUE DATE</th>"; 
echo "<th class='specalt'>Received Date</th>"; 
echo "<th class='specalt'>Tran ID</th>"; 
echo "<th class='specalt'>Comments</th>"; 
echo "<th class='specalt'>Teacher</th>"; 


//echo "<th class='specalt'>Payment Month done</th>"; 									WHICH MONTH PAYMENT DONE COMMENTED

//echo "<th class='specalt'>Total Amount</th>"; 
//echo "<th class='specalt'>Recieved Amount</th>"; 
//echo "<th class='specalt'>Pending Amount</th>"; 
//echo "<th class='specalt'>Signup Amount</th>";
//echo "<th class='specalt'>Actions</th>";

echo "</tr>";
$amount=array();
$recieved=array();
$pending =array();
$signups =array();

$result = mysql_query($sql) or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 

$countresult=$row['amount'];



//QUERY FOR DUE DATE FROM campus_schedule//
$detail_report="SELECT campus_schedule.id,campus_schedule.teacherID,
campus_schedule.paydate 
FROM campus_schedule WHERE campus_schedule.studentID=".$row['studentID']." and campus_schedule.std_status=2 and campus_schedule.`status` =1";
$result_detail_report = mysql_query($detail_report);
$result_detail_report = mysql_fetch_assoc($result_detail_report);

//echo nl2br($result_m['maxdate']);

//QUERY FOR EMAIL FROM campus_students//
$email_query="SELECT * FROM campus_students WHERE id=".$row['studentID']." and std_status=2";
$email_result=mysql_query($email_query);
$email_result=mysql_fetch_array($email_result);

//echo nl2br($email_result['email']);

//QUERY FOR AMOUNT SUM PER STUDENT FROM campus_transaction//
$amount_sum="SELECT sum(amount) as amount_sum FROM campus_transaction WHERE campus_transaction.studentID = ".$row['studentID']." and campus_transaction.dateRecieved!='0000-00-00'";
$result_amount_sum=mysql_query($amount_sum);
$result_amount_sum=mysql_fetch_array($result_amount_sum);




$countmonthesult=mysql_query($countmonthsql);
$countmonthesult=mysql_fetch_assoc($countmonthesult);

$amount[$row['id']]=$countresult;
$recieved[$row['id']]=$countmonthesult['amount'];
$pending[$row['id']]=$countresult-$countmonthesult['amount'];

$mon_pay_left = paymentdue($tdd,$tdm,nl2br($result_detail_report['dddayz']),nl2br($result_detail_report['ddmonth']),nl2br($result_detail_report['ddyear']),nl2br( $row['drday']),nl2br( $row['drmonth']),nl2br( $row['dryear']));

$mon_pay_left_d_done = paymentdue_done($tdd,$tdm,nl2br($result_detail_report['dddayz']),nl2br($result_detail_report['ddmonth']),nl2br($result_detail_report['ddyear']),nl2br( $row['drday']),nl2br( $row['drmonth']),nl2br( $row['dryear']));


if($row['ddmonth']==date('n'))
{
$signups[$row['id']]=$countresult;

}
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</a></td>";  
echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
echo "<td valign='top'>" . nl2br( $row['sender_name']) . "</a></td>";  
echo "<td valign='top'>" . nl2br( $row['tran_amount']) . "</a></td>";  
echo "<td valign='top'>" . nl2br( $email_result['email']) . "</a></td>"; 
echo "<td valign='top'>" . nl2br( $row['paypal_email_id']) . "</a></td>"; 
 

//echo "<td valign='top'>" . nl2br( $row['dateRecieved']) . "</a></td>";  


echo "<td valign='top'>" . $result_detail_report['paydate'] . "</td>";
//echo "<td valign='top'>" . nl2br( $countmonthesult['drday'])." - ".nl2br( $countmonthesult['drmonth'])." - ".nl2br( $countmonthesult['dryear']). "</td>";
echo "<td valign='top'>" . nl2br( $row['dateRecieved']). "</td>";
echo "<td valign='top'>" . nl2br( $row['date']). "</td>";
echo "<td valign='top'>" . nl2br( $row['transactionID']). "</td>";
echo "<td valign='top'>" . nl2br( $row['comments']). "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])). "</td>";


//echo "<td valign='top'>" .$mon_pay_left_d_done. " th month payment done </td>";					WHICH MONTH PAYMENT DONE COMMENTED

//echo "<td valign='top'>$" . nl2br( $amount[$row['id']])  . "</td>";  
//echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";  
//echo "<td valign='top'>$" . nl2br( $pending[$row['id']]) . "</td>";  
//echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";
echo "</tr>"; 
}


echo "<tr>";  
echo "<td valign='top'> </td>";    
echo "<td valign='top'>Sum </td>";    
echo "<td valign='top'><b>$" . nl2br( $result_amount_sum['amount_sum'])  . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
//echo "<td valign='top'><b>$" . nl2br( array_sum($pending)) . "</td>"; 
//echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";   
//echo "<td valign='top'></td>";

 
echo "</tr>";

echo "</table>";

echo "<a href='#' class=button>New Row</a>"; 
include('include/footer.php');?>