<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) {
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `campus_meeting_link` SET `teacherID` =  '{$_POST['teacherID']}'  ,  `linkID` =  '{$_POST['linkID']}' , date = '".date('Y-m-d')."'  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_meeting_link` WHERE `id` = '$id' ")); 
?>
<form action='' method='POST'>  
<div id="label">Teacher:</div><div id="field"><?php echo getDataList(stripslashes($row['teacherID']),'teacherID',3);?> </div> 
<div id="label">Meeting Link</div><div id="field"><input type="text" name="linkID" id="linkID"  value="<?php echo ($row['linkID']); ?>" /></div>
<div id="label"></div><div id="field"><input type='submit' class="button" value='Edit Row' /><input type='hidden' value='1' name='submitted'/> </div>
</form> 
<? }
include('include/footer.php');?> 
