<? 
include('config.php');
include('include/header.php'); 
if($_SESSION['userType']==1)
{
	//echo "<label style='color:RED; font-weight:bold; font-size:9px; margin-bottom:5px;'>NOTE: Add the following relevant BIOMETRIC ID under LIST EMPLOYEES to make the Attendance visible for specific teachers</label>";
}
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
<?php //if($_SESSION['userType']==1){ getTeacherFilter(); }?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?

 ?></div>
<div style="float:left">
<?
//echo "<label style='color:red; font-weight:bold'>NOTE: Don't consider ABSENT ALERT for MAKE OVER classes - <u>Take the Load</u></label>";
?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
</div>
<br><br>
</form>
</div>
<?
$total_tranId_count_array=array();
$total_amount_sum_array=array();

echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>Paypal Date</b></th>";
echo "<th class='specalt'><b>Tran Date</b></th>";
echo "<th class='specalt'><b>Tran ID Count</b></th>";
//TEACHER TEAMLEAD Commented for now  
//echo "<th class='specalt'><b>Teamlead</b></th>";  
echo "<th class='specalt' style='color:RED;'><b>Amount</b></th>"; 
echo "<th class='specalt'><b>time</b></th>"; 
echo "<th class='specalt'><b>timezone</b></th>"; 
echo "<th class='specalt'>currency</th>"; 
echo "<th class='specalt'>gross</th>"; 
echo "<th class='specalt'>fromemail</th>";
echo "<th class='specalt'>TRANSACTED</th>";
echo "<th class='specalt'>PAYPAL</th>";
echo "</tr>"; 

if($_SESSION['userType']==1){
	//count(DISTINCT campus_transaction.transactionID) as tranId_count,
	//SUM(campus_transaction.amount_original)
	//campus_transaction_paypal.transactionId=campus_transaction.transactionID
	//campus_transaction_paypal.transactionId LIKE CONCAT('%', campus_transaction.transactionID, '%')
	//GROUP BY campus_transaction_paypal.fromemail 
	
	//DATE-Add later
	//(campus_transaction_paypal.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."') and 
	
	$sql="SELECT 
	campus_transaction.id as tran_id,
	campus_transaction.transactionID as tranId_transaction,
	campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	SUM(campus_transaction.amount_original) as amount_original_sum,
	campus_transaction_paypal.id,campus_transaction_paypal.transactionId as tranId_paypal,campus_transaction_paypal.gross, 
	campus_transaction_paypal.fromemail,campus_transaction_paypal.currency,
	campus_transaction_paypal.date as paypal_date 	
	FROM campus_transaction
	RIGHT OUTER JOIN campus_transaction_paypal ON 
	campus_transaction_paypal.fromemail = campus_transaction.email AND 
	(campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."') and 
	campus_transaction_paypal.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and 
	
	campus_transaction.date!='' 
	GROUP BY campus_transaction.email  ORDER BY  campus_transaction_paypal.date  ASC";
	$result=mysql_query($sql) or die(mysql_error());	
	}

while($row = mysql_fetch_array($result)){ 
echo $row['tran_id'];echo "----";echo $row['id'];echo "<br>";
echo "<tr>";  
//if($row['amount_original_sum']=='')
//{
//echo "<td valign='top'>" . $total_tranId_count_array[$row['tran_id']] = $row['tranId_count'] . "</td>";
echo "<td valign='top'>" . $row['paypal_date'] . "</td>";
echo "<td valign='top'>" . $row['date_rec_cam_tran'] . "</td>";
echo "<td valign='top'>" . $row['tranId_count'] . "</td>";
//TEACHER TEAMLEAD Commented for now
//echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>";

if($row['amount_original_sum']>=$row['gross'])
echo "<td valign='top' style='color:GREEN;'>" . $row['amount_original_sum'] . "</td>";
else
echo "<td valign='top' style='color:RED;'>" . $row['amount_original_sum'] . "</td>";
echo "<td valign='top'>" . nl2br( $row['time']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['timezone']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['currency']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['gross']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['fromemail']) ."**". nl2br( $row['email']) ."</td>";
echo "<td valign='top'>" . nl2br( $row['tranId_transaction']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['tranId_paypal']) . "</td>";
echo "</tr>"; 
}


echo "</table>";
include('include/footer.php');
?>