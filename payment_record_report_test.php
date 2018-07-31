<? 
include('config.php'); 
include('include/header.php');

/*FUCNTION to Partially hide the email address*/
function hideEmail($email){
    $prefix = substr($email, 0, strrpos($email, '@'));
    $suffix = substr($email, strripos($email, '@'));
	$len_all = strlen($prefix);
    $len  = floor(strlen($prefix)/2);
    //return substr($prefix, 0, $len) . str_repeat('*', $len) . $suffix;
	return str_repeat('*', 4) . substr($prefix, 4, $len_all) . $suffix;
}
/*********************************************/

if($_SESSION['userId']!=2015)
{
echo "<label style='color:green; font-weight:bold'>**Signup and Recurring Transacted in SAME MONTH and SAME DATE will be shown in both SIGNUP and RECURRING columns but overall sum will be ACCURATE-Under Development**</label>";
echo "<label style='color:red; font-weight:bold'>NOTE: For Accurate OLD report, Please click on <a href='payment_record_report_test_old_report.php' target='_blank'>PRR Report OLD</a> Link</label>";
//>>>>>>>>>>>>>>>>>>>>>>>>> Added for accounts chk for PHYSICAL/BANK payment <<<<<<<<<<<<<<<<<<<<< NEWLY Added
if(isset($_POST['sender']))
{
	if(!empty($_POST['accounts_amount']) && isset($_POST['accounts_chk_box_id']))
	{
		
		$systemdate = systemDate();
		$accounts_chk_box_id = $_POST['accounts_chk_box_id'];echo "<br>";
		$accounts_amount = $_POST['accounts_amount'];echo "<br>";
		$accounts_comment = $_POST['accounts_comment'];echo "<br>";		
		//
		echo $received_date_manual = $_POST['received_date_manual'];echo "<br>";
			
			//Following has been added to update amount_usd_simple but also keeping the
			//CAD amoutn column maintained, so maintaining CAD column in following
			//And doing conversion from USD to CAD in following
			$date_rec_cam_tran_SUBTRACTED = strtotime($systemdate);
			$date_rec_cam_tran_SUBTRACTED = strtotime('-5 day', $date_rec_cam_tran_SUBTRACTED);
			$date_rec_cam_tran_SUBTRACTED = date('Y-m-d', $date_rec_cam_tran_SUBTRACTED);
			//$sql_USD_to_CAD="SELECT * FROM campus_currency WHERE date <='".$systemdate."' AND date >= '".$date_rec_cam_tran_SUBTRACTED."' ";
			$sql_USD_to_CAD="SELECT * FROM campus_currency ORDER BY id DESC LIMIT 0,1 ";
			$row_USD_to_CAD = mysql_fetch_array(mysql_query($sql_USD_to_CAD));
			$row_USD_to_CAD['1_cad_to_usd_new'];	
			$usd_to_cad_inverted=1/$row_USD_to_CAD['1_cad_to_usd_new'];	
			$accounts_amount_CAD = $accounts_amount*$usd_to_cad_inverted;	
			//////////////////////////////////////////////////////////////////////////
		if($_POST['campus']==1 && $_POST['schedule_id']!=0 && $_POST['schedule_id']!="")
		{
			//posting schedule ID
			$schedule_id = $_POST['schedule_id'];
			//Updating both SCH and TRAN table in case of signup
			$update_schedule_dates=mysql_query("UPDATE campus_schedule SET duedate='".$systemdate."' , paydate='".$systemdate."' WHERE id='".$schedule_id."'  ") or trigger_error(mysql_error());
			$update_accounts_amount = mysql_query("UPDATE campus_transaction SET accounts_chk = '1' , date='".$systemdate."' , dateRecieved='".$systemdate."' , amount_usd_simple='".$accounts_amount."' , accounts_comment = '".$accounts_comment."' , amount='".$accounts_amount_CAD."' WHERE id='".$accounts_chk_box_id."' ") or trigger_error(mysql_error());
			getMessages('edit','payment_record_report_test.php');
		}
		else
		{
			$update_accounts_amount = mysql_query("UPDATE campus_transaction SET accounts_chk = '1' , date='".prepareDate($received_date_manual)."' , amount_usd_simple='".$accounts_amount."' , accounts_comment = '".$accounts_comment."' , amount='".$accounts_amount_CAD."' WHERE id='".$accounts_chk_box_id."' ") or trigger_error(mysql_error());
			getMessages('edit','payment_record_report_test.php');
			//echo "<script>window.location.href = 'payment_record_report_test.php'</script>";
		}
	}
	else
	{
		getMessages('error');
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////

if(isset($_POST['submit']))
{
	
	$sql_USD_to_CAD="SELECT * FROM campus_currency WHERE id=433";
	$row_USD_to_CAD = mysql_fetch_array(mysql_query($sql_USD_to_CAD));
	$row_USD_to_CAD['1_cad_to_usd'];
	
	$fromDate=date('d',strtotime($_POST['fromDate']));
	
	$fromMonth=date('n',$_POST['fromDate']);
	$toDate=date('d',strtotime($_POST['toDate']));
	if(!empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));		
 //NO CONDITION ON REGULAR STUDENTS TRANSACTION, all include, regular, dead, freeze
 	$sql=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original,campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	campus_transaction.accounts_chk,campus_transaction.accounts_comment,
	campus_transaction.agent_comm,campus_transaction.teacher_comm,campus_transaction.cardSave_ccv_code,
	campus_transaction.amount_usd_simple,
	campus_transaction.datetime_now_accounts,campus_transaction.bank_payment_image_filepath,
	campus_transaction.discount_tran,campus_transaction.amount_original_deducted,
	campus_transaction.bankNameId 
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!='' ";
	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql.=" and campus_transaction.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-main']!=0)
	{
		$sql.=" and campus_transaction.main_LeadId='".$_POST['search-teacher-main']."' ";
	}
	if(isset($_POST['submit']) && $_POST['paymentMode']!=0)
	{
		$sql.=" and campus_transaction.method_array='".$_POST['paymentMode']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
	{
		$sql.=" and campus_transaction.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['recurr_signup']!=0)
	{
		if($_POST['recurr_signup']==2)
		$sql.=" and campus_transaction.campus=1 ";
		if($_POST['recurr_signup']==1)
		$sql.=" and campus_transaction.campus IS NULL ";
	}
	if(isset($_POST['submit']) && $_POST['tranID_match']!=0 && $_POST['tranID_match']!='')
	{
		$sql.=" and transactionID LIKE '%".$_POST['tranID_match']."%' 
		and transactionID IS NOT NULL";
	}
	if(isset($_POST['submit']) && $_POST['search-agent-id2']!=0)
	{
		$sql.=" and campus_transaction.operator='".$_POST['search-agent-id2']."' ";
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
<?php if($_SESSION['userType']==1 || $_SESSION['userType']==15 || $_SESSION['userType']==6 || $_SESSION['userType']==8 || $_SESSION['userType']==2 || $_SESSION['userType']==10 || $_SESSION['userType']==12) { getTeacherFilterLead_main(); getTeacherFilterLead(); getTeacherFilter(); echo getList('','paymentMode','paymentMode'); echo getList('','recurr_signup','recurr_signup'); } ?>
&nbsp;&nbsp;<input name='tranID_match' id='tranID_match' type='text' placeholder='Type TranID' />
<?php getAgentFilterLead(); ?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
<br /><br />
</div>

<? 
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
if($_SESSION['userId']==159)
{
	echo "<th class='specalt' colspan=2>Actions</th>";
}
/* if(($_SESSION['userId']==126 || $_SESSION['userId']==221) && $receivedDate_strtotime==$systemDate_strtotime)
{
	echo "<th class='specalt' colspan=2>Actions</th>";
} */
echo "<th class='specalt'>Account Comment</th>"; 
echo "<th class='specalt'>ID</th>"; 
echo "<th class='specalt' style='color:blue'>Current Month DUE DATE</th>"; 
echo "<th class='specalt'>Received Date</th>"; 
echo "<th class='specalt'>Student Name</th>";
//echo "<th class='specalt' style='color:green'>AMT USD SIMPLE-REC</th>";
//echo "<th class='specalt' style='color:green'>AMT USD SIMPLE-SIG</th>";
echo "<th class='specalt' style='color:green'>AMT USD SIMPLE-REC</th>";
echo "<th class='specalt' style='color:green'>AMT USD SIMPLE-SIG</th>";

/* echo "<th class='specalt' style='color:green'>Recieved Amount(USD-Convert)</th>"; 
echo "<th class='specalt' style='color:green'>Signup Amount(USD-Convert)</th>";  */
//echo "<th class='specalt'>Recieved Amount(CAD)</th>"; 
//echo "<th class='specalt'>Signup Amount(CAD)</th>";
//echo "<th class='specalt'>GBP Amount</th>";
echo "<th class='specalt'>Original Amount</th>";
if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userType']==6)
{
echo "<th class='specalt'>DISCOUNT</th>";
}
echo "<th class='specalt'>Amoutn Sch-CAD</th>";
echo "<th class='specalt'>Amoutn Sch-USD converted</th>";
echo "<th class='specalt'>Currency</th>";
echo "<th class='specalt'>Transaction ID</th>";
echo "<th class='specalt'>Method</th>";
echo "<th class='specalt'>Operator</th>"; 
echo "<th class='specalt'>Comments</th>"; 
echo "<th class='specalt'>Teacher</th>"; 
echo "<th class='specalt'>Teamlead</th>"; 
echo "<th class='specalt'>Main Teamlead</th>"; 
echo "<th class='specalt'>Sender</th>"; 
//echo "<th class='specalt'>Email</th>"; 
echo "<th class='specalt'>Email</th>"; //HIDDEN EMAIL
echo "<th class='specalt'>Campus</th>";
//echo "<th class='specalt'>agent</th>";
//echo "<th class='specalt'>ATL</th>";
//echo "<th class='specalt'>MATL</th>";
echo "<th class='specalt'>Agent Commision</th>";
echo "<th class='specalt'>Teacher Commision</th>";
echo "<th class='specalt'>CCV CODE</th>";
//Download link for WU/BANK/PHY payment image
echo "<th class='specalt'><b>Download file</b></th>";  
if($_SESSION['userId']==159 || $_SESSION['userId']==298 || $_SESSION['userId']==227 || $_SESSION['userId']==2074){
echo "<th class='specalt'>Accounts date</th>";
echo "<th class='specalt'>Deducted amount</th>";
}

echo "<th class='specalt' colspan='5'>Actions</th>";
echo "<th class='specalt'><b>Bank Name</b></th>";
echo "</tr>";
$amount=array();
$recieved=array();
$recieved_with_tran_id=array();
$usd_convert_recieved=array();
$usd_convert_recieved_with_tran_id=array();

$pending =array();
$signups =array();
$usd_convert_signups=array();

$recieved_usd=array();
$recieved_usd_with_tran_id=array();
$signups_usd =array();
$signups_usd_with_tran_id =array();
$discount =array();

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
if(isset($_POST['submit']))
{
	$result = mysql_query($sql) or trigger_error(mysql_error()); 
	echo "Count:".$row_count=mysql_num_rows($result);
	/*$row_count=mysql_num_rows($result);	//Required for number of rows counted/effected/returned*/
	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
	$signup_check=1;



	$countresult=$row['amount'];

	$countmonthsql="select amount as amounttran_not_main,date,dateRecieved,operator,id FROM campus_transaction where date BETWEEN '".nl2br(prepareDate($_POST['fromDate']))."' AND '".nl2br(prepareDate($_POST['toDate']))."' and studentID=".$row['studentID']." and schedule_id=".$row['id']." and id=".$row['tran_id']." "; 
	$countmonthesult=mysql_query($countmonthsql);
	$countmonthesult=mysql_fetch_assoc($countmonthesult);
	$amount[$row['id']]=$countresult;
	
	$discount[$row['id']] = $row['discount_tran'];

	//DUE DATE(Signup DATE) - Month and Year
	$duedate_month = date('m', strtotime(nl2br($row['due_date'])));
	$duedate_year = date('Y', strtotime(nl2br($row['due_date'])));
	
	//DUE DATE(Signup DATE) - Month and Year
	$dateRec_month = date('m', strtotime(nl2br($countmonthesult['dateRecieved'])));
	$dateRec_year = date('Y', strtotime(nl2br($countmonthesult['dateRecieved'])));
	
	
	
	if(($row['due_date']>=nl2br(prepareDate($_POST['fromDate'])) && $row['due_date']<=nl2br(prepareDate($_POST['toDate']))) && $row['due_date']==$countmonthesult['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult) && ($duedate_month==$dateRec_month && $duedate_year==$dateRec_year))
	{
		if(($row['method_array']==2 || $row['method_array']==3 || $row['method_array']==4 || $row['method_array']==5) && $row['accounts_chk']!=1)
		{
			$signups[$row['id']]=0;
			$signup_check=0;
			$signups_usd[$row['id']]=0;
			$signups_usd_with_tran_id[$row['tran_id']]=0;
		}
		else
		{
			$signups[$row['id']]=$row['amounttran'];
			$signup_check=0;
			$signups_usd[$row['id']]=$row['amount_usd_simple'];
			$signups_usd_with_tran_id[$row['tran_id']]=$row['amount_usd_simple'];
		}
	}
	else
	{
	//$signup_check==1;
	}

	if(!empty($countresult) && ($countmonthesult['date']>=nl2br(prepareDate($_POST['fromDate'])) && $countmonthesult['date']<=nl2br(prepareDate($_POST['toDate']))) && $signup_check==1)
	{
		if(($row['method_array']==2 || $row['method_array']==3 || $row['method_array']==4 || $row['method_array']==5) && $row['accounts_chk']!=1)
		{
			$recieved[$row['id']]=0;//oldly used
			$recieved_with_tran_id[$row['tran_id']]=0;
			$recieved_usd[$row['id']]=0;
			$recieved_usd_with_tran_id[$row['tran_id']]=0;
		}
		else
		{
			$recieved[$row['id']]=$row['amounttran'];//oldly used
			$recieved_with_tran_id[$row['tran_id']]=$row['amounttran'];
			$recieved_usd[$row['id']]=$row['amount_usd_simple'];
			$recieved_usd_with_tran_id[$row['tran_id']]=$row['amount_usd_simple'];
		}
	//USD-Convert
	
	//$recieved[$row['id']]=0;//newly used
	//$signup_check==0;
	}
	//else
	//{
	//$recieved[$row['id']]=0;//newly used;
	//}
	//$pending[$row['id']]=$countresult-$countmonthesult['amounttran'];


	/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

	//$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row['studentID']." and courseID=".$row['courseID']." and classType=".$row['classType']." and startTime='".$row['startTime']."'"; 
	////$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row['studentID']." and schedule_id=".$row['schedule_id']." "; 
	////$maxdate_rec_result=mysql_query($maxdate_rec);
	////$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);


	/////////////GETTING COUNTRY//////////////// NEWLY ADDED

	//$query_country="SELECT countryID FROM campus_students where id=".$row['studentID']." "; 
	//$query_country_result=mysql_query($query_country);
	//$query_country_result=mysql_fetch_assoc($query_country_result);


	/*if($row['due_date']==nl2br(prepareDate($_POST['fromDate'])) && !empty($countresult) && $signup_check==1)
	{
	$signups[$row['id']]=$countresult;

	}*/
	
	$systemdate = systemDate();
	$receivedDate_strtotime = strtotime($row['date_rec_cam_tran']);
	$systemDate_strtotime = strtotime($systemdate);
	
	echo "<tr>";  
	//echo "<td valign='top'>" . nl2br( $row['dayz'])  . "</td>";
	if($_SESSION['userId']==159)
	{
		echo "<td valign='top'><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=payment_record_report_delete.php?tran_id={$row['tran_id']}>Delete</a></td></td>";
		echo "<td valign='top'><a class=button href=payment_record_report_test_edit.php?tran_id={$row['tran_id']}>Edit</a></td>";
		
	}
/* 	if(($_SESSION['userId']==126 || $_SESSION['userId']==411 || $_SESSION['userId']==221) && $receivedDate_strtotime==$systemDate_strtotime)
	{
		echo "<td valign='top'><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=payment_record_report_delete.php?tran_id={$row['tran_id']}>Delete</a></td></td>";
		echo "<td valign='top'><a class=button href=#>Edit</a></td>";
	} */
/* 	if(($_SESSION['userId']==126 || $_SESSION['userId']==221) && $receivedDate_strtotime!=$systemDate_strtotime)
	{
		echo "<td valign='top' colspan=2> </td>";
	} */
	echo "<td valign='top'>" . nl2br( $row['accounts_comment']). "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['tran_id']). "</td>"; 
	echo "<td valign='top' style='color:blue; font-weight:bold'>" . nl2br( $row['maxdate_rec']). "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['date_rec_cam_tran']). "</td>"; 
	if(($row['method_array']==2 || $row['method_array']==3 || $row['method_array']==4 || $row['method_array']==5) && $row['accounts_chk']!=1)
	{
		echo "<td valign='top' style='color:RED; font-weight:bold; background-color:RED;'><a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
	}
	else
	{
		echo "<td valign='top'><a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";
	}
	//from CAD to USD Conversion/////////////////////////////////////////////////////////////
	//Get 1 cad to usd rate from db
	$date_rec_cam_tran_SUBTRACTED = strtotime($row['date_rec_cam_tran']);
	$date_rec_cam_tran_SUBTRACTED = strtotime('-5 day', $date_rec_cam_tran_SUBTRACTED);
	$date_rec_cam_tran_SUBTRACTED = date('Y-m-d', $date_rec_cam_tran_SUBTRACTED);
	$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE date <='".$row['date_rec_cam_tran']."' AND date >= '".$date_rec_cam_tran_SUBTRACTED."' ";
	$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
	$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	if($row_1cad_to_dollar_rate_USDval['1_cad_to_usd']=='')
	{
		//Get 1 cad to usd rate from db
		$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
		$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
		$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	}
	//echo "<td valign='top'>" . 	nl2br( $recieved_usd[$row['id']]). "</td>";
	//echo "<td valign='top'>" . 	nl2br( $signups_usd[$row['id']]). "</td>";
	
	echo "<td valign='top'>" . 	nl2br( $recieved_usd_with_tran_id[$row['tran_id']]). "</td>";
	echo "<td valign='top'>" . 	nl2br( $signups_usd_with_tran_id[$row['tran_id']]). "</td>";
	
	/* Commenting old RECEIVED AMOUNT(USD) and SIGNUP AMOUNT(USD)
	echo "<td valign='top'>$" . $usd_convert_recieved[$row['id']] =  round($recieved[$row['id']]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'],2) . "</td>";
	$usd_convert_recieved_with_tran_id[$row['tran_id']] = $recieved_with_tran_id[$row['tran_id']]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
	echo "<td valign='top'>$" . $usd_convert_signups[$row['id']] =  round($signups[$row['id']]*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'],2) . "</td>";
	 */
	/////////////////////////////////////////////////////////////////////////////////////////
	//echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";
	//echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";
	//echo "<td valign='top'>$" . nl2br( $row['amounttran_gbp']) . "</td>";
	$recieved[$row['id']];
	$signups[$row['id']];
	$row['amounttran_gbp'];
	echo "<td valign='top'>$" . nl2br( $row['amounttran_original']) . "</td>";
	if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userType']==6)
	{
	echo "<td valign='top'>$" . nl2br( $discount[$row['id']]) . "</td>";
	}
	echo "<td valign='top'>$" . nl2br( $row['amount'] ) . "</td>";
	echo "<td valign='top'>$" . round( $row['amount'] * $row_USD_to_CAD['1_cad_to_usd'],2) . "</td>";
	
	echo "<td valign='top'>" .  getData(nl2br( $row['currency_array']),'currency') . "</td>";
	echo "<td valign='top'>" .  nl2br( $row['transactionID']) . "</td>";
	echo "<td valign='top'>" .  getData(nl2br( $row['method_array']),'paymentMode') . "</td>";
	echo "<td valign='top'>" . 	showUser(nl2br( $row['tran_op'])). "</td>"; 
	echo "<td valign='top'>" . 	nl2br( $row['comments']). "</td>"; 
	echo "<td valign='top'>" . 	showUser(nl2br( $row['teacherID'])). "</td>"; 
	echo "<td valign='top'>" . 	showUser(nl2br( $row['LeadId'])). "</td>";
	echo "<td valign='top'>" . 	showUser(nl2br( $row['main_LeadId'])). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['sender_name']). "</td>";
	if($_SESSION['userType']==2){
	echo "<td valign='top'>NA</td>";
	}else{
	//echo "<td valign='top'>" . nl2br( $row['email']) . "</td>";
	echo "<td valign='top'>" . hideEmail($row['email']) . "</td>";
	}
	echo "<td valign='top'>" .  getData(nl2br( $row['campus']),'campus') . "</td>";
	//echo "<td valign='top'>" . 	showUser(nl2br( $row['agent_id'])). "</td>";
	//echo "<td valign='top'>" . 	showUser(nl2br( $row['agentLeadId'])). "</td>";
	//echo "<td valign='top'>" . 	showUser(nl2br( $row['main_agentLeadId'])). "</td>";
	echo "<td valign='top'>" . 	showUser(nl2br( $row['agent_comm'])). "</td>";		//Commented on 02-09-16
	echo "<td valign='top'>" . 	showUser(nl2br( $row['teacher_comm'])). "</td>";	//Commented on 02-09-16
	//echo "<td valign='top'>" .  $row['agent_comm']. "</td>";						Commented on 16-03-17
	//echo "<td valign='top'>" . 	$row['teacher_comm']. "</td>";					Commented on 16-03-17
	echo "<td valign='top'>" . 	nl2br( $row['cardSave_ccv_code']). "</td>";
	//Download link for WU/BANK/PHY payment image
	if(!empty($row['bank_payment_image_filepath']))
	{
	echo "<td valign='top'><a href='". nl2br( $row['bank_payment_image_filepath'])."' target=_blank>" . DOWNLOAD . "</a></td>";
	}
	else
	{
	echo "<td valign='top'><a href=#>" . NOFILE . "</a></td>";
	}
	if($_SESSION['userId']==159 || $_SESSION['userId']==298 || $_SESSION['userId']==227 || $_SESSION['userId']==2074){
	echo "<td valign='top'>" . $row['datetime_now_accounts'] . "</td>";
	echo "<td valign='top'>" . $row['amount_original_deducted'] . "</td>";	
	}	
	
	?>
	<form action='' method='POST'> 
	<?
	if(($_SESSION['userId']==159 || $_SESSION['userId']==298  || $_SESSION['userId']==86 || $_SESSION['userId']==2074) && ($row['method_array']==2 || $row['method_array']==3 || $row['method_array']==4 || $row['method_array']==5))
	{
	echo "<td valign='top'>"?> <input name="accounts_amount" id="accounts_amount" type="number" placeholder='Enter Amount' required /> <?"</td>"; 
	echo "<td valign='top'>"?> <input name="accounts_comment" id="accounts_comment" type="text" placeholder='Enter Comments' /> <?"</td>"; 
	echo "<td valign='top'>" . getCheckbox_id( $_POST['accounts_chk_box_id'],$row['tran_id'],'accounts_chk_box_id') . "</td>"; 
	//Added for ACCOUNTS to select the RECEIVED DATE(date) manually		//Newly added 04-08-16
	if($row['campus']!=1)
	{
		echo "<td valign='top'>" . getInput(stripslashes($_POST['received_date_manual']),'received_date_manual','class=flexy_datepicker_input') . "</td>";
	}
	echo "<td valign='top'>"?> <input type='submit' value='Submit' name='sender' class="button" />
	<input type='hidden' value='1' name='submitted'/>
	<!-- For updating DUE DATE and PAYDATE for SIGNUPS only, so passing schedule_id and campus rawalpindi -->
	<input type='hidden' value=<?php echo $row['schedule_id']; ?> id='schedule_id' name='schedule_id' />
	<input type='hidden' value=<?php echo $row['campus']; ?> id='campus' name='campus' />
	</div> <? "</td>";
	}
	?>
	</form>
	<?
	echo "<td valign='top'>" . getData(nl2br( $row['bankNameId']),'bankName') . "</td>";
	echo "</tr>"; 
}


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
echo "<td valign='top'> </td>";
if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userId']==126)
{
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
}
echo "<td valign='top'>Sum </td>";  
echo "<td valign='top'><b>$" . nl2br( round(array_sum($recieved_usd),2)) . "</td>";
echo "<td valign='top'><b>$" . nl2br( round(array_sum($signups_usd),2)) . "</td>";
echo "<td valign='top'> </td>";
if($_SESSION['userId']==159 || $_SESSION['userId']==227){
echo "<td valign='top'><b>$" . nl2br( array_sum($discount)) . "</td>";
}
/* Commenting old RECEIVED and SIGNUPS sums 
echo "<td valign='top'><b>$" . nl2br( round(array_sum($usd_convert_recieved),2)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( round(array_sum($usd_convert_signups),2)) . "</td>";  
*/
//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
//echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";   
echo "<td valign='top'></td>"; 
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
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "</tr>";

	echo "<tr>";  
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userId']==126)
	{
		echo "<td valign='top'> </td>";
		echo "<td valign='top'> </td>";
	}
	echo "<td valign='top'>Sum Actual</td>";  
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($recieved_usd_with_tran_id)) . "</td>";  
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($signups_usd_with_tran_id)) . "</td>";  
	
	/* Commenting old SUM ACTUAL sum
	echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($usd_convert_recieved_with_tran_id)) . "</td>";  
	 */
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
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	//echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($recieved_with_tran_id)) . "</td>";  
	//echo "<td valign='top'></td>"; 
	echo "</tr>";

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
}
else
{
echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}
include('include/footer.php');?>

<!--<form action='' method='POST'>--> 
<!--<div id="label"></div><div id="field"><input type='text' id='recurring_amount' name='recurring_amount' value='<?//= stripslashes(nl2br( array_sum($amount))) ?>' /> </div>-->

<!--WORKING FINE, HAD TO BE ADDED LATER-->
<!--<div id="label"></div><div id="field"><input name="sender" type="button" id="sender" value="Send CCMS Recurring Amount" onclick="javascript: send_recurring_email()" /> </div>-->

<!--<div id="ajaxdiv_amount"></div>-->
<!--<input type='hidden' value='1' name='submitted' /></div> -->
<!--</form>-->