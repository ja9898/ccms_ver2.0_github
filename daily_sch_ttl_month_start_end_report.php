<?
include('config.php');
include('include/header.php');
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<?php if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==15 ) { 
//getTeacherFilterLead_main(); 
getStudentFilter();
getTeacherFilter();
getTeacherFilterLead(); 
} ?>

&nbsp;&nbsp;<?php if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==15) { echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input'); }?>&nbsp;&nbsp;

&nbsp;&nbsp;
<? if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==15) { 
?> 
<input type="submit" class="button" name="submit" value="Filter">
<? } ?> 
</form>
<br /><br />
</div>
<?

//>>>>>>>>>>>>>>>>>>>>>>>>> To send the MONTH START REPORT as an EMAIL <<<<<<<<<<<<<<<<<<<<< 
if(isset($_POST['send_email_month_start_report']))
{
	if($_POST['row_id']!=0 && $_POST['email_id']!='' && $_POST['email_id']!='abc@ycc.com' && $_POST['email_id']!='abc@xyz.com' && $_POST['email_id']!='abc@paypal.com'){
	
	}
	else{
		echo "<script type='text/javascript'>alert('Email cannot be sent');</script>";
	}
}
//////////////////////////////////////////////////////////////////////////////////////////////////////////////
echo "<table  border=0 id='table_liquid' cellspacing=0>"; 
echo "<tr>";
echo "<th class='specalt' ><b>id</b></th>";
echo "<th class='specalt' ><b>Student</b></th>";
echo "<th class='specalt' ><b>Grade</b></th>";
echo "<th class='specalt' ><b>Topics</b></th>";
echo "<th class='specalt' ><b>Feedback</b></th>";
echo "<th class='specalt' ><b>Teacher</b></th>";
echo "<th class='specalt' ><b>Course</b></th>";
echo "<th class='specalt' ><b>Country</b></th>";
echo "<th class='specalt' ><b>TTL</b></th>";
echo "<th class='specalt' ><b>MTTL</b></th>";
echo "<th class='specalt' ><b>Date</b></th>";
echo "<th class='specalt' colspan=4><b>Actions</b></th>";
echo "</tr>"; 
if(isset($_POST['submit'])){
if($_SESSION['userType']==8)
{
	$sql="SELECT * FROM `campus_start_end_report` WHERE ttl='".$_SESSION['userId']."' ";
	if(isset($_POST['submit']) && $_POST['search-student-id']!=0)
	{
		$sql.=" and campus_start_end_report.studentID='".$_POST['search-student-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
	{
		$sql.=" and campus_start_end_report.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql.=" and campus_start_end_report.ttl='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.= " and campus_start_end_report.date>='".prepareDate($_POST['fromDate'])."' and campus_start_end_report.date<='".prepareDate($_POST['toDate'])."'";
	}
	$result = mysql_query($sql) or trigger_error(mysql_error());
}
else if($_SESSION['userType']==15)
{
	$sql="SELECT * FROM `campus_start_end_report` WHERE mttl='".$_SESSION['userId']."' ";
	if(isset($_POST['submit']) && $_POST['search-student-id']!=0)
	{
		$sql.=" and campus_start_end_report.studentID='".$_POST['search-student-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
	{
		$sql.=" and campus_start_end_report.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql.=" and campus_start_end_report.ttl='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.= " and campus_start_end_report.date>='".prepareDate($_POST['fromDate'])."' and campus_start_end_report.date<='".prepareDate($_POST['toDate'])."'";
	}
	$result = mysql_query($sql) or trigger_error(mysql_error());
}
else
{
	if($_SESSION['userType']==1){
		$sql="SELECT * FROM `campus_start_end_report` WHERE 1 ";
		if(isset($_POST['submit']) && $_POST['search-student-id']!=0)
		{
			$sql.=" and campus_start_end_report.studentID='".$_POST['search-student-id']."' ";
		}
		if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
		{
			$sql.=" and campus_start_end_report.teacherID='".$_POST['search-teacher-id']."' ";
		}
		if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
		{
			$sql.=" and campus_start_end_report.ttl='".$_POST['search-teacher-id2']."' ";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql.= " and campus_start_end_report.date>='".prepareDate($_POST['fromDate'])."' and campus_start_end_report.date<='".prepareDate($_POST['toDate'])."'";
		}
		//echo $sql;
		$result = mysql_query($sql) or trigger_error(mysql_error());
	}
}
}
while($row = mysql_fetch_array($result)){ 
//student country
$query="select `campus_students`.id as stu_id , `campus_students`.extId_old ,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline, `campus_students`.username , `campus_students`.password , `campus_students`.parentId ,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
////////////////
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top' id=row_id>" . $row['id'] . "</td>";
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";
echo "<td valign='top'>" . $row['grade'] . "</td>";
echo "<td valign='top'>" . $row['topics'] . "</td>";
echo "<td valign='top'>" . stripslashes($row['feedback']) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top'>" . getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . getData( nl2br( $rows['countryID']),'country') . "</td>";
echo "<td valign='top' style='color:red; font-weight:bold'>" . showUser(nl2br( $row['ttl'])) . "</td>"; 
echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row['mttl'])) . "</td>"; 
echo "<td valign='top'>" . $row['date'] . "</td>";
echo "<td valign='top'><a class=button href=daily_sch_ttl_month_start_end_edit.php?id={$row['id']}>Edit</a></td>";
echo "<td valign='top'><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=daily_sch_ttl_month_start_end_delete.php?id={$row['id']}>Delete</a></td>";

		$systemdate = systemDate();
		$systemdate = strtotime($systemdate);
		$date=date($row['date']);
		$date = strtotime($date);
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


	<?php if(($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==15)) { ?>
	<? echo "<td valign='top'>"?> 
	<input type='button' value='Send Email' name='send_email_month_test_report' onclick="javascript: email_to_send_test_REPORT('<?php echo $row['id']?>')"  />
	<? echo "</td>"?>
	<? echo "<td valign='top'>"?> 
	<input type='email' id='email_id<?php echo $row['id'] ?>' name='email_id' placeholder='Enter email' required/>
	<? echo "</td>"?>
	<? } ?>
	<input type='hidden' value=<?php echo $row['id']; ?> id='row_id' name='row_id' />
	<input type='hidden' value=<?php echo $row['teacherID']; ?> id='teacher_id' name='teacher_id' />
	<input type='hidden' value='1' name='submitted'/>
<?
//$sql_row_values=mysql_fetch_array ( mysql_query("SELECT * FROM `campus_start_end_report` WHERE `id` = '".$_POST['row_id']."' "));
	//Making EMAIL HTML		START
	
echo "<td valign='top' style='visibility:hidden'>" . 	$email_to_send_on_MONTH_START_REPORT = "<div align='center' style='color:Orange; font-size:20px; font-weight:bold'>Email From YOURCLOUDCAMPUS</div>
			<table border='1'  cellspacing=2px > 
			<tr align='center'>
			<td colspan='2' style='color:Orange; background-color:purple; font-size:16px;'><b>Your this month Course is outlined as following</b></td>
			</tr>
			
			<tr bgcolor=#CD96CD>
			<td><b>Grade: </b></td>
			<td valign='top'> ".$row['grade']."</td>
			</tr>
			
			<tr bgcolor=#EED2EE>
			<td><b>Student: </b></td>
			<td valign='top'> ".showStudents(nl2br( $row['studentID']))."</td>
			</tr>
			
			<tr bgcolor=#EED2EE>
			<td><b>Teacher: </b></td>
			<td valign='top'> ".showUser( nl2br( $row['teacherID']))."</td>
			</tr>
			
			<tr bgcolor=#CD96CD>
			<td><b>Course: </b></td>
			<td valign='top'> ".getData( nl2br( $row['courseID']),'course')."</td>
			</tr>
			
			<tr bgcolor=#EED2EE>
			<td><b>Topics: </b></td>
			<td valign='top'> ".stripslashes($row['topics'])."</td>
			</tr>	

			<tr bgcolor=#EED2EE>
		<td><b>Feedback: </b></td>
			<td valign='top'> ".stripslashes($row['feedback'])."</td>
			</tr>			
			</table>";
			
			$email_to_send_on_MONTH_START_REPORT.="<br><br>
			NOTE: Please do check your Junk Email if you dont receive under INBOX <br><br>
			URL: <a href='www.yourcloudcampus.com'>www.yourcloudcampus.com</a><br>
			E-mail: Info@yourcloudcampus.com<br>
			Skype: yourcloudcampus<br>
			AUS  : 280-911-200<br>
			U.S.A: 215-764-6162<br>
			U.K  : 121-288-3093<br>  </td>";
	
		$sql_get_ttl_mttl="SELECT * FROM capmus_users WHERE id='".$row['teacherID']."'";
		$row_get_ttl_mttl = mysql_fetch_array ( mysql_query($sql_get_ttl_mttl));
		
		//TTL and MTTL email		START
		$sql_get_ttl_email="SELECT * FROM capmus_users WHERE id='".$row_get_ttl_mttl['LeadId']."'";
		$row_get_ttl_email = mysql_fetch_array ( mysql_query($sql_get_ttl_email));		
		$sql_get_mttl_email="SELECT * FROM capmus_users WHERE id='".$row_get_ttl_mttl['main_LeadId']."'";
		$row_get_mttl_email = mysql_fetch_array ( mysql_query($sql_get_mttl_email));
		//TTL and MTTL email		END

	//Making EMAIL HTML		END	
	?>
	<input rows="10" cols="90" id='email_to_send_on_MONTH_START_REPORT<?php echo $row['id'] ?>' name='email_to_send_on_MONTH_START_REPORT' readonly="readonly" type='hidden' value="<?php echo $email_to_send_on_MONTH_START_REPORT; ?>"/>
	<input id='student_email<?php echo $row['id'] ?>' name='student_email' readonly="readonly" type='hidden' value="<?php echo $_POST['email_id']; ?>"/>	
	<input id='ttl_email<?php echo $row['id'] ?>' name='ttl_email' readonly="readonly" type='hidden' value="<?php echo $row_get_ttl_email['email']; ?>"/>
	<input id='mttl_email<?php echo $row['id'] ?>' name='mttl_email' readonly="readonly" type='hidden' value="<?php echo $row_get_mttl_email['email']; ?>"/>

	<?
	//echo '<script> email_to_send_on_MONTH_START_REPORT(); </script>';?>		
	
</form>


<?
echo "</tr>"; 
} 
echo "</table>";
include('include/footer.php');
?>