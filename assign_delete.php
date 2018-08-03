<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `campus_assignment` WHERE `id` = '$id' ") ; 
getMessages('delete');
include('include/footer.php');?>