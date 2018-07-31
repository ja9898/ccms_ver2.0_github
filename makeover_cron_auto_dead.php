<?php
///////////////////////////////////////////////////**********************************************Making separate session_start and session variables
//session_start();
//include('include/function-inc.php'); 
$database="test";
$username="root";
$password="";
/*$r = mysql_connect('localhost',$username,$password);
if (!$r) {
    echo "Could not connect to server\n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Connection established\n"; 
}*/

$link = mysql_connect('localhost', 'ccms', 'vicidialnow');
if (!$link) {
    die('Not connected : ' . mysql_error());
}
else {
    echo "Connection established\n"; 
}
if (! mysql_select_db('ccmsnew') ) {
    die ('Can\'t use cloud_new1 : ' . mysql_error());
}

$_LIST['course']=array('Select Course','MS Office','Graphics Designinig','Web Designing','Web Development-PHP','AutoCad','Bundle','Design and Development','Basic Networking','English','CCNA','Quran Pak','Web Development-.Net','Physics','Chemistry','Biology','Math-Minor','Urdu','French','C++','ACCA','Accounts','Economics','Science','Calculus','Statistics','Math-Major');

//ALL FUNCTIONS ARE FOLLOWING//////////////////////////////////////////////////////
function getResultResource_superadmin_makeover_cron_auto_dead()
{
global $_LIST,$_return;

$sql="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.status,campus_schedule.status_dead,
	campus_schedule.startTime,campus_schedule.startDate 
	FROM campus_schedule 
	WHERE campus_schedule.status=1 and campus_schedule.status_dead=0 and campus_schedule.std_status=5";
	//$sql.=" ORDER BY campus_schedule.startTime";
	echo $sql; 
  
	$_return=mysql_query($sql) or trigger_error(mysql_error());
	return $_return;

}


function makeover_auto_dead_request_function($id)
{
	$row_sel = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
	echo $dead_schedule="Course:".getData( nl2br( $row_sel['courseID']),'course').",Teacher:".showUser( nl2br( $row_sel['teacherID'])).",Student:". showStudents(nl2br( $row_sel['studentID']));
	//			.",BKDATE:".nl2br( $row['dateBooked']).",START_DATE:".prepareDate($row['startDate']).",END_DATE:".prepareDate($row['endDate'])
	//			.",Class Days:".getData(nl2br( $row['classType']),'plan').",Status:".getData(nl2br( $row['std_status']),'stdStatusmo-list');
				echo "\n";
				echo "GETTING Student,Teacher and Course NAME-AND making AUTO DEAD";
	sleep(1);
	sleep(1);
	sleep(1);
	sleep(1);
	user_log_makeover_auto_dead( "makeover_cron_auto_dead.php" ,"MAKEOVER_AUTO_DEAD", "N/A" ,$dead_schedule, "Make Over Auto Dead Request");
/////////////////////////////////////////////////////// 

	confirming_dead_schedule($id,'1',"Make Over Auto Dead Request");
}


function confirming_dead_schedule($_id='',$status='',$commentsdead){
  
   //$sql="delete from campus_schedule where `studentID`=$_id";
   $sql="update campus_schedule set status_dead=$status,comments_dead='$commentsdead',status_dead_second_last=1,std_status_old=5,std_status=3,dead_date=NOW() where `id`=$_id";
  
  mysql_query($sql) or die(mysql_error());
  
  //return true;
  
  }


function user_log_makeover_auto_dead($page, $action, $preval, $newval, $comments_dead)
{

	
	if($action=="MAKEOVER_AUTO_DEAD")
	{
		$user_id=10001;$user_type=10001;
		$sql_insert_user_log=("INSERT INTO campus_user_log VALUES('','$user_id','$user_type','".date('H:i:s')."','$page','$action','$preval','$newval','$comments_dead')");
		$result_user_log=mysql_query($sql_insert_user_log) or die(mysql_error());
		echo "\n";
		echo "VALUES INSERTED IN LOG";
	sleep(1);
	sleep(1);
	sleep(1);
	sleep(1);
		//echo "<script>alert('Data Entered in user_log, Becareful with manual editing')</script>";
		//echo "Successful";
	}
	
	else 
	{
		//echo "<script>alert('BUGGY')</script>";
		//echo "unsuccessful";
	}
}


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
function systemDate(){
	  
  $todayDate = date("Y-m-d g:i a");// current date
  $currentTime = time($todayDate); //Change date into time
  $timeAfterOneHour = $currentTime-9*60*60;

  //return date("Y-m-d H:i:s",$timeAfterOneHour);
  return date("Y-m-d",$timeAfterOneHour);
  
  }
function showUser($_id){
  if(!empty($_id)){
  $sql="Select * from capmus_users where id=$_id";
  
  $result=mysql_query($sql);
  $rows=mysql_fetch_array($result);
  $return=$rows['firstName'].'  '.$rows['lastName'];
  
  return $return;
  }
  else
  {
  return "";}
  
  
  }
  
  function showStudents($_id,$_field=''){
  if($_field==''){
  $sql="Select * from campus_students where id=$_id";
  }
  else{
  $sql="Select * from campus_students where $_field=$_id";
  }
  
  $result=mysql_query($sql);
  $rows=mysql_fetch_array($result);
  if($_field==''){
  $return=$rows['firstName'].'  '.$rows['lastName'];}
  else{
  $return=$rows[$_field];
  }
  
  return $return;
  
  }
  function getData($_id,$_index){
  
  global $_LIST;
  return $_LIST[$_index][$_id];
  
  }
  
  












$result = getResultResource_superadmin_makeover_cron_auto_dead();		//Function to select the startDate of  MAKEOVER students


while ($row = mysql_fetch_array($result)) 
{
    echo $row['id'];
	echo $row['startDate'];
	sleep(1);
	sleep(1);
	$makeover_deaddate = date('Y-m-d', strtotime(nl2br( $row['startDate']). ' + 4 days'));
	$systemdate = systemDate();
	//echo date('Y-m-d', strtotime($systemdate. ' + 4 days'));
	sleep(1);
	sleep(1);
	if($makeover_deaddate==$systemdate)									//checking whether startDate +4 days equals TODAYS DATE(system Date))
	{
		echo "\n";
		echo "MAKE OVER DEAD DATE EQUALS CURRENT SYSTEM DATE";
		sleep(1);
		sleep(1);
		sleep(1);
		sleep(1);
			makeover_auto_dead_request_function($row['id']);				//If TRUE, send the MAKEOVER schedule to the DEAD CONFIRMATION LIST
	}
}


?>