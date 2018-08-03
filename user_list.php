<? 
include('config.php');
include('include/header.php');

//if($_SESSION['userId']==159 || $_SESSION['userId']==195 || $_SESSION['userId']==294 || $_SESSION['userId']==48)
//{

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
<?php
/*getCourseFilter();
getActiveDeactiveFilter();
getFilterSubmit();*/
?></div>
<br>
</form>
</div>
<?
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>"; 

echo "<th class='specalt'><b>FirstName</b></th>";  
echo "<th class='specalt'><b>LastName</b></th>"; 
echo "<th class='specalt'><b>FatherName</b></th>"; 
echo "<th class='specalt'><b>Email</b></th>";  
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Shift</b></th>"; 
//echo "<th class='specalt'><b>Department</b></th>"; 
//echo "<th class='specalt'><b>Designation</b></th>"; 
echo "<th class='specalt'><b>TeamLead</b></th>"; 

echo "<th class='specalt' colspan=4><b>Actions</b></th>"; 
echo "</tr>";
$result =getResultResource('capmus_users',$_POST,'1');;   
/*$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,capmus_users.fatherName,capmus_users.email,capmus_users.status,
	capmus_teacher_course.id,capmus_teacher_course.teacherID,capmus_teacher_course.courseID 
	FROM capmus_users 
	INNER JOIN capmus_teacher_course  
	ON capmus_users.id=capmus_teacher_course.teacherID and capmus_users.status=1";
if(isset($_POST['course']) && !empty($_POST['course']))
	{
		$sql.= " and capmus_teacher_course.courseID= '".$_POST['course']."'";
	}
if(isset($_POST['status']) && !empty($_POST['status']))
	{
		$sql.= " and capmus_users.status='".$_POST['status']."'";
	}

$result=mysql_query($sql);*/
while($row = mysql_fetch_array($result)){ 
foreach($row as $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
 
echo "<td valign='top'>" . nl2br( $row['firstName']) . "</td>";    
echo "<td valign='top'>" . nl2br( $row['lastName']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['fatherName']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['email']) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['status']),'status') . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['empShift']),'shift') . "</td>"; 
//echo "<td valign='top'>" . getData(nl2br( $row['departmentId']),'department') . "</td>"; 
//echo "<td valign='top'>" . getData(nl2br( $row['designationID']),'designation') . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['LeadId']) . "</td>";
echo "<td valign='top'><a class=button target='_blank' href=chat_panel.php?id={$row['id']}>Chat</a></td>";
nl2br( $row['appointment_date']);
nl2br( $row['confirmation_date']);
nl2br( $row['basic_salary']);
nl2br( $row['departmentId']);
nl2br( $row['designationID']);

if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==1 || $_SESSION['userId']==298 || $_SESSION['userId']==86 || $_SESSION['userId']==195 || $_SESSION['userId']==227)
{
	echo "<td valign='top'><a href=user_edit.php?id={$row['id']} class='button'>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class='button' href=user_delete.php?id={$row['id']}>Delete</a></td> ";
	echo "<td><a href=emp_payroll_new.php?emp_id={$row['id']}&department_id={$row['departmentId']}&designation_id={$row['designationID']}&emp_shift={$row['empShift']}&appointment_date={$row['appointment_date']}&confirmation_date={$row['confirmation_date']}&g_pay_before_deduction={$row['basic_salary']}&tea_deduct={$row['tea_deduct']}&res_allow={$row['res_allow']} target=_blank class=button>Pay slip generator</a></td>"; 
}
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=user_new.php class='button'>New Row</a>"; 
//}
//else
//{
//	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
//}
include('include/footer.php');
?>