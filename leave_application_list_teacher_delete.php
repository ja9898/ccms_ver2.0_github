<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 

if(isset($id))
/////////////////////////////////////////////////////// NEWLY ADDED // FOR PAYMENT RECORD REPORT SPECIFIC DELETE
{
	mysql_query("DELETE FROM `campus_empleave` WHERE `id` = '$id' ") ; 
}
///////////////////////////////////////////////////////
getMessages('delete','leave_application_list_teacher.php');
include('include/footer.php');?>