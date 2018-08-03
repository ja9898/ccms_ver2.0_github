<? 
include('config.php');
include('include/header.php'); 
$id = (int) $_GET['id']; 
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row = mysql_fetch_array( mysql_query(" SELECT * FROM campus_timing WHERE id='$id' ")) or die(mysql_error());
$delete_teacher_schedule="ID:".nl2br( $row['id']).",Teacher:".showUser( nl2br( $row['teacherID'])).",Sun:".nl2br( $row['sun']).",Mon:". nl2br( $row['mon']).",Tue:".nl2br( $row['tue'])
				.",Wed:".nl2br( $row['wed']).",Thu:".nl2br( $row['thu']).",Fri:".nl2br( $row['fri']).",Sat:".nl2br( $row['sat']).",StartTime".getData(nl2br( $row['startTime']),'time')
				.",EndTime:".getData(nl2br( $row['endTime']),'time');
				user_log( $_SERVER['PHP_SELF'] , "DELETE_TEACHER_SCHEDULE" , $_SESSION['userId'] ,$delete_teacher_schedule);
///////////////////////////////////////////////////////

mysql_query("DELETE FROM `campus_timing` WHERE `id` = '$id' ") ; 
getMessages('delete','scheduler_list.php');?>
<? include('include/footer.php'); ?>