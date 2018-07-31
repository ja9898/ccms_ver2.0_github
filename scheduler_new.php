<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `campus_timing` ( `sun` ,  `mon` ,  `tue` ,  `wed` ,  `thu` ,  `fri` ,  `sat` ,  `startTime` ,  `endTime` ,  `breakStart` ,  `breakEnd` ,  `teacherID`  ) VALUES(  '{$_POST['sun']}' ,  '{$_POST['mon']}' ,  '{$_POST['tue']}' ,  '{$_POST['wed']}' ,  '{$_POST['thu']}' ,  '{$_POST['fri']}' ,  '{$_POST['sat']}' ,  '{$_POST['startTime']}' ,  '{$_POST['endTime']}' ,  '{$_POST['breakStart']}' ,  '{$_POST['breakEnd']}' ,  '{$_POST['teacherID']}'  ) "; 
mysql_query($sql) or die(mysql_error()); 
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$add_teacher_schedule="Teacher:".showUser( nl2br( $_POST['teacherID'])).",Sun:".nl2br( $_POST['sun']).",Mon:". nl2br( $_POST['mon']).",Tue:".nl2br( $_POST['tue'])
				.",Wed:".nl2br( $_POST['wed']).",Thu:".nl2br( $_POST['thu']).",Fri:".nl2br( $_POST['fri']).",Sat:".nl2br( $_POST['sat']).",StartTime:".getData(nl2br( $_POST['startTime']),'time')
				.",EndTime:".getData(nl2br( $_POST['endTime']),'time');
				user_log( $_SERVER['PHP_SELF'] , "ADD_TEACHER_SCHEDULE" , $_SESSION['userId'] ,$add_teacher_schedule);
///////////////////////////////////////////////////////
				getMessages('add'); 
} 
?>

<form action='' method='POST'> 
<div id="label">Sunday:</div><div id="field"><?php echo getCheckbox('','sun');?></div> 
<div id="label">Monday:</div><div id="field"><?php echo getCheckbox('','mon');?> </div> 
<div id="label">Tuesday:</div><div id="field"><?php echo getCheckbox('','tue');?> </div> 
<div id="label">Wednesday:</div><div id="field"><?php echo getCheckbox('','wed');?> </div> 
<div id="label">Thursday:</div><div id="field"><?php echo getCheckbox('','thu');?> </div> 
<div id="label">Friday:</div><div id="field"><?php echo getCheckbox('','fri');?> </div> 
<div id="label">Saturday:</div><div id="field"><?php echo getCheckbox('','sat');?> </div> 
<div id="label">Start Time:</div><div id="field"><?php echo getList('','startTime','time','Start Time');?></div> 
<div id="label">End Time:</div><div id="field"><?php echo getList('','endTime','time','End Time');?> </div> 
<div id="label">Break Start:</div><div id="field"><?php echo getList('','breakStart','time','Break Start');?> </div> 
<div id="label">Break End:</div><div id="field"><?php echo getList('','breakEnd','time','Break End');?> </div> 
<div id="label">Teacher:</div><div id="field"><?php echo getDataList('','teacherID',3);?> </div> 
<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? include('include/footer.php'); ?>