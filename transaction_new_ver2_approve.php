<? 
include('config.php');
include('include/header.php'); 
$id = (int) $_GET['id']; 


mysql_query("UPDATE campus_schedule SET statusPendRejAccpt=1 WHERE `id` = '$id' ") ; 
getMessages('edit','','The Entered amount is Approved');
?>
<?php include('include/footer.php');?>