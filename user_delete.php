<? 
include('config.php');
include('include/header.php'); 
$id = (int) $_GET['id']; 
$usertype=getUserType($id);
if($usertype==3){
removeCourse($id);
removeTimings($id);
}
mysql_query("DELETE FROM `capmus_users` WHERE `id` = '$id' ") ; 
getMessages('delete','user_list.php');
?>
<?php include('include/footer.php');?>