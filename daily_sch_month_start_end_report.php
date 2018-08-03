<? 
include('config.php');
include('include/header.php');  
$id = (int) $_GET['id'];
$studentID  = $_GET['sID'];
$teacherID  = $_GET['tID'];
if (isset($_POST['submitted'])) {

	if(isset($_POST['grade']) && $_POST['grade']!=0)
	{
		/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
		$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
		/////////////////////////////////////////////////////// 

		$sql_get_ttl_mttl="SELECT * FROM capmus_users WHERE id='".$row['teacherID']."'";
		$row_get_ttl_mttl = mysql_fetch_array ( mysql_query($sql_get_ttl_mttl));

		//Month Start Report
		$sql_start_end_report="INSERT INTO campus_start_end_report(studentID,grade,topics,date,teacherID,courseID,
		schedule_id,ttl,mttl,feedback) 
		VALUES('".$row['studentID']."','".$_POST['grade']."','".$_POST['topics']."','".date('Y-m-d')."',
		'".$row['teacherID']."','".$row['courseID']."','".$id."',
		'".$row_get_ttl_mttl['LeadId']."','".$row_get_ttl_mttl['main_LeadId']."' , '{$_POST['feedback']}')";
		mysql_query($sql_start_end_report);
		getMessages('add','daily_sch_ttl_month_start_end_report.php');
	}
	else
	{
		getMessages('error');
	}

}
?>
<? 		$systemdate = systemDate();
		$systemdate = strtotime($systemdate);
		// 25th day of the month.
		$t5_day=date('Y-m-25');
		$t5_day = strtotime($t5_day);
		// Last day of the month.
		$last_day=date('Y-m-t');
		$last_day = strtotime($last_day);
		if($systemdate>=$t5_day && $systemdate<=$last_day){
		$topics = "Topics covered:";
		}
		else{
		$topics = "Topics to be covered:";
		}
?>
<form action='' method='POST' onsubmit="return checkLength(this);">
<div id="label">Teacher Name:</div><div id="field"><label name='teacher-readonly'><?php echo showUser($teacherID); ?> </label></div>
<div id="label">Student Name:</div><div id="field"><label name='student-readonly'><?php echo showStudents($studentID); ?> </label></div>
<div id="label">Grade:</div><div id="field"><?php echo getList('','grade','grade');?> </div>
<div id="label"><?php echo $topics; ?></div><div id="field"><textarea name='topics' id='topics' required></textarea></div>
		<? if($systemdate>=$t5_day && $systemdate<=$last_day){ ?>
		<div id="label">Teacher Feedback:</div><div id="field"><textarea name='feedback' id='feedback' required></textarea></div>
		<? } ?>
<div id="label"></div><div id="field"><input type='submit' value='Generate Report' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<?include('include/footer.php');?>