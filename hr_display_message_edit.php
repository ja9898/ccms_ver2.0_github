<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `campus_hr_messages` SET   `heading` =  '{$_POST['heading']}' ,  `message` =  '{$_POST['message']}' ,  `active_deactive` =  '{$_POST['status']}' , `endDate` =  '".prepareDate($_POST['endDate'])."'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 

getMessages('edit');

} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_hr_messages` WHERE `id` = '$id' ")); 
?>
<form action='' method='POST' id="new_entry"> 
<div id="label">Heading:</div><div id="field"><input type='text' name='heading' required value='<?= stripslashes($row['heading']) ?>' /></div> 
<div id="label">Message:</div><div id="field"><textarea name='message'><?= stripslashes($row['message']) ?></textarea> </div> 
<div id="label">Status:</div><div id="field"><?php echo getList(stripslashes($row['active_deactive']),'status','status');?></div> 
<div id="label">End Date:</div><div id="field"><input type="text"  name="endDate"  id="endDate" required value="<?php echo $row['endDate']; ?>"  class="flexy_datepicker_input"/></div>


<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /><input type='hidden' value='<?php $_GET['id']?>' name='id' /> </div>
</form> 
<? } 
include('include/footer.php');?> 
