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
<?php //echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php //echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?
//getStudentFilter();
//getTeacherFilter();
//getAgentFilter();
//getStartTimeFilter();
 ?></div>
<div style="float:left">
<?
//getPlanFilter();
//getShiftFilter();
//getCourseFilter();
//getStatusFilter_with_makeover();
//getFilterSubmit();
//echo "<label style='color:red; font-weight:bold'>NOTE: Don't consider ABSENT ALERT for MAKE OVER classes - <u>Take the Load</u></label>";
?>
</form>
</div>
<br><br>
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>id</b></th>";  
echo "<th class='specalt' style='color:RED;'><b>date</b></th>"; 
echo "<th class='specalt'><b>time</b></th>"; 
echo "<th class='specalt'><b>timezone</b></th>";
//echo "<th class='specalt'>name</th>"; 
//echo "<th class='specalt'>type</th>"; 
//echo "<th class='specalt'>status</th>"; 
echo "<th class='specalt'>currency</th>"; 
echo "<th class='specalt'>gross</th>"; 
//echo "<th class='specalt'>fee</th>"; 
//echo "<th class='specalt'>net</th>"; 
echo "<th class='specalt'>fromemail</th>";
//echo "<th class='specalt'>toemail</th>"; 
echo "<th class='specalt'>transactionId</th>";
//echo "<th class='specalt'>counterparty_status</th>";
//echo "<th class='specalt'>address_status</th>";
/* echo "<th class='specalt'>item_title</th>";
echo "<th class='specalt'>itemId</th>";
echo "<th class='specalt'>postage_package</th>";
echo "<th class='specalt'>insurance</th>";
echo "<th class='specalt'>vat</th>";
echo "<th class='specalt'>option1name</th>";
echo "<th class='specalt'>option1value</th>";
echo "<th class='specalt'>option2name</th>";
echo "<th class='specalt'>option2value</th>";
echo "<th class='specalt'>auctionsite</th>";
echo "<th class='specalt'>buyerId</th>";
echo "<th class='specalt'>itemurl</th>";
echo "<th class='specalt'>closingdate</th>";
echo "<th class='specalt'>escrowId</th>";
echo "<th class='specalt'>invoiceId</th>";
echo "<th class='specalt'>referencetxnId</th>";
echo "<th class='specalt'>invoiceNo</th>";
echo "<th class='specalt'>customNo</th>";
echo "<th class='specalt'>receiptId</th>";
echo "<th class='specalt'>balance</th>";
echo "<th class='specalt'>addressline1</th>";
echo "<th class='specalt'>addressline2</th>";
echo "<th class='specalt'>town</th>";
echo "<th class='specalt'>state</th>";
echo "<th class='specalt'>postcode</th>";
echo "<th class='specalt'>country</th>";
echo "<th class='specalt'>contactperson</th>";
 */








//echo "<th class='specalt' colspan=8><b>Actions</b></th>";  
echo "</tr>"; 

if($_SESSION['userType']==1){
	$sql="SELECT *  
	FROM campus_transaction_paypal ";
	
	$result=mysql_query($sql) or die(mysql_error());	
	}

while($row = mysql_fetch_array($result)){ 

echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['time']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['timezone']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['currency']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['gross']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['fromemail']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['transactionId']) . "</td>";
echo "</tr>"; 
} 
echo "</table>";
include('include/footer.php');
?>