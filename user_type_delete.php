<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `campus_usertype` WHERE `id` = '$id' ") ; 
getMessages('delete','user_type_list.php');
?> 

<?php include('include/footer.php');?>