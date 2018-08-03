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
//}


$availableTeamLead_query=("SELECT * FROM capmus_users WHERE user_type='$usertype_teamlead_main'");
$result=mysql_query($availableTeamLead_query);

?>
<select id="state_main" name="state_main" onchange="availableTeamUnder_main(<?=$usertype_teamlead_main?>,this.value)">
<option>Select MAIN Team Lead</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['id']?>><?=$row['firstName']." "?><?=$row['lastName']?></option>
<? } ?>
</select>
