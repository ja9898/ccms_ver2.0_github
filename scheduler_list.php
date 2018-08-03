<? 
include('config.php');
include('include/header.php'); 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>"; 
 
echo "<th class='specalt'><b>Monday</b></th>"; 
echo "<th class='specalt'><b>Tueday</b></th>"; 
echo "<th class='specalt'><b>Wednesday</b></th>"; 
echo "<th class='specalt'><b>Thursday</b></th>"; 
echo "<th class='specalt'><b>Friday</b></th>"; 
echo "<th class='specalt'><b>Saturday</b></th>"; 
echo "<th class='specalt'><b>StartTime</b></th>"; 
echo "<th class='specalt'><b>EndTime</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Group</b></th>";

echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
echo "</tr>"; 

if($_SESSION['userType']==8)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_campus_timing();
}
else
{
$result = mysql_query("SELECT * FROM `campus_timing`") or trigger_error(mysql_error());
}
 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
  
echo "<td valign='top'>" . nl2br( $row['mon']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['tue']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['wed']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['thu']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['fri']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['sat']) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['startTime']),'time') . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['endTime']),'time') . "</td>";  
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";  
if($_SESSION['userType']==8)
{
echo "<td valign='top'>Blocked</td>";
}
else
{
echo "<td valign='top'>" . nl2br( $row['group_value']) . "</td>";  
}
echo "<td valign='top'><a class=button href=scheduler_edit.php?id={$row['id']}>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=scheduler_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=scheduler_new.php class=button>New Row</a>"; 
include('include/footer.php');
?>