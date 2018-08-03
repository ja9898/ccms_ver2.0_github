<? 
include('config.php');
include('include/header.php');
?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

<?php if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==15 ) { 
//getTeacherFilterLead_main(); 
getStudentFilter();
getTeacherFilter();
getTeacherFilterLead(); 
} ?>

&nbsp;&nbsp;<?php if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==15) { echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input'); }?>&nbsp;&nbsp;

&nbsp;&nbsp;
<? if($_SESSION['userType']==1 || $_SESSION['userType']==8 || $_SESSION['userType']==15) { 
echo getList('','open_close','open_close');
?> 
<input type="submit" class="button" name="submit" value="Filter">
<? } ?> 
</form>
<br /><br />
</div>

<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt' ><b>Ticket number</b></th>";
echo "<th class='specalt' ><b>Student</b></th>";  
echo "<th class='specalt' ><b>Teacher</b></th>";
echo "<th class='specalt' ><b>TTL</b></th>";
echo "<th class='specalt' ><b>MTTL</b></th>";
echo "<th class='specalt' ><b>Date</b></th>";
echo "<th class='specalt' ><b>Ticket Status</b></th>";
echo "<th class='specalt' colspan=2 ><b>Actions</b></th>";
echo "</tr>"; 

if($_SESSION['userType']==8)
{
	$sql="SELECT * FROM `campus_ticket_new_tn` WHERE ttl='".$_SESSION['userId']."' ";
	if(isset($_POST['submit']) && $_POST['search-student-id']!=0)
	{
		$sql.=" and campus_ticket_new_tn.studentID='".$_POST['search-student-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
	{
		$sql.=" and campus_ticket_new_tn.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql.=" and campus_ticket_new_tn.ttl='".$_POST['search-teacher-id2']."' ";
	}
	if(isset($_POST['submit']) && $_POST['open_close']!=0)
	{
		$sql.=" and campus_ticket_new_tn.open_close='".$_POST['open_close']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.= " and campus_ticket_new_tn.date>='".prepareDate($_POST['fromDate'])."' and campus_ticket_new_tn.date<='".prepareDate($_POST['toDate'])."'";
	}
	$result = mysql_query($sql) or trigger_error(mysql_error());
}
else if($_SESSION['userType']==15)
{
	$sql="SELECT * FROM `campus_ticket_new_tn` WHERE mttl='".$_SESSION['userId']."' ";
	if(isset($_POST['submit']) && $_POST['search-student-id']!=0)
	{
		$sql.=" and campus_ticket_new_tn.studentID='".$_POST['search-student-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
	{
		$sql.=" and campus_ticket_new_tn.teacherID='".$_POST['search-teacher-id']."' ";
	}
	if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
	{
		$sql.=" and campus_ticket_new_tn.ttl='".$_POST['search-teacher-id2']."' ";
	}
	if(isset($_POST['submit']) && $_POST['open_close']!=0)
	{
		$sql.=" and campus_ticket_new_tn.open_close='".$_POST['open_close']."' ";
	}
	if($_POST['fromDate']!="" && $_POST['toDate']!="")
	{
		$sql.= " and campus_ticket_new_tn.date>='".prepareDate($_POST['fromDate'])."' and campus_ticket_new_tn.date<='".prepareDate($_POST['toDate'])."'";
	}
	$result = mysql_query($sql) or trigger_error(mysql_error());
}
else
{
	if($_SESSION['userType']==1){
		$sql="SELECT * FROM `campus_ticket_new_tn` WHERE 1 ";
		if(isset($_POST['submit']) && $_POST['search-student-id']!=0)
		{
			$sql.=" and campus_ticket_new_tn.studentID='".$_POST['search-student-id']."' ";
		}
		if(isset($_POST['submit']) && $_POST['search-teacher-id']!=0)
		{
			$sql.=" and campus_ticket_new_tn.teacherID='".$_POST['search-teacher-id']."' ";
		}
		if(isset($_POST['submit']) && $_POST['search-teacher-id2']!=0)
		{
			$sql.=" and campus_ticket_new_tn.ttl='".$_POST['search-teacher-id2']."' ";
		}
		if(isset($_POST['submit']) && $_POST['open_close']!=0)
		{
			$sql.=" and campus_ticket_new_tn.open_close='".$_POST['open_close']."' ";
		}
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$sql.= " and campus_ticket_new_tn.date>='".prepareDate($_POST['fromDate'])."' and campus_ticket_new_tn.date<='".prepareDate($_POST['toDate'])."'";
		}
		//echo $sql;
		$result = mysql_query($sql) or trigger_error(mysql_error());
	}
}
 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . $row['ticket_number'] . "</td>";
echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";
echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>";
echo "<td valign='top' style='color:red; font-weight:bold'>" . showUser(nl2br( $row['ttl'])) . "</td>"; 
echo "<td valign='top' style='color:green; font-weight:bold'>" . showUser(nl2br( $row['mttl'])) . "</td>"; 
echo "<td valign='top'>" . $row['date'] . "</td>";
//TICKET OPEN CLOSE STATUS
if($row['open_close']==2){
echo "<td valign='top' style='color:red; font-weight:bold'>CLOSE</td>";
}
if($row['open_close']==1){
echo "<td valign='top' style='color:green; font-weight:bold'>OPEN</td>";
}
/////////////////////

//TICKET CONVERSATION
echo "<td><a target=_blank 
class=button style='background-color:Yellow' 
href=ticket_conversation.php?id=".$row['studentID']."&tn=".$row['ticket_number']."&sch_id=".$row['schedule_id'].">Conversation</a></td>";
////////////////////

//TICKET ACTIONS(OPEN_CLOSE)
if($_SESSION['userType']==1 || $_SESSION['userType']==15){
	if($row['open_close']==2){
	echo "<td><a class=button style='background-color:GREY' 
	href=#>TICKET CLOSED</a></td>";
	}
	if($row['open_close']==1){
	echo "<td><a class=button style='background-color:PURPLE' 
	href=ticket_close.php?id=".$row['id']."&sch_id=".$row['schedule_id'].">CLOSE TICKET</a></td>";
	} 
}
else
{
	echo "<td><a class=button style='background-color:RED' 
	href=#>NA</a></td>";
}
////////////////	

echo "</tr>"; 
} 
echo "</table>";  


include('include/footer.php');
?>