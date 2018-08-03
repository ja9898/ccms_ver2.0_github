<? 
include('config.php');
include('include/header.php'); 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>"; 
 
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>course</b></th>"; 
echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
echo "</tr>"; 
//$result = mysql_query("SELECT * FROM `capmus_teacher_course`") or trigger_error(mysql_error()); 
$result = getResultResource($_table='capmus_teacher_course',$_post='',$_where='',$join='',$joinFields='',$joinWhere='',$joinselect="",$orderby="",$_fields="");
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
  
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
echo "<td valign='top'>" . showCourse(nl2br( $row['courseID'])) . "</td>";    
echo "<td valign='top'><a class=button href=teacher_course_edit.php?id={$row['id']}>Edit</td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=teacher_course_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=teacher_course_new.php class=button>New Row</a>"; 
include('include/footer.php');
?>