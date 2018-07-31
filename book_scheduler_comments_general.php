<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id'];
//$slot=makeSlot($id); 
//$_POST['scheduleEdit']=$id;
if (isset($_POST['submitted'])) { 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG //GETTING PRE_VALUE
/*$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$edit_schedule_pre="Course:".getData( nl2br( $row_status_pre['courseID']),'course').",Teacher:".showUser( nl2br( $row_status_pre['teacherID'])).",Student:". showStudents(nl2br( $row_status_pre['studentID']))
				.",BKDATE:".nl2br( $row_status_pre['dateBooked']).",Class Days:".getData(nl2br( $row_status_pre['classType']),'plan').",Status:".getData(nl2br( $row_status_pre['std_status']),'stdStatusmo-list')
				.",SDATE:".prepareDate($row_status_pre['startDate']).",EDATE:".prepareDate($row_status_pre['endDate']).",SUDATE:".prepareDate($row_status_pre['duedate']).",PAYDATE:".prepareDate($row_status_pre['paydate'])
				.",Amount:".nl2br( $row_status_pre['dues'])
				.",START_TIME:".nl2br( $row_status_pre['startTime']).",END_TIME:".nl2br( $row_status_pre['endTime'])
				.",Ref:".showUser(nl2br( $row_status_pre['reference']));*/
///////////////////////////////////////////////////////

if(!empty($_POST['comments_general']) ){

$operator_name = showUser( nl2br( $_SESSION['userId']));

//Checking that comments_general is NULL
$comments_gen_NULL = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' ")); 
if($comments_gen_NULL['comments_general']==NULL)
{
$sql = "UPDATE `campus_schedule` SET  `comments_general` ='\r\nOperator:{$operator_name} - Comments : {$_POST['comments_general']}\r\n'  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
}
else
{
$sql = "UPDATE `campus_schedule` SET  `comments_general` =concat(comments_general ,'\r\nOperator:{$operator_name} - Comments : {$_POST['comments_general']}\r\n')  WHERE `id` = '$id' "; 
mysql_query($sql) or die(mysql_error()); 
}
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG //PUTTING-INSERTING NEW_VALUE
/*$row_status_new = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$edit_schedule_new="Course:".getData( nl2br( $_POST['courseID']),'course').",Teacher:".showUser( nl2br( $_POST['teacherID'])).",Student:". showStudents(nl2br( $_POST['studentID']))
				.",BKDATE:".nl2br( $row_status_pre['dateBooked']).",Class Days:".getData(nl2br( $_POST['classType']),'plan').",Status:".getData(nl2br( $row_status_new['std_status']),'stdStatusmo-list')
				.",SDATE:".prepareDate($_POST['startDate']).",EDATE:".prepareDate($_POST['endDate']).",SUDATE:".prepareDate($_POST['duedate']).",PAYDATE:".prepareDate($_POST['paydate'])
				.",Amount:".nl2br( $_POST['dues'])
				.",START_TIME:".nl2br( $_POST['startTime']).",END_TIME:".nl2br( $_POST['endTime'])
				.",Ref:".showUser(nl2br( $_POST['reference']));
user_log( $_SERVER['PHP_SELF'] , "EDIT_SCHEDULE" , $edit_schedule_pre ,$edit_schedule_new);*/

///////////////////////////////////////////////////////

getMessages('comments_general');

}
else
{
getMessages('error');
}
} 

$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' ")); 



?>

 
 
<!--<form action='' method='POST'> 
<div id="label">StartTime:</div><div id="field"><?php echo getList(stripslashes($row['startTime']),'startTime','time','Start Time');?> </div> 
<div id="label">EndTime:</div><div id="field"><?php echo getList(stripslashes($row['endTime']),'endTime','time','Start Time');?> </div> 
<div id="label">StartDate:</div><div id="field"><?php echo getInput(stripslashes($row['startDate']),'startDate','class=flexy_datepicker_input');?></div> 
<div id="label">EndDate:</div><div id="field"><?php echo getInput(stripslashes($row['endDate']),'endDate','class=flexy_datepicker_input');?> </div> 
<div id="label">TeacherID:</div><div id="field"><?php echo getDataList(stripslashes($row['teacherID']),'teacherID',3);?> </div> 
<div id="label">StudentID:</div><div id="field"><?php echo getDataList(stripslashes($row['studentID']),'studentID',4);?> </div>   
<div id="label">ClassType:</div><div id="field"><?php echo getList(stripslashes($row['classType']),'classType','plan','Select Class Type');?></div> 
<div id="label">Status:</div><div id="field"><?php echo getList(stripslashes($row['status']),'status','status','');?> </div> 
<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
</form> -->
<form action='' method='POST' onsubmit="">

<div id="label">Comments Submitted(READ ONLY):</div><div id="field"><textarea readonly name='comments_general_readonly'><?php echo stripslashes($row['comments_general']);?></textarea></div> 

<div id="label">Comments General:</div><div id="field"><textarea name='comments_general'></textarea></div>  
 
<div id="label"></div><div id="field"><input type='submit' value='Submit comments for this schedule' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? } 
include('include/footer.php');?> 
