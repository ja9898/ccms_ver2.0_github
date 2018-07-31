<? 
include('config.php');
include('include/header.php'); 
//CODE FOR SUBTRACTING DATES and getting DAYS
/*$datetime1 = strtotime($MONTH_START_DATE);
$datetime2 = strtotime($MONTH_END_DATE);

echo $datetime1 =  strtotime(nl2br($MONTH_START_DATE));
echo $datetime2 =  strtotime(nl2br($MONTH_END_DATE));
echo $OUR_MONTH_START_END = $datetime2 - $datetime1;
echo floor($OUR_MONTH_START_END/(60*60*24));*/

/* if($_SESSION['emp_shift']==2 || $_SESSION['emp_shift']==1)
{ */

?>
<div id="label">Current Date:</div><div id="field"><label id='current_date' name='current_date'><?php echo date('Y-m-d') ?> </label></div>
<div id="label">CCMS Date:</div><div id="field"><label id='ccms_date' name='ccms_date'><?php echo $systemdate = systemDate(); ?> </label></div>


<?php
			
//MONTH START-END/////////////////////////////////////////////////////////////////////////////////////
//MONTH START DATE
$current_date = '01';
$current_month = date('m');
$current_year = date('Y');
echo $MONTH_START_DATE = $current_year."-".$current_month."-".$current_date;echo "<br>";
//////////////////
//MONTH END DATE
echo $MONTH_END_DATE  = date('Y-m-t');echo "<br>";echo "<br>";

if(isset($_POST['submitted']))
{
	if($_POST['timeLeave']!='' && $_POST['timeRejoin']!='')
	{
	$systemdate = systemDate();
	$serverdate = strtotime($systemdate);
	$shortLeaveApplied = strtotime(prepareDate($_POST['shortLeaveDate']));
	$three_days_range = $serverdate - $shortLeaveApplied;
	$three_days_range = floor($three_days_range/(60*60*24));
		if($three_days_range>=3)
		{
			getMessages('error_short_leave');
		}
		else
		{	
			$timeLeave = $_LIST['time'][$_POST['timeLeave']];
			$timeRejoin = $_LIST['time'][$_POST['timeRejoin']];
			$leaveDuration = $_LIST['leaveDuration'][$_POST['leaveDuration']];
			$sql_insert_short_leave = "INSERT INTO 
			campus_empshort_leave( empId , contact , reasonLeave , timeLeave , timeRejoin , leaveDuration , leaveApplied , 
			currentDateTime)  
			VALUES('".$_SESSION['userId']."' , '".$_POST['contact']."' , '".$_POST['reasonLeave']."' , 
			'".$timeLeave."' , '".$timeRejoin."' , '".$leaveDuration."' , '".prepareDate($_POST['shortLeaveDate'])."' , NOW() )";
			$result_short_leave = mysql_query($sql_insert_short_leave);
			getMessages('add');
			//echo "<script>alert('Click OK to Continue')</script>";
			//echo "<script>window.location.href = 'index.php'</script>";
		}
	}
	else
	{
		getMessages('error');
		echo "<script>alert('Processing Error-Click OK to continue')</script>";
		echo "<script>window.location.href = 'index.php'</script>";
	}
}

//if(isset($_POST['search-submit']))
//{

//BEST LINK FOR LEAVE APPLICATION using biztalk and sharepoint developer
/////****!!!!http://www.codeproject.com/Articles/684769/Implementing-a-Leave-Application-Workflow-System-u!!!!!******//////
//http://www.c-sharpcorner.com/UploadFile/abhijmk/moment-js/   - moment.js

if($_SESSION['userType']==5)
{
	//$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and status_dead=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues'); 
}


//FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8 && isset($_POST['search-teacher-id']))
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_emp_pro_teamlead();
}


else if($_SESSION['userType']==1 && isset($_POST['search-teacher-id'])){
	//$result = getResultResource('campus_schedule',$_POST,'status=1 and campus_schedule.std_status!="3" and status_dead=0',"",",campus_students.firstName as name,campus_students.std_status as std_status",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id ","order by startTime asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues,campus_schedule.id');
	
	$result = getResultResource_emp_pro_superadmin();
	
	}
else
{

}


//Query of BASIC INFORMATION
$sql_employee_info=("SELECT * FROM capmus_users WHERE id='".$_SESSION['userId']."' ");
$sql_employee_info_result=mysql_query($sql_employee_info) or die(mysql_error());
$sql_employee_info_result=mysql_fetch_array($sql_employee_info_result);
?>
<?
//Table of BASIC INFORMATION
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr bgcolor=#FF0000>";
echo "<th colspan=2 class='specalt'><b>Basic Information</b></th>";  
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Employee Name: </b></td>";
echo "<td valign='top'>" .nl2br( $sql_employee_info_result['firstName']). " " .nl2br( $sql_employee_info_result['lastName']). "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Department: </b></td>";
echo "<td valign='top'>" . getData(nl2br( $sql_employee_info_result['departmentId']),'department') . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Designation: </b></td>";
echo "<td valign='top'>" . getData(nl2br( $sql_employee_info_result['designationID']),'designation') . "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Contact Number: </b></td>";
echo "<td valign='top'>" .nl2br( $sql_employee_info_result['phone']). "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Address: </b></td>";
echo "<td valign='top'>" .nl2br( $sql_employee_info_result['address']). "</td>";
echo "</tr>";

echo "</table>"

?>
<!-- onsubmit="return timeLeave_timeRejoin(this);"   Commenting this for now as HOURS calculation with 30 mins NOT WORKING -->
<form action="" method="post" onsubmit="return timeLeave_timeRejoin_MUST();">

<table border="0">
<tr><td colspan='2'>Short Leave Date:<input type='text' name='shortLeaveDate' id="shortLeaveDate" class="flexy_datepicker_input" required/></td>
<tr><td colspan='2'>Contact No During Leave:<input type='text' name='contact' required/> </td></tr>
<tr><td colspan='2'>Reason For Leave:<input type='text' name='reasonLeave' required/> </td></tr>
<tr>
<td>Time of Leaving:<?php echo getList('','timeLeave','time','','',''); ?></td>
<td>Time of Rejoining:<?php echo getList('','timeRejoin','time','','',''); ?></td>
</tr>
<!--<tr><td>Leave Start Date:<input type='text' name='LeaveStartDate' id="LeaveStartDate" class="flexy_datepicker_input" required/></td>
<td>Leave End Date:<input type='text' name='LeaveEndDate' id="LeaveEndDate" class="" readonly required/></td></tr>-->
<tr><td colspan='2'>Leave Duration:<?php echo getList('','leaveDuration','leaveDuration','','',''); ?></td>
<!--<select id="leaveDuration" name="leaveDuration" onchange="">
				<option value="">Select Leave Duration:</option>
				<option value="1">01:00</option>
				<option value="2">01:30</option>
				<option value="3">02:00</option>
				<option value="4">02:30</option>
				<option value="5">03:00</option>
				<option value="6">03:30</option>
				<option value="7">04:00</option>
</select>-->
</td></tr>
</table>
<div id="label"></div><div id="field"><input type='submit' value='Submit' /><input type='hidden' value='1' name='submitted' /></div> 

</form>

<?
/* } */
/* else
{
	echo "<label style='color:red; font-weight:bold'>Contact CCMS Administrator</label>";
} */
//} 
include('include/footer.php');
?>