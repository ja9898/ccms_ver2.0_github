<? 
include('config.php');
include('include/header.php'); 
$id = (int) $_GET['id']; 
$sch_id = (int) $_GET['sch_id']; 

if($id!='' && $sch_id!=''){
mysql_query("UPDATE campus_schedule SET statusPendRejAccpt=1 , statusPendRejAccpt_User='".$_SESSION['userId']."' 
WHERE `id` = '$sch_id' "); 
mysql_query("UPDATE campus_transaction SET statusPendRejAccpt=1 , statusPendRejAccpt_User='".$_SESSION['userId']."' 
WHERE `id` = '$id' "); 

getMessages('edit','','The Entered amount is Approved');
}

?>
<?php include('include/footer.php');?>