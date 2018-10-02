<?php 
include('config.php'); 
include('include/header.php');

echo "<label style='color:red; font-weight:bold'>NOTE: For Accurate report, Please click on <a href='teamlead_teacher_report_old.php'>Teacher TL Report OLD</a> Link</label>";
	
?>
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
//getStudentFilter();
//getTeamLeadTeacherFilter();
//getAgentFilter();
//getStatusFilter();

getStatusFilter_with_makeover();
getTeacherFilterLead();
getTeacherFilter();
?>
<br><br>
<?php
getTeacherFilterLead_main();
getFilterSubmit();
//NEWLY ADDED
echo "<br><br><br>";
echo "<label style='color:green'>Old Teacher Dropdown List ( Apply Dead Filter ):</label>";
echo getDataList_active_deactive_teachers(stripslashes($_POST['teacher_old']),'teacher_old',3);

//NEWLY ADDED on 17-05-2014
echo "<br><br><br>";
echo "<label style='color:green'>Checkbox to get Confirm DEAD DATE SCHEDULES</label>";
echo getCheckbox($_POST['stdStatus_confirmdead'],'stdStatus_confirmdead');


//NEWLY ADDED on 28-04-2015
echo "<br><br><br>";
echo "<label style='color:green'>Checkbox to get UNFREEZE SCHEDULES</label>";
echo getCheckbox($_POST['stdStatus_unfreeze'],'stdStatus_unfreeze');

?>
<br><br>

</div>
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','std_status','stdStatus');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
<?

if(isset($_POST['search-submit']))
{
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";
echo "<th class='specalt'><b>Teacher Old</b></th>"; 
echo "<th class='specalt'><b>Teacher Name</b></th>";
//echo "<th class='specalt'><b>NUMBER</b></th>";
echo "<th class='specalt'><b>Extension ID</b></th>";
echo "<th class='specalt'><b>COUNTRY</b></th>";
echo "<th class='specalt'><b>EMAIL</b></th>";  
echo "<th class='specalt'><b>Student Name</b></th>";
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'><b>Dead Comments</b></th>";
echo "<th class='specalt'><b>Main Team Lead Name</b></th>";  
echo "<th class='specalt'><b>Team Lead Name</b></th>";  
echo "<th class='specalt'><b>Booked Date</b></th>"; 
echo "<th class='specalt'><b>Signup Date</b></th>";
echo "<th class='specalt'><b>Pay Date</b></th>"; 
echo "<th class='specalt'><b>Dead Date</b></th>";  
echo "<th class='specalt'><b>Confirm DeadDate</b></th>"; 
echo "<th class='specalt'><b>Unfreeze Date</b></th>"; 
echo "<th class='specalt'><b>Dues USD</b></th>"; 
echo "<th class='specalt'><b>Comments</b></th>"; 
echo "<th class='specalt'><b>Freeze Date</b></th>";
echo "<th class='specalt'><b>Comments Freeze</b></th>";
echo "<th class='specalt'><b>Status(Old)</b></th>"; 
echo "<th class='specalt'><b>Status(Current)</b></th>"; 
echo "<th class='specalt'><b>Reason</b></th>"; 
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Recording link</b></th>";
echo "</tr>"; 
 
//Following query will show result by clicking TEACHER TL REPORT	-	GENERAL			-	NOT FOR SuperAdmin
if($_SESSION['userType']==8)
{
	$result = teacher_teamlead_report();
}

//MAIN TEACHER TEAMELAD
else if($_SESSION['userType']==15)
{
	$result = main_teacher_teamlead_report();
}

else if(isset($_POST['search-submit']) && $_POST['stdStatus_confirmdead']==1)
{
	$result = confirm_dead_teacher_teamlead_report();
}

//FOR Main Teacher Teamlead	-	FOR SuperAdmin - DATE FILTER WORKING
else if(isset($_POST['search-submit']) && $_POST['search-teacher-main']!=0) /*&& $_POST['fromDate']!="" && $_POST['toDate']!=""*/ 
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze,campus_schedule.agentId,campus_schedule.record_link_dead 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.main_LeadId='".$_POST['search-teacher-main']."'  
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
		if($_POST['stdStatus']!=0)
		{
			$result.=" and campus_schedule.std_status= '".$_POST['stdStatus']."' ";
		}
		if($_POST['search-teacher-id2']!=0)
		{
			$result.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
		}
		
		
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
		{
			$result.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
		{
			$result.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
		{
			$result.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==4)
		{
			$result.=" and campus_schedule.freeze_date>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.freeze_date<= '".prepareDate($_POST['toDate'])."'";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_teacher();
}




//NEWLY ADDED - DEAD OLD TEACHER FILTER
//FOR OLD TEACHER with DEAD FILTER ---ONLY	-	FOR SuperAdmin - DATE FILTER WORKING
else if(isset($_POST['search-submit']) && $_POST['teacher_old']!=0 && $_POST['stdStatus']!=0) 
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze,campus_schedule.agentId,campus_schedule.record_link_dead  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id='".$_POST['teacher_old']."' and campus_schedule.teacherID_old='".$_POST['teacher_old']."'  
	and campus_schedule.std_status='".$_POST['stdStatus']."'
	and campus_schedule.status=1"; 
		/*if($_POST['search-teacher-id2']!=0)
		{
			$result.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
		}*/
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
		{
			$result.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
		echo $result.=" ORDER BY campus_schedule.teacherID_old";
	$result=mysql_query($result);
}




//FOR BOTH TEAMLEAD and STUDENT STATUS FILTERING	-	FOR SuperAdmin - DATE FILTER WORKING
else if(isset($_POST['search-submit']) && $_POST['search-teacher-id']!=0 && $_POST['stdStatus']!=0) /*&& $_POST['fromDate']!="" && $_POST['toDate']!=""*/ 
{
	
//echo prepareDate($_POST['fromDate'])."<br>"; echo prepareDate($_POST['toDate']);
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze,campus_schedule.agentId,campus_schedule.record_link_dead 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON  capmus_users.id='".$_POST['search-teacher-id']."' and campus_schedule.teacherID='".$_POST['search-teacher-id']."'  
	and campus_schedule.std_status='".$_POST['stdStatus']."'
	and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
		if($_POST['search-teacher-id2']!=0)
		{
			$result.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
		{
			$result.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
		{
			$result.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
		{
			$result.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==4)
		{
			$result.=" and campus_schedule.freeze_date>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.freeze_date<= '".prepareDate($_POST['toDate'])."'";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_teacher();
}



//FOR BOTH TEAMLEAD and STUDENT STATUS FILTERING	-	FOR SuperAdmin - DATE FILTER WORKING
else if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0 && $_POST['stdStatus']!=0) /*&& $_POST['fromDate']!="" && $_POST['toDate']!=""*/ 
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze,campus_schedule.agentId,campus_schedule.record_link_dead  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' and campus_schedule.std_status='".$_POST['stdStatus']."'
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
		{
			$result.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
		{
			$result.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
		{
			$result.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==4)
		{
			$result.=" and campus_schedule.freeze_date>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.freeze_date<= '".prepareDate($_POST['toDate'])."'";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_teacher();
}



//FOR TEAM LEAD ONLY	-	FOR SuperAdmin
else if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0) /*&& $_POST['fromDate']!="" && $_POST['toDate']!=""*/
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze,campus_schedule.agentId,campus_schedule.record_link_dead 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_POST['search-teacher-id2']."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0"; 
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
		{
			$result.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==4)
	{
		$result.=" and campus_schedule.freeze_date>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.freeze_date<= '".prepareDate($_POST['toDate'])."'";
	}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_teacher();
}

//FOR STUDENT STATUS ACCORDING TO TEACHER UNDER THE TEAM LEAD ONLY(STUDENT STATUS ONLY)	-	FOR SuperAdmin - DATE FILTER WORKING
else if(isset($_POST['search-submit']) && $_POST['stdStatus']!=0) /*&& $_POST['fromDate']!="" && $_POST['toDate']!=""*/
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.paydate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.confirm_dead_date,campus_schedule.freeze_date,campus_schedule.comments,campus_schedule.dead_reason,campus_schedule.comments_freeze,campus_schedule.unfreeze_date,campus_schedule.agentId,campus_schedule.record_link_dead  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON campus_schedule.std_status='".$_POST['stdStatus']."' 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
		{
			$result.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
		{
			if($_POST['stdStatus_unfreeze']==1)
			{
				$result.=" and campus_schedule.std_status_old=4 and campus_schedule.unfreeze_date>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.unfreeze_date<= '".prepareDate($_POST['toDate'])."'";
			}
			else
			{
				$result.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
			}
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
		{
			$result.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'  ";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==4)
		{
			$result.=" and campus_schedule.freeze_date>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.freeze_date<= '".prepareDate($_POST['toDate'])."'";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_teacher();
}
else	//	-	FOR SuperAdmin
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.main_LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.teacherID_old,campus_schedule.comments,campus_schedule.record_link_dead  
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0";
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$result.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
		}
	/*if($_POST['fromDate-day']!="" && $_POST['toDate-day']!="")
		{
			$result.=" and day(campus_schedule.dateBooked)>= '".$fromDate."' and day(campus_schedule.dateBooked)<= '".$toDate."'";
		}*/
		$result.=" ORDER BY campus_schedule.teacherID";
	//$result=mysql_query($result);
	//teamlead_count_teacher();
}
$rows_count = mysql_num_rows($result);
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rows_count." &nbsp;&nbsp;&nbsp;</div><br></b>";


while($row = mysql_fetch_array($result)){ 
//Getting student number
$query="select `campus_students`.id as stu_id,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);
////////////////////////

$sum=$row['dues'];
$sum_dues[$row['sch_id']]=$sum;

//foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['sch_id']) . "</td>";
//echo "<td valign='top'>" . nl2br( $row['duedays']) . "</td>";
echo "<td valign='top'>" . showUser(nl2br( $row['teacherID_old'])) . "</td>";  
if($_POST['teacher_old']!=0)
{
	echo "<td valign='top'>" . showUser(nl2br( $row['teacherID'])) . "</td>";  
}
else
{
	echo "<td valign='top'>" . nl2br( $row['firstName']) . " " . nl2br( $row['lastName']) . "</td>";  
}
//Showing student number
/* echo "<td valign='top'>";
	if(!empty($rows['phone'])){

	echo "[" . nl2br( $rows['phone'] )."]";
	}
	if(!empty($rows['mobile'])){
	echo " <br>[".nl2br( $$rows['mobile'] )."]";
	}
	if(!empty($$rows['landline'])){
	echo "<br>[".nl2br( $rows['landline'] ) . "]";
	}
echo "</td>"; */
///////////////////////
///////////////////////
//NOW Showing EXTENSION ID	16-07-2015
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $rows['stu_id']))."' target=_blank >" . getextID(nl2br( $rows['stu_id'])) . "</a></td>";
///////////////////////
echo "<td valign='top'>" . getData(nl2br( $rows['countryID']),'country'). "</td>";
if($_SESSION['userType']==2){
echo "<td valign='top'>NA</td>";
}else{
echo "<td valign='top'>" . 	nl2br( $rows['email']). "</td>";
}
echo "<td valign='top'>" .  "<a href=class_details.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";
echo "<td valign='top'>" . nl2br( $row['comments_dead']) . "</td>"; 
echo "<td valign='top' style='color:red; font-weight:bold'>" . showUser(nl2br( $row['main_LeadId'])) . "</td>"; 
echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row['LeadId'])) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['dateBooked']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['duedate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['paydate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dead_date']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['confirm_dead_date']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['unfreeze_date']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";
//FOR COMMENTS-Removing rn
$comments = $row['comments'];
$comments = stripslashes($comments);
$comments = str_replace("rn","\r\n",$comments);
echo "<td valign='top'>" . $comments . "</td>";
echo "<td valign='top'>" . nl2br( $row['freeze_date']) . "</td>";
echo "<td valign='top'>" . $row['comments_freeze'] . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['std_status_old']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['dead_reason']),'dead_reason') . "</td>";
echo "<td valign='top'>" . showUser($row['agentId']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['record_link_dead']) . "</td>";
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
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum </td>";  
echo "<td valign='top'><b>$" . array_sum($sum_dues)  . "</td>";  
echo "<td valign='top'></td>";
echo "</tr>";

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
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum/90 </td>";  
echo "<td valign='top'><b>$" . array_sum($sum_dues)/90  . "</td>";  
echo "<td valign='top'></td>";
echo "</tr>"; 
echo "</table>"; 
}
?>
<?php include('include/footer.php');?>