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
<?php if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==9 || $_SESSION['userType']==15 || ($_SESSION['userType']==17 && $_SESSION['userId']==1760))
	{
	 ?>
<br><br><input type="button" value="SUPER BUTTON TL-UPDATE" id="buttonClass_recommend_teamlead" style="background-color:red">
<div id="result_div">
</div>
<?php } ?>

</div>
</form>
<?
if(isset($_POST['search-submit']))		//if $_POST['search-submit'] start
{
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>ID</b></th>";
echo "<th class='specalt'><b>EMP ID</b></th>";
echo "<th class='specalt'><b>Leave Type</b></th>";
echo "<th class='specalt'><b>Leave Reason</b></th>";
echo "<th class='specalt'><b>Leave Start Date</b></th>"; 
echo "<th class='specalt'><b>Leave End Date</b></th>"; 
echo "<th class='specalt'><b>No Of Days</b></th>"; 
echo "<th class='specalt'><b>Leave Applied</b></th>"; 
echo "<th class='specalt'><b>TL Recommend/Not Recommend</b></th>"; 
echo "<th class='specalt'><b>GM Approve/Not Approve</b></th>"; 
echo "<th class='specalt'><b>HR Received/Not Received</b></th>"; 
echo "<th class='specalt' colspan='4'><b>Actions</b></th>"; 

echo "</tr>";

if(isset($_POST['sender']))
{
	if(!empty($_POST['TLRecommend']) && isset($_POST['recommend_id']))
	{
		echo $recommend_id = $_POST['recommend_id'];echo "<br>";
		echo $TLRecommend = $_POST['TLRecommend'];
		
		$update_TLRecommend_comments = mysql_query("UPDATE campus_empleave SET TLRecommend = '".$TLRecommend."' , TLComments = '".$_POST['TLComments']."' , TLID = '".$_SESSION['userId']."' , TLDate=NOW() WHERE id='".$recommend_id."' ") or trigger_error(mysql_error());
		getMessages('leave_comments','leave_application_list_teamlead.php');
		echo "<script>window.location.href = 'leave_application_list_teamlead.php'</script>";
	}
	else
	{
		getMessages('error');
	}
}

else
{	
$sql=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_empleave.id as empleave_id,campus_empleave.EmpID,campus_empleave.LeaveType,campus_empleave.LeaveReason,campus_empleave.LeaveStartDate,campus_empleave.LeaveEndDate,campus_empleave.NoOfDays,campus_empleave.LeaveApplied,campus_empleave.TLRecommend,campus_empleave.TLComments,campus_empleave.TLID,campus_empleave.GMApprove,campus_empleave.GMComments,campus_empleave.GMID,campus_empleave.HRReceive,campus_empleave.HRComments,campus_empleave.HRID,campus_empleave.current_datetime,campus_empleave.TLDate,campus_empleave.GMDate,campus_empleave.HRDate     
	FROM capmus_users 
	INNER JOIN campus_empleave 
	ON capmus_users.id=campus_empleave.EmpID ");
	
	if($_SESSION['userType']==15)
	{
		$sql.= "AND capmus_users.main_LeadId='".$_SESSION['userId']."'";
	}
	if($_SESSION['userType']==8)
	{
		$sql.= "AND capmus_users.LeadId='".$_SESSION['userId']."'";
	}
	if($_SESSION['userType']==9)
	{
		$sql.= "AND capmus_users.LeadId='".$_SESSION['userId']."'";
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
		$sql.= " and campus_empleave.EmpID=".$_POST['search-teacher-id'];
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.=" and campus_empleave.LeaveApplied>= '".prepareDate($_POST['fromDate'])."' and campus_empleave.LeaveApplied<= '".prepareDate($_POST['toDate'])."'";
	}
	
	//echo $sql; 
	$result = mysql_query($sql) or trigger_error(mysql_error());
	
}

while($row = mysql_fetch_array($result)){
		
	
	echo "<td valign='top'>" . nl2br( $row['empleave_id']) . "</td>";  
	echo "<td valign='top'>" . showUser( nl2br( $row['EmpID'])) . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['LeaveType']),'LeaveType') . "</td>"; 	
	echo "<td valign='top'>" . nl2br( $row['LeaveReason']) . "</td>";   
	echo "<td valign='top'>" . nl2br( $row['LeaveStartDate']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['LeaveEndDate']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['NoOfDays']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['LeaveApplied']) ." , <b>(". nl2br( $row['current_datetime']) . ")</b></td>";  
	echo "<td valign='top'><b>" . getData(nl2br( $row['TLRecommend']),'TL')."</b> - ".$row['TLComments'] . " - <span style='color:green'>". showUser( nl2br( $row['TLID'])) ." , ". nl2br( $row['TLDate']) ."</span></td>"; 
	echo "<td valign='top'><b>" . getData(nl2br( $row['GMApprove']),'GM')."</b> - ".$row['GMComments'] . " - <span style='color:green'>". showUser( nl2br( $row['GMID'])) ." , ". nl2br( $row['GMDate']) ."</span></td>"; 
	echo "<td valign='top'><b>" . getData(nl2br( $row['HRReceive']),'HR')."</b> - ".$row['HRComments'] . " - <span style='color:green'>". showUser( nl2br( $row['HRID'])) ." , ". nl2br( $row['HRDate']) ."</span></td>";
	?>
	<form action='' method='POST'> 
	<?
	echo "<td valign='top'>" . getList('','TLRecommend'.$row['empleave_id'],'TL') . "</td>"; 
	echo "<td valign='top'><input name=TLComments id=TLComments".$row['empleave_id']." type=text /> </td>"; 
	echo "<td valign='top'>" . getCheckbox_email_select( $_POST[$row['empleave_id']],$row['empleave_id'],'recommend_id[]') . "</td>"; 
	?>
	</form>
	<?
	echo "</tr>"; 
} 
echo "</table>"; ?>
<?
} //	if $_POST['search-submit'] end
include('include/footer.php');
?>