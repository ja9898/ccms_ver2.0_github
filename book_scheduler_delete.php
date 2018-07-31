<? 
include('config.php');
include('include/header.php');  
$id = (int) $_GET['id']; 
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row = mysql_fetch_array( mysql_query(" SELECT * FROM campus_schedule WHERE id='$id' ")) or die(mysql_error());
$delete_schedule="Course:".getData( nl2br( $row['courseID']),'course').",Teacher:".showUser( nl2br( $row['teacherID'])).",Student:". showStudents(nl2br( $row['studentID']))
				.",BKDATE:".nl2br( $row['dateBooked']).",Class Days:".getData(nl2br( $row['classType']),'plan').",Status:".getData(nl2br( $row['std_status']),'stdStatusmo-list')
				.",SDATE:".prepareDate($row['startDate']).",EDATE:".prepareDate($row['endDate']).",SUDATE:".prepareDate($row['duedate']).",Amount:".nl2br( $row['dues']);

user_log( $_SERVER['PHP_SELF'] , "DELETE_SCHEDULE" , $_SESSION['userId'] ,$delete_schedule);

///////////////////////////////////////////////////////
mysql_query("DELETE FROM `campus_schedule` WHERE `id` = '$id' ") ; 
getMessages('delete','book_scheduler_manage.php');
include('include/footer.php');?> 