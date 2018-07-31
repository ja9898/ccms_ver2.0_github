<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 

if (isset($_POST['submitted'])) { 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `capmus_users` WHERE `id` = '$id' "));
//$department_pre = getData(nl2br( $row['departmentId']),'department');	//Getting previous DEPARTMENT for/according to DESIGNATION
$edit_user_pre="User:".nl2br( $row_status_pre['username']).",Pass:".nl2br( $row_status_pre['password']).",FName:". nl2br( $row_status_pre['firstName'])
				.",LName:".nl2br( $row_status_pre['lastName']).",Email:".nl2br( $row_status_pre['email'])
				.",Status:".getData(nl2br( $row_status_pre['status']),'status').",User_Type:".getData(nl2br( $row_status_pre['user_type']),'userType')
				.",Department:".getData(nl2br( $row_status_pre['departmentId']),'department').",Designation:".getData(nl2br( $row_status_pre['designationID']),'designation')
				.",Emp_type:".getData(nl2br( $row_status_pre['empType']),'employeeType').",Shift:".getData(nl2br( $row_status_pre['empShift']),'shift')
				.",Appt_date:". prepareDate( $row_status_pre['appointment_date']).",Confirm_date:". prepareDate( $row_status_pre['confirmation_date'])
				.",Basic_salary:". $row_status_pre['basic_salary'];
///////////////////////////////////////////////////////

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `capmus_users` SET    `username` =  '{$_POST['username']}' ,  `password` =  '".md5($_POST['password'])."' , `firstName` =  '{$_POST['firstName']}' ,  `middleName` =  '{$_POST['middleName']}' ,  `lastName` =  '{$_POST['lastName']}' ,  `fatherName` =  '{$_POST['fatherName']}' ,  `email` =  '{$_POST['email']}' ,  `user_type` =  '{$_POST['user_type']}' ,  `gender` =  '{$_POST['gender']}' ,  `status` =  '{$_POST['status']}' ,  `phone` =  '{$_POST['phone']}' ,  `alt_phone` =  '{$_POST['alt_phone']}' ,  `skypeId` =  '{$_POST['skypeId']}' ,  `departmentId` =  '{$_POST['departmentId']}' ,  `nic` =  '{$_POST['nic']}' ,  `designationID` =  '{$_POST['designationID']}' ,  `countryId` =  '{$_POST['countryId']}' ,  `address` =  '{$_POST['address']}' ,  `empType` =  '{$_POST['empType']}' ,  `empShift` =  '{$_POST['empShift']}' , `appointment_date` =  '".prepareDate($_POST['appointment_date'])."' , `confirmation_date` =  '".prepareDate($_POST['confirmation_date'])."' , `basic_salary` =  '{$_POST['basic_salary']}' , `voice_id` =  '{$_POST['voice_id']}' , `v_password` =  '{$_POST['v_password']}' , `sip_server` =  '{$_POST['sip_server']}'  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$edit_user_new="User:".nl2br( $_POST['username']).",Pass:".nl2br( $_POST['password']).",FName:". nl2br( $_POST['firstName'])
				.",LName:".nl2br( $_POST['lastName']).",Email:".nl2br( $_POST['email'])
				.",Status:".getData(nl2br( $_POST['status']),'status').",User_Type:".getData(nl2br( $_POST['user_type']),'userType')
				.",Department:".getData(nl2br( $_POST['departmentId']),'department').",Designation:".getData(nl2br( $_POST['designationID']),'designation')
				.",Emp_type:".getData(nl2br( $_POST['empType']),'employeeType').",Shift:".getData(nl2br( $_POST['empShift']),'shift')
				.",Appt_date:". prepareDate( $_POST['appointment_date']).",Confirm_date:". prepareDate( $_POST['confirmation_date']).",Basic_salary:". $_POST['basic_salary'];
				user_log( $_SERVER['PHP_SELF'] , "EDIT_USER" , $edit_user_pre ,$edit_user_new);
///////////////////////////////////////////////////////

getMessages('edit');

} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `capmus_users` WHERE `id` = '$id' ")); 
//$department = getData(nl2br( $row['departmentId']),'department');	// Getting department from Database and then passing this variable to 
																		// designationID to get the EXACT DESIGNATION under that DEPARTMENT
?>
<form action='' method='POST' id="new_entry"> 
<div id="label">Username:</div><div id="field"><input type='text' name='username' value='<?= stripslashes($row['username']) ?>' /></div> 
<div id="label">Password:</div><div id="field"><input type='password' name='password' value='<?= stripslashes($row['password']) ?>' /></div> 
<div id="label">FirstName:</div><div id="field"><input type='text' name='firstName' value='<?= stripslashes($row['firstName']) ?>' /></div> 
<div id="label">MiddleName:</div><div id="field"><input type='text' name='middleName' value='<?= stripslashes($row['middleName']) ?>' /></div> 
<div id="label">LastName:</div><div id="field"><input type='text' name='lastName' value='<?= stripslashes($row['lastName']) ?>' /></div> 
<div id="label">FatherName:</div><div id="field"><input type='text' name='fatherName' value='<?= stripslashes($row['fatherName']) ?>' /></div> 
<div id="label">Email:</div><div id="field"><input type='text' name='email' value='<?= stripslashes($row['email']) ?>' /></div> 
<div id="label">User Type:</div><div id="field"><?php echo getList(stripslashes($row['user_type']),'user_type','userType');?> </div> 
<div id="label">Gender:</div><div id="field"><?php echo getList(stripslashes($row['gender']),'gender','gender');?></div> 
<div id="label">Status:</div><div id="field"><?php echo getList(stripslashes($row['status']),'status','status');?></div> 
<div id="label">Phone:</div><div id="field"><input type='text' name='phone' value='<?= stripslashes($row['phone']) ?>' /></div> 
<div id="label">Alt Phone:</div><div id="field"><input type='text' name='alt_phone' value='<?= stripslashes($row['alt_phone']) ?>' /></div> 
<div id="label">SkypeId:</div><div id="field"><input type='text' name='skypeId' value='<?= stripslashes($row['skypeId']) ?>' /></div> 
<div id="label">Department:</div><div id="field"><?php echo getList(stripslashes($row['departmentId']),'departmentId','department');?></div>
<div id="label">Nic:</div><div id="field"><input type='text' name='nic' value='<?= stripslashes($row['nic']) ?>' /></div> 
<div id="label">Designation:</div><div id="field"><div id=""><?php echo getList(stripslashes($row['designationID']),'designationID','designation_insert_edit');?></div></div>
<div id="label">Country:</div><div id="field"><?php echo getList(stripslashes($row['countryId']),'countryId','country');?> </div> 
<div id="label">Address:</div><div id="field"><textarea name='address'><?= stripslashes($row['address']) ?></textarea> </div>
<div id="label">Employee Type:</div><div id="field"><?php echo getList(stripslashes($row['empType']),'empType','employeeType');?></div> 
<div id="label">Employee Shift:</div><div id="field"><?php echo getList(stripslashes($row['empShift']),'empShift','shift');?> </div> 
<div id="label">Appointment date:</div><div id="field"><input type='text' name='appointment_date' value='<?= stripslashes($row['appointment_date']) ?>' class="flexy_datepicker_input"/></div> 
<div id="label">Confirmation date:</div><div id="field"><input type='text' name='confirmation_date' value='<?= stripslashes($row['confirmation_date']) ?>' class="flexy_datepicker_input"/></div>
<div id="label">Basic salary:</div><div id="field"><input type='text' name='basic_salary' value='<?= stripslashes($row['basic_salary']) ?>' /></div> 
<div id="label">Voice ID-sip:</div><div id="field"><input type='text' name='voice_id' value='<?= stripslashes($row['voice_id']) ?>' /></div> 
<div id="label">Voice Password:</div><div id="field"><input type='text' name='v_password' value='<?= stripslashes($row['v_password']) ?>' /></div> 
<div id="label">Voice IP:</div><div id="field"><input type='text' name='sip_server' value='<?= stripslashes($row['sip_server']) ?>' /></div> 


<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /><input type='hidden' value='<?php $_GET['id']?>' name='id' /> </div>
<!--<div id="designationID_index" name="designationID_index"></div>-->

</form> 
<? } 
include('include/footer.php');?> 
