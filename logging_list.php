<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 
echo " <a href='logging_list_DEAD.php'>DEAD_SCHEDULE_LIST</a> ";
//getStudentFilter();
//getTeacherFilter();
getAgentFilter();
getTeacherFilterLead();
getAgentFilterLead();
//getStartTimeFilter(); ?></div>
<div style="float:left">
<?php
getAdminFilter();
getSuperAdminFilter();
//getPlanFilter();
//getShiftFilter();
//getCourseFilter();
//getStatusFilter_with_makeover();
getlogscheduleFilter();
getFilterSubmit();
?></div>
<br>
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','stdStatus','stdStatusmo-list');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
</div>
<?

//BEST PAGING CODE FOR PHP PAGES
//http://php.about.com/od/phpwithmysql/ss/php_pagination.htm

//**********
//FOLLOWING LINK SOLVED MY PROBLEM BY SELF POSTING ---$_SERVER[PHP_SELF]--- and then GETTING THE VALUE ON THE SAME PAGE
//$_GET['pagenum']; Also by commenting the "456456" concatenated with ---$pagenum = $_GET['pagenum']."456456";---
//http://www.webmasterworld.com/php/4477092.htm
//**********//


if (!(isset($_GET['pagenum']))) 

 { 

$pagenum = 1 ; 

 } 
 
else
{
$pagenum = $_GET['pagenum'];
} 

 

 //Here we count the number of results 

 //Edit $data to be your query 

 $data = mysql_query("SELECT * FROM campus_user_log") or die(mysql_error()); 

 $rows = mysql_num_rows($data); 

 

 //This is the number of results displayed per page 

 $page_rows = 1000; 

 

 //This tells us the page number of our last page 

 $last = floor($rows/$page_rows); 

 

 //this makes sure the page number isn't below one, or more than our maximum pages 

 if ($pagenum < 1) 

 { 

 $pagenum = 1; 

 } 

 elseif ($pagenum > $last) 

 { 

 $pagenum = $last; 

 } 

 

 //This sets the range to display in our query 
//FOR SUPER ADMIN - CCMS Administrator		//CCMS ADMIN
if($_SESSION['userId']==159)
{
$max = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
}
//FOR SUPER ADMIN - CCMS Non-Administrator	//CCMS NON-ADMIN
else if($_SESSION['userId']==48 && $pagenum = $last-2)
{
$max2 = 'limit ' .($pagenum - 1) * $page_rows .',' .$page_rows;
}
else
{
echo "Restricted Area";
}
 
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>ID</b></th>"; 
echo "<th class='specalt'><b>User Name</b></th>"; 
echo "<th class='specalt'><b>User Type</b></th>"; 
echo "<th class='specalt'><b>Date & Time</b></th>"; 
echo "<th class='specalt'><b>Page Name</b></th>"; 
echo "<th class='specalt'><b>Action Performed</b></th>"; 
echo "<th class='specalt'><b>Previous Value</b></th>";
echo "<th class='specalt'><b>New Value</b></th>"; 
echo "<th class='specalt'><b>Comments(For Being Dead)</b></th>"; 
//echo "<th class='specalt'><b>Status</b></th>"; 
//echo "<th class='specalt'><b>Class Days</b></th>"; 

//echo "<th class='specalt' colspan=4><b>Actions</b></th>";  
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());

//////SEARCH AGENT WISE//////
/*if(isset($_POST['search-submit']) && $_POST['search-agent-id']!=0)
{
	//$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch'); 
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,capmus_users.status,
	campus_user_log.* 
	FROM capmus_users 
	INNER JOIN campus_user_log 
	ON campus_user_log.user_id='".$_POST['search-agent-id']."' and capmus_users.id='".$_POST['search-agent-id']."' and capmus_users.user_type=5 and capmus_users.status=1";
	
	
	$result=logging_list();
	
}

//////SEARCH TEACHER TEAMLEAD WISE//////
else if(isset($_POST['search-submit']) && $_POST['search-teacher-id2']!=0)
{
	//$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch'); 
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,capmus_users.status,
	campus_user_log.* 
	FROM capmus_users 
	INNER JOIN campus_user_log 
	ON campus_user_log.user_id='".$_POST['search-teacher-id2']."' and capmus_users.id='".$_POST['search-teacher-id2']."' and capmus_users.user_type=8 and capmus_users.status=1";
	$result=mysql_query($result);
	
}

//////SEARCH AGENT TEAMLEAD WISE//////
else if(isset($_POST['search-submit']) && $_POST['search-agent-id2']!=0)
{
	//$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch'); 
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,capmus_users.status,
	campus_user_log.* 
	FROM capmus_users 
	INNER JOIN campus_user_log 
	ON campus_user_log.user_id='".$_POST['search-agent-id2']."' and capmus_users.id='".$_POST['search-agent-id2']."' and capmus_users.user_type=9 and capmus_users.status=1";
	$result=mysql_query($result);
	
}

//////SEARCH ADMIN WISE//////
else if(isset($_POST['search-submit']) && $_POST['search-admin-id']!=0)
{
	//$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch'); 
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,capmus_users.status,
	campus_user_log.* 
	FROM capmus_users 
	INNER JOIN campus_user_log 
	ON campus_user_log.user_id='".$_POST['search-admin-id']."' and capmus_users.id='".$_POST['search-admin-id']."' and capmus_users.user_type=2 and capmus_users.status=1";
	$result=mysql_query($result);
	
}

//////SEARCH SUPER-ADMIN WISE//////
else if(isset($_POST['search-submit']) && $_POST['search-superadmin-id']!=0)
{
	//$result = getResultResource('campus_schedule',$_POST,"status=1 and campus_schedule.std_status!='3' and agentId='".$_SESSION['userId']."'","",",campus_students.firstName as name,campus_students.std_status as std_status ",""," left JOIN campus_students ON campus_schedule.studentID=campus_students.id  "," order by name asc",'campus_schedule.std_status as statussch'); 
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,capmus_users.status,
	campus_user_log.* 
	FROM capmus_users 
	INNER JOIN campus_user_log 
	ON campus_user_log.user_id='".$_POST['search-superadmin-id']."' and capmus_users.id='".$_POST['search-superadmin-id']."' and capmus_users.user_type=1 and capmus_users.status=1";
	$result=mysql_query($result);
	
}

else{
	$result="SELECT capmus_users.id,capmus_users.firstName,capmus_users.lastName,capmus_users.LeadId,capmus_users.user_type,capmus_users.status,
	campus_user_log.* 
	FROM capmus_users 
	INNER JOIN campus_user_log 
	ON capmus_users.id=campus_user_log.user_id and capmus_users.status=1";
	$result=mysql_query($result);
	}*/
	if($_SESSION['userId']==159)
	{
		$result=logging_list($max);
		$rowcount = mysql_num_rows($result);
	}
	else if($_SESSION['userId']==48)
	{
		$result=logging_list($max2);
		$rowcount = mysql_num_rows($result);
	}
	else
	{
		echo "<div align='center' style='color:red; font-size:16px'>Contact CCMS Administrator for LOG REPORT</div>";
	}
while($row = mysql_fetch_array($result)){ 

foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";   
echo "<td valign='top'>" . showUser(nl2br( $row['user_id'])) . "</td>";  
echo "<td valign='top'>" . getData(nl2br( $row['user_type']),'userType') . "</td>";  
echo "<td valign='top'>" . nl2br( $row['datetime']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['page']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['action']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['pre_value']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['new_value']) . "</td>";   
echo "<td valign='top'>" . nl2br( $row['comments_dead']) . "</td>";   

 

echo "</tr>"; 
} 
echo "</table>"; 

// This shows the user what page they are on, and the total number of pages

 echo " --Page $pagenum of $last-- <p>";

 
 // First we check if we are on page one. If we are then we don't need a link to the previous page or the first page so we do nothing. If we aren't then we generate links to the first page, and to the previous page.

 if ($pagenum == 1) 

 {

 } 

 else 

 {

 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=1'> <<-First</a> ";

 echo " ";

 $previous = $pagenum-1;

 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$previous'> <-Previous</a> ";

 } 


 //just a spacer

 echo " ---- ";


 //This does the same as above, only checking if we are on the last page, and then generating the Next and Last links

 if ($pagenum == $last) 

 {

 } 

 else {
 

 
$next = $pagenum+1;
 
 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$next'>Next -></a> ";

 echo " ";

 echo " <a href='{$_SERVER['PHP_SELF']}?pagenum=$last'>Last ->></a> ";

 } 

 
include('include/footer.php');
?>