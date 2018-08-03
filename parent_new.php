<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) {
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `campus_parent` ( `firstName` , `lastName` , `timeZoneArea` , `timeDifference`  ) VALUES(  '{$_POST['firstName']}' , '{$_POST['lastName']}' , '{$_POST['timeZoneArea']}' , '{$_POST['timeDifference']}' ) "; 
mysql_query($sql) or die(mysql_error()); 
				getMessages('add'); 
} 
?>
<form action='' method='POST'> 
<div id="label">FirstName:</div><div id="field"><input type='text' name='firstName'/></div> 
<div id="label">LastName:</div><div id="field"><input type='text' name='lastName'/> </div>
<div id="label">Time Zone Area:</div><div id="field"><?php echo getList('','timeZoneArea','timeZoneArea');?> </div>
<div id="label">Time Difference:</div><div id="field"><?php echo getList('','timeDifference','timeDifference');?> </div>
<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? include('include/footer.php'); ?>