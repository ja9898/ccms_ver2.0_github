<? 
include('config.php');
include('include/header.php'); 
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>"; 
echo "<th class='specalt'><b>Name</b></th>"; 
echo "<th class='specalt'><b>Description</b></th>"; 
echo "<th class='specalt'><b>Date</b></th>";
echo "<th class='specalt' colspan=2><b>Actions</b></th>"; 
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `campus_usertype`") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['typeName']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['typeDesc']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['typeDate']) . "</td>";  
echo "<td valign='top'><a class=button href=user_type_edit.php?id={$row['id']}>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=user_type_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=user_type_new.php class=button>New Row</a>"; 
include('include/footer.php');
?>