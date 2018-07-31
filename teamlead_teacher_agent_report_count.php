<?php 
include('config.php'); 
include('include/header.php');


?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div id="filter">

<?php
//getStudentFilter();
//getTeamLeadTeacherFilter();
//getAgentFilter();
//getStatusFilter();

//getStatusFilter_with_makeover();
//getTeacherFilterLead();
//getFilterSubmit();
?>
<br><br>

</div>
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','std_status','stdStatus');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->

<?php
//echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
//echo "<tr>"; 
//echo "<th class='specalt'><b>TL</b></th>";
//echo "</tr>"; 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
/*echo "<th class='specalt'><b>Id</b></th>";
echo "<th class='specalt'><b>Teacher Name</b></th>"; 
echo "<th class='specalt'><b>Student Name</b></th>";
echo "<th class='specalt'><b>Team Lead Name</b></th>";  
echo "<th class='specalt'><b>Team Lead ID</b></th>"; 
echo "<th class='specalt'><b>Booked Date</b></th>"; 
echo "<th class='specalt'><b>Signup Date</b></th>"; 

echo "<th class='specalt'><b>Dues</b></th>"; 

echo "<th class='specalt'><b>Status(Old)</b></th>"; 

echo "<th class='specalt'><b>Status(Current)</b></th>"; 

echo "<th class='specalt' colspan=3><b>Actions</b></th>";*/ 
echo "</tr>"; 


////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//TEACHER TEAMLEAD TODAY, OVERALL and FILTERED STATUS REPORT
////////////////////////////////////////////////////////////////////////////////////////////////////////////////	

	echo "<br><br><br>";
	echo "<div align='center' style='color:red; font-size:16px'>TEACHER TEAMLEAD SUMMARY</div>";
	echo $_LIST['systemdate']."<br>";
	//TEACHER TEAMLEAD COUNT
	//QUERY FOR TOTAL TEAMLEAD COUNT(NUMBER OF TEAMLEADS)
	$result_sql="SELECT capmus_users.id as cs_id,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId,count(capmus_users.id) as cnt 
	FROM capmus_users 
	WHERE capmus_users.user_type=8 GROUP BY capmus_users.user_type";
	
	$result=mysql_query($result_sql) or die(mysql_error());
	while($row_count_teamlead_total = mysql_fetch_array($result))
	{ 
		echo "<b><div style='float:left'>". getData(nl2br( $row_count_teamlead_total['user_type']),'userType') . " : " . $row_count_teamlead_total['cnt']."</b>&nbsp;&nbsp;&nbsp;";
		echo "<hr><hr>";
	}

	
	//QUERY FOR GETTING TEACHER TEAMLEAD ID's from capmus_users
	$result1_sql="SELECT capmus_users.id as cs_id2,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId 
	FROM capmus_users 
	WHERE capmus_users.user_type=8";
	$result1=mysql_query($result1_sql);
	
	
	$result2_sql="SELECT capmus_users.id as cs_id2,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId 
	FROM capmus_users 
	WHERE capmus_users.user_type=8";
	$result2=mysql_query($result2_sql);
	//echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
	
	$str_arr=array();
	$str_arr_oneday=array();
	$str_arr_allday=array();
	$str_arr_10day=array();
	

	
	echo "<div align='left' style='color:green; font-size:16px'>Today Status</div>";
	while($row_count_teamlead_id_one = mysql_fetch_array($result1))
	
	{
		 echo $string_teacherTL_name_oneday=nl2br( $row_count_teamlead_id_one['firstName']) . " " . nl2br( $row_count_teamlead_id_one['lastName'])."---";
		
		 echo $string_status_oneday_trial=teamlead_teacher_collective_count_summary($row_count_teamlead_id_one['cs_id2'],1)." , ";
		
		 echo $string_status_oneday_regular=teamlead_teacher_collective_count_summary($row_count_teamlead_id_one['cs_id2'],5);
		
		$str_arr_oneday[]="<br />".$string_teacherTL_name_oneday."  ".$string_status_oneday_trial."  ".$string_status_oneday_regular;
		
		echo "<hr>";
		
	}

	echo "<br><br><br>";
	$complete_teacher_teamlead_string_oneday = implode("\r\n",$str_arr_oneday);
	
	
	echo "<div align='left' style='color:green; font-size:16px'>Overall Status</div>";	
	while($row_count_teamlead_id_all = mysql_fetch_array($result2))
	
	{
		 echo $string_teacherTL_name_allday=nl2br( $row_count_teamlead_id_all['firstName']) . " " . nl2br( $row_count_teamlead_id_all['lastName'])."---";
		
		 echo $string_status_allday=teamlead_teacher_collective_count_summary($row_count_teamlead_id_all['cs_id2'],3);
		
		$str_arr_allday[]="<br />".$string_teacherTL_name_allday."  ".$string_status_allday;
		
		echo "<hr>";
		
	}

	echo "<br><br><br>";
	$complete_teacher_teamlead_string_allday = implode("\r\n",$str_arr_allday);
?>	


<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;<?php echo "TRIAL FILTER DATES - ";
echo getInput(stripslashes($_POST['fromDate_TTL_datebook']),'fromDate_TTL_datebook','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate_TTL_datebook']),'toDate_TTL_datebook','class=flexy_datepicker_input');?>&nbsp;&nbsp;

&nbsp;&nbsp;<?php echo "REGULAR FILTER DATES - ";
echo getInput(stripslashes($_POST['fromDate_TTL_duedate']),'fromDate_TTL_duedate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate_TTL_duedate']),'toDate_TTL_duedate','class=flexy_datepicker_input');?>&nbsp;&nbsp;


&nbsp;&nbsp;<!--<input type="submit" class="button" name="submit" value="Filter"></form><br>-->


<?php
echo "<div align='left' style='color:green; font-size:16px'>Filtered Status</div>";
if((!empty($_POST['fromDate_TTL_datebook']) && !empty($_POST['toDate_TTL_datebook'])) || (!empty($_POST['fromDate_TTL_duedate']) && !empty($_POST['toDate_TTL_duedate'])))
{
	//QUERY FOR NAME and STATUS BETWEEN FILTERED DATES
	$result3_sql="SELECT capmus_users.id as cs_id2,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId 
	FROM capmus_users 
	WHERE capmus_users.user_type=8";
	$result3=mysql_query($result3_sql);
		
	while($row_count_teamlead_id_10 = mysql_fetch_array($result3))
	
	{
		 echo $string_teacherTL_name_10day=nl2br( $row_count_teamlead_id_10['firstName']) . " " . nl2br( $row_count_teamlead_id_10['lastName'])."---";
		
		 echo $string_status_10day_datebook=teamlead_teacher_collective_count_summary($row_count_teamlead_id_10['cs_id2'],2)." , ";
		 
		 echo $string_status_10day_duedate=teamlead_teacher_collective_count_summary($row_count_teamlead_id_10['cs_id2'],4);

		$str_arr_10day[]="<br />". $string_teacherTL_name_10day."  ".$string_status_10day_datebook."  ".$string_status_10day_duedate;
		
		echo "<hr>";
		
	}
}
	echo "<br><br><br>";
	$complete_teacher_teamlead_string_10day = implode("\r\n",$str_arr_10day);
	
	$all_TTL="\r\n <br /><b>Today status:: </b>".$complete_teacher_teamlead_string_oneday."\r\n <br /><b> Overall Status:: </b>".$complete_teacher_teamlead_string_allday . "\r\n <br /><b> Filtered Status:: </b>" . $complete_teacher_teamlead_string_10day;
	
	echo "<div  style='color:red'>TOTAL COUNT</div>";
	teamlead_teacher_overall_count_summary();

	
	
	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//AGENT TEAMLEAD TODAY, OVERALL and FILTERED STATUS REPORT
////////////////////////////////////////////////////////////////////////////////////////////////////////////////		
	echo "<br><br><br>";
	echo "<div align='center' style='color:red; font-size:16px'>AGENT TEAMLEAD SUMMARY</div>";

	//AGENT TEAMLEAD COUNT
	//QUERY FOR TOTAL TEAMLEAD COUNT(NUMBER OF TEAMLEADS)
	$result_agent_sql="SELECT capmus_users.id as cs_id_a,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId,count(capmus_users.id) as cnt_a 
	FROM capmus_users 
	WHERE capmus_users.user_type=9 GROUP BY capmus_users.user_type";
	
	$result_agent=mysql_query($result_agent_sql) or die(mysql_error());
	while($row_count_teamlead_agent_total = mysql_fetch_array($result_agent))
	{ 
		echo "<br><b><div style='float:left'>". getData(nl2br( $row_count_teamlead_agent_total['user_type']),'userType') . " : " . $row_count_teamlead_agent_total['cnt_a']."</b>&nbsp;&nbsp;&nbsp;";
		echo "<hr><hr>";
	}
	
	
	//QUERY FOR GETTING AGENT TEAMLEAD ID's from capmus_users
	$result_agent1_sql="SELECT capmus_users.id as cs_id2_a,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId 
	FROM capmus_users 
	WHERE capmus_users.user_type=9";
	$result_agent1=mysql_query($result_agent1_sql);
	
	$result_agent2_sql="SELECT capmus_users.id as cs_id2_a,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId 
	FROM capmus_users 
	WHERE capmus_users.user_type=9";
	$result_agent2=mysql_query($result_agent2_sql);
	
	
	$str_arr=array();
	$str_arr_agent_oneday=array();
	$str_arr_agent_allday=array();
	$str_arr_agent_10day=array();
	
	
	/*while($row_count_teamlead_agent_id = mysql_fetch_array($result_agent1))
	
	{
		echo "<br><b><div style='float:left'>".nl2br( $row_count_teamlead_agent_id['firstName']) . " " . nl2br( $row_count_teamlead_agent_id['lastName'])."</b>";  
		teamlead_agent_collective_count_summary($row_count_teamlead_agent_id['cs_id2_a']);
	}*/
	
	echo "<div align='left' style='color:green; font-size:16px'>Today Status</div>";
	while($row_count_teamlead_agent_id_one = mysql_fetch_array($result_agent1))
	
	{
		 echo $string_agentTL_name_oneday=nl2br( $row_count_teamlead_agent_id_one['firstName']) . " " . nl2br( $row_count_teamlead_agent_id_one['lastName'])."---";
		
		 echo $string_agentTL_status_oneday_trial=teamlead_agent_collective_count_summary($row_count_teamlead_agent_id_one['cs_id2_a'],1)." , ";
		
		 echo $string_agentTL_status_oneday_regular=teamlead_agent_collective_count_summary($row_count_teamlead_agent_id_one['cs_id2_a'],5);
		
		$str_arr_agent_oneday[]="<br />".$string_agentTL_name_oneday."  ".$string_agentTL_status_oneday_trial."  ".$string_agentTL_status_oneday_regular;
		
		echo "<hr>";
		
	}
	echo "<br><br><br>";
	$complete_agent_teamlead_string_oneday = implode("\r\n",$str_arr_agent_oneday);
	
	
	echo "<div align='left' style='color:green; font-size:16px'>Overall Status</div>";
	while($row_count_teamlead_agent_id_all = mysql_fetch_array($result_agent2))
	
	{
		 echo $string_agentTL_name_allday=nl2br( $row_count_teamlead_agent_id_all['firstName']) . " " . nl2br( $row_count_teamlead_agent_id_all['lastName'])."---";
		
		 echo $string_agentTL_status_allday=teamlead_agent_collective_count_summary($row_count_teamlead_agent_id_all['cs_id2_a'],3);
		
		$str_arr_agent_allday[]="<br />".$string_agentTL_name_allday."  ".$string_agentTL_status_allday;
		
		echo "<hr>";
		
	}
	echo "<br><br><br>";
	$complete_agent_teamlead_string_allday = implode("\r\n",$str_arr_agent_allday);
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;<?php echo "TRIAL FILTER DATES - "; 
echo getInput(stripslashes($_POST['fromDate_ATL_datebook']),'fromDate_ATL_datebook','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate_ATL_datebook']),'toDate_ATL_datebook','class=flexy_datepicker_input');?>&nbsp;&nbsp;

&nbsp;&nbsp;<?php echo "REGULAR FILTER DATES - "; 
echo getInput(stripslashes($_POST['fromDate_ATL_duedate']),'fromDate_ATL_duedate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate_ATL_duedate']),'toDate_ATL_duedate','class=flexy_datepicker_input');?>&nbsp;&nbsp;

&nbsp;&nbsp;<!--<input type="submit" class="button" name="submit" value="Filter ">-->
</form><br>

<?php

echo "<div align='left' style='color:green; font-size:16px'>Filtered Status</div>";
if((!empty($_POST['fromDate_ATL_datebook']) && !empty($_POST['toDate_ATL_datebook'])) || (!empty($_POST['fromDate_ATL_duedate']) && !empty($_POST['toDate_ATL_duedate'])))
{
	$result_agent3_sql="SELECT capmus_users.id as cs_id2_a,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId 
	FROM capmus_users 
	WHERE capmus_users.user_type=9";
	$result_agent3=mysql_query($result_agent3_sql);
	
	while($row_count_teamlead_agent_id_10 = mysql_fetch_array($result_agent3))
	
	{
		 echo $string_agentTL_name_10day=nl2br( $row_count_teamlead_agent_id_10['firstName']) . " " . nl2br( $row_count_teamlead_agent_id_10['lastName'])."---";
		
		 echo $string_agentTL_status_10day_datebook=teamlead_agent_collective_count_summary($row_count_teamlead_agent_id_10['cs_id2_a'],2)." , ";
		
		 echo $string_agentTL_status_10day_duedate=teamlead_agent_collective_count_summary($row_count_teamlead_agent_id_10['cs_id2_a'],4);
		
		$str_arr_agent_10day[]="<br />".$string_agentTL_name_10day."  ".$string_agentTL_status_10day_datebook."  ".$string_agentTL_status_10day_duedate;
		
		echo "<hr>";
		
	}
}	
	echo "<br><br><br>";
	$complete_agent_teamlead_string_10day = implode("\r\n",$str_arr_agent_10day);
	
	$all_ATL="\r\n <br /><b>Today status:: </b>".$complete_agent_teamlead_string_oneday."\r\n <br /><b> Overall Status:: </b>".$complete_agent_teamlead_string_allday . "\r\n <br /><b> Filtered Status:: </b>" . $complete_agent_teamlead_string_10day;
	
	
	echo "<br><br><br>";
	echo "<div  style='color:red'>TOTAL COUNT</div>";
	teamlead_agent_overall_count_summary();

while($row = mysql_fetch_array($result)){ 
$sum=$row['dues'];

$sum_dues[$row['sch_id']]=$sum;


//foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['firstName']) . " " . nl2br( $row['lastName']) . "</td>";  
  
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>"; 

//echo "<td valign='top'>" . $_POST['search-teacher2'] . "</td>"; 

echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['LeadId']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['dateBooked']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['duedate']) . "</td>";  

echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";


echo "<td valign='top'>" . getData(nl2br( $row['std_status_old']),'stdStatusmo-list') . "</td>"; 
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatusmo-list') . "</td>"; 

if(!empty($row['teacherId']))  { 
//echo "<td valign='top'>" . nl2br( $row['startTime']) . "</td>";
}
else
{
	//echo "<td valign='top'></td>";

	}
 
if(!empty($row['teacherId']))  {
//echo "<td valign='top'>" . showUser(nl2br( $row['teacherId'])) . "</td>";
}
else
{
	//echo "<td valign='top'></td>";

	}
 
//echo "<td valign='top'><a class=button href=#.php?id=#>Edit</a></td><td>";

//echo "</td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=#?id=#>Delete</a></td> "; 
echo "</tr>"; 
}

echo "<tr>";  


 
echo "</table>"; 



echo "<a href=# class=button>New Row</a>";
?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter ALL">
<?php include('include/footer.php');?>
</form>
<form action='' method='POST'> 

<!--<div id="label"></div><div id="field"><label type='text' id='teamlead_summary' name='teamlead_summary' value='<? //echo $complete_string; ?>'><? //echo $complete_string; ?> </label></div>-->

<div id="label"></div><div id="field"><textarea id='teamlead_summary' name='teamlead_summary'><?php echo "<br/><span style='color:blue; font-size:16px'>TeacherTL</span>".$all_TTL."\r\n <br/><span style='color:blue; font-size:16px'>AgentTL</span>".$all_ATL; ?> </textarea> </div>

<div id="label"></div><div id="field"><input name="sender" type="button" id="sender" value="Send Teacher Teamlead Summary" onclick="javascript: send_teacher_teamlead_summary()" /> </div>

<div id="ajaxdiv_summary"></div>
</form>