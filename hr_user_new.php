<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted']) && !empty($_POST['firstName']) && !empty($_POST['lastName']) && !empty($_POST['phone'])) {
if($_POST['tea_deduct']==1)
{
	$tea_deduct = 300;	
}
else
{
	$tea_deduct = 0;
}
if($_POST['res_allow']==1)
{
	$res_allow = 4500;
}
else
{
	$res_allow = 0;
} 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `capmus_users` (   `firstName` ,  `lastName` ,  `fatherName` ,  `email` ,  `user_type` ,  `gender` ,  `status` ,  `phone` ,  `alt_phone` ,  `skypeId` ,  `departmentId` ,  `nic` ,  `designationID` ,  `countryId` ,  `address` ,  `empType` ,  `empShift`  ,  `appointment_date` , `confirmation_date` , `basic_salary` , `tea_deduct` , `res_allow` , `qualification` ,`LeadId` ) VALUES(    '{$_POST['firstName']}' ,  '{$_POST['lastName']}' ,  '{$_POST['fatherName']}' ,  '{$_POST['email']}' ,  '14' ,  '{$_POST['gender']}' ,  '1' ,  '{$_POST['phone']}' ,  '{$_POST['alt_phone']}' ,  '{$_POST['skypeId']}' ,  '{$_POST['departmentId']}' ,  '{$_POST['nic']}' ,  '{$_POST['designationID']}' ,  '{$_POST['countryId']}' ,  '{$_POST['address']}' ,  '{$_POST['empType']}' ,  '{$_POST['empShift']}' ,  '".prepareDate($_POST['appointment_date'])."' , '".prepareDate($_POST['confirmation_date'])."' , '{$_POST['basic_salary']}' , '".$tea_deduct."' , '".$res_allow."' , '{$_POST['qualification']}' , 0 ) "; 
mysql_query($sql) or die(mysql_error()); 
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG

//NOTE************** FOR HR USER TYPE has been fixed to 14 index for NEW as a USER TYPE
$add_user="FName:". nl2br( $_POST['firstName']).",LName:".nl2br( $_POST['lastName']).",Father_Name:".nl2br( $_POST['fatherName'])
				.",Email:".nl2br( $_POST['email']).",Phone:".nl2br( $_POST['phone']).",skypeId:".nl2br( $_POST['skypeId'])
				.",NIC:".nl2br( $_POST['nic'])
				.",User_Type:".getData(nl2br('14'),'userType').",Gender:".getData(nl2br( $_POST['gender']),'gender')
				.",Status:".getData(nl2br( $_POST['status']),'status')
				.",Department:".getData(nl2br( $_POST['departmentId']),'department').",Designation:".getData(nl2br( $_POST['designationID']),'designation')
				.",Emp_type:".getData(nl2br( $_POST['empType']),'employeeType').",Shift:".getData(nl2br( $_POST['empShift']),'shift')
				.",Appt_date:". prepareDate( $_POST['appointment_date']).",Confirm_date:". prepareDate( $_POST['confirmation_date']).",Basic_salary:". $_POST['basic_salary'];
				user_log( $_SERVER['PHP_SELF'] , "HR_ADD_USER" , $_SESSION['userId'] ,$add_user);
///////////////////////////////////////////////////////
getMessages('add'); 

} 
?>

<form action='' method='POST' id="new_entry"> 
<!-- Commenting those fields that are NOW ALLOWED FOR HR to Enter/Change -->
<!--<div id="label">Username:</div><div id="field"><input type='text' name='username'/> </div>
<div id="label">Password:</div><div id="field"><input type='password' name='password'/> </div>-->
<div id="label">FirstName:</div><div id="field"><input type='text' name='firstName' required/></div> 
<!--<div id="label">MiddleName:</div><div id="field"><input type='text' name='middleName'/></div> -->
<div id="label">LastName:</div><div id="field"><input type='text' name='lastName' required/> </div>
<div id="label">FatherName:</div><div id="field"><input type='text' name='fatherName'/></div>
<div id="label">Qualification:</div><div id="field"><input type='text' name='qualification'/></div> 
<div id="label">Email:</div><div id="field"><input type='text' name='email'/> </div>
<!--<div id="label">User Type:</div><div id="field"><?php //echo getList('','user_type','userType');?> </div>-->
<div id="label">Gender:</div><div id="field"><?php echo getList('','gender','gender');?> </div>
<!--<div id="label">Status:</div><div id="field"><?php //echo getList('','status','status');?> </div>-->
<div id="label">Phone:</div><div id="field"><input type='text' name='phone'/> </div>
<div id="label">Alt Phone:</div><div id="field"><input type='text' name='alt_phone'/> </div>
<div id="label">SkypeId:</div><div id="field"><input type='text' name='skypeId'/> </div>
<div id="label">Department:</div><div id="field"><?php echo getList('','departmentId','department');?> </div>
<div id="label">NIC:</div><div id="field"><input type='text' name='nic'/> </div>
<div id="label">Designation:</div><div id="field"><?php echo getList('','designationID','designation_insert_edit');?> </div>
<div id="label">Country:</div><div id="field"><?php echo getList('','countryId','country');?></div> 
<div id="label">Address:</div><div id="field"><textarea name='address'></textarea> </div>
<div id="label">Employee Type:</div><div id="field"><?php echo getList('','empType','employeeType');?> </div>
<div id="label">Employee Shift:</div><div id="field"><?php echo getList('','empShift','shift');?> </div>
<div id="label">Appointment Date:</div><div id="field"><input type="text"  name="appointment_date"  id="appointment_date"  class="flexy_datepicker_input"/></div>
<div id="label">Confirmation Date:</div><div id="field"><input type="text"  name="confirmation_date"  id="confirmation_date" class="flexy_datepicker_input"/></div>
<div id="label">Basic salary:</div><div id="field"><input name='basic_salary'/> </div>


<div id="label">Tea deduction:</div><div id="field" style="color:red"><?php echo getCheckbox($_POST['tea_deduct'],'tea_deduct'); ?>(Check to put value of 300 Rs)</div>

<div id="label">Residance allowance:</div><div id="field" style="color:red"><?php echo getCheckbox($_POST['res_allow'],'res_allow'); ?>(Check to put value of 4500 Rs)</div>


<div id="label">&nbsp;</div><div id="field"><input type='submit' class="button" value='Add Row' /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<?php include('include/footer.php');?>