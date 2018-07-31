<? 
include('config.php');
include('include/header.php');  
$id = (int) $_GET['id']; 
/////////////////////////////////////////////////////// NEWLY ADDED // For make over class duplication //24-08-15
$row_initial_values = mysql_fetch_array( mysql_query(" SELECT * FROM campus_schedule WHERE id='$id' ")) or die(mysql_error());
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 

echo "<tr>";
echo "<td valign='top'><b> Course:  </b></td>";
echo "<td valign='top'>" .getData( nl2br( $row_initial_values['courseID']),'course'). "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Start Time: </b></td>";
echo "<td valign='top'>" .$row_initial_values['startTime']. "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> End Time: </b></td>";
echo "<td valign='top'>". $row_initial_values['endTime'] ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Start Date: </b></td>";
echo "<td valign='top'>". $row_initial_values['startDate'] ."</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> End Date: </b></td>";
echo "<td valign='top'>" .$row_initial_values['endDate']. "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Teacher: </b></td>";
echo "<td valign='top'>" .showUser( nl2br( $row_initial_values['teacherID'])). "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Student: </b></td>";
echo "<td valign='top'>" .showStudents(nl2br( $row_initial_values['studentID'])). "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Date Booked: </b></td>";
echo "<td valign='top'>" .$row_initial_values['datebooked']. "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Class Type: </b></td>";
echo "<td valign='top'>" .getData(nl2br( $row_initial_values['classType']),'plan'). "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Status: </b></td>";
echo "<td valign='top'>" .getData(nl2br( $row_initial_values['status']),'status'). "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Agent: </b></td>";
echo "<td valign='top'>" .showUser( nl2br( $row_initial_values['agentId'])). "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Comments: </b></td>";
echo "<td valign='top'>" .$row_initial_values['comments']. "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Std Status: </b></td>";
echo "<td valign='top'>" .getData(nl2br( $row_initial_values['std_status']),'stdStatusmo-list'). "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Reference: </b></td>";
echo "<td valign='top'>" .$row_initial_values['reference']. "</td>";
echo "</tr>";

echo "<tr>";
echo "<td valign='top'><b> Skype: </b></td>";
echo "<td valign='top'>" .$row_initial_values['skypetext']. "</td>";
echo "</tr>";

echo "</table>";
$systemdate = systemDate();
if (isset($_POST['submitted'])) 
{
	if($id!=0 || $id!='')
	{
		$row = mysql_fetch_array( mysql_query(" SELECT * FROM campus_schedule WHERE id='$id' ")) or die(mysql_error());
		$startDate = date('Y-m-d');
		$sql_makeover_class_insert = "INSERT INTO `campus_schedule` (`courseID`, `startTime` ,  `endTime` ,  `startDate` ,  
		`endDate` ,  `teacherID` ,  `studentID`, `dateBooked` ,  `classType` ,  `status` , `agentId` ,`comments`,
		`std_status` , `reference`, `skypetext`) 
		VALUES(  '".$row['courseID']."' , '".$row['startTime']."' ,  '".$row['endTime']."' ,  '".$startDate."' ,  
		'".$row['endDate']."' ,  '{$_POST['teacherID']}' ,  '".$row['studentID']."'  ,  '".$systemdate."' ,  
		'".$_POST['classType']."' ,  '".$row['status']."' ,  '".$row['agentId']."' ,'".$row['comments']."', '5' , 
		'".$row['reference']."' , '".$row['skypetext']."' )";
		///////////////////////////////////////////////////////
		mysql_query($sql_makeover_class_insert) or die(mysql_error()) ; 
		getMessages('add','book_scheduler_manage.php');
	}
}
if(date('w',strtotime($systemdate))==1) { $classType=5; }
if(date('w',strtotime($systemdate))==2) { $classType=6; }
if(date('w',strtotime($systemdate))==3) { $classType=7; }
if(date('w',strtotime($systemdate))==4) { $classType=8; }
if(date('w',strtotime($systemdate))==5) { $classType=9; }
if(date('w',strtotime($systemdate))==6) { $classType=10; }


?>
<form action='' method='POST'>
	<div id="label">MakeOver DUP-Day:</div><div id="field"><?php echo date('l');echo "<br>";?> </div>
		<input name="classType" type="hidden" value="<?php echo $classType; ?>" />
	<div id="label">Teacher:</div><div id="field"><?php echo getDataList('','teacherID',3);?> </div>	
	<div id="label"></div><div id="field"><input type='submit' value='Add Row' class="button" /><input type='hidden' value='1' name='submitted'/> </div>
</form>
<?
include('include/footer.php');?> 