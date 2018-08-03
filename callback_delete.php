<? 
include('config.php');
include('include/header.php');

$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `campus_callbacks` WHERE `id` = '$id' ") ; 
getMessages('delete','callback_list.php');

include('include/footer.php');
?> 

