<? 
include('config.php');
include('include/header.php'); 


echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227)
{
echo "<th class='specalt'><b>Actions</b></th>";
}
echo "<th class='specalt'><b>ID</b></th>";
echo "<th class='specalt'><b>EMP ID</b></th>";
echo "<th class='specalt'><b>Leave Reason</b></th>";
echo "<th class='specalt'><b>Time Leave</b></th>";
echo "<th class='specalt'><b>Time Rejoin</b></th>";
echo "<th class='specalt'><b>Leave Duration</b></th>";
echo "<th class='specalt'><b>Leave Applied</b></th>"; 
echo "<th class='specalt'><b>Applied At</b></th>"; 
echo "<th class='specalt'><b>TL Recommend/Not Recommend</b></th>"; 
echo "<th class='specalt'><b>HR Received/Not Received</b></th>"; 
echo "</tr>";

if($_SESSION['userType']==3 || $_SESSION['userType']==5 || $_SESSION['userType']==17)
{
	$result = mysql_query("SELECT * FROM campus_empshort_leave WHERE empId = '".$_SESSION['userId']."'") or trigger_error(mysql_error()); 
}
else
{
	$result = mysql_query("SELECT * FROM campus_empshort_leave") or trigger_error(mysql_error());
}

while($row = mysql_fetch_array($result)){
	
	echo "<tr>";  
	if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227)
	{
		echo "<td valign='top'><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=short_leave_application_list_teacher_delete.php?id={$row['id']}>Delete</a></td></td>";
	}
	echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
	echo "<td valign='top'>" . showUser( nl2br( $row['empId'])) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['reasonLeave']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['timeLeave']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['timeRejoin']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['leaveDuration']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['leaveApplied']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['currentDateTime']) . "</td>";
	echo "<td valign='top'><b>" . getData(nl2br( $row['TLRecommend']),'TL')."</b> - ".$row['TLComments'] . " - <span style='color:green'>". showUser( nl2br( $row['TLID'])) ."</span></td>"; 
	echo "<td valign='top'><b>" . getData(nl2br( $row['HRReceive']),'HR')."</b> - ".$row['HRComments'] . " - <span style='color:green'>". showUser( nl2br( $row['HRID'])) ."</span></td>";
	echo "</tr>"; 
} 
echo "</table>"; ?>
<?
include('include/footer.php');
?>