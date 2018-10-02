<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


<br>
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','stdStatus','stdStatusmo-list');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Contact No.</b></th>"; 
//echo "<th class='specalt'><b>ID</b></th>"; 
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'>Country</th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>"; 
echo "<th class='specalt' colspan=4><b>Actions</b></th>";  
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());
$expr1='02:00';
$expr2='03:00';
//echo $out=subtime($expr2,$expr1);
echo $livetime = time() + 3600 . "<br>";
echo $livetime = date('H:i:s', time() + 3600)."<br>"; // 16:00:00
date('H:i ', strtotime(nl2br( $row['startTime'])) + 3600)."<br>";
echo $livetime = date('g:iA ', time() + 3600)."<br>"; // 4:00PM
$result="SELECT campus_schedule.startTime,campus_schedule.endTime,campus_schedule.id as sch_id,
		campus_schedule.studentID,campus_schedule.std_status,campus_schedule.courseID,campus_schedule.teacherID,
		campus_schedule.classType,
		campus_schedule.dues,campus_schedule.dues_original, 
		campus_schedule.dues_amountDefaultNew_Usd,campus_schedule.dues_amountDefaultNew,
		campus_schedule.dues_discountNew_Usd,campus_schedule.statusPendRejAccpt,
		campus_students.id,campus_students.countryID 
		FROM campus_schedule 
		INNER JOIN campus_students 
		ON campus_schedule.studentID=campus_students.id and campus_schedule.status=1 and 
		campus_schedule.statusPendRejAccpt=1 and 
		(campus_schedule.std_status=1 OR campus_schedule.std_status=2 OR 
		campus_schedule.std_status=3 OR campus_schedule.std_status=4) 
		ORDER BY  campus_students.countryID asc";

	
	$result=mysql_query($result);
	echo "count:".$rowcount = mysql_num_rows($result);
	echo "<br>";
	
while($row = mysql_fetch_array($result)){ 
$query2="select `campus_students`.id,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.countryID=130 and campus_students.id=".$row['studentID'];
$results2=mysql_query($query2);
$rows2=mysql_fetch_array($results2);


foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>";
if(!empty($rows['phone'])){

echo "[" . nl2br( $rows['phone'] )."]";
}
if(!empty($rows['mobile'])){
echo " <br>[".nl2br( $$rows['mobile'] )."]";
}
if(!empty($$rows['landline'])){
echo "<br>[".nl2br( $rows['landline'] ) . "]";
}
echo "</td>";  
echo "<td valign='top'>" . nl2br( $row['sch_id']) . "</td>";  

echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['countryID']),'country'). "</td>";
echo "<td valign='top'>" . nl2br( $row['startTime']). "</td>";
echo "<td valign='top'>" . nl2br( $row['endTime']). "</td>";

//$time_var_startTime = date('H:i ', strtotime(nl2br( $row['startTime'])) + (3600)) ;  
//$time_var_endTime = date('H:i ', strtotime(nl2br( $row['endTime'])) + (3600)) ;  

echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" .showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top'>" .showUser( nl2br( $row['agentId'])) . "</td>";
echo "<td valign='top'>" .getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";  
  

//Commenting following so that no one should accidently make an hour BACK or FORWARD  
//CHANGE STARTTIME or ENDTIME to make the required TIME FIELD to change 1 hour back(or according to the requirement)
echo $update_amount="UPDATE campus_schedule 
SET campus_schedule.dues='".$row['dues_amountDefaultNew_Usd']."',
campus_schedule.dues_original='".$row['dues_amountDefaultNew']."', 
campus_schedule.discount='".$row['dues_discountNew_Usd']."' 

WHERE campus_schedule.courseID='".$row['courseID']."' and 
campus_schedule.teacherID='".$row['teacherID']."' and campus_schedule.classType='".$row['classType']."' and  
campus_schedule.id='".$row['sch_id']."' "; echo "<br>";
$out=mysql_query($update_amount);
  
  
if($_SESSION['userType']==8)
{
	if($_SESSION['userId']==203)
	{
	echo "<td valign='top'><a class=button>N/A</a></td>";
	}
	else
	{
		echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['sch_id']}>Edit</a></td>
		<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead_message.php?id={$row['sch_id']}>Dead</a></td>";
		if($row['statussch']=='1')
		{
		echo "<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['sch_id']}&crs={$row['courseID']}&classType={$row['classType']}>Make Regular</a></td> ";
		}
	}
}

else if($_SESSION['userType']==10)
{
		echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['sch_id']}>Edit</a></td>
		<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead_message.php?id={$row['id']}>Dead</a></td>";
		if($row['statussch']=='1')
		{
		echo "<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['sch_id']}&crs={$row['courseID']}&classType={$row['classType']}>Make Regular</a></td> ";
		}
}

else
{
	echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id=#>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=book_scheduler_delete.php?id=#>Delete</a></td>
	<td><a onclick=\"return confirm('Are you sure you want to mark this record Dead?')\" class=button href=book_scheduler_dead.php?id=#>Dead</a></td>";
	if($row['statussch']=='1')
	{
		echo "<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['id']}&crs={$row['courseID']}&classType={$row['classType']}>Make Regular</a></td> ";
	} 
}



/*if($row['statussch']=='1'){

echo "
<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['id']}>Make Regular</a></td> ";} */
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=# class=button>New Row</a>"; 
include('include/footer.php');
?>