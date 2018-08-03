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
echo "<th class='specalt'><b>Leave Type</b></th>";
echo "<th class='specalt'><b>Leave Reason</b></th>";
echo "<th class='specalt'><b>Leave Start Date</b></th>"; 
echo "<th class='specalt'><b>Leave End Date</b></th>"; 
echo "<th class='specalt'><b>No Of Days</b></th>"; 
echo "<th class='specalt'><b>Leave Applied</b></th>"; 
echo "<th class='specalt'><b>TL Recommend/Not Recommend</b></th>"; 
echo "<th class='specalt'><b>GM Approve/Not Approve</b></th>"; 
echo "<th class='specalt'><b>HR Received/Not Received</b></th>"; 
echo "</tr>";

if($_SESSION['userType']==3 || $_SESSION['userType']==5 || $_SESSION['userType']==8 || $_SESSION['userType']==9)
{
	$result = mysql_query("SELECT * FROM campus_empleave WHERE EmpID = '".$_SESSION['userId']."'") or trigger_error(mysql_error()); 
}
else
{
	$result = mysql_query("SELECT * FROM campus_empleave") or trigger_error(mysql_error());
}

while($row = mysql_fetch_array($result)){
	
	echo "<tr>";  
	if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227)
	{
		echo "<td valign='top'><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=leave_application_list_teacher_delete.php?id={$row['id']}>Delete</a></td></td>";
	}
	echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
	echo "<td valign='top'>" . showUser( nl2br( $row['EmpID'])) . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['LeaveType']),'LeaveType') . "</td>"; 	
	echo "<td valign='top'>" . nl2br( $row['LeaveReason']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['LeaveStartDate']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['LeaveEndDate']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['NoOfDays']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['LeaveApplied']) . "</td>";  
	echo "<td valign='top'><b>" . getData(nl2br( $row['TLRecommend']),'TL')."</b> - ".$row['TLComments'] . " - <span style='color:green'>". showUser( nl2br( $row['TLID'])) ."</span></td>"; 
	echo "<td valign='top'><b>" . getData(nl2br( $row['GMApprove']),'GM')."</b> - ".$row['GMComments'] . " - <span style='color:green'>". showUser( nl2br( $row['GMID'])) ."</span></td>"; 
	echo "<td valign='top'><b>" . getData(nl2br( $row['HRReceive']),'HR')."</b> - ".$row['HRComments'] . " - <span style='color:green'>". showUser( nl2br( $row['HRID'])) ."</span></td>";
	echo "</tr>"; 
} 
echo "</table>"; ?>
<?
include('include/footer.php');
?>