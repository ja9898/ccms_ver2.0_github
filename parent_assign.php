<? 
include('config.php'); 
include('include/header.php');
//global $_LISTTEAM;
if (isset($_POST['sender']) || isset($_POST['submitted'])) { 
$parent_id=$_POST['parent_id'];
foreach($_POST['stateunderID'] as $team_under_index){
$_inValid=checkDuplication_LISTTEAM_PARENT($team_under_index,$parent_id);
echo $_inValid;
//echo $usertype_teamunder."-";
echo $parent_id;
//echo $team_under_index."<br>";
//echo $_inValid."-";


/*if(!$_inValid){
$sql = ("UPDATE capmus_users SET LeadId='$team_lead_id' WHERE id='$team_under_index'"); 
mysql_query($sql) or die(mysql_error()); 
//getMessages('add');
}*/


/*else
{
getMessages('duplicate');
}*/ 
}

if($_inValid)
{
	//echo "<script>alert('Selection contains One OR more members already in your team')</script>";
}


//NEW CODE
if($_inValid || !$_inValid)
{
	if($_inValid)
	{
		echo "<script>alert('Successful :  Selected team members are AVAILABLE')</script>";
		foreach($_POST['stateunderID'] as $team_under_index)
		{
				$sql = ("UPDATE campus_students SET parentId=0  WHERE id='$team_under_index'"); 
				mysql_query($sql) or die(mysql_error());
			
		}
	}
	else
	{
		echo "<script>alert('Successful :  Selected team members are TEAM MEMBERS')</script>";
		//Selecting main_LeadId for the teachers whos TEAMLEAD has a MAIN TEAMLEAD ID in the main_LeadId column
		//$main_LeadId=mysql_fetch_array(mysql_query("SELECT main_LeadId FROM capmus_users WHERE id='$team_lead_id'"));
		//$main_TeamLeadId_of_teacher = $main_LeadId['main_LeadId'];
		
		foreach($_POST['stateunderID'] as $team_under_index)
		{
				$sql = ("UPDATE campus_students SET parentId='$parent_id'  WHERE id='$team_under_index'"); 
				mysql_query($sql) or die(mysql_error());
			
		}
	}
}

//PREVIOUSLY
/*foreach($_POST['stateunderID'] as $team_under_index){

if(!$_inValid){
$sql = ("UPDATE capmus_users SET LeadId='$team_lead_id' WHERE id='$team_under_index'"); 
mysql_query($sql) or die(mysql_error()); 
//getMessages('add');
}
}*/

//foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
//$sql = "INSERT INTO `capmus_users` (   `username` ,  `password` ,  `firstName` ,  `middleName` ,  `lastName` ,  `fatherName` ,  `email` ,  `user_type` ,  `gender` ,  `status` ,  `phone` ,  `alt_phone` ,  `skypeId` ,  `departmentId` ,  `nic` ,  `designationID` ,  `countryId` ,  `address` ,  `empType` ,  `empShift`  ) VALUES(    '{$_POST['username']}' ,  '".md5($_POST['password'])."' ,  '{$_POST['firstName']}' ,  '{$_POST['middleName']}' ,  '{$_POST['lastName']}' ,  '{$_POST['fatherName']}' ,  '{$_POST['email']}' ,  '{$_POST['user_type']}' ,  '{$_POST['gender']}' ,  '{$_POST['status']}' ,  '{$_POST['phone']}' ,  '{$_POST['alt_phone']}' ,  '{$_POST['skypeId']}' ,  '{$_POST['departmentId']}' ,  '{$_POST['nic']}' ,  '{$_POST['designationID']}' ,  '{$_POST['countryId']}' ,  '{$_POST['address']}' ,  '{$_POST['empType']}' ,  '{$_POST['empShift']}'  ) "; 
//mysql_query($sql) or die(mysql_error()); 
//getMessages('add'); 

getMessages('edit'); 


//global $_LISTTEAM;

} 
?>

<form action='' method='POST'> 

<!--<div id="label">Team Lead Main:</div><div id="field"><?php //echo getList($_POST['userType'],'user_type','userType','','availableTeamLead','statediv','');?> </div> --> 



<!--<div id="label">Student:</div><div id="field"><?php //echo getDataList($_POST['userType'],'user_type',8,$_SESSION['userId']);?> </div> -->

<div id="label">MAIN CATEGORY Parent:</div>
<div id="field"><div id="">
		<select id="usertype_student" onchange="availableStudent(this.value)">
			<option value="">Select Parent:</option>
			<option value="1000">Parent</option>
			<option value="9">Agent TeamLead</option>
		</select>
</div></div>
<div id="label">Select Parnet:</div>
	<div id="field"><div id="statediv">
		<select  name="state">
			<option>Select Team Lead Category First</option>
        </select>
	</div></div>
<!--<div id="label">Select Team Members:</div>
	<div id="field"><div id="statedivunder">
		<select  name="stateunder">
			<option>Select Team Lead First</option>
        </select>
	</div></div>-->
<div id="label">Select Students:</div>
	<div id="field"><div id="statedivunder">
		<input type='checkbox' name='stateunderID' />
	</div></div>
	
	<!--<div id="label">Select Team Memebrs CHECKBOX111:</div><div id="field"><?php //echo getCheckboxList_LISTTEAM('','stateunderID[]',$_LISTTEAM);?></div>-->
	
	
<!--<div id="label">Select Team Memebrs CHECKBOX111:</div><div id="field"><?php //echo getCheckboxList('','stateunder','team_members');?></div> --> 	
<!--<div id="label">Select Team Leads:</div><div id="field"><div id="availableTeamLeads">&nbsp;</div> </div> -->

<!--<div id="label"></div><div id="field"><input name='sender' type='submit' value='Add Row-original' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
-->
</form>
<?php include('include/footer.php');?>