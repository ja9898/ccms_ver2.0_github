<? 
include('config.php');
include('include/header.php');  

/* if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227 || $_SESSION['userId']==411 || $_SESSION['userId']==195 || $_SESSION['userId']==126 || $_SESSION['userId']==625)
{ */

$id = (int) $_GET['id'];
$student_id = (int) $_GET['student_id'];

if (isset($_POST['submitted'])) { 
if($id!=0 && !empty($id))
{
	if(!empty($_POST['comments_freeze']) )
	{
		
		//Check 15 days condition on freeze that if student paid within last 15 days then freeze is 
		//allowed
		$check_freeze="SELECT * FROM campus_transaction 
						WHERE studentID='".$student_id."' 
						and schedule_id='".$id."' ORDER BY id DESC LIMIT 1";
		$result_check_freeze = mysql_query($check_freeze);
		$rowcount_check_freeze = mysql_fetch_array($result_check_freeze);
	
		$now = date('Y-m-d'); 
		$current_date_time = strtotime($now);
		$rowcount_check_freeze['date'];
		$rowcount_check_freeze['id'];
		
		$your_date = strtotime($rowcount_check_freeze['date']);
		$datediff = $current_date_time - $your_date;

		$freeze_days_15_cond = round($datediff / (60 * 60 * 24));
	
		if($freeze_days_15_cond>15)
		{
			getMessages('error_check_freeze_15_days');
		}
	
		else
		{
			//Get previous values for log
			/////////////////////////////////////////////////////// FOR USER LOG
			$row_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
			$freeze_schedule_pre="Course:".getData( nl2br( $row_pre['courseID']),'course').",Teacher:".showUser( nl2br( $row_pre['teacherID'])).",Student:". showStudents(nl2br( $row_pre['studentID']))
							.",BKDATE:".nl2br( $row_pre['dateBooked']).",Class Days:".getData(nl2br( $row_pre['classType']),'plan').",Status:".getData(nl2br( $row_pre['std_status']),'stdStatusmo-list')
							.",Amount:".nl2br( $row_pre['dues']);
			/////////////////////////////////////////////////////// 

			//Change the values and FREEZE the schedule FUNCTION
			freeze_schedule($id,'4',$row_pre['std_status']);

			//Get new values for log
			/////////////////////////////////////////////////////// FOR USER LOG
			$row_new = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
			$freeze_schedule_new="Course:".getData( nl2br( $row_new['courseID']),'course').",Teacher:".showUser( nl2br( $row_new['teacherID'])).",Student:". showStudents(nl2br( $row_new['studentID']))
							.",BKDATE:".nl2br( $row_new['dateBooked']).",Class Days:".getData(nl2br( $row_new['classType']),'plan').",Status:".getData(nl2br( $row_new['std_status']),'stdStatusmo-list')
							.",Amount:".nl2br( $row_new['dues'])
							.",Freeze_date:".date('Y-m-d');
			/////////////////////////////////////////////////////// 

			//Enter the Data in the log
			user_log( $_SERVER['PHP_SELF'] , "FREEZE_SCHEDULE" , $freeze_schedule_pre ,$freeze_schedule_new, $_POST['comments_freeze']);
				
				
				$operator_name = showUser( nl2br( $_SESSION['userId']));
				$systemdate = systemDate();	
				
				//Checking that comments_general is NULL
				$comments_gen_NULL = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' ")); 
				if($comments_gen_NULL['comments_freeze']==NULL)
				{
				$sql = "UPDATE `campus_schedule` SET freeze_date='".$systemdate."' , `comments_freeze` ='\r\nOperator:{$operator_name} - Comments : {$_POST['comments_freeze']}\r\n' , `record_link_freeze` =  '".$_POST['record_link_freeze']."' WHERE `id` = '$id' "; 
				mysql_query($sql) or die(mysql_error()); 
				}
				else
				{
				$sql = "UPDATE `campus_schedule` SET freeze_date='".$systemdate."' , `comments_freeze` =concat(comments_freeze ,'\r\nOperator:{$operator_name} - Comments : {$_POST['comments_freeze']}\r\n') , `record_link_freeze` =  '".$_POST['record_link_freeze']."'  WHERE `id` = '$id' "; 
				mysql_query($sql) or die(mysql_error()); 
				}
//////////////////////////////////// To SEND EMAIL on every FREEZE	//START
$query="select `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$student_id;
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
$sql_row_values=mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$email_to_send_on_FREEZE = "<table border=1 id='table_liquid' cellspacing='2px' >
<tr bgcolor=#eceff5>
<th class='specalt' style='font-size:8px'><b>Id</b></th>
<th class='specalt' style='font-size:8px'><b>Status Old</b></th>
<th class='specalt' style='font-size:8px'><b>Status</b></th>
<th class='specalt' style='font-size:8px'><b>Comments/Reason</b></th> 
<th class='specalt' style='font-size:8px'><b>Email</b></th> 
<th class='specalt' style='font-size:8px'><b>Start time</b></th> 
<th class='specalt' style='font-size:8px'><b>Start Date</b></th> 
<th class='specalt' style='font-size:8px'><b>Student</b></th> 
<th class='specalt' style='font-size:8px'><b>Teacher</b></th>
<th class='specalt' style='font-size:8px'><b>Amount LOCAL CURRENCY</b></th> 
<th class='specalt' style='font-size:8px'><b>Country</b></th> 
<th class='specalt' style='font-size:8px'><b>Class Days</b></th> 
<th class='specalt' style='font-size:8px'><b>Freeze Date</b></th> 
<th class='specalt' style='font-size:8px'><b>Record link</b></th> 
</tr>";
$email_to_send_on_FREEZE.="<tr bgcolor=#eceff5>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['id']) ."</td>
	<td valign='top' style='font-size:8px'>". getData(nl2br( $sql_row_values['std_status_old']),'stdStatusmo-list') ."</td>
	<td valign='top' style='font-size:8px'>". getData(nl2br( $sql_row_values['std_status']),'stdStatusmo-list') ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['comments_freeze']) ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $rows['email']) ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['startTime']) ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['startDate']) ."</td>
	<td valign='top' style='font-size:8px'>". showStudents(nl2br( $sql_row_values['studentID'])) ."</td>
	<td valign='top' style='font-size:8px'>". showUser( nl2br( $sql_row_values['teacherID'])) ."</td>
	<td valign='top' style='font-size:8px'>$". nl2br( $sql_row_values['dues_original']) ."</td>
	<td valign='top' style='font-size:8px'>". getData(nl2br( $rows['countryID']),'country') ."</td>
	<td valign='top' style='font-size:8px'>". getData(nl2br( $sql_row_values['classType']),'plan') ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['freeze_date']) ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['record_link_freeze']) ."</td></tr></table>";
?>
<input rows="10" cols="90" id='email_to_send_on_FREEZE' name='email_to_send_on_FREEZE' readonly="readonly" type='hidden' value="<?php echo $email_to_send_on_FREEZE; ?>"/>
<?
echo '<script> email_to_send_on_FREEZE(); </script>';
//////////////////////////////////// To SEND EMAIL on every FREEZE	//START

			
				getMessages('freeze_schedule','book_scheduler_manage.php');
		}
	}
	else
	{
		getMessages('error');
	}
}
	?>
	
	<!--Commenting following countdown timer after FREEZEing schedule-Adding COMMENTS instead-->
	<!--<div id="countdown">
		<div style="float:left">You will be redirected within  </div>
		<div id="minutes" style="float:left; color:green; font-size:14px"> 00</div>
		<div style="float:left">:</div>
		<div id="seconds" style="float:left; color:green; font-size:14px">00 </div>
		<div style="float:left">  second(s)</div>
	</div>
	<div id="aftercount" style="display:none">Redirecting...</div>-->
	<!-- Countdown timer script, calling the JAVASCRIPT function in PHP file for FREEZE STUDENTS-->
	<!--<script type="text/javascript">UpdateTime();var counter = setInterval(UpdateTime, 500);</script>-->
	<?php
}
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' ")); 
?>

<form action='' method='POST' onsubmit="">

<div id="label">Comments Submitted(READ ONLY):</div><div id="field"><textarea readonly name='comments_freeze_readonly'><?php echo stripslashes($row['comments_freeze']);?></textarea></div> 

<div id="label">Comments Freeze:</div><div id="field"><textarea name='comments_freeze'></textarea></div>  

<div id="label">Recording Link:</div><div id="field"><input name='record_link_freeze' id='record_link_freeze' required/></div>

<div id="label"></div><div id="field"><input type='submit' value='Submit comments for this schedule' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 

<?
/* }
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
} */

include('include/footer.php');?> 