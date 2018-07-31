<?php 
include('config.php'); 
include('include/header.php');
	
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div id="filter">

<?php

?>

<br><br>

</div>
</form>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";
echo "<th class='specalt'><b>teamLead</b></th>"; 
echo "<th class='specalt'><b>amount</b></th>"; 
echo "<th class='specalt'><b>fromDate</b></th>"; 
echo "<th class='specalt'><b>toDate</b></th>"; 
echo "<th class='specalt'><b>user_type</b></th>"; 
echo "<th class='specalt' colspan=2><b>Actions</b></th>"; 
echo "</tr>"; 


	$result = mysql_query("SELECT * FROM campus_target_table ");

while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['amount']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['fromDate']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['toDate']) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['user_type']),'userType') . "</td>";
echo "<td valign='top'><a class=button href=teamlead_target_edit_values.php?id={$row['id']}>Edit</a></td>";
echo "<td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=teamlead_target_delete_values.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
}
echo "</table>"; 
echo "<a href=teamlead_target_new.php class=button>New Row</a>"; 
?>
<?php include('include/footer.php');?>