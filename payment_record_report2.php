<? 
include('config.php'); 
include('include/header.php');
echo "<label style='color:red; font-weight:bold'>NOTE: Proper results will be shown after 28th June 2013</label>";
if(isset($_POST['submit']))
{
	
	$fromDate=date('d',strtotime($_POST['fromDate']));
	
	$fromMonth=date('n',$_POST['fromDate']);
	//$toMonth=date('n',$_POST['toDate']);
	$toDate=date('d',strtotime($_POST['toDate']));
	if(!empty($_POST['toDate']) || !empty($_POST['toDate2'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	     
		 
		 /* $sql=" Select campus_schedule.id,
		  campus_schedule.duedate as due_date,
day(campus_schedule.duedate) AS dayz,
month(campus_schedule.duedate) AS month,
campus_schedule.dues as amount,
campus_schedule.studentID,
campus_schedule.courseID,
campus_schedule.classType,

campus_schedule.`status`
FROM
campus_schedule
WHERE
campus_schedule.`status` =1 and std_status!=3 and day(campus_schedule.duedate) BETWEEN ".$fromDate." AND ".$toDate."
 order by dayz DESC";*/
 
 if($_SESSION['userId']==263)
	{
		echo "<div align='center' style='color:red; font-size:16px'>Contact CCMS Administrator </div>";
	}
 /*else
 {
 	$sql=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime 
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.courseID=campus_transaction.courseID and campus_schedule.classType=campus_transaction.classType and campus_schedule.startTime=campus_transaction.startTime 
	and campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!=''";
 }*/
 
 else
 {
 	$sql=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array 
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1 and campus_schedule.std_status=2 ";
	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql.=" and campus_transaction.operator='".$_POST['search-teacher-id2']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-main']!=0)
	{
		$sql.=" and campus_transaction.operator='".$_POST['search-teacher-main']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' ";
	}
	if($_POST['fromDate2']!="" && $_POST['toDate2']!="")
	{
		$sql.=" and campus_transaction.dateRecieved BETWEEN '".prepareDate($_POST['fromDate2'])."' AND '".prepareDate($_POST['toDate2'])."' and campus_transaction.dateRecieved!='' ";
	}
 }
 
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

<br><br>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate2']),'fromDate2','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate2']),'toDate2','class=flexy_datepicker_input');?>&nbsp;&nbsp;

<?php if($_SESSION['userType']==1) { getTeacherFilterLead_main(); getTeacherFilterLead(); } ?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
<br /><br />
</div>

<? 
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>ID</th>"; 
echo "<th class='specalt' style='color:blue'>Current Month DUE DATE</th>"; 
echo "<th class='specalt'>Received Date</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Signup Amount</th>";
echo "<th class='specalt'>Transaction ID</th>";
echo "<th class='specalt'>Method</th>";
echo "<th class='specalt'>TeamLead/Operator</th>"; 
echo "<th class='specalt'>Comments</th>"; 
echo "<th class='specalt'>Teacher</th>"; 




//echo "<th class='specalt'>Actions</th>";

echo "</tr>";
$amount=array();
$recieved=array();
$recieved_with_tran_id=array();
$pending =array();
$signups =array();



//Applying following FOR LOOP to HARDCODE the COLUMN HEADINGS in .CSV file
/*$prr_array_var[$c] = array(); // array of cells for column $c
for($r=0; $r<6; $r++)
	{
		if($r==0)
		{
		$prr_array_var[$c][$r] = "RECEIVED DATE";
		}
		if($r==1)
		{
        $prr_array_var[$c][$r] = "STUDENT NAME";
		}
		if($r==2)
		{
		$prr_array_var[$c][$r] = "RECEIVED AMOUNT";
		}
		if($r==3)
		{
		$prr_array_var[$c][$r] = "SIGNUP AMOUNT";
		}
		if($r==4)
		{
		$prr_array_var[$c][$r] = "TRANSACTION ID";
		}
		if($r==5)
		{
		$prr_array_var[$c][$r] = "TEAMLEAD/OPERATOR";
		}
	}

$c=1;	//incrementing the value of this variable so we can now generate ROWS dynamically
*/

$result = mysql_query($sql) or trigger_error(mysql_error()); 

/*$row_count=mysql_num_rows($result);	//Required for number of rows counted/effected/returned*/

while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


//echo $date=date('d', strtotime( nl2br(prepareDate($_POST['fromDate']))));
$signup_check=1;



$countresult=$row['amount'];

//$countmonthsql="select amount as amounttran,date,operator FROM campus_transaction where date BETWEEN '".nl2br(prepareDate($_POST['fromDate']))."' AND '".nl2br(prepareDate($_POST['toDate']))."' and studentID=".$row['studentID']." and courseID=".$row['courseID']." and classType=".$row['classType']." and startTime='".$row['startTime']."'"; 
if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$countmonthsql="select amount as amounttran_not_main,date,operator,id FROM campus_transaction where date BETWEEN '".nl2br(prepareDate($_POST['fromDate']))."' AND '".nl2br(prepareDate($_POST['toDate']))."' and studentID=".$row['studentID']." and schedule_id=".$row['id']." "; 
	}
if($_POST['fromDate2']!="" && $_POST['toDate2']!="")
	{
		$countmonthsql="select amount as amounttran_not_main,dateRecieved,operator,id FROM campus_transaction where dateRecieved BETWEEN '".nl2br(prepareDate($_POST['fromDate2']))."' AND '".nl2br(prepareDate($_POST['toDate2']))."' and studentID=".$row['studentID']." and schedule_id=".$row['id']." "; 
	}
//echo $countmonthsql."<br>";
$countmonthesult=mysql_query($countmonthsql);
$countmonthesult=mysql_fetch_assoc($countmonthesult);

$amount[$row['id']]=$countresult;

/*echo $row['due_date']."<br>";
echo $countmonthesult['date']."<br>";
echo nl2br(prepareDate($_POST['fromDate']))."<br>";
echo nl2br(prepareDate($_POST['toDate']))."<br>";*/

if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
if(($row['due_date']>=nl2br(prepareDate($_POST['fromDate'])) && $row['due_date']<=nl2br(prepareDate($_POST['toDate']))) && $row['due_date']==$countmonthesult['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult))
{
$signups[$row['id']]=$row['amount'];
$signup_check=0;
}
else
{
//$signup_check==1;
}



if(!empty($countresult) && ($countmonthesult['date']>=nl2br(prepareDate($_POST['fromDate'])) && $countmonthesult['date']<=nl2br(prepareDate($_POST['toDate']))) && $signup_check==1)
{
$recieved[$row['id']]=$row['amounttran'];//oldly used
$recieved_with_tran_id[$row['tran_id']]=$row['amounttran'];
//$recieved[$row['id']]=0;//newly used
//$signup_check==0;
}
}


if($_POST['fromDate2']!="" && $_POST['toDate2']!="")
	{
if(($row['due_date']>=nl2br(prepareDate($_POST['fromDate2'])) && $row['due_date']<=nl2br(prepareDate($_POST['toDate2']))) && $row['due_date']==$countmonthesult['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult))
{
$signups[$row['id']]=$row['amount'];
$signup_check=0;
}
else
{
//$signup_check==1;
}



if(!empty($countresult) && ($countmonthesult['dateRecieved']>=nl2br(prepareDate($_POST['fromDate2'])) && $countmonthesult['dateRecieved']<=nl2br(prepareDate($_POST['toDate2']))) && $signup_check==1)
{
$recieved[$row['id']]=$row['amounttran'];//oldly used
$recieved_with_tran_id[$row['tran_id']]=$row['amounttran'];
//$recieved[$row['id']]=0;//newly used
//$signup_check==0;
}
}


echo "<tr>";  
//echo "<td valign='top'>" . nl2br( $row['dayz'])  . "</td>";
echo "<td valign='top'>" . nl2br( $row['tran_id']). "</td>"; 
echo "<td valign='top' style='color:blue; font-weight:bold'>" . nl2br( $row['maxdate_rec']). "</td>"; 
echo "<td valign='top'>" . nl2br( $row['date_rec_cam_tran']). "</td>"; 
echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  

  
//echo "<td valign='top'>$" . nl2br( $amount[$row['id']])  . "</td>";  

//echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";
//echo "<td valign='top'>$" . nl2br( $pending[$row['id']]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";

echo "<td valign='top'>" .  nl2br( $row['transactionID']) . "</td>";
echo "<td valign='top'>" .  getData(nl2br( $row['method_array']),'paymentMode') . "</td>";
echo "<td valign='top'>" . 	showUser(nl2br( $row['tran_op'])). "</td>"; 
echo "<td valign='top'>" . 	nl2br( $row['comments']). "</td>"; 
echo "<td valign='top'>" . 	showUser(nl2br( $row['teacherID'])). "</td>"; 



//echo "<td ><a class=button href=class_details.php?id={$row['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}>Pay</a>&nbsp;&nbsp;</td> "; 
 
echo "</tr>"; 



// $prr_array_var = array(); // array of columns
//for($c=0; $c<$row_count; $c++){			//This OUTER LOOP has been commented because if main WHILE LOOP of query runs 1 time, it runs 
											//the same number if times the mysql_num_rows() has reyurned th number of rows effected,
											//SO using only inner loop to FILL THE 2D ARRAY
    
	
	// The following FOR LOOP is the remaining part for filling the $a 2D array dynamically with data
    /*for($r=0; $r<6; $r++)
	{
		if($r==0)
		{
		$prr_array_var[$c][$r] = nl2br( $maxdate_rec_result['date_rec_cam_tran']);
		}
		if($r==1)
		{
        $prr_array_var[$c][$r] = showStudents(nl2br( $row['studentID']));
		}
		if($r==2)
		{
		$prr_array_var[$c][$r] = nl2br( $recieved[$row['id']]);
		}
		if($r==3)
		{
		$prr_array_var[$c][$r] = nl2br( $signups[$row['id']]);
		}
		if($r==4)
		{
		$prr_array_var[$c][$r] = nl2br( $row['transactionID']);
		}
		if($r==5)
		{
		$prr_array_var[$c][$r] = showUser(nl2br( $countmonthesult['operator']));
		}
	}
//}

$c=$c+1;	//Same $c variable but in a LOOPING fashion as it is in the WHILE LOOP
*/
}


echo "<tr>";  
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum </td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";   
echo "<td valign='top'></td>"; 
echo "</tr>";

if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227 || $_SESSION['userId']==1 || $_SESSION['userId']==52)
{
	echo "<tr>";  
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'>Sum Actual</td>";  
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($recieved_with_tran_id)) . "</td>";  
	echo "<td valign='top'></td>"; 
	echo "</tr>";
}

echo "</table>";
 
/*$row_count=$row_count+1;	//Adding 1 in the result of mysql_num_rows to put the SUM of RECEIVED and SIGNUP amounts in the last row of 
							//2D array
for($r=0; $r<6; $r++)
	{
		if($r==0)
		{
		$prr_array_var[$c][$r] = "";
		}
		if($r==1)
		{
        $prr_array_var[$c][$r] = "Sum";
		}
		if($r==2)
		{
		$prr_array_var[$c][$r] = nl2br( array_sum($recieved));
		}
		if($r==3)
		{
		$prr_array_var[$c][$r] = nl2br( array_sum($signups));
		}
		if($r==4)
		{
		$prr_array_var[$c][$r] = "";
		}
		if($r==5)
		{
		$prr_array_var[$c][$r] = "";
		}
	}



$_SESSION['prr_array'] = $prr_array_var;
echo "<a href=payment_record_report_csv_gen.php class=button>CSV</a>"*/;

include('include/footer.php');?>

<!--<form action='' method='POST'>--> 
<!--<div id="label"></div><div id="field"><input type='text' id='recurring_amount' name='recurring_amount' value='<?//= stripslashes(nl2br( array_sum($amount))) ?>' /> </div>-->

<!--WORKING FINE, HAD TO BE ADDED LATER-->
<!--<div id="label"></div><div id="field"><input name="sender" type="button" id="sender" value="Send CCMS Recurring Amount" onclick="javascript: send_recurring_email()" /> </div>-->

<!--<div id="ajaxdiv_amount"></div>-->
<!--<input type='hidden' value='1' name='submitted' /></div> -->
<!--</form>-->