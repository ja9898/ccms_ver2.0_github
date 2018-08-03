<? 
include('config.php');
include('include/header.php');
/* if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227 || $_SESSION['userId']==411 || $_SESSION['userId']==195 || $_SESSION['userId']==625)
{   */
$id = (int) $_GET['id'];

//Get previous values for log
/////////////////////////////////////////////////////// FOR USER LOG
$row_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$unfreeze_schedule_pre="Course:".getData( nl2br( $row_pre['courseID']),'course').",Teacher:".showUser( nl2br( $row_pre['teacherID'])).",Student:". showStudents(nl2br( $row_pre['studentID']))
				.",BKDATE:".nl2br( $row_pre['dateBooked']).",Class Days:".getData(nl2br( $row_pre['classType']),'plan').",Status:".getData(nl2br( $row_pre['std_status']),'stdStatusmo-list')
				.",Amount:".nl2br( $row_pre['dues'])
				.",Freeze_date:".nl2br( $row_pre['freeze_date']);
/////////////////////////////////////////////////////// 

//Change the values and UN-FREEZE the schedule FUNCTION //NOT HERE-NOW the STATUS from FREEZE to REGULAR
														//Will be changed under EDIT SCHEDULE
//unfreeze_schedule($id,'2',$row_pre['std_status']);

$status_old_freeze = $row_pre['std_status'];

//Get new values for log
/////////////////////////////////////////////////////// FOR USER LOG
$row_new = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$unfreeze_schedule_new="Course:".getData( nl2br( $row_new['courseID']),'course').",Teacher:".showUser( nl2br( $row_new['teacherID'])).",Student:". showStudents(nl2br( $row_new['studentID']))
				.",BKDATE:".nl2br( $row_new['dateBooked']).",Class Days:".getData(nl2br( $row_new['classType']),'plan').",Status:".getData(nl2br( $row_new['std_status']),'stdStatusmo-list')
				.",Amount:".nl2br( $row_new['dues'])
				.",UnFreeze_date:".date('Y-m-d');
/////////////////////////////////////////////////////// 


//Enter the Data in the log
//user_log( $_SERVER['PHP_SELF'] , "UNFREEZE_SCHEDULE" , $unfreeze_schedule_pre ,$unfreeze_schedule_new, "UNFREEZE");

getMessages('unfreeze_schedule','book_scheduler_manage.php');
?>

	<div  style="float:left">Redirecting...Please wait for 2 seconds...</div>
	
	<script type="text/javascript">
	//DELAY of 2 second before going to the EDIT SCHED
	setTimeout("delaylogin();",2000);
	function delaylogin()
	{
	window.location.href = 'book_scheduler_edit.php?id=' + <?php echo $id; ?> + "&status_old_freeze="+<?php echo $status_old_freeze; ?>;
	}
	</script>
	
<?
/* }
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
} */


include('include/footer.php');?> 