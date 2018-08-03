<? 
include('config.php');
include('include/header.php'); 
//BEST EXAMPLE TO Group by two columns and sum(Google search-how to group by two columns in sql php and sum the values?) 
//http://stackoverflow.com/questions/11025623/mysql-group-by-two-columns-and-sum

//Just for reference-NOT THAT USEFUL(how to show teacher one in mysql and group by on subject and status)
//http://stackoverflow.com/questions/8411116/mysql-display-all-records-and-count-related-records
//http://stackoverflow.com/questions/9954697/mysql-group-by-subject
//http://learn.shayhowe.com/html-css/organizing-data-tables

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 

 ?></div>
<div style="float:left">
<?php
?></div>
<br>
</form>
</div>
<?
//////////////////******************** 1st TABLE for MON,TUE,WED***********************\\\\\\\\\\\\\\\\\\\\\\
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
   
echo "<th colspan=1 class='specalt'><b>Start Time</b></th>";
echo "<th colspan=1 class='specalt' style='color:red; font-weight:bold'><b>Mon,Tues,Wed</b></th>";
echo "<th colspan=1 class='specalt' style='color:green; font-weight:bold'><b>Business</b></th>"; 
echo "<th colspan=1 class='specalt' style='color:red; font-weight:bold'><b>Thur,Fri,Sat</b></th>"; 
echo "<th colspan=1 class='specalt' style='color:green; font-weight:bold'><b>Business</b></th>";  
 
echo "</tr>"; 


if($_SESSION['userType']==5)
{
	
}

else
{
//Arrays for Mon,Tues,Wed - Query1
$total_regular_sum_array=array();
$total_amount_sum_array=array();
//Arrays for Thur,Fri,Sat - Query2
$total_regular_sum_array2=array();
$total_amount_sum_array2=array();

$start_24hr='22:00';
$start_12hr = date('g:iA ', strtotime($start_24hr));	//10:00PM
	
$end_24hr='09:00';
$end_12hr = date('g:iA ', strtotime($end_24hr));		//08:00AM


while($start_12hr<$end_12hr)	
{
	//Mysql query for counting the REGULAR classes on MON,TUE,WED i.e classtype=1	
	$result_regular="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID  
	FROM campus_schedule 
	WHERE campus_schedule.std_status=2 and campus_schedule.std_status!=3 and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.teacherID!=262 and campus_schedule.classType=1 and campus_schedule.startTime='$start_24hr' and campus_schedule.courseID!=11 "; 
	$result_regular.=" GROUP BY campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc";
	$row_regular = mysql_fetch_array(mysql_query($result_regular));
	
	//Mysql query for counting the REGULAR classes on MON,TUE,WED i.e classtype=2
	$result_regular2="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID 
	FROM campus_schedule 
	WHERE campus_schedule.std_status=2 and campus_schedule.std_status!=3 and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.teacherID!=262 and campus_schedule.classType=2 and campus_schedule.startTime='$start_24hr' and campus_schedule.courseID!=11 "; 
	$result_regular2.=" GROUP BY campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc";
	$row_regular2 = mysql_fetch_array(mysql_query($result_regular2));

	//while(($row_regular = mysql_fetch_array($result_regular)))
	//{ 
		//Populating arrays for MON,TUE,WED 
		$total_regular_sum_array[$row_regular['sch_id']] = $row_regular['cnt_regular'];
		$total_amount_sum_array[$row_regular['sch_id']] = $row_regular['dues'];
		$total_amount_per_teacher = $row_regular['dues'];
		
		
		//Populating arrays for THUR,FRI,SAT
		$total_regular_sum_array2[$row_regular2['sch_id']] = $row_regular2['cnt_regular'];
		$total_amount_sum_array2[$row_regular2['sch_id']] = $row_regular2['dues'];
		$total_amount_per_teacher2 = $row_regular2['dues'];
		
		echo "<tr>";
		echo "<td valign='top'>" . $start_24hr . "</td>";
		
		echo "<td valign='top' style='color:red; font-weight:bold'>" . $row_regular['cnt_regular'] . "</td>";
		echo "<td valign='top' style='color:green; font-weight:bold'>$ " . $row_regular['dues'] . "</td>";
		
		echo "<td valign='top' style='color:red; font-weight:bold'>" . $row_regular2['cnt_regular'] . "</td>";
		echo "<td valign='top' style='color:green; font-weight:bold'>$ " . $row_regular2['dues'] . "</td>";
		echo "</tr>"; 
	//}
	$start_24hr = date('H:i ', strtotime($start_24hr) + (3600));
	$start_12hr = date('g:iA ', strtotime($start_12hr) +(3600));
	if($start_12hr>$end_12hr)
	{
		break;
	}
}
}
echo "<tr>";

echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red; font-weight:bold'><b>" . nl2br( array_sum($total_regular_sum_array)) . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($total_amount_sum_array)) . "</td>";   

echo "<td valign='top' style='color:red; font-weight:bold'><b>" . nl2br( array_sum($total_regular_sum_array2)) . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($total_amount_sum_array2)) . "</td>";   

echo "</tr>";
//echo "</table>"; 









//Arrays for Mon,Tues,Wed - Query1
$total_regular_sum_array3=array();
$total_amount_sum_array3=array();
//Arrays for Thur,Fri,Sat - Query2
$total_regular_sum_array4=array();
$total_amount_sum_array4=array();

$start_24hr3='09:00';echo "<br>";
$start_12hr3 = date('g:iA ', strtotime($start_24hr3));echo "<br>";	//09:00AM
	
$end_24hr4='19:00';echo "<br>";
$end_12hr4 = date('g:iA ', strtotime($end_24hr4));echo "<br>";		//07:00PM


while($start_24hr3<$end_24hr4)	
{
	//Mysql query for counting the REGULAR classes on MON,TUE,WED i.e classtype=1	
	$result_regular3="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID  
	FROM campus_schedule 
	WHERE campus_schedule.std_status=2 and campus_schedule.std_status!=3 and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.teacherID!=262 and campus_schedule.classType=1 and campus_schedule.startTime='$start_24hr3' and campus_schedule.courseID!=11 "; 
	$result_regular3.=" GROUP BY campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc";
	$row_regular3 = mysql_fetch_array(mysql_query($result_regular3));
	
	//Mysql query for counting the REGULAR classes on MON,TUE,WED i.e classtype=2
	$result_regular4="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID 
	FROM campus_schedule 
	WHERE campus_schedule.std_status=2 and campus_schedule.std_status!=3 and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.teacherID!=262 and campus_schedule.classType=2 and campus_schedule.startTime='$start_24hr3' and campus_schedule.courseID!=11 "; 
	$result_regular4.=" GROUP BY campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc";
	$row_regular4 = mysql_fetch_array(mysql_query($result_regular4));

	//while(($row_regular = mysql_fetch_array($result_regular)))
	//{ 
		//Populating arrays for MON,TUE,WED 
		$total_regular_sum_array3[$row_regular3['sch_id']] = $row_regular3['cnt_regular'];
		$total_amount_sum_array3[$row_regular3['sch_id']] = $row_regular3['dues'];
		$total_amount_per_teacher3 = $row_regular3['dues'];
		
		
		//Populating arrays for THUR,FRI,SAT
		$total_regular_sum_array4[$row_regular4['sch_id']] = $row_regular4['cnt_regular'];
		$total_amount_sum_array4[$row_regular4['sch_id']] = $row_regular4['dues'];
		$total_amount_per_teacher4 = $row_regular4['dues'];
		
		echo "<tr>";
		echo "<td valign='top'>" . $start_24hr3 . "</td>";
		
		echo "<td valign='top' style='color:red; font-weight:bold'>" . $row_regular3['cnt_regular'] . "</td>";
		echo "<td valign='top' style='color:green; font-weight:bold'>$ " . $row_regular3['dues'] . "</td>";
		
		echo "<td valign='top' style='color:red; font-weight:bold'>" . $row_regular4['cnt_regular'] . "</td>";
		echo "<td valign='top' style='color:green; font-weight:bold'>$ " . $row_regular4['dues'] . "</td>";
		echo "</tr>"; 
	//}
	$start_24hr3 = date('H:i ', strtotime($start_24hr3) + (3600));
	$start_12hr3 = date('g:iA ', strtotime($start_12hr3) +(3600));
	if($start_12hr3>$end_12hr4)
	{
		break;
	}
}

echo "<tr>";

echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red; font-weight:bold'><b>" . nl2br( array_sum($total_regular_sum_array3)) . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($total_amount_sum_array3)) . "</td>";   

echo "<td valign='top' style='color:red; font-weight:bold'><b>" . nl2br( array_sum($total_regular_sum_array4)) . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold'><b>$" . nl2br( array_sum($total_amount_sum_array4)) . "</td>";   

echo "</tr>";
echo "</table>"; 





?>







<?
//VERY IMPORTANT
//***NOTE : WHILE LOOP of Query within WHILE LOOP of Hours(startTime) is o.k but we can get the required
//results by using ONLY WHILE LOOP of HOURS(startTime - 12 hrs ,24 hrs etc)
//becasue the QUERY counts the regular classes for one specific startTime e.g 22:00 and
//the WHILE LOOP of HOURS increamnets by one and 
//the QUERY counts the regular classes for one specific startTime e.g 23:00 and so on
//SO COMMENTING FOLLOWING TABLE - GOOD for just the information / reference***\\\
//////////////////********************2nd TABLE for THUR,FRI,SAT***********************\\\\\\\\\\\\\\\\\\\\\\
/*
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
   
echo "<th colspan=1 class='specalt'><b>Start Time</b></th>";
echo "<th colspan=1 class='specalt'><b>Thur,Fri,Sat</b></th>";  
echo "<th colspan=1 class='specalt'><b>Business</b></th>"; 
 
echo "</tr>"; 

if($_SESSION['userType']==5)
{
	
}

else
{
$total_regular_sum_array2=array();
$total_amount_sum_array2=array();

$start_24hr2='22:00';
$start_12hr2 = date('g:iA ', strtotime($start_24hr2));	//10:00PM
	
$end_24hr2='09:00';
$end_12hr2 = date('g:iA ', strtotime($end_24hr2));		//08:00AM

while($start_12hr2<$end_12hr2)	
{
		
	$result_regular2="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType,campus_schedule.startTime,campus_schedule.courseID 
	FROM campus_schedule 
	WHERE campus_schedule.std_status=2 and campus_schedule.std_status!=3 and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.teacherID!=262 and campus_schedule.classType=2 and campus_schedule.startTime='$start_24hr2' and campus_schedule.courseID!=11 "; 
	$result_regular2.=" GROUP BY campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc";
	$result_regular2=mysql_query($result_regular2);

	while(($row_regular2 = mysql_fetch_array($result_regular2)))
	{ 
		$total_regular_sum_array2[$row_regular2['sch_id']] = $row_regular2['cnt_regular'];
		$total_amount_sum_array2[$row_regular2['sch_id']] = $row_regular2['dues'];


		$total_amount_per_teacher2 = $row_regular2['dues'];
		echo "<tr>";

		echo "<td valign='top'>" . $start_24hr2 . "</td>";
		echo "<td valign='top'>" . $row_regular2['cnt_regular'] . "</td>";
		echo "<td valign='top'>$ " . $row_regular2['dues'] . "</td>";


		echo "</tr>"; 
	}
	$start_24hr2 = date('H:i ', strtotime($start_24hr2) + (3600));
	$start_12hr2 = date('g:iA ', strtotime($start_12hr2) +(3600));
	if($start_12hr2>$end_12hr2)
	{
		break;
	}
}
}
echo "<tr>";

echo "<td valign='top'> </td>";
echo "<td valign='top'><b>" . nl2br( array_sum($total_regular_sum_array2)) . "</td>";
echo "<td valign='top'><b>$" . nl2br( array_sum($total_amount_sum_array2)) . "</td>";   
$total_reg_classes2 = nl2br( array_sum($total_regular_sum_array2));
$total_dollar_amount_of_reg_classes2 = nl2br( array_sum($total_amount_sum_array2));
echo "</tr>";
echo "</table>"; 
*/


include('include/footer.php');
?>