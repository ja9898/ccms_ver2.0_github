	<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<div style="float:left"><?php 
//getStudentFilter();
//getTeacherFilter();
getTeacherFilterLead();
getPlanFilter();
//getStartTimeFilter(); ?></div>

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
		$count_reg_tr="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.status,campus_schedule.classType 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 ";
		if(isset($_POST['classType']) && !empty($_POST['classType']))
		{
			$count_reg_tr.=" and ".getClassTypeSchedule($_POST['classType'])." ";
		}
		$count_reg_tr.=" GROUP BY campus_schedule.std_status";
		$count_reg_tr_result=mysql_query($count_reg_tr);
		while($row_count = mysql_fetch_array($count_reg_tr_result))
		{ 
			if($row_count['std_status']==1)
			{
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $top_trial = $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
			}
			if($row_count['std_status']==2)
			{
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $top_regular = $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
			}
			if($row_count['std_status']==5)
			{
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $top_MO = $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
			}
			echo "<br>";
			
		}
		echo $top_regular_and_MO = $top_regular + $top_MO." ";
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
		$count_reg_tr="SELECT capmus_users.id,capmus_users.LeadId,campus_schedule.std_status,count(campus_schedule.studentID) as cnt,campus_schedule.status,campus_schedule.classType 
		FROM capmus_users 
		INNER JOIN campus_schedule 
		ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 ";
		if(isset($_POST['classType']) && !empty($_POST['classType']))
		{
			$count_reg_tr.=" and ".getClassTypeSchedule($_POST['classType'])." ";
		}
		if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
		{
			$count_reg_tr.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."' ";
		}
		$count_reg_tr.=" GROUP BY campus_schedule.std_status";
		$count_reg_tr_result=mysql_query($count_reg_tr);
		while($row_count = mysql_fetch_array($count_reg_tr_result))
		{ 
			if($row_count['std_status']==1)
			{
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $top_trial = $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
			}
			if($row_count['std_status']==2)
			{
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $top_regular = $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
			}
			if($row_count['std_status']==5)
			{
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . " : " . $top_MO = $row_count['cnt']."</b>&nbsp;&nbsp;&nbsp;";
			}
			echo "<br>";
			
		}
		echo $top_regular_and_MO = $top_regular + $top_MO." ";
	}

$rowcount = mysql_num_rows($result);
$while_1=1;
while($row = mysql_fetch_array($result)){ 



	
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
echo "<th class='specalt' colspan=3><b>Trial - ". $top_trial ."</b></th>"; 
echo "</tr>";


}


//Total TRIAL started
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	if($_SESSION['userType']==8)
	{
		$pa_status_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status 
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
			INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=1 and 
											campus_attendance_student.date>='".nl2br(prepareDate($_POST['fromDate']))."' and campus_attendance_student.date<='".nl2br(prepareDate($_POST['toDate']))."' "; 
											/*if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
											{
												$pa_status_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
											}
											if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
											{
												$pa_status_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
											}
											if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
											{
												$pa_status_tr_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
											}*/
			if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
			{
				$pa_status_tr_result.= " and capmus_users.LeadId = '".$_SESSION['userId']."' ";
			}
											$pa_status_tr_result.= " GROUP BY std_status ";
		$pa_status_tr_result = mysql_query($pa_status_tr_result);
	}


	else
	{
		$pa_status_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status 
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
			INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=1 and 
											campus_attendance_student.date>='".nl2br(prepareDate($_POST['fromDate']))."' and campus_attendance_student.date<='".nl2br(prepareDate($_POST['toDate']))."' "; 
											if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
											{
												$pa_status_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
											}
											if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
											{
												$pa_status_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
											}
											if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
											{
												$pa_status_tr_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
											}
											if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
											{
												$pa_status_tr_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
											}
											$pa_status_tr_result.= " GROUP BY std_status ";
		$pa_status_tr_result = mysql_query($pa_status_tr_result);
	}
}

$total_trial_count = mysql_num_rows($pa_status_tr_result);


while($pa_status_count = mysql_fetch_array($pa_status_tr_result))
{
	if($pa_status_count['std_status']==1)
	{
		$trial_total = $pa_status_count['sa_cnt'];		//Total trial count
	}
	echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['std_status']),'stdStatusmo-list') . " - classes started</b></td>&nbsp;&nbsp;&nbsp;";
	echo "<td><b><div style='float:left'>" . $pa_status_count['sa_cnt'] . "</b></td>";
	echo "<td valign='top'> </td>";
}
echo "</tr>";

//TRIAL PRESENT count
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	if($_SESSION['userType']==8)
	{
		$pa_status_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
																	
								
								/*if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
								{
									$pa_status_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
								}
								if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
								{
									$pa_status_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
								}*/
								if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
								{
									$pa_status_tr_result.= " and capmus_users.LeadId = '".$_SESSION['userId']."'";
								}
								/*if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
										{
											$pa_status_tr_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
										}*/
								$pa_status_tr_result.= " GROUP BY std_status,status ";
								$pa_status_tr_result = mysql_query($pa_status_tr_result);
	}

	else
	{
		$pa_status_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
									$pa_status_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
								}
								if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
								{
									$pa_status_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
								}
								if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
								{
									$pa_status_tr_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
								}
								/*if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
										{
											$pa_status_tr_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
										}*/
								$pa_status_tr_result.= " GROUP BY std_status,status ";
								$pa_status_tr_result = mysql_query($pa_status_tr_result);
	}
}
if(mysql_num_rows($pa_status_tr_result)==0)	
{
	echo "<td valign='top'>Present</td>";	//
	echo "<td valign='top'>0</td>";			//Formatting table cells if there is NO trial present count,Only regular present count
	echo "<td valign='top'>0</td>";			//
}
else
{
	while($pa_status_count = mysql_fetch_array($pa_status_tr_result))
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
		$trial_present_percentage = ($trial_present_count / $top_trial)*100;
		echo "<td><b><div style='float:left'>" . $trial_present_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
}
echo "</tr>";

//TRIAL ABSENT count
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	if($_SESSION['userType']==8)
	{
		$pa_status_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
							/*if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
							{
								$pa_status_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}*/
							if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
							{
								$pa_status_tr_result.= " and capmus_users.LeadId = '".$_SESSION['userId']."'";
							}
							$pa_status_tr_result.= " GROUP BY std_status,status ";
							$pa_status_tr_result = mysql_query($pa_status_tr_result);
	}
	else
	{
		$pa_status_tr_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
								$pa_status_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}
							if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
							{
								$pa_status_tr_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
							}
							$pa_status_tr_result.= " GROUP BY std_status,status ";
							$pa_status_tr_result = mysql_query($pa_status_tr_result);
	}
}

if(mysql_num_rows($pa_status_tr_result)==0)	
{
	echo "<td valign='top'>Absent</td>";		//
	echo "<td valign='top'>0</td>";				//Formatting table cells if there is NO trial absent count,Only regular absent count
	echo "<td valign='top'>0</td>";				//
}
else
{
	while($pa_status_count = mysql_fetch_array($pa_status_tr_result))
	{ 
		if($pa_status_count['status']!=1)
		{
			//echo "<td valign='top'> </td>";
			//echo "<td valign='top'> </td>";
		}
		echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $trial_absent_count = $pa_status_count['sa_S'] . "</b></td>&nbsp;&nbsp;&nbsp;";
	}
		$trial_absent_percentage = ($trial_absent_count / $top_trial)*100;
		echo "<td><b><div style='float:left'>" . $trial_absent_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
}

echo "</tr>";

//TRIAL OTHERS count
echo "<tr>";
	echo "<td><b><div style='float:left'>Others</b></td>&nbsp;&nbsp;&nbsp;";
	echo "<td><b><div style='float:left'>" . $others_total_trial = ($top_trial - ($trial_present_count + $trial_absent_count)) . "</b></td>&nbsp;&nbsp;&nbsp;";
	$trial_others_percentage = ($others_total_trial / $top_trial)*100;
	echo "<td><b><div style='float:left'>" . $trial_others_percentage ." % </b></td>&nbsp;&nbsp;&nbsp;";
echo "</tr>";

echo "</table>";





echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt' colspan=3><b>Regular - ". $top_regular ."</b></th>"; 
//(<b style='color:blue; font-size:12px'>Total ". $top_regular_and_MO ."</b>)
echo "</tr>";

//Total REGULAR started
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	if($_SESSION['userType']==8)
	{
		$pa_status_reg_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status 
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
			INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=2 and 
											campus_attendance_student.date>='".nl2br(prepareDate($_POST['fromDate']))."' and campus_attendance_student.date<='".nl2br(prepareDate($_POST['toDate']))."' "; 
											/*if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
											{
												$pa_status_reg_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
											}
											if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
											{
												$pa_status_reg_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
											}
											if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
											{
												$pa_status_reg_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
											}*/
											if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
											{
												$pa_status_reg_result.= " and capmus_users.LeadId = '".$_SESSION['userId']."' ";
											}
											$pa_status_reg_result.= " GROUP BY std_status ";
		$pa_status_reg_result = mysql_query($pa_status_reg_result);
	}


	else
	{
		$pa_status_reg_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status 
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
			INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=2 and 
											campus_attendance_student.date>='".nl2br(prepareDate($_POST['fromDate']))."' and campus_attendance_student.date<='".nl2br(prepareDate($_POST['toDate']))."' "; 
											if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
											{
												$pa_status_reg_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
											}
											if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
											{
												$pa_status_reg_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
											}
											if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
											{
												$pa_status_reg_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
											}
											if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
											{
												$pa_status_reg_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
											}
											$pa_status_reg_result.= " GROUP BY std_status ";
		$pa_status_reg_result = mysql_query($pa_status_reg_result);
	}
}

$total_regular_count = mysql_num_rows($pa_status_reg_result);	

$while_ck = 0;
while($pa_status_count = mysql_fetch_array($pa_status_reg_result))
{
	

	if($pa_status_count['std_status']==2)
	{
		$regular_total = $pa_status_count['sa_cnt'];	//Total regular count
	}

	echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['std_status']),'stdStatusmo-list') . " - classes started</b></td>&nbsp;&nbsp;&nbsp;";
	echo "<td><b><div style='float:left'>" . $pa_status_count['sa_cnt'] . "</b></td>";
	echo "<td valign='top'> </td>";
}
echo "</tr>";

//REGULAR PRESENT count
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	if($_SESSION['userType']==8)
	{
		$pa_status_reg_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
								/*if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
								{
									$pa_status_reg_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
								}
								if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
								{
									$pa_status_reg_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
								}*/
								if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
								{
									$pa_status_reg_result.= " and capmus_users.LeadId = '".$_SESSION['userId']."'";
								}
								$pa_status_reg_result.= " GROUP BY std_status,status ";
								$pa_status_reg_result = mysql_query($pa_status_reg_result);
	}
	
	else
	{
		$pa_status_reg_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
									$pa_status_reg_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
								}
								if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
								{
									$pa_status_reg_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
								}
								if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
								{
									$pa_status_reg_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
								}
								$pa_status_reg_result.= " GROUP BY std_status,status ";
								$pa_status_reg_result = mysql_query($pa_status_reg_result);
	}
}
if(mysql_num_rows($pa_status_reg_result)==0)	
{
	echo "<td valign='top'>Present</td>";		//
	echo "<td valign='top'>0</td>";				//Formatting table cells if there is NO trial present count,Only regular present count
	echo "<td valign='top'>0</td>";				//
}
else
{
	while($pa_status_count = mysql_fetch_array($pa_status_reg_result))
	{ 
		echo "<td><b><div style='float:left'>" . $regular_present_status = getData(nl2br($pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $regular_present_count = $pa_status_count['sa_S'] . "</b></td>&nbsp;&nbsp;&nbsp;";
		$regular_present_percentage = ($regular_present_count / $top_regular)*100;
		echo "<td><b><div style='float:left'>" . $regular_present_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
	}	
}
echo "</tr>";
	
//REGULAR ABSENT count
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	
	if($_SESSION['userType']==8)
	{
		$pa_status_reg_result_REG="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
							/*if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_reg_tr_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}*/
							if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
							{
								$pa_status_reg_result_REG.= " and capmus_users.LeadId = '".$_SESSION['userId']."'";
							}
							$pa_status_reg_result_REG.=" GROUP BY std_status,status ";
							$pa_status_reg_result_REG = mysql_query($pa_status_reg_result_REG);
	}
	
	
	else
	{
		$pa_status_reg_result_REG="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
								$pa_status_reg_result_REG.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_reg_result_REG.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}
							if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
							{
								$pa_status_reg_result_REG.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
							}
							$pa_status_reg_result_REG.=" GROUP BY std_status,status ";
							$pa_status_reg_result_REG = mysql_query($pa_status_reg_result_REG);
	}
}
if(mysql_num_rows($pa_status_reg_result_REG)==0)
{
	echo "<td valign='top'>Absent</td>";	//
	echo "<td valign='top'>0</td>";			//Formatting table cells if there is NO trial present count,Only regular present count
	echo "<td valign='top'>0</td>";			//
}
else
{
	while($pa_status_count_REG = mysql_fetch_array($pa_status_reg_result_REG))
	{ 
		if($pa_status_count_REG['status']!=1)
		{
		}
		echo "<td><b><div style='float:left'>" . $regular_absent_status = getData(nl2br( $pa_status_count_REG['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $regular_absent_count = $pa_status_count_REG['sa_S'] . "</b></td>&nbsp;&nbsp;&nbsp;";
		
		$regular_absent_percentage = ($regular_absent_count / $top_regular)*100;
		echo "<td><b><div style='float:left'>" . $regular_absent_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
	}
}	
echo "</tr>";

echo "<tr>";
	echo "<td><b><div style='float:left'>Others</b></td>&nbsp;&nbsp;&nbsp;";
	echo "<td><b><div style='float:left'>" . $others_total_regular = ($top_regular - ($regular_present_count + $regular_absent_count)) . "</b></td>&nbsp;&nbsp;&nbsp;";
	$regular_others_percentage = ($others_total_regular / $top_regular)*100;
	echo "<td><b><div style='float:left'>" . $regular_others_percentage ." % </b></td>&nbsp;&nbsp;&nbsp;";
echo "</tr>";

echo "</table>";




echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt' colspan=3><b>Make Over - <b>". $top_MO ."</b></b></th>"; 
echo "</tr>";

//Total MAKEOVER started
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	if($_SESSION['userType']==8)
	{
		$pa_status_MO_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status 
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
			INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=5 and 
											campus_attendance_student.date>='".nl2br(prepareDate($_POST['fromDate']))."' and campus_attendance_student.date<='".nl2br(prepareDate($_POST['toDate']))."' "; 
											/*if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
											{
												$pa_status_MO_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
											}
											if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
											{
												$pa_status_MO_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
											}
											if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
											{
												$pa_status_MO_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
											}*/
											if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
											{
												$pa_status_MO_result.= " and capmus_users.LeadId = '".$_SESSION['userId']."' ";
											}
											$pa_status_MO_result.= " GROUP BY std_status ";
		$pa_status_MO_result = mysql_query($pa_status_MO_result);
	}


	else
	{
		$pa_status_MO_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status 
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
			INNER JOIN capmus_users ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=5 and 
											campus_attendance_student.date>='".nl2br(prepareDate($_POST['fromDate']))."' and campus_attendance_student.date<='".nl2br(prepareDate($_POST['toDate']))."' "; 
											if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
											{
												$pa_status_MO_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
											}
											if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
											{
												$pa_status_MO_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
											}
											if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
											{
												$pa_status_MO_result.= " and campus_attendance_student.std_status = ".$_POST['stdStatus'];
											}
											if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
											{
												$pa_status_MO_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
											}
											$pa_status_MO_result.= " GROUP BY std_status ";
		$pa_status_MO_result = mysql_query($pa_status_MO_result);
	}
}

$total_MO_count = mysql_num_rows($pa_status_MO_result);



while($pa_status_count = mysql_fetch_array($pa_status_MO_result))
{
	if($pa_status_count['std_status']==5)
	{
		$makeover_total = $pa_status_count['sa_cnt'];	//Total makeover count
	}
	echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['std_status']),'stdStatusmo-list') . " - classes started</b></td>&nbsp;&nbsp;&nbsp;";
	echo "<td><b><div style='float:left'>" . $pa_status_count['sa_cnt'] . "</b></td>";
	echo "<td valign='top'> </td>";
}
echo "</tr>";

//MAKEOVER PRESENT count
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	if($_SESSION['userType']==8)
	{
		$pa_status_MO_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
		campus_attendance_student.status=1 and campus_attendance_student.std_status=5 
		and date>='".nl2br(prepareDate($_POST['fromDate']))."' and date<='".nl2br(prepareDate($_POST['toDate']))."' ";
								/*if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
								{
									$pa_status_MO_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
								}
								if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
								{
									$pa_status_MO_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
								}*/
								if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
								{
									$pa_status_MO_result.= " and capmus_users.LeadId = '".$_SESSION['userId']."'";
								}
								$pa_status_MO_result.= " GROUP BY std_status,status ";
								$pa_status_MO_result = mysql_query($pa_status_MO_result);
	}
	
	else
	{
		$pa_status_MO_result="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
		campus_attendance_student.status=1 and campus_attendance_student.std_status=5 
		and date>='".nl2br(prepareDate($_POST['fromDate']))."' and date<='".nl2br(prepareDate($_POST['toDate']))."' ";
								if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
								{
									$pa_status_MO_result.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
								}
								if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
								{
									$pa_status_MO_result.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
								}
								if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
		{
			$pa_status_MO_result.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
		}
								$pa_status_MO_result.= " GROUP BY std_status,status ";
								$pa_status_MO_result = mysql_query($pa_status_MO_result);
	}
}

if(mysql_num_rows($pa_status_MO_result)==0)	
{
	echo "<td valign='top'>Present</td>";	//
	echo "<td valign='top'>0</td>";			//Formatting table cells if there is NO trial present count,Only regular present count
	echo "<td valign='top'>0</td>";			//
}
else
{
	while($pa_status_count = mysql_fetch_array($pa_status_MO_result))
	{ 
		echo "<td><b><div style='float:left'>" . $MO_present_status = getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $MO_present_count = $pa_status_count['sa_S'] . "</b></td>&nbsp;&nbsp;&nbsp;";
		$MO_present_percentage = ($MO_present_count / $top_MO)*100;
		echo "<td><b><div style='float:left'>" . $MO_present_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
	}	
}
echo "</tr>";

//MAKEOVER ABSENT count
echo "<tr>";
if($_POST['fromDate']!="" && $_POST['toDate']!="")
{
	
	if($_SESSION['userType']==8)
	{
		$pa_status_MO_result_REG="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
		campus_attendance_student.status=0 and campus_attendance_student.std_status=5 
		and date>='".nl2br(prepareDate($_POST['fromDate']))."' and date<='".nl2br(prepareDate($_POST['toDate']))."' ";
							/*if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
							{
								$pa_status_MO_result_REG.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_MO_result_REG.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}*/
							if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
							{
								$pa_status_MO_result_REG.= " and capmus_users.LeadId = '".$_SESSION['userId']."'";
							}
							$pa_status_MO_result_REG.=" GROUP BY std_status,status ";
							$pa_status_MO_result_REG = mysql_query($pa_status_MO_result_REG);
	}
	
	
	else
	{
		$pa_status_MO_result_REG="SELECT count(campus_attendance_student.studentID) as sa_cnt,campus_attendance_student.std_status,
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
		campus_attendance_student.status=0 and campus_attendance_student.std_status=5 
		and date>='".nl2br(prepareDate($_POST['fromDate']))."' and date<='".nl2br(prepareDate($_POST['toDate']))."' ";
							if(isset($_POST['search-teacher-id']) && !empty($_POST['search-teacher-id']))
							{
								$pa_status_MO_result_REG.= " and campus_attendance_student.teacherID = ".$_POST['search-teacher-id'];
							}
							if(isset($_POST['search-student-id']) && !empty($_POST['search-student-id']))
							{
								$pa_status_MO_result_REG.= " and campus_attendance_student.studentID = ".$_POST['search-student-id'];
							}
							if(isset($_POST['search-teacher-id2']) && !empty($_POST['search-teacher-id2']))
		{
			$pa_status_MO_result_REG.= " and capmus_users.LeadId = '".$_POST['search-teacher-id2']."'";
		}
							$pa_status_MO_result_REG.=" GROUP BY std_status,status ";
							$pa_status_MO_result_REG = mysql_query($pa_status_MO_result_REG);
	}
}

if(mysql_num_rows($pa_status_MO_result_REG)==0)
{
	echo "<td valign='top'>Absent</td>";		//
	echo "<td valign='top'>0</td>";			//Formatting table cells if there is NO trial present count,Only regular present count
	echo "<td valign='top'>0</td>";			//
}
else
{
	while($pa_status_count_REG = mysql_fetch_array($pa_status_MO_result_REG))
	{ 
		if($pa_status_count_REG['status']!=1)
		{
		}
		echo "<td><b><div style='float:left'>" . $MO_absent_status = getData(nl2br( $pa_status_count_REG['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $MO_absent_count = $pa_status_count_REG['sa_S'] . "</b></td>&nbsp;&nbsp;&nbsp;";
		
		$MO_absent_percentage = ($MO_absent_count / $top_MO)*100;
		echo "<td><b><div style='float:left'>" . $MO_absent_percentage . " % </b></td>&nbsp;&nbsp;&nbsp;";
	}
}	
echo "</tr>";

echo "<tr>";
	echo "<td><b><div style='float:left'>Others</b></td>&nbsp;&nbsp;&nbsp;";
	echo "<td><b><div style='float:left'>" . $others_total_MO = ($top_MO - ($MO_present_count + $MO_absent_count)) . "</b></td>&nbsp;&nbsp;&nbsp;";
	$MO_others_percentage = ($others_total_MO / $top_MO)*100;
	echo "<td><b><div style='float:left'>" . $MO_others_percentage ." % </b></td>&nbsp;&nbsp;&nbsp;";
echo "</tr>";

echo "</table>";



include('include/footer.php');
?>