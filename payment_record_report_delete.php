<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['tran_id']; 

if(isset($id))
/////////////////////////////////////////////////////// NEWLY ADDED // FOR PAYMENT RECORD REPORT SPECIFIC DELETE
{
	mysql_query("DELETE FROM `campus_transaction` WHERE `id` = '$id' ") ; 
}
///////////////////////////////////////////////////////
getMessages('delete','payment_record_report_test.php');
include('include/footer.php');?>