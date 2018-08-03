<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id'];
$slot=makeSlot($id); 
$_POST['scheduleEdit']=$id;
if (isset($_POST['submitted'])) { 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG //GETTING PRE_VALUE
$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$edit_schedule_ver2_pre="Teacher:".showUser( nl2br( $row_status_pre['teacherID'])).",Student:". showStudents(nl2br( $row_status_pre['studentID']))
					.",SDATE:".prepareDate($row_status_pre['startDate']).",EDATE:".prepareDate($row_status_pre['endDate'])
					.",SUDATE:".prepareDate($row_status_pre['duedate']).",PAYDATE:".prepareDate($row_status_pre['paydate'])
					.",Amount:".nl2br( $row_status_pre['dues']).",Discount:". nl2br( $row_status_pre['discount'])
					.",STARTTIME:".nl2br( $row_status_pre['startTime']).",ENDTIME:".nl2br( $row_status_pre['endTime']).",status_dead:".nl2br( $row_status_pre['status_dead']);
///////////////////////////////////////////////////////

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
if(!isset($_POST['teacherID']))
{
	$_POST['teacherID']=$_POST['prevteacherID'];
	} 
if(!empty($_POST['teacherID']) && !empty($_POST['studentID'])  ){
	
$sql = "UPDATE `campus_schedule` SET  `currency_array` =  '".$_POST['currency_array']."' , `dues_original` =  '".$_POST['dues_original']."' , `dues_gbp` =  '".$_POST['dues_gbp']."' , `dues` =  '".$_POST['dues']."'  , `discount` =  '{$_POST['discount']}' , `duedate` =  '".prepareDate($_POST['duedate'])."' , `paydate` =  '".prepareDate($_POST['paydate'])."' , `startTime` =  '".$_POST['startTime']."' ,`endTime` =  '".$_POST['endTime']."' , `std_status_old` =  '".$_POST['std_status_old']."' , `std_status` =  '".$_POST['std_status']."'  WHERE `id` = '$id' "; 
//, `status_dead` =  '".$_POST['status_dead']."' , `dead_date` =  '".$_POST['dead_date']."' , `comments_dead` =  '".$_POST['comments_dead']."'
mysql_query($sql) or die(mysql_error()); 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG //GETTING PRE_VALUE
$edit_schedule_ver2_new="Teacher:".showUser( nl2br( $_POST['teacherID'])).",Student:". showStudents(nl2br( $_POST['studentID']))
					.",SDATE:".prepareDate($_POST['startDate']).",EDATE:".prepareDate($_POST['endDate'])
					.",SUDATE:".prepareDate($_POST['duedate']).",PAYDATE:".prepareDate($_POST['paydate'])
					.",Amount:".nl2br( $_POST['dues']).",Discount:". nl2br( $_POST['discount'])
					.",STARTTIME:".nl2br( $_POST['startTime']).",ENDTIME:".nl2br( $_POST['endTime']).",status_dead:".nl2br( $_POST['status_dead']);
user_log( $_SERVER['PHP_SELF'] , "EDIT_SCHEDULE_VER2" , $edit_schedule_ver2_pre ,$edit_schedule_ver2_new);

///////////////////////////////////////////////////////


//////////////////////////////////////////////////////////
$systemdate = systemDate();
//Getting Lead ID[TEAMLEAD NAME]
$get_LeadId = "SELECT * FROM capmus_users WHERE id='".$_POST['teacherID']."' ";
$row_LeadId = mysql_fetch_array(mysql_query($get_LeadId));
///////////////////////////////
// Query to populate the MANAGE SCHEDULE VER 2 Amendments
$sql_pop_ver2_list="INSERT INTO campus_schedule_ver2_list(teacherID, studentID, dues, dues_new, duedate, paydate, 
paydate_new , operator, check_done, LeadId, ccms_date) VALUES('".$_POST['teacherID']."' , '".$_POST['studentID']."' , 
'".$row_status_pre['dues']."' , '".$_POST['dues']."' , '".prepareDate($_POST['duedate'])."' , 
'".prepareDate($row_status_pre['paydate'])."' , '".prepareDate($_POST['paydate'])."' , 
'".$_SESSION['userId']."' , '1', '".$row_LeadId['LeadId']."', '".prepareDate($systemdate)."')";
mysql_query($sql_pop_ver2_list) or die(mysql_error()); 
echo "<script>alert('Record Inserted in Another table for history.');</script>";
echo "<script>window.location.href = 'book_scheduler_manage_amounts_ver2.php'</script>";
//////////////////////////////////////////////////////////




getMessages('edit');
}
else
{
getMessages('error');
}
} 

$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' ")); 


?>

 
 
<!--<form action='' method='POST'> 
<div id="label">StartTime:</div><div id="field"><?php //echo getList(stripslashes($row['startTime']),'startTime','time','Start Time');?> </div> 
<div id="label">EndTime:</div><div id="field"><?php //echo getList(stripslashes($row['endTime']),'endTime','time','Start Time');?> </div> 
<div id="label">StartDate:</div><div id="field"><?php //echo getInput(stripslashes($row['startDate']),'startDate','class=flexy_datepicker_input');?></div> 
<div id="label">EndDate:</div><div id="field"><?php //echo getInput(stripslashes($row['endDate']),'endDate','class=flexy_datepicker_input');?> </div> 
<div id="label">TeacherID:</div><div id="field"><?php //echo getDataList(stripslashes($row['teacherID']),'teacherID',3);?> </div> 
<div id="label">StudentID:</div><div id="field"><?php //echo getDataList(stripslashes($row['studentID']),'studentID',4);?> </div>   
<div id="label">ClassType:</div><div id="field"><?php //echo getList(stripslashes($row['classType']),'classType','plan','Select Class Type');?></div> 
<div id="label">Status:</div><div id="field"><?php //echo getList(stripslashes($row['status']),'status','status','');?> </div> 
<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
</form> -->
<form action='' method='POST'>
<div id="label">Student:</div><div id="field"><?php echo getDataList(stripslashes($row['studentID']),'studentID',4,$_SESSION['userId']);?> </div> 
<div id="label">Teacher:</div><div id="field"><div id="availableTeachers"></div>&nbsp;
<input type="hidden"  name="prevteacherID"  id="prevteacherID" value="<?php echo stripslashes($row['teacherID']); ?>" />
<?php echo showUser(stripslashes($row['teacherID']));?> </div>

<div id="label">SignUp Date:</div><div id="field" style='color:red;'><input type="text" class=""  name="duedate"  id="duedate" readonly="readonly" value="<?php echo stripslashes($row['duedate']); ?>" /></div>
<div id="label">Paying Date:</div><div id="field" style='color:red;'><input type="text" class="flexy_datepicker_input"  name="paydate"  id="paydate" value="<?php echo stripslashes($row['paydate']); ?>" />(EMPTY to convert to Trial[Revert])</div>

<div id="label">Currency Array:</div><div id="field" style='color:red;'><input type="text"  name="currency_array"  id="currency_array" value="<?php echo stripslashes($row['currency_array']); ?>" />(Enter 0 to convert to Trial[Revert])</div>
<div id="label">Dues Original:</div><div id="field" style='color:red;'><input type="text"  name="dues_original"  id="dues_original" value="<?php echo stripslashes($row['dues_original']); ?>" />(Enter 0 to convert to Trial[Revert])</div>
<div id="label">Dues GBP:</div><div id="field" style='color:red;'><input type="text"  name="dues_gbp"  id="dues_gbp" value="<?php echo stripslashes($row['dues_gbp']); ?>" />(Enter 0 to convert to Trial[Revert])</div>
<div id="label">Total Dues:</div><div id="field" style='color:red;'><input type="text"  name="dues"  id="dues" value="<?php echo stripslashes($row['dues']); ?>" />(Enter 0 to convert to Trial[Revert])</div>

<div id="label">Status OLD:</div><div id="field" style='color:brown;'><input type="text"  name="std_status_old"  id="std_status_old" value="<?php echo stripslashes($row['std_status_old']); ?>" />(Enter 0 to convert to Trial[Revert])</div>
<div id="label">Status:</div><div id="field" style='color:brown;'><input type="text"  name="std_status"  id="std_status" value="<?php echo stripslashes($row['std_status']); ?>" />(Enter 1 to convert to Trial[Revert])</div>

<div id="label">Discount:</div><div id="field"><input type="text" id="discount" name="discount" readonly="readonly" value="<?php echo stripslashes($row['discount']); ?>"/> </div>


<div id="label">StartTime(ReadOnly):</div><div id="field"><input type="text"  name="startTime"  id="startTime" readonly="readonly" value="<?php echo stripslashes($row['startTime']); ?>" /></div>
<div id="label">EndTime(ReadOnly):</div><div id="field"><input type="text"  name="endTime"  id="endTime" readonly="readonly" value="<?php echo stripslashes($row['endTime']); ?>" /></div>
<!--<div id="label">Status Dead:</div><div id="field"><input type="text" name="status_dead" id="status_dead" value="<?php //echo stripslashes($row['status_dead']); ?>" /></div>
<div id="label">Dead Date:</div><div id="field"><input type="text" class="" name="dead_date" id="dead_date" value="<?php //echo stripslashes($row['dead_date']); ?>" /></div>
<div id="label">Dead comments:</div><div id="field"><input type="text" name="comments_dead" id="comments_dead" value="<?php //echo stripslashes($row['comments_dead']); ?>" /></div>-->


<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? } 
include('include/footer.php');?> 
