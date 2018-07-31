<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `campus_skype` ( `skype` ,  `password` ,  `status`  ) VALUES(  '{$_POST['skype']}' ,  '{$_POST['password']}' ,  '{$_POST['status']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('add'); 
} 
?>

<form action='' method='POST'> 
<div id="label">Skype:</div><div id="field"><?php echo getInput(stripslashes($_POST['skype']),'skype');?></div>
<div id="label">Password:</div><div id="field"><?php echo getInput(stripslashes($_POST['password']),'password');?></div>
<div id="label">Status:</div><div id="field"><?php echo getList(stripslashes($_POST['status']) ,'status','skype_status')?> </div>
<div id="label"></div><div id="field"><input type='submit' value='Add Row' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<? include('include/footer.php');?>