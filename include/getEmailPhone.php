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
	$student_id=intval($_GET['student_id']);
//}


$EmailPhone_query=("SELECT * FROM campus_students WHERE id='$student_id' ");
$result=mysql_fetch_array(mysql_query($EmailPhone_query));
//get extID
$extId_query=("SELECT * FROM campus_voice_ext WHERE id='".$result['extId']."' ");
$result_extId=mysql_query($extId_query);

?>
<label id="EmailPhonediv" name="EmailPhonediv">

<? while($row=mysql_fetch_array($result_extId)) { ?>
<label value=<?=$row['id']?>>Email:<?="Blocked"." - "?>Phone:<?=$row['extId']?></label>
<? } ?>
</label>
