<? 
include('config.php'); 
include('include/header.php');

if (isset($_GET['id']) ) {
$id = (int) $_GET['id']; 
$user_id = (int) $_GET['userId']; 
if (isset($_POST['submitted'])) {
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `campus_emp_gift_fine` SET  
`gift_amount` =  '{$_POST['gift_amount']}' ,  `fine_amount` =  '{$_POST['fine_amount']}' , 
`empID` =  '{$_POST['teacherID']}' , `transactionID` =  '{$_POST['transactionID']}' , 
`comments` =  '{$_POST['comments']}' ,  `date` =  '".prepareDate($_POST['date'])."' 
WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_emp_gift_fine` WHERE `id` = '$id' ")); 
?>
<form action='' method='POST'>  
<div id="label">Gift Amount:</div><div id="field"><input type='number' name='gift_amount' value='<?= stripslashes($row['gift_amount']) ?>' /></div> 
<div id="label">Fine Amount:</div><div id="field"><input type='number' name='fine_amount' value='<?= stripslashes($row['fine_amount']) ?>' /></div> 
<div id="label">Teacher:</div><div id="field"><label ><?php echo getDataList(stripslashes($row['empID']),'teacherID',3); ?> </label></div>
<div id="label">transactionID:</div><div id="field"><input type='text' name='transactionID' value='<?= stripslashes($row['transactionID']) ?>' /></div> 
<div id="label">Comments:</div><div id="field"><input type='text' name='comments' value='<?= stripslashes($row['comments']) ?>' /></div> 
<div id="label">Date:</div><div id="field"><input type='text' name='date' value='<?= stripslashes($row['date']) ?>' class="flexy_datepicker_input"/></div> 
<div id="label"></div><div id="field"><input type='submit' class="button" value='Edit Row' /><input type='hidden' value='1' name='submitted'/> </div>
</form> 
<? } /* } */
include('include/footer.php');?> 
