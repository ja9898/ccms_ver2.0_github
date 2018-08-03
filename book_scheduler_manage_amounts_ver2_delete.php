<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 

if(isset($id))
/////////////////////////////////////////////////////// NEWLY ADDED // FOR PAYMENT RECORD REPORT SPECIFIC DELETE
{
	mysql_query("DELETE FROM `campus_schedule_ver2_list` WHERE `id` = '$id' ") ; 
}
///////////////////////////////////////////////////////
getMessages('delete','book_scheduler_manage_amounts_ver2_list.php');
include('include/footer.php');?>