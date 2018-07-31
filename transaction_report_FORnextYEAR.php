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
			campus_schedule.comments_reminder,
			campus_schedule.date_reminder,
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
			campus_schedule.comments_reminder,
			campus_schedule.date_reminder,
			campus_schedule.`status` 

			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 ";
			//////SEARCH TEACHER TEAMLEAD WISE ONLY//////
			if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
			{
				$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
			}
			$sql.=" and campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')." 
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
				campus_schedule.comments_reminder,
				campus_schedule.date_reminder,

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
				$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
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
				campus_schedule.comments_reminder,
				campus_schedule.date_reminder,

				campus_schedule.`status` 
				FROM capmus_users 
				INNER JOIN campus_schedule 
				ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0"; 
				//////SEARCH TEACHER TEAMLEAD WISE ONLY//////
				if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
				{
					$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
				}
				//////SEARCH MAIN TEACHER TEAMLEAD WISE ONLY//////
				if(isset($_POST['submit']) && $_POST['search-teacher-main']!=0)
				{
					$sql.=" and capmus_users.main_LeadId='".$_POST['search-teacher-main']."' ";
				}
				$sql.=" and campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate."
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
		campus_schedule.comments_reminder,
		campus_schedule.date_reminder,		
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
		campus_schedule.comments_reminder,
		campus_schedule.date_reminder,
		campus_schedule.`status` 

		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.main_LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
		campus_schedule.status=1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')." 
		order by paydayz DESC";
	}

	else
	{
		if(isset($_POST['submit']))
		{
			$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,capmus_users.main_LeadId,
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
			campus_schedule.comments_reminder,
			campus_schedule.date_reminder,
			


			campus_schedule.`status` 
			FROM capmus_users 
			INNER JOIN campus_schedule 
			ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 ";
			//////SEARCH TEACHER TEAMLEAD WISE ONLY//////
			if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
			{
				$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
			}
			//////SEARCH MAIN TEACHER TEAMLEAD WISE ONLY//////
			if(isset($_POST['submit']) && $_POST['search-teacher-main']!=0)
			{
				$sql.=" and capmus_users.main_LeadId='".$_POST['search-teacher-main']."' ";
			}
			$sql.=" and campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  ".date('d')."
			order by paydayz DESC";
			
			//capmus_users.main_LeadId='".$_SESSION['userId']."'
		}
	}

}

?>

<style>

/* The Modal (background) */
.modal {
    display: none; /* Hidden by default */
    position: fixed; /* Stay in place */
    z-index: 1; /* Sit on top */
    padding-top: 100px; /* Location of the box */
    left: 0;
    top: 0;
    width: 100%; /* Full width */
    height: 100%; /* Full height */
    overflow: auto; /* Enable scroll if needed */
    background-color: rgb(0,0,0); /* Fallback color */
    background-color: rgba(0,0,0,0.4); /* Black w/ opacity */
}

/* Modal Content */
.modal-content {
    position: relative;
    background-color: #fefefe;
    margin: auto;
    padding: 0;
    border: 1px solid #888;
    width: 40%;
    box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2),0 6px 20px 0 rgba(0,0,0,0.19);
    -webkit-animation-name: animatetop;
    -webkit-animation-duration: 0.4s;
    animation-name: animatetop;
    animation-duration: 0.4s
}

/* Add Animation */
@-webkit-keyframes animatetop {
    from {top:-300px; opacity:0} 
    to {top:0; opacity:1}
}

@keyframes animatetop {
    from {top:-300px; opacity:0}
    to {top:0; opacity:1}
}

/* The Close Button */
.close {
    color: white;
    float: right;
    font-size: 28px;
    font-weight: bold;
}

.close:hover,
.close:focus {
    color: #000;
    text-decoration: none;
    cursor: pointer;
}

.modal-header {
    padding: 2px 16px;
    /* background-color: #5cb85c; */
	background-color: #2485d8;
    color: white;
}

.modal-body {padding: 50px 16px;}

.modal-footer {
    padding: 2px 16px;
    /* background-color: #5cb85c; */
	background-color: #2485d8;
    color: white;
}


/****** TOOLTIP ******/
.tooltip {
    position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;
	color: #0a5dc3;
	font-weight: bold;
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 120px;
    background-color: #555;
    color: #fff;
    text-align: center;
    border-radius: 6px;
    padding: 5px 0;
    position: absolute;
    z-index: 1;
    bottom: 125%;
    left: 50%;
    margin-left: -60px;
    opacity: 0;
    transition: opacity 0.3s;
}

.tooltip .tooltiptext::after {
    content: "";
    position: absolute;
    top: 100%;
    left: 50%;
    margin-left: -5px;
    border-width: 5px;
    border-style: solid;
    border-color: #555 transparent transparent transparent;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
    opacity: 1;
}
</style>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php if($_SESSION['userType']==1 || $_SESSION['userType']==2 || $_SESSION['userType']==15) 
{ 
getTeacherFilterLead(); 
getTeacherFilterLead_main();
} ?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter">
</form>
<br /><br />
</div>

<? 
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'>Reminder</th>"; 
echo "<th class='specalt' colspan=2>Pay BTN</th>";
echo "<th class='specalt'>Sch ID</th>"; 
echo "<th class='specalt'>Reminder</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>Teacher Name</th>";
echo "<th class='specalt'>MAIN TL Name</th>";
echo "<th class='specalt'>TL Name</th>";
echo "<th class='specalt'>Country</th>";
echo "<th class='specalt'>Cousre</th>";
echo "<th class='specalt'>Total Amount-USD</th>";
echo "<th class='specalt'>Total Amount-CAD</th>"; 
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
//USD AMOUNT ARRAY
$usd_convert_amount=array();


$result = mysql_query($sql) or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


$countresult=$row['amount'];

 $countmonthsql="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".date('n')."' and year(dateRecieved)='".date('Y')."' and studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
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
echo "<td valign='top'>" . nl2br( $row['paydayz']) . "</td>";

//td for the modal
echo "<td valign='top'>"?> 
<button id="myBtn" onclick='modal_window_box(<?php echo $row['id'];  ?>)' class='button' style='background-color:skyblue'>Reminder</button>
<? "</td>";

echo "<td ><a class=button href=transaction_paymentdue_month_new.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&due_date={$row['due_date']}&pay_date={$row['pay_date']}&startTime={$row['startTime']}>Pay Old Due</a>&nbsp;&nbsp;</td> ";
echo "<td ><a class=button href=transaction_new.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&due_date={$row['due_date']}&pay_date={$row['pay_date']}&startTime={$row['startTime']}>Pay</a></td>";
echo "<td valign='top'>" . nl2br( $row['id'])  . "</td>";


if($row['comments_reminder']){
	echo "<td valign='top' id='idReminder_".$row['id']."'><div class='tooltip' align='center'>".date($row['date_reminder'])." <img src='images/info-512.png' width=20px height=20px /><span class='tooltiptext'>" . $row['comments_reminder'] ."<br> @ <b>" .$row['date_reminder'] ."</b></span>  </td>";
}else{
	echo "<td valign='top' id='idReminder_".$row['id']."'>&nbsp</td>";
}


echo "<td valign='top'>" .  "<a href=transaction_paymentdue_month_per_student_report.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row['main_LeadId'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
echo "<td valign='top'>" . showCourse(nl2br( $row['courseID'])). "</td>"; 

//Get 1 cad to usd rate from db
$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE date ='".$row['date_rec_cam_tran']."' ";
$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
if($row_1cad_to_dollar_rate_USDval['1_cad_to_usd']=='')
{
	//Get 1 cad to usd rate from db
	$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
	$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
	$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
}
	
echo "<td valign='top' style='color:green; font-weight:bold'>$" . round($usd_convert_amount[$row['id']] =  $amount[$row['id']]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
echo "<td valign='top' style='color:red; font-weight:bold'>$" . nl2br( $amount[$row['id']])  . "</td>";  
echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $pending[$row['id']]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";
echo "<td valign='top'>$" . nl2br( $discount[$row['id']]) . "</td>";


echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row['due_date']) . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row['pay_date']) . "</td>";
echo "<td valign='top'>" . nl2br( $maxdate_rec_result['date_rec_cam_tran']). "</td>"; 
echo "<td valign='top'>" . nl2br( $maxdate_rec_result['maxdate_rec']). "</td>"; 


echo "<td ><a class=button href=class_details.php?id={$row['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&due_date={$row['due_date']}&pay_date={$row['pay_date']}&startTime={$row['startTime']}>Pay</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class=button href=transaction_new_next_month.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&due_date={$row['due_date']}&pay_date={$row['pay_date']}&startTime={$row['startTime']}>Pay Next Month</a>&nbsp;&nbsp;&nbsp;&nbsp;<a class=button href=transaction_new_next_next_month.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}&teacherID={$row['teacherID']}&due_date={$row['due_date']}&pay_date={$row['pay_date']}&startTime={$row['startTime']}>Pay Next Next Month</a></td> "; 
 
echo "</tr>"; 
}


echo "<tr>";  

 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'>Sum </td>";  
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . round(nl2br( array_sum($usd_convert_amount)))  . "</td>";
echo "<td valign='top' style='color:red; font-weight:bold'><b>$" . nl2br( array_sum($amount))  . "</td>";

echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($pending)) . "</td>"; 
echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";
echo "<td valign='top'><b>$" . nl2br( array_sum($discount)) . "</td>";   
echo "<td valign='top'></td>";

 
echo "</tr>";

echo "</table>";
 
echo "<a href=transaction_new.php class=button>New Row</a>"; 
?>
<!-- The Modal - Remember modal will be called only once and the Reminder/Open Modal button will be
in the loop  -->
<div id="myModal" class="modal">

  <!-- Modal content -->
  <div class="modal-content">
    <div class="modal-header">
      <span class="close" id="close">&times;</span>
      <h2>Reminder Comments</h2>
    </div>

    <div class="modal-body">
      <p>Comments:<br>
	  <textarea id="comments_reminder" name="comments_reminder" rows="4" cols="30"></textarea><br>
	  </p>
      <p>Date:<br>
	  <input id="date_reminder" name="date_reminder" type="date"/><br>
	  <input id="rid" name="rid" type="hidden"/><br>
	  </p>
	  <div align='right'><button name="edit" id="btnEdit" class="edit_data" >Edit</button></div>
    </div>

    <div class="modal-footer">
      <h3></h3>
    </div>
  </div>

</div>
<?php
include('include/footer.php');?>

<form action='' method='POST'> 
<div id="label"></div><div id="field"><input type='text' id='recurring_amount' name='recurring_amount' value='<?= stripslashes(nl2br( array_sum($amount))) ?>' /> </div>

<!--WORKING FINE, HAD TO BE ADDED LATER-->
<div id="label"></div><div id="field"><input name="sender" type="button" id="sender" value="Send CCMS Recurring Amount"  /> </div> <!-- onclick="javascript: send_recurring_email()" -->

<div id="ajaxdiv_amount"></div>
<input type='hidden' value='1' name='submitted' /></div> 
</form>


<script>

	// Get the modal
	var modal = document.getElementById('myModal');

	// Get the button that opens the modal
	var btn = document.getElementById("myBtn");

	// Get the <span> element that closes the modal
	var span = document.getElementsByClassName("close")[0];
	var span = document.getElementById("close");

	// When the user clicks on <span> (x), close the modal
	span.onclick = function() {
		modal.style.display = "none";
	}

	// When the user clicks anywhere outside of the modal, close it
	window.onclick = function(event) {
		if (event.target == modal) {
			modal.style.display = "none";
		}
	}


	function modal_window_box(id){
		if(id!=""){
			document.getElementById("rid").value=id;
			modal.style.display = "block";
		}
	}



 $(document).ready(function(){ 
      $(document).on('click', '.edit_data', function(){  
			var id=document.getElementById("rid").value;
			var comments_reminder=document.getElementById("comments_reminder").value;
			var date_reminder=document.getElementById("date_reminder").value;
		
		   
			/* if(comments_reminder == '')  
           {  
                alert("comments are required");  
           }  
           if(date_reminder == '')  
           {  
                alert("Date is required");  
           }  
           */
			$.ajax({
			 url:'reminder_insert.php',
			 method: 'post',
			 data: {employee_id: id , comments_reminder: comments_reminder, date_reminder: date_reminder},
			 dataType: 'json',
			 success: function(response){
			  if(response == 1){
				document.getElementById("idReminder_"+id).innerHTML= comments_reminder +' @ '+ date_reminder;
				alert("Reminder set successfully.");
			  }else{
				alert("Error");
			  }
			  
			 }
		   });
		   /* } */
      });
 });

</script>