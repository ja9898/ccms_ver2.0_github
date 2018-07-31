<? 
include('config.php'); 
include('include/header.php'); 

//NEWLY ADDED
$student_id = $_GET['id']; 		//Passed from pending report overall
$course_id = $_GET['courseID']; 		//Passed from pending report overall
if($_GET['paydate_pre']!="" && isset($_GET['paydate_pre']))
{
$paydate_pre = $_GET['paydate_pre'];
}
else
{
$paydate = $_GET['paydate'];	//Passed from pending report overall
}
////////////
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
&nbsp;&nbsp;<?php //echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php //echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php //getTeacherFilter(); getTeacherFilterLead(); getPlanFilter();  //getStudentFilter(); ?>
&nbsp;&nbsp;<!--<input type="submit" class="button" name="submit" value="Filter">-->
<?php //echo "<label style='color:red; font-weight:bold'>Check the box to activate Teacher Teamlead filter</label>";
//echo getCheckbox($_POST['ttl_check'],'ttl_check'); ?>
</form>
</div>
<? echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>TeacherID</th>"; 
echo "<th class='specalt'>StudentID</th>"; 
echo "<th class='specalt'>Status</th>"; 
echo "<th class='specalt'>STD STATUS</th>"; 
echo "<th class='specalt'>plan</th>"; 
echo "<th class='specalt' style='color:green;'>REGULAR-Present Count</th>";
echo "<th class='specalt' style='color:red;'>REGULAR-Present [THAT CAN HAPPEN]</th>";
echo "<th class='specalt' style='color:blue;'>REG PRE + THAT CAN HAPPEN </th>";

echo "<th class='specalt'>Actual Count</th>";
echo "</tr>"; 

/* if(isset($_POST['submit']))
{
 */
if(isset($_GET['id'])){
	
	$_POST['search-student-id']=$_GET['id'];
	$_POST['search-submit']='';
	}

	//PREVIOUS MONTH PAYDATE
	if($paydate_pre!="" && isset($paydate_pre))
	{
		
		$fromDate_NEW=date('Y')."-".(date('m')-1)."-".$paydate_pre;
		$fromDate_NEW=date_create($fromDate_NEW);
		//1 month will be subtracted from current month
		$fromDate_NEW = date_sub($fromDate_NEW,date_interval_create_from_date_string("30 days"));
		echo $fromDate_NEW = date_format($fromDate_NEW,"Y-m-d");echo "<br>";
		echo $toDate_NEW=date('Y')."-".(date('m')-1)."-".$paydate_pre;echo "<br>";
	}
	//CURRENT MONTH PAYDATE
	if($paydate!="" && isset($paydate))
	{
		echo "<br>";
		echo "1st DATE RANGE";echo "<br>";
		
		echo $fromDate_NEW=date('Y')."-".date('m')."-".$paydate;echo "<br>";
		$fromDate_NEW=date_create($fromDate_NEW);
		$timestamp_fromDate= strtotime($fromDate_NEW);
		$fromDate_NEW_day = date("d", $timestamp_fromDate);echo "<br>";
		if($paydate>=date('d'))
		{
			echo "1st:";echo "<br>";
			echo $fromDate_NEW = date('Y')."-0".(date('m')-1)."-".$paydate;echo "<br>";
		}
		if($paydate<date('d'))
		{
			echo "2nd:";echo "<br>";
			//Making the fromDate format by using PAYDATE from pending report overall
			echo $fromDate_NEW = date('Y')."-0".(date('m'))."-".$paydate;echo "<br>";
			//echo $fromDate_NEW = date_format($fromDate_NEW,"Y-m-d");echo "<br>";
		}
		//Making the toDate format till CURRENT DATE to check how many REGULAR classes have been PRESENT
		echo $toDate_NEW=date('Y-m-d');echo "<br>";
		echo "<br>";echo "<br>";
		
		echo "2nd DATE RANGE";echo "<br>";
		//Adding 1 in the current DATE, And then will make a range from CURR DATE to NEXT PAYDATE
		echo $toDate_NEW_plus_1 = date('Y-m-d', strtotime($toDate_NEW . ' +1 day'));echo "<br>";
		$timestamp = strtotime($toDate_NEW_plus_1);
		$toDate_NEW_plus_1_day = date("d", $timestamp);
		//Checking if CURR DATE +1 DAY is greater than paydate - then we will stop at NEXT MONTH paydate
		if($toDate_NEW_plus_1_day>$paydate)
		{
			//echo $paydate_curr_month_plus_one = date('Y')."-0".(date('m')+1)."-".$paydate;echo "<br>";
			echo $paydate_curr_month_plus_one = date('Y')."-".date('m')."-".$paydate;echo "<br>";
		}
		if($toDate_NEW_plus_1_day<=$paydate)
		{
			echo $paydate_curr_month_plus_one = date('Y')."-".date('m')."-".$paydate;echo "<br>";
		} 
	}
/* 	SELECT capmus_users.id as user_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_attendance_student.id,campus_attendance_student.schedule_id,
		count(campus_attendance_student.status) as sa_status,campus_attendance_student.teacherID,
		campus_attendance_student.startTime,campus_attendance_student.endTime,
		campus_attendance_student.courseID,campus_attendance_student.classType,
		campus_attendance_student.classStartTime,campus_attendance_student.comments,
		campus_attendance_student.lessonDetails,campus_attendance_student.std_status,campus_attendance_student.status,
		campus_attendance_student.date,campus_attendance_student.lecture_image_filepath,campus_attendance_student.studentID  
		FROM capmus_users  
		INNER JOIN campus_attendance_student ON 
		campus_attendance_student.status=1 and (campus_attendance_student.std_status=2 OR  
		campus_attendance_student.std_status=5) and 
		capmus_users.id=campus_attendance_student.teacherID and 
		campus_attendance_student.date>= '".$fromDate_NEW."' and campus_attendance_student.date<= '".$toDate_NEW."' */
		$sql_paydate_to_curr_date_present_cnt="
		SELECT 
		campus_attendance_student.id,campus_attendance_student.schedule_id,
		count(campus_attendance_student.status) as sa_status,campus_attendance_student.teacherID,
		campus_attendance_student.startTime,campus_attendance_student.endTime,
		campus_attendance_student.courseID,campus_attendance_student.classType,
		campus_attendance_student.classStartTime,campus_attendance_student.comments,
		campus_attendance_student.lessonDetails,campus_attendance_student.std_status,campus_attendance_student.status,
		campus_attendance_student.date,campus_attendance_student.lecture_image_filepath,campus_attendance_student.studentID  
		FROM  campus_attendance_student WHERE  
		campus_attendance_student.status=1  and  
		campus_attendance_student.courseID='".$course_id."' and 
		campus_attendance_student.date>= '".$fromDate_NEW."' and campus_attendance_student.date<= '".$toDate_NEW."'
		";		
		if($_POST['search-teacher-id']!=0)
		{
			//$sql_paydate_to_curr_date_present_cnt.="  and campus_attendance_student.teacherID='".$_POST['search-teacher-id']."'";
		}
		if($_POST['search-student-id']!=0)
		{
			$sql_paydate_to_curr_date_present_cnt.=" and campus_attendance_student.studentID='".$_POST['search-student-id']."' ";
		}
		/* if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql_paydate_to_curr_date_present_cnt.=" and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."'";
		} */
		if(isset($_POST['classType']) && !empty($_POST['classType']))
		{
			$sql_paydate_to_curr_date_present_cnt.=" and  ".getClassTypeSchedule($_POST['classType']);
		}
		//	ADD LATE TOMORROW	$sql_paydate_to_curr_date_present_cnt.="  GROUP BY campus_attendance_student.teacherID,campus_attendance_student.studentID,campus_attendance_student.status,campus_attendance_student.classType";

		$sql_paydate_to_curr_date_present_cnt.="  GROUP BY campus_attendance_student.status";
		$result_paydate_to_curr_date_present_cnt = mysql_query($sql_paydate_to_curr_date_present_cnt);
	
	/////////////////////////////////////////////////////// PAYDATE CURRENT RANGE ****************<<<<<<<<<<<<<<<	
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
	$date1 = $_POST['fromDate']; 
	$date2 = $_POST['toDate']; 
	}
	else
	{
	$date1 = $fromDate_NEW; 
	$date2 = $toDate_NEW;
	}
	//$date2 = date('t-m-Y'); 

	# Do some checks here for valid dates and to make sure date1 is less than date2 

	# Time strings 
	$time1 = strtotime($date1); echo "<br>";
	$time2 = strtotime($date2); echo "<br>";

	$days_mtw = 0; 
	$days_tfs = 0; 
			while($time1 <= $time2) { 
			   $chk_mtw = date('D', $time1); # Actual date conversion 
			   $chk_tfs = date('D', $time1);
			   $chk_mtwtf = date('D', $time1);
			   if($chk_mtw != 'Sun' && $chk_mtw != 'Thu' && $chk_mtw != 'Fri' && $chk_mtw != 'Sat')
				  $days_mtw++;
			   if($chk_tfs != 'Sun' && $chk_tfs != 'Mon' && $chk_tfs != 'Tue' && $chk_tfs != 'Wed')
				  $days_tfs++;
			   if($chk_mtwtf != 'Sun' && $chk_mtwtf != 'Sat')
				  $days_mtwtf++;
				  
			   $time1 += 86400; # Add a day 
			}
	/* 	}
	} */
	echo "Mon,Tue,Wed ** -- ".$days_mtw;echo "<br>";
	echo "Thu,Fri,Sat ** -- ".$days_tfs;echo "<br>";
	echo "Mon,Tue,Wed,Thu,Fri ** -- ".$days_mtwtf;echo "<br>";
	
	/////////////////////////////////////////////////////// PAYDATE NEXT RANGE ****************<<<<<<<<<<<<<<<
	echo "NR1:".$date1_next_range = $toDate_NEW_plus_1; 
	echo "NR2:".$date2_next_range = $paydate_curr_month_plus_one;
	//$date2 = date('t-m-Y'); 

	# Do some checks here for valid dates and to make sure date1 is less than date2 

	# Time strings 
	$time1_next_range = strtotime($date1_next_range); echo "<br>";
	$time2_next_range = strtotime($date2_next_range); echo "<br>";

	$days_mtw_next_range = 0; 
	$days_tfs_next_range = 0; 
			while($time1_next_range <= $time2_next_range) { 
			   $chk_mtw_next_range = date('D', $time1_next_range); # Actual date conversion 
			   $chk_tfs_next_range = date('D', $time1_next_range);
			   $chk_mtwtf_next_range = date('D', $time1_next_range);
			   if($chk_mtw_next_range != 'Sun' && $chk_mtw_next_range != 'Thu' && $chk_mtw_next_range != 'Fri' && $chk_mtw_next_range != 'Sat')
				  $days_mtw_next_range++;
			   if($chk_tfs_next_range != 'Sun' && $chk_tfs_next_range != 'Mon' && $chk_tfs_next_range != 'Tue' && $chk_tfs_next_range != 'Wed')
				  $days_tfs_next_range++;
			   if($chk_mtwtf_next_range != 'Sun' && $chk_mtwtf_next_range != 'Sat')
				  $days_mtwtf_next_range++;
				  
			   $time1_next_range += 86400; # Add a day 
			}
	/* 	}
	} */
	echo "Mon,Tue,Wed _NEXT_RANGE ** -- ".$days_mtw_next_range;echo "<br>";
	echo "Thu,Fri,Sat _NEXT_RANGE ** -- ".$days_tfs_next_range;echo "<br>";
	echo "Mon,Tue,Wed,Thu,Fri _NEXT_RANGE ** -- ".$days_mtwtf_next_range;echo "<br>";
	//Adding PAYDATE CURRENT RANGE and PAYDATE NEXT RANGE
	$total_RANGE_mtw = $days_mtw + $days_mtw_next_range;
	$total_RANGE_tfs = $days_tfs + $days_tfs_next_range;
	
	
while($row = mysql_fetch_array($result_paydate_to_curr_date_present_cnt)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
if($row['sa_status'] + $days_mtw_next_range < 12 && $row['classType']==1) 
echo "<td valign='top' style='background-color:red; font-size:10px;'>1" . showStudents(nl2br( $row['studentID'])) . "</td>";
else if($row['sa_status'] + $days_tfs_next_range < 12 && $row['classType']==2)
echo "<td valign='top' style='background-color:red; font-size:10px;'>2" . showStudents(nl2br( $row['studentID'])) . "</td>";
else if($row['sa_status'] + $days_mtwtf_next_range < 21 && $row['classType']==3)
echo "<td valign='top' style='background-color:red; font-size:10px;'>3" . showStudents(nl2br( $row['studentID'])) . "</td>";
else
echo "<td valign='top' style='background-color:green; font-size:16px;'>O.K." . showStudents(nl2br( $row['studentID'])) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['status']),'class_status') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";
if($row['classType']==1 || $row['classType']==5 || $row['classType']==6 || $row['classType']==7)
{
	echo "<td valign='top'>" . ($row['sa_status']) . "</td>";
	echo "<td valign='top'>" . ($days_mtw_next_range) . "</td>";
	echo "<td valign='top' style='color:blue;'>" . ($row['sa_status'] + $days_mtw_next_range) . "</td>";
	echo "<td valign='top'>" . ($days_mtw + $days_mtw_next_range) . "</td>";
}
if($row['classType']==2 || $row['classType']==8 || $row['classType']==9 || $row['classType']==10)
{
	echo "<td valign='top'>" . ($row['sa_status']) . "</td>";
	echo "<td valign='top'>" . ($days_tfs_next_range) . "</td>";
	echo "<td valign='top' style='color:blue;'>" . ($row['sa_status'] + $days_tfs_next_range) . "</td>";
	echo "<td valign='top'>" . ($days_tfs + $days_tfs_next_range) . "</td>";
}
if($row['classType']==3)
{
	echo "<td valign='top'>" . ($row['sa_status']) . "</td>";
	echo "<td valign='top'>" . ($days_mtwtf_next_range) . "</td>";
	echo "<td valign='top' style='color:blue;'>" . ($row['sa_status'] + $days_mtwtf_next_range) . "</td>";
	echo "<td valign='top'>" . ($days_mtwtf + $days_mtwtf_next_range) . "</td>";
}
echo "</tr>"; 
} 
/* } */
echo "</table>"; 

include('include/footer.php');?>