<? 
include('config.php'); 
include('include/header.php');

if (isset($_GET['id']) ) {
$id = (int) $_GET['id']; 
$user_id = (int) $_GET['userId']; 
if (isset($_POST['submitted'])) {
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `campus_emp_arrears` SET  
`arrears_amount` =  '{$_POST['arrears_amount']}' ,  `empID` =  '{$_POST['teacherID']}' , 
`comments` =  '{$_POST['comments']}' ,  `date` =  '".prepareDate($_POST['date'])."' 
WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_emp_arrears` WHERE `id` = '$id' ")); 
?>
<form action='' method='POST'>  
<div id="label">Arrears Amount:</div><div id="field"><input type='number' name='arrears_amount' value='<?= stripslashes($row['arrears_amount']) ?>' /></div> 
<div id="label">Teacher:</div><div id="field"><label ><?php echo getDataList(stripslashes($row['empID']),'teacherID',3); ?> </label></div>
<div id="label">Comments:</div><div id="field"><input type='text' name='comments' value='<?= stripslashes($row['comments']) ?>' /></div> 
<div id="label">Date:</div><div id="field"><input type='text' name='date' value='<?= stripslashes($row['date']) ?>' class="flexy_datepicker_input"/></div> 
<div id="label"></div><div id="field"><input type='submit' class="button" value='Edit Row' /><input type='hidden' value='1' name='submitted'/> </div>
</form> 
<? } /* } */
include('include/footer.php');?> 
