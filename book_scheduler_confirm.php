<? 
include('config.php');
include('include/header.php');  
$id = (int) $_GET['id']; 
if(isset($_POST['Reg_id']) && !empty($_POST['Reg_id'])){
mysql_query("update `campus_schedule` set confirmingagentID=".$_SESSION['userId']." , status = 1 WHERE `id` = '$id' ") ; 

	/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
	$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
	$confirm_schedule="Course:".getData( nl2br( $row['courseID']),'course').",Teacher:".showUser( nl2br( $row['teacherID'])).",Student:". showStudents(nl2br( $row['studentID']))
					.",BKDATE:".nl2br( $row['dateBooked']).",Class Days:".getData(nl2br( $row['classType']),'plan').",Status:".getData(nl2br( $row['std_status']),'stdStatusmo-list');
	user_log( $_SERVER['PHP_SELF'] , "CONFIRM_SCHEDULE" , $_SESSION['userId'] ,$confirm_schedule);

	///////////////////////////////////////////////////////

$result=mysql_query("Select studentID from `campus_schedule`  WHERE `id` = '$id' ") ; 
$_row=mysql_fetch_assoc($result);
mysql_query("update `campus_students` set reg_id=".$_POST['Reg_id']." WHERE `id` = '".$_row['studentID']."' ") ;
getMessages('edit','book_scheduler_manage.php');}
else{
$result=mysql_query("select reg_id from `campus_students` WHERE 1 order by reg_id DESC limit 0,1 ") ;
$_row=mysql_fetch_assoc($result); 
?>
<form action='' method='POST'> 
<div id="label">Enter Registeration ID:</div><div id="field"><?php echo getInput(($_row['reg_id']+1),'Reg_id');?> </div>
 
 
<div id="label"></div><div id="field"><input type='submit' value='Confirm Schedule' /><input type='hidden' value='1' name='submitted'/> </div> 
</form>

<? }
include('include/footer.php');?>