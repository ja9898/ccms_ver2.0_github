<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['tran_id']) ) { 
$id = (int) $_GET['tran_id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
//If $_POST['campus'] equals 0, Then keeping the value of $_POST['campus'] to EMPTY
if($_POST['campus']==0){
	$campus_val = 'NULL';
}
$sql = "UPDATE `campus_transaction` SET  `campus` =  ".$campus_val." , 
`agent_id` =  '{$_POST['agent_id']}' ,
`agentLeadId` =  '{$_POST['agentLeadId']}' ,
`main_agentLeadId` =  '{$_POST['main_agentLeadId']}' , 
`date` =  '".prepareDate($_POST['date'])."' , 
`dateRecieved` =  '".prepareDate($_POST['dateRecieved'])."'  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_transaction` WHERE `id` = '$id' ")); 
?>
<form action='' method='POST' id="new_entry"> 
<div id="label">Campus:</div><div id="field"><?php echo getList(stripslashes($row['campus']),'campus','campus');?></div> 
<div id="label">Agent:</div><div id="field"><?php echo getDataList(stripslashes($row['agent_id']),'agent_id',5);?></div> 
<div id="label">Agent TL:</div><div id="field"><?php echo getDataList(stripslashes($row['agentLeadId']),'agentLeadId',9);?></div> 
<div id="label">Main Agent TL:</div><div id="field"><?php echo getDataList(stripslashes($row['main_agentLeadId']),'main_agentLeadId',16);?></div> 
<div id="label">Date Received:</div><div id="field"><input type='text' name='date' class="flexy_datepicker_input" value="<?php echo stripslashes($row['date']); ?>" required /> </div>
<div id="label" style='color:Blue;'>CURRENT MONTH DUE DATE:</div><div id="field"><input type='text' name='dateRecieved' class="flexy_datepicker_input"  value="<?php echo stripslashes($row['dateRecieved']); ?>" required /></div>
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /><input type='hidden' value='<?php $_GET['id']?>' name='id' /> </div>
</form> 
<? } 
include('include/footer.php');?>