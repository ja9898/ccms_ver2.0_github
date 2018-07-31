<? 
include('config.php'); 
include('include/header.php'); 
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php getTeacherFilter(); getTeacherFilterLead(); getPlanFilter();  //getStudentFilter(); ?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter">
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
//echo "<th class='specalt'>plan num</th>"; 
echo "<th class='specalt'>REGULAR-Present Count</th>";
echo "<th class='specalt'>Actual Count</th>";
echo "</tr>"; 

if(isset($_POST['submit']))
{

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
		$fromDate_NEW=date('Y')."-".date('m')."-".$paydate;
		$fromDate_NEW=date_create($fromDate_NEW);
		//1 month will be subtracted from current month
		$fromDate_NEW = date_sub($fromDate_NEW,date_interval_create_from_date_string("30 days"));
		echo $fromDate_NEW = date_format($fromDate_NEW,"Y-m-d");echo "<br>";
		echo $toDate_NEW=date('Y')."-".date('m')."-".$paydate;echo "<br>";
	}
		
	//$toDate = prepareDate($_POST['toDate']);echo "<br>";
	//$toDate = date('Y-m-d', strtotime($toDate . ' + 1 days'));echo "<br>";
	
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

	/* if($plan==""){ 
	
	$plan=$_POST['classType']; 
	
		if($plan!="")
		{
			if($plan==1) //classes on MON,TUE,WED
			{
				while($time1 <= $time2) { 
				   echo $chk_mtw = date('D', $time1); # Actual date conversion 
				   if($chk_mtw != 'Sun' && $chk_mtw != 'Thu' && $chk_mtw != 'Fri' && $chk_mtw != 'Sat')
					  $days_mtw++;

				   $time1 += 86400; # Add a day 
				}
			}
			if($plan==2) //classes on THU,FRI,SAT
			{
				while($time1 <= $time2) { 
				   echo $chk_tfs = date('D', $time1); # Actual date conversion 
				   if($chk_tfs != 'Sun' && $chk_tfs != 'Mon' && $chk_tfs != 'Tue' && $chk_tfs != 'Wed')
					  $days_tfs++;

				   $time1 += 86400; # Add a day 
				}
			}
	
		}
		else
		{ */
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
	
//if(isset($_POST['ttl_check']))
//{
	//FROM campus_attendance_student 
	//WHERE campus_attendance_student.status=1 and campus_attendance_student.std_status=2 and 
	//campus_attendance_student.teacherID='".$_POST['search-teacher-id']."' 
	//$result = getResultResource('campus_attendance_student',$_POST,'1');  
	$sql="SELECT capmus_users.id as user_id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
		campus_attendance_student.id,campus_attendance_student.schedule_id,count(campus_attendance_student.status) as sa_status,campus_attendance_student.teacherID,
		campus_attendance_student.startTime,campus_attendance_student.endTime,campus_attendance_student.courseID,campus_attendance_student.classType,
		campus_attendance_student.classStartTime,campus_attendance_student.comments,campus_attendance_student.lessonDetails,
		campus_attendance_student.std_status,campus_attendance_student.status,campus_attendance_student.date,
		campus_attendance_student.lecture_image_filepath,campus_attendance_student.studentID  
		FROM capmus_users 
		INNER JOIN campus_attendance_student ON 
		campus_attendance_student.status=1 and campus_attendance_student.std_status=2 and 
		capmus_users.id=campus_attendance_student.teacherID    		
		";		
		if($_POST['search-teacher-id']!=0)
		{
			$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' and campus_attendance_student.teacherID='".$_POST['search-teacher-id']."'";
		}
		if($_POST['search-teacher-id2']!=0 && isset($_POST['search-teacher-id2']))
		{
			$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."'";
		}
		if($_POST['search-student-id']!=0)
		{
			$sql.=" and campus_attendance_student.studentID='".$_POST['search-student-id']."' ";
		}
		/* if($fromDate_NEW!="" && $toDate_NEW!="")
		{
			$sql.=" and campus_attendance_student.date>= '".prepareDate($fromDate_NEW)."' and campus_attendance_student.date<= '".prepareDate($toDate_NEW)."'";
		} */
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql.=" and campus_attendance_student.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_student.date<= '".prepareDate($_POST['toDate'])."'";
		}
		if(isset($_POST['classType']) && !empty($_POST['classType']))
		{
			$sql.=" and  ".getClassTypeSchedule($_POST['classType']);
		}
		$sql.="  GROUP BY campus_attendance_student.teacherID,campus_attendance_student.studentID,campus_attendance_student.status,campus_attendance_student.classType";
		//echo $sql;
		$result = mysql_query($sql);
//}
		//Following function call is being used as query above
		//count_present_absent_classes_teacher_AND_student_wise($_POST['search-teacher-id'],$_POST['search-student-id'],$_POST['fromDate'],$_POST['toDate']);
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['status']),'class_status') . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";
//echo "<td valign='top'>" . $row['classType'] . "</td>";
echo "<td valign='top'>" . $row['sa_status'] . "</td>";
/* if($plan!="")
{
	if($row['classType']==1)
	{
		echo "<td valign='top'>" . $days_mtw . "</td>";
	}
	if($row['classType']==2)
	{
		echo "<td valign='top'>" . $days_mtw . "</td>";
	}
}
if($plan=="")
{ */
	if($row['classType']==1)
	{
		echo "<td valign='top'>" . $days_mtw . "</td>";
	}
	if($row['classType']==2)
	{
		echo "<td valign='top'>" . $days_tfs . "</td>";
	}
	if($row['classType']==3)
	{
		echo "<td valign='top'>" . $days_mtwtf . "</td>";
	}
/* }
 */	
echo "</tr>"; 
} 
}
echo "</table>"; 

include('include/footer.php');?>