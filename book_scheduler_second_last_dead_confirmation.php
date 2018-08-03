<? 
include('config.php');
include('include/header.php');  

if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==195 || $_SESSION['userId']==227 || $_SESSION['userId']==411 || $_SESSION['userId']==60 || $_SESSION['userId']==550 || $_SESSION['userId']==856)
{
$id = (int) $_GET['id'];
$studentID = $_GET['studentID'];
$std_status = $_GET['std_status'];

$systemdatetime = systemDateTime();
$systemdate = systemDate();
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
if (isset($_POST['submitted'])) {		//$_POST['submitted'] 	START
if(nl2br( $row['dead_date'])=="")
{
$row_deaddate = mysql_fetch_array ( mysql_query("UPDATE campus_schedule SET dead_date='".$systemdate."' , comments_dead='".$_POST['comments_dead']."'  WHERE `id` = '$id' ") or trigger_error(mysql_error()));
}
$row_confirm_deaddate = mysql_fetch_array ( mysql_query("UPDATE campus_schedule SET  comments_dead='".$_POST['comments_dead']."' , status_dead_second_last = 1 , pending_confirmed_dead_date = NOW() WHERE `id` = '$id' ") or trigger_error(mysql_error()));
echo "<script>window.location.href = 'book_scheduler_dead_confirmation.php'</script>";
}	//$_POST['submitted'] 	END
echo "<b>Student Name : </b> ".showStudents($studentID);
echo "<br>";
echo "<b>Status : </b> ".getData(nl2br($std_status),'stdStatusmo-list');
echo "<br>";
echo "<b>CCMS Date/Time</b> : ".$systemdatetime;
echo "<br>";
?>
<form action='' method='POST'>
<div id="label">Reason/Comments For Student(Dead):</div><div id="field"><textarea name='comments_dead' required></textarea></div>  
<div id="label"></div><div id="field"><input type='submit' value='Dead' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
<div id="ajaxdiv_summary_confirm_dead"></div>
</form>

<?php } else {echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";}?>

<?include('include/footer.php');?> 