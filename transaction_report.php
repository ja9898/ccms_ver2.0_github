<? 
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
	     
		if($_SESSION['userType']==8)
		{
			$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.teacherID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.`status` 

			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
			order by paydayz DESC";
		}
		
		//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
		else if($_SESSION['userType']==15)
		{
			$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
			campus_schedule.id,
			campus_schedule.duedate as due_date,
			campus_schedule.paydate as pay_date,
			day(campus_schedule.duedate) AS dayz,
			month(campus_schedule.duedate) AS month,
			year(campus_schedule.duedate) AS year,
			day(campus_schedule.paydate) AS paydayz,
			campus_schedule.dues as amount,
			campus_schedule.studentID,
			campus_schedule.teacherID,
			campus_schedule.courseID,
			campus_schedule.classType,
			campus_schedule.startTime,
			campus_schedule.`status` 

			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
			campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
			order by paydayz DESC";
		}
		
		else
		{
			//////SEARCH TEACHER TEAMLEAD WISE//////
			if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
			{
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.teacherID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and 
				capmus_users.id=campus_schedule.teacherID and 
				campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate."
				order by paydayz DESC";
			}
			//////FOLLOWING SHOWS ALL TEAMLEADS Total payments//////
			else
			{
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
				campus_schedule.id,
				campus_schedule.duedate as due_date,
				campus_schedule.paydate as pay_date,
				day(campus_schedule.duedate) AS dayz,
				month(campus_schedule.duedate) AS month,
				year(campus_schedule.duedate) AS year,
				day(campus_schedule.paydate) AS paydayz,
				campus_schedule.dues as amount,
				campus_schedule.studentID,
				campus_schedule.teacherID,
				campus_schedule.courseID,
				campus_schedule.classType,
				campus_schedule.startTime,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
				campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate."
				order by paydayz DESC";
			}
		}
 
}
	/*elseif(!empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	      $sql=" Select campus_schedule.id,
		  campus_schedule.duedate as due_date,
		  campus_schedule.paydate as pay_date,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
day(campus_schedule.paydate) AS paydayz,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.courseID,
campus_schedule.classType,
campus_schedule.startTime,

campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and day(campus_schedule.paydate) not BETWEEN ".$fromDate." AND ".$toDate."
 order by paydayz DESC";
	}else
	if(!empty($_POST['toDate'])){
		
		  $sql=" Select campus_schedule.id,
		  campus_schedule.duedate as due_date,
		  campus_schedule.paydate as pay_date,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
day(campus_schedule.paydate) AS paydayz,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.courseID,
campus_schedule.classType,
campus_schedule.startTime,

campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and day(campus_schedule.paydate) =  ".$fromDate."
 order by paydayz DESC"; 

		}
	
}*/
}
else
{
	if($_SESSION['userType']==8)
	{
		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,
		campus_schedule.id,
		campus_schedule.duedate as due_date,
		campus_schedule.paydate as pay_date,
		day(campus_schedule.duedate) AS dayz,
		month(campus_schedule.duedate) AS month,
		year(campus_schedule.duedate) AS year,
		day(campus_schedule.paydate) AS paydayz,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.teacherID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.`status` 

		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
		campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')." 
		order by paydayz DESC";
	}
	
	//NEWLY ADDED - MAIN TEACHER TEAMLEAD	//06-11-2013
	else if($_SESSION['userType']==15)
	{
		$sql="SELECT capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_schedule.id,
		campus_schedule.duedate as due_date,
		campus_schedule.paydate as pay_date,
		day(campus_schedule.duedate) AS dayz,
		month(campus_schedule.duedate) AS month,
		year(campus_schedule.duedate) AS year,
		day(campus_schedule.paydate) AS paydayz,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.teacherID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,
		campus_schedule.`status` 

		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
		campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')." 
		order by paydayz DESC";
	}

	else
	{
		$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
		campus_schedule.id,
		campus_schedule.duedate as due_date,
		campus_schedule.paydate as pay_date,
		day(campus_schedule.duedate) AS dayz,
		month(campus_schedule.duedate) AS month,
		year(campus_schedule.duedate) AS year,
		day(campus_schedule.paydate) AS paydayz,
		campus_schedule.dues as amount,
		campus_schedule.studentID,
		campus_schedule.teacherID,
		campus_schedule.courseID,
		campus_schedule.classType,
		campus_schedule.startTime,


		campus_schedule.`status` 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 ";
		//////SEARCH TEACHER TEAMLEAD WISE ONLY//////
		if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
		{
			$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
		}
		$sql.=" and campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')."
		order by paydayz DESC";
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
<?php if($_SESSION['userType']==1) { getTeacherFilterLead(); } ?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter">
</form>
<br /><br />
</div>

<? 
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>MAIN TL Name</th>";
echo "<th class='specalt'>TL Name</th>";
echo "<th class='specalt'>Country</th>";
echo "<th class='specalt'>Cousre</th>";
echo "<th class='specalt'>Total Amount</th>"; 
echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Pending Amount</th>"; 
echo "<th class='specalt'>Signup Amount</th>";
echo "<th class='specalt'>Discount</th>";

echo "<th class='specalt'>SignUp Date</th>";
echo "<th class='specalt'>Paying Date</th>";
echo "<th class='specalt'>Received Date</th>"; 
echo "<th class='specalt'>Current Month Due date</th>"; 




echo "<th class='specalt'>Actions</th>";

echo "</tr>";
$amount=array();
$recieved=array();
$pending =array();
$signups =array();
$discount =array();


$result = mysql_query($sql) or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


$countresult=$row['amount'];

 $countmonthsql="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".date('n')."'  and studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
$countmonthesult=mysql_query($countmonthsql);
$countmonthesult=mysql_fetch_assoc($countmonthesult);

$amount[$row['id']]=$countresult;
$recieved[$row['id']]=$countmonthesult['amounttran'];
$pending[$row['id']]=$countresult-$countmonthesult['amounttran']-$countmonthesult['discount_tran'];
$discount[$row['id']] = $countmonthesult['discount_tran'];


/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
$maxdate_rec_result=mysql_query($maxdate_rec);
$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);


/////////////GETTING COUNTRY//////////////// NEWLY ADDED

$query_country="SELECT countryID FROM campus_students where id=".$row['studentID']." "; 
$query_country_result=mysql_query($query_country);
$query_country_result=mysql_fetch_assoc($query_country_result);



if($row['month']==date('n') && $row['year']==date('Y'))
{
$signups[$row['id']]=$countresult;

}
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['paydayz'])  . "</td>";
echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
echo "<td valign='top'>" . showUser( nl2br( $row['main_LeadId'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
echo "<td valign='top'>" . showCourse(nl2br( $row['courseID'])). "</td>"; 

  
echo "<td valign='top'>$" . nl2br( $amount[$row['id']])  . "</td>";  
echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $pending[$row['id']]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";
echo "<td valign='top'>$" . nl2br( $discount[$row['id']]) . "</td>";


echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row['due_date']) . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row['pay_date']) . "</td>";
echo "<td valign='top'>" . nl2br( $maxdate_rec_result['date_rec_cam_tran']). "</td>"; 
echo "<td valign='top'>" . nl2br( $maxdate_rec_result['maxdate_rec']). "</td>"; 


echo "<td ><a class=button href=class_details.php?id={$row['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&due_date={$row['due_date']}&pay_date={$row['pay_date']}&startTime={$row['startTime']}>Pay</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class=button href=transaction_new_next_month.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&due_date={$row['due_date']}&pay_date={$row['pay_date']}&startTime={$row['startTime']}>Pay Next Month</a></td> "; 
 
echo "</tr>"; 
}


echo "<tr>";  

 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
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

<form action='' method='POST'> 
<div id="label"></div><div id="field"><input type='text' id='recurring_amount' name='recurring_amount' value='<?= stripslashes(nl2br( array_sum($amount))) ?>' /> </div>

<!--WORKING FINE, HAD TO BE ADDED LATER-->
<div id="label"></div><div id="field"><input name="sender" type="button" id="sender" value="Send CCMS Recurring Amount"  /> </div> <!-- onclick="javascript: send_recurring_email()" -->

<div id="ajaxdiv_amount"></div>
<input type='hidden' value='1' name='submitted' /></div> 
</form>