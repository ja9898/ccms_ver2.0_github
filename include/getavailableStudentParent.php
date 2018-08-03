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
//}

if($usertype_student==1000){
$availableStudentParent_query=("SELECT * FROM campus_parent");
$result=mysql_query($availableStudentParent_query);
}
?>
<select id="state" name="state" onchange="availableParent_of_Student(<?=$usertype_student?>,this.value)">
<option>Select Parents</option>
<? while($row=mysql_fetch_array($result)) { ?>
<option value=<?=$row['id']?>><?=$row['firstName']." "?><?=$row['lastName']?></option>
<? } ?>
</select>
