<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
&nbsp;&nbsp;
<?php 
//getAgentFilter();
//getTeacherFilterLead();
//getAgentFilterLead();
?></div>
<div style="float:left">
<?php
//getAdminFilter();
//getSuperAdminFilter();
getlogscheduleFilter();
getFilterSubmit();
?></div>
<br>

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
echo "</tr>"; 

if(isset($_POST['search-submit']))
{
	if(($_SESSION['userId']==1 || $_SESSION['userId']==159) && ($_POST['log_schedule']==5 || $_POST['log_schedule']==6 || $_POST['log_schedule']==12 || $_POST['log_schedule']==2 || $_POST['log_schedule']==3 || $_POST['log_schedule']==19))
	{
		$result=logging_list_DEAD();
		$rowcount = mysql_num_rows($result);
	}
	else if($_SESSION['userId']==48 && $_POST['log_schedule']==6)
	{
		$result=logging_list_DEAD();
		$rowcount = mysql_num_rows($result);
	}
	else
	{
		echo "<div align='center' style='color:red; font-size:16px'>Only DEAD_SCHEDULE List Allowed</div>";
	}
}
else
{
	echo "<div align='center' style='color:red; font-size:16px'>Apply proper filters</div>";
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

 
include('include/footer.php');
?>