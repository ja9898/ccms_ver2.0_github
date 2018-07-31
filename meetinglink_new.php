<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) {
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `campus_meeting_link` ( `teacherID` , `linkID` , date  ) VALUES(  '{$_POST['teacherID']}' , '{$_POST['linkID']}' , NOW() ) "; 
mysql_query($sql) or die(mysql_error()); 
				getMessages('add'); 
} 
?>

<form action='' method='POST'> 
<div id="label">Teacher:</div><div id="field"><?php echo getDataList('','teacherID',3);?> </div> 
<div id="label">Meeting Link</div><div id="field"><input type="text" name="linkID" id="linkID" /></div>
<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? include('include/footer.php'); ?>