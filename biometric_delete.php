<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 

if(isset($id))
/////////////////////////////////////////////////////// NEWLY ADDED // FOR PAYMENT RECORD REPORT SPECIFIC DELETE
{
	mysql_query("DELETE FROM `campus_attendance_employee` WHERE `id` = '$id' ") ; 
}
///////////////////////////////////////////////////////
getMessages('delete','biometric_list.php');
include('include/footer.php');?>