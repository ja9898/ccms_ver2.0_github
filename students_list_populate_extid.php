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
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";
echo "<th class='specalt'><b>Reg No.</b></th>"; 
echo "<th class='specalt'><b>Country</b></th>"; 
echo "<th class='specalt'><b>Name</b></th>"; 
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Email</b></th>"; 
echo "<th class='specalt'><b>Phone</b></th>"; 
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt' colspan=3><b>Actions</b></th>"; 
echo "</tr>"; 

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
	$result = ("SELECT * FROM campus_students WHERE id BETWEEN 80 AND 7983 ");
	$result=mysql_query($result);
	}
$id_count=1;
while($row = mysql_fetch_array($result)){

$query2="SELECT id,extId FROM campus_voice_ext WHERE id ='".$id_count."' AND (status=2)";
echo "<br>";
$results2=mysql_query($query2);
$rows2=mysql_fetch_array($results2); 
$id_count=$id_count+1;
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

echo "<br>";
echo $update_extId="UPDATE campus_students 
SET campus_students.extId='".$rows2['id']."' WHERE campus_students.id='".$row['id']."' ";

echo "<br>";echo "<br>";
$out=mysql_query($update_extId);
extStatus($rows2['id'],'1');
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['reg_id']) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['countryID']),'country') . "</td>";
//echo "<td valign='top'>" .getData(nl2br( $row['classType']),'plan') . "</td>";    
echo "<td valign='top'>" . nl2br( $row['firstName'])." ".nl2br( $row['lastName']) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['agent_id'])) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['email']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['phone'])."<br>".nl2br( $row['mobile'])."<br>".nl2br( $row['landline']) . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatus') . "</td>";
echo "<td valign='top'><a class=button href=students_edit.php?id={$row['id']}>Edit</a></td><td>";
echo "</td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=students_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
}
echo "</table>"; 
echo "<a href=students_new.php class=button>New Row</a>"; 
?>
<?php include('include/footer.php');?>