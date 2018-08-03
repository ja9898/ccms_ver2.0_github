<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
/*$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_payroll` WHERE `s_id` = '$id' "));
$edit_user_pre="User:".nl2br( $row_status_pre['username']).",Pass:".nl2br( $row_status_pre['password']).",FName:". nl2br( $row_status_pre['firstName'])
				.",LName:".nl2br( $row_status_pre['lastName']).",Email:".nl2br( $row_status_pre['email'])
				.",Status:".getData(nl2br( $row_status_pre['status']),'status').",Shift:".getData(nl2br( $row_status_pre['empShift']),'shift');
///////////////////////////////////////////////////////*/

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `campus_payroll` SET  `department_id` = '{$_POST['department_id']}' , `designation_id` = '{$_POST['designation_id']}' ,  
`appointment_date` = '".prepareDate($_POST['appointment_date'])."' , `confirmation_date` = '".prepareDate($_POST['confirmation_date'])."'  ,  
`emp_shift` = '{$_POST['emp_shift']}' ,  `g_pay_before_deduction` = '{$_POST['g_pay_before_deduction']}' ,  
`working_days` = '{$_POST['working_days']}' ,  `days_worked` = '{$_POST['days_worked']}' ,  `paid_leaves` = '{$_POST['paid_leaves']}'  ,  
`g_pay_after_deduction` = '{$_POST['g_pay_after_deduction']}' ,  
`increament` = '{$_POST['increament']}' ,  `arrears` = '{$_POST['arrears']}' ,  `incentive_bonus` = '{$_POST['incentive_bonus']}' ,  
`commision_paid` = '{$_POST['commision_paid']}' ,  `commision_unpaid` = '{$_POST['commision_unpaid']}' , 
`travelling_allowance` = '{$_POST['travelling_allowance']}' , 
`staff_advance` = '{$_POST['staff_advance']}' ,   
`fine` = '{$_POST['fine']}' ,  `other_deduction` = '{$_POST['other_deduction']}' ,  `tea_deduction` = '{$_POST['tea_deduction']}' ,  
`residance_allowance` = '{$_POST['residance_allowance']}' ,  `net_payable` = '{$_POST['net_payable']}' ,  `salaries_paid` = '{$_POST['salaries_paid']}' ,  
`payment_date` = '".prepareDate($_POST['payment_date'])."' ,  `total_earn` = '{$_POST['total_earn']}' ,  `total_deduct` = '{$_POST['total_deduct']}' 
WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
/*$edit_user_new="User:".nl2br( $_POST['username']).",Pass:".nl2br( $_POST['password']).",FName:". nl2br( $_POST['firstName'])
				.",LName:".nl2br( $_POST['lastName']).",Email:".nl2br( $_POST['email'])
				.",Status:".getData(nl2br( $_POST['status']),'status').",Shift:".getData(nl2br( $_POST['empShift']),'shift');
				user_log( $_SERVER['PHP_SELF'] , "EDIT_USER" , $edit_user_pre ,$edit_user_new);
///////////////////////////////////////////////////////*/

getMessages('edit');

} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_payroll` WHERE `id` = '$id' ")); 
?>
<form action='' method='POST' id="new_entry"> 
<div id="label">Employee Name:</div><div id="field"><input type='text' name='emp_id' value='<?= stripslashes(showUser(nl2br($row['emp_id']))) ?>' /></div>
<div id="label">Department:</div><div id="field"><?php echo getList(stripslashes($row['department_id']),'department_id','department');?></div> 
<div id="label">Designation:</div><div id="field"><?php echo getList(stripslashes($row['designation_id']),'designation_id','designation');?></div> 
<div id="label">Appointment Date:</div><div id="field"><input type="text" class="flexy_datepicker_input"  name="appointment_date"  id="appointment_date" value="<?php echo stripslashes($row['appointment_date']); ?>" /></div>
<div id="label">Confirmation Date:</div><div id="field"><input type="text" class="flexy_datepicker_input"  name="confirmation_date"  id="confirmation_date" value="<?php echo stripslashes($row['confirmation_date']); ?>" /></div>
<div id="label">Employee Shift:</div><div id="field"><?php echo getList(stripslashes($row['emp_shift']),'emp_shift','shift');?> </div> 
<div id="label">Gross pay before deduction:</div><div id="field"><input name='g_pay_before_deduction' value='<?= stripslashes($row['g_pay_before_deduction']) ?>' /></div> 
<div id="label">Working days:</div><div id="field"><input name='working_days' value='<?= stripslashes($row['working_days']) ?>' /> </div>
<div id="label">Days worked:</div><div id="field"><input name='days_worked' value='<?= stripslashes($row['days_worked']) ?>' /> </div>
<div id="label">Paid Leaves:</div><div id="field"><input name='paid_leaves' value='<?= stripslashes($row['paid_leaves']) ?>' /> </div>
<div id="label">Gross pay after deduction:</div><div id="field"><input name='g_pay_after_deduction' value='<?= stripslashes($row['g_pay_after_deduction']) ?>' /> </div>
<div id="label">Increament:</div><div id="field"><input name='increament' value='<?= stripslashes($row['increament']) ?>' /> </div>
<div id="label">Arrears:</div><div id="field"><input name='arrears' value='<?= stripslashes($row['arrears']) ?>' /> </div>
<div id="label">Incentives/Bonus:</div><div id="field"><input name='incentive_bonus' value='<?= stripslashes($row['incentive_bonus']) ?>' /> </div>
<div id="label">Commision Paid:</div><div id="field"><input name='commision_paid' value='<?= stripslashes($row['commision_paid']) ?>' /> </div>
<div id="label">Commision Unpaid:</div><div id="field"><input name='commision_unpaid' value='<?= stripslashes($row['commision_unpaid']) ?>' /> </div>
<div id="label">Travelling Allowance:</div><div id="field"><input name='travelling_allowance' value='<?= stripslashes($row['travelling_allowance']) ?>' /> </div>
<div id="label">Staff Advance:</div><div id="field"><input name='staff_advance' value='<?= stripslashes($row['staff_advance']) ?>' /> </div>
<div id="label">Fine:</div><div id="field"><input name='fine' value='<?= stripslashes($row['fine']) ?>' /> </div>
<div id="label">Other deduction:</div><div id="field"><input name='other_deduction' value='<?= stripslashes($row['other_deduction']) ?>' /> </div>
<div id="label">Tea Deduction:</div><div id="field"><input name='tea_deduction' value='<?= stripslashes($row['tea_deduction']) ?>' /> </div>
<div id="label">Residance allowance:</div><div id="field"><input name='residance_allowance' value='<?= stripslashes($row['residance_allowance']) ?>' /> </div>
<div id="label">Net Payable:</div><div id="field"><input name='net_payable' value='<?= stripslashes($row['net_payable']) ?>' /> </div>
<div id="label">Salaries Paid:</div><div id="field"><input name='salaries_paid' value='<?= stripslashes($row['salaries_paid']) ?>' /> </div>
<div id="label">Payment Date:</div><div id="field"><input type="text" class="flexy_datepicker_input"  name="payment_date"  id="payment_date" value="<?php echo stripslashes($row['payment_date']); ?>" /></div>
<div id="label">Total earn:</div><div id="field"><input name='total_earn' value='<?= stripslashes($row['total_earn']) ?>' /> </div>
<div id="label">Total deduct:</div><div id="field"><input name='total_deduct' value='<?= stripslashes($row['total_deduct']) ?>' /> </div>
<!--<div id="label">Status:</div><div id="field"><?php //echo getList($row['status'],'status','status');?> </div>-->
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /><input type='hidden' value='<?php $_GET['id']?>' name='id' /> </div>
</form> 
<? } 
include('include/footer.php');?> 
