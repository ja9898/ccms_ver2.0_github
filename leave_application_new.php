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

<div id="label">Current Date:</div><div id="field"><label name='LeaveApplied'><?php echo date('Y-m-d') ?> </label></div>
<div id="label">CCMS Date:</div><div id="field"><label name='LeaveApplied'><?php echo $systemdate = systemDate(); ?> </label></div>


<?php
$serverdate = strtotime($systemdate);echo "<br>";
$startdate = strtotime('2014-09-21');echo "<br>";
$seven_days_range = $serverdate - $startdate;echo "<br>";
$seven_days_range = floor($seven_days_range/(60*60*24));echo "<br>";
			
//FOR CASUAL
//MONTH START-END/////////////////////////////////////////////////////////////////////////////////////
//MONTH START DATE
$current_date = '01';
$current_month = date('m');
$current_year = date('Y');
echo $MONTH_START_DATE = $current_year."-".$current_month."-".$current_date;echo "<br>";
//////////////////
//MONTH END DATE
echo $MONTH_END_DATE  = date('Y-m-t');echo "<br>";echo "<br>";

if($systemdate>=$MONTH_START_DATE && $systemdate<=$MONTH_END_DATE)
{
//echo "1st";
$current_month = date('m');
$next_month = date('m')+1;
}

//////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////


//FOR SICK
//START/////////////////////////////////////////////////////////////////////////////////////
//JANUARY
$jan_date = '01';
$jan_month = '01';
$current_year = date('Y');
echo $JANUARY = $current_year."-".$jan_month."-".$jan_date;echo "<br>";
//////////////////

//DECEMBER
$dec_date = '31';
$dec_month = '12';
$current_year = date('Y');
echo $DECEMBER = $current_year."-".$dec_month."-".$dec_date;echo "<br>";
//////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////


if(isset($_POST['submitted']))
{
	$_POST['sick_leave'];
	if(($_POST['sick_leave']!='' || $_POST['casual_leave']!='' || $_POST['other_leave']!='') && $_POST['LeaveStartDate']!='' && $_POST['LeaveEndDate']!='')
	{
		$systemdate = systemDate();
		
		//Sick leave overall sum
		$result_sick_overall_sum = leave_CheckSick($JANUARY,$DECEMBER);
		$rowcount_sick_overall_sum = mysql_num_rows($result_sick_overall_sum);
		while($row_sick_overall_sum=mysql_fetch_array($result_sick_overall_sum ))
		{
			$sick_total_count = $row_sick_overall_sum['NoOfDaysTotal']; 

		}
		$SL_total_sum=$sick_total_count+$_POST['NoOfDays'];
		////////////////////////
		
		
		if($_POST['NoOfDays']>1 && $_POST['casual_leave']==1)
		{
			getMessages('error');
			echo "<script>alert('Casual Leave - Days Selection NOT APPLICABLE')</script>";
			echo "<script>window.location.href = 'index.php'</script>";
		}
		else
		{
			if($systemdate<prepareDate($_POST['LeaveStartDate']))
			{
				if($_POST['sick_leave']==1)
				{$leave_type=1;if($SL_total_sum>6){				getMessages('error');
				echo "<script>alert('Total sick leave sum overlimit')</script>";
				echo "<script>window.location.href = 'index.php'</script>";
				exit();}}
				if($_POST['casual_leave']==1)
				{$leave_type=2;}
				if($_POST['other_leave']==1)
				{$leave_type=3;}
				$sql_insert_leave = "INSERT INTO campus_empleave( EmpID , LeaveType , LeaveReason , LeaveStartDate , LeaveEndDate , NoOfDays , LeaveApplied , current_datetime)  VALUES('".$_SESSION['userId']."' , '".$leave_type."' , '{$_POST['LeaveReason']}' , '".prepareDate($_POST['LeaveStartDate'])."' , '".prepareDate($_POST['LeaveEndDate'])."' , '{$_POST['NoOfDays']}' , '".prepareDate($systemdate)."' , NOW() )";
				$result_leave = mysql_query($sql_insert_leave);
				getMessages('add');
				echo "<script>alert('Click OK to Continue')</script>";
				echo "<script>window.location.href = 'index.php'</script>";
			}


echo $serverdate = strtotime($systemdate);
echo $startdate = strtotime(prepareDate($_POST['LeaveStartDate']));
echo $seven_days_range = $serverdate - $startdate;
echo $seven_days_range = floor($seven_days_range/(60*60*24));

			if($systemdate>=prepareDate($_POST['LeaveStartDate']) && $seven_days_range>=7)
			{
				getMessages('error');
				echo "<script>alert('Auto Refershing Webpage-Cannot apply 7 days before')</script>";
				echo "<script>window.location.href = 'leave_application_new.php'</script>";
			}
			if($systemdate>=prepareDate($_POST['LeaveStartDate']) && $seven_days_range<7)
			{
				if($_POST['casual_leave']==1)
				{	
					$result_CL_dual=mysql_query("SELECT * FROM campus_empleave WHERE EmpID='".$_SESSION['userId']."'
					AND LeaveType=2");
					while($row_CL_dual=mysql_fetch_array($result_CL_dual))
					{
						echo "<td class='specalt'><b>".$cl_db_date = $row_CL_dual['LeaveStartDate']."</b></td>";
						echo "<br>";
					}
					$rowcount_CL_dual = mysql_num_rows($result_CL_dual);
					$leave_type=2;
					$seven_days_range_AND_2_days_range = $seven_days_range;
					$ddd = $cl_db_date;
						if($seven_days_range_AND_2_days_range<7)
						{
							$msd_date = date('d', strtotime( nl2br($MONTH_START_DATE)));
							$msd_month = date('m', strtotime( nl2br($MONTH_START_DATE)));
							$msd_year = date('Y', strtotime( nl2br($MONTH_START_DATE)));
							$d = date_parse_from_format("Y-m-d", $ddd);
							$lsd_date = $d["day"];
							$lsd_month = $d["month"];
							$lsd_year = $d["year"];
							
//REMOVE LATER							
//echo $msd = strtotime($MONTH_START_DATE);echo "<br>--times2";
//echo $lsd = strtotime(prepareDate($cl_db_date));echo "<br>--times2";
//echo $seven_days_range_times_2 = $msd - $lsd;echo "<br>--times2";
//echo $seven_days_range_times_2 = floor($seven_days_range_times_2/(60*60*24));echo "<br>--times2";
							
							
							$startdate_date = date('d',strtotime(prepareDate($_POST['LeaveStartDate'])));
							$startdate_month = date('m',strtotime(prepareDate($_POST['LeaveStartDate'])));
							
							
							if($lsd_date<$msd_date && $msd_month==$lsd_month && $msd_year==$lsd_year && $rowcount_CL_dual>=1 && $startdate_date<=date('t') && $startdate_month==$lsd_month/*to check start month equals to LeaveStartDate month*/)
							{
							echo "<script>alert('Cannot Apply for casual leave')</script>";
							exit();
							echo $lsd_date_db = date('d', strtotime($ddd));echo "<br>";
							echo $lsd_month_db = date('m', strtotime($ddd));echo "<br>";
							echo $lsd_year_db = date('Y', strtotime($ddd));echo "<br>";
							}
							else
							{
								//echo "<script>alert('No casual in pre month')</script>";
								$sql_insert_leave = "INSERT INTO campus_empleave( EmpID , LeaveType , LeaveReason , LeaveStartDate , LeaveEndDate , NoOfDays , LeaveApplied , current_datetime)  VALUES('".$_SESSION['userId']."' , '".$leave_type."' , '{$_POST['LeaveReason']}' , '".prepareDate($_POST['LeaveStartDate'])."' , '".prepareDate($_POST['LeaveEndDate'])."' , '{$_POST['NoOfDays']}' , '".prepareDate($systemdate)."' , NOW() )";
					//echo "<script>alert('Successful for lst day casual of last month')</script>";
					$result_leave = mysql_query($sql_insert_leave);
					getMessages('add');
					echo "<script>alert('Applied for Casual Leave')</script>";
					echo "<script>window.location.href = 'index.php'</script>";
							}
							
							
						}
				}
				if($_POST['sick_leave']==1 || $_POST['other_leave']==1)
				{
					if($_POST['sick_leave']==1)
					{$leave_type=1;if($SL_total_sum>6){				getMessages('error');
				echo "<script>alert('Total sick leave sum overlimit')</script>";
				echo "<script>window.location.href = 'index.php'</script>";
				exit();}}
					if($_POST['other_leave']==1)
					{$leave_type=3;}
				
					$sql_insert_leave = "INSERT INTO campus_empleave( EmpID , LeaveType , LeaveReason , LeaveStartDate , LeaveEndDate , NoOfDays , LeaveApplied , current_datetime)  VALUES('".$_SESSION['userId']."' , '".$leave_type."' , '{$_POST['LeaveReason']}' , '".prepareDate($_POST['LeaveStartDate'])."' , '".prepareDate($_POST['LeaveEndDate'])."' , '{$_POST['NoOfDays']}' , '".prepareDate($systemdate)."' , NOW() )";
					$result_leave = mysql_query($sql_insert_leave);
					getMessages('add');
					echo "<script>alert('Range Within 7 days')</script>";
					echo "<script>window.location.href = 'index.php'</script>";
				}
			}
			
			
			
			//if(prepareDate($_POST['LeaveStartDate'])<=$MONTH_START_DATE || prepareDate($_POST['LeaveEndDate'])>=$MONTH_END_DATE)
			//{
			//	echo "shit2";
			//	getMessages('error');
			//	echo "<script>alert('Auto Refershing Webpage')</script>";
			//	echo "<script>window.location.href = 'leave_application_new.php'</script>";
			//}
		/*
			if(prepareDate($_POST['LeaveStartDate'])>=$MONTH_START_DATE && prepareDate($_POST['LeaveEndDate'])<=$MONTH_END_DATE)
			{
				if($_POST['sick_leave']==1)
				{$leave_type=1;}
				if($_POST['casual_leave']==1)
				{$leave_type=2;}
				if($_POST['other_leave']==1)
				{$leave_type=3;}
				$sql_insert_leave = "INSERT INTO campus_empleave( EmpID , LeaveType , LeaveReason , LeaveStartDate , LeaveEndDate , NoOfDays , LeaveApplied)  VALUES('".$_SESSION['userId']."' , '".$leave_type."' , '{$_POST['LeaveReason']}' , '".prepareDate($_POST['LeaveStartDate'])."' , '".prepareDate($_POST['LeaveEndDate'])."' , '{$_POST['NoOfDays']}' , '".prepareDate($systemdate)."' )";
				$result_leave = mysql_query($sql_insert_leave);
				getMessages('add');
			}
			if(prepareDate($_POST['LeaveStartDate'])<=$MONTH_START_DATE || prepareDate($_POST['LeaveEndDate'])>=$MONTH_END_DATE)
			{
				echo "shit2";
				getMessages('error');
				echo "<script>alert('Auto Refeshing Webpage')</script>";
				echo "<script>window.location.href = 'leave_application_new.php'</script>";
			}
		*/
		}
	}
	else
	{
		getMessages('error');
		echo "<script>alert('Processing Error-Click OK to continue')</script>";
		echo "<script>window.location.href = 'index.php'</script>";
	}
}

?>

<?
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

<form action="" method="post">
<?
echo $_POST['NoOfDays'];

//Casual Leave function CALL and row count
$result_casual = leave_CheckCasual($MONTH_START_DATE,$MONTH_END_DATE);
$rowcount_casual = mysql_num_rows($result_casual);

//Sick Leave function CALL and row count
$result_sick = leave_CheckSick($JANUARY,$DECEMBER);
$rowcount_sick = mysql_num_rows($result_sick);

while($row_sick=mysql_fetch_array($result_sick))
{
	$sick_total_count = $row_sick['NoOfDaysTotal']; 

}

echo "<label style='font-weight:bold'>Remaining Sick Leaves:".(6-$sick_total_count)."</label>";
//Table of SICK CASUAL and OTHER leave checkboxes
echo "<table  border=0 id='' cellspacing=0 >"; 
//echo "<tr><td colspan=3 class='specalt'><b></b></td>".."</tr>";
echo "<tr>"; 
//SICK LEAVE - ChkBox, Show/Hide
if($sick_total_count>=6)
{
	//echo "<td class='specalt' style='color:red'><b>Sick Leaves Acquired</b></td>";
	echo "<td class='specalt'><b>"?><input type='checkbox' id='sick_leave' name='sick_leave' disabled='disabled'/><?"</b></td>";
}
if($sick_total_count<=5)
{
	echo "<td class='specalt'><b>".getCheckbox_leave($_POST['sick_leave'],'sick_leave')."</b></td>";
}
///////////////////////////////////
//CASUAL LEAVE - ChkBox, Show/Hide
if($rowcount_casual>=1)
{
	//echo "<td class='specalt' syle='color:red'><b>Casual Leave Acquired</b></td>";
	echo "<td class='specalt'><b>"?><input type='checkbox' id='casual_leave' name='casual_leave' disabled='disabled'/><?"</b></td>";
}
if($rowcount_casual==0)
{
	echo "<td class='specalt'><b>".getCheckbox_leave($_POST['casual_leave'],'casual_leave')."</b></td>"; 
}
///////////////////////////////////
echo "<td class='specalt'><b>".getCheckbox_leave($_POST['other_leave'],'other_leave')."</b></td>"; 

//echo "<td class='specalt'><b>"?><!--<input type='checkbox'  name='sick_leave' id='sick_leave' /><?"</b></td>"; 
//echo "<td class='specalt'><b>"?><input type='checkbox'  name='casual_leave' id='casual_leave'/><?"</b></td>"; 
//echo "<td class='specalt'><b>"?><input type='checkbox'  name='other_leave' id='other_leave'/>--><?"</b></td>"; 


echo "</tr>";
echo "<tr>"; 
echo "<th class='specalt'><b>Sick</b></th>"; 
echo "<th class='specalt'><b>Casual</b></th>"; 
echo "<th class='specalt'><b>Other</b></th>"; 
echo "</tr>"; 
echo "</table>";
?>
<table border="0">
<tr><td colspan='2'>Reason For Leave:<input type='text' name='LeaveReason' required/> </td></tr>
<tr><td>Leave Start Date:<input type='text' name='LeaveStartDate' id="LeaveStartDate" class="flexy_datepicker_input" required/></td>
<td>Leave End Date:<input type='text' name='LeaveEndDate' id="LeaveEndDate" class="" readonly required/></td></tr>
<tr><td colspan='2'>
<select id="NoOfDays" name="NoOfDays" onchange="getDate_days(this.value)">
				<option value="">Select No of Days:</option>
				<option value="1">1</option>
				<option value="2">2</option>
				<option value="3">3</option>
				<option value="4">4</option>
				<option value="5">5</option>
				<option value="6">6</option>
	</select>
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