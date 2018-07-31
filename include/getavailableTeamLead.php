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
	$usertype_teamlead=intval($_GET['usertype_teamlead']);
//}


$availableTeamLead_query=("SELECT * FROM capmus_users WHERE user_type='$usertype_teamlead'");
$result=mysql_query($availableTeamLead_query);

?>
<select id="state" name="state" onchange="availableTeamUnder(<?=$usertype_teamlead?>,this.value)">
<option>Select Team Lead</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['id']?>><?=$row['firstName']." "?><?=$row['lastName']?></option>
<? } ?>
</select>
