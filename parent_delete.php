<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 

if(isset($id))
/////////////////////////////////////////////////////// NEWLY ADDED // FOR PAYMENT RECORD REPORT SPECIFIC DELETE
{
	mysql_query("DELETE FROM `campus_parent` WHERE `id` = '$id' ") ; 
}
///////////////////////////////////////////////////////
getMessages('delete','parent_list.php');
include('include/footer.php');?>