<? 
include('config.php');
include('include/header.php'); 
$id = (int) $_GET['id']; 
$sch_id = (int) $_GET['sch_id'];

if($id!='' && $sch_id!=''){
mysql_query("UPDATE campus_schedule SET statusPendRejAccpt=2 , statusPendRejAccpt_User='".$_SESSION['userId']."' 
WHERE `id` = '$sch_id' ") ; 
mysql_query("UPDATE campus_transaction SET statusPendRejAccpt=2 , statusPendRejAccpt_User='".$_SESSION['userId']."' 
WHERE `id` = '$id' "); 
getMessages('error_reject_payment','','The Entered amount is Rejected');
}
?>
<?php include('include/footer.php');?>