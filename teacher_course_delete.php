<? 
include('config.php');
include('include/header.php'); 
$id = (int) $_GET['id']; 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row= mysql_fetch_array ( mysql_query("SELECT * FROM `capmus_teacher_course` WHERE `id` = '$id' "));
$delete_teacher_course="ID:".nl2br( $row['id']).",Teacher:".showUser( nl2br( $row['teacherID'])).",Course:".getData( nl2br( $row['courseID']),'course');
user_log( $_SERVER['PHP_SELF'] , "DELETE_TEACHER_COURSE" , $_SESSION['userId'] ,$delete_teacher_course);
///////////////////////////////////////////////////////

mysql_query("DELETE FROM `capmus_teacher_course` WHERE `id` = '$id' ") ; 
getMessages('delete','teacher_course_list.php');?>
<? include('include/footer.php'); ?>