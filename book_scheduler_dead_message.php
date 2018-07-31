<? 
include('config.php');
include('include/header.php');  
$id = (int) $_GET['id'];

if (isset($_POST['submitted'])) {

	if(isset($_POST['dead_reason']) && $_POST['dead_reason']!=0)
	{
		/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
		$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
		$dead_schedule="Course:".getData( nl2br( $row['courseID']),'course').",Teacher:".showUser( nl2br( $row['teacherID'])).",Student:". showStudents(nl2br( $row['studentID']))
						.",BKDATE:".nl2br( $row['dateBooked']).",Class Days:".getData(nl2br( $row['classType']),'plan').",Status:".getData(nl2br( $row['std_status']),'stdStatusmo-list')
						.",Amount:".nl2br( $row['dues'])."Dead Reason:".getData(nl2br( $row['dead_reason']),'dead_reason');
		user_log( $_SERVER['PHP_SELF'] , "CONFIRM_DEAD_SCHEDULE" , $_SESSION['userId'] ,$dead_schedule, $_POST['comments_dead']);
		/////////////////////////////////////////////////////// 


		//FOLLOWING QUERY IS IN confirming_dead_schedule
		//$row_deaddate = mysql_fetch_array ( mysql_query("UPDATE campus_schedule SET dead_date=NOW() WHERE `id` = '$id' ") or trigger_error(mysql_error()));

		confirming_dead_schedule($id,'1',$_POST['comments_dead'],$_POST['record_link_dead']);
		getMessages('confirming_dead','book_scheduler_manage.php');
	}
	else
	{
		getMessages('error');
	}

}
?>
<form action='' method='POST' onsubmit="return checkLength(this);">

<div id="label">Reason/Comments For Student(Dead):</div><div id="field"><textarea name='comments_dead' id='comments_dead' required></textarea></div>  

<div id="label">Reasons:</div><div id="field"><?php echo getList('','dead_reason','dead_reason');?> </div> 

<div id="label">Recording Link:</div><div id="field"><input name='record_link_dead' id='record_link_dead' required/></div>

<div id="label"></div><div id="field"><input type='submit' value='Confirm Dead' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 


<?include('include/footer.php');?> 