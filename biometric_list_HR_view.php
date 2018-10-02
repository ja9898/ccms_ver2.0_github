<?
include('config.php');
include('include/header.php'); 
if($_SESSION['userType']==1)
{
	echo "<label style='color:RED; font-weight:bold; font-size:9px; margin-bottom:5px;'>NOTE: Add the following relevant BIOMETRIC ID under LIST EMPLOYEES to make the Attendance visible for specific teachers</label>";
}
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
<?php if($_SESSION['userType']==1 || $_SESSION['userType']==11 || $_SESSION['userType']==18 || 
$_SESSION['userType']==3 || $_SESSION['userType']==8 || $_SESSION['userType']==2 || 
$_SESSION['userType']==17){ getTeacherFilter(); getTeacherFilterLead(); }?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?
?></div>
<div style="float:left">
<?
?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
</div>
<br><br>
</form>
</div>
<?
if(isset($_POST['submit']))		//if $_POST['submit'] start
{


/**********No of Days in a month**********/ //START
$fromMonth=date('n',strtotime($_POST['fromDate']));
$toMonth=date('n',strtotime($_POST['toDate']));
	if($fromMonth==$toMonth){
		$NO_OF_DAYS_in_a_month = date('t');
		$NO_OF_DAYS_in_a_month=cal_days_in_month(CAL_GREGORIAN,$fromMonth,date('Y'));
	}
/**********No of Days in a month**********/ //END

/****************** SUNDAYS HOLIDAYS COUNT ********************/	//START
$fromDate_ccms = prepareDate($_POST['fromDate']);
$toDate_ccms = prepareDate($_POST['toDate']);
//$toDate = date('Y-m-d', strtotime($toDate . ' + 1 days'));echo "<br>";

$date1 = $fromDate_ccms; 
$date2 = $toDate_ccms; 
//$date2 = date('t-m-Y'); 

# Do some checks here for valid dates and to make sure date1 is less than date2 

# Time strings 
$time1 = strtotime($date1); 
$time2 = strtotime($date2); 

$sunday_count = 0; 
$sunday_array = array();
while($time1 <= $time2) { 
   ////<><><> echo "DAY:".
   $chk = date('D', $time1); # Actual date conversion 
   $chk2 = date('d', $time1);
   if($chk == 'Sun') {
	$daysofsun_text = $chk;
	$daysofsun_number = $chk2;
	$sunday_array[] = $daysofsun_number;
	$sunday_count++;
   }
   $time1 += 86400; # Add a day 
} 

$sunday_count;
/****************** SUNDAYS HOLIDAYS COUNT ********************/	//END

echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'>Name</th>"; 
$days_1_to_30 = array();
for($i=1; $i<=$NO_OF_DAYS_in_a_month; $i++){
echo "<th class='specalt'><b>".$i."</b></th>";
$days_1_to_30[$i] = $i;
}
echo "</tr>";
//TEACHERS
if($_SESSION['userType']==3 && ($_SESSION['emp_shift']==1 || $_SESSION['emp_shift']==2) && $_SESSION['designationID']!=17)
{
	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	day(campus_attendance_employee.date) as dateDays,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName,
	capmus_users.LeadId  
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId 
	AND capmus_users.id='".$_SESSION['userId']."'";
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['search-teacher-id2']!=0)
	{
		$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.="GROUP BY capmus_users.id ORDER BY user_id DESC ";//ORDER BY user_id DESC  GROUP BY capmus_users.id
	$result=mysql_query($sql) or die(mysql_error());
}
//SUPERAMDIN
if($_SESSION['userType']==1 || $_SESSION['userType']==11 || $_SESSION['userType']==18 || $_SESSION['userType']==17 || ($_SESSION['userType']==3 && $_SESSION['designationID']==17) ){

	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	day(campus_attendance_employee.date) as dateDays,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName,
	capmus_users.LeadId  
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId";
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['search-teacher-id2']!=0)
	{
		$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.="GROUP BY capmus_users.id ORDER BY user_id DESC ";//ORDER BY user_id DESC  GROUP BY capmus_users.id
	$result=mysql_query($sql) or die(mysql_error());
}
	$row_count = mysql_num_rows($result);echo "<br>";echo "<br>";echo "<br>";echo "<br>";
	
while($row = mysql_fetch_array($result)){ 
	//Query code for SHORT LEAVE APP checking		//START
	//echo "SELECT * FROM campus_empshort_leave WHERE empId = '".$row['user_id']."' and leaveApplied = '".$row['date']."' ";
	$short_leave_app_result = mysql_query("SELECT * FROM campus_empshort_leave WHERE empId = '".$row['user_id']."' and leaveApplied = '".$row['date']."' ") or trigger_error(mysql_error());
	//ROW COUNT
	$rowcount_short_leave_app = mysql_num_rows($short_leave_app_result);
	//Query code for SHORT LEAVE APP checking		//END	
echo "<tr>";  

//echo "<td valign='top'>" .nl2br($row['emp_att_id']). "</td>";
//echo "<td valign='top'>" . nl2br( $row['biometricId']) . "</td>";  
//echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>"; 
//echo "<td valign='top'>" . showUser(nl2br( $row['user_id'])) . "</td>"; 
echo "<td valign='top'>" . "<a href=biometric_list.php?teacherID={$row['user_id']}&fromDate={$fromDate_ccms}&toDate={$toDate_ccms} target='_blank'>".showUser(nl2br( $row['user_id']))."</a></td>";
				
$row['dateDays'];

		$sql_get_biometric_id="SELECT campus_attendance_employee.id as emp_att_id,
		campus_attendance_employee.biometricId,
		campus_attendance_employee.date,
		day(campus_attendance_employee.date) as dateDays,
		campus_attendance_employee.onDuty,
		campus_attendance_employee.offDuty,
		campus_attendance_employee.clockIn,
		campus_attendance_employee.clockOut,
		campus_attendance_employee.late,
		campus_attendance_employee.early,
		campus_attendance_employee.absent,
		campus_attendance_employee.exception,
		campus_attendance_employee.department 
	  
		FROM campus_attendance_employee 
		WHERE campus_attendance_employee.biometricId = '".$row['biometricId']."' ";
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql_get_biometric_id.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
		}
		$result_biometric_id=mysql_query($sql_get_biometric_id) or die(mysql_error());
		$att_dates = array(); 
		$j=1;
		while($row_bio_id = mysql_fetch_array($result_biometric_id)){
			$row_bio_id['dateDays'];
			$att_dates[$j] = $row_bio_id['dateDays']; // modified
			$j=$j+1;
			
		}//inner query 		END for dates display	

		
		
//Query code for LEAVE APP checking		//START
$leaves_array = array();
$casual_array = array();


	$sql_leave_app = "SELECT campus_empleave.*, day(LeaveStartDate) as Leave_StartDays,
	day(LeaveEndDate) as Leave_EndDays, LeaveType 
	FROM campus_empleave ";
	
	if($_SESSION['userType']==3)
	{
		$sql_leave_app.= "WHERE EmpId = '".$_SESSION['userId']."' "; 
	}
	else
	{
		$sql_leave_app.= "WHERE EmpId = '".$_POST['search-teacher-id']."' "; 
	}
	
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql_leave_app.=" and (LeaveStartDate >= '".prepareDate($_POST['fromDate'])."' AND LeaveEndDate <= '".prepareDate($_POST['toDate'])."' )";
	}
//Query code for LEAVE APP checking		//END
	$leave_app_result = mysql_query($sql_leave_app);
	//ROW COUNT
	$rowcount_leave_app = mysql_num_rows($leave_app_result);
	while($row_leave_app_result =  mysql_fetch_array($leave_app_result)){
		
		$row_leave_app_result['Leave_StartDays'];
		$row_leave_app_result['Leave_EndDays'];
		$leaves_array[] = $row_leave_app_result['Leave_StartDays'];
		$casual_array[] = $row_leave_app_result['LeaveType'];
	}		
		//print_r($leaves_array);
		//print_r($casual_array);
		
		$CL = 0;
			foreach($days_1_to_30 as $key=>$value){
				if(in_array($value,$att_dates)){
					echo "<td valign='top' style='background-color:green;'>P</td>"; 
				}
				else if(in_array($value,$sunday_array)){
					echo "<td valign='top' style='color:blue;'>SUN</td>";
				}
				else if(in_array($value,$leaves_array)){
					if(in_array("2",$casual_array,TRUE) && $CL==0){
					echo "<td valign='top' style='background-color:orange;'>CL</td>";
					$CL=1;
					}
					else{
						echo "<td valign='top' style='background-color:red;'>A</td>"; 
					}
				}
				else{
					echo "<td valign='top' style='background-color:red;'>A</td>"; 
				}
			}
		


echo "</tr>"; 
}//1st query 		END GROUP BY ONE
echo "</table>";
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	
	


	
	
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'>Actions</th>";
//echo "<th class='specalt'><b>id</b></th>";  
//echo "<th class='specalt' style='color:RED;'><b>biometricId</b></th>"; 
echo "<th class='specalt'><b>Teamlead</b></th>"; 
echo "<th class='specalt'><b>Name</b></th>"; 
echo "<th class='specalt'><b>date</b></th>";
echo "<th class='specalt'><b>onDuty</b></th>"; 
echo "<th class='specalt'><b>offDuty</b></th>"; 
echo "<th class='specalt'><b>clockIn</b></th>"; 
echo "<th class='specalt'><b>clockOut</b></th>"; 
//echo "<th class='specalt'><b>TS-Output_CI</b></th>"; 
//echo "<th class='specalt'><b>TS-Output_CO</b></th>"; 
//echo "<th class='specalt'><b>H:M:S</b></th>"; 
echo "<th class='specalt'><b>Output</b></th>"; 
echo "<th class='specalt'><b>LATE COMMENTS</b></th>"; 
echo "<th class='specalt'><b>EARLY COMMENTS</b></th>";
echo "<th class='specalt'><b>P/A</b></th>"; 
//echo "<th class='specalt'><b>late</b></th>"; 
//echo "<th class='specalt'><b>early</b></th>"; 
//echo "<th class='specalt'><b>Absent Alert</b></th>"; 
//echo "<th class='specalt'><b>absent</b></th>";
//echo "<th class='specalt'><b>exception</b></th>"; 
echo "<th class='specalt'><b>department</b></th>";
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());
if($_SESSION['userType']==3 && ($_SESSION['emp_shift']==1 || $_SESSION['emp_shift']==2) && $_SESSION['designationID']!=17)
{
	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName, 
	capmus_users.LeadId 
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId 
	AND capmus_users.id='".$_SESSION['userId']."'";
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.="ORDER BY user_id DESC";
	$result=mysql_query($sql) or die(mysql_error());
}

//MANAGE SCHEDULE AND FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8)
{
	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName,
	capmus_users.LeadId  	
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId 
	AND capmus_users.LeadId='".$_SESSION['userId']."' ";
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
	}
	$result=mysql_query($sql) or die(mysql_error());
}

else if($_SESSION['userType']==9)
{
	
}

//	NEWLY ADDED - MAIN TEACHER TEAMLEAD
else if($_SESSION['userType']==15)
{
	
}

//	NEWLY ADDED - ADMIN
else if($_SESSION['userType']==2)
{
	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName,
	capmus_users.LeadId  
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId";
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['search-teacher-id2']!=0)
	{
		$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
	}
	$result=mysql_query($sql) or die(mysql_error());
}



//SHOWING ALL THE TRIALS< REGULARS AND MAKEOVERS IN MANAGE SCHEDULE
if($_SESSION['userType']==1 || $_SESSION['userType']==11 || $_SESSION['userType']==18 || $_SESSION['userType']==17 || ($_SESSION['userType']==3 && $_SESSION['designationID']==17) ){
	$sql="SELECT campus_attendance_employee.id as emp_att_id,
	campus_attendance_employee.biometricId,
	campus_attendance_employee.date,
	campus_attendance_employee.onDuty,
	campus_attendance_employee.offDuty,
	campus_attendance_employee.clockIn,
	campus_attendance_employee.clockOut,
	campus_attendance_employee.late,
	campus_attendance_employee.early,
	campus_attendance_employee.absent,
	campus_attendance_employee.exception,
	campus_attendance_employee.department,
	capmus_users.id as user_id,
	capmus_users.biometricId as user_biometricId,
	capmus_users.firstName,
	capmus_users.lastName,
	capmus_users.LeadId  
	FROM campus_attendance_employee 
	INNER JOIN capmus_users 
	ON capmus_users.biometricId=campus_attendance_employee.biometricId";
	if($_POST['search-teacher-id']!=0)
	{
		$sql.=" and capmus_users.id='".$_POST['search-teacher-id']."' ";
	}
	if($_POST['search-teacher-id2']!=0)
	{
		$sql.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_attendance_employee.date>= '".prepareDate($_POST['fromDate'])."' and campus_attendance_employee.date<= '".prepareDate($_POST['toDate'])."'";
	}
	$sql.="ORDER BY user_id DESC";
	$result=mysql_query($sql) or die(mysql_error());	
	}
while($row = mysql_fetch_array($result)){ 
	//Query code for SHORT LEAVE APP checking		//START
	//echo "SELECT * FROM campus_empshort_leave WHERE empId = '".$row['user_id']."' and leaveApplied = '".$row['date']."' ";
	$short_leave_app_result = mysql_query("SELECT * FROM campus_empshort_leave WHERE empId = '".$row['user_id']."' and leaveApplied = '".$row['date']."' ") or trigger_error(mysql_error());
	//ROW COUNT
	$rowcount_short_leave_app = mysql_num_rows($short_leave_app_result);
	//Query code for SHORT LEAVE APP checking		//END	
echo "<tr>";  
if($_SESSION['userType']==1 || $_SESSION['userType']==11)
echo "<td valign='top'><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=biometric_delete.php?id={$row['emp_att_id']}>Delete</a></td></td>";
else 
echo "<td valign='top'><a class=button href=#>NA</a></td></td>";
//echo "<td valign='top'>" .nl2br($row['emp_att_id']). "</td>";
//echo "<td valign='top'>" . nl2br( $row['biometricId']) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>"; 
echo "<td valign='top'>" . showUser(nl2br( $row['user_id'])) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";

///////////// ON DUTY <<<<<<<<<<<<<<<<<<<<<<
echo "<td valign='top'>" . nl2br( $row['onDuty']) . "</td>"; 
//////////////////////////////ALL BELOW is for LATE  ////////////////////////////////	START
//Adding 10 minutes[in seconds within onDuty time]
$onDuty = strtotime(nl2br( $row['onDuty']));
$ten_min_onDuty = 600; //600 secs is equal to 10 mins
$onDuty_plus_10min = $onDuty + $ten_min_onDuty;
//Adding 1 hour in onDuty time for Short leave COND
$_1hr = 3600; //3600 secs is equal to 1 hr 		//1 Hour
$_4hrs = 14400; //14400 secs is equal to 4 hrs	//4 Hours
$onDuty_plus_1hr = $onDuty + $_1hr;		//Late and Short Leave Late Condition
$onDuty_plus_4hrs = $onDuty + $_4hrs;	//Full Leave Condition
/////////////////////////////////////////////////

///////////// OFF DUTY <<<<<<<<<<<<<<<<<<<<<<
echo "<td valign='top'>" . nl2br( $row['offDuty']) . "</td>";
//Subtracting 10 minutes[in seconds within offDuty time]	//In case of Mon,Tue,Wed,Thur,Fri <<<<<<<<<< offDuty
$offDuty = strtotime(nl2br( $row['offDuty']));
$ten_min_offDuty = 600; //600 secs is equal to 10 mins
$offDuty_minus_10min = $offDuty - $ten_min_offDuty; //Mon,Tue,Wed,Thur,Fri CONDITION

//Calculating 1 hr 10 min							//In case of Sat <<<<<<<<<< offDuty
$ten_min_offDuty = 600; //600 secs is equal to 10 mins
$_1hr = 3600;	//3600 secs is equal to 1 hr 		//1 Hour
$_1hr_10min = $ten_min_offDuty + $_1hr;
$offDuty_minus_1hr_10min = $offDuty - $_1hr_10min; 	//SAT CONDITION 

$offDuty_minus_1hr = $offDuty - $_1hr;				// For Short Leave Early

/////////////////////////////////////////////////


if($row['clockIn']==''){ echo "<td valign='top' style='color:RED;'>NOT CLOCKED IN</td>"; } 
else{ echo "<td valign='top'>" . nl2br( $row['clockIn']) . "</td>"; }
if($row['clockOut']==''){ echo "<td valign='top' style='color:RED;'>NOT CLOCKED OUT</td>"; }
else{ echo "<td valign='top'>" . nl2br( $row['clockOut']) . "</td>"; }
//echo "<td valign='top'>" . $TS_CI = strtotime(nl2br( $row['clockIn'])) . "</td>"; //TS is timestamp
//echo "<td valign='top'>" . $TS_CO = strtotime(nl2br( $row['clockOut'])) . "</td>";//TS is timestamp
$TS_CI = strtotime(nl2br( $row['clockIn'])) . "</td>"; //TS is timestamp
$TS_CO = strtotime(nl2br( $row['clockOut'])) . "</td>";//TS is timestamp
//Custom HOURS and MINUTES calculations	<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	$Output = $TS_CO  - $TS_CI ;
	$secondsInAMinute = 60;
    $secondsInAnHour  = 60 * $secondsInAMinute;
    $secondsInADay    = 24 * $secondsInAnHour;
    
	// extract hours
	$hourSeconds = $Output % $secondsInADay;
    $hours = floor($hourSeconds / $secondsInAnHour);
    // extract minutes
    $minuteSeconds = $hourSeconds % $secondsInAnHour;
    $minutes = floor($minuteSeconds / $secondsInAMinute);
	//Calculation manually for NIGHT SHIFT timings i.e 23:00 to 08:00 OR 22:00 to 07:00 // TO DO - Remaining
	if($hours<0)
	{
		$hours=$hours+24;
	}
	if($minutes<0)
	{
		$minutes=$minutes+60;
		//$hours=$hours-1;
	}
//////////////////////////////////////////////////////////////////////////////////////////////////
//LATE  - START
//echo "<td valign='top' style='color:green; font-weight:bold;'>" . $hours .":". $minutes . "</td>";
echo "<td valign='top' style='color:green; font-weight:bold;'>" . gmdate("H:i", $Output) . "</td>";
if($row['clockIn']=='')
{ 
	echo "<td valign='top' style='color:RED;'>NOT CLOCKED IN</td>";
} 
else 
{
	//General Late Condition >10 min AND <=1hr
	if($TS_CI>$onDuty_plus_10min && $TS_CI<=$onDuty_plus_1hr)
	{
		$late = $TS_CI - $onDuty;
		// extract hours
		$hourSeconds_late = $late % $secondsInADay;
		$hours_late = floor($hourSeconds_late / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_late = $hourSeconds_late % $secondsInAnHour;
		$minutes_late = floor($minuteSeconds_late / $secondsInAMinute);
		echo "<td valign='top' style='color:brown; font-weight:bold;'>LATE-" . $hours_late .":". $minutes_late."min". "</td>";
	}
	//SHOT LEAVE CONDITIONS - >10 min AND >1hr AND <4hrs
	else if($TS_CI>$onDuty_plus_10min && $TS_CI>$onDuty_plus_1hr && $TS_CI<$onDuty_plus_4hrs)
	{
		$late = $TS_CI - $onDuty;
		// extract hours
		$hourSeconds_late = $late % $secondsInADay;
		$hours_late = floor($hourSeconds_late / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_late = $hourSeconds_late % $secondsInAnHour;
		$minutes_late = floor($minuteSeconds_late / $secondsInAMinute);
		echo "<td valign='top' style='color:purple; font-weight:bold;'>SHORT LEAVE of 0" . $hours_late .":". $minutes_late ."min". "</td>";
	}
	//FULL LEAVE CONDITIONS - >10 min AND >1hr AND >=4hrs
	else if($TS_CI>$onDuty_plus_10min && $TS_CI>$onDuty_plus_1hr && $TS_CI>=$onDuty_plus_4hrs)
	{
		$late = $TS_CI - $onDuty;
		// extract hours
		$hourSeconds_late = $late % $secondsInADay;
		$hours_late = floor($hourSeconds_late / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_late = $hourSeconds_late % $secondsInAnHour;
		$minutes_late = floor($minuteSeconds_late / $secondsInAMinute);
		//Added for those whose onDuty time is 00:00 and their clockIn is less 		//NEWLY ADDED //24-06-16
		//than 00:00 meaning 23:50 or 23:30 etc 			// START
		if($hours_late=='23')
		{
			$hours_late = 00;
			echo "<td valign='top' style='color:green; font-weight:bold;'>BEFORE TIME</td>";
		}
		else {
		echo "<td valign='top' style='color:red; font-weight:bold;'>FULL LEAVE of " . $hours_late .":". $minutes_late ."min". "</td>";
		}
		//Added for those whose onDuty time is 00:00 and their clockIn is less 
		//than 00:00 meaning 23:50 or 23:30 etc 			// END
	}
	
	else
	{
		echo "<td valign='top' style='color:green; font-weight:bold;'>NOT LATE</td>";
	}
}
//LATE - END
////////////////////////////////ALL is for LATE//////////////////////////////////////	END 

//EARLY  - START
if($row['clockOut']=='')
{
	echo "<td valign='top' style='color:RED;'>NOT CLOCKED OUT "?> <?php 
	//Short Leave Applied START 
	if($rowcount_short_leave_app>=1 ) { echo "<label style='color:GREEN;'>[SHORT LEAVE APPLIED]</label>"; } 
	else { echo "<label style='color:GREY;'>[SHORT LEAVE NOT APPLIED]</label>"; } "</td>";
	//Short Leave Applied END
}
else 
{
	if($TS_CO>=$offDuty_minus_10min)
	{
		echo "<td valign='top' style='color:green; font-weight:bold;'>NO EARLYOUT</td>";
	}

	else
	{
		//Calculating the day of SATURDAY , And Grace time is 1 hr 10 min
		$date1 = prepareDate($_POST['fromDate']);
		$date2 = prepareDate($_POST['toDate']);
			$time1 = strtotime($date1);
			$time2 = strtotime($date2);
			$TS_emp_date = strtotime($row['date']);
		//$days = 1; 
		//while($time1 < $time2) { 
		$chk = date('D', $TS_emp_date); # Actual date conversion 
		if($chk == 'Sat' && $TS_CO>=$offDuty_minus_1hr_10min && $TS_CO<$offDuty){
			$early = $offDuty - $TS_CO;
			// extract hours
			$hourSeconds_early = $early % $secondsInADay;
			$hours_early = floor($hourSeconds_early / $secondsInAnHour);
			// extract minutes
			$minuteSeconds_early = $hourSeconds_early % $secondsInAnHour;
			$minutes_early = floor($minuteSeconds_early / $secondsInAMinute);
			echo "<td valign='top' style='color:orange; font-weight:bold;'>NO EARLYOUT</td>";
		}
		
		//} 
		//$days;
		
		
		else{
		//EarlyOut
		if($TS_CO<$offDuty_minus_10min && $TS_CO<$offDuty && $TS_CO>=$offDuty_minus_1hr){
		$early = $offDuty - $TS_CO;
		// extract hours
		$hourSeconds_early = $early % $secondsInADay;
		$hours_early = floor($hourSeconds_early / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_early = $hourSeconds_early % $secondsInAnHour;
		$minutes_early = floor($minuteSeconds_early / $secondsInAMinute);
		echo "<td valign='top' style='color:red; font-weight:bold;'>EarlyOut-0".$hours_early.":".$minutes_early."min"."</td>";
		}
		//SHORT LEAVE EarlyOut
		else if($TS_CO<$offDuty_minus_10min && $TS_CO<$offDuty && $TS_CO<$offDuty_minus_1hr){
		$early = $offDuty - $TS_CO;
		// extract hours
		$hourSeconds_early = $early % $secondsInADay;
		$hours_early = floor($hourSeconds_early / $secondsInAnHour);
		// extract minutes
		$minuteSeconds_early = $hourSeconds_early % $secondsInAnHour;
		$minutes_early = floor($minuteSeconds_early / $secondsInAMinute);
		echo "<td valign='top' style='color:purple; font-weight:bold;'>SHORT LEAVE of 0".$hours_early.":".$minutes_early."min"."</td>";
		}
		
		else{
			echo "<td valign='top' style='color:red; font-weight:bold;'>NONE</td>";
		}
		}
	}
}
//EARLY - END

//Present/Absent START
if($row['clockIn']=='' && $row['clockOut']=='')
{ 
echo "<td valign='top' style='background-color:RED;'>A</td>"; 
} 
else
{
echo "<td valign='top' style='background-color:GREEN;'>P</td>"; 
}
//Present/Absent END

//if($row['clockIn']==''){ echo "<td valign='top'>" . nl2br( $row['late']) . "</td>"; }
//else { echo "<td valign='top' style='color:RED;'>" . nl2br( $row['late']) . "</td>"; }
//echo "<td valign='top'>" . nl2br( $row['early']) . "</td>"; 
//echo "<td valign='top'>" . nl2br( $row['absent']) . "</td>"; 
//echo "<td valign='top'>" . nl2br( $row['exception']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['department']) . "</td>"; 
echo "</tr>"; 
} 
echo "</table>";






echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>Name</b></th>"; 
echo "<th class='specalt'><b>Start/End date</b></th>";
echo "<th class='specalt'><b>Leave Type</b></th>"; 
echo "<th class='specalt'><b>DAYS</b></th>";
echo "</tr>"; 
//Query code for LEAVE APP checking		//START
	$sql_leave_app = "SELECT * 
	FROM campus_empleave ";
	
	if($_SESSION['userType']==3)
	{	
		$sql_leave_app.= "WHERE EmpId = '".$_SESSION['userId']."' "; 
	}
	else
	{
		$sql_leave_app.= "WHERE EmpId = '".$_POST['search-teacher-id']."' "; 
	}
	
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql_leave_app.=" and (LeaveStartDate >= '".prepareDate($_POST['fromDate'])."' AND LeaveEndDate <= '".prepareDate($_POST['toDate'])."' )";
	}
//Query code for LEAVE APP checking		//END
	$leave_app_result = mysql_query($sql_leave_app);
	//ROW COUNT
	$rowcount_leave_app = mysql_num_rows($leave_app_result);
	while($row_leave_app_result =  mysql_fetch_array($leave_app_result)){
	echo "<tr>";
		echo "<td valign='top' style='background-color:RED;'>" . showUser( nl2br( $row_leave_app_result['EmpID'])) . "</td>";
		echo "<td valign='top' style='background-color:RED;'>[" . nl2br( $row_leave_app_result['LeaveStartDate']) ."]-[". nl2br( $row_leave_app_result['LeaveEndDate']) . "]</td>";  
		echo "<td valign='top' style='background-color:RED;'>" . getData(nl2br( $row_leave_app_result['LeaveType']),'LeaveType') . "</td>";
		echo "<td valign='top' style='background-color:RED;'>" . nl2br( $row_leave_app_result['NoOfDays']) . "</td>";
	echo "</tr>";
	}
echo "</table>";
} //	if $_POST['submit'] end
include('include/footer.php');
?>