<? 
include('config.php');
include('include/header.php');  

/* if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==195 || $_SESSION['userId']==227 || $_SESSION['userId']==411 || $_SESSION['userId']==60 || $_SESSION['userId']==625 || $_SESSION['userId']==221)

{
 */


$id = (int) $_GET['id'];
$studentID = $_GET['studentID'];
$std_status = $_GET['std_status'];

$systemdatetime = systemDateTime();
$systemdate = systemDate();
//if (isset($_POST['submitted'])) {		//$_POST['submitted'] 	START
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$dead_schedule="Course:".getData( nl2br( $row['courseID']),'course').",Teacher:".showUser( nl2br( $row['teacherID'])).",Student:". showStudents(nl2br( $row['studentID']))
				.",BKDATE:".nl2br( $row['dateBooked']).",Class Days:".getData(nl2br( $row['classType']),'plan').",Status:".getData(nl2br( $row['std_status']),'stdStatusmo-list')
				.",Amount:".nl2br( $row['dues']);
user_log( $_SERVER['PHP_SELF'] , "DEAD_SCHEDULE" , $_SESSION['userId'] ,$dead_schedule, $_POST['comments_dead']);
/////////////////////////////////////////////////////// 

//$std_status_old_update_query=("UPDATE campus_schedule SET std_status_old='".$row['std_status']."' WHERE id=$id");
//mysql_query($std_status_old_update_query) or die(mysql_error());
if(nl2br( $row['dead_date'])=="")
{
//$row_deaddate = mysql_fetch_array ( mysql_query("UPDATE campus_schedule SET dead_date='".$systemdate."' , comments_dead='".$_POST['comments_dead']."'  WHERE `id` = '$id' ") or trigger_error(mysql_error()));
}
$row_confirm_deaddate = mysql_fetch_array ( mysql_query("UPDATE campus_schedule SET confirm_dead_date='".$systemdate."'  WHERE `id` = '$id' ") or trigger_error(mysql_error()));

changeSchedule($id,'3',$row['std_status']);
getMessages('dead','book_scheduler_manage.php');
//NEWLY ADDED , Making SKYPEID FREE while making DEAD
//Commenting for now
//skypeStatus($row['skypeid'],'3');
$query="select `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$studentID;
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
//////////////////////////////////// To SEND EMAIL on every REGULAR CONFIRM DEAD//////////////////////////////////
$sql_row_values=mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
$email_to_send_on_CONFIRM_DEAD = "<table border=1 id='table_liquid' cellspacing='2px' >
<tr bgcolor=#eceff5>
<th class='specalt' style='font-size:8px'><b>Id</b></th>
<th class='specalt' style='font-size:8px'><b>Status Old</b></th>
<th class='specalt' style='font-size:8px'><b>Status</b></th>
<th class='specalt' style='font-size:8px'><b>Comments/Reason</b></th> 
<th class='specalt' style='font-size:8px'><b>Email</b></th> 
<th class='specalt' style='font-size:8px'><b>Start time</b></th> 
<th class='specalt' style='font-size:8px'><b>Start Date</b></th> 
<th class='specalt' style='font-size:8px'><b>End Date</b></th> 
<th class='specalt' style='font-size:8px'><b>Student</b></th> 
<th class='specalt' style='font-size:8px'><b>Teacher</b></th>
<th class='specalt' style='font-size:8px'><b>Amount</b></th> 
<th class='specalt' style='font-size:8px'><b>Class Days</b></th> 
<th class='specalt' style='font-size:8px'><b>Reason</b></th>
<th class='specalt' style='font-size:8px'><b>Dead Date</b></th> 
<th class='specalt' style='font-size:8px'><b>PENDING/CONFIRM Dead Date</b></th></tr>";
$email_to_send_on_CONFIRM_DEAD.="<tr bgcolor=#eceff5>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['id']) ."</td>
	<td valign='top' style='font-size:8px'>". getData(nl2br( $sql_row_values['std_status_old']),'stdStatusmo-list') ."</td>
	<td valign='top' style='font-size:8px'>". getData(nl2br( $sql_row_values['std_status']),'stdStatusmo-list') ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( mysql_real_escape_string($sql_row_values['comments_dead'])) ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $rows['email']) ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['startTime']) ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['startDate']) ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['endDate']) ."</td>
	<td valign='top' style='font-size:8px'>". showStudents(nl2br( $sql_row_values['studentID'])) ."</td>
	<td valign='top' style='font-size:8px'>". showUser( nl2br( $sql_row_values['teacherID'])) ."</td>
	<td valign='top' style='font-size:8px'>$". nl2br( $sql_row_values['dues']) ."</td>
	<td valign='top' style='font-size:8px'>". getData(nl2br( $sql_row_values['classType']),'plan') ."</td>
	<td valign='top' style='font-size:8px'>". getData(nl2br( $sql_row_values['dead_reason']),'dead_reason') ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['dead_date']) ."</td>
	<td valign='top' style='font-size:8px'>". nl2br( $sql_row_values['pending_confirmed_dead_date']) ."</td></tr></table>";
?>
<input rows="10" cols="90" id='email_to_send_on_CONFIRM_DEAD' name='email_to_send_on_CONFIRM_DEAD' readonly="readonly" type='hidden' value="<?php echo $email_to_send_on_CONFIRM_DEAD; ?>"/>
<?
if($std_status==2){
echo '<script> email_to_send_on_CONFIRM_DEAD(); </script>';
}
/////////////////////////////////////////////////////
echo "<script>window.location.href = 'book_scheduler_dead_confirmation.php'</script>";
//}	//$_POST['submitted'] 	END
echo "<b>Student Name : </b> ".showStudents($studentID);
echo "<br>";
echo "<b>Status : </b> ".getData(nl2br($std_status),'stdStatusmo-list');
echo "<br>";
echo "<b>CCMS Date/Time</b> : ".$systemdatetime;
echo "<br>";

?>
<!--<form action='' method='POST'>

<div id="label">Reason/Comments For Student(Dead):</div><div id="field"><textarea name='comments_dead' required></textarea></div>  
 
<div id="label"></div><div id="field"><input type='submit' value='Dead' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
<div id="ajaxdiv_summary_confirm_dead"></div>
</form>-->





<?php 
/* } else {echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";} */
?>

<?include('include/footer.php');?> 