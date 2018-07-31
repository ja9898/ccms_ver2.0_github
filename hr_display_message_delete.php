<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 

if(isset($id))
/////////////////////////////////////////////////////// NEWLY ADDED // FOR PAYMENT RECORD REPORT SPECIFIC DELETE
{
	mysql_query("DELETE FROM `campus_hr_messages` WHERE `id` = '$id' ") ; 
}
///////////////////////////////////////////////////////
getMessages('delete','hr_display_message_list.php');
include('include/footer.php');?>