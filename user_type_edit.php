<? 
include('config.php');
include('include/header.php'); 
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `campus_usertype` SET  `typeName` =  '{$_POST['typeName']}' ,  `typeDesc` =  '{$_POST['typeDesc']}' ,  `typeDate` =  '{$_POST['typeDate']}'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_usertype` WHERE `id` = '$id' ")); 
?>

<form action='' method='POST'> 
<div id="label">TypeName:</div><div id="field"><input type='text' name='typeName' value='<?= stripslashes($row['typeName']) ?>' /></div>
<div id="label">TypeDesc:</div><div id="field"><textarea name='typeDesc'><?= stripslashes($row['typeDesc']) ?></textarea> </div>
<div id="label">TypeDate:</div><div id="field"><input type='text' name='typeDate' class="flexy_datepicker_input" value='<?= stripslashes($row['typeDate']) ?>' /></div> 
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<? } 
include('include/footer.php');?> 
