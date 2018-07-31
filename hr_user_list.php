<? 
include('config.php');
include('include/header.php');
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?
getActiveDeactiveFilter();
getDepartmentFilter();
getuserTypeFilter();
getFilterSubmit();
?>
</form>
<?
if($_SESSION['userId']==159 || $_SESSION['userId']==195 || $_SESSION['userId']==86 || $_SESSION['userId']==227 || $_SESSION['userType']==11)
{

	echo "<table border=0 id='' cellspacing=0 >"; 
	echo "<tr>";
	echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
	echo "<th class='specalt'><b>Id</b></th>"; 
	echo "<th class='specalt' style='color:GREEN;'><b>VOICE/EXT ID</b></th>"; 	
	echo "<th class='specalt' style='color:RED;'><b>biometricId</b></th>"; 
	echo "<th class='specalt'><b>FULLName</b></th>";  
	echo "<th class='specalt'><b>FatherName</b></th>";
	echo "<th class='specalt'><b>Status</b></th>";
	echo "<th class='specalt'><b>Phone</b></th>";
	echo "<th class='specalt'><b>Department</b></th>";
	echo "<th class='specalt'><b>Designation</b></th>";
	echo "<th class='specalt'><b>Qualification</b></th>";
	echo "<th class='specalt'><b>Skype ID</b></th>";
	echo "<th class='specalt'><b>NIC</b></th>"; 
	echo "<th class='specalt'><b>Address</b></th>";
	echo "<th class='specalt'><b>Email</b></th>";   
	echo "<th class='specalt'><b>Gender</b></th>";      
	echo "<th class='specalt'><b>UserType</b></th>";
	echo "<th class='specalt'><b>EmpType</b></th>";  
	echo "<th class='specalt'><b>Shift</b></th>"; 
	echo "<th class='specalt'><b>Appt_Date</b></th>"; 
	echo "<th class='specalt'><b>Confirm_Dtae</b></th>"; 
	echo "<th class='specalt'><b>Salary</b></th>"; 
	echo "<th class='specalt'><b>Tea</b></th>"; 
	echo "<th class='specalt'><b>Residance</b></th>"; 



	echo "</tr>";
	//$result =getResultResource('capmus_users',$_POST,'capmus_users.user_type=3 and capmus_users.user_type=5');
	//$result =getResultResource('capmus_users',$_POST,"capmus_users.user_type=3 and capmus_users.user_type=5","","","","","",'');   
	$sql = "SELECT * FROM `capmus_users` WHERE 1";
	if(isset($_POST['status']) && !empty($_POST['status']))
	{
		$sql.= " and status = ".$_POST['status'];
	}
	if(isset($_POST['department']) && !empty($_POST['department']))
	{
		$sql.= " and departmentId = ".$_POST['department'];
	}
	if(isset($_POST['userType']) && !empty($_POST['userType']))
	{
		$sql.= " and user_type = ".$_POST['userType'];
	}
	$sql.=" ORDER BY id asc";
	//echo $sql;
	$result = mysql_query($sql) or trigger_error(mysql_error());
	$rowcount = mysql_num_rows($result);	
	echo "<br><br><br><br><b><div style='float:left'>Total : ".$rowcount." &nbsp;&nbsp;&nbsp;</div><br></b>";
	while($row = mysql_fetch_array($result)){ 
	foreach($row as $key => $value) { $row[$key] = stripslashes($value); } 
	echo "<tr>";  
	echo "<td valign='top'><a href=hr_user_edit.php?id={$row['id']} class='button'>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class='button' href=#>Delete</a></td> "; 
	echo "<td valign=''>" . nl2br( $row['id']) . "</td>";  
	echo "<td valign='' style='color:GREEN;'>" . nl2br( $row['voice_id']) . "</td>";
	echo "<td valign=''>" . nl2br( $row['biometricId']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['firstName']) . " " . nl2br( $row['lastName']) ."</td>";     
	echo "<td valign='top'>" . nl2br( $row['fatherName']) . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['status']),'status') . "</td>";
	echo "<td valign='top'>" . nl2br( $row['phone']) . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['departmentId']),'department') . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['designationID']),'designation') . "</td>";
	echo "<td valign='top'>" . nl2br( $row['qualification']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['skypeId']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['nic']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['address']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['email']) . "</td>";  
	echo "<td valign='top'>" . getData(nl2br( $row['gender']),'gender') . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['user_type']),'userType') . "</td>";    
	echo "<td valign='top'>" . getData(nl2br( $row['empType']),'employeeType') . "</td>";  
	echo "<td valign='top'>" . getData(nl2br( $row['empShift']),'shift') . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['appointment_date']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['confirmation_date']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['basic_salary']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['tea_deduct']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['res_allow']) . "</td>"; 

	echo "</tr>"; 
	} 
	echo "</table>"; 
	echo "<a href=hr_user_new.php class='button'>New Row</a>"; 
}
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}


include('include/footer.php');
?>