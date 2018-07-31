<?php
include('config.php');
include('include/header.php'); 
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
<?php
echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<? getStudentFilter();
getTeacherFilterLead();
getParentFilter();
getFilterSubmit(); ?>
</div>
<br>
</form>
</div>
<?
if($_POST['search-submit']){
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>id</b></th>";  
echo "<th class='specalt'><b>invoice_id</b></th>"; 
echo "<th class='specalt'><b>pid</b></th>";
echo "<th class='specalt'><b>teacherID</b></th>";
echo "<th class='specalt'><b>student_id</b></th>";
echo "<th class='specalt'><b>team_id</b></th>";
echo "<th class='specalt'><b>student_name</b></th>";   
echo "<th class='specalt'><b>due_date</b></th>";  
echo "<th class='specalt'><b>next_due_date</b></th>"; 
echo "<th class='specalt'><b>monthly_fee (CAD)</b></th>";
echo "<th class='specalt'><b>months</b></th>";
echo "<th class='specalt'><b>payment (USD)</b></th>";
echo "<th class='specalt'><b>payment_local (Local)</b></th>";
echo "<th class='specalt'><b>voice_id</b></th>";   
echo "<th class='specalt'><b>invoice_date</b></th>";
echo "<th class='specalt'><b>currency</b></th>";
echo "<th class='specalt'><b>schedule_id</b></th>";
echo "</tr>"; 
if($_SESSION['userType']==0)
{
	$result = mysql_query("SELECT * FROM `tbl_invoices_details` WHERE fromID='".$_SESSION['userId']."' ") or trigger_error(mysql_error());
}
else
{
	if($_SESSION['userType']==1 || $_SESSION['userType']==8){
		$sql="SELECT * FROM `tbl_invoices_details` WHERE id!=0 ";
		if(isset($_POST['search-parent-id']) && !empty($_POST['search-parent-id']))
		{
			$sql.= " and pid = ".$_POST['search-parent-id'];
		}
		if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0)
		{
			$sql.=" and team_id='".$_POST['search-teacher-id2']."' ";
		}
		if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
		{
			$sql.= " and student_id = ".$_POST['search-student-id'];
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql.= " and invoice_date>='".prepareDate($_POST['fromDate'])."' and invoice_date<='".prepareDate($_POST['toDate'])."'";
		}
		//echo $sql;
		$result=mysql_query($sql) or trigger_error(mysql_error());
	}
}
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";
echo "<td valign='top'>" . $row['id'] . "</td>";
echo "<td valign='top'>" . $row['invoice_id'] . "</td>";
echo "<td valign='top'>" . getparentname($row['pid']) . "</td>";
echo "<td valign='top'>" . showUser($row['teacherID']) . "</td>";
echo "<td valign='top'>" . showStudents($row['student_id']) . "</td>";
echo "<td valign='top'>" . showUser($row['team_id']) . "</td>";
echo "<td valign='top'>" . $row['student_name'] . "</td>";
echo "<td valign='top'>" . $row['due_date'] . "</td>";
echo "<td valign='top'>" . $row['next_due_date'] . "</td>";
echo "<td valign='top'>" . $row['monthly_fee'] . "</td>";
echo "<td valign='top'>" . $row['months'] . "</td>";
echo "<td valign='top'>" . $row['payment'] . " <b>(USD)</b></td>";
echo "<td valign='top'>" . $row['payment_local'] . " <b>(". get_user_currency_from_SCH($row['schedule_id']) . ")</b>" . "</td>";
echo "<td valign='top'>" . $row['voice_id'] . "</td>";
echo "<td valign='top'>" . $row['invoice_date'] . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['currency']),'currency') . "</td>";
echo "<td valign='top'>" . $row['schedule_id'] . "</td>";
echo "</tr>"; 

//Picking INOVICE ID from tbl_invoice_details and comparing it with invoice_details
//And then GROUPING BY to check PAID or UNPAID
  $sql_invoice = "SELECT parent_name,ti.invoice_id,ti.pid,ti.due_date ,ti.invoice_date ,
  ti.paid_status	,SUM(payment) as total_amount,
  tid.schedule_id 
					FROM tbl_invoices ti
					INNER JOIN `tbl_invoices_details` tid 
					ON ti.invoice_id = tid.invoice_id
					WHERE  ti.invoice_id = '".$row['invoice_id']."' and 
					tid.pid = '".$_POST['search-parent-id']."' 
					GROUP BY tid.invoice_id" ;
	$exe_invoice 	= mysql_query($sql_invoice);
	$count_invoices = mysql_num_rows($exe_invoice);
	$fetch_invoice = mysql_fetch_array($exe_invoice);
}
echo "</table>";
//Showing status i.e PAID UNPAID
	echo "<span style=font-size:16px;font-weight:bold;>STATUS:</span>";
	if($fetch_invoice['paid_status']=='0' || $fetch_invoice['paid_status']=='3')
	echo $status.='<span style="border:#F00 3px solid;padding:10px;spacing:10px">Unpaid</span>';
	else if($fetch_invoice['paid_status']=='1')
	echo $status.='<span style="border:#26A908 3px solid;padding:10px; color:#26A908">Paid</span>';
	else if($fetch_invoice['paid_status']=='2')
	echo $status.='<span style="border:#26A908 3px solid;padding:10px; color:#26A908">Canceled</span>';
///////////////////////////////
}
include('include/footer.php');
?>