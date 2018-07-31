<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">

&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
</div>


<div style="float:left">
<?php
getFilterSubmit();
?></div>
<br>

</form>
</div>
<?
if(isset($_POST['search-submit']))
{

if($_SESSION['userType']==5)
{
	$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and status_dead=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues'); 
}


//FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8 && isset($_POST['search-teacher-id']))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_emp_pro_teamlead();
}


else if($_SESSION['userType']==1){
	//$result = getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status!="3" and status_dead=0',"",",campus_students.firstName as name,campus_students.std_status as std_status",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id ","order by startTime asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues,campus_schedule.id');
	
	$result_manage_sch = getResultResource_teacher_commision_superadmin();
	
	}
else
{

}


?>








<?php
//Table for Trial - Present/Absent, Trial Present then REGULAR, Trial Present then DEAD
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Teacher</b></th>"; 
//echo "<th class='specalt'><b>Per Teacher</b></th>"; 
echo "<th class='specalt'><b>Trial</b></th>"; 
echo "<th class='specalt'><b>Present</b></th>"; 
echo "<th class='specalt'><b>Absent</b></th>"; 

echo "<th class='specalt'><b>Others</b></th>";
echo "<th class='specalt'><b>Signup</b></th>"; 
echo "<th class='specalt'><b>Amount</b></th>"; 
 
echo "<th class='specalt'><b>Dead</b></th>"; 
echo "</tr>";

//COUNT TOTAL TRIAL

//http://stackoverflow.com/questions/8334229/count-multiple-criteria-in-separate-columns-mysql
	$total_trial_cnt="SELECT teacherID,count(*) as cnt_teacher,
	SUM(std_status = '1') AS std_status,
    SUM(std_status_old = '1') AS std_status_old  	
	FROM campus_schedule 
	WHERE status=1 ";
	
	//FROM Date and TO Date
	$fd = prepareDate($_POST['fromDate']);
	$td = prepareDate($_POST['toDate']);
	
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$total_trial_cnt.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	$total_trial_cnt.=" GROUP BY teacherID";
	$result_total_trial_cnt=mysql_query($total_trial_cnt);
	while($row_total_trial_cnt = mysql_fetch_array($result_total_trial_cnt)){
	echo "<tr>";
	
	
		//Count per teacher - commenting for now
		//$cnt_teacher = nl2br( $row_total_trial_cnt['cnt_teacher']) ;
		echo "<td valign='top'>" .  "<a href=class_details_teacher_sub_version.php?teacherID_tea_tri_sta={$row_total_trial_cnt['teacherID']}&fromdate={$fd}&todate={$td} target='_blank'>" . showUser( nl2br( $row_total_trial_cnt['teacherID'])) . "</a></td>"; 
		//echo "<td valign='top'>" . $total_per_teacher = $cnt_teacher . "</td>";
		echo "<td valign='top'>" . $total_trial = nl2br( $row_total_trial_cnt['std_status']) + nl2br( $row_total_trial_cnt['std_status_old']) . "</td>";
		
		/*$pa_status_tr_result="SELECT count(std_status) as trial_pre_cnt   
		FROM campus_attendance_student 
		WHERE teacherID='".$row_total_trial_cnt['teacherID']."' and status=1 and std_status=1 ";	*/						
		
$pa_status_tr_result="SELECT count(DISTINCT campus_attendance_student.studentID) as trial_pre_cnt   
		FROM campus_attendance_student 
		WHERE teacherID='".$row_total_trial_cnt['teacherID']."' and status=1 and std_status=1 ";							
		
		
								if($_POST['fromDate']!="" && $_POST['toDate']!="")
								{
									$pa_status_tr_result.=" and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."'";
								}
								//$pa_status_tr_result.= " GROUP BY std_status";
								$pa_status_tr_result = mysql_query($pa_status_tr_result);
								while($pa_status_count = mysql_fetch_array($pa_status_tr_result))
								{
									//echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
									echo "<td><b><div style='float:left'>" . $trial_present_count = $pa_status_count['trial_pre_cnt'] . "</b></td>&nbsp;&nbsp;&nbsp;";
								}
								
		$pa_status_tr_result="SELECT count(std_status) as trial_abs_cnt   
		FROM campus_attendance_student 
		WHERE teacherID='".$row_total_trial_cnt['teacherID']."' and status=0 and std_status=1 ";							
								
								if($_POST['fromDate']!="" && $_POST['toDate']!="")
								{
									$pa_status_tr_result.=" and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."'";
								}
								//$pa_status_tr_result.= " GROUP BY std_status";
								$pa_status_tr_result = mysql_query($pa_status_tr_result);
								while($pa_status_count = mysql_fetch_array($pa_status_tr_result))
								{
									//echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
									echo "<td><b><div style='float:left'>" . $trial_absent_count = $pa_status_count['trial_abs_cnt'] . "</b></td>&nbsp;&nbsp;&nbsp;";
								}
		
		$trial_PRESENT_ABSENT_TOTAL_count = $trial_present_count + $trial_absent_count;																								;
			// OTHERS count by subtracting $trial_PRESENT_ABSENT_TOTAL_count FROM $total_trials
	echo "<td valign='top'> " . $trial_OTHERS_count = $total_trial - $trial_PRESENT_ABSENT_TOTAL_count. "</td>";
		
		
		
		/*$trial_pre_then_reg="SELECT 
		campus_schedule.id as sch_id,count(campus_schedule.std_status) as sch_status,campus_schedule.std_status_old as sch_status_old,
		campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,SUM(campus_schedule.dues) as dues_cnt_trial_to_regular,
		campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
		campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
		campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
		FROM campus_schedule 
		INNER JOIN campus_attendance_student ON 
		campus_attendance_student.teacherID='".$row_total_trial_cnt['teacherID']."' and 
		campus_schedule.id=campus_attendance_student.schedule_id and 
		campus_schedule.std_status_old=1 and campus_attendance_student.std_status=1 and campus_attendance_student.status=1 and 
		campus_schedule.status=1 and campus_schedule.status_dead=0 and 
		campus_schedule.teacherID!=0 and campus_schedule.std_status=2 ";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$trial_pre_then_reg.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		$trial_pre_then_reg.="  GROUP BY campus_schedule.teacherID ORDER BY campus_schedule.teacherID";*/
		
		$trial_pre_then_reg="SELECT 
		campus_schedule.id as sch_id,campus_schedule.std_status as sch_status,campus_schedule.std_status_old as sch_status_old,
		count(DISTINCT campus_schedule.studentID) as cam_stu_id,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,SUM(DISTINCT campus_schedule.dues) as dues_cnt_trial_to_regular,
		campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
		campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
		campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
		FROM campus_schedule 
		INNER JOIN campus_attendance_student ON 
		campus_attendance_student.teacherID='".$row_total_trial_cnt['teacherID']."' and 
		campus_schedule.id=campus_attendance_student.schedule_id and 
		campus_schedule.std_status_old=1 and campus_attendance_student.std_status=1 and campus_attendance_student.status=1 and 
		campus_schedule.status=1 and campus_schedule.status_dead=0 and 
		campus_schedule.teacherID!=0 and campus_schedule.std_status=2 and campus_schedule.studentID=campus_attendance_student.studentID ";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$trial_pre_then_reg.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		$trial_pre_then_reg.="  GROUP BY campus_schedule.teacherID ORDER BY campus_schedule.teacherID";
		//Trial to signup count
		$trial_to_signup = 0;
		//Trial to signup amount sum array
		$total_signup_sum_array=array();
		$total_regular_sum_array=array();
		$trial_pre_then_reg = mysql_query($trial_pre_then_reg) or trigger_error(mysql_error());
		while($row_trial_pre_then_reg = mysql_fetch_array($trial_pre_then_reg))
		{
			//if($row_trial_pre_then_reg['sch_status']==2)
			//{
			//$trial_to_signup = $trial_to_signup + 1;
			//}
			echo $total_signup_sum_array[$row_trial_pre_then_reg['sch_id']] = $row_trial_pre_then_reg['sch_status'];
			
			echo $total_regular_sum_array[$row_trial_pre_then_reg['sch_id']] = $row_trial_pre_then_reg['dues_cnt_trial_to_regular'];
			echo "<td valign='top'> " . $total_signup_sum_array[$row_trial_pre_then_reg['sch_id']] = $row_trial_pre_then_reg['cam_stu_id'] . "</td>";
			echo "<td valign='top'> " . $total_regular_sum_array[$row_trial_pre_then_reg['sch_id']] = $row_trial_pre_then_reg['dues_cnt_trial_to_regular'] . "</td>";
		
		}
		echo "</tr>";
		//echo "<td valign='top'> " . $trial_to_signup . "</td>";
		//echo "<td valign='top'> " . $total_regular_sum_array[$row_trial_pre_then_reg['sch_id']] = $row_trial_pre_then_reg['dues_cnt_trial_to_regular'] . "</td>";
		
		//echo "<td valign='top'> " . $trial_to_signup . "</td>";
		//echo "<td valign='top'> " . $total_regular_sum_array[$row_trial_pre_then_reg['sch_id']] = $row_trial_pre_then_reg['dues_cnt_trial_to_regular'] . "</td>";
		

		
		
		/*$trial_pre_then_dead="SELECT 
		campus_schedule.id as sch_id,campus_schedule.std_status as sch_status,campus_schedule.std_status_old as sch_status_old,
		campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
		campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
		campus_schedule.agentId,campus_schedule.classType,
		campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
		campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
		campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
		FROM campus_schedule 
		INNER JOIN campus_attendance_student ON 
		campus_attendance_student.teacherID='".$row_total_trial_cnt['teacherID']."' and
		campus_schedule.id=campus_attendance_student.schedule_id and 
		campus_schedule.std_status_old=1 and campus_attendance_student.std_status=1 and campus_attendance_student.status=1 and 
		campus_schedule.status=1 and 
		campus_schedule.teacherID!=0 and campus_schedule.std_status=3 ";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$trial_pre_then_dead.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
		
		$trial_to_dead = 0;
		
		$trial_pre_then_dead = mysql_query($trial_pre_then_dead);
		while($row_trial_pre_then_dead = mysql_fetch_array($trial_pre_then_dead))
		{
			$trial_to_dead = $trial_to_dead  + 1;
		}
		echo "<td valign='top'> " . $trial_to_dead . "</td>";*/
		
		
		
		
	}	

echo "</table>";



?>


<?
/*echo "<b>NOTE: Following schedule is for testing, will be removed later</b>"; 
echo "<table  border=0 id='table' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>ID</b></th>";  
echo "<th class='specalt'><b>Contact No.</b></th>"; 
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'>Country</th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>"; 
echo "<th class='specalt'><b>Status old</b></th>"; 
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>"; 
echo "</tr>"; 
	
while($row_manage_sch = mysql_fetch_array($result_manage_sch)){ 

$query="select `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$row_manage_sch['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
foreach($row_manage_sch AS $key => $value) { $row_manage_sch[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" .nl2br($row_manage_sch['id']) . "</td>";

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
//echo "<td valign='top'>" . nl2br( $row['users_id']) . "</td>";  

echo "<td valign='top'>" . getData( nl2br( $row_manage_sch['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $rows['countryID']),'country'). "</td>";   
echo "<td valign='top'>" . nl2br( $row_manage_sch['startTime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row_manage_sch['endTime']) . "</td>";  


//BEST EXAMPLE TO JOIN 2 TABLES FOR UPDATING THE RECORD IN THE OTHER TABLE WHICH HAS THE PRIMARY KEY
//http://stackoverflow.com/questions/9957171/how-to-join-two-tables-in-an-update-statement
//http://stackoverflow.com/questions/4840833/mysql-add-12-hours-to-a-time-field


echo "<td valign='top'>" . nl2br( $row_manage_sch['startDate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row_manage_sch['endDate']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row_manage_sch['studentID'])) . "</td>";  
echo "<td valign='top'>" . showUser( nl2br( $row_manage_sch['teacherID'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row_manage_sch['agentId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row_manage_sch['dues']) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row_manage_sch['std_status_old']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row_manage_sch['statussch']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row_manage_sch['classType']),'plan') . "</td>";  
echo "</tr>"; 
} 
echo "</table>"; */
} 
include('include/footer.php');
?>