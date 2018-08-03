<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); }
$sql_check_extId= mysql_query("SELECT extId FROM campus_voice_ext WHERE extId >= '".$_POST['extId_from']."' AND extId <= '".$_POST['extId_to']."' ");
if (mysql_num_rows($sql_check_extId)>=1)
{
	getMessages('duplicate','','Ext ID Duplication');
}
else
{
	$count_range = $_POST['extId_to'] - $_POST['extId_from'];
	if($count_range==0)
	{
		for($i=0 ; $i<=$count_range ; $i++)
		{
			//echo "inside for loop";
			$sql = "INSERT INTO `campus_voice_ext` ( `extId` ,  `date` ,  `userId` , `status`  ) VALUES(  '{$_POST['extId_from']}' ,  '".date('y-m-d')."' ,  '".$_SESSION['userId']."' ,  '{$_POST['status']}'  ) "; 
			mysql_query($sql) or die(mysql_error());
		}
		getMessages('add'); 
	}
	else
	{
		for($i=0 ; $i<=$count_range ; $i++)
		{
			//echo "inside for loop 222";
			$var_extId_from = $_POST['extId_from']+$i;
			$sql = "INSERT INTO `campus_voice_ext` ( `extId` ,  `date` ,  `userId` , `status`  ) VALUES(  '".$var_extId_from."' ,  '".date('y-m-d')."' ,  '".$_SESSION['userId']."' ,  '{$_POST['status']}'  ) "; 
			mysql_query($sql) or die(mysql_error()); 
		}
		getMessages('add');
	}
} 
}
?>

<form action='' method='POST'> 
<div id="label">Ext Id(From):</div><div id="field"><input name='extId_from' id='extId_from' type='number' /><?php //echo getInput(stripslashes($_POST['extId_from']),'extId_from');?></div>
<div id="label">Ext Id(To):</div><div id="field"><input name='extId_to' id='extId_to' type='number' /><?php //echo getInput(stripslashes($_POST['extId_to']),'extId_to');?></div>

<div id="label">Status:</div><div id="field"><?php echo getList(stripslashes($_POST['status']) ,'status','ext_status')?> </div>
<div id="label"></div><div id="field"><input type='submit' value='Add Row' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<? include('include/footer.php');?>