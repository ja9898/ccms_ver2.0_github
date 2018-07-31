<? 
include('config.php'); 
include('include/header.php');

if ( isset($_POST['submitted'])) {
	
if($_POST['teacherID']!=0 || $_POST['teacherID']!=''){
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `campus_emp_gift_fine` (   `gift_amount` ,  `fine_amount` ,  `empID` ,  `transactionID` , 
`comments` , `date`) 
VALUES( '{$_POST['gift_amount']}' , '{$_POST['fine_amount']}' , '{$_POST['teacherID']}' , '{$_POST['transactionID']}' , 
'{$_POST['comments']}' , '".prepareDate($_POST['date'])."' ) "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('add');
}
 
else
{
	getMessages('error');
}
}
?>
<form action='' method='POST' id="new_entry"> 
<div id="label">Gift Amount:</div><div id="field"><input type='number' name='gift_amount'/> </div>
<div id="label">Fine Amount:</div><div id="field"><input type='number' name='fine_amount'/> </div>
<div id="label">Teacher:</div><div id="field"><?php echo getDataList('','teacherID',3);?> </div>
<div id="label">transactionID:</div><div id="field"><input type='number' name='transactionID'/> </div>
<div id="label">Comments:</div><div id="field"><input type='text' name='comments'/></div> 
<div id="label">Date:</div><div id="field"><input type="text"  name="date"  id="date"  class="flexy_datepicker_input"/></div>
<div id="label">&nbsp;</div><div id="field"><input type='submit' class="button" value='Add Row' /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<?php 
include('include/footer.php');?>