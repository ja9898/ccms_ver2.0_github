<? 
include('config.php');
include('include/header.php');  

if($_SESSION['userId']==159 || $_SESSION['userId']==48)
{

$id = (int) $_GET['id'];
if (isset($_POST['submitted'])) { 
if($id!=0 && !empty($id))
{
	if(!empty($_POST['comments_transfertolhr']) )
	{
	//Get previous values for log
	/////////////////////////////////////////////////////// FOR USER LOG
	$row_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
	$transfertolhr_schedule_pre="Course:".getData( nl2br( $row_pre['courseID']),'course').",Teacher:".showUser( nl2br( $row_pre['teacherID'])).",Student:". showStudents(nl2br( $row_pre['studentID']))
					.",BKDATE:".nl2br( $row_pre['dateBooked']).",Class Days:".getData(nl2br( $row_pre['classType']),'plan').",Status:".getData(nl2br( $row_pre['std_status']),'stdStatusmo-list')
					.",Amount:".nl2br( $row_pre['dues']);
	/////////////////////////////////////////////////////// 

	//Change the values and transfertolhr_schedule FUNCTION
	transfertolhr_schedule($id,'7',$row_pre['std_status']);

	//Get new values for log
	/////////////////////////////////////////////////////// FOR USER LOG
	$row_new = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
	$transfertolhr_schedule_new="Course:".getData( nl2br( $row_new['courseID']),'course').",Teacher:".showUser( nl2br( $row_new['teacherID'])).",Student:". showStudents(nl2br( $row_new['studentID']))
					.",BKDATE:".nl2br( $row_new['dateBooked']).",Class Days:".getData(nl2br( $row_new['classType']),'plan').",Status:".getData(nl2br( $row_new['std_status']),'stdStatusmo-list')
					.",Amount:".nl2br( $row_new['dues'])
					.",TransferToLHR_date:".date('Y-m-d');
	/////////////////////////////////////////////////////// 

	//Enter the Data in the log
	user_log( $_SERVER['PHP_SELF'] , "TransferToLHR_SCHEDULE" , $transfertolhr_schedule_pre ,$transfertolhr_schedule_new, $_POST['comments_transfertolhr']);
		
		
		$operator_name = showUser( nl2br( $_SESSION['userId']));
		$systemdate = systemDate();	
		
		//Checking that comments_general is NULL
		$comments_gen_NULL = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' ")); 
		if($comments_gen_NULL['comments_transfertolhr']==NULL)
		{
		$sql = "UPDATE `campus_schedule` SET transfertolhr_date='".$systemdate."' , `comments_transfertolhr` ='\r\nOperator:{$operator_name} - Comments : {$_POST['comments_transfertolhr']}\r\n'  WHERE `id` = '$id' "; 
		mysql_query($sql) or die(mysql_error()); 
		}
		else
		{
		$sql = "UPDATE `campus_schedule` SET transfertolhr_date='".$systemdate."' , `comments_transfertolhr` =concat(comments_transfertolhr ,'\r\nOperator:{$operator_name} - Comments : {$_POST['comments_transfertolhr']}\r\n')  WHERE `id` = '$id' "; 
		mysql_query($sql) or die(mysql_error()); 
		}
	
	getMessages('transfertolhr_schedule','book_scheduler_manage.php');
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

<div id="label">Comments Submitted(READ ONLY):</div><div id="field"><textarea readonly name='comments_transfertolhr_readonly'><?php echo stripslashes($row['comments_transfertolhr']);?></textarea></div> 

<div id="label">Comments Transfer to lhr:</div><div id="field"><textarea name='comments_transfertolhr'></textarea></div>  
 
<div id="label"></div><div id="field"><input type='submit' value='Submit comments for this schedule' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 

<?
}
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}

include('include/footer.php');?> 