<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `campus_skype` WHERE `id` = '$id' ") ; 
getMessages('delete','skype_list.php'); include('include/footer.php');?>