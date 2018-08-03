<? 
include('config.php');
include('include/header.php'); 

if(isset($_POST['submitted']))
{
echo $start = $_POST['start'];
echo $end = $_POST['end'];
echo $Date = $_POST['Date'];
}
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

echo "<th class='specalt'><b>Actions</b></th>";

echo "</tr>"; 
if($start<=$end)
{
	echo $Date_month=date('n',strtotime($_POST['Date']));
	echo $Date_year=date('Y',strtotime($_POST['Date']));
	$result = mysql_query("SELECT * FROM `campus_payroll` WHERE id BETWEEN '$start' AND '$end' and month(payment_date)='$Date_month' AND year(payment_date)='$Date_year'") or trigger_error(mysql_error()); 
}
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: START Value must be less or equal to END Value</label>";
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

$string="id={$row['id']}&basic_pay={$row['g_pay_before_deduction']}&emp_designation=".$desig."&emp_shift=".$emp_shift."&emp_app_date={$row['appointment_date']}&working_days={$row['working_days']}&days_worked={$row['days_worked']}&gross_pay_ad={$row['g_pay_after_deduction']}&increament={$row['increament']}&arrears={$row['arrears']}&incentive_bonus={$row['incentive_bonus']}&commision_paid={$row['commision_paid']}&commision_unpaid={$row['commision_unpaid']}&trvl_allow={$row['travelling_allowance']}&staff_adv={$row['staff_advance']}&fine={$row['fine']}&other_deduction={$row['other_deduction']}&tea_deduction={$row['tea_deduction']}&residance_allowance={$row['residance_allowance']}&net_payable={$row['net_payable']}&salaries_paid={$row['salaries_paid']}&payment_date={$row['payment_date']}&paid_leaves={$row['paid_leaves']}&emp_name=".$user."&total_earn={$row['total_earn']}&total_deduct={$row['total_deduct']} ";
urlencode($string);
$string_with_url = "excel.php?".$string;

//FOLLOWING IMPORTANT LINK-HOPE IT HELPS
//http://stackoverflow.com/questions/3714843/free-script-to-open-multiple-urls-at-once
//FOLLOWING LINK is for array_splice for array cutting specific indexes
//http://php.net/manual/en/function.array-splice.php

//Button for PER PERSON pdf page generation
echo "<td><a class=button target='_blank' href=excel.php?".$string." >Pay slip</a></td>";
//Following is the array to be filled with the pdf page(excel.php) and with the values to be passed
$_AUTO_PRINT_PDF_ARRAY[$row['id']]=$string_with_url;
echo "<br>";
echo "</tr>"; 
} 
echo "</table>"; 
$open = ''; 
foreach ($_AUTO_PRINT_PDF_ARRAY as $link => $value) 
{
	if($link==0)
	{
		//$link=$link+1;
		//echo'<option value="'.$link.'">'.$link.'-'.$value.'</option>';
		//DO NOTHING
	}
	else
	{
		$open .= "window.open('{$value}'); ";
	}
}	
echo "<a href=\"#\" onclick=\"{$open}\">ONE CLICK GO - PRINT</a>"; 
include('include/footer.php');
?>