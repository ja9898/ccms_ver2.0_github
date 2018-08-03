<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 

//getStudentFilter();
//getTeacherFilter();
//getAgentFilter();
//getStartTimeFilter(); ?></div>
<div style="float:left">
<?php
//getPlanFilter();
//getShiftFilter();
//getCourseFilter();
//getStatusFilter_with_makeover();
//getFilterSubmit();
?></div>
<br>
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','stdStatus','stdStatusmo-list');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 

 
echo "<th class='specalt'><b>ID</b></th>"; 
echo "<th class='specalt'><b>TranID</b></th>";
echo "<th class='specalt'><b>Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>sch ID</b></th>";  
echo "<th class='specalt'><b>teacher</b></th>"; 
 
echo "<th class='specalt'><b>Amt</b></th>";
echo "<th class='specalt'><b>operator</b></th>";
echo "<th class='specalt'><b>Course</b></th>";
echo "<th class='specalt'><b>class</b></th>";

echo "<th class='specalt'><b>date Received</b></th>";



echo "<th class='specalt' colspan=4><b>Actions</b></th>";  
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());

if($_SESSION['userId']==159 || $_SESSION['userId']==1 || $_SESSION['userId']==48)
{
	$result = "SELECT * FROM campus_transaction";
	$result = mysql_query($result);
}	


while($row = mysql_fetch_array($result)){ 

echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['transactionID']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['schedule_id']) . "</td>";
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";
  
 
echo "<td valign='top'>" . nl2br( $row['amount']) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['operator'])) . "</td>";  
echo "<td valign='top'>" . getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>"; 

echo "<td valign='top'>" . nl2br( $row['dateRecieved']) . "</td>"; 

echo "<td valign='top'><a class=button href=transaction_edit_ver2.php?id={$row['id']}&studentID={$row['studentID']}&crs={$row['courseID']}&classType={$row['classType']}&schedule_id={$row['schedule_id']}&teacherID={$row['teacherID']}>Edit</a></td>";

echo "</tr>"; 
} 

echo "</table>"; 
//echo "<a href=book_scheduler_new.php class=button></a>"; 
include('include/footer.php');
?>