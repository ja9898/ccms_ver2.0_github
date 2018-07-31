<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 
getTeacherFilter();
?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
</div>

<div id="label">CAD to PKR(Enter exchange rate)</div>
<div id="field"><input name="exchange_rate" type="number" id="exchange_rate"  /></div> 

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


else if($_SESSION['userType']==1 && isset($_POST['search-teacher-id'])){
	//$result = getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status!="3" and status_dead=0',"",",campus_students.firstName as name,campus_students.std_status as std_status",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id ","order by startTime asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues,campus_schedule.id');
	
	$result_manage_sch = getResultResource_teacher_commision_superadmin();
	
	}
else
{

}

$rowcount = mysql_num_rows($result);

//Query of TEACHER NAME
$sql_employee_info=("SELECT * FROM capmus_users WHERE id='".$_POST['search-teacher-id']."' ");
$sql_employee_info_result=mysql_query($sql_employee_info) or die(mysql_error());
$sql_employee_info_result=mysql_fetch_array($sql_employee_info_result);
//******************************* TABLE FOR 1st PART of TEACHER's COMMISION ******************************
//Table for CURRENT STUDENTS,DEAD
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr bgcolor=#FF0000>";
echo "<th colspan=2 class='specalt'><b>EMPLOYEE CURRENT STATUS</b></th>";  
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Employee Name: </b></td>";
echo "<td valign='top'>" .nl2br( $sql_employee_info_result['firstName']). " " .nl2br( $sql_employee_info_result['lastName']). "</td>";
echo "</tr>";



echo "<tr>";
echo "<td valign='top'><b> Number of students[Regular classes delivered]: </b></td>";
echo "<td valign='top'>UNDER-DEVELOPMENT</td>";
echo "</tr>";


?>


<?
//CLASSES,TOTAL BUSINESS
echo "<tr>";
//Query of Current students,Regular classes with STUDENT status cnt
	echo "<td valign='top'><b>Current Students</b></td>";
	$result_row_count_cnt = teacher_commision();
	$result_row_count_num = mysql_num_rows($result_row_count_cnt);
	while($row_count = mysql_fetch_array($result_row_count_cnt))
	{ 
		echo "<td valign='top'><b>"/*. getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . */ . $row_count['cnt_regular']."</b></td>";
		echo "<td valign='top'>$ ". $row_count['dues_cnt_regular'] ."</td>";
	}
?>
<?
echo "<tr>";
//Query for DEAD of that specific teacher
	echo "<td valign='top'><b>Dead</b></td>";
	$sql_dead_students="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_dead,campus_schedule.status,SUM(campus_schedule.dues) as dues_cnt_dead,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON  capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."'  
	and campus_schedule.std_status_old=2 and campus_schedule.std_status=3 
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql_dead_students.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
		$sql_dead_students.=" GROUP BY campus_schedule.std_status ";
	$result_dead_students=mysql_query($sql_dead_students);
	while($row_count_dead = mysql_fetch_array($result_dead_students))
	{ 
		echo "<td valign='top'><b>"/*. getData(nl2br( $row_count['std_status']),'stdStatusmo-list') . */ . $row_count_dead['cnt_dead']."</b></td>";
		echo "<td valign='top'>$ ". $row_count_dead['dues_cnt_dead']."</td>";
	}
echo "</tr>";
echo "</table>"
?>







<?
//Table for Trial - Present/Absent, Trial Present then REGULAR, Trial Present then DEAD
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Trial</b></th>"; 
echo "<th class='specalt'><b>Present</b></th>"; 
echo "<th class='specalt'><b>Absent</b></th>"; 
echo "<th class='specalt'><b>Signup</b></th>"; 
echo "<th class='specalt'><b>Others</b></th>"; 
echo "<th class='specalt'><b>Dead</b></th>"; 
echo "</tr>";

echo "<tr>";
//COUNT TOTAL TRIAL
//-- Total current trial count
$total_trial_cnt="SELECT count(std_status) as cnt_trial   
	FROM campus_schedule 
	WHERE teacherID='".$_POST['search-teacher-id']."' and status=1 and std_status=1 ";
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$total_trial_cnt.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	$total_trial_cnt.=" GROUP BY std_status";
	$result_total_trial_cnt=mysql_query($total_trial_cnt);
	while($row_total_trial_cnt = mysql_fetch_array($result_total_trial_cnt)){
		$cnt_trial_current = nl2br( $row_total_trial_cnt['cnt_trial']) ;
	}	
//-- Total old trial count
$total_trial_cnt_old="SELECT count(std_status_old) as cnt_trial_old 
	FROM campus_schedule 
	WHERE teacherID='".$_POST['search-teacher-id']."' and status=1 and std_status_old=1 ";
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$total_trial_cnt_old.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	$total_trial_cnt_old.=" GROUP BY std_status_old";
	$result_total_trial_cnt_old=mysql_query($total_trial_cnt_old);
	while($row_total_trial_cnt_old = mysql_fetch_array($result_total_trial_cnt_old)){
		$cnt_trial_old =  nl2br( $row_total_trial_cnt_old['cnt_trial_old']) ;
	}	
//-- Total CURRENT/OLD Trials
echo "<td valign='top'>" . $total_trials = $cnt_trial_current+$cnt_trial_old . "</td>";




	//echo "<br>";
	//echo "<b>TRIAL PRESENT count</b>";
	//echo "<br>";
//TRIAL PRESENT count
//if($_POST['fromDate']!="" && $_POST['toDate']!="")
//{

		$pa_status_tr_result="SELECT count(std_status) as trial_pre_cnt   
		FROM campus_attendance_student 
		WHERE teacherID='".$_POST['search-teacher-id']."' and status=1 and std_status=1 ";							
								
								if($_POST['fromDate']!="" && $_POST['toDate']!="")
								{
									$pa_status_tr_result.=" and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."'";
								}
								//$pa_status_tr_result.= " GROUP BY std_status";
								$pa_status_tr_result = mysql_query($pa_status_tr_result);

//}
	while($pa_status_count = mysql_fetch_array($pa_status_tr_result))
	{
		//echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $trial_present_count = $pa_status_count['trial_pre_cnt'] . "</b></td>&nbsp;&nbsp;&nbsp;";
	}

	
	
	//echo "<br>";
	//echo "<b>TRIAL ABSENT count</b>";
	//echo "<br>";
//TRIAL ABSENT count
//if($_POST['fromDate']!="" && $_POST['toDate']!="")
//{

		$pa_status_tr_result="SELECT count(std_status) as trial_abs_cnt   
		FROM campus_attendance_student 
		WHERE teacherID='".$_POST['search-teacher-id']."' and status=0 and std_status=1 ";							
								
								if($_POST['fromDate']!="" && $_POST['toDate']!="")
								{
									$pa_status_tr_result.=" and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."'";
								}
								//$pa_status_tr_result.= " GROUP BY std_status";
								$pa_status_tr_result = mysql_query($pa_status_tr_result);

//}
	while($pa_status_count = mysql_fetch_array($pa_status_tr_result))
	{
		//echo "<td><b><div style='float:left'>" . getData(nl2br( $pa_status_count['status']),'class_status') . "</b></td>&nbsp;&nbsp;&nbsp;";
		echo "<td><b><div style='float:left'>" . $trial_absent_count = $pa_status_count['trial_abs_cnt'] . "</b></td>&nbsp;&nbsp;&nbsp;";
	}

	
	//echo "<br>";
	//echo "<b>Trial is Present and THEN Regular</b>";
	//echo "<br>";
// Trial is Present and THEN Regular
// REMOVED condition - campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
$trial_pre_then_reg="SELECT 
	campus_schedule.id as sch_id,campus_schedule.std_status as sch_status,campus_schedule.std_status_old as sch_status_old,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
	campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
	campus_schedule.agentId,campus_schedule.classType,campus_schedule.dues as dues_cnt_trial_to_regular,
	campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
	campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
	campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
	FROM campus_schedule 
	INNER JOIN campus_attendance_student ON 
	campus_attendance_student.teacherID='".$_POST['search-teacher-id']."' and 
	campus_schedule.id=campus_attendance_student.schedule_id and 
	campus_schedule.std_status_old=1 and campus_attendance_student.std_status=1 and campus_attendance_student.status=1 and 
	campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.teacherID!=0 and campus_schedule.std_status=2 ";
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$trial_pre_then_reg.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	//Trial to signup count
	$trial_to_signup = 0;
	//Trial to signup amount sum array
	$total_regular_sum_array=array();
	$trial_pre_then_reg = mysql_query($trial_pre_then_reg);
	while($row_trial_pre_then_reg = mysql_fetch_array($trial_pre_then_reg))
	{
		$trial_to_signup = $trial_to_signup + 1;
		$total_regular_sum_array[$row_trial_pre_then_reg['sch_id']] = $row_trial_pre_then_reg['dues_cnt_trial_to_regular'];
	}
	echo "<td valign='top'> " . $trial_to_signup . "</td>";
	
	
	
	
// OTHERS count by subtracting $trial_PRESENT_ABSENT_TOTAL_count FROM $total_trials
	$trial_PRESENT_ABSENT_TOTAL_count = $trial_present_count + $trial_absent_count;
	echo "<td><div style='float:left'>" . $trial_OTHERS_count = $total_trials - $trial_PRESENT_ABSENT_TOTAL_count. "</td>&nbsp;&nbsp;&nbsp;";

	
	

	//echo "<br>";
	//echo "<b>Trial is Present and THEN Dead</b>";
	//echo "<br>";
// Trial is Present and THEN Dead
// REMOVED condition - campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
$trial_pre_then_dead="SELECT 
	campus_schedule.id as sch_id,campus_schedule.std_status as sch_status,campus_schedule.std_status_old as sch_status_old,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,
	campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,
	campus_schedule.agentId,campus_schedule.classType,
	campus_attendance_student.id as sa_id,campus_attendance_student.studentID as sa_sid,campus_attendance_student.teacherID as sa_tid,
	campus_attendance_student.startTime as sa_st,campus_attendance_student.courseID as sa_cid,campus_attendance_student.classType as sa_CT,
	campus_attendance_student.std_status as sa_SS,campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date 
	FROM campus_schedule 
	INNER JOIN campus_attendance_student ON 
	campus_attendance_student.teacherID='".$_POST['search-teacher-id']."' and
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
	echo "<td valign='top'> " . $trial_to_dead . "</td>";
	

echo "</tr>";




//Table for Trial to Signup, Recurring Paid students, Recurring pending students, Reference
//Trial to Signup			***************************
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Trial to Signup</b></th>"; 
echo "<td valign='top'> " . $trial_to_signup . "</td>";
echo "<td valign='top'><b> $" . nl2br( array_sum($total_regular_sum_array)) . "</td>";
echo "</tr>";

//Recurring PAID students	***************************
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Recurring Paid students</b></th>";
//Array for Recurring Paid students
	$total_recurr_paid_stu_array=array();

$recieved=array();
$recieved_with_tran_id=array();
$signups =array();

$sql_recurr_paid_stu=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,
	campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.startTime,
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.teacherID as tran_tID 
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id and 
	campus_schedule.`status` = 1 and campus_schedule.std_status=2 and 
	campus_transaction.teacherID='".$_POST['search-teacher-id']."' and 
	campus_transaction.date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."' and campus_transaction.date!=''";

$result_sql_recurr_paid_stu = mysql_query($sql_recurr_paid_stu);
//Row count for recurring paid students 
$row_count_recurr_paid_stu = 0;
// Following while and the conditions inside it are for RECURRING PAID STUDENTS(similar to PAYMENT RECORD REPORT)
while($row_sql_recurr_paid_stu = mysql_fetch_array($result_sql_recurr_paid_stu))
	{
		//$total_recurr_paid_stu_array[$row_sql_recurr_paid_stu['id']] = $row_sql_recurr_paid_stu['amounttran'];
		$signup_check=1;

		$countresult=$row_sql_recurr_paid_stu['amount'];

		$countmonthsql="select amount as amounttran_not_main,date,operator,id FROM campus_transaction where date BETWEEN '".nl2br(prepareDate($_POST['fromDate']))."' AND '".nl2br(prepareDate($_POST['toDate']))."' and studentID=".$row_sql_recurr_paid_stu['studentID']." and teacherID=".$row_sql_recurr_paid_stu['tran_tID']." and schedule_id=".$row_sql_recurr_paid_stu['id']." "; 

		$countmonthesult=mysql_query($countmonthsql);
		$countmonthesult=mysql_fetch_assoc($countmonthesult);
		$amount[$row_sql_recurr_paid_stu['id']]=$countresult;

		if(($row_sql_recurr_paid_stu['due_date']>=nl2br(prepareDate($_POST['fromDate'])) && $row_sql_recurr_paid_stu['due_date']<=nl2br(prepareDate($_POST['toDate']))) && $row_sql_recurr_paid_stu['due_date']==$countmonthesult['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult))
		{
		$signups[$row_sql_recurr_paid_stu['id']]=$row_sql_recurr_paid_stu['amount'];
		$signup_check=0;
		}

		if(!empty($countresult) && ($countmonthesult['date']>=nl2br(prepareDate($_POST['fromDate'])) && $countmonthesult['date']<=nl2br(prepareDate($_POST['toDate']))) && $signup_check==1)
		{
		$recieved[$row_sql_recurr_paid_stu['id']]=$row_sql_recurr_paid_stu['amounttran'];//oldly used
		//Array for Recurring Paid students
		$total_recurr_paid_stu_array[$row_sql_recurr_paid_stu['tran_id']]=$row_sql_recurr_paid_stu['amounttran'];
		//Row count for recurring paid students counting
		$row_count_recurr_paid_stu = $row_count_recurr_paid_stu +1;

		}
	}
echo "<td valign='top'> " . $row_count_recurr_paid_stu . "</td>";
echo "<td valign='top'><b> $" . nl2br( array_sum($total_recurr_paid_stu_array)) . "</td>";
//Doing this for RECURRING in 3rd table
$third_table_recurr = $row_count_recurr_paid_stu;
echo "</tr>";





// CHANGED TO REGUALR and SIGNUP DATE	
//References		***************************
//Array for REFERENCE amount count
	$total_reference_amount_count_array=array();

echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Reference</b></th>";
$references_sql="SELECT * FROM campus_schedule WHERE reference='".$_POST['search-teacher-id']."' AND std_status=2 ";
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$references_sql.=" and duedate>= '".prepareDate($_POST['fromDate'])."' and duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	$references_sql_result = mysql_query($references_sql);
	echo "<td><div style='float:left'>" . $references_row_count = mysql_num_rows($references_sql_result) . "</td>";
	
	while($references_row = mysql_fetch_array($references_sql_result))
	{
		$total_reference_amount_count_array[$references_row['id']] = $references_row['dues'];
	}
	echo "<td valign='top'><b> $" . nl2br( array_sum($total_reference_amount_count_array)) . "</td>";
echo "</tr>";
echo "</table>";





//Recurring PENDING students	***************************
	$fromDate=date('d',strtotime($_POST['fromDate']));
	$fromMonth=date('n',strtotime($_POST['fromDate']));

	$fromdaysss=date('t',strtotime($_POST['fromDate']));

	
	$toDate=date('d',strtotime($_POST['toDate']));

	$toMonth=date('n',strtotime($_POST['toDate']));

	
	//Following is for date(n)-1
	//echo "pre mon";
	$curr_mon_sub_one = date('n')-1;

	////////echo "curr mon";
	$curr_mon = date('n');
	
	//echo "next mon";
	$curr_mon_add_one = date('n')+1;
	

	
//Pre month + curr month && curr month + next month
if($toMonth > $fromMonth && !empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	    
				//Pre month + curr month
				if($fromDate >= $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					echo "loop-loop111-1";
					echo "123<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
					
					/*$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";*/
				}
				//curr month + next month
				if($fromDate >= $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					echo "loop-loop222-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//Pre month + curr month
				if($fromDate < $toDate && $fromMonth==$curr_mon_sub_one && $toMonth==$curr_mon)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//curr month + next month
				if($fromDate < $toDate && $fromMonth==$curr_mon && $toMonth==$curr_mon_add_one)
				{
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) <=31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			
 //day(campus_schedule.paydate) >= ".$fromDate." AND day(campus_schedule.paydate) <= ".$toDate."
		}
		
		
		//Pre month + Pre month
else if($toMonth == $fromMonth && $toMonth==$curr_mon_sub_one && $fromMonth==$curr_mon_sub_one)
{
			if(!empty($_POST['search-teacher-id']) && $_POST['search-teacher-id']!=0)
			{
				if($fromDate <= $toDate)
				{
					echo "loop-curr-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
				}
			}
			else
			{
				if($fromDate <= $toDate)
				{
					echo "loop-curr-1";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
				}
			}
 
}
		
		
		//curr month + curr month
else if($toMonth == $fromMonth && $fromMonth==$curr_mon && $toMonth==$curr_mon && !empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));

			if(!empty($_POST['search-teacher-id']) && $_POST['search-teacher-id']!=0)
			{
				if($fromDate <= $toDate)
				{
					//echo "loop-loop111-2";
					//echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//else if()
				else
				{
					echo "loop-loop222-2";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			else
			{
				if($fromDate <= $toDate)
				{
					echo "loop-loop111-2";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
				//else if()
				else
				{
					echo "loop-loop222-2";
					echo "<br>";
					$sql_pre=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,


					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and day(campus_schedule.paydate) <=  31 
					order by paydayz DESC";
					
					$sql=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$fromdaysss." 
					order by paydayz DESC";
					
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN 1 AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			
 //day(campus_schedule.paydate) >= ".$fromDate." AND day(campus_schedule.paydate) <= ".$toDate."

 
}
 
 
		//NEXT month + NEXT month
else if($toMonth == $fromMonth && $fromMonth==$curr_mon_add_one && $toMonth==$curr_mon_add_one && !empty($_POST['toDate'])){
		$toDate=date('d',strtotime($_POST['toDate']));
	     
			if(!empty($_POST['search-teacher-id']) && $_POST['search-teacher-id']!=0)
			{
				if($fromDate <= $toDate)
				{
					
					//echo "loop-NEXT-TL-Only-less";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate.") 
					order by paydayz DESC";
				}
				//else if()
				else
				{
					
					//echo "loop-NEXT-TL-Admin-less";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					(day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate.") 
					order by paydayz DESC";
				}
			}
			else
			{
				if($fromDate <= $toDate)
				{
					
					
					//echo "SA-all";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
				}
				//else if()
				else
				{
					
					
					//echo "SA-all-2";
					$sql2=" Select capmus_users.id as users_id,capmus_users.LeadId,
					campus_schedule.id,
					campus_schedule.duedate as due_date,
					campus_schedule.paydate as pay_date,
					day(campus_schedule.duedate) AS dayz,
					month(campus_schedule.duedate) AS month,
					year(campus_schedule.duedate) AS year,
					day(campus_schedule.paydate) AS paydayz,
					campus_schedule.dues as amount,
					campus_schedule.studentID,
					campus_schedule.teacherID,
					campus_schedule.courseID,
					campus_schedule.classType,
					campus_schedule.startTime,

					campus_schedule.`status` 
					FROM capmus_users 
					INNER JOIN campus_schedule 
					ON capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."' and 
					campus_schedule.teacherID!=0 and 
					campus_schedule.`status` =1 and campus_schedule.std_status=2 and 
					day(campus_schedule.paydate) BETWEEN ".$fromDate." AND ".$toDate." 
					order by paydayz DESC";
				}
			}
			
 //day(campus_schedule.paydate) >= ".$fromDate." AND day(campus_schedule.paydate) <= ".$toDate."
 
}
 
 //PREVIOUS MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the PREVIOUS MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
/*
echo "<div align='center' style='color:red; font-size:16px'>PREVIOUS MONTH PENDINGS</div>";
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>TL Name</th>";
echo "<th class='specalt'>Country</th>";
echo "<th class='specalt'>Cousre</th>";
//echo "<th class='specalt'>Total Amount</th>"; 
//echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Pending Amount</th>"; 
//echo "<th class='specalt'>Signup Amount</th>";
//echo "<th class='specalt'>Discount</th>";
//echo "<th class='specalt'>SignUp Date</th>";
//echo "<th class='specalt'>Paying Date</th>";
//echo "<th class='specalt'>Received Date</th>"; 
//echo "<th class='specalt'>Current Month Due date</th>"; 
//echo "<th class='specalt'>Pending month</th>"; 
echo "</tr>";
$amount_pre=array();
$recieved_pre=array();
$pending_pre =array();
$signups_pre =array();
$discount_pre =array();

$result_pre = mysql_query($sql_pre) or trigger_error(mysql_error()); 
while($row_pre = mysql_fetch_array($result_pre)){ 
foreach($row_pre AS $key => $value) { $row_pre[$key] = stripslashes($value); }

//http://www.w3schools.com/sql/func_date_sub.asp	SUBTRACTING 1 MONTH from date in mysql query
//http://www.plus2net.com/sql_tutorial/date-lastweek.php


$countresult_pre=$row_pre['amount'];

$date_subtracted = date('n') - 1;
$countmonthsql_pre="select amount as amounttran, discount_tran FROM campus_transaction where month(dateRecieved)>='".$date_subtracted."'  and studentID=".$row_pre['studentID']." and schedule_id=".$row_pre['id'].""; 

$countmonthesult_pre=mysql_query($countmonthsql_pre) or die(mysql_error());
$countmonthesult_pre=mysql_fetch_assoc($countmonthesult_pre);


$maxdate_rec_pre="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row_pre['studentID']." and schedule_id=".$row_pre['id'].""; 
$maxdate_rec_result_pre=mysql_query($maxdate_rec_pre) or die(mysql_error());
$maxdate_rec_result_pre=mysql_fetch_assoc($maxdate_rec_result_pre);

$amount_pre[$row_pre['id']]=$countresult_pre;
$recieved_pre[$row_pre['id']]=$countmonthesult_pre['amounttran'];
$pending_pre[$row_pre['id']]=$countresult_pre-$countmonthesult_pre['amounttran']-$countmonthesult_pre['discount_tran'];
//echo "<br>";
if($pending_pre[$row_pre['id']]<0)
{
$pending_pre[$row_pre['id']]=0;
}
$discount_pre[$row_pre['id']] = $countmonthesult_pre['discount_tran'];


/////////////GETTING COUNTRY//////////////// NEWLY ADDED

$query_country_pre="SELECT countryID FROM campus_students where id=".$row_pre['studentID']." "; 
$query_country_result_pre=mysql_query($query_country_pre) or die(mysql_error());
$query_country_result_pre=mysql_fetch_assoc($query_country_result_pre);



	if($row_pre['month']==date('n') && $row_pre['year']==date('Y'))
	{
	$signups_pre[$row_pre['id']]=$countresult_pre;
	}
	if($pending_pre[$row_pre['id']] > 0 && ($signups_pre[$row_pre['id']]==''))
	{
	echo "<tr>";  
	echo "<td valign='top'>" . nl2br( $row_pre['paydayz'])  . "</td>";
	echo "<td valign='top'>" . "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row_pre['studentID'])) . "</a></td>";  
	echo "<td valign='top'>" . showUser( nl2br( $row_pre['LeadId'])) . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $query_country_result_pre['countryID']),'country'). "</td>"; 
	echo "<td valign='top'>" . showCourse(nl2br( $row_pre['courseID'])). "</td>"; 
	//echo "<td valign='top'>$" . nl2br( $amount_pre[$row_pre['id']])  . "</td>";  
	//echo "<td valign='top'>$" . nl2br( $recieved_pre[$row_pre['id']]) . "</td>";  
	echo "<td valign='top'>$" . nl2br( $pending_pre[$row_pre['id']]) . "</td>";  
	//echo "<td valign='top'>$" . nl2br( $signups_pre[$row_pre['id']]) . "</td>";
	//echo "<td valign='top'>$" . nl2br( $discount_pre[$row_pre['id']]) . "</td>";
	//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row_pre['due_date']) . "</td>";
	//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row_pre['pay_date']) . "</td>";
	//echo "<td valign='top'>" . nl2br( $maxdate_rec_result_pre['date_rec_cam_tran']). "</td>"; 
	//echo "<td valign='top'>" . nl2br( $maxdate_rec_result_pre['maxdate_rec']). "</td>"; 
	//echo "<td valign='top'>" . $date_subtracted . "</td>"; 
	echo "</tr>"; 
	}
}


echo "<tr>";  
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'>Sum </td>";  
//echo "<td valign='top'><b>$" . nl2br( array_sum($amount_pre))  . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved_pre)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($pending_pre)) . "</td>"; 
//echo "<td valign='top'><b>$" . nl2br( array_sum($signups_pre)) . "</td>";   
//echo "<td valign='top'><b>$" . nl2br( array_sum($discount_pre)) . "</td>";  
echo "</tr>";
echo "</table>";
*/


//CURRENT MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the CURRENT MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

echo "<div align='center' style='color:red; font-size:16px'>CURRENT MONTH PENDINGS</div>";

echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
echo "<th class='specalt'>Student Name</th>";
echo "<th class='specalt'>TL Name</th>";
echo "<th class='specalt'>Country</th>";
echo "<th class='specalt'>Cousre</th>";
//echo "<th class='specalt'>Total Amount</th>"; 
//echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Pending Amount</th>"; 
//echo "<th class='specalt'>Signup Amount</th>";
//echo "<th class='specalt'>Discount</th>";
//echo "<th class='specalt'>SignUp Date</th>";
//echo "<th class='specalt'>Paying Date</th>";
//echo "<th class='specalt'>Received Date</th>"; 
//echo "<th class='specalt'>Current Month Due date</th>"; 
echo "</tr>";

$amount=array();
$recieved=array();
$pending =array();
$signups =array();
$discount =array();


$result = mysql_query($sql) or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }


$countresult=$row['amount'];
//echo "<br>";
$amount[$row['id']]=$countresult;

//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses



	$countmonthsql="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>='".date('n')."'  and studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
	$countmonthesult=mysql_query($countmonthsql) or die(mysql_error());
	$countmonthesult=mysql_fetch_assoc($countmonthesult);

	$amount[$row['id']]=$countresult;
	$recieved[$row['id']]=$countmonthesult['amounttran'];
	$pending[$row['id']]=$countresult-$countmonthesult['amounttran']-$countmonthesult['discount_tran'];
	if($pending[$row['id']]<0)
	{
	$pending[$row['id']]=0;
	}
	$discount[$row['id']] = $countmonthesult['discount_tran'];


	/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

	$maxdate_rec="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row['studentID']." and schedule_id=".$row['id'].""; 
	$maxdate_rec_result=mysql_query($maxdate_rec) or die(mysql_error());
	$maxdate_rec_result=mysql_fetch_assoc($maxdate_rec_result);


/////////////GETTING COUNTRY//////////////// NEWLY ADDED

$query_country="SELECT countryID FROM campus_students where id=".$row['studentID']." "; 
$query_country_result=mysql_query($query_country) or die(mysql_error());
$query_country_result=mysql_fetch_assoc($query_country_result);



	if($row['month']==date('n') && $row['year']==date('Y'))
	{
	$signups[$row['id']]=$countresult;
	}

	if($pending[$row['id']] > 0 && ($signups[$row['id']]==''))
	{
	echo "<tr>";  
	echo "<td valign='top'>" . nl2br( $row['paydayz'])  . "</td>";
	echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
	echo "<td valign='top'>" . showUser( nl2br( $row['LeadId'])) . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $query_country_result['countryID']),'country'). "</td>"; 
	echo "<td valign='top'>" . showCourse(nl2br( $row['courseID'])). "</td>"; 
	//echo "<td valign='top'>$" . nl2br( $amount[$row['id']])  . "</td>";  
	//echo "<td valign='top'>$" . nl2br( $recieved[$row['id']]) . "</td>";  
	echo "<td valign='top'>$" . nl2br( $pending[$row['id']]) . "</td>";  
	//echo "<td valign='top'>$" . nl2br( $signups[$row['id']]) . "</td>";
	//echo "<td valign='top'>$" . nl2br( $discount[$row['id']]) . "</td>";
	//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row['due_date']) . "</td>";
	//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row['pay_date']) . "</td>";
	//echo "<td valign='top'>" . nl2br( $maxdate_rec_result['date_rec_cam_tran']). "</td>"; 
	//echo "<td valign='top'>" . nl2br( $maxdate_rec_result['maxdate_rec']). "</td>"; 
	echo "</tr>"; 
	}
}


echo "<tr>";  
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'> </td>";
 echo "<td valign='top'>Sum </td>";  
//echo "<td valign='top'><b>$" . nl2br( array_sum($amount))  . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($pending)) . "</td>"; 
//echo "<td valign='top'><b>$" . nl2br( array_sum($signups)) . "</td>";
//echo "<td valign='top'><b>$" . nl2br( array_sum($discount)) . "</td>";   
echo "</tr>";
echo "</table>";




//NEXT MONTH
//*******************************************************************************************************************************************************************//
//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> Following is related to the NEXT MONTH DUES CALCULATIONS <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
/*
echo "<div align='center' style='color:red; font-size:16px'>NEXT MONTH PENDINGS</div>";
//1st condition for curr month+next month
if($toMonth>$fromMonth)
{
echo "1st";
	echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
	echo "<tr>"; 
	echo "<th class='specalt'>Day</th>"; 
	echo "<th class='specalt'>Student Name</th>";
	echo "<th class='specalt'>TL Name</th>";
	echo "<th class='specalt'>Country</th>";
	echo "<th class='specalt'>Cousre</th>";
	//echo "<th class='specalt'>Total Amount</th>"; 
	//echo "<th class='specalt'>Recieved Amount</th>"; 
	echo "<th class='specalt'>Pending Amount</th>"; 
	//echo "<th class='specalt'>Signup Amount</th>";
	//echo "<th class='specalt'>Discount</th>";
	//echo "<th class='specalt'>SignUp Date</th>";
	//echo "<th class='specalt'>Paying Date</th>";
	//echo "<th class='specalt'>Received Date</th>"; 
	//echo "<th class='specalt'>Current Month Due date</th>"; 


		$amount2=array();
		$recieved2=array();
		$pending2 =array();
		$signups2 =array();
		$discount2 =array();


		$result2 = mysql_query($sql2) or trigger_error(mysql_error()); 
		while($row2 = mysql_fetch_array($result2)){ 
		foreach($row2 AS $key => $value) { $row2[$key] = stripslashes($value); }


		$countresult2=$row2['amount'];
		//echo "<br>";
		$amount2[$row2['id']]=$countresult2;
		//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses



			$countmonthsql2="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>'".date('n')."'  and studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$countmonthesult2=mysql_query($countmonthsql2) or die(mysql_error());
			$countmonthesult2=mysql_fetch_assoc($countmonthesult2);

			$amount2[$row2['id']]=$countresult2;
			$recieved2[$row2['id']]=$countmonthesult2['amounttran'];
			$pending2[$row2['id']]=$countresult2-$countmonthesult2['amounttran']-$countmonthesult2['discount_tran'];
			if($pending2[$row2['id']]<0)
			{
			$pending2[$row2['id']]=0;
			}
			$discount2[$row2['id']] = $countmonthesult2['discount_tran'];


			/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

			$maxdate_rec2="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$maxdate_rec_result2=mysql_query($maxdate_rec2) or die(mysql_error());
			$maxdate_rec_result2=mysql_fetch_assoc($maxdate_rec_result2);


		/////////////GETTING COUNTRY//////////////// NEWLY ADDED

		$query_country2="SELECT countryID FROM campus_students where id=".$row2['studentID']." "; 
		$query_country_result2=mysql_query($query_country2) or die(mysql_error());
		$query_country_result2=mysql_fetch_assoc($query_country_result2);



		if($row2['month']==date('n') && $row2['year']==date('Y'))
		{
		$signups2[$row2['id']]=$countresult2;
		}
		if($pending2[$row2['id']] > 0 && ($signups2[$row2['id']]==''))
		{
		echo "<tr>";  
		echo "<td valign='top'>" . nl2br( $row2['paydayz'])  . "</td>";
		echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row2['studentID']}>" . showStudents(nl2br( $row2['studentID'])) . "</a></td>";  
		echo "<td valign='top'>" . showUser( nl2br( $row2['LeadId'])) . "</td>";
		echo "<td valign='top'>" . getData(nl2br( $query_country_result2['countryID']),'country'). "</td>"; 
		echo "<td valign='top'>" . showCourse(nl2br( $row2['courseID'])). "</td>"; 
		//echo "<td valign='top'>$" . nl2br( $amount2[$row2['id']])  . "</td>";  
		//echo "<td valign='top'>$" . nl2br( $recieved2[$row2['id']]) . "</td>";  
		echo "<td valign='top'>$" . nl2br( $pending2[$row2['id']]) . "</td>";  
		//echo "<td valign='top'>$" . nl2br( $signups2[$row2['id']]) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $discount2[$row2['id']]) . "</td>";
		//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row2['due_date']) . "</td>";
		//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row2['pay_date']) . "</td>";
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['date_rec_cam_tran']). "</td>"; 
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['maxdate_rec']). "</td>"; 

		echo "</tr>"; 
		}
	}


		echo "<tr>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'>Sum </td>";  
		//echo "<td valign='top'><b>$" . nl2br( array_sum($amount2))  . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved2)) . "</td>";  
		echo "<td valign='top'><b>$" . nl2br( array_sum($pending2)) . "</td>"; 
		//echo "<td valign='top'><b>$" . nl2br( array_sum($signups2)) . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($discount2)) . "</td>";   

		echo "</tr>";

}



//2nd condition for NEXT month+NEXT month
else if($toMonth>=$fromMonth && $fromMonth==$curr_mon_add_one && $toMonth==$curr_mon_add_one)
{
echo "2nd";
	echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
	echo "<tr>"; 
	echo "<th class='specalt'>Day</th>"; 
	echo "<th class='specalt'>Student Name</th>";
	echo "<th class='specalt'>TL Name</th>";
	echo "<th class='specalt'>Country</th>";
	echo "<th class='specalt'>Cousre</th>";
	//echo "<th class='specalt'>Total Amount</th>"; 
	//echo "<th class='specalt'>Recieved Amount</th>"; 
	echo "<th class='specalt'>Pending Amount</th>"; 
	//echo "<th class='specalt'>Signup Amount</th>";
	//echo "<th class='specalt'>Discount</th>";
	//echo "<th class='specalt'>SignUp Date</th>";
	//echo "<th class='specalt'>Paying Date</th>";
	//echo "<th class='specalt'>Received Date</th>"; 
	//echo "<th class='specalt'>Current Month Due date</th>"; 


		$amount2=array();
		$recieved2=array();
		$pending2 =array();
		$signups2 =array();
		$discount2 =array();


		$result2 = mysql_query($sql2) or trigger_error(mysql_error()); 
		while($row2 = mysql_fetch_array($result2)){ 
		foreach($row2 AS $key => $value) { $row2[$key] = stripslashes($value); }


		$countresult2=$row2['amount'];
		//echo "<br>";
		$amount2[$row2['id']]=$countresult2;
		//http://stackoverflow.com/questions/5268369/multiple-mysql-where-between-clauses



			$countmonthsql2="select amount as amounttran,discount_tran FROM campus_transaction where month(dateRecieved)>'".date('n')."'  and studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$countmonthesult2=mysql_query($countmonthsql2) or die(mysql_error());
			$countmonthesult2=mysql_fetch_assoc($countmonthesult2);

			$amount2[$row2['id']]=$countresult2;
			$recieved2[$row2['id']]=$countmonthesult2['amounttran'];
			$pending2[$row2['id']]=$countresult2-$countmonthesult2['amounttran']-$countmonthesult2['discount_tran'];
			if($pending2[$row2['id']]<0)
			{
			$pending2[$row2['id']]=0;
			}
			$discount2[$row2['id']] = $countmonthesult2['discount_tran'];


			/////////////CALCULATING REC DATE//////////////// NEWLY ADDED

			$maxdate_rec2="SELECT MAX(dateRecieved) as maxdate_rec,MAX(date) as date_rec_cam_tran FROM campus_transaction where studentID=".$row2['studentID']." and schedule_id=".$row2['id'].""; 
			$maxdate_rec_result2=mysql_query($maxdate_rec2) or die(mysql_error());
			$maxdate_rec_result2=mysql_fetch_assoc($maxdate_rec_result2);


		/////////////GETTING COUNTRY//////////////// NEWLY ADDED

		$query_country2="SELECT countryID FROM campus_students where id=".$row2['studentID']." "; 
		$query_country_result2=mysql_query($query_country2) or die(mysql_error());
		$query_country_result2=mysql_fetch_assoc($query_country_result2);



		if($row2['month']==date('n'))
		{
		$signups2[$row2['id']]=$countresult2;
		}
		if($pending2[$row2['id']] > 0 && ($signups2[$row2['id']]==''))
		{
		echo "<tr>";  
		echo "<td valign='top'>" . nl2br( $row2['paydayz'])  . "</td>";
		echo "<td valign='top'>" .  "<a href=transaction_list.php?id={$row2['studentID']}>" . showStudents(nl2br( $row2['studentID'])) . "</a></td>";  
		echo "<td valign='top'>" . showUser( nl2br( $row2['LeadId'])) . "</td>";
		echo "<td valign='top'>" . getData(nl2br( $query_country_result2['countryID']),'country'). "</td>"; 
		echo "<td valign='top'>" . showCourse(nl2br( $row2['courseID'])). "</td>"; 
		//echo "<td valign='top'>$" . nl2br( $amount2[$row2['id']])  . "</td>";  
		//echo "<td valign='top'>$" . nl2br( $recieved2[$row2['id']]) . "</td>";  
		echo "<td valign='top'>$" . nl2br( $pending2[$row2['id']]) . "</td>";  
		//echo "<td valign='top'>$" . nl2br( $signups2[$row2['id']]) . "</td>";
		//echo "<td valign='top'>$" . nl2br( $discount2[$row2['id']]) . "</td>";
		//echo "<td valign='top' style='color:red; font-weight:bold'>" .  nl2br( $row2['due_date']) . "</td>";
		//echo "<td valign='top' style='color:green; font-weight:bold'>" .  nl2br( $row2['pay_date']) . "</td>";
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['date_rec_cam_tran']). "</td>"; 
		//echo "<td valign='top'>" . nl2br( $maxdate_rec_result2['maxdate_rec']). "</td>"; 

		echo "</tr>"; 
		}
	}


		echo "<tr>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'> </td>";
		 echo "<td valign='top'>Sum </td>";  
		//echo "<td valign='top'><b>$" . nl2br( array_sum($amount2))  . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($recieved2)) . "</td>";  
		echo "<td valign='top'><b>$" . nl2br( array_sum($pending2)) . "</td>"; 
		//echo "<td valign='top'><b>$" . nl2br( array_sum($signups2)) . "</td>";
		//echo "<td valign='top'><b>$" . nl2br( array_sum($discount2)) . "</td>";   

		echo "</tr>";
}

echo "</table>";




echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
echo "<br>";
*/

//>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>> TOTAL SUM <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

echo "<div align='center' style='color:blue; font-size:16px'>TOTAL SUM</div>";
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>";
if( nl2br( array_sum($pending))>0 )
{ 
	//$amount_total = nl2br( array_sum($amount_pre)) + nl2br( array_sum($amount)) + nl2br( array_sum($amount2));
	//$recieved_total = nl2br( array_sum($recieved_pre)) + nl2br( array_sum($recieved)) + nl2br( array_sum($recieved2));
	$pending_total = nl2br( array_sum($pending)) ;
	//$signups_total = nl2br( array_sum($signups_pre)) + nl2br( array_sum($signups)) + nl2br( array_sum($signups2));
	//$discount_total = nl2br( array_sum($discount_pre)) + nl2br( array_sum($discount)) + nl2br( array_sum($discount2));
}	
	
	echo "<td valign='top' style='color:blue; font-weight:bold'> </td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'> </td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'> </td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'> </td>";
	echo "<td valign='top' style='color:blue; font-weight:bold'>Sum </td>";    
	//echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $amount_total . "</td>";
	//echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $recieved_total . "</td>";  
	echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $pending_total . "</td>"; 
	//echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $signups_total . "</td>";
	//echo "<td valign='top' style='color:blue; font-weight:bold'><b>$" . $discount_total . "</td>";   
	echo "<td valign='top' style='color:blue; font-weight:bold'></td>";
echo "</tr>";
echo "</table>";



//****************************** TABLE FOR 2nd PART of TEACHER's COMMISION ******************************
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Student Name</b></th>"; 
echo "<th class='specalt'><b>Course</b></th>"; 
echo "<th class='specalt'><b>Regular classes(P)</b></th>"; 
echo "<th class='specalt'><b>Makeover classes(P)</b></th>"; 
echo "<th class='specalt'><b>Recurring</b></th>"; 
//echo "<th class='specalt'><b>S</b></th>"; 
//echo "<th class='specalt'><b>E</b></th>"; 

echo "<th class='specalt'><b>Class duration(Avg)</b></th>"; 
echo "<th class='specalt'><b>Status</b></th>";
echo "</tr>";


function sec2hms ($sec, $padHours = false) {
$hms = "";
$hours = intval(intval($sec) / 3600);
$hms .= ($padHours)
? str_pad($hours, 2, "0", STR_PAD_LEFT). ':'
: $hours. ':';
$minutes = intval(($sec / 60) % 60);
$hms .= str_pad($minutes, 2, "0", STR_PAD_LEFT). ':';
$seconds = intval($sec % 60);
$hms .= str_pad($seconds, 2, "0", STR_PAD_LEFT);
return $hms;
}



//NOTE ******************	HELPFUL WEBSITE REGARDING timediff, sum, time_to_sec and sec_to_time
//http://stackoverflow.com/questions/4102480/mysql-how-to-sum-a-timediff-on-a-group

//TIMEDIFF(endTime,classStartTime) AS class_time_diff,
//SEC_TO_TIME(SUM(TIMEDIFF(endTime,classStartTime))) AS class_time_diff_sum,
//TIMEDIFF(endTime,classStartTime) AS class_time_diff,
	$result_regular="SELECT 
	campus_attendance_student.id as sa_id,count(campus_attendance_student.studentID) as sa_sid,
	campus_attendance_student.studentID as student_name,
	campus_attendance_student.teacherID as sa_tid,campus_attendance_student.courseID as sa_cid,
	campus_attendance_student.classType as sa_CT,campus_attendance_student.std_status as sa_SS,
	campus_attendance_student.classStartTime as sa_cst,campus_attendance_student.endTime as sa_cet,
	campus_attendance_student.status as sa_S,campus_attendance_student.date as sa_date,
	
	
	
	SUM(TIME_TO_SEC(endTime) - TIME_TO_SEC(classStartTime)) class_time_diff,
	
	
	campus_attendance_student.schedule_id as sa_sch_id 
	FROM campus_attendance_student 
	WHERE campus_attendance_student.teacherID='".$_POST['search-teacher-id']."' and 
	campus_attendance_student.std_status=2 and campus_attendance_student.status=1 ";
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$result_regular.=" and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."'";
	}
	
	$result_regular.=" GROUP BY campus_attendance_student.studentID,campus_attendance_student.std_status ";
	$result_regular=mysql_query($result_regular);
	
	
	//Arrays of Amount and pending etc
	$recieved = array();
	$recieved_with_tran_id = array();
	$signups = array();
	$amount = array();
	$pending_2nd_tbl = array();

	
	while(($row_regular = mysql_fetch_array($result_regular)))
	{ 

		
		//echo "<br>";
		// Class STARTTIME
		//echo $row_regular['sa_cst'];
		//echo "<br>";
		// Class ENDTIME
		//echo $row_regular['sa_cet'];
		
		// Calculating ALL CLASS TIMES AVERAGE - IN SECONDS
		$total_class_time_average = $row_regular['class_time_diff'] / $row_regular['sa_sid'];
		
		//echo "<br>";
		$total_class_time = $total_class_time_average;
		
		
		//echo "<br>";
		// Calculating ALL CLASS TIMES AVERAGE - IN HH:MM:SS
		// Following is really used in colums
		$total_class_time_final_result = sec2hms($total_class_time);


		//echo "<br>";
		//echo "NAME_ID-".$row_regular['student_name'];
		//echo "<br>";

		echo "<td valign='top'>" . showStudents(nl2br( $row_regular['student_name'])) . "</td>"; 
		echo "<td valign='top'>" . getData( nl2br( $row_regular['sa_cid']),'course') . "</td>";
		echo "<td valign='top'>" . $row_regular['sa_sid'] . "</td>";
		echo "<td valign='top'> </td>";

		
		
//RECURRING YES/NO 2nd PART
		
/*
NEVER use INNER JOIN if you are not using COLUMN NAMES of the other table and using
ONLY 1 table
*/
	
/*FUCKING SHIT changed the query of Campus_schedule and campus_transaction*/
	$sql_recurr_paid_stu=" SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,year(campus_schedule.duedate) AS year,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,
	campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.startTime 
	FROM campus_schedule WHERE campus_schedule.studentID='".$row_regular['student_name']."' and 
	campus_schedule.id='".$row_regular['sa_sch_id']."' and 	
	campus_schedule.`status` = 1 and campus_schedule.std_status=2 and 
	campus_schedule.teacherID='".$_POST['search-teacher-id']."'
	";
$result_sql_recurr_paid_stu = mysql_query($sql_recurr_paid_stu);

// Following while and the conditions inside it are for RECURRING PAID STUDENTS(similar to PAYMENT RECORD REPORT)
while($row_sql_recurr_paid_stu = mysql_fetch_array($result_sql_recurr_paid_stu))
	{


		$signup_check=1;
		$countresult=$row_sql_recurr_paid_stu['amount'];
		
		$countmonthsql="select amount as amounttran_not_main,discount_tran,date,operator,id FROM campus_transaction where date BETWEEN '".nl2br(prepareDate($_POST['fromDate']))."' AND '".nl2br(prepareDate($_POST['toDate']))."' and studentID=".$row_sql_recurr_paid_stu['studentID']." and schedule_id=".$row_sql_recurr_paid_stu['id']." and teacherID='".$_POST['search-teacher-id']."'"; 
		$countmonthesult=mysql_query($countmonthsql);
		$countmonthesult=mysql_fetch_assoc($countmonthesult);
		
		$amount[$row_sql_recurr_paid_stu['id']]=$countresult;
		
		//echo "<br>";
		$pending_2nd_tbl[$countmonthesult['id']]=$countresult-$countmonthesult['amounttran_not_main']-$countmonthesult['discount_tran'];
		//echo "<br>";
		
		//This is simply signup between 2 dates
		if(($row_sql_recurr_paid_stu['due_date']>=nl2br(prepareDate($_POST['fromDate'])) && $row_sql_recurr_paid_stu['due_date']<=nl2br(prepareDate($_POST['toDate']))) && $row_sql_recurr_paid_stu['due_date']==$countmonthesult['date']/*(Got required result by this-[date=due_date(receive date=signup date)])*/ && !empty($countresult))
		{
		$signups[$row_sql_recurr_paid_stu['id']]=$row_sql_recurr_paid_stu['amount'];
		$signup_check=0;
		echo "<td valign='top'>Signup</td>";
		}

		if(!empty($countresult) && ($countmonthesult['date']>=nl2br(prepareDate($_POST['fromDate'])) && $countmonthesult['date']<=nl2br(prepareDate($_POST['toDate']))) && $signup_check==1)
		{
		$recieved[$row_sql_recurr_paid_stu['id']]=$row_sql_recurr_paid_stu['amounttran'];//oldly used
		//Array for Recurring Paid students
		$total_recurr_paid_stu_array[$row_sql_recurr_paid_stu['tran_id']]=$row_sql_recurr_paid_stu['amounttran'];
		//Row count for recurring paid students counting
		$row_count_recurr_paid_stu = $row_count_recurr_paid_stu +1;
			//Recurring PAID AMOUNT
			if($countmonthesult['amounttran_not_main']>0)
			{
				echo "<td valign='top'>" . $countmonthesult['amounttran_not_main'] ." </td>";
			}
			//Recurring PAID WITH ZERO or DEAD
			if($countmonthesult['amounttran_not_main']==0)
			{
				echo "<td valign='top'>PAID WITH ZERO AND/OR DEAD</td>";
			}
			
		}
		//If PENDING is not ZERO, show NO(means pending not paid)
		if($pending_2nd_tbl[$countmonthesult['id']]>0)
		{
			echo "<td valign='top'>NO </td>";
		}
	}//END of INNER while loop

			
			//echo "<td valign='top'>". $row_regular['sa_cst']."</td>";
			//echo "<td valign='top'>". $row_regular['sa_cet']."</td>";
			
			echo "<td valign='top'>". $total_class_time_final_result."</td>";
			
			if($countmonthesult['amounttran_not_main']>0 && $total_class_time_final_result<'0:50:00')
			{
				echo "<td valign='top'>1-Alarming</td>";
			}
			else if($countmonthesult['amounttran_not_main']>0 && $total_class_time_final_result>='0:50:00')
			{
				echo "<td valign='top'>Satisfied</td>";
			}
			else if($pending_2nd_tbl[$countmonthesult['id']]>0 && $total_class_time_final_result<'0:50:00')
			{
				echo "<td valign='top'>2-Alarming</td>";
			}
			else if($pending_2nd_tbl[$countmonthesult['id']]>0 && $total_class_time_final_result>='0:50:00')
			{
				echo "<td valign='top'>3-Alarming</td>";
			}
			else
			{
			}
			
			
			
		echo "</tr>";
	}//END of OUTER while loop
	
	
echo "</table>";
?>




<?
//****************************** TABLE FOR 3rd FINAL PART of TEACHER's COMMISION ******************************
//RECURRING COMMISION
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Recurring</b></th>"; 
echo $total_recurr_paid_amount_array = nl2br( array_sum($total_recurr_paid_stu_array));
echo "<br>";
echo $third_table_recurr;

if(($third_table_recurr >=10) && ($third_table_recurr<12))
{
	// 3 % commision if recurring paid students is >=10 and less than 12
	$total_recurr_paid_amount_commision_DOLLAR = ($total_recurr_paid_amount_array) * (3/100);
}
if($third_table_recurr >= 12)
{
	// 5 % commision if recurring paid students is >=12
	$total_recurr_paid_amount_commision_DOLLAR = ($total_recurr_paid_amount_array) * (5/100);
}
if($third_table_recurr < 10)
{
	// NO commision of RECURR PAID STUDENTS
	$total_recurr_paid_amount_commision_DOLLAR = 0;
}
echo "<td valign='top'> " . $total_recurr_paid_amount_commision_DOLLAR . "</td>";
echo $total_recurr_paid_amount_commision_RS = $total_recurr_paid_amount_commision_DOLLAR * $_POST['exchange_rate'];
echo "<td valign='top'><b> Rs . " . $total_recurr_paid_amount_commision_RS = round($total_recurr_paid_amount_commision_RS, 2) . "</td>";
echo "</tr>";

//SIGNUPS COMMISION
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Signups</b></th>"; 
echo "<td valign='top'><b> $" . nl2br( array_sum($total_regular_sum_array)) . "</td>";
$total_signup_commision_RS = (array_sum($total_regular_sum_array)/90) * 500 ;
echo "<td valign='top'><b> Rs . " . $total_signup_commision_RS = round($total_signup_commision_RS, 2) . "</td>";
echo "</tr>";

//REFERENCE COMMISION
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Reference</b></th>"; 
echo "<td valign='top'><b> $" . nl2br( array_sum($total_reference_amount_count_array)) . "</td>";
$total_reference_commision_RS = (array_sum($total_reference_amount_count_array)/90) * 1000 ;
echo "<td valign='top'><b> Rs . " . $total_reference_commision_RS = round($total_reference_commision_RS , 2) . "</td>";
echo "</tr>";


//Adding RECURRING, SIGNUPS and REFERENCE COMMISIONS
$TOTAL = $total_recurr_paid_amount_commision_RS + $total_signup_commision_RS + $total_reference_commision_RS;
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Commision</b></th>"; 
echo "<td valign='top'><b> </td>";
echo "<td valign='top'><b> Rs . " . $TOTAL . "</td>";
echo "</tr>";
?>



<?
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
echo "</table>"; 
} 
include('include/footer.php');
?>