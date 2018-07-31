<? 
include('config.php');
include('include/header.php'); 

if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==227 || $_SESSION['userId']==506 || $_SESSION['userId']==126 || $_SESSION['userId']==411 || $_SESSION['userId']==195 || $_SESSION['userId']==60 || $_SESSION['userId']==550 || $_SESSION['userId']==856 || $_SESSION['userId']==1668 || $_SESSION['userId']==625 || $_SESSION['userId']==221)
{
?>
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
<?php
getShiftFilter();
getFilterSubmit();
?></div>
<br>
</form>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
//echo "<th class='specalt'><b>ChkBox</b></th>";
echo "<th class='specalt'><b>Update</b></th>";
echo "<th class='specalt'><b>Id</b></th>";
echo "<th class='specalt'><b>Status</b></th>";
echo "<th class='specalt'><b>Comments/Reason</b></th>"; 
echo "<th class='specalt'><b>Team Lead Name</b></th>";
//echo "<th class='specalt'><b>Contact</b></th>"; 
echo "<th class='specalt'><b>Email</b></th>"; 
echo "<th class='specalt'><b>Start time</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Country</b></th>";
echo "<th class='specalt'><b>EXT ID</b></th>";
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>";
echo "<th class='specalt'><b>Amount</b></th>"; 
echo "<th class='specalt'><b>Class Days</b></th>"; 
echo "<th class='specalt'><b>Reason</b></th>"; 
echo "<th class='specalt'><b>Dead Date</b></th>"; 
echo "<th class='specalt'><b>PENDING/CONFIRM Dead Date</b></th>"; 
echo "<th class='specalt'><b>Pending/Confirmed</b></th>"; 
//echo "<th class='specalt'><b>Comments Dead</b></th>"; 
echo "<th class='specalt' colspan=3><b>Actions</b></th>";  
echo "</tr>";

//>>>Commenting following to shift the DEAD TEXTBOX under SEND DEAD CONFIRMATION from CONFIRM DEAD <<<
/* if(isset($_POST['second_last_dead_confirmation']))
{
	$id_second_last_dead_confirmation = $_POST['second_last_dead_confirmation'];
	$second_last_dead_confirmation = mysql_query("UPDATE campus_schedule SET status_dead_second_last = 1 , pending_confirmed_dead_date = NOW() WHERE id='".$id_second_last_dead_confirmation."' ") or trigger_error(mysql_error());
	getMessages('second_last_dead_confirmation_edit','book_scheduler_dead_confirmation.php');
}
else
{ */
//>>>																								<<<
	if($_SESSION['userId']==48)
	{
		$result = mysql_query("SELECT * FROM `campus_schedule` WHERE campus_schedule.status_dead=1 and campus_schedule.std_status!=3 and status_dead_second_last=1") or trigger_error(mysql_error()); 
	}
	else
	{
		
	//$result = mysql_query("SELECT * FROM `campus_schedule` WHERE campus_schedule.status_dead=1 and campus_schedule.std_status!=3") or trigger_error(mysql_error());
	//**********************									**************************
	//Used following query for MORNING and NIGHT SHIFT Teamleads filter to be implemented properly
	//So commented the original [SELECT * campus_schedule query] // Newly added 20-11-16
	$sql="SELECT capmus_users.id as users_id,capmus_users.firstName,capmus_users.lastName,
	capmus_users.LeadId,capmus_users.main_LeadId,
	campus_schedule.id,campus_schedule.std_status,campus_schedule.dues as dues,
	campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,
	campus_schedule.status_dead,campus_schedule.dateBooked,campus_schedule.duedate,
	campus_schedule.startTime,campus_schedule.endTime,campus_schedule.startDate,campus_schedule.endDate,
	campus_schedule.agentId,campus_schedule.classType,campus_schedule.paydate,campus_schedule.skypetext,
	campus_schedule.comments_dead,campus_schedule.dead_reason,campus_schedule.dead_date,
	campus_schedule.confirm_dead_date,campus_schedule.status_dead_second_last,
	campus_schedule.pending_confirmed_dead_date,
	campus_schedule.edit_sch_TL_confirm   
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status_dead=1 and 
	campus_schedule.std_status!=3";
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql.= " and capmus_users.empShift = ".$_POST['shift'];
	}
	$result = mysql_query($sql);
	}
/* } */
//Arrays for the Amount sum
$dead_amt_sum=array();
///////////////////////////
while($row = mysql_fetch_array($result)){
	$query="select `campus_students`.id as stu_id , `campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
	$results=mysql_query($query);
	$rows=mysql_fetch_array($results);
	
	/* $sql_teamlead="SELECT * FROM capmus_users WHERE id='".$row['teacherID']."'";
	if(isset($_POST['shift']) && !empty($_POST['shift']))
	{
		$sql_teamlead.= " and capmus_users.empShift = ".$_POST['shift'];
	}
	echo $sql_teamlead;echo "<br>";
	$result_teamlead=mysql_query($sql_teamlead);
	$row_teamlead=mysql_fetch_array($result_teamlead); */
	
	$dead_amt_sum[$row['id']] = $row['dues'];
	
	
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

	echo "<tr>";  	//Following 2 tables cells are for CHECKBOX and CONFIRM DEAD BUTTON
					//Following FORM TAGS were required to POST the CHECKBOX VALUE?>
	<!--<form action='' method='POST'> -->
	<?php 	
		if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==126 || $_SESSION['userId']==227 || $_SESSION['userId']==411 || $_SESSION['userId']==195 || $_SESSION['userId']==60 || $_SESSION['userId']==550 || $_SESSION['userId']==856 || $_SESSION['userId']==625 || $_SESSION['userId']==221)
		{
			//>>>Commenting following to shift the DEAD TEXTBOX under SEND DEAD CONFIRMATION from CONFIRM DEAD <<<
			//echo "<td valign='top'>" . getCheckbox_2nd_last_dead_confirmation( $_POST['second_last_dead_confirmation'],$row['id'],'second_last_dead_confirmation') . "</td>"; 
			//echo "<td valign='top'>"?><!--<input type='submit' value='Send Dead Confirmation' class="button" /><input type='hidden' value='1' name='submitted'/> </div>--> <? //"</td>";
			if($row['status_dead_second_last']==NULL)
			echo "<td valign='top'><a class=button href=book_scheduler_second_last_dead_confirmation.php?id={$row['id']}&studentID={$row['studentID']}&std_status={$row['std_status']}>Send Dead Confirmation</a></td>";
			if($row['status_dead_second_last']==1)
			echo "<td valign='top'><a class=button href=#>Confirmation sent</a></td>";
		}
		else
		{
			echo "<td valign='top'><td><a class=button href=#>N/A</a></td>";
		}
		?>
	<!--</form>-->
	<?
	echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
	echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['comments_dead']) . "</td>";  
	//echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row_teamlead['LeadId'])) . "</td>";
	echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row['LeadId'])) . "</td>";
			
		/*echo "<td valign='top'>";
		if(!empty($rows['phone'])){

		echo "[" . nl2br( $rows['phone'] )."]";
		}
		if(!empty($rows['mobile'])){
		echo " <br>[".nl2br( $$rows['mobile'] )."]";
		}
		if(!empty($$rows['landline'])){
		echo "<br>[".nl2br( $rows['landline'] ) . "]";
		}
		echo "</td>";*/
		
	echo "<td valign='top'>" . nl2br( $rows['email']) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
	echo "<td valign='top'>" . getData(nl2br( $rows['countryID']),'country'). "</td>"; 
	echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $rows['stu_id']))."' target=_blank >" . getextID(nl2br( $rows['stu_id'])) . "</a></td>";
	echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
	echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
	echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";
	echo "<td valign='top'>" . getData(nl2br( $row['classType']),'plan') . "</td>";   
	echo "<td valign='top'>" . getData(nl2br( $row['dead_reason']),'dead_reason') . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['dead_date']) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['pending_confirmed_dead_date']) . "</td>"; 
	//Following is for PENDIND and CONFIRMED Status//////////////////////////////////
	if($row['status_dead_second_last']==NULL)
		echo "<td valign='top' style='color:red; font-weight:bold'>PENDING</td>"; 
	if($row['status_dead_second_last']==1)
		echo "<td valign='top' style='color:green; font-weight:bold'>CONFIRMED</td>";
	/////////////////////////////////////////////////////////////////////////////////
	if($_SESSION['userId']==159 || $_SESSION['userId']==227 || $_SESSION['userId']==60 || $_SESSION['userId']==411 || $_SESSION['userId']==195 || $_SESSION['userId']==625 || $_SESSION['userId']==221)  
	{
		echo "<td valign='top'><td><a class=button href=book_scheduler_dead.php?id={$row['id']}&studentID={$row['studentID']}&std_status={$row['std_status']}>Confirm dead</a></td>	"; 
	}
	else
	{
		echo "<td valign='top'><td><a class=button href=#>N/A</a></td>";
	}
	if($_SESSION['userId']==159)
	{
		echo "<td valign='top'><a class=button href=book_scheduler_edit_amounts_ver2.php?id={$row['id']}>Edit</a></td>";
	}	 
	//echo "<td valign='top'><a class=button href=book_scheduler_edit.php?id={$row['id']}>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to confirm this schedule?')\" class=button href=book_scheduler_confirm.php?id={$row['id']}>Confirm Schedule</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=book_scheduler_delete.php?id={$row['id']}>Delete</a></td> "; 
	echo "</tr>"; 
} 
echo "<tr>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'>Sum </td>";  
	echo "<td valign='top'><b>$" . nl2br( array_sum($dead_amt_sum)) . "</td>";
echo "</tr>";
echo "</table>"; ?>
<div id="update_dead_confirmation_Div"></div>
<?
}
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}
include('include/footer.php');
?>