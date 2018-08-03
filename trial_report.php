<? 
include('config.php'); 
include('include/header.php');
global $check;
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp; 
<?php getStatusFilter(); ?>
&nbsp;&nbsp; 
<?php getAgentFilter(); ?>
&nbsp;&nbsp; 
<?php getTeacherFilter(); ?> 
&nbsp;&nbsp;
<?php echo getShiftFilter(); ?>
&nbsp;&nbsp;<input type="submit" class="button" name="search-submit" value="Filter"></form>
<br /><br />
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >";
echo "<tr>"; 
 
echo "<th class='specalt'><b>Student Name</b></th>"; 

echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>Booked Date</b></th>"; 

 
echo "<th class='specalt'><b>Status</b></th>"; 

echo "</tr>"; 

//$_sql="SELECT * FROM `campus_students` ";
//getResultResource('campus_schedule',$_POST,'status=1');

//$result =getResultResource('campus_schedule',$_POST,'1',"","","","");  //ORIGINAL QUERY

if($_SESSION['userType']==5)
{
	//$_sql.=" Where agent_id='".$_SESSION['userId']."'";
	$result = getResultResource('campus_schedule',$_POST," agent_id='".$_SESSION['userId']."'","","","","");
}
/*else if(isset($_POST['search-submit']) && $_POST['stdStatus']!="" && $_POST['stdStatus']>0)
{
$student_status = $_POST['stdStatus'];
//echo "Student status found<br>";
//echo $_POST['stdStatus'];
//header ('Location:loggeduser.php');
	//$select_sta_query=("SELECT * FROM campus_schedule WHERE campus_schedule.std_status ='".$student_status."'");
	//$result=mysql_query($select_sta_query);
	$result = getResultResource($_table='campus_schedule',$_post="",$_where="campus_schedule.std_status ='".$student_status."'",$join='',$joinFields='',$joinWhere='',$joinselect="",$orderby="",$_fields="");
	if(mysql_num_rows($result))
	{
		$check=1;
		//echo "<br>";
		//echo '1';
	}
	else
	{
	//echo "<br>0<br>";
	//echo "No status match";
	}
}*/
//else if($_POST['stdStatus']!="" && $_POST['stdStatus']>0)
//{
//	$result =getResultResource('campus_schedule',$_POST,"campus_schedule.std_status='".$_POST['stdStatus']."'","","","","");  //MY QUERY
//}
else
{
	$result = getResultResource('campus_schedule',$_POST,'1',"","","","");  //ORIGINAL QUERY
	//echo "Student status NOT FOUND-ALL SHOWN";
	//$result =getResultResource('campus_schedule',$_POST,'1',"","","","");  
}

while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
   
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
 
echo "<td valign='top'>" . showUser(nl2br( $row['agentId'])) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dateBooked']) . "</td>";  

 
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatus') . "</td>";  

echo "</tr>"; 
} 
echo "</table>"; 

?>
<?php include('include/footer.php');?>