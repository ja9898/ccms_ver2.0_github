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

 
echo "<th class='specalt'><b>id</b></th>";
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>StartTime</b></th>"; 
echo "<th class='specalt'><b>Amount/Dues</b></th>"; 
echo "<th class='specalt'><b>Discount</b></th>"; 
echo "<th class='specalt'><b>Signin Date</b></th>";
echo "<th class='specalt'><b>Pay Date</b></th>";


echo "<th class='specalt' colspan=4><b>Actions</b></th>";  
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());

if($_SESSION['userType']==5)
{
	$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.startTime'); 
}
else if(isset($_POST['search-submit']) && $_POST['stdStatus']!="" && $_POST['stdStatus']!=0)
{
	//$result=mysql_query($select_sta_query);
	$result = getResultResource($_table='campus_schedule',$_post="",$_where="campus_schedule.std_status='".$_POST['stdStatus']."' and status=1 and campus_schedule.std_status!='3'",$join='',$joinFields=',campus_students.firstName as name,campus_students.std_status as std_status',$joinWhere='',$joinselect="left JOIN campus_students ON campus_schedule.studentID=campus_students.id",$orderby="order by name asc",$_fields="campus_schedule.std_status as statussch");
	//$check=0;
}
else{
	if($_SESSION['userId']==1 || $_SESSION['userId']==48 || $_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userId']==411 )
	{
	$result = getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status="2"',"",",campus_students.firstName as name,campus_students.std_status as std_status",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id ","order by campus_students.firstName asc",'campus_schedule.std_status as statussch,campus_schedule.dues,campus_schedule.paydate,campus_schedule.startTime,campus_students.firstName');
	}
	}

	$rowcount = mysql_num_rows($result);
	
	$sum_dues=array();

while($row = mysql_fetch_array($result)){ 

$sum=$row['dues'];

$sum_dues[$row['id']]=$sum;



$query="select `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
/*echo "<td valign='top'>";
if(!empty($rows['phone'])){

echo "[" . nl2br( $rows['phone'] )."]";
}
if(!empty($rows['mobile'])){
echo " <br>[".nl2br( $$rows['mobile'] )."]";
}
if(!empty($$rows['landline'])){
echo "<br>[".nl2br( $rows['landline'] ) . "]";
}
echo "</td>";  */

echo "<td valign='top'>" .  $row['id'] . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['discount']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['duedate']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['paydate']) . "</td>";

  

if($_SESSION['userId']==159)
{
echo "<td valign='top'><a class=button href=book_scheduler_edit_amounts_ver2.php?id={$row['id']}>Edit</a></td>";
}
else
{
echo "<td valign='top'><a class=button href=#>N/A</a></td>";
}
echo "</tr>"; 
} 

echo "<tr>";  
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum </td>";  
  
echo "<td valign='top'><b>$" . nl2br( array_sum($sum_dues))  . "</td>";  
echo "<td valign='top'></td>";

 
echo "</tr>";

echo "</table>"; 
echo "</table>"; 
//echo "<a href=book_scheduler_new.php class=button></a>"; 
include('include/footer.php');
?>