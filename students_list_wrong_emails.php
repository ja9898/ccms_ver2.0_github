<?php 
include('config.php'); 
include('include/header.php');
	
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div id="filter">

<?php
getStudentFilter();
getAgentFilter();
getStatusFilter();
getFilterSubmit();
?><div id="field"><?php echo getList('','countryID','country');?> </div> 

<br><br>

</div>
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','std_status','stdStatus');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";
echo "<th class='specalt'><b>Reg No.</b></th>";
echo "<th class='specalt'><b>Ext ID</b></th>"; 
echo "<th class='specalt'><b>Country</b></th>"; 
echo "<th class='specalt'><b>Name</b></th>"; 
echo "<th class='specalt'><b>Agent</b></th>"; 
echo "<th class='specalt'><b>Email</b></th>";
if($_SESSION['userId']==159 || $_SESSION['userId']==195 || $_SESSION['userId']==227)
{ 
echo "<th class='specalt'><b>Phone</b></th>"; 
echo "<th class='specalt'><b>USERNAME</b></th>"; 
echo "<th class='specalt'><b>PASSWORD</b></th>";
}
echo "<th class='specalt'><b>Status</b></th>"; 
echo "<th class='specalt' colspan=3><b>Actions</b></th>"; 
echo "</tr>"; 

/* if(isset($_POST['search-submit']))
{ */
if($_SESSION['userType']==5 && ($_POST['search-student-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['stdStatus']!=0 || $_POST['countryID']!=0))
{
	//$_sql.=" Where agent_id='".$_SESSION['userId']."'";
	$result = getResultResource('campus_students',$_POST," agent_id='".$_SESSION['userId']."'","",",campus_students.id","","");
}
else if(($_SESSION['userType']==9 || $_SESSION['userType']==16) && ($_POST['search-student-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['stdStatus']!=0 || $_POST['countryID']!=0))
{
	$result = getResultResource_teamlead_agent_list_students();
}
//FOR SUPER ADMIN/MTTL/TTL
else if( ($_POST['search-student-id']!=0 || $_POST['search-agent-id']!=0 || $_POST['stdStatus']!=0 || $_POST['countryID']!=0) ){
	//$result =getResultResource('campus_students',$_POST,'1',"",",campus_students.id","",""); 
	//$result2 = ("SELECT * FROM campus_students WHERE campus_students.std_status = '".."' ");
	}
	
else
{

	/* $result = mysql_query("SELECT * FROM campus_students WHERE campus_students.email LIKE '%@ycc%' 
	OR  
	campus_students.email='' "); */
	$sql="SELECT * 
	FROM campus_students as STU 
	INNER JOIN campus_schedule as SCH 
	ON STU.id=SCH.studentID AND SCH.std_status=2 
	AND (STU.email LIKE '%@ycc%' 
	OR  
	STU.email='') ";
	$result = mysql_query($sql);
}
$rowcount = mysql_num_rows($result);echo "<br>";
echo "<br><br><b><div style='float:left'>Total : ".$rowcount." &nbsp;&nbsp;&nbsp;</div><br></b>";
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['reg_id']) . "</td>";
echo "<td valign='top'><a href='vbas-softphone/softphone.php?uid=".$_SESSION['userId']."&number=66".getextID(nl2br( $row['id']))."' target=_blank >" . getextID(nl2br( $row['id'])) . "</a></td>";
echo "<td valign='top'>" . getData(nl2br( $row['countryID']),'country') . "</td>";
//echo "<td valign='top'>" .getData(nl2br( $row['classType']),'plan') . "</td>";    
echo "<td valign='top'>" . nl2br( $row['firstName'])." ".nl2br( $row['lastName']) . "</td>";  
echo "<td valign='top'>" . showUser(nl2br( $row['agent_id'])) . "</td>";  
if($_SESSION['userType']==2){
echo "<td valign='top'>NA</td>";
}else{
echo "<td valign='top'>".$row['email']."</td>"; 
}
if($_SESSION['userId']==159 || $_SESSION['userId']==195 || $_SESSION['userId']==227)
{ 
echo "<td valign='top'>" . nl2br( $row['phone'])."<br>".nl2br( $row['mobile'])."<br>".nl2br( $row['landline']) . "</td>"; 
echo "<td valign='top'>" . nl2br( $row['username']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['password']) . "</td>";
}
echo "<td valign='top'>" . getData(nl2br( $row['std_status']),'stdStatus') . "</td>";
/* echo "<td valign='top'><a class=button href=students_edit.php?id={$row['id']}>Edit</a></td><td>";
echo "</td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=students_delete.php?id={$row['id']}>Delete</a></td> "; */ 
echo "</tr>"; 
} 
/* } */
echo "</table>"; 
echo "<a href=students_new.php class=button>New Row</a>"; 
?>
<?php include('include/footer.php');?>