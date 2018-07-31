<? 
include('config.php');
include('include/header.php');

echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";  
echo "<th class='specalt'><b>Name</b></th>"; 
echo "<th class='specalt'><b>Menu</b></th>";
echo "<th class='specalt'><b>Comments</b></th>"; 
echo "<th class='specalt'><b>Date</b></th>";
echo "<th class='specalt'><b>Actions</b></th>";

echo "</tr>"; 

if($_SESSION['userType']!=1)
{
	$result = mysql_query("SELECT * FROM `campus_meal` WHERE userId='".$_SESSION['userId']."' ") or trigger_error(mysql_error());
}
else
{
	if($_SESSION['userType']==1){
	$result = mysql_query("SELECT * FROM `campus_meal`") or trigger_error(mysql_error());
	}
}
 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br($row['id']) . "</td>";
echo "<td valign='top'>" . showUser($row['userId']) . "</td>";
echo "<td valign='top'>" . getData($row['menuId'],'menuAry') . "</td>";
echo "<td valign='top'>" . $row['comments'] . "</td>";
echo "<td valign='top'>" . $row['dateTime'] . "</td>";

echo "<td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=#>Delete</a></td> "; 
echo "</tr>"; 
}
echo "</table>"; 
echo "<a href=order_meal_new.php class=button>New Row</a>";
include('include/footer.php');
?>