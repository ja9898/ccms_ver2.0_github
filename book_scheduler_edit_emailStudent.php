<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id'];

if (isset($_POST['submitted'])) { 

if($_POST['emailStudent']!=''){
	
$sql = "UPDATE `campus_schedule` SET  `emailStudent` =  '".$_POST['emailStudent']."'   WHERE `id` = '$id' "; 
//, `status_dead` =  '".$_POST['status_dead']."' , `dead_date` =  '".$_POST['dead_date']."' , `comments_dead` =  '".$_POST['comments_dead']."'
mysql_query($sql) or die(mysql_error()); 


getMessages('edit');
}
else
{
getMessages('error');
}
} 

$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' ")); 


?>
<form action='' method='POST'>
<div id="label">Email Student[No Email-0 , Send Email-1]:</div><div id="field"><input type="text"  name="emailStudent"  id="emailStudent"  value="<?php echo $row['emailStudent']; ?>" /></div>
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? } 
include('include/footer.php');?> 
