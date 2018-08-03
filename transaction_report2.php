<? 
include('config.php'); 
include('include/header.php');

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
	
}
if(isset($_POST['submit']) && !empty($_POST['fromDate']) && !empty($_POST['toDate']))
{
	$sql="SELECT campus_schedule.id,
day(campus_schedule.duedate) AS dddayz,
month(campus_schedule.duedate) AS ddmonth,
year(campus_schedule.duedate) AS ddyear,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.`status`
FROM campus_schedule 
WHERE campus_schedule.std_status=2 and campus_schedule.`status` =1 and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."' 
order by dddayz DESC";
//campus_schedule.std_status!=5 and campus_schedule.std_status!=4 and campus_schedule.std_status!=3 and campus_schedule.std_status!=1
}
else
{
	  $sql="SELECT campus_schedule.id,
day(campus_schedule.duedate) AS dddayz,
month(campus_schedule.duedate) AS ddmonth,
year(campus_schedule.duedate) AS ddyear,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.`status`
FROM campus_schedule 
WHERE campus_schedule.std_status=2 and campus_schedule.`status` =1 
order by dddayz DESC";
//campus_schedule.std_status!=5 and campus_schedule.std_status!=4 and campus_schedule.std_status!=3 and campus_schedule.std_status!=1
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
echo "<th class='specalt'>Amount</th>";
echo "<th class='specalt'>Email</th>";


echo "<th class='specalt'>Day-Month-Year(DUE DATE)</th>"; 
//echo "<th class='specalt'>Day-Month-Year(DATE RECEIVED)</th>"; 
echo "<th class='specalt'>Day-Month-Year(DATE RECEIVED)-MAX</th>"; 
echo "<th class='specalt'>Payment Due</th>"; 
//echo "<th class='specalt'>Total Amount</th>"; 
//echo "<th class='specalt'>Recieved Amount</th>"; 
//echo "<th class='specalt'>Pending Amount</th>"; 
//echo "<th class='specalt'>Signup Amount</th>";
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

//QUERY FOR PAYMENT MAXIMUM DATE RECEIVED//
$countmonthsql_m="select sum(amount) as amount,
MAX(day(dateRecieved)) as drday_m,
MAX(month(dateRecieved)) as drmonth_m,
MAX(year(dateRecieved)) as dryear_m 
FROM campus_transaction where studentID=".$row['studentID']." and courseID=".$row['id']." GROUP BY studentID";
$result_m = mysql_query($countmonthsql_m);
$result_m = mysql_fetch_assoc($result_m);

//echo nl2br($result_m['maxdate']);

//QUERY FOR EMAIL//
$email_query="SELECT * FROM campus_students WHERE id=".$row['studentID']." and std_status=2";
$email_result=mysql_query($email_query);
$email_result=mysql_fetch_array($email_result);

//echo nl2br($email_result['email']);


$countmonthesult=mysql_query($countmonthsql);
$countmonthesult=mysql_fetch_assoc($countmonthesult);

$amount[$row['id']]=$countresult;
$recieved[$row['id']]=$countmonthesult['amount'];
$pending[$row['id']]=$countresult-$countmonthesult['amount'];

$mon_pay_left = paymentdue($tdd,$tdm,nl2br($row['dddayz']),nl2br($row['ddmonth']),nl2br($row['ddyear']),nl2br( $result_m['drday_m']),nl2br( $result_m['drmonth_m']),nl2br( $result_m['dryear_m']));

if($row['ddmonth']==date('n'))
{
$signups[$row['id']]=$countresult;

}
echo "<tr>";  
echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
echo "<td valign='top'>" . nl2br( $row['amount']) . "</a></td>";  
echo "<td valign='top'>" . nl2br( $email_result['email']) . "</a></td>";  

echo "<td valign='top'>" . nl2br( $row['dddayz'])." - ".nl2br( $row['ddmonth'])." - ".nl2br( $row['ddyear'])  . "</td>";
//echo "<td valign='top'>" . nl2br( $countmonthesult['drday'])." - ".nl2br( $countmonthesult['drmonth'])." - ".nl2br( $countmonthesult['dryear']). "</td>";
echo "<td valign='top'>" . nl2br( $result_m['drday_m'])." - ".nl2br( $result_m['drmonth_m'])." - ".nl2br( $result_m['dryear_m']). "</td>";

echo "<td valign='top'>" .$mon_pay_left. " month's payment left </td>";
//echo "<td valign='top'>$" . nl2br( $amount[$row['id']])  . "</td>";  
//echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";  
//echo "<td valign='top'>$" . nl2br( $pending[$row['id']]) . "</td>";  
//echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";
echo "<td ><a class=button href=class_details.php?id={$row['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$row['studentID']}>Pay</a>&nbsp;&nbsp;</td> ";
echo "</tr>"; 
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