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
</form>
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


	echo "<br><br><br>";
	echo "<div align='center' style='color:red; font-size:16px'>TEACHER TEAMLEAD SUMMARY</div>";

	//TEACHER TEAMLEAD COUNT
	//QUERY FOR TOTAL TEAMLEAD COUNT(NUMBER OF TEAMLEADS)
	$result_sql="SELECT capmus_users.id as cs_id,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId,count(capmus_users.id) as cnt 
	FROM capmus_users 
	WHERE capmus_users.user_type=8 GROUP BY capmus_users.user_type";
	
	$result=mysql_query($result_sql) or die(mysql_error());
	while($row_count_teamlead_total = mysql_fetch_array($result))
	{ 
		echo "<br><b><div style='float:left'>". getData(nl2br( $row_count_teamlead_total['user_type']),'userType') . " : " . $row_count_teamlead_total['cnt']."</b>&nbsp;&nbsp;&nbsp;";
		echo "<hr><hr>";
	}
	
	
	//QUERY FOR GETTING TEAMLEAD ID's from capmus_users
	$result2_sql="SELECT capmus_users.id as cs_id2,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId 
	FROM capmus_users 
	WHERE capmus_users.user_type=8";
	$result2=mysql_query($result2_sql);
	//echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
	while($row_count_teamlead_id = mysql_fetch_array($result2))
	
	{
		//echo "<tr>"; 
		echo "<br><b><div style='float:left'>".nl2br( $row_count_teamlead_id['firstName']) . " " . nl2br( $row_count_teamlead_id['lastName'])."</b>";  
		teamlead_teacher_collective_count_summary($row_count_teamlead_id['cs_id2']);
		//echo "</tr>";
	}
	//echo "</table>";
	echo "<br><br><br>";
	echo "<div  style='color:red'>TOTAL COUNT</div>";
	teamlead_teacher_overall_count_summary();


	
	
	
	echo "<br><br><br>";
	echo "<div align='center' style='color:red; font-size:16px'>AGENT TEAMLEAD SUMMARY</div>";
	
	
	
	
	//AGENT TEAMLEAD COUNT
	$result_agent_sql="SELECT capmus_users.id as cs_id_a,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId,count(capmus_users.id) as cnt_a 
	FROM capmus_users 
	WHERE capmus_users.user_type=9 GROUP BY capmus_users.user_type";
	
	$result_agent=mysql_query($result_agent_sql) or die(mysql_error());
	while($row_count_teamlead_agent_total = mysql_fetch_array($result_agent))
	{ 
		echo "<br><b><div style='float:left'>". getData(nl2br( $row_count_teamlead_agent_total['user_type']),'userType') . " : " . $row_count_teamlead_agent_total['cnt_a']."</b>&nbsp;&nbsp;&nbsp;";
		echo "<hr><hr>";
	}
	
	
	//QUERY FOR GETTING TEAMLEAD ID's from capmus_users
	$result_agent2_sql="SELECT capmus_users.id as cs_id2_a,capmus_users.firstName,capmus_users.lastName,capmus_users.user_type,capmus_users.LeadId 
	FROM capmus_users 
	WHERE capmus_users.user_type=9";
	$result_agent2=mysql_query($result_agent2_sql);
	//echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
	while($row_count_teamlead_agent_id = mysql_fetch_array($result_agent2))
	
	{
		//echo "<tr>"; 
		echo "<br><b><div style='float:left'>".nl2br( $row_count_teamlead_agent_id['firstName']) . " " . nl2br( $row_count_teamlead_agent_id['lastName'])."</b>";  
		teamlead_agent_collective_count_summary($row_count_teamlead_agent_id['cs_id2_a']);
		//echo "</tr>";
	}
	//echo "</table>";
	echo "<br><br><br>";
	echo "<div  style='color:red'>TOTAL COUNT</div>";
	teamlead_agent_overall_count_summary();





//}

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
<?php include('include/footer.php');?>