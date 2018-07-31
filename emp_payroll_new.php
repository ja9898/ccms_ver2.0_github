<? 
include('config.php'); 
include('include/header.php');

$emp_id= (int) $_GET['emp_id'];
$department_id= (int) $_GET['department_id'];
$designation_id= (int) $_GET['designation_id'];
$emp_shift=$_GET['emp_shift'];
$appointment_date=$_GET['appointment_date'];
$confirmation_date=$_GET['confirmation_date'];
$g_pay_before_deduction=$_GET['g_pay_before_deduction'];
$tea_deduct=$_GET['tea_deduct'];
$res_allow=$_GET['res_allow'];


echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";  
echo "<td valign='top'>" . showUser(nl2br($emp_id)) . "</td>"; 
echo "<td valign='top'>" . getData(nl2br($department_id),'department') . "</td>";   
echo "<td valign='top'>" . getData(nl2br($designation_id),'designation') . "</td>";  
echo "<td valign='top'>" . getData(nl2br($emp_shift),'shift') . "</td>";  
echo "<td valign='top'>" . $appointment_date . "</td>";  
echo "<td valign='top'>" . $confirmation_date . "</td>";  
echo "<td valign='top'>" . $g_pay_before_deduction . "</td>";  
echo "</tr>"; 
echo "</table>"; 

$emp_name=showUser(nl2br($emp_id));
//`designation_id` ,  `appointment_date` , `confirmation_date` ,  `emp_shift`  ,

if (isset($_POST['submitted']))
{
if(!empty($_POST['basic_pay']) && ($_POST['working_days']>=0) && ($_POST['days_worked']>=0 && $_POST['days_worked']<=30) && ($_POST['paid_leaves']>=0 && $_POST['paid_leaves']<=12) && ($_POST['g_pay_after_deduction']>=0) && ($_POST['increament']>=0) && ($_POST['arrears']>=0) && ($_POST['incentive_bonus']>=0) && ($_POST['commision_paid']>=0) && ($_POST['commision_unpaid']>=0) && ($_POST['travelling_allowance']>=0) && ($_POST['staff_advance']>=0) && ($_POST['fine']>=0) && ($_POST['other_deduction']>=0) && ($_POST['tea_deduction']>=0) && ($_POST['residance_allowance']>=0) && ($_POST['net_payable']>=0) && ($_POST['salaries_paid']>=0) && ($_POST['payment_date']>=0) && ($_POST['total_earn']>=0) && ($_POST['total_deduct']>=0)) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `campus_payroll` (   `emp_id` , `department_id` ,  `designation_id` ,  `appointment_date` , `confirmation_date` ,  `emp_shift`  ,  
`g_pay_before_deduction`  , `working_days` ,  `days_worked` ,  `paid_leaves`  ,  `g_pay_after_deduction` ,  `increament` ,  `arrears` ,  
`incentive_bonus`  ,  `commision_paid` ,  `commision_unpaid` ,  `travelling_allowance` ,  `staff_advance`  , 
`fine` ,  `other_deduction` ,  `tea_deduction` , `residance_allowance` , `net_payable` ,  `salaries_paid` ,  `payment_date` , `total_earn` , `total_deduct`) 
VALUES(    '$emp_id' ,  '$department_id'  ,'$designation_id' ,  '$appointment_date' , '$confirmation_date' ,  '$emp_shift'  , 
'{$_POST['basic_pay']}' ,  '{$_POST['working_days']}' ,  '{$_POST['days_worked']}' ,  '{$_POST['paid_leaves']}'  , '{$_POST['g_pay_after_deduction']}' ,  
'{$_POST['increament']}' ,  '{$_POST['arrears']}' ,  '{$_POST['incentive_bonus']}' ,  '{$_POST['commision_paid']}' ,  '{$_POST['commision_unpaid']}' ,  
'{$_POST['travelling_allowance']}' ,  '{$_POST['staff_advance']}'  , '{$_POST['fine']}' ,  '{$_POST['other_deduction']}' ,  '{$_POST['tea_deduction']}' ,  
'{$_POST['residance_allowance']}' , '{$_POST['net_payable']}' ,  '{$_POST['salaries_paid']}'  ,  '".prepareDate($_POST['payment_date'])."' , 
'{$_POST['total_earn']}' , '{$_POST['total_deduct']}' ) "; 
mysql_query($sql) or die(mysql_error()); 

echo $_POST['search-employee-payroll-id']."<br>";
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
//$add_user="User:".nl2br( $_POST['username']).",Pass:".nl2br( $_POST['password']).",FName:". nl2br( $_POST['firstName']).",LName:".nl2br( $_POST['lastName']).",Email:".nl2br( $_POST['email'])
//				.",Status:".getData(nl2br( $_POST['status']),'status').",Shift:".getData(nl2br( $_POST['empShift']),'shift');
//				user_log( $_SERVER['PHP_SELF'] , "ADD_USER" , $_SESSION['userId'] ,$add_user);
///////////////////////////////////////////////////////
getMessages('add'); 
}
else
{
getMessages('error');
}
} 
?>

<form action='' method='POST'> 
<!--<div id="label">Employee Name:</div><div id="field"><div id="filter"><?php //getemployee();?></div> </div>
<div id="label">Designation:</div><div id="field"><?php //echo getList('','designation_id','designation');?> </div>
<div id="label">Appointment Date:</div><div id="field"><input type="text"  name="appointment_date"  id="appointment_date" required value="<?php echo $_POST['appointment_date']; ?>"  class="flexy_datepicker_input"/></div>
<div id="label">Confirmation Date:</div><div id="field"><input type="text"  name="confirmation_date"  id="confirmation_date" required value="<?php echo $_POST['confirmation_date']; ?>"  class="flexy_datepicker_input"/></div>
<div id="label">Employee Shift:</div><div id="field"><?php //echo getList('','emp_shift','shift');?> </div>-->

<div id="label">Employee:</div><div id="field"><input type='hidden' id='emp_name' name='emp_name' value='<?= stripslashes(showUser(nl2br($emp_id))) ?>' /> </div>
<div id="label">Designation:</div><div id="field"><input type='hidden' id='emp_designation' name='emp_designation' value='<?= stripslashes(getData(nl2br($designation_id),'designation')) ?>' /> </div>
<div id="label">Shift:</div><div id="field"><input type='hidden' id='emp_shift' name='emp_shift' value='<?= stripslashes(getData(nl2br($emp_shift),'shift')) ?>' /> </div>
<div id="label">Appointment date:</div><div id="field"><input type='hidden' id='emp_app_date' name='emp_app_date' value='<?= stripslashes($appointment_date) ?>' /> </div>
<div id="label">Confirmation date:</div><div id="field"><input type='hidden' id='emp_confirm_date' name='emp_confirm_date' value='<?= stripslashes($confirmation_date) ?>' /> </div>

<!--
Best example for textbox keyup addition and showing result in the last textbox
http://jsfiddle.net/niklasvh/BT2BE/
http://viralpatel.net/blogs/sum-html-textbox-values-using-jquery-javascript/
http://www.devcurry.com/2010/04/sum-of-all-textbox-values-using-jquery.html#.Uh_d26y3SlJ 
http://jsfiddle.net/f6Ggk/1/ 

Negative values not allowed in jquery
http://jsfiddle.net/5cgXg/
-->

<div id="label">Basic pay:</div><div id="field"><input  type='text' id='basic_pay' name='basic_pay' readonly="readonly" value='<?= stripslashes($g_pay_before_deduction) ?>' /> </div>
<!--<div id="label">Gross pay before deduction:</div><div id="field"><input name='g_pay_before_deduction'/> </div>-->
<div id="label">Working days:</div><div id="field"><input  id='working_days' name='working_days' value='30' readonly="readonly"/> </div>
<div id="label">Days worked(Enter b/w 0-30):</div><div id="field"><input required id='days_worked' name='days_worked' onchange="calculate_salary_gross_pay_after_deduction()" /> </div> <!--  -->
<div id="label">Paid leaves(Enter b/w 0-12):</div><div id="field"><input required name='paid_leaves'/> </div>


<!-- TOTAL SUM OF EARNING -->
<div id="label">Gross pay after deduction:</div><div id="field"><input required class="txt" type='number' id='g_pay_after_deduction' name='g_pay_after_deduction' readonly="readonly"/> </div>
<div id="label">Increament:</div><div id="field"><input required class="txt" type='number' id='increament' name='increament'/> </div>
<div id="label">Arrears:</div><div id="field"><input required class="txt" type='number' id='arrears' name='arrears'/> </div>
<div id="label">Incentives/Bonus:</div><div id="field"><input required class="txt" type='number' id='incentive_bonus' name='incentive_bonus'/> </div>
<div id="label">Commision Paid:</div><div id="field"><input required type='number' id='commision_paid' name='commision_paid'/> </div>
<div id="label">Commision Unpaid:</div><div id="field"><input required class="txt" type='number' id='commision_unpaid' name='commision_unpaid'/> </div>
<div id="label">Travelling allowance:</div><div id="field"><input required class="txt" type='number' id='travelling_allowance' name='travelling_allowance'/> </div>
<div id="label">Total sum_add:</div><div id="field"><span id="sum_add">0</span> </div>
<div id="label">Total sum_add_text:</div><div id="field"><input id="sum_add_text"  readonly="readonly" /> </div> <!--onchange="calculate_net_payable_salaries_paid()" -->

<!-- TOTAL SUM OF DEDUCTION -->
<div id="label">Staff advance:</div><div id="field"><input required class="txt_sub" id='staff_advance' name='staff_advance'/> </div>
<div id="label">Fine:</div><div id="field"><input required class="txt_sub" id='fine' name='fine'/> </div>
<div id="label">Other deduction:</div><div id="field"><input required class="txt_sub" id='other_deduction' name='other_deduction'/> </div>
<div id="label">Tea Deduction:</div><div id="field"><input required class="txt_sub" id='tea_deduction' name='tea_deduction' value='<? echo $tea_deduct; ?>' readonly="readonly"/> </div><!--onchange="calculate_salary_net_payable_month()" -->
<div id="label">Total sum_sub:</div><div id="field"><span id="sum_sub">0</span> </div>
<div id="label">Total sum_sub_text:</div><div id="field"><input id="sum_sub_text" readonly="readonly"/> </div> <!--onchange="calculate_net_payable_salaries_paid()" -->


<div id="label">Residance allowance:</div><div id="field"><input required id='residance_allowance' name='residance_allowance' value='<? echo $res_allow; ?>' readonly="readonly"/> </div>
<div id="label">Net Payable:</div><div id="field"><input required id='net_payable' name='net_payable' readonly="readonly" /> </div>
<div id="label">Salaries Paid:</div><div id="field"><input required id='salaries_paid' name='salaries_paid' readonly="readonly" /> </div>
<div id="label">Payment date/month:</div><div id="field"><input required type="text"  name="payment_date"  id="payment_date"  class="flexy_datepicker_input"/></div>

<!-- TOTAL EARN -->
<div id="label">Total Earning:</div><div id="field"><input required id='total_earn' name='total_earn' readonly="readonly"/> </div>
<!-- TOTAL DEDUCT -->
<div id="label">Total Deduction:</div><div id="field"><input required id='total_deduct' name='total_deduct' readonly="readonly"/> </div>


<!-- This was used previously -->
<!--<div id="label">Payment month:</div><div id="field"><?php //echo getList('','payment_month','months');?> </div>-->

<div id="label">&nbsp;</div><div id="field"><input type='submit' class="button" value='Save' /><input type='hidden' value='1' name='submitted' /> </div>
<!--<div id="label">&nbsp;</div><div id="field"><input type='submit' class="button" value='Add Row' /><input type='hidden' value='1' name='submitted' /> </div>-->
</form> 
<?php include('include/footer.php');?>