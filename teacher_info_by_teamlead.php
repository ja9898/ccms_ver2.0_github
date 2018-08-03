<?php 
include('config.php'); 
include('include/header.php');

if($_SESSION['userId']==159 || $_SESSION['userId']==195 || $_SESSION['userId']==294 || $_SESSION['userId']==227 || $_SESSION['userId']==636)
{
	
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

&nbsp;&nbsp;
<?php //echo getInput(stripslashes($_POST['fromDate-day']),'fromDate-day','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php// echo getInput(stripslashes($_POST['toDate-day']),'toDate-day','class=flexy_datepicker_input');?>


<?php
//getStudentFilter();
//getTeamLeadTeacherFilter();
//getAgentFilter();
//getStatusFilter();

//getStatusFilter_with_makeover();
//getTeacherFilterLead();
//getFilterSubmit();

?>
<br><br>

</div>
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','std_status','stdStatus');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
<?


echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Team Lead</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Skype ID</b></th>";
echo "<th class='specalt'><b>Mobile Number</b></th>";
echo "<th class='specalt'><b>StartTime - EndTime</b></th>";   
echo "</tr>"; 

 
//Following query will show result by clicking TEACHER TL REPORT	-	GENERAL			-	NOT FOR SuperAdmin
if($_SESSION['userType']==8)
{

	$result = teacher_info_by_teamlead();
}


else
{
	$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.skypeId,capmus_users.phone,
	campus_timing.id,campus_timing.startTime,campus_timing.endTime,campus_timing.teacherID 
	FROM capmus_users 
	INNER JOIN campus_timing 
	ON capmus_users.id=campus_timing.teacherID ORDER BY capmus_users.LeadId");
	$result = mysql_query($sql);
}

while($row = mysql_fetch_array($result)){ 
//foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['firstName']) . " " . nl2br( $row['lastName']) . "</td>";   
echo "<td valign='top'>" . nl2br( $row['skypeId']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['phone']) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['startTime']),'time') . " - " . getData(nl2br( $row['endTime']),'time') . "</td>";  
echo "</tr>"; 
}


 
echo "</table>"; 
}
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}

?>
<?php include('include/footer.php');?>