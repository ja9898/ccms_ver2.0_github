<? 
include('config.php'); 
include('include/header.php');
if(isset($_GET['id']))
{
$id = (int) $_GET['id']; 
mysql_query("DELETE FROM `campus_voice_ext` WHERE `id` = '$id' ") ; 
getMessages('delete','ext_list.php');
}
else{
	getMessages('error');
}

include('include/footer.php');?>