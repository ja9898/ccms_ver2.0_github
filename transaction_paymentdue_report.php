<? 
//http://www.midwesternmac.com/blogs/jeff-geerling/php-calculating-monthly

//http://www.phpbook.net/how-to-calculate-the-difference-between-two-dates-in-php.html

//how to calculate months between two dates in php
include('config.php'); 
include('include/header.php');

if(isset($_POST['submit']))
{
	
	$fromDate=date('d',strtotime($_POST['fromDate']));
	
	$fromMonth=date('n',$_POST['fromDate']);
	//$toMonth=date('n',$_POST['toDate']);
	$toDate=date('d',strtotime($_POST['toDate']));
	if($fromDate <= $toDate && !empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	     
		 
		  $sql=" Select campus_schedule.id,
		  campus_schedule.duedate as due_date,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.courseID,
campus_schedule.classType,
campus_schedule.startTime,
campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and std_status=2 and day(campus_schedule.duedate) BETWEEN ".$fromDate." AND ".$toDate."
 order by dayz DESC";
 
}
	elseif(!empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	      $sql=" Select campus_schedule.id,
		  campus_schedule.duedate as due_date,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.courseID,
campus_schedule.classType,
campus_schedule.startTime,
campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and std_status=2 and day(campus_schedule.duedate) not BETWEEN ".$fromDate." AND ".$toDate."
 order by dayz DESC";
	}else
	if(!empty($_POST['toDate'])){
		
		  $sql=" Select campus_schedule.id,
		  campus_schedule.duedate as due_date,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.courseID,
campus_schedule.classType,
campus_schedule.startTime,
campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and std_status=2 and day(campus_schedule.duedate) =  ".$fromDate."
 order by dayz DESC"; 

		}
	
}
else
{
 /*$sql=" Select campus_schedule.id,
 campus_schedule.duedate,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.courseID,
campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and day(campus_schedule.duedate) <=  ".date('d')."
 order by dayz DESC";*/
 
 
 
$sql=" Select campus_schedule.id,
campus_schedule.duedate as due_date,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.courseID,
campus_schedule.classType,
campus_schedule.startTime,
campus_schedule.`status`,
campus_schedule.startDate,
campus_schedule.endDate,
campus_schedule.dues,
campus_schedule.discount 

FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and std_status=2 and day(campus_schedule.duedate) <=  ".date('d')." 
order by dayz DESC";
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
/*echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Total Amount</th>"; 
echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Pending Amount</th>"; 

echo "<th class='specalt'>Signup Amount</th>";
echo "<th class='specalt'>Received Date</th>"; 
echo "<th class='specalt'>Due Date</th>"; 
echo "<th class='specalt'>Course ID</th>"; 

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

$countmonthsql="select sum(amount) as amount, dateRecieved, courseID FROM campus_transaction where month(date)='".date('n')."' and studentID=".$row['studentID']." and courseID=".$row['id'].""; 
$countmonthesult=mysql_query($countmonthsql);
$countmonthesult=mysql_fetch_assoc($countmonthesult);

$amount[$row['id']]=$countresult;
$recieved[$row['id']]=$countmonthesult['amount'];
$pending[$row['id']]=$countresult-$countmonthesult['amount'];

if($row['month']==date('n'))
{
$signups[$row['id']]=$countresult;

}
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['dayz'])  . "</td>";
echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
  
echo "<td valign='top'>$" . nl2br( $amount[$row['id']])  . "</td>";  
echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $pending[$row['id']]) . "</td>";  
 

echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";
echo "<td valign='top'>" .  nl2br( $countmonthesult['dateRecieved']) . "</td>"; 
echo "<td valign='top'>" .  nl2br( $row['duedate']) . "</td>"; 
echo "<td valign='top'>" .  nl2br( $countmonthesult['courseID']) . "</td>"; 

echo "<td ><a class=button href=class_details.php?id={$row['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$row['studentID']}>Pay</a>&nbsp;&nbsp;</td> "; 
 
echo "</tr>"; 
}


echo "<tr>";  
 echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum </td>";  
  
echo "<td valign='top'><b>$" . nl2br( array_sum($amount))  . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($pending)) . "</td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";   
echo "<td valign='top'></td>";

 
echo "</tr>";

echo "</table>"; 
echo "<a href=transaction_new.php class=button>New Row</a>";
*/











echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Country</th>";
echo "<th class='specalt'>Course</th>"; 
echo "<th class='specalt'>Total Amount</th>"; 
echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Pending Amount</th>"; 
echo "<th class='specalt'>Signup Amount</th>";

echo "<th class='specalt'>Discount</th>";

echo "<th class='specalt'>Due Date</th>";
echo "<th class='specalt'>Received Date</th>"; 
//echo "<th class='specalt'>Due Date</th>"; 
//echo "<th class='specalt'>S</th>"; 
//echo "<th class='specalt'>E</th>"; 
//echo "<th class='specalt'>Mon</th>";
//echo "<th class='specalt'>TtL Amt</th>";
 

echo "<th class='specalt'>Actions</th>";

echo "</tr>";
$amount=array();
$recieved=array();
$pending =array();
$signups =array();
///////////////////////////// NEWLY ADDED
$discount = array();
/////////////////////////////


$result = mysql_query($sql) or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


$countresult=$row['amount'];

/////////////CALCULATING DISCOUNT//////////////// NEWLY ADDED
$countresult_discount=$row['discount'];
/////////////////////////////

$countmonthsql="SELECT amount as amounttran FROM campus_transaction where month(dateRecieved)='".date('n')."' and studentID=".$row['studentID']." and courseID=".$row['courseID'].""; 
$countmonthesult=mysql_query($countmonthsql);
$countmonthesult=mysql_fetch_array($countmonthesult);

$amount[$row['id']]=$countresult;
$recieved[$row['id']]=$countmonthesult['amounttran'];
$pending[$row['id']]=$countresult-$countmonthesult['amounttran'];

$discount[$row['id']]=$row['discount'];

/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec FROM campus_transaction where studentID=".$row['studentID']." and courseID=".$row['courseID']." "; 
$maxdate_rec_result=mysql_query($maxdate_rec);
$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);


/////////////GETTING COUNTRY//////////////// NEWLY ADDED

$query_country="SELECT countryID FROM campus_students where id=".$row['studentID']." "; 
$query_country_result=mysql_query($query_country);
$query_country_result=mysql_fetch_assoc($query_country_result);



//FOLLOWING NOT IN USE
/*$timestamp_start = strtotime(nl2br( $row['startDate']));

$timestamp_end = strtotime(nl2br( $row['endDate']));

$difference = abs($timestamp_end - $timestamp_start);
 $months = floor($difference/(60*60*24*30));*/
//echo 'Months '.$months."<br>";

//echo $months*$row['dues']."<br>";

//////////////////////////////////


if($row['month']==date('n'))
{
$signups[$row['id']]=$countresult;

}

echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['dayz'])  . "</td>";
echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
echo "<td valign='top'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
echo "<td valign='top'>" . showCourse(nl2br( $row['courseID'])). "</td>";
  
echo "<td valign='top'>$" . nl2br( $amount[$row['id']])  . "</td>";  
echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $pending[$row['id']]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";

echo "<td valign='top'>$" . nl2br( $discount[$row['id']]) . "</td>";  

echo "<td valign='top'>" .  nl2br( $row['due_date']) . "</td>";
echo "<td valign='top'>" . nl2br( $maxdate_rec_result['maxdate_rec']). "</td>"; 
//echo "<td valign='top'>" .  nl2br( $row['duedate']) . "</td>"; 
//echo "<td valign='top'>" .  nl2br( $countmonthesult['courseID']) . "</td>"; 
//echo "<td valign='top'>" .  nl2br( $row['startDate']) . "</td>"; 
//echo "<td valign='top'>" .  nl2br( $row['endDate']) . "</td>";
//echo "<td valign='top'>" .  $months . "</td>";
//echo "<td valign='top'>" .  $months*$row['dues'] . "</td>";

//echo "<td valign='top'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
 

echo "<td ><a class=button href=class_details.php?id={$row['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&due_date={$row['due_date']}&startTime={$row['startTime']}>Pay</a>&nbsp;&nbsp;</td> "; 
 
echo "</tr>"; 

}

echo "<tr>";  
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum </td>";  
  
echo "<td valign='top'><b>$" . nl2br( array_sum($amount))  . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($pending)) . "</td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";
echo "<td valign='top'><b>$" . nl2br( array_sum($discount)) . "</td>";   
echo "<td valign='top'></td>";

 
echo "</tr>";

echo "</table>"; 
echo "<a href=transaction_new.php class=button>New Row</a>";








 
include('include/footer.php');?>