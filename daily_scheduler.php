<? 
include('config.php');
include('include/header.php');
?>
<form action='<?php echo $_SERVER['PHP_SELF']?>' method='post'>
<?php 
if($_SESSION['userType']!=3) { ?>



<?php echo getDataList(stripslashes($_POST['teacher']),'teacher',3);}?>


<select name='days[]'  >
<option>Select Days</option>
<option <?php if(isset($_POST['days']) && in_array("Monday",$_POST['days'])){ echo "selected='selected'";}?>>Monday</option>
<option <?php if(isset($_POST['days']) && in_array("Tuesday",$_POST['days'])){ echo "selected='selected'";}?>>Tuesday</option>
<option <?php if(isset($_POST['days']) && in_array("Wednesday",$_POST['days'])){ echo "selected='selected'";}?>>Wednesday</option>
<option <?php if(isset($_POST['days']) && in_array("Thursday",$_POST['days'])){ echo "selected='selected'";}?>>Thursday</option>
<option <?php if(isset($_POST['days']) && in_array("Friday",$_POST['days'])){ echo "selected='selected'";}?>>Friday</option>
<option <?php if(isset($_POST['days']) && in_array("Saturday",$_POST['days'])){ echo "selected='selected'";}?>>Saturday</option>
<option <?php if(isset($_POST['days']) && in_array("Sunday",$_POST['days'])){ echo "selected='selected'";}?>>Sunday</option>
</select>&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['classDate']),'classDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;<input type="submit" class="button" value="Show Classes" name="submit"></form><br /><br /><br />
<a href='https://www.yourcloudcampus.com/ccmsycc_fileupload/' target='_blank'>
<img src='images/upload_file.png' width='60px' height='60px' />
<span style='font-size:20px; color:#ff7802' >Send file to Student</span>
</a>
<? 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>DUE DATE</b></th>";
echo "<th class='specalt'><b>Course</b></th>"; 
//echo "<th class='specalt'><b>Skype ID</b></th>";
//echo "<th class='specalt'><b>Skype ID</b></th>";
echo "<th class='specalt'><b>Ext ID OLD</b></th>";
echo "<th class='specalt'><b>Extension ID</b></th>";
echo "<th class='specalt'><b>Status</b></th>";  
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>End time</b></th>"; 
//echo "<th class='specalt'><b>Start Date</b></th>"; 
//echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>USERNAME</b></th>"; 
echo "<th class='specalt'><b>PASSWORD</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
//echo "<th class='specalt'><b>Comments</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>";
echo "<th class='specalt' colspan=3><b>Actions</b></th>";  
echo "</tr>";
$systemdate = systemDate();

//Auto filter of Current day**********************
date('l');//echo "<br>"; //Week day with small 'l', Monday,Tuesday,Wednesday etc
$systemdate;//echo "<br>"; //  Our CCMS date
$ccms_week_day = date('l', strtotime( $systemdate));//echo "<br>"; // Calculationg CCMS week day
$ccms_week_day_number = date('w', strtotime( $systemdate));//echo "<br>"; // Calculationg CCMS week day number
//************************************************

if(!isset($_POST['days'])){
	$_POST['days'][0]='Monday';
	}
if(!isset($_POST['classDate'])){
	$_POST['classDate']=date('Y-m-d');
	
	}
if($_SESSION['userType']==3) {

	
//$result = mysql_query("SELECT `campus_schedule`.*  FROM `campus_schedule` where status=1 and `campus_schedule`.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and teacherID='".$_SESSION['userId']."' and classType in (".getPlan($_POST['days'][0]).") order by `campus_schedule`.startTime asc") or trigger_error(mysql_error());
$sql = "SELECT `campus_schedule`.*  FROM `campus_schedule` where status=1 and `campus_schedule`.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.std_status!=7 and teacherID='".$_SESSION['userId']."' and campus_schedule.status_dead=0 ";
if(isset($_POST['days'][0]) && isset($_POST['submit']))
{
	$sql.=" and classType in (".getPlan($_POST['days'][0]).") ";
}
else
{
	$sql.=" and classType in (".getPlan($ccms_week_day).") ";
}
$sql.=" order by `campus_schedule`.startTime asc ";
$result = mysql_query($sql) or trigger_error(mysql_error());

//QUERY FOR Teacher scoring points for EMPLOYEE OF THE MONTH
//NOW COMMENTING FOLLOWING QUERY	//Commenting on 26-07-2013
/*$result_regular="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId!=0 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.teacherID='".$_SESSION['userId']."' and campus_schedule.std_status=2 and campus_schedule.std_status!=3 and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	$result_regular.="  GROUP BY campus_schedule.teacherID,campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc,campus_schedule.teacherID desc";
	$result_regular=mysql_query($result_regular);*/

}
else{



$result = mysql_query("SELECT `campus_schedule`.*  FROM `campus_schedule` where status=1 and `campus_schedule`.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.std_status!=7 and teacherID='".$_POST['teacher']."' and classType in (".getPlan($_POST['days'][0]).") and startDate<='".prepareDate($_POST['classDate'])."' and endDate>='".prepareDate($_POST['classDate'])."' order by `campus_schedule`.startTime asc") or trigger_error(mysql_error());
}

//$first_date = strtotime($_POST['classDate']);
//$second_date = strtotime('-7 day', $first_date);
//print 'First Date ' . date('Y-m-d', $first_date);
//print 'Next Date ' . date('Y-m-d', $second_date);

//QUERY FOR Teacher scoring points for EMPLOYEE OF THE MONTH
//NOW COMMENTING FOLLOWING
/*
while(($row_regular = mysql_fetch_array($result_regular)))
{ 
$total_amount_per_teacher = $row_regular['dues'];
}

$total_points = (($total_amount_per_teacher/50)-3.25)*0.78;
$total_points_round_off = round($total_points,2);

echo "<div align='center' style='color:green'><label>Your current points for <b><u>EMPLOYEE OF THE MONTH : " . $total_points_round_off . "</u></b></label></div>";
*/
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

$query="select `campus_students`.extId , `campus_students`.extId_old , `campus_students`.id , `campus_students`.username , `campus_students`.password from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);

$sql_meetinglink="SELECT * FROM campus_meeting_link WHERE teacherID='".$row['teacherID']."' ";
$result_meetinglink=mysql_query($sql_meetinglink);
$row_meetinglink=mysql_fetch_array($result_meetinglink);


	if($row['startDate']>$systemdate)
	{
		echo "<tr>";  
		echo "<td valign='top'></td>";
		echo "<td valign='top'></td>";
		echo "<td valign='top'></td>";    
		echo "<td valign='top'></td>"; 
		echo "<td valign='top'></td>";  
		echo "<td valign='top'></td>";
		echo "<td valign='top' style='color:RED; font-weight:bold'>Schedule will be activated after the given date - " . nl2br( $row['startDate']) . "</td>";  
		echo "<td valign='top'></td>";   
		echo "<td valign='top'></td>"; 
		echo "<td valign='top'></td>";
		echo "<td valign='top'></td>"; 
		echo "<td valign='top'></td>";  
		echo "<td valign='top'></td>";
		echo "</tr>";
	}

	if($row['startDate']<=$systemdate)
	{
		echo "<tr>";
		echo "<td valign='top'>" . date('d',strtotime($row['duedate'])) . "</td>";
		echo "<td valign='top'>" . getData(nl2br( $row['courseID']),'course') . "</td>";  
		//echo "<td valign='top'>" . getSkypeID_of_manage_schedule(nl2br( $row['skypeid'])) . "</td>";
		//echo "<td valign='top'>" . nl2br( $row['skypetext']) . "</td>";
		echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".$rows['extId_old']."' target=_blank >" . $rows['extId_old'] . "</a></td>";
		echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $rows['id']))."' target=_blank >" . getextID(nl2br( $rows['id'])) . "</a></td>";
		echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>";    
		echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>"; 
		echo "<td valign='top'>" . nl2br( $row['endTime']) . "</td>";  
		//echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
		//echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";   
		//Following student ID is sent to class_details_teacher_sub_version.php NOT TO CLASS_DETAILS.PHP for security reasons
		echo "<td valign='top'>" .  "<a href=class_details_teacher_sub_version.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>"; 
		//////////////////////////
		echo "<td valign='top'>" . nl2br( $rows['username']) . "</td>";
		echo "<td valign='top'>" . nl2br( $rows['password']) . "</td>";
		echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
		//FOR COMMENTS-Removing rn
		$comments = $row['comments'];
		$comments = stripslashes($comments);
		$comments = str_replace("rn","\r\n",$comments);
		//echo "<td valign='top'>" . $comments . "</td>"; 
		echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";  
		echo "<td valign='top'>";
		//Link for Chat Panel //Start //newly added 25-02-17
		echo "<a class=button target='_blank' href=chat_panel.php?id={$row['studentID']}>Chat</a>";
		//Link for Chat Panel //End
		$_invalid=getClassStatus($row['id'],$_POST['classDate']);
		if($row_meetinglink['linkID']!=""){
				echo "<a class=button style='background-color:ORANGE' href='".$row_meetinglink['linkID']."'  target='_blank' >Start Session</a>";
				}
		if($_invalid=='2' ){
		echo "<a class=button style='background-color:RED' href=student_attandance.php?id={$row['id']}>Start Class</a>";}
		else if($_invalid=='-1'){

		/////***** Following code is to check that teacher took more than 50 min class*****/////
		////////////////////////////////////////////////////////////////////////////////////////
		$timenow = time();
		$newtime = $timenow;
		date('H:i:s' , $newtime);
		//$newtime = $timenow+32400;
		$sql_30min_class = "select * from `campus_attendance_student` where `studentID` = '".$row['studentID']."' and  `teacherID` ='".$row['teacherID']."' and  `startTime` ='".$row['startTime']."' and date='".$_LIST['systemdate']."' ";
		$_result_30min_class=mysql_query($sql_30min_class) or die(mysql_error());
		while($row_30min_class = mysql_fetch_array($_result_30min_class)){

		//Subtracting CURRENT TIME from classStartTime
			$class_duration =  round(abs($timenow) - strtotime(nl2br( $row_30min_class['classStartTime'])));
			$class_duration = gmdate('H:i:s',$class_duration);
			/* if($class_duration>="00:30:00" && $row_30min_class['courseID']!=11)
			{ */
				echo "<a class=button style='background-color:GREEN' href=student_attandance.php?eid={$row['id']}>End Class</a>";
			/* } */
			//Following is for QURAN END CLASS whose duration is 25 MIN
			/* else if($class_duration>="00:25:00" && $row_30min_class['courseID']==11)
			{
				echo "<a class=button style='background-color:GREEN' href=student_attandance.php?eid={$row['id']}>End Class(Quran)</a>";
			}
			else if($class_duration<"00:30:00" && $row_30min_class['courseID']!=11)
			{
				if($_SESSION['userId']==174){
				echo "<a class=button style='background-color:ORANGE' href='https://www.gotomeet.me/FaheemUr-Rehman'  target='_blank' >GoToMeeting</a>";
				}
				echo "<a class=button style='background-color:YELLOW' href=#>Blocked(class time < 30 MIN)</a>";
			} */
			//Following is for QURAN class
			/* else
			{
				echo "<a class=button style='background-color:YELLOW' href=#>Blocked(class time < 25 MIN)</a>";
			} */
		}
		//***************************************************************************************
		//***************************************************************************************
		}
		else if($_invalid=='3'){
		echo "<a class=button style='background-color:RED' href=student_attandance.php?eid={$row['id']}>BLOCKED</a>";}
		echo "</td> ";
		
		//Month Start and Month End Report
		$systemdate = systemDate();
		$systemdate = strtotime($systemdate);
		// First day of the month.
		$first_day_date=date('Y-m-01');
		$first_day = strtotime($first_day_date);
		// Fifth day of the month.
		$fifth_day_date=date('Y-m-05');
		$fifth_day = strtotime($fifth_day_date);
		
		// 25th day of the month.
		$t5_day_date=date('Y-m-25');
		$t5_day = strtotime($t5_day_date);
		// Last day of the month.
		$last_day_date=date('Y-m-t');
		$last_day = strtotime($last_day_date);
		
		$sql_check_start_end_report="SELECT * FROM campus_start_end_report WHERE schedule_id='".$row['id']."' ";
		if($systemdate>=$first_day && $systemdate<=$fifth_day)
		{
			$sql_check_start_end_report.=" and date BETWEEN '".$first_day_date."' AND '".$fifth_day_date."' ";
		}
		if($systemdate>=$t5_day && $systemdate<=$last_day)
		{
			$sql_check_start_end_report.=" and date BETWEEN '".$t5_day_date."' AND '".$last_day_date."' ";
		}
		$result_check_start_end_report = mysql_query($sql_check_start_end_report) or trigger_error(mysql_error());
		$rowcount = mysql_num_rows($result_check_start_end_report);
		
		if($systemdate>=$first_day && $systemdate<=$fifth_day){
			echo "<td valign='top'>";
			if($rowcount>0){
			echo "<a class=button style='background-color:green' target=_blank 
			href=#>
			Month START report-Submitted</a>";
			}
			else{
			echo "<a class=button style='background-color:Grey' target=_blank 
			href=daily_sch_month_start_end_report.php?id={$row['id']}&sID={$row['studentID']}&tID={$row['teacherID']}>
			Month START report</a>";
			}
			echo "</td> ";
		}
		else if($systemdate>=$t5_day && $systemdate<=$last_day){
			echo "<td valign='top'>";
			if($rowcount>0){
			echo "<a class=button style='background-color:green' target=_blank 
			href=#>
			Month END report-Submitted</a>";
			}
			else{
			echo "<a class=button style='background-color:Grey' target=_blank 
			href=daily_sch_month_start_end_report.php?id={$row['id']}&sID={$row['studentID']}&tID={$row['teacherID']}>
			Month END report</a>";
			}
			echo "</td> ";
		}
		echo "</tr>"; 
	}
}
echo "</table>"; 
include('include/footer.php');
?>