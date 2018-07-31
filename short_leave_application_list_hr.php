<? 
include('config.php');
include('include/header.php'); ?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>

&nbsp;&nbsp;
<?php //echo getInput(stripslashes($_POST['fromDate-day']),'fromDate-day','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php// echo getInput(stripslashes($_POST['toDate-day']),'toDate-day','class=flexy_datepicker_input');?>
<?php
getTeacherFilterLead();
//getSuperAdminFilter();
getTeacherFilter();
?>
<br><br>
<?php
//getTeacherFilterLead_main();
getFilterSubmit();
?>
<br><br>
<?php if($_SESSION['userType']==1 || $_SESSION['userType']==11)
	{
	 ?>
<br><br><!--<input type="button" value="SUPER BUTTON-UPDATE" id="buttonClass_recommend_hr" style="background-color:red">-->
<div id="result_div">
</div>
<?php } ?>


<div id="submit" style="position:relative">
<input type='submit' value='Filter TL Pending Recommendations' name='pending_TL' class="button" />
<input type='submit' value='Filter HR Pending Recommendations' name='pending_HR' class="button" />
</div>  
</div>
</form>
<?


echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>ID</b></th>";
echo "<th class='specalt'><b>EMP ID</b></th>";
echo "<th class='specalt'><b>Leave Reason</b></th>";
echo "<th class='specalt'><b>Time Leave</b></th>";
echo "<th class='specalt'><b>Time Rejoin</b></th>";
echo "<th class='specalt'><b>Leave Duration</b></th>";
echo "<th class='specalt'><b>Leave Applied</b></th>"; 
echo "<th class='specalt'><b>TL Recommend/Not Recommend</b></th>"; 
echo "<th class='specalt'><b>HR Received/Not Received</b></th>"; 
echo "<th class='specalt' colspan='5'><b>Actions</b></th>"; 
echo "</tr>";

if(isset($_POST['sender']))
{
	if(!empty($_POST['HRReceive']) && isset($_POST['recommend_id']))
	{
		echo $recommend_id = $_POST['recommend_id'];echo "<br>";
		echo $HRReceive = $_POST['HRReceive'];
		
		$update_HRReceive_comments = mysql_query("UPDATE campus_empshort_leave SET HRReceive = '".$HRReceive."' , HRID = '".$_SESSION['userId']."' , HRDate=NOW() WHERE id='".$recommend_id."' ") or trigger_error(mysql_error());
		getMessages('leave_comments','leave_application_list_hr.php');
		echo "<script>window.location.href = 'short_leave_application_list_hr.php'</script>";
	}
	else
	{
		getMessages('error');
	}
}

else
{
	
$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,
campus_empshort_leave.id as empshortleave_id,campus_empshort_leave.empId,campus_empshort_leave.contact,
campus_empshort_leave.reasonLeave,campus_empshort_leave.timeLeave,campus_empshort_leave.timeRejoin,
campus_empshort_leave.leaveDuration,campus_empshort_leave.leaveApplied,
campus_empshort_leave.TLRecommend,campus_empshort_leave.TLID,
campus_empshort_leave.HRReceive,campus_empshort_leave.HRID,
campus_empshort_leave.currentDateTime,
campus_empshort_leave.TLDate,campus_empshort_leave.HRDate     
	FROM capmus_users 
	INNER JOIN campus_empshort_leave 
	ON capmus_users.id=campus_empshort_leave.empId ");
	
	if($_SESSION['userType']==15)
	{
		$sql.= "AND capmus_users.main_LeadId='".$_SESSION['userId']."'";
	}
	//MAIN TEACHER TEAMLEAD
	if(isset($_POST['search-teacher-main']) && !empty($_POST['search-teacher-main']))
	{
		$sql.= " and capmus_users.main_LeadId=".$_POST['search-teacher-main'];
	}
	//TEACHER TEAMLEAD(NOT MAIN)
	if($_POST['search-teacher-id2']!=0 && !empty($_POST['search-teacher-id2']))
	{
		$sql.= " and capmus_users.LeadId=".$_POST['search-teacher-id2'];
	}
	//TEACHER
	if($_POST['search-teacher-id']!=0 && !empty($_POST['search-teacher-id']))
	{
		$sql.= " and campus_empshort_leave.empId=".$_POST['search-teacher-id'];
	}
	
	//Pending TEAMLEAD'S Recommendations
	if(isset($_POST['pending_TL']))
	{
		$sql.= " and campus_empshort_leave.TLRecommend IS NULL and 
		campus_empshort_leave.TLID IS NULL ";
	}
	//Pending HR Recommendations
	if(isset($_POST['pending_HR']))
	{
		$sql.= " and campus_empshort_leave.HRReceive IS NULL and 
		campus_empshort_leave.HRID IS NULL ";
	}
	
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_empshort_leave.leaveApplied>= '".prepareDate($_POST['fromDate'])."' and campus_empshort_leave.leaveApplied<= '".prepareDate($_POST['toDate'])."'";
	}
	
	//echo $sql; 
	$result = mysql_query($sql) or trigger_error(mysql_error());
  
	
}

while($row = mysql_fetch_array($result)){
	echo "<td valign='top'>" . nl2br( $row['empshortleave_id']) . "</td>";  
	echo "<td valign='top'>" . showUser( nl2br( $row['empId'])) . "</td>";	
	echo "<td valign='top'>" . nl2br( $row['reasonLeave']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['timeLeave']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['timeRejoin']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['leaveDuration']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['leaveApplied']) ." , <b>(". nl2br( $row['currentDateTime']) . ")</b></td>";  
	echo "<td valign='top'><b>" . getData(nl2br( $row['TLRecommend']),'TL')."</b> - ".$row['TLComments'] . " - <span style='color:green'>". showUser( nl2br( $row['TLID'])) ." , ". nl2br( $row['TLDate']) ."</span></td>"; 
	echo "<td valign='top'><b>" . getData(nl2br( $row['HRReceive']),'HR')."</b> - ".$row['HRComments'] . " - <span style='color:green'>". showUser( nl2br( $row['HRID'])) ." , ". nl2br( $row['HRDate']) ."</span></td>";
	?>
	<form action='' method='POST'> 
	<?
	echo "<td valign='top'>" . getList('','HRReceive','HR') . "</td>"; 
	if(($_SESSION['userType']==1 || $_SESSION['userType']==11) && isset($row['TLID']))
	{
	if(($row['HRReceive']==0 || $row['HRReceive']=='') ){
		echo "<td valign='top'>" . getCheckbox_id( $_POST['recommend_id'],$row['empshortleave_id'],'recommend_id') . "</td>"; 
		echo "<td valign='top'>"?><input type='submit' value='Submit' name='sender' class="button" /><input type='hidden' value='1' name='submitted'/> </div> <? "</td>";
	
		}
	}
	else
	{
		echo "<td valign='top'>N/A</td>"; 
		echo "<td valign='top'>N/A</td>"; 
	}
//FOLLOWING CODE is related to SUPER BUTTON-UPDATE SUBMIT/////////////////////////////////////////////////////
/* 	if(($_SESSION['userType']==1 || $_SESSION['userType']==11) && isset($row['TLID']))
	{
		if(($row['HRReceive']==0 || $row['HRReceive']=='') ){
		echo "<td valign='top'>" . getCheckbox_email_select( $_POST[$row['empleave_id']],$row['empleave_id'],'recommend_id[]') . "</td>"; 
		}
		else
		{
			echo "<td valign='top'>N/A</td>"; 
			echo "<td valign='top'>N/A</td>"; 
		}
	} */
//////////////////////////////////////////////////////////////////////////////////////////////////////

	//Commenting this SUBMIT BUTTON for now,NOT IN USE as AJAX is used by clicking on SUPER BUTTON
	//echo "<td valign='top'>"?><!--<input type='submit' value='Submit' name='sender' class="button" /><input type='hidden' value='1' name='submitted'/> </div>--> <? //"</td>";
	?>
	</form>
	<?
	echo "</tr>"; 
} 
echo "</table>"; ?>
<?
include('include/footer.php');
?>