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
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','std_status','stdStatus');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
<?


if(isset($_POST['search-submit']))
{
if($_SESSION['userType']==5)
{
	//$_sql.=" Where agent_id='".$_SESSION['userId']."'";
	$result = getResultResource('campus_students',$_POST," agent_id='".$_SESSION['userId']."'","",",campus_students.id","","");
}
else if($_SESSION['userType']==9 || $_SESSION['userType']==16)
{
	$result = getResultResource_teamlead_agent_list_students();
}
else{
	//$result =getResultResource('campus_students',$_POST,'1',"",",campus_students.id","",""); 
	$result = ("SELECT * FROM capmus_users WHERE `status`=1 AND `user_type`=5 AND `empShift`=2 ");
	$result=mysql_query($result);
	}
$id_count=4651;
while($row = mysql_fetch_array($result)){

//$query2="SELECT id,extId FROM campus_voice_ext WHERE id ='".$id_count."' AND (status=2)";
//echo "<br>";
//$results2=mysql_query($query2);
//$rows2=mysql_fetch_array($results2); 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

echo "<br>";
echo $update_extId="UPDATE capmus_users 
SET capmus_users.voice_id='".$id_count."' , capmus_users.v_password='Sabia@30#60' , capmus_users.sip_server='209.126.65.56' 
WHERE capmus_users.id='".$row['id']."' ";

echo "<br>";echo "<br>";
$id_count=$id_count+1;
$out=mysql_query($update_extId);

} 
}
?>
<?php include('include/footer.php');?>