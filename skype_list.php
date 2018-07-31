<? 
include('config.php'); 
include('include/header.php');
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'>Id</th>"; 
echo "<th class='specalt'>Skype</th>"; 
echo "<th class='specalt'>Password</th>"; 
echo "<th class='specalt'>Status</th>";
echo "<th class='specalt'>Student</th>"; 
echo "<th class='specalt'>Action</th>";
echo "</tr>"; 
//$result = mysql_query("SELECT campus_students.id AS studentID, campus_skype.id, campus_skype.skype, campus_skype.password, campus_skype.status
 //FROM campus_skype left JOIN campus_students ON campus_skype.id = campus_students.skypeid ") or trigger_error(mysql_error()); 
 /*
 $result = getResultResource($_table='campus_skype',$_post='',$_where='',$join='',$joinFields='',$joinWhere='',
 $joinselect="left JOIN campus_students ON campus_skype.id = campus_students.skypeid",$orderby="",
 $_fields="campus_students.id AS studentID, campus_skype.id, campus_skype.skype, campus_skype.password, campus_skype.status, campus_students.countryID");
 */
 $result = getResultResource($_table='campus_skype',$_post='',$_where='',$join='',$joinFields='',$joinWhere='',
 $joinselect="left JOIN campus_schedule ON campus_skype.id = campus_schedule.skypeid",$orderby="",
 $_fields="campus_schedule.studentID AS studentID, campus_skype.id, campus_skype.skype, campus_skype.password, campus_skype.status");
 
 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['skype']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['password']) . "</td>";  
echo "<td valign='top'>" .  getData(nl2br( $row['status']),'skype_status') . "</td>"; 
echo "<td valign='top'>" ;  if(!empty($row['studentID'])) { echo showStudents_from_manageschedule(nl2br( $row['studentID']));} echo "</td>"; 
echo "<td valign='top'><a class=button href=skype_edit.php?id={$row['id']}>Edit</a>&nbsp;&nbsp;&nbsp;<a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=skype_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a class=button href=skype_new.php>New Row</a>"; 
include('include/footer.php');?>