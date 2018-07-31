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
	$usertype_student=intval($_GET['usertype_student']);	
	$parent_id=intval($_GET['parent_id']);
//}
//echo $usertype_teamlead_id."<br><br><br><br>";
//global $_LISTTEAM;

if($usertype_student==1000) // CHECKING TEACHER TEAM LEADS
{

$availableTeam_LeadUnder_query_A=("SELECT * FROM campus_students WHERE user_type=4 and parentId=0 and 
std_status=2 order by firstName ASC"); //Query for Available Students
$availableTeam_LeadUnder_query_NA=("SELECT * FROM campus_students WHERE user_type=4 and parentId='$parent_id' and 
std_status=2 order by firstName ASC"); //Query for Not Available/Occupied Students

$result_A=mysql_query($availableTeam_LeadUnder_query_A);
$result_NA=mysql_query($availableTeam_LeadUnder_query_NA);

}

if($usertype_teamlead==9) // CHECKING AGENT TEAM LEADS
{
$availableTeam_LeadUnder_query_A=("SELECT * FROM capmus_users WHERE (user_type=5 and LeadId=0) or (user_type=9 and LeadId=0) order by firstName ASC"); //Query for Available Agents
$availableTeam_LeadUnder_query_NA=("SELECT * FROM capmus_users WHERE (user_type=5 and LeadId='$usertype_teamlead_id') OR 
(user_type=9 and LeadId='$usertype_teamlead_id') order by firstName ASC"); //Query for Not Available/Occupied Agents

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

<form method='post' action='teamlead_new.php'>
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
			<?php echo getCheckboxList_LISTTEAM('','stateunderID[]',$_LISTTEAM_A);?><!-- Available Teachers/Agents -->
		</div>
		<div style="float:right; border:2px solid; border-radius:0px; margin:0 300px 0px 0px">
		Current Team Members<br>
			(Select members to make them Available):<hr>
			<?php echo getCheckboxList_LISTTEAM('','stateunderID[]',$_LISTTEAM_NA);?><!--Not Available/Occupied Teachers/Agents -->
		</div>
<!--</div>-->
<div id="field"><input type="hidden" name="parent_id" value=<?php echo $parent_id; ?> /></div>
<div id="label"></div><div id="field" style="margin:0px 0px 0px 100px"><input name='sender' type='submit' value='Add/Remove Members' class="button" /><input type='hidden' value='1' name='submitted' /></div>
</form>
<!--onchange="availableUnderLead(<?//$usertype_teamlead?>,this.value)"-->
<!--<div id="label">Select Team Memebrs CHECKBOX222:</div><div id="field"><?php //echo getCheckboxList('','stateunder','team_members');?></div>-->






