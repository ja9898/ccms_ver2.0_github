<?php 
include('config.php'); 
include('include/header.php');


//FOR FILTERING STUDENT STATUS ONLY
/*global $check;

if(isset($_POST['sender']) && $_POST['std_status']!="")
{
$student_status = $_POST['std_status'];
//echo "Student status found<br>";
echo $_POST['std_status'];
//header ('Location:loggeduser.php');
	//$select_sta_query=("SELECT * FROM campus_students WHERE campus_students.std_status ='".$student_status."'");
	
	//$result=mysql_query($select_sta_query);
	//if(mysql_num_rows($result))
	//{
		$check=1;
		//echo "<br>";
		//echo '1';
	//}
	//else
	//{
		//echo "<br>0<br>";
		//echo "No status match";
	//}
}
else
{
	echo "Student status NOT FOUND-ALL SHOWN";
}*/
	
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div id="filter">
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
<?php
//getStudentFilter();
//getStatusFilter();
getStatusFilter_with_makeover();
getAgentFilterLead();
getAgentFilter();

echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt' colspan=5 style='color:RED'><b> 1) Check only one BOX at a time to get the OVERALL status result according to dates</b><br>
<b> 2) For DEAD-TRIAL/REGULAR/MAKEOVER , Dead must be selected from DROPDOWN LIST</b></th>"; 
echo "</tr>"; 
echo "<tr>";
echo "<tr>"; 
echo "<th class='specalt'><b>Trial</b></th>"; 
echo "<th class='specalt'><b>Regular</b></th>"; 
echo "<th class='specalt'><b>Dead - Trial</b></th>";
echo "<th class='specalt'><b>Dead - Regular</b></th>";
echo "<th class='specalt'><b>Dead - Make Over</b></th>";
 
echo "</tr>"; 
echo "<tr>"; 
echo "<td class='specalt'><b>".getCheckbox($_POST['stdStatus_Trl'],'stdStatus_Trl')."</b></td>"; 
echo "<td class='specalt'><b>".getCheckbox($_POST['stdStatus_Reg'],'stdStatus_Reg')."</b></td>"; 
echo "<td class='specalt'><b>".getCheckbox($_POST['stdStatus_deadTrl'],'stdStatus_deadTrl')."</b></td>"; 
echo "<td class='specalt'><b>".getCheckbox($_POST['stdStatus_deadReg'],'stdStatus_deadReg')."</b></td>"; 
echo "<td class='specalt'><b>".getCheckbox($_POST['stdStatus_deadMO'],'stdStatus_deadMO')."</b></td>";
echo "</tr>";
echo "</table>";

getFilterSubmit();
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
echo "<th class='specalt'><b>Agent Name</b></th>"; 
echo "<th class='specalt'><b>Student Name</b></th>";
echo "<th class='specalt'><b>EXT ID</b></th>";
echo "<th class='specalt'><b>Course ID</b></th>";
echo "<th class='specalt'><b>Dead Comments</b></th>";
echo "<th class='specalt'><b>Agent TeamLead Name</b></th>";  
echo "<th class='specalt'><b>Booked Date</b></th>"; 
echo "<th class='specalt'><b>Signup Date</b></th>"; 
echo "<th class='specalt'><b>Dead Date</b></th>"; 
echo "<th class='specalt'><b>Confirm DeadDate</b></th>"; 
echo "<th class='specalt'><b>Dues</b></th>"; 
echo "<th class='specalt'><b>Status(Old)</b></th>"; 
echo "<th class='specalt'><b>Status</b></th>"; 


echo "</tr>"; 

function trial_dead()
{
	$trial_dead="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_trial,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_POST['search-agent-id2']."' and campus_schedule.std_status='".$_POST['stdStatus']."'
	and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0 and campus_schedule.std_status_old=1 "; 
	if($_POST['stdStatus']!=0)
		{
			//$trial_dead.=" and campus_schedule.std_status= '".$_POST['stdStatus']."' ";
		}
		
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==1)
		{
			//$trial_dead.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==2)
		{
			//$trial_dead.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
		{
			$trial_dead.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
		$trial_dead.=" GROUP BY campus_schedule.std_status_old ORDER BY campus_schedule.agentId";	
		$trial_dead=mysql_query($trial_dead);
		while($row_count_trialdead = mysql_fetch_array($trial_dead))
		{ 
			echo "<br><b><div style='float:left'>". getData(nl2br( $row_count_trialdead['std_status_old']),'stdStatusmo-list') . " : " . $row_count_trialdead['cnt_trial']."</b>&nbsp;&nbsp;&nbsp;";
		}
}

//$_sql="SELECT * FROM `campus_students` ";
//getResultResource('campus_schedule',$_POST,'status=1');
 
//if(isset($_POST['search-submit']))
//{
//$team_lead_id2=$_POST['search-agent-id2'];
//$team_lead=$_POST['search-agent2'];

//For searching STUDENT STATUS(stdStatus) ONLY for specific TEAMLEAD has bee loggedIn	-	NOT FOR SuperAdmin
/*if($_SESSION['userType']==9 && isset($_POST['search-submit']) && $_POST['stdStatus']!=0)
{
	$result=("SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_SESSION['userId']."' and campus_schedule.std_status='".$_POST['stdStatus']."' and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0");
	$result=mysql_query($result);
	teamlead_count_agent();
}*/
//Following query will show result by clicking TEACHER TL REPORT	-	GENERAL			-	NOT FOR SuperAdmin
if($_SESSION['userType']==9)
{
	$result=agent_teamlead_report();
	//teamlead_count_agent();
}





//*****************************************NEWLY ADDED 19-06-2014*********************************************
//OVERALL status result according to dates
else if(isset($_POST['search-submit']) && ($_POST['stdStatus_Trl']==1 || $_POST['stdStatus_Reg']==1 || $_POST['stdStatus_deadTrl']==1 || $_POST['stdStatus_deadReg']==1 || $_POST['stdStatus_deadMO']==1))
{
	$result="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.agentId 
	FROM  campus_schedule 
	WHERE campus_schedule.status=1 "; 
	//Agent TEAMLEAD(NOT MAIN)
	if($_POST['search-agent-id2']!=0 && !empty($_POST['search-agent-id2']))
	{
		$result.= " and capmus_users.LeadId=".$_POST['search-agent-id2'];
	}
	//Agent 
	if($_POST['search-agent-id']!=0 && !empty($_POST['search-agent-id']))
	{
		$result.= " and campus_schedule.agentId!=0 and capmus_users.id=".$_POST['search-agent-id'];
	}
	
	//OVERALL TRIAL STATUS on BOOKING DATE
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus_Trl']==1)
	{
		$result.=" and campus_schedule.std_status!=5 and campus_schedule.std_status_old!=5 
		and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
	}
	//OVERALL REGULAR STATUS on SIGNUP DATE
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus_Reg']==1)
	{
		$result.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
	}
	//DEAD-TRIAL/REGULAR/MAKEOVER STATUS on CONFIRM DEAD DATE
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3 && ($_POST['stdStatus_deadTrl']==1 || $_POST['stdStatus_deadReg']==1 || $_POST['stdStatus_deadMO']==1))
	{
		//STUDENT STATUS - current(which will be dead)
		if(isset($_POST['stdStatus']) && !empty($_POST['stdStatus']))
		{
			$result.= " and campus_schedule.std_status = ".$_POST['stdStatus'];
		}
		//STUDENT STATUS - Applying condition on old
		if(isset($_POST['stdStatus_deadReg']) && !empty($_POST['stdStatus_deadReg']))
		{
			$result.= " and campus_schedule.std_status_old = 2 ";
		}
		if(isset($_POST['stdStatus_deadTrl']) && !empty($_POST['stdStatus_deadTrl']))
		{
			$result.= " and campus_schedule.std_status_old = 1 ";
		}
		if(isset($_POST['stdStatus_deadMO']) && !empty($_POST['stdStatus_deadMO']))
		{
			$result.= " and campus_schedule.std_status_old = 5 ";
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
				$result.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
			}
		
		//$result.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
		echo $result.=" ORDER BY campus_schedule.teacherID";
		$result=mysql_query($result);
}






//FOR BOTH TEAMLEAD and STUDENT STATUS FILTERING	-	FOR SuperAdmin - DATE FILTER WORKING
else if(isset($_POST['search-submit']) && $_POST['search-agent-id']!=0 && $_POST['stdStatus']!=0) /*&& $_POST['fromDate']!="" && $_POST['toDate']!=""*/ 
{
//echo prepareDate($_POST['fromDate'])."<br>"; echo prepareDate($_POST['toDate']);
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.agentId 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id='".$_POST['search-agent-id']."' and campus_schedule.std_status='".$_POST['stdStatus']."'
	and campus_schedule.agentId='".$_POST['search-agent-id']."' and campus_schedule.status=1 and campus_schedule.agentId!=0"; 
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
		$result.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_agent();
	//trial_dead();
}



//FOR BOTH TEAMLEAD and STUDENT STATUS FILTERING	-	FOR SuperAdmin - DATE FILTER WORKING
else if(isset($_POST['search-submit']) && $_POST['search-agent-id2']!=0 && $_POST['stdStatus']!=0) /*&& $_POST['fromDate']!="" && $_POST['toDate']!=""*/ 
{
//echo prepareDate($_POST['fromDate'])."<br>"; echo prepareDate($_POST['toDate']);
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.agentId 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_POST['search-agent-id2']."' and campus_schedule.std_status='".$_POST['stdStatus']."'
	and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0"; 
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
			$result.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_agent();
	//trial_dead();
}

//FOR TEAM LEAD ONLY	-	FOR SuperAdmin
else if(isset($_POST['search-submit']) && $_POST['search-agent-id2']!=0) /*&& $_POST['fromDate']!="" && $_POST['toDate']!=""*/
{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.agentId 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId='".$_POST['search-agent-id2']."' 
	and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0"; 
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$result.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_agent();
}

//FOR STUDENT STATUS ACCORDING TO TEACHER UNDER THE TEAM LEAD ONLY(STUDENT STATUS ONLY)	-	FOR SuperAdmin - DATE FILTER WORKING
else if(isset($_POST['search-submit']) && $_POST['stdStatus']!=0) /*&& $_POST['fromDate']!="" && $_POST['toDate']!=""*/
{
	//$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID 
	//FROM capmus_users 
	//INNER JOIN campus_schedule 
	//ON campus_schedule.std_status='".$_POST['stdStatus']."' 
	//and capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0";
	$result="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.agentId 
	FROM  campus_schedule 
	WHERE campus_schedule.std_status='".$_POST['stdStatus']."' 
	and campus_schedule.status=1 ";
	
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
			$result.=" and DATE(campus_schedule.confirm_dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.confirm_dead_date)<= '".prepareDate($_POST['toDate'])."'";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_agent();
}
else	//	-	FOR SuperAdmin
{
	
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.confirm_dead_date,campus_schedule.std_status_old,campus_schedule.std_status,campus_schedule.studentID,campus_schedule.status,campus_schedule.dues as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.agentId 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.agentId and campus_schedule.status=1 and campus_schedule.agentId!=0";
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$result.=" and campus_schedule.dateBooked>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.dateBooked<= '".prepareDate($_POST['toDate'])."'";
		}
		$result.=" ORDER BY campus_schedule.teacherID";
	$result=mysql_query($result);
	//teamlead_count_agent();
	
	
}
//}
$rows_count = mysql_num_rows($result);
echo "<br><br><br><br><b><div style='float:left'>Total : ".$rows_count." &nbsp;&nbsp;&nbsp;</div><br></b>";
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

$sum=$row['dues'];

$sum_dues[$row['sch_id']]=$sum;

echo "<tr>";    
echo "<td valign='top'>" . nl2br( $row['firstName']) . " " . nl2br( $row['lastName']) . "</td>"; 
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>"; 
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row['studentID']))."' target=_blank >" . getextID(nl2br( $row['studentID'])) . "</a></td>";
echo "<td valign='top'>" .getData( nl2br( $row['courseID']),'course') . "</td>";  
echo "<td valign='top'>" . nl2br( $row['comments_dead']) . "</td>";
echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['dateBooked']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['duedate']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['dead_date']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['confirm_dead_date']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['std_status_old']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 


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
echo "<td valign='top'>Sum/90 </td>"; 
echo "<td valign='top'><b>$" . array_sum($sum_dues)/90  . "</td>";  
echo "<td valign='top'></td>";
echo "</tr>";

echo "</table>"; 
}
?>
<?php include('include/footer.php');?>