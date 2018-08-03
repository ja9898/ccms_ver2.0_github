<? 
include('config.php'); 
include('include/header.php');


$sql_receive_msg_count = "SELECT chat.*,fromID,count(fromID) as counter FROM `chat` WHERE toID='".$_SESSION['userId']."' and recd=0 GROUP BY fromID " or die(mysql_error()); 
$result_receive_msg_count = mysql_query($sql_receive_msg_count) or die(mysql_error()); 
// Print out result
while($row_receive_msg_count = mysql_fetch_array($result_receive_msg_count)){
	echo "<a href='chat_panel.php?id={$row_receive_msg_count['fromID']}' style='font-size:24px; color:#ff7802'>".$row_receive_msg_count['from']. " - ". $row_receive_msg_count['counter']." message</a>";
	echo "<br />";
}
$id = (int) $_GET['id'];
$to_name = showUser( nl2br( $id ));
 //Query to make the messages recd column from 0 to 1, It means that the link is clicked, 
//and messages are in READ state or READ by the USER
if($id!=0 && $to_name!=''){
$sql_read_unread="UPDATE chat SET recd=1 WHERE (`toID` = '".$_SESSION['userId']."' and `fromID` = '".$id."') and recd=0";
$result_sql_read_unread= mysql_query($sql_read_unread) or die(mysql_error()); 
}


echo "<label style='color:Blue; font-weight:bold'><u>MANAGEMENT STAFF</u></label>";
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Name</b></th>";  
echo "<th class='specalt' ><b>Actions</b></th>"; 
echo "</tr>";
$all_managerial_staff="SELECT * from capmus_users WHERE user_type=1 and status=1 and 
id IN('227','195')";
$result_all_managerial_staff = mysql_query($all_managerial_staff) or die(mysql_error());
while($row_all_managerial_staff = mysql_fetch_array($result_all_managerial_staff)){
	//echo "<a href='chat_panel.php?id={$row_all_managerial_staff['id']}'>".showUser($row_all_managerial_staff['id'])."</a>";
	//echo "<br />";
	//echo "<br />";
	echo "<tr>";    
	echo "<td valign='top'>" . showUser($row_all_managerial_staff['id']) . "</td>";      
	echo "<td valign='top'><a class=button target='_blank' href=chat_panel.php?id={$row_all_managerial_staff['id']}>Chat</a></td>";
	echo "</tr>";
}
echo "</table>"; 

echo "************************************---------------------------------********************************";
echo "<br>";

if($_SESSION['userType']==3)
{
	echo "<label style='color:Blue; font-weight:bold'><u>TEAMLEAD</u></label>";
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	echo "<tr>"; 
	echo "<th class='specalt'><b>Name</b></th>";  
	echo "<th class='specalt' ><b>Actions</b></th>"; 
	echo "</tr>";
	$sql_SA_TL = "SELECT * from capmus_users WHERE id='".$_SESSION['userId']."' ";
	$result_SA_TL = mysql_query($sql_SA_TL) or die(mysql_error()); 
}
// Student must see his/her teacher only	//newly added 25-02-17
else if($_SESSION['userType']==4)
{
	echo "<label style='color:Blue; font-weight:bold'><u>TEACHERS</u></label>";
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	echo "<tr>"; 
	echo "<th class='specalt'><b>Student</b></th>"; 
	echo "<th class='specalt'><b>Teacher</b></th>"; 	
	echo "<th class='specalt' ><b>Actions</b></th>"; 
	echo "</tr>";
	$sql_SA_TL = "SELECT * from campus_schedule WHERE studentID='".$_SESSION['userId']."' 
	and (std_status=1 || std_status=2)";
	$result_SA_TL = mysql_query($sql_SA_TL) or die(mysql_error()); 
}
////////////////////////////////
else if($_SESSION['userType']==5)
{
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	echo "<tr>"; 
	echo "<th class='specalt'><b>Name</b></th>";  
	echo "<th class='specalt' ><b>Actions</b></th>"; 
	echo "</tr>";
	$sql_SA_TL = "SELECT * from capmus_users WHERE id='".$_SESSION['userId']."' ";
	$result_SA_TL = mysql_query($sql_SA_TL) or die(mysql_error());
}
else if($_SESSION['userType']==8)
{
	echo "<label style='color:Blue; font-weight:bold'><u>TEACHER LIST-TEAMLEAD WISE</u></label>";
	$result_SA_TL = teacher_info_by_teamlead();
}
else
{
	echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
	echo "<tr>"; 
	echo "<th class='specalt'><b>Id</b></th>"; 
	echo "<th class='specalt'><b>Full Name</b></th>";  
	echo "<th class='specalt'><b>Designation</b></th>"; 
	echo "<th class='specalt'><b>Status</b></th>"; 
	echo "<th class='specalt'><b>Shift</b></th>"; 
	echo "<th class='specalt' ><b>Actions</b></th>"; 
	echo "</tr>";
	$sql_SA_TL = "SELECT * from capmus_users WHERE status=1 ORDER BY empShift ASC, firstName ASC";
	$result_SA_TL = mysql_query($sql_SA_TL) or die(mysql_error());
}

	while($row_SA_TL = mysql_fetch_array($result_SA_TL )){
	if($_SESSION['userType']==3 || $_SESSION['userType']==5)
	{
		//echo "<a href='chat_panel.php?id={$row_SA_TL['LeadId']}'>".showUser($row_SA_TL['LeadId'])."</a>";
		//echo "<br />";
		echo "<tr>";    
		echo "<td valign='top'>" . showUser($row_SA_TL['LeadId']). "</td>";      
		//echo "<td valign='top'><a class=button target='_blank' href=chat_panel.php?id={$row_SA_TL['LeadId']}>Chat</a></td>";
		echo "<td valign='top'>NA</td>";
		echo "</tr>";
	}
	else if($_SESSION['userType']==4)
	{
		echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
		echo "<tr>";  
		echo "<td valign='top'>" . showStudents(nl2br( $row_SA_TL['studentID'])) . "</td>";
		echo "<td valign='top'>" . showUser(nl2br( $row_SA_TL['teacherID'])) . "</td>";
		echo "<td valign='top'><a class=button target='_blank' href='chat_panel.php?id={$row_SA_TL['teacherID']}'>Chat</a></td>";   
		echo "</tr>"; 
		echo "</table>"; 
		//}
	}
	else if($_SESSION['userType']==8)
	{
		//while($row = mysql_fetch_array($result)){ 
		//foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
		echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
		echo "<tr>";  
		//echo "<td valign='top'>" . showUser(nl2br( $row_SA_TL['LeadId'])) . "</td>";
		echo "<td valign='top'><a href='chat_panel.php?id={$row_SA_TL['user_id']}'>".showUser($row_SA_TL['user_id'])."</a></td>";   
		echo "</tr>"; 
		echo "</table>"; 
		//}
	}
	else
	{
		//echo "<a href='chat_panel.php?id={$row_SA_TL['id']}'>".showUser($row_SA_TL['id'])."</a>";
		//echo "<br />";
		echo "<tr>";  
		echo "<td valign='top'>" . nl2br( $row_SA_TL['id']) . "</td>";  
		echo "<td valign='top'>" . nl2br( $row_SA_TL['firstName']) . " " . nl2br( $row_SA_TL['lastName']) . "</td>";    
		echo "<td valign='top'>" . getData(nl2br( $row_SA_TL['designationID']),'designation') . "</td>";  
		echo "<td valign='top'>" . getData(nl2br( $row_SA_TL['status']),'status') . "</td>";  
		echo "<td valign='top'>" . getData(nl2br( $row_SA_TL['empShift']),'shift') . "</td>"; 
		echo "<td valign='top'><a class=button target='_blank' href=chat_panel.php?id={$row_SA_TL['id']}>Chat</a></td>";
		echo "</tr>";
		 
	}
}
echo "</table>";
?>


<? 
include('include/footer.php');?> 
