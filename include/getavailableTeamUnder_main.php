<?php
include('../config.php');
include('function-inc.php');

/*foreach($_GET AS $key => $value) {
    $_GET[$key] = mysql_real_escape_string($value);
}
$_classType=getClassTypeSchedule90($_GET['classType']);
$_condition=getCondition90($_GET['classType']);*/
//if(isset($_GET['usertype_teamlead'])
//{
	$usertype_teamlead_main=intval($_GET['usertype_teamlead_main']);	
	$usertype_teamlead_id_main=intval($_GET['usertype_teamlead_id_main']);
//}
//echo $usertype_teamlead_id."<br><br><br><br>";
//global $_LISTTEAM;

if($usertype_teamlead_main==15) // CHECKING MAIN TEACHER TEAM LEADS
{

$availableTeam_LeadUnder_query_A=("SELECT * FROM capmus_users WHERE user_type=8 and main_LeadId=0 order by firstName ASC"); //Query for Available Teachers
$availableTeam_LeadUnder_query_NA=("SELECT * FROM capmus_users WHERE user_type=8 and main_LeadId='$usertype_teamlead_id_main' order by firstName ASC"); //Query for Not Available/Occupied Teachers

$result_A=mysql_query($availableTeam_LeadUnder_query_A);
$result_NA=mysql_query($availableTeam_LeadUnder_query_NA);

}

if($usertype_teamlead_main==16) // CHECKING MAIN AGENT TEAM LEADS
{
echo $availableTeam_LeadUnder_query_A=("SELECT * FROM capmus_users WHERE (user_type=9 and main_LeadId=0) or (user_type=16 and main_LeadId=0) order by firstName ASC"); //Query for Available Agents
echo $availableTeam_LeadUnder_query_NA=("SELECT * FROM capmus_users WHERE (user_type=9 and main_LeadId='$usertype_teamlead_id_main') OR 
(user_type=16 and main_LeadId='$usertype_teamlead_id_main') order by firstName ASC"); //Query for Not Available/Occupied Agents

$result_A=mysql_query($availableTeam_LeadUnder_query_A);
$result_NA=mysql_query($availableTeam_LeadUnder_query_NA);

}
    while ($row1 = mysql_fetch_array($result_A))
   {
    //echo "<tr><td>";
    //echo "<input type='checkbox' name='stateunder' value =''";
    //echo " />";
	//echo $row['id'];
	
    $_LISTTEAM_A[$row1['id']]=$row1['firstName']." ".$row1['lastName']."<br>";
    //echo "</td></tr><br/>";
	//$_LIST['team_members']=$row['firstName'];
	//echo $_LISTTEAM
   }
   while ($row2 = mysql_fetch_array($result_NA))
   {
    //echo "<tr><td>";
    //echo "<input type='checkbox' name='stateunder' value =''";
    //echo " />";
	//echo $row['id'];
	
    $_LISTTEAM_NA[$row2['id']]=$row2['firstName']." ".$row2['lastName']."<br>";
    //echo "</td></tr><br/>";
	//$_LIST['team_members']=$row['firstName'];
	//echo $_LISTTEAM
   }
   //echo "<form method='post' action='teamlead_new.php'>";
   //echo getCheckboxList_LISTTEAM('','stateunderID[]',$_LISTTEAM);
   //echo "</form>";
?>

<form method='post' action='teamlead_new_main.php'>
<!--<div>-->

		<!--<div style="float:left; border:2px solid; border-radius:0px">
			Available Members:
		</div><br>-->
		<!--<div style="float:right; border:2px solid; border-radius:0px">
			Current Team Members<br>
			(Select members to make them Available):
		</div><br>-->
	
		<div style="float:left; border:2px solid; border-radius:0px">
			Available Members:<br><br><hr>
			<?php echo getCheckboxList_LISTTEAM('','stateunderID_main[]',$_LISTTEAM_A);?><!-- Available Teachers/Agents -->
		</div>
		<div style="float:right; border:2px solid; border-radius:0px; margin:0 300px 0px 0px">
		Current Team Members<br>
			(Select members to make them Available):<hr>
			<?php echo getCheckboxList_LISTTEAM('','stateunderID_main[]',$_LISTTEAM_NA);?><!--Not Available/Occupied Teachers/Agents -->
		</div>
<!--</div>-->
<div id="field"><input type="hidden" name="team_lead_id_main" value=<?php echo $usertype_teamlead_id_main; ?> /></div>
<div id="label"></div><div id="field" style="margin:0px 0px 0px 100px"><input name='sender' type='submit' value='Add/Remove Members' class="button" /><input type='hidden' value='1' name='submitted' /></div>
</form>
<!--onchange="availableUnderLead(<?//$usertype_teamlead?>,this.value)"-->
<!--<div id="label">Select Team Memebrs CHECKBOX222:</div><div id="field"><?php //echo getCheckboxList('','stateunder','team_members');?></div>-->






