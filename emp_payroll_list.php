<? 
include('config.php');
include('include/header.php'); 
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
<?php
getDepartmentFilter();
?>
</div>

<div id="label">Date filter:</div>&nbsp;<?php echo getInput(stripslashes($_POST['Date']),'Date','class=flexy_datepicker_input');?>&nbsp;&nbsp;
&nbsp;&nbsp;
<input type="submit" class="button" name="submit" value="Filter"></form>
<br /><br />
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>"; 
echo "<th class='specalt'><b>Emp_Name</b></th>";
echo "<th class='specalt'><b>Department</b></th>";  
echo "<th class='specalt'><b>Designation</b></th>"; 
echo "<th class='specalt'><b>Appoint_date</b></th>"; 
echo "<th class='specalt'><b>Confirm_date</b></th>";
echo "<th class='specalt'><b>Emp_shift</b></th>";  
echo "<th class='specalt'><b>Gross pay_BD</b></th>"; 
echo "<th class='specalt'><b>Working Days</b></th>"; 
echo "<th class='specalt'><b>Days Worked</b></th>";
echo "<th class='specalt'><b>Paid Leaves</b></th>";
echo "<th class='specalt'><b>Gross Pay_AD</b></th>";
echo "<th class='specalt'><b>Increament</b></th>";
echo "<th class='specalt'><b>Arrears</b></th>";
echo "<th class='specalt'><b>Inc_bonus</b></th>";
echo "<th class='specalt'><b>Commision_paid</b></th>";
echo "<th class='specalt'><b>Commission_unpaid</b></th>";
echo "<th class='specalt'><b>Travel_all</b></th>";
echo "<th class='specalt'><b>staff_adv</b></th>";
echo "<th class='specalt'><b>fine</b></th>";
echo "<th class='specalt'><b>Other deduction</b></th>";
echo "<th class='specalt'><b>Tea deduction</b></th>";
echo "<th class='specalt'><b>Res_all</b></th>";
echo "<th class='specalt'><b>Net payable</b></th>";
echo "<th class='specalt'><b>Sal_paid</b></th>";
echo "<th class='specalt'><b>Sal_month</b></th>";
echo "<th class='specalt'><b>T_Earn</b></th>";
echo "<th class='specalt'><b>T_Deduct</b></th>";

echo "<th class='specalt'  colspan=3><b>Actions</b></th>";

echo "</tr>"; 
if(isset($_POST['submit']) && !empty($_POST['Date']))
{
echo $Date = $_POST['Date'];
echo "<br>";
echo $Date_month=date('n',strtotime($_POST['Date']));
echo "<br>";
echo $Date_year=date('Y',strtotime($_POST['Date']));
echo "<br>";
$sql = "SELECT * FROM `campus_payroll` WHERE month(payment_date)='$Date_month' AND year(payment_date)='$Date_year'";
	if($_POST['department']!=0)
	{
		$sql.= " and department_id='".$_POST['department']."' ";
	}
$result = mysql_query($sql) or trigger_error(mysql_error());
}
else
{
$result = mysql_query("SELECT * FROM `campus_payroll`") or trigger_error(mysql_error()); 
}
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
$user = showUser_emp_payroll(nl2br( $row['emp_id']));
echo "<td valign='top'>" . showUser(nl2br( $row['emp_id'])) . "</td>";
$depart = getData(nl2br( $row['department_id']),'department');
echo "<td valign='top'>" . getData(nl2br( $row['department_id']),'department') . "</td>";     
$desig = getData(nl2br( $row['designation_id']),'designation');
echo "<td valign='top'>" . getData(nl2br( $row['designation_id']),'designation') . "</td>";   
echo "<td valign='top'>" . nl2br( $row['appointment_date']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['confirmation_date']) . "</td>";
$emp_shift = getData(nl2br( $row['emp_shift']),'shift');
echo "<td valign='top'>" . getData(nl2br( $row['emp_shift']),'shift'). "</td>"; 
echo "<td valign='top'>" . nl2br( $row['g_pay_before_deduction']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['working_days']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['days_worked']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['paid_leaves']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['g_pay_after_deduction']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['increament']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['arrears']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['incentive_bonus']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['commision_paid']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['commision_unpaid']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['travelling_allowance']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['staff_advance']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['fine']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['other_deduction']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['tea_deduction']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['residance_allowance']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['net_payable']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['salaries_paid']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['payment_date']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['total_earn']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['total_deduct']) . "</td>";

$string="basic_pay={$row['g_pay_before_deduction']}&emp_department=".$depart."&emp_designation=".$desig."&emp_shift=".$emp_shift."&emp_app_date={$row['appointment_date']}&working_days={$row['working_days']}&days_worked={$row['days_worked']}&gross_pay_ad={$row['g_pay_after_deduction']}&increament={$row['increament']}&arrears={$row['arrears']}&incentive_bonus={$row['incentive_bonus']}&commision_paid={$row['commision_paid']}&commision_unpaid={$row['commision_unpaid']}&trvl_allow={$row['travelling_allowance']}&staff_adv={$row['staff_advance']}&fine={$row['fine']}&other_deduction={$row['other_deduction']}&tea_deduction={$row['tea_deduction']}&residance_allowance={$row['residance_allowance']}&net_payable={$row['net_payable']}&salaries_paid={$row['salaries_paid']}&payment_date={$row['payment_date']}&paid_leaves={$row['paid_leaves']}&emp_name=".$user."&total_earn={$row['total_earn']}&total_deduct={$row['total_deduct']} ";
urlencode($string);

echo "<td valign='top'><a class=button href=excel.php?".$string." target=_blank>Pay slip</a></td>
<td><a class=button href=emp_payroll_edit.php?id={$row['id']} target=_blank>Edit</a></td>
<td><a class=button href=emp_payroll_delete.php?id={$row['id']} target=_blank>Delete</a></td>";
echo "</tr>"; 
} 
echo "</table>"; 
?>

<form action='emp_payroll_list_result.php' method='POST' target="_blank"> 


<div id="label">Start ID:</div><div id="field"><input id='start' name='start'/> </div>
<div id="label">End ID:</div><div id="field"><input id='end' name='end'/> </div>
<div id="label">Date:</div><div id="field"><input id='Date' name='Date' value=<? echo $Date; ?>> </div>



<div id="label">&nbsp;</div><div id="field"><input type='submit' class="button" value='Send Values' /><input type='hidden' value='1' name='submitted' /> </div>
<!--<div id="label">&nbsp;</div><div id="field"><input type='submit' class="button" value='Add Row' /><input type='hidden' value='1' name='submitted' /> </div>-->
</form> 

<?php include('include/footer.php');
?>