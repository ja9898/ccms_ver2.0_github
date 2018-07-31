<? 
include('config.php');
include('include/header.php'); 
$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `campus_meeting_link` WHERE `id` = '$id' ") ; 
getMessages('delete','meetinglink_list.php');?>
<? include('include/footer.php'); ?>