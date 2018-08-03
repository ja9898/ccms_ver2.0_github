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
		if(!empty($_POST['topics']) )
		{
			$sql = "UPDATE `campus_start_end_report` SET topics='".$_POST['topics']."' , feedback='".$_POST['feedback']."'   WHERE `id` = '$id' "; 
			mysql_query($sql) or die(mysql_error());
			getMessages('edit','daily_sch_ttl_month_start_end_report.php');
		}
		else
		{
			getMessages('error');
		}
	}

}
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_start_end_report` WHERE `id` = '$id' ")); 
?>

<form action='' method='POST' onsubmit="">

<div id="label">Topics to be covered:</div><div id="field"><textarea name='topics'><?php echo stripslashes($row['topics']);?></textarea></div>  

<div id="label">Feedback:</div><div id="field"><textarea name='feedback'><?php echo stripslashes($row['feedback']);?></textarea></div>  
 
<div id="label"></div><div id="field"><input type='submit' value='Submit' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 

<?
/* }
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
} */

include('include/footer.php');?> 