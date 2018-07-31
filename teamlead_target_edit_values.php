<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id'];

if (isset($_POST['submitted'])) { 


if($_POST['teamLeadID']!=0)
{
$sql = "UPDATE `campus_target_table` SET  `LeadId` =  '".$_POST['teamLeadID']."'  , `amount` =  '{$_POST['amount']}' , `fromDate` =  '".prepareDate($_POST['fromDate'])."' , `toDate` =  '".prepareDate($_POST['toDate'])."'  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 


getMessages('edit');
}
else
{
getMessages('error');
}
} 

$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_target_table` WHERE `id` = '$id' ")); 


?>

 
<form action='' method='POST'>
<div id="label">Teamlead:</div><div id="field"><?php echo getDataList(stripslashes($row['LeadId']),'teamLeadID',8,$_SESSION['userId']);?> </div> 
<div id="label">Amount:</div><div id="field"><input type="text"  name="amount"  id="amount" value="<?php echo stripslashes($row['amount']); ?>" /></div>
<div id="label">From Date:</div><div id="field"><input type="text" class="flexy_datepicker_input"  name="fromDate"  id="fromDate" value="<?php echo stripslashes($row['fromDate']); ?>" /></div>
<div id="label">To Date:</div><div id="field"><input type="text" class="flexy_datepicker_input"  name="toDate"  id="toDate" value="<?php echo stripslashes($row['toDate']); ?>" /></div>



<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? } 
include('include/footer.php');?> 
