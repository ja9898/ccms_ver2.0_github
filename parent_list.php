<? 
include('config.php');
include('include/header.php');
if($_SESSION['userId']!=2015)
{ 
if($_SESSION['userType']==1 || $_SESSION['userType']==15 || $_SESSION['userType']==8 || $_SESSION['userType']==9 || $_SESSION['userType']==18){
echo "<a href=parent_new.php class=button>New Row</a>"; 
}
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";  
echo "<th class='specalt'><b>FULL NAME</b></th>"; 
echo "<th class='specalt'><b>Time Zone Area</b></th>";
echo "<th class='specalt'><b>Time Difference</b></th>"; 
echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
echo "</tr>"; 

if($_SESSION['userType']==8 || $_SESSION['userType']==9)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	//$result = getResultResource_campus_parent();
	$result = mysql_query("SELECT * FROM `campus_parent`") or trigger_error(mysql_error());
}
else
{
if($_SESSION['userType']==1 || $_SESSION['userType']==15 || $_SESSION['userType']==18){
$result = mysql_query("SELECT * FROM `campus_parent`") or trigger_error(mysql_error());
}
}
 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br($row['id']) . "</td>";
echo "<td valign='top'>" . nl2br($row['firstName'])." ".nl2br($row['lastName']) . "</td>";
echo "<td valign='top'>" . getData($row['timeZoneArea'],'timeZoneArea') . "</td>";
echo "<td valign='top'>" . getData($row['timeDifference'],'timeDifference') . "</td>";
echo "<td valign='top'><a class=button href=parent_edit.php?id={$row['id']}>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=parent_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
if($_SESSION['userType']==1 || $_SESSION['userType']==15 || $_SESSION['userType']==8 || $_SESSION['userType']==9 || $_SESSION['userType']==18){
echo "<a href=parent_new.php class=button>New Row</a>"; 
}
}
else
{
echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}
include('include/footer.php');
?>