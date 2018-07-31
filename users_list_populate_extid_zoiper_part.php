<?php 
include('config.php'); 
include('include/header.php');
	
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div id="filter">

<?php
getStudentFilter();
getAgentFilter();
getStatusFilter();
getFilterSubmit();
?><div id="field"><?php echo getList('','countryID','country');?> </div> 

<br><br>

</div>
</form>
<?


if(isset($_POST['search-submit']))
{
if($_SESSION['userType']==5)
{
	//$_sql.=" Where agent_id='".$_SESSION['userId']."'";
	$result = getResultResource('campus_students',$_POST," agent_id='".$_SESSION['userId']."'","",",campus_students.id","","");
}
else{
	//$result =getResultResource('campus_students',$_POST,'1',"",",campus_students.id","",""); 
	$result = ("SELECT * FROM capmus_users WHERE `status`=1 AND `user_type`=3");
	$result=mysql_query($result);
	}
$id_count=40001;
while($row = mysql_fetch_array($result)){
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<br>";
echo $update_extId_zoiper="UPDATE capmus_users 
SET capmus_users.voice_id='".$id_count."' , capmus_users.v_password='6OT#YCC@jpk' , 
capmus_users.sip_server='209.126.65.56' 
WHERE capmus_users.id='".$row['id']."' ";

echo "<br>";echo "<br>";
$id_count=$id_count+1;
$out=mysql_query($update_extId_zoiper);

} 
}
?>
<?php include('include/footer.php');?>