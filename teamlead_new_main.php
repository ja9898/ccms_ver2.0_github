<? 
include('config.php'); 
include('include/header.php');
//global $_LISTTEAM;
if (isset($_POST['sender']) || isset($_POST['submitted'])) { 
$team_lead_id_main=$_POST['team_lead_id_main'];
foreach($_POST['stateunderID_main'] as $team_under_index_main){
$_inValid=checkDuplication_LISTTEAM_main($team_under_index_main,$team_lead_id_main);
echo $_inValid;
//echo $usertype_teamunder."-";
echo $team_lead_id_main;
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
		foreach($_POST['stateunderID_main'] as $team_under_index_main)
		{
				echo $sql = ("UPDATE capmus_users SET main_LeadId=0 WHERE id='$team_under_index_main'"); 
				mysql_query($sql) or die(mysql_error());
			
		}
		echo "<br>";
		//Removing value in main_LeadId column of the TEACHERS who are under TEAMLEAD whos MAIN TEAMLEAD ID has 
		// to be removed - So removing main_LeadId column values from TEACHERS 
		echo $sql_removing_teacher_main_LeadId = ("UPDATE capmus_users SET main_LeadId=0 WHERE LeadId='$team_under_index_main'"); 
		mysql_query($sql_removing_teacher_main_LeadId) or die(mysql_error());
	}
	else
	{
		echo "<script>alert('Successful :  Selected team members are TEAM MEMBERS')</script>";
		foreach($_POST['stateunderID_main'] as $team_under_index_main)
		{
				echo $sql = ("UPDATE capmus_users SET main_LeadId='$team_lead_id_main' WHERE id='$team_under_index_main'"); 
				mysql_query($sql) or die(mysql_error());
			
		}
		echo "<br>";
		//Adding value in main_LeadId column of the TEACHERS who are under TEAMLEAD whos MAIN TEAMLEAD ID has 
		// to be Added - So adding main_LeadId column values into TEACHERS
		echo $sql_making_teacher_main_LeadId = ("UPDATE capmus_users SET main_LeadId='$team_lead_id_main' WHERE LeadId='$team_under_index_main'"); 
		mysql_query($sql_making_teacher_main_LeadId) or die(mysql_error());
		
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

<div id="label">MAIN Team Lead Category:</div>
<div id="field"><div id="">
		<select id="usertype_teamlead_main" onchange="availableTeamLead_main(this.value)">
			<option value="">Select Team Lead Category:</option>
			<option value="15">Main Teacher TeamLead</option>
			<option value="16">Main Agent TeamLead</option>
		</select>
</div></div>
<div id="label">Select MAIN Team Lead:</div>
	<div id="field"><div id="statediv_main">
		<select  name="state_main">
			<option>Select MAIN Team Lead Category First</option>
        </select>
	</div></div>
<!--<div id="label">Select Team Members:</div>
	<div id="field"><div id="statedivunder">
		<select  name="stateunder">
			<option>Select Team Lead First</option>
        </select>
	</div></div>-->
<div id="label">Select TEAMLEAD Members:</div>
	<div id="field"><div id="statedivunder_main">
		<input type='checkbox' name='stateunderID_main' />
	</div></div>
	
	<!--<div id="label">Select Team Memebrs CHECKBOX111:</div><div id="field"><?php //echo getCheckboxList_LISTTEAM('','stateunderID[]',$_LISTTEAM);?></div>-->
	
	
<!--<div id="label">Select Team Memebrs CHECKBOX111:</div><div id="field"><?php //echo getCheckboxList('','stateunder','team_members');?></div> --> 	
<!--<div id="label">Select Team Leads:</div><div id="field"><div id="availableTeamLeads">&nbsp;</div> </div> -->

<!--<div id="label"></div><div id="field"><input name='sender' type='submit' value='Add Row-original' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
-->
</form>
<?php include('include/footer.php');?>