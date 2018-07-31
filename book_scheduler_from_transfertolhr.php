<? 
include('config.php');
include('include/header.php');  
$id = (int) $_GET['id'];

//Get previous values for log
/////////////////////////////////////////////////////// FOR USER LOG
$row_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
//$from_transfertolhr_schedule_pre="Course:".getData( nl2br( $row_pre['courseID']),'course').",Teacher:".showUser( nl2br( $row_pre['teacherID'])).",Student:". showStudents(nl2br( $row_pre['studentID']))
//				.",BKDATE:".nl2br( $row_pre['dateBooked']).",Class Days:".getData(nl2br( $row_pre['classType']),'plan').",Status:".getData(nl2br( $row_pre['std_status']),'stdStatusmo-list')
//				.",Amount:".nl2br( $row_pre['dues'])
//				.",TransfertoLHR_date:".nl2br( $row_pre['transfertolhr_date']);
/////////////////////////////////////////////////////// 

//Change the values and UN-FREEZE the schedule FUNCTION
//from_transfertolhr_schedule($id,'',$row_pre['std_status']);

$status_old_from_lhr = $row_pre['std_status'];

//Get new values for log
/////////////////////////////////////////////////////// FOR USER LOG
//$row_new = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
//$from_transfertolhr_schedule_new="Course:".getData( nl2br( $row_new['courseID']),'course').",Teacher:".showUser( nl2br( $row_new['teacherID'])).",Student:". showStudents(nl2br( $row_new['studentID']))
//				.",BKDATE:".nl2br( $row_new['dateBooked']).",Class Days:".getData(nl2br( $row_new['classType']),'plan').",Status:".getData(nl2br( $row_new['std_status']),'stdStatusmo-list')
//				.",Amount:".nl2br( $row_new['dues'])
//				.",From_TransfertoLHR_date:".date('Y-m-d');
/////////////////////////////////////////////////////// 


//Enter the Data in the log
//user_log( $_SERVER['PHP_SELF'] , "From_TransfertoLHR_SCHEDULE" , $from_transfertolhr_schedule_pre ,$from_transfertolhr_schedule_new, "From_TransfertoLHR");

getMessages('from_transfertolhr_schedule','book_scheduler_manage.php');
?>

	<div  style="float:left">Redirecting...Please wait for 2 seconds...</div>
	
	<script type="text/javascript">
	//DELAY of 2 second before going to the EDIT SCHED
	setTimeout("delaylogin();",2000);
	function delaylogin()
	{
	window.location.href = 'book_scheduler_edit.php?id=' + <?php echo $id; ?> + "&status_old_from_lhr="+<?php echo $status_old_from_lhr; ?>;
	}
	</script>
	
<?include('include/footer.php');?> 