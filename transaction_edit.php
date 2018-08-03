<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `campus_transaction` SET  `transactionID` =  '{$_POST['transactionID']}' ,  `date` =  '".prepareDate($_POST['date'])."'    ,  `method` =  '{$_POST['method']}' ,  `amount` =  '{$_POST['amount']}' ,`comments`='{$_POST['comments']}' ,`courseID`='{$_POST['courseID']}' ,`operator` = '".$_SESSION['userId']."',`dateRecieved` = '".prepareDate($_POST['dateRecieved'])."' WHERE `id` = '$id' ";

 
  
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
} 
//////////////////////////////////////////////////////////////////////////////////////////////////////////  NEWLY ADDED
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_transaction` WHERE `studentID` = '$id' ")); 
$maxdate_rec=mysql_fetch_array ( mysql_query("SELECT MAX(dateRecieved) as maxdate_rec FROM campus_transaction where studentID=".$row['studentID'].""));
//////////////////////////////////////////////////////////////////////////////////////////////////////////
?>

<form action='' method='POST'> 
<div id="label">TransactionID:</div><div id="field"><input type='text' name='transactionID' value='<?= stripslashes($row['transactionID']) ?>' /></div> 
<div id="label">Date:</div><div id="field"><input type='text' name='date' class="flexy_datepicker_input" value='<?= stripslashes($row['date']) ?>' /> </div>



<div id="label">Transaction Date Received:</div><div id="field"><input type='text' name='dateRecieved' class="flexy_datepicker_input" value='<?= stripslashes($maxdate_rec['maxdate_rec']) ?>'/> </div>

<!--<div id="label">StudentID:</div><div id="field"><?php echo getDataList(stripslashes($row['studentID']),'studentID',4);?> </div>-->
<!--



-->
<div id="label">Course:</div><div id="field"><?php echo getScheduleList(stripslashes($row['studentID']));?> </div>
<div id="label">Method:</div><div id="field"><input type='text' name='method' value='<?= stripslashes($row['method']) ?>' /> </div>
<div id="label">Amount:</div><div id="field"><input type='text' name='amount' value='<?= stripslashes($row['amount']) ?>' /> </div>
<div id="label">Comments:</div><div id="field"><textarea name='comments'><?php echo stripslashes($row['comments']);?></textarea></div> 
<div id="label"></div><div id="field"><input type='submit' class='button' value='Edit Row' /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<? } ?> 
<? 
include('include/footer.php');?>