<? 
include('webcrawl.php');
include('include/header.php');
?>
<form action='<?php echo $_SERVER['PHP_SELF']?>' method='post'>
<?php 
if($_SESSION['userType']!=3 && $_SESSION['userType']!=4) { ?>



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

<? 
echo "<label align='center' style='color:Orange; font-weight:bold; font-size:20px'><u><i>Welcome,".$_SESSION['userName']."</i></u></label>";
echo "<br>";
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Course</b></th>"; 
//echo "<th class='specalt'><b>Skype ID</b></th>";
//echo "<th class='specalt'><b>Status</b></th>";  
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>"; 
echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
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
if($_SESSION['userType']==4) {

	
//$result = mysql_query("SELECT `campus_schedule`.*  FROM `campus_schedule` where status=1 and `campus_schedule`.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and teacherID='".$_SESSION['userId']."' and classType in (".getPlan($_POST['days'][0]).") order by `campus_schedule`.startTime asc") or trigger_error(mysql_error());
$sql = "SELECT `campus_schedule`.*  FROM `campus_schedule` where status=1 and `campus_schedule`.std_status!=3 and campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and campus_schedule.std_status!=7 and studentID='".$_SESSION['userId']."' and campus_schedule.status_dead=0 ";
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
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

$query="select `campus_students`.extId , `campus_students`.id from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);

$sql_meetinglink="SELECT * FROM campus_meeting_link WHERE teacherID='".$row['teacherID']."' ";
$result_meetinglink=mysql_query($sql_meetinglink);
$row_meetinglink=mysql_fetch_array($result_meetinglink);


	/* if($row['startDate']>$systemdate)
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
	{ */
		echo "<tr>";
		echo "<td valign='top'>" . getData(nl2br( $row['courseID']),'course') . "</td>";  
		//echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>";       
		//Following student ID is sent to class_details_teacher_sub_version.php NOT TO CLASS_DETAILS.PHP for security reasons
		echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>"; 
		//////////////////////////
		echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
		//FOR COMMENTS-Removing rn

		echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";  
		echo "<td valign='top'>";

		
		if($row_meetinglink['linkID']!=""){
				echo "<a class=button style='background-color:ORANGE' href='".$row_meetinglink['linkID']."'  target='_blank' >Start Session</a>";

		}
		echo "</td> "; 
		
		echo "<td valign='top'>"?> 
		<form action='' method='POST' enctype="multipart/form-data"> 
		<!--file upload-->
		FileSize: 2 MB<input id="file_name" name="file_name" type="file"/>
		<!--/////////////////////////////-->
		<input type='submit' value='Upload File' name='sender' class="button" />
		<input type='hidden' value='1' name='submitted'/>
		<!-- For updating DUE DATE and PAYDATE for SIGNUPS only, so passing schedule_id and campus rawalpindi -->
		<input type='hidden' id='teacher_id' name='teacher_id' value=<?php echo $row['teacherID']; ?> />
		<input type='hidden' id='schedule_id' name='schedule_id' value=<?php echo $row['id']; ?> />
		</form>
		<? "</td>";
		
		echo "</tr>"; 
	/* } */
} 
echo "</table>";
if($_SESSION['parentId']==39){
//IMPORTANT													 NEWLY ADDED 26-12-16
//>>>>>>Adding for the parnet if different students have same parents <<<<<<<<<<<
echo "<br>";
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Course</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>"; 
echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
echo "</tr>";

$sql_diff_stu_parent="SELECT campus_schedule.id,campus_schedule.std_status as statussch,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.edit_sch_TL_confirm,day(campus_schedule.paydate) AS paydayz,
	campus_schedule.dues_original,campus_schedule.currency_array,
	campus_students.id as studentIDPARENT,campus_students.firstName,
	campus_students.lastName,campus_students.parentId    	
	FROM campus_schedule INNER JOIN campus_students 
	ON campus_schedule.status=1 and campus_schedule.status_dead=0 and 
	campus_schedule.status_freeze=0 and campus_schedule.std_status!=4 and 
	campus_schedule.std_status!=3 and campus_schedule.std_status!=1 and 
	campus_schedule.edit_sch_TL_confirm=0 and 
	campus_schedule.std_status!=7 and campus_schedule.status_transfertolhr=0 and 
	campus_students.parentId='".$_SESSION['parentId']."' and 
	campus_students.id=campus_schedule.studentID";
	$result_diff_stu_parent=mysql_query($sql_diff_stu_parent);
while($row_diff_stu_parent = mysql_fetch_array($result_diff_stu_parent)){ 
foreach($row_diff_stu_parent AS $key => $value) { $row_diff_stu_parent[$key] = stripslashes($value); }
$sql_meetinglink="SELECT * FROM campus_meeting_link WHERE teacherID='".$row_diff_stu_parent['teacherID']."' ";
$result_meetinglink=mysql_query($sql_meetinglink);
$row_meetinglink=mysql_fetch_array($result_meetinglink); 

		echo "<tr>";
		echo "<td valign='top'>" . getData(nl2br( $row_diff_stu_parent['courseID']),'course') . "</td>";  
		echo "<td valign='top'>" . showStudents(nl2br( $row_diff_stu_parent['studentID'])) . "</td>"; 
		echo "<td valign='top'>" . showUser( nl2br( $row_diff_stu_parent['teacherID'])) . "</td>";
		//FOR COMMENTS-Removing rn
		echo "<td valign='top'>" . getData(nl2br( $row_diff_stu_parent['classType']),'plan') . "</td>";  
		echo "<td valign='top'>";
		if($row_meetinglink['linkID']!=""){
				echo "<a class=button style='background-color:ORANGE' href='".$row_meetinglink['linkID']."'  target='_blank' >Start Session</a>";

		}
		echo "</td> "; 
		echo "</tr>"; 
}
echo "</table>";
}?>
<!-- FILE UPLOAD CODE-->
<!-- -->
<?php if(isset($_POST['sender']) ){
//print_r($_REQUEST);
$teacher_id = $_POST['teacher_id'];
$schedule_id = $_POST['schedule_id'];
	//FOLLOWING CODE is the FILE UPLOADER code//
	$allowedext2=array("");
	$allowedext=array("doc","docx","jpg","jpeg","pdf");
	$extension=end(explode(".",$_FILES["file_name"]["name"]));
	if(($_FILES["file_name"]["size"]<=2000000) && (in_array($extension, $allowedext)) && ($_FILES["file_name"]["size"]!=0))
	{
		if($_FILES["file_name"]["error"]>0)
		{
			echo $file_error="Return Code:". $_FILES["file_name"]["error"] ."<br />";
			echo "<script>alert('file_error')</script>";
		}
		else
		{
			$dir = "student_teacher_file_upload";
				/* if(is_dir($dir) == false)
				{
					mkdir($dir);
					echo "<script>alert('Directory made')</script>";
				} */		
				
			move_uploaded_file($_FILES["file_name"]["tmp_name"], $dir."/".$_FILES["file_name"]["name"]);			
			//Making proper string with folder name to the file path
			$filepath=$dir."/".$_FILES["file_name"]["name"];
			$sql = "INSERT INTO 
			`campus_fileupload` ( `id` ,`fromID` ,  `toID` , `src` , `dest` , 
			`description` , `sent` , `recd` , `filepath`) 
			VALUES( '' , '".$_SESSION['userId']."' ,  '".$teacher_id."' , 'Student' , 'Teacher' , 
			'".$description."' , NOW() , '0' , '".$filepath."' ) "; 
			mysql_query($sql) or die(mysql_error());
			getMessages('file_uploaded');
		}		
	} //old if of image upload
	/////////////////////////////////////////////
	else 
	{
		if($_FILES["file_name"]["name"]=="" || $_FILES["file_name"]["size"]>2000000 || 
		!in_array($extension, $allowedext))
		{
			echo "<script>alert('Invalid File Selection OR File is bigger than 2 MB, Data cannot be inserted')</script>";
			getMessages('error');
		}
	}
}
include('include/footer.php');
?>