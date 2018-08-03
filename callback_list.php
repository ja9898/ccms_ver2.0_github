<? 
include('config.php');
include('include/header.php');
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div id="filter">
<? 
if($_SESSION['userType']==1)
{
	getAgentFilter();
	getFilterSubmit();
}
?>
</div>
</form>
<?
echo "<table id=\"Open_Text_General\" class=\"FixedTables\" cellspacing=0>"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Name</b></th>"; 
echo "<th class='specalt'><b>Contact</b></th>"; 
echo "<th class='specalt'><b>Details</b></th>"; 
echo "<th class='specalt'><b>agent</b></th>"; 
echo "<th class='specalt' colspan='2'><b>Actions</b></th>";
echo "</tr>"; 

if($_SESSION['userType']==5)
{
	$result = mysql_query("SELECT * FROM `campus_callbacks` WHERE agentId=".$_SESSION['userId']."") or trigger_error(mysql_error());   
}
else{
	
	//$result = mysql_query("SELECT * FROM `campus_callbacks`") or trigger_error(mysql_error()); 
	$sql = "SELECT * FROM `campus_callbacks`";
	if(isset($_POST['search-agent-id']))
	{
		$sql.= "WHERE agentId='".$_POST['search-agent-id']."'";
	}
	$result = mysql_query($sql) or trigger_error(mysql_error());
}
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['name']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['contact']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['otherDetails']) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['agentId'])) . "</td>";  
echo "<td valign='top' callcpan='2'><a class=button href=callback_edit.php?id={$row['id']}>Edit</a>&nbsp;&nbsp;&nbsp;&nbsp;<a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button  href=callback_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table><br><br>"; 

echo "<a href=callback_new.php class=button>New Row</a>"; 

include('include/footer.php');
?>