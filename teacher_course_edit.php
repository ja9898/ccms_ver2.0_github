<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) { 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `capmus_teacher_course` WHERE `id` = '$id' "));
$edit_teacher_course_pre="ID:".nl2br( $row_status_pre['id']).",Teacher:".showUser( nl2br( $row_status_pre['teacherID'])).",Course:".showCourse( nl2br( $row_status_pre['courseID']));
///////////////////////////////////////////////////////

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "UPDATE `capmus_teacher_course` SET  `courseID` =  '{$_POST['courseID']}'   ,  `teacherID` =  '{$_POST['teacherID']}'   WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 



/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$edit_teacher_course_new="Teacher:".showUser( nl2br( $_POST['teacherID'])).",Course:".getData( nl2br($_POST['courseID']),'course');
				user_log( $_SERVER['PHP_SELF'] , "EDIT_TEACHER_COURSE" ,$edit_teacher_course_pre,$edit_teacher_course_new);
///////////////////////////////////////////////////////
echo $_POST['courseID'];
getMessages('edit');
} 
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `capmus_teacher_course` WHERE `id` = '$id' ")); 

?>

<form action='' method='POST'>  
<!--<div id="label">Sunday:</div><div id="field"><//?php echo getCheckbox(stripslashes($row['sun']),'sun');?></div> 
<div id="label">Monday:</div><div id="field"><//?php echo getCheckbox(stripslashes($row['mon']),'mon');?> </div> 
<div id="label">Tuesday:</div><div id="field"><//?php echo getCheckbox(stripslashes($row['tue']),'tue');?> </div> 
<div id="label">Wednesday:</div><div id="field"><//?php echo getCheckbox(stripslashes($row['wen']),'wen');?> </div> 
<div id="label">Thursday:</div><div id="field"><//?php echo getCheckbox(stripslashes($row['thu']),'thu');?> </div> 
<div id="label">Friday:</div><div id="field"><//?php echo getCheckbox(stripslashes($row['fri']),'fri');?> </div> 
<div id="label">Saturday:</div><div id="field"><//?php echo getCheckbox(stripslashes($row['sat']),'sat');?> </div> 
<div id="label">Start Time:</div><div id="field"><//?php echo getList(stripslashes($row['startTime']),'startTime','time','Start Time');?></div> 
<div id="label">End Time:</div><div id="field"><//?php echo getList(stripslashes($row['endTime']),'endTime','time','End Time');?> </div> 
<div id="label">Break Start:</div><div id="field"><//?php echo getList(stripslashes($row['breakStart']),'breakStart','time','Break Start');?> </div> 
<div id="label">Break End:</div><div id="field"><//?php echo getList(stripslashes($row['breakEnd']),'breakEnd','time','Break End');?> </div> -->
<div id="label">Course:</div><div id="field"><?php echo getCheckboxList(stripslashes($row['courseID']),'courseID','course');?></div>  
<div id="label">Teacher:</div><div id="field"><?php echo getDataList(stripslashes($row['teacherID']),'teacherID',3);?> </div> 
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' /><input type='hidden' value='1' name='submitted'/> </div>
</form> 
<? } 
include('include/footer.php');?> 
