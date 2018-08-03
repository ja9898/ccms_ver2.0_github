<? 
include('config.php');
include('include/header.php'); 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>"; 
 
echo "<th class='specalt'><b>Start time</b></th>"; 
 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>"; 

echo "<th class='specalt' colspan=3><b>Actions</b></th>";  
echo "</tr>"; 
$result = mysql_query("SELECT * FROM `campus_schedule` where status=0") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
  
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  

echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" .showUser( nl2br( $row['teacherID'])) . "</td>";
//Newly Added - Added for YCC LHR AGENT so that when agentId is 565 , it must be RED
if($row['agentId']==565)
{
echo "<td valign='top' style='color:red'>" .showUser( nl2br( $row['agentId'])) . "</td>";
}
else
{
echo "<td valign='top'>" .showUser( nl2br( $row['agentId'])) . "</td>";
}
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";  
  

 
echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['id']}>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to confirm this schedule?')\" class=button href=book_scheduler_confirm.php?id={$row['id']}>Confirm Schedule</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=book_scheduler_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=book_scheduler_new.php class=button>New Row</a>"; 
include('include/footer.php');
?>