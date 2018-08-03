<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 
if($id!=0 && $id!=''){
	mysql_query("DELETE FROM `campus_start_end_report` WHERE `id` = '$id' ") ; 
	getMessages('delete','daily_sch_ttl_month_start_end_report.php');	
}
include('include/footer.php');?>