	<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<div style="float:left"><?php 
getStudentFilter();
getTeacherFilter();
getTeacherFilterLead();
getStartTimeFilter(); ?></div>

<div style="float:left">
<?php
getStatusFilter_with_makeover();
getFilterSubmit();
echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');
echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');
?></div>

<br>
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Course ID</b></th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>"; 
echo "<th class='specalt'><b>present/absent</b></th>";
echo "<th class='specalt'><b>TeamLead</b></th>";
echo "<th class='specalt'><b>Date</b></th>";
echo "</tr>"; 

if(isset($_POST['submit']) || !empty($_POST['search-teacher-id']) || !empty($_POST['search-student-id']) || !empty($_POST['stdStatus']) || !empty($_POST['search-teacher-id2']) || (!empty($_POST['fromDate']) && !empty($_POST['toDate'])))
{
	if($_SESSION['userType']==5)
	{
		$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and status_dead=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch'); 
	}


	else if($_SESSION['userType']==8)
	{
		$result = getResultResource_teamlead_present_absent();	
		//COUNT REGULAR TRIAL
	$count_reg_tr=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 GROUP BY campus_schedule.std_status");
		$count_reg_tr_result=mysql_query($count_reg_tr);
		while($row_count = mysql_fetch_array($count_reg_tr_result))
		{ 
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
		}
	}


	/*else if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$result = getResultResource_teamlead_present_absent_superadmin();
		//COUNT REGULAR TRIAL
	$count_reg_tr=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0  
		GROUP BY campus_schedule.std_status");
		$count_reg_tr_result=mysql_query($count_reg_tr);
		while($row_count = mysql_fetch_array($count_reg_tr_result))
		{ 
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
		}
	}*/


	else
	{
		$result = getResultResource_teamlead_present_absent_superadmin();
		//COUNT REGULAR TRIAL
	$count_reg_tr=("SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0  
		GROUP BY campus_schedule.std_status");
		$count_reg_tr_result=mysql_query($count_reg_tr);
		while($row_count = mysql_fetch_array($count_reg_tr_result))
		{ 
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
		}
	}

$rowcount = mysql_num_rows($result);
$while_1=1;
while($row = mysql_fetch_array($result)){ 

//$query="select `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline from `campus_students` where campus_students.id=".$row['studentID'];
//$results=mysql_query($query);
//$rows=mysql_fetch_array($results);

//QUERY FOR PRESENT/ABSENT/MAKEOVER  STATUS column coming from campus_attendance_student
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	//$pa_status="SELECT * FROM campus_attendance_student WHERE studentID='".$row['studentID']."' and teacherID='".$row['teacherID']."' and startTime='".$row['startTime']."' and courseID='".$row['courseID']."' and classType='".$row['classType']."' and std_status='".$row['statussch']."' and date>='".nl2br(prepareDate($_POST['fromDate']))."' and date<='".nl2br(prepareDate($_POST['toDate']))."' ";

	//QUERY FOR THE PRESENT/ABSENT COUNT according to REGULAR/TRIAL
	//$pa_status_reg_tr_result=mysql_query("SELECT count(studentID) as sa_cnt,std_status,status,count(status) as sa_S FROM campus_attendance_student WHERE date>='".nl2br(prepareDate($_POST['fromDate']))."' and date<='".nl2br(prepareDate($_POST['toDate']))."' GROUP BY std_status,status ");
	
	
	//QUERY for counting , NOT WORKING - 26-06-2013
	
	/******************      MMAKE FOLLOWING QUERY WORK for Trial-Regular Present/Absent count    ***********************/
	
	
	$pa_status_reg_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status as sa_stu_status,campus_attendance_student.status as sa_S,count(campus_attendance_student.status) as sa_S_cnt 
	FROM campus_attendance_student 
	INNER JOIN campus_schedule ON 
	campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.classType=campus_attendance_student.classType and 
	campus_schedule.std_status=campus_attendance_student.std_status and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 
	INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID ";
	/*$sql="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,
	campus_schedule.id as sch_id,campus_schedule.std_status as statussch,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
	campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
	campus_schedule.agentId,campus_schedule.classType,
	count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status as sa_stu_status,campus_attendance_student.status as sa_S,count(campus_attendance_student.status) as sa_S_cnt 
	FROM capmus_users 
	INNER JOIN campus_schedule ON capmus_users.id=campus_schedule.teacherID 
	INNER JOIN campus_attendance_student ON 
	campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.classType=campus_attendance_student.classType and 
	campus_schedule.std_status=campus_attendance_student.std_status and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 
	";*/
	
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$pa_status_reg_tr_result.= " and campus_attendance_student.date>='".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<='".prepareDate($_POST['toDate'])."' ";
	}
	if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
	{
		$pa_status_reg_tr_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
	}
	
	$pa_status_reg_tr_result.=" GROUP BY std_status,status";
	
	//echo $pa_status_reg_tr_result;
	
	echo $pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
	
	if($while_1==1)
	{
		while($pa_status_count = mysql_fetch_array($pa_status_reg_tr_result))
		{ 
			echo "<br><b><div style='float:left'>". getData(nl2br( $pa_status_count['sa_stu_status']),'stdStatusmo-list') . " : " . $pa_status_count['sa_cnt'] . " , " . getData(nl2br( $pa_status_count['sa_S']),'class_status') . " : " . $pa_status_count['sa_S_cnt'] . "</b>&nbsp;&nbsp;&nbsp;";
		}
		$while_1=0;
	}
	
}
else
{
	//$pa_status="SELECT * FROM campus_attendance_student WHERE studentID='".$row['studentID']."' and teacherID='".$row['teacherID']."' and startTime='".$row['startTime']."' and courseID='".$row['courseID']."' and classType='".$row['classType']."' and std_status='".$row['statussch']."' and date='".$_LIST['systemdate']."' ";
	
	//QUERY FOR THE PRESENT/ABSENT COUNT according to REGULAR/TRIAL
	//$pa_status_reg_tr_result=mysql_query("SELECT count(studentID) as sa_cnt,std_status,status,count(status) as sa_S FROM campus_attendance_student WHERE date='".$_LIST['systemdate']."' GROUP BY std_status,status ");

	
	
	if($while_1==1)
	{
		while($pa_status_count = mysql_fetch_array($pa_status_reg_tr_result))
		{ 
			//echo "<br><b><div style='float:left'>". getData(nl2br( $pa_status_count['std_status']),'stdStatusmo-list') . " : " . $pa_status_count['sa_cnt'] . " , " . getData(nl2br( $pa_status_count['status']),'class_status') . " : " . $pa_status_count['sa_S'] . "</b>&nbsp;&nbsp;&nbsp;";
		}
		$while_1=0;
	}
	
}
	//$pa_status_result=mysql_query($pa_status);
	//$pa_status_result=mysql_fetch_array($pa_status_result);

	
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  

echo "<td valign='top'>" . getData( nl2br( $row['courseID']),'course') . "</td>";   
echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row['agentId'])) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['statussch']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['sa_S']),'class_status') . "</td>";
echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row['sa_date']) . "</td>";
echo "</tr>"; 
} 
echo "</table>"; 



echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt' colspan=3><b>Trial</b></th>"; 
echo "<th class='specalt' colspan=3><b>Regular</b></th>"; 
echo "</tr>";


}


//Total TRIAL & REGULAR count
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
$pa_status_reg_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status 
	FROM campus_attendance_student 
	INNER JOIN campus_schedule ON 
	campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.classType=campus_attendance_student.classType and 
	campus_schedule.std_status=campus_attendance_student.std_status and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 
	INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and 
									campus_attendance_student.date>='".nl2br(prepareDate($_POST['fromDate']))."' and campus_attendance_student.date<='".nl2br(prepareDate($_POST['toDate']))."' "; 
									if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
									{
										$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
									}
									if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
									{
										$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
									}
									if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
									{
										$pa_status_reg_tr_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
									}
	if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
	{
		$pa_status_reg_tr_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
	}
									$pa_status_reg_tr_result.= " GROUP BY std_status ";
									//echo $pa_status_reg_tr_result;
									echo "<br>";
									echo "****";
$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}
/*else
{
$pa_status_reg_tr_result="SELECT count(studentID) as sa_cnt,std_status FROM campus_attendance_student WHERE date='".$_LIST['systemdate']."' ";
									if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
									{
										$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
									}
									if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
									{
										$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
									}
									if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
									{
										$pa_status_reg_tr_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
									}
									$pa_status_reg_tr_result.= " GROUP BY std_status ";
$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}*/
echo $total_trial_regular_count = mysql_num_rows($pa_status_reg_tr_result);	//Checking the number of rows that have been effected OR Selected
echo "<br>";
echo "123";

while($pa_status_count = mysql_fetch_array($pa_status_reg_tr_result))
{
	if($total_trial_regular_count==1 && $pa_status_count['std_status']==2 && $pa_status_count['std_status']!=1)
	{
		echo "<td valign='top'> </td>";
		echo "<td valign='top'> </td>";
		echo "<td valign='top'> </td>";
	}
	if($pa_status_count['std_status']==1)
	{
		$trial_total = $pa_status_count['sa_cnt'];		//Total trial count
	}
	if($pa_status_count['std_status']==2)
	{
		$regular_total = $pa_status_count['sa_cnt'];	//Total regular count
	}
	echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['std_status']),'stdStatusmo-list') . "</b></td>&nbsp;&nbsp;&nbsp;";
	echo "<td><b><div style='float:left'>" . $pa_status_count['sa_cnt'] . "</b></td>";
	echo "<td valign='top'> </td>";
}
echo "</tr>";





//TRIAL PRESENT count
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
$pa_status_reg_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
campus_attendance_student.status,count(campus_attendance_student.status) as sa_S 
	FROM campus_attendance_student 
	INNER JOIN campus_schedule ON 
	campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.classType=campus_attendance_student.classType and 
	campus_schedule.std_status=campus_attendance_student.std_status and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 
	INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and 
	campus_attendance_student.status=1 and campus_attendance_student.std_status=1 and 
									campus_attendance_student.date>='".nl2br(prepareDate($_POST['fromDate']))."' and campus_attendance_student.date<='".nl2br(prepareDate($_POST['toDate']))."' "; 
																
							
							if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}
	if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
	{
		$pa_status_reg_tr_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
	}
							/*if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
									{
										$pa_status_reg_tr_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
									}*/
							$pa_status_reg_tr_result.= " GROUP BY std_status,status ";
							$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}
/*else
{
$pa_status_reg_tr_result="SELECT count(studentID) as sa_cnt,std_status,status,count(status) as sa_S FROM campus_attendance_student WHERE status=1 and std_status=1 and date='".$_LIST['systemdate']."' " ;
							if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}
							///if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
								//	{
								//		$pa_status_reg_tr_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
								//	}
							$pa_status_reg_tr_result.=" GROUP BY std_status,status ";
							$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}*/

if(mysql_num_rows($pa_status_reg_tr_result)==0)	//Checking if there are no trial present count, if NOT then do formatting for regular present count
{
	echo "<td valign='top'> </td>";		//
	echo "<td valign='top'> </td>";		//Formatting table cells if there is NO trial present count,Only regular present count
	echo "<td valign='top'> </td>";		//
}
else
{
	while($pa_status_count = mysql_fetch_array($pa_status_reg_tr_result))
	{
		if($pa_status_count['status']!=0 && $pa_status_count['status']!=1)
		{
			echo "<td valign='top'> </td>";
			echo "<td valign='top'> </td>";
			echo "<td valign='top'> </td>";
		}
		echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $trial_present_count = $pa_status_count['sa_S'] . "</b></td>&nbsp;&nbsp;&nbsp;";
	}
		$trial_present_percentage = ($trial_present_count / $trial_total)*100;
		echo "<td><b><div style='float:left'>" . $trial_present_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
}
//echo "</tr>";


//REGULAR PRESENT count
//echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
$pa_status_reg_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
campus_attendance_student.status,count(campus_attendance_student.status) as sa_S 
	FROM campus_attendance_student 
	INNER JOIN campus_schedule ON 
	campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.classType=campus_attendance_student.classType and 
	campus_schedule.std_status=campus_attendance_student.std_status and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 
	INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and 
	campus_attendance_student.status=1 and campus_attendance_student.std_status=2 
	and date>='".nl2br(prepareDate($_POST['fromDate']))."' and date<='".nl2br(prepareDate($_POST['toDate']))."' ";
							if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}
							if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
	{
		$pa_status_reg_tr_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
	}
							$pa_status_reg_tr_result.= " GROUP BY std_status,status ";
							$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}
/*else
{
$pa_status_reg_tr_result="SELECT count(studentID) as sa_cnt,std_status,status,count(status) as sa_S FROM campus_attendance_student WHERE status=1 and std_status=2 and date='".$_LIST['systemdate']."' ";
							if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}
							$pa_status_reg_tr_result.= " GROUP BY std_status,status ";
							$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}*/
										//No formatting is required in regular present count, As REGULAR is the last COLUMN
	while($pa_status_count = mysql_fetch_array($pa_status_reg_tr_result))
	{ 
		echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $regular_present_count = $pa_status_count['sa_S'] . "</b></td>&nbsp;&nbsp;&nbsp;";
	}	
	$regular_present_percentage = ($regular_present_count / $regular_total)*100;
	echo "<td><b><div style='float:left'>" . $regular_present_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
echo "</tr>";











//TRIAL ABSENT count
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
$pa_status_reg_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
campus_attendance_student.status,count(campus_attendance_student.status) as sa_S 
	FROM campus_attendance_student 
	INNER JOIN campus_schedule ON 
	campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.classType=campus_attendance_student.classType and 
	campus_schedule.std_status=campus_attendance_student.std_status and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 
	INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and 
	campus_attendance_student.status=0 and campus_attendance_student.std_status=1 
	and date>='".nl2br(prepareDate($_POST['fromDate']))."' and date<='".nl2br(prepareDate($_POST['toDate']))."' ";
						if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
						{
							$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
						}
						if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
						{
							$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
						}
						if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
	{
		$pa_status_reg_tr_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
	}
						$pa_status_reg_tr_result.= " GROUP BY std_status,status ";
						$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}
/*else
{
$pa_status_reg_tr_result="SELECT count(studentID) as sa_cnt,std_status,status,count(status) as sa_S FROM campus_attendance_student WHERE status=0 and std_status=1 and date='".$_LIST['systemdate']."' ";
						if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
						{
							$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
						}
						if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
						{
							$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
						}
						$pa_status_reg_tr_result.=" GROUP BY std_status,status ";
						$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}*/

if(mysql_num_rows($pa_status_reg_tr_result)==0)	//Checking if there are no trial absent count, if NOT then do formatting for regular absent count
{
	echo "<td valign='top'> </td>";		//
	echo "<td valign='top'> </td>";		//Formatting table cells if there is NO trial absent count,Only regular absent count
	echo "<td valign='top'> </td>";		//
}
else
{
	while($pa_status_count = mysql_fetch_array($pa_status_reg_tr_result))
	{ 
		if($pa_status_count['status']!=1)
		{
			//echo "<td valign='top'> </td>";
			//echo "<td valign='top'> </td>";
		}
		echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $trial_absent_count = $pa_status_count['sa_S'] . "</b></td>&nbsp;&nbsp;&nbsp;";
	}
		$trial_absent_percentage = ($trial_absent_count / $trial_total)*100;
		echo "<td><b><div style='float:left'>" . $trial_absent_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
}

//REGULAR ABSENT count
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
$pa_status_reg_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
campus_attendance_student.status,count(campus_attendance_student.status) as sa_S 
	FROM campus_attendance_student 
	INNER JOIN campus_schedule ON 
	campus_schedule.studentID=campus_attendance_student.studentID and 
	campus_schedule.teacherID=campus_attendance_student.teacherID and 
	campus_schedule.startTime=campus_attendance_student.startTime and 
	campus_schedule.courseID=campus_attendance_student.courseID and 
	campus_schedule.classType=campus_attendance_student.classType and 
	campus_schedule.std_status=campus_attendance_student.std_status and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status!=3 
	INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and 
	campus_attendance_student.status=0 and campus_attendance_student.std_status=2 
	and date>='".nl2br(prepareDate($_POST['fromDate']))."' and date<='".nl2br(prepareDate($_POST['toDate']))."' ";
						if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
						{
							$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
						}
						if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
						{
							$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
						}
						if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
	{
		$pa_status_reg_tr_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
	}
						$pa_status_reg_tr_result.=" GROUP BY std_status,status ";
						$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}
/*else
{
$pa_status_reg_tr_result="SELECT count(studentID) as sa_cnt,std_status,status,count(status) as sa_S FROM campus_attendance_student WHERE status=0 and std_status=2 and date='".$_LIST['systemdate']."' ";
						if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
						{
							$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
						}
						if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
						{
							$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
						}
						$pa_status_reg_tr_result.=" GROUP BY std_status,status ";
						$pa_status_reg_tr_result = mysql_query($pa_status_reg_tr_result);
}*/
										//No formatting is required in regular absent count, As REGULAR is the last COLUMN
while($pa_status_count = mysql_fetch_array($pa_status_reg_tr_result))
{ 
	if($pa_status_count['status']!=1)
	{
		//echo "<td valign='top'> </td>";
		//echo "<td valign='top'> </td>";
	}
	echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
	echo "<td><b><div style='float:left'>" . $regular_absent_count = $pa_status_count['sa_S'] . "</b></td>&nbsp;&nbsp;&nbsp;";
}
	$regular_absent_percentage = ($regular_absent_count / $regular_total)*100;
	echo "<td><b><div style='float:left'>" . $regular_absent_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
	
echo "</tr>";

echo "</table>";

include('include/footer.php');
?>