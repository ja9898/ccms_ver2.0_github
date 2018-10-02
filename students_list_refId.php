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
echo "<th class='specalt'><b>Ext ID</b></th>"; 
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

	$sql="SELECT * FROM campus_students";
	$result=mysql_query($sql);

echo $rowcount = mysql_num_rows($result);echo "<br>";
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
$randomRefId = rand(100000,999999);echo "<br>";
echo $update_refId="UPDATE campus_students 
SET campus_students.refId='".$randomRefId."' , 
campus_students.user_type=4 
WHERE campus_students.id='".$row['id']."' ";echo "<br>";
$out=mysql_query($update_refId);
echo "<br>";

echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['reg_id']) . "</td>";
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row['id']))."' target=_blank >" . getextID(nl2br( $row['id'])) . "</a></td>";
echo "<td valign='top'>" . getData(nl2br( $row['countryID']),'country') . "</td>";
//echo "<td valign='top'>" .getData(nl2br( $row['classType']),'plan') . "</td>";    
echo "<td valign='top'>" . nl2br( $row['firstName'])." ".nl2br( $row['lastName']) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['agent_id'])) . "</td>";  
echo "<td valign='top'><a href=mailto:'".$row['email']."' target=_blank>Email</a></td>"; 
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