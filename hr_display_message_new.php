<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) {
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `campus_hr_messages` (   `heading` ,  `message` ,  `active_deactive` , `endDate` ) VALUES(    '{$_POST['heading']}' ,  '{$_POST['message']}' ,  '{$_POST['status']}' , '".prepareDate($_POST['endDate'])."' ) "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('add'); 
} 
?>

<form action='' method='POST' id="new_entry"> 
<div id="label">Heading:</div><div id="field"><input type='text' name='heading' required/></div> 
<div id="label">Message:</div><div id="field"><textarea name='message' required></textarea> </div>
<div id="label">Status:</div><div id="field"><?php echo getList('','status','status');?> </div>
<div id="label">End Date:</div><div id="field"><input type="text"  name="endDate"  id="endDate" required value="<?php echo $_POST['endDate']; ?>"  class="flexy_datepicker_input"/></div>

<!--<div id="label">Message ACTIVE/DEACTIVE:</div><div id="field" style="color:red"><?php //echo getCheckbox($_POST['active_deactive'],'active_deactive'); ?>(Check to Make this Message ACTIVE, Uncheck for DEACTIVE)</div>-->


<div id="label">&nbsp;</div><div id="field"><input type='submit' class="button" value='Add Row' /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<?php include('include/footer.php');?>