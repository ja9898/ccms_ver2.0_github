<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) { 

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
echo $sql = "INSERT INTO `campus_usertype` ( `typeName` ,  `typeDesc` ,  `typeDate`  ) VALUES(  '{$_POST['typeName']}' ,  '{$_POST['typeDesc']}' ,  '".prepareDateTime($_POST['typeDate'])."'  ) "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('add'); 
} 

?>

<form action='' method='POST'> 
<div id="label">Name:</div><div id="field"><input type='text' name='typeName'/> </div>
<div id="label">Description:</div><div id="field"><textarea name='typeDesc'></textarea></div> 
<div id="label">Date:</div><div id="field"><input type='text' name='typeDate' value="<?=date('Y-m-d');?>" class='flexy_datepicker_input'/></div> 
<div id="label"></div><div id="field"><input type='submit' value='Add Row' class="button" /><input type='hidden' value='1' name='submitted' /></div> 
</form> 
<? include('include/footer.php');?>