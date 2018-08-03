<? 
include('config.php');
include('include/header.php'); 
$id = (int) $_GET['id']; 


mysql_query("UPDATE campus_schedule SET statusPendRejAccpt=2 WHERE `id` = '$id' ") ; 
getMessages('error_reject_payment','','The Entered amount is Rejected');
?>
<?php include('include/footer.php');?>