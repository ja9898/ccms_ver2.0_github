<? 
include('config.php');
include('include/header.php'); 
//BEST EXAMPLE TO Group by two columns and sum(Google search-how to group by two columns in sql php and sum the values?) 
//http://stackoverflow.com/questions/11025623/mysql-group-by-two-columns-and-sum

//Just for reference-NOT THAT USEFUL(how to show teacher one in mysql and group by on subject and status)
//http://stackoverflow.com/questions/8411116/mysql-display-all-records-and-count-related-records
//http://stackoverflow.com/questions/9954697/mysql-group-by-subject
//http://learn.shayhowe.com/html-css/organizing-data-tables
?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">




<div style="float:left"><?php 
getStatusFilter_with_makeover();
getTeacherFilterLead();
 ?></div>
<div style="float:left">
<?php
?>
<div style="float:left">
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
&nbsp;&nbsp;
</div>
<?php
getFilterSubmit();
?></div>
<br>
</form>
</div>
<?


//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());

if($_SESSION['userType']==5)
{
	$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and status_dead=0 and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch,campus_schedule.dues as dues'); 
}


//MANAGE SCHEDULE AND FILTER ONLY FOR TEACHER TEAMLEADS
else if($_SESSION['userType']==8)
{
	//$result = getResultResource_teamlead($_table='campus_schedule',$_post="",$_where="",$join='',$joinFields='',$joinWhere='',$joinselect="INNER JOIN capmus_users ON capmus_users.LeadId='".$_SESSION['userId']."' and capmus_users.id=campus_schedule.teacherID and campus_schedule.status=1 and campus_schedule.teacherID!=0 and campus_schedule.std_status!='3'",$orderby="ORDER BY campus_schedule.teacherID asc",$_fields="capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.std_status as statussch,campus_schedule.studentID,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.status,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.agentId,campus_schedule.classType");
	$result = getResultResource_teamlead();
}

else if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0 && $_POST['stdStatus']==3)
{
	
	//OVERALL
	//Following query is for REGULAR CLASS STAT
	$result_regular="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status!=2 and campus_schedule.teacherID!=0 and campus_schedule.std_status_old=2"; 
	if($_POST['search-teacher-id2']!=0)
	{
		$result_regular.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['stdStatus']==3)
	{
		$result_regular.=" and campus_schedule.std_status= '".$_POST['stdStatus']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
	{
		$result_regular.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	
	$result_regular.="  GROUP BY campus_schedule.teacherID,campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc,campus_schedule.teacherID desc";
	$result_regular=mysql_query($result_regular);

	
	
	///////////////////////////////////		MON,TUE,WED		/////////////////////////////////////////
	//Following query is for REGULAR CLASS STAT - MON,TUE,WED
	$result_regular_mon_tue_wed="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status!=2 and campus_schedule.teacherID!=0 and campus_schedule.std_status_old=2 and campus_schedule.classType in (1,3,4,5,6,7)"; 
	if($_POST['search-teacher-id2']!=0)
	{
		$result_regular_mon_tue_wed.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['stdStatus']==3)
	{
		$result_regular_mon_tue_wed.=" and campus_schedule.std_status= '".$_POST['stdStatus']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
	{
		$result_regular_mon_tue_wed.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$result_regular_mon_tue_wed.="  GROUP BY campus_schedule.teacherID,campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc,campus_schedule.teacherID desc";
	$result_regular_mon_tue_wed=mysql_query($result_regular_mon_tue_wed);
	
	///////////////////////////////////		THUR,FRI,SAT		/////////////////////////////////////
	//Following query is for REGULAR CLASS STAT - THUR,FRI,SAT
	$result_regular_thur_fri_sat="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status!=2 and campus_schedule.teacherID!=0 and campus_schedule.std_status_old=2 and campus_schedule.classType in (2,4,8,9,10)"; 
	if($_POST['search-teacher-id2']!=0)
	{
		$result_regular_thur_fri_sat.=" and capmus_users.LeadId='".$_POST['search-teacher-id2']."' ";
	}
	if($_POST['stdStatus']==3)
	{
		$result_regular_thur_fri_sat.=" and campus_schedule.std_status= '".$_POST['stdStatus']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="" && $_POST['stdStatus']==3)
	{
		$result_regular_thur_fri_sat.=" and DATE(campus_schedule.dead_date)>= '".prepareDate($_POST['fromDate'])."' and DATE(campus_schedule.dead_date)<= '".prepareDate($_POST['toDate'])."'";
	}
	$result_regular_thur_fri_sat.="  GROUP BY campus_schedule.teacherID,campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc,campus_schedule.teacherID desc";
	$result_regular_thur_fri_sat=mysql_query($result_regular_thur_fri_sat);
}

else{
	//OVERALL
	$result_regular="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId!=0 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=3 and campus_schedule.std_status!=2 and campus_schedule.teacherID!=0 and campus_schedule.std_status_old=2"; 
	$result_regular.="  GROUP BY campus_schedule.teacherID,campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc,campus_schedule.teacherID desc";
	$result_regular=mysql_query($result_regular);
	
	//MON,TUE,WED
	$result_regular_mon_tue_wed="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId!=0 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=3 and campus_schedule.std_status!=2 and campus_schedule.teacherID!=0 and campus_schedule.std_status_old=2 and campus_schedule.classType in (1,3,4,5,6,7)"; 
	$result_regular_mon_tue_wed.="  GROUP BY campus_schedule.teacherID,campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc,campus_schedule.teacherID desc";
	$result_regular_mon_tue_wed=mysql_query($result_regular_mon_tue_wed);
	
	//THUR,FRI,SAT
	$result_regular_thur_fri_sat="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.studentID) as cnt_regular,campus_schedule.status,SUM(campus_schedule.dues) as dues,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType 
	FROM capmus_users 
	INNER JOIN campus_schedule 
	ON capmus_users.LeadId!=0 
	and capmus_users.id=campus_schedule.teacherID and campus_schedule.std_status=3 and campus_schedule.std_status!=2 and campus_schedule.teacherID!=0 and campus_schedule.std_status_old=2 and campus_schedule.classType in (2,4,8,9,10)"; 
	$result_regular_thur_fri_sat.="  GROUP BY campus_schedule.teacherID,campus_schedule.std_status ORDER BY SUM(campus_schedule.dues) desc,campus_schedule.std_status asc,campus_schedule.teacherID desc";
	$result_regular_thur_fri_sat=mysql_query($result_regular_thur_fri_sat);
	
	
	}


//Get 1 cad to usd rate from db
$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];

///////////////////////////////////		MON,TUE,WED		/////////////////////////////////////
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>Serial</b></th>";    
echo "<th class='specalt'><b>TeamLead</b></th>";    
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th colspan=1 class='specalt'><b>status</b></th>";  
echo "<th colspan=1 class='specalt'><b>Business</b></th>"; 
echo "<th colspan=1 class='specalt'><b>Business-USD</b></th>"; 
echo "</tr>"; 

echo "<tr>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<th class='specalt' style='color:blue;'><b>DEAD(MON,TUE,WED)</b></th>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
echo "</tr>"; 
//FOR CAD
$total_regular_sum_array_mon_tue_wed=array();
$total_amount_sum_array_mon_tue_wed=array();
//FOR USD
$total_amount_sum_array_mon_tue_wed_usd=array();

$x_xbar_square_array=array();

//Counting number of rows teamlead wise to get teacher count
$cnt_rows_teamlead_wise_mon_tue_wed = mysql_num_rows($result_regular_mon_tue_wed);
//Added for serial number
$serial=0;

while(($row_regular_mon_tue_wed = mysql_fetch_array($result_regular_mon_tue_wed)))
{ 
//FOR CAD
$total_regular_sum_array_mon_tue_wed[$row_regular_mon_tue_wed['sch_id']] = $row_regular_mon_tue_wed['cnt_regular'];
$total_amount_sum_array_mon_tue_wed[$row_regular_mon_tue_wed['sch_id']] = $row_regular_mon_tue_wed['dues'];
//FOR USD
$total_amount_sum_array_mon_tue_wed_usd[$row_regular_mon_tue_wed['sch_id']] = round($row_regular_mon_tue_wed['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);

//FOR CAD
$total_amount_per_teacher_mon_tue_wed = $row_regular_mon_tue_wed['dues'];
//FOR USD
$total_amount_per_teacher_mon_tue_wed_usd = round($row_regular_mon_tue_wed['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
//FOR Serial = serial + 1
$serial=$serial+1;

echo "<tr>";
echo "<td valign='top'>" . $serial . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row_regular_mon_tue_wed['LeadId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row_regular_mon_tue_wed['firstName']) . " " . nl2br( $row_regular_mon_tue_wed['lastName']) . "</td>";
echo "<td valign='top'>" . $row_regular_mon_tue_wed['cnt_regular'] . "</td>";
echo "<td valign='top'>$ " . $row_regular_mon_tue_wed['dues'] . "</td>";
echo "<td valign='top'>$ " . round($row_regular_mon_tue_wed['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
echo "</tr>"; 
}
echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:blue;'><b>" . nl2br( array_sum($total_regular_sum_array_mon_tue_wed)) . "</td>";
//echo "<td valign='top'> </td>"; 
//echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:blue;'><b>$" . nl2br( array_sum($total_amount_sum_array_mon_tue_wed)) . "</td>";   
echo "<td valign='top' style='color:blue;'><b>$" . nl2br( array_sum($total_amount_sum_array_mon_tue_wed_usd)) . "</td>";   
//FOR CAD
$total_reg_classes_mon_tue_wed = nl2br( array_sum($total_regular_sum_array_mon_tue_wed));
$total_dollar_amount_of_reg_classes_mon_tue_wed = nl2br( array_sum($total_amount_sum_array_mon_tue_wed));
//FOR USD
$total_dollar_amount_of_reg_classes_mon_tue_wed_usd = nl2br( array_sum($total_amount_sum_array_mon_tue_wed_usd));
echo "</tr>";
echo "</table>"; 



///////////////////////////////////		THUR,FRI,SAT		/////////////////////////////////////
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>Serial</b></th>";    
echo "<th class='specalt'><b>TeamLead</b></th>";    
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th colspan=1 class='specalt'><b>status</b></th>";  
echo "<th colspan=1 class='specalt'><b>Business</b></th>"; 
echo "<th colspan=1 class='specalt'><b>Business-USD</b></th>"; 
echo "</tr>"; 

echo "<tr>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<th class='specalt' style='color:blue;'><b>DEAD(THUR,FRI,SAT)</b></th>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
echo "</tr>"; 
//FOR CAD
$total_regular_sum_array_thur_fri_sat=array();
$total_amount_sum_array_thur_fri_sat=array();
//FOR USD
$total_amount_sum_array_thur_fri_sat_usd=array();

$x_xbar_square_array=array();

//Counting number of rows teamlead wise to get teacher count
$cnt_rows_teamlead_wise_thur_fri_sat = mysql_num_rows($result_regular_thur_fri_sat);
//Added for serial number
$serial=0;

while(($row_regular_thur_fri_sat = mysql_fetch_array($result_regular_thur_fri_sat)))
{
//FOR CAD 
$total_regular_sum_array_thur_fri_sat[$row_regular_thur_fri_sat['sch_id']] = $row_regular_thur_fri_sat['cnt_regular'];
$total_amount_sum_array_thur_fri_sat[$row_regular_thur_fri_sat['sch_id']] = $row_regular_thur_fri_sat['dues'];
//FOR USD
$total_amount_sum_array_thur_fri_sat_usd[$row_regular_thur_fri_sat['sch_id']] = round($row_regular_thur_fri_sat['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);

//FOR CAD
$total_amount_per_teacher_thur_fri_sat = $row_regular_thur_fri_sat['dues'];
//FOR USD
$total_amount_per_teacher_thur_fri_sat_usd = round($row_regular_thur_fri_sat['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
//FOR Serial = serial + 1
$serial=$serial+1;

echo "<tr>";
echo "<td valign='top'>" . $serial . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row_regular_thur_fri_sat['LeadId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row_regular_thur_fri_sat['firstName']) . " " . nl2br( $row_regular_thur_fri_sat['lastName']) . "</td>";
echo "<td valign='top'>" . $row_regular_thur_fri_sat['cnt_regular'] . "</td>";
echo "<td valign='top'>$ " . $row_regular_thur_fri_sat['dues'] . "</td>";
echo "<td valign='top'>$ " . round($row_regular_thur_fri_sat['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
echo "</tr>"; 
}
echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:blue;'><b>" . nl2br( array_sum($total_regular_sum_array_thur_fri_sat)) . "</td>";
//echo "<td valign='top'> </td>"; 
//echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:blue;'><b>$" . nl2br( array_sum($total_amount_sum_array_thur_fri_sat)) . "</td>";   
echo "<td valign='top' style='color:blue;'><b>$" . nl2br( array_sum($total_amount_sum_array_thur_fri_sat_usd)) . "</td>";   
//FOR CAD
$total_reg_classes_thur_fri_sat = nl2br( array_sum($total_regular_sum_array_thur_fri_sat));
$total_dollar_amount_of_reg_classes_thur_fri_sat = nl2br( array_sum($total_amount_sum_array_thur_fri_sat));
//FOR USD
$total_dollar_amount_of_reg_classes_thur_fri_sat_usd = nl2br( array_sum($total_amount_sum_array_thur_fri_sat_usd));
echo "</tr>";
echo "</table>"; 

//// MON,TUE,WED and THUR,FRI,SAT (Regular classes SUM AND DOLLAR SUM/////////////////////////////
$total_regular_classes = $total_reg_classes_mon_tue_wed + $total_reg_classes_thur_fri_sat;
//FOR CAD
$total_dollars = $total_dollar_amount_of_reg_classes_mon_tue_wed + $total_dollar_amount_of_reg_classes_thur_fri_sat;
//FOR USD
$total_dollars_usd = $total_dollar_amount_of_reg_classes_mon_tue_wed_usd + $total_dollar_amount_of_reg_classes_thur_fri_sat_usd;
//Table for Mean business per teacher
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
	echo "<tr>";
		echo "<td valign='top'> </td>";
		echo "<td valign='top'> </td>";
		echo "<td valign='top' style='color:blue;'><b>".$total_regular_classes."</b></td>";
		echo "<td valign='top' style='color:blue;'><b>$".$total_dollars."</b></td>";
		echo "<td valign='top' style='color:blue;'><b>$".$total_dollars_usd."</b></td>";
	echo "</tr>";
echo "</table>"; 



///////////////////////////////////		OVERALL		/////////////////////////////////////////

echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>Serial</b></th>";    
echo "<th class='specalt'><b>TeamLead</b></th>";    
echo "<th class='specalt'><b>Teacher</b></th>"; 
echo "<th colspan=1 class='specalt'><b>status</b></th>";  
echo "<th colspan=1 class='specalt'><b>Business</b></th>"; 
echo "<th colspan=1 class='specalt'><b>Business-USD</b></th>"; 
echo "</tr>"; 

echo "<tr>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
	echo "<th class='specalt' style='color:red;'><b>DEAD(OVERALL)</b></th>";
	echo "<td valign='top'> </td>";
	echo "<td valign='top'> </td>";
echo "</tr>"; 
//FOR CAD
$total_regular_sum_array=array();
$total_amount_sum_array=array();
//FOR USD
$total_amount_sum_array_usd=array();

$x_xbar_square_array=array();

//Counting number of rows teamlead wise to get teacher count
$cnt_rows_teamlead_wise = mysql_num_rows($result_regular);
//Added for serial number
$serial=0;

while(($row_regular = mysql_fetch_array($result_regular)))
{ 
//FOR CAD
$total_regular_sum_array[$row_regular['sch_id']] = $row_regular['cnt_regular'];
$total_amount_sum_array[$row_regular['sch_id']] = $row_regular['dues'];
//FOR USD
$total_amount_sum_array_usd[$row_regular['sch_id']] = round($row_regular['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);

//FOR CAD
$total_amount_per_teacher = $row_regular['dues'];
//FOR USD
$total_amount_per_teacher_usd = round($row_regular['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']);
//FOR Serial = serial + 1
$serial=$serial+1;

echo "<tr>";
echo "<td valign='top'>" . $serial . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row_regular['LeadId'])) . "</td>";
echo "<td valign='top'>" . nl2br( $row_regular['firstName']) . " " . nl2br( $row_regular['lastName']) . "</td>";
echo "<td valign='top'>" . $row_regular['cnt_regular'] . "</td>";
echo "<td valign='top'>$ " . $row_regular['dues'] . "</td>";
echo "<td valign='top'>$ " . round($row_regular['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd']) . "</td>";
echo "</tr>"; 
}
echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red;'><b>" . nl2br( array_sum($total_regular_sum_array)) . "</td>";

echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($total_amount_sum_array)) . "</td>";   
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($total_amount_sum_array_usd)) . "</td>";   
$total_reg_classes= nl2br( array_sum($total_regular_sum_array));
$total_dollar_amount_of_reg_classes = nl2br( array_sum($total_amount_sum_array));
echo "</tr>";
echo "</table>"; 







include('include/footer.php');
?>