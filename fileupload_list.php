<? 
include('config.php');
include('include/header.php'); 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";  
echo "<th class='specalt'><b>From</b></th>"; 
echo "<th class='specalt'><b>To</b></th>";
echo "<th class='specalt'><b>Src</b></th>";
echo "<th class='specalt'><b>Dest</b></th>";
echo "<th class='specalt'><b>sent</b></th>";
echo "<th class='specalt'><b>Download</b></th>";   
echo "</tr>"; 

if($_SESSION['userType']==3)
{
	$result = mysql_query("SELECT * FROM `campus_fileupload` WHERE fromID='".$_SESSION['userId']."' || toID='".$_SESSION['userId']."' ") or trigger_error(mysql_error());
}
else if($_SESSION['userType']==4)
{
	$result = mysql_query("SELECT * FROM `campus_fileupload` WHERE fromID='".$_SESSION['userId']."' ") or trigger_error(mysql_error());
}
else
{
if($_SESSION['userType']==1 ){
$result = mysql_query("SELECT * FROM `campus_fileupload`") or trigger_error(mysql_error());
}
}
 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br($row['id']) . "</td>";
if($row['src']=='Teacher' && $row['dest']=='Student'){
echo "<td valign='top'>" . showUser($row['fromID']) . "</td>";
echo "<td valign='top'>" . showStudents($row['toID']) . "</td>";
}
if($row['src']=='Student' && $row['dest']=='Teacher'){
echo "<td valign='top'>" . showStudents($row['fromID']) . "</td>";
echo "<td valign='top'>" . showUser($row['toID']) . "</td>";
}
echo "<td valign='top'>" . $row['src'] . "</td>";
echo "<td valign='top'>" . $row['dest'] . "</td>";
echo "<td valign='top'>" . $row['sent'] . "</td>";
if(!empty($row['filepath']))
{
	$filepath = rawurlencode($row['filepath']);
	echo "<td valign='top'><a href=https://www.yourcloudcampus.com/ccmsycc/student_teacher_file_upload/".$filepath." target=_blank>" . DOWNLOAD . "</a></td>";
}
else
{
	echo "<td valign='top'><a href=#>" . NOFILE . "</a></td>";
}
echo "</tr>"; 
} 
echo "</table>"; 
include('include/footer.php');
?>