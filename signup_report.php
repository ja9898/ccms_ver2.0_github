<? 
include('config.php'); 
include('include/header.php');
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate-s']),'fromDate-s','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate-s']),'toDate-s','class=flexy_datepicker_input');?>
&nbsp;&nbsp; 
<?php getAgentFilter(); ?>
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
echo "<th class='specalt'><b>Signup Date</b></th>"; 

 
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>"; 

echo "</tr>"; 

//$_sql="SELECT * FROM `campus_students` ";
//getResultResource('campus_schedule',$_POST,'status=1');

//$result =getResultResource('campus_schedule',$_POST,'1',"","","","");  //ORIGINAL QUERY NOT REQUIRED
if(isset($_POST['search-submit']) && $_POST['fromDate-s']!="" && $_POST['toDate-s']!="") //&& $_POST['search-agent']!="Select Agent")
{
	if($_SESSION['userType']==5)
	{
		//$_sql.=" Where agent_id='".$_SESSION['userId']."'";
		$result = getResultResource('campus_schedule',$_POST," agent_id='".$_SESSION['userId']."'","","","","");
	}
	//else if($_POST['stdStatus']!="" && $_POST['stdStatus']>0)
	//{
	//	$result =getResultResource('campus_schedule',$_POST,"campus_schedule.std_status='".$_POST['stdStatus']."'","","","","");  //MY QUERY
	//}
	else
	{
		$result =getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status!="3"',"","","","");  
	}	
}
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
   
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
 
echo "<td valign='top'>" . showUser(nl2br( $row['agentId'])) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dateBooked']) . "</td>";  

echo "<td valign='top'>" . nl2br( $row['duedate']) . "</td>";  
 
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatus') . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";  


echo "</tr>"; 
} 
echo "</table>"; 

?>
<?php include('include/footer.php');?>