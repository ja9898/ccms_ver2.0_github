<? 
include('config.php');
include('include/header.php'); 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";  
echo "<th class='specalt'><b>Teacher ID</b></th>"; 
echo "<th class='specalt'><b>Link ID</b></th>"; 
echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
echo "</tr>"; 

if($_SESSION['userType']==8 || $_SESSION['userType']==15)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_campus_meetinglink();
}
else
{
$result = mysql_query("SELECT * FROM `campus_meeting_link`") or trigger_error(mysql_error());
}
 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";     
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['linkID']) . "</td>";     

echo "<td valign='top'><a class=button href=meetinglink_edit.php?id={$row['id']}>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=meetinglink_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=meetinglink_new.php class=button>New Row</a>"; 
include('include/footer.php');
?>