<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
if($_SESSION['userType']=='5' || $_SESSION['userType']=='9'){
$agent_id=$_SESSION['userId'];
$_POST['std_status']=1;
}
else
{
	$agent_id=192;
}
if($_POST['email']!='' && ($_POST['extId']!='' || $_POST['extId']!=0) /*&& $_POST['skypeid']!=''*/)
{	
	$sql_check_email_phone= mysql_query("SELECT email,phone FROM campus_students WHERE email = '".$_POST['email']."' OR phone = '".$_POST['phone']."' ");
	if (mysql_num_rows($sql_check_email_phone)>=1 && ($_SESSION['userType']=='5' || $_SESSION['userType']=='8' || $_SESSION['userType']=='15' || $_SESSION['userType']=='16'))
	{
		getMessages('duplicate','','Email or Phone Duplication');
	}
	else
	{
		$sql_get_extid_number = "SELECT * FROM campus_voice_ext WHERE id='".$_POST['extId']."' ";
		$result_get_extid_number = mysql_query($sql_get_extid_number) or die(mysql_error()); 
		$row_get_extid_number= mysql_fetch_array ( $result_get_extid_number );
		
		$FNAME  = preg_replace('/\s+/', '', $_POST['firstName']);
		$LNAME  = preg_replace('/\s+/', '', $_POST['lastName']);
		$sql = "INSERT INTO `campus_students` ( `firstName` ,  `middleName` ,  `lastName` ,  `email` ,  `phone` ,  `landline` ,  `mobile` ,`gender` ,  `dues` ,  `std_status` ,   `skypeid` ,    `countryID` ,agent_id , `reference` , `extId` , `username` , `password` , `user_type` ) VALUES(  '".ucfirst($_POST['firstName'])."' ,  '".ucfirst($_POST['middleName'])."' ,  '".ucfirst($_POST['lastName'])."' ,  '{$_POST['email']}' ,  '{$_POST['phone']}' ,  '{$_POST['landline']}' ,  '{$_POST['mobile']}' ,  '{$_POST['gender']}' ,  '{$_POST['dues']}' ,  '{$_POST['std_status']}' ,  0 ,  '{$_POST['countryID']}' ,  '{$agent_id}', '{$_POST['search-reference-id']}' , '{$_POST['extId']}' , '".$FNAME."_".$LNAME."', '".$FNAME.$row_get_extid_number['extId']."' , 4) "; 
		mysql_query($sql) or die(mysql_error()); 
//Commenting following as SKYPEID is not required during NEW STUDENTS 28-01-2014
//skypeStatus($_POST['skypeid'],'1');

//Using following as EXTID is required during NEW STUDENTS 18-06-2015
if($_POST['extId']!=0){
extStatus($_POST['extId'],'1');
}
else{
extStatus($_POST['extId'],'2');
}
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$add_student="FName:". nl2br( $_POST['firstName']).",LName:".nl2br( $_POST['lastName']).",Email:".nl2br( $_POST['email'])
				.",Agent:".showUser(nl2br( $_POST['agent_id'])).",Ref:".showUser(nl2br( $_POST['search-reference-id']))
				.",Phone:(P,M,LL)".nl2br( $_POST['phone'])." , ".nl2br( $_POST['mobile'])." , ".nl2br( $_POST['landline'])
				.",Status:".getData(nl2br( $_POST['std_status']),'stdStatus');
				user_log( $_SERVER['PHP_SELF'] , "ADD_STUDENT" , $_SESSION['userId'] ,$add_student);
///////////////////////////////////////////////////////

//////////TO SEND EMAIL TO AAQIB///////////////////
$sql_get_extid_number = "SELECT * FROM campus_voice_ext WHERE id='".$_POST['extId']."' ";
$result_get_extid_number = mysql_query($sql_get_extid_number) or die(mysql_error()); 
$row_get_extid_number= mysql_fetch_array ( $result_get_extid_number );


$_POST['phone'];
$phone1_without_dashes_brackets_output = preg_replace('/\D+/', '', $_POST['phone']);
$phone1_without_dashes_brackets_output = ltrim($phone1_without_dashes_brackets_output, '0');
	
$_POST['mobile'];
$Mobile3_without_dashes_brackets_output = preg_replace('/\D+/', '', $_POST['mobile']);
$Mobile3_without_dashes_brackets_output = ltrim($Mobile3_without_dashes_brackets_output, '0');



$email_format_to_send = "<br/><span style='color:Orange; font-size:16px'>Email From YOURCLOUDCAMPUS</span> <br /><br /><b>Dear Mr.Aaqib</b>\r\n\r\n <br/><br/>Please make the following extension id against the numbers given.\r\n\r\n <br/><br/> Ext ID : <b>".$row_get_extid_number['extId']."</b>  \r\n <br>
'".ucfirst($_POST['firstName'])."' <br>
'".ucfirst($_POST['lastName'])."' <br>
'".showUser(nl2br($_SESSION['userId']))."' <br><br>
<b>Phone: '".$_POST['phone']."' </b><br><b>Landline : '".$_POST['landline']."' </b> <br><b>Mobile : '".$_POST['mobile']."' </b> <br /><br /><br />Regards, \r\n <br /><b>YCC(YourCloudCampus Management)</b> <br /><br /><br /><br /><br />

[66".$row_get_extid_number['extId']."]<br>
deny=0.0.0.0/0.0.0.0<br>
secret=BZH@ss6990<br>
dtmfmode=rfc2833<br>
canreinvite=<br>
context=from-internal<br>
host=dynamic<br>
type=friend<br>
nat=yes<br>
port=5060<br>
qualify=yes<br>
dial=SIP/".$phone1_without_dashes_brackets_output."@voip<br>
mailbox=66".$row_get_extid_number['extId']."@device<br>
permit=0.0.0.0/0.0.0.0<br>
trustrpid=yes<br>
sendrpid=no<br>
qualifyfreq=64<br>
transport=ws,udp,tcp,tls<br>
encryption=yes<br>
callerid= <66".$row_get_extid_number['extId']."><br>
callcounter=yes<br>
faxdetect=no<br>
cc_monitor_policy=generic<br>


<br><br><br><br>

exten => 66".$row_get_extid_number['extId'].",1,Set(__RINGTIMER=$"."{IF($[$"."{DB(AMPUSER/66".$row_get_extid_number['extId']."/ringtimer)} > 0]?$"."{DB(AMPUSER/66".$row_get_extid_number['extId']."/ringtimer)}:$"."{RINGTIMER_DEFAULT})})<br>
exten => 66".$row_get_extid_number['extId'].",n,Macro(exten-vm,novm,66".$row_get_extid_number['extId'].",0,0,0)<br>
exten => 66".$row_get_extid_number['extId'].",n(dest),Set(__PICKUPMARK=)<br>
exten => 66".$row_get_extid_number['extId'].",n,Goto($"."{IVR_CONTEXT},return,1)<br>
exten => 66".$row_get_extid_number['extId'].",n,Goto(from-internal,66".$row_get_extid_number['extId'].",1)<br>
exten => 66".$row_get_extid_number['extId'].",hint,SIP/".trim($phone1_without_dashes_brackets_output)."@voip&Custom:DND66".$row_get_extid_number['extId'].",CustomPresence:66".$row_get_extid_number['extId']."<br>";



////////////////////////////////////////////////////
?>
<input rows="10" cols="90" id='email_format_to_send_after_post' name='email_format_to_send_after_post' readonly="readonly" type='hidden' value="<?php echo $email_format_to_send; ?>"/>
<?
//	echo '<script> alert(START); </script>';
echo '<script> send_email_to_aaqib_for_extid(); </script>';
	getMessages('add');
	}
}

else
{
	getMessages('error');
}
}
?>
<script type="text/javascript">
jQuery(function($){
  // $("#date").mask("99/99/9999");
   $("#phone").mask("(999) 999-999-9999");
   $("#landline").mask("(999) 999-999-9999");
   $("#mobile").mask("(999) 999-999-9999");
  // $("#tin").mask("99-9999999");
  // $("#ssn").mask("999-99-9999");
});
</script>
<form action='' method='POST'>
<div id="label">First Name:</div><div id="field"><?php echo getInput('','firstName','')?> </div> 
<div id="label">Middle Name:</div><div id="field"><?php echo getInput('','middleName','')?> </div> 
<div id="label">Last Name:</div><div id="field"><?php echo getInput('','lastName','')?> </div> 
<div id="label">Email:</div><div id="field"><input name="email" type="email" id="email" required /><?php //echo getInput('','email','')?> </div> 
<div id="label">Phone:</div><div id="field"><input name="phone" type="text" id="phone" required /><?php //echo getInput('','phone','')?></div> 
<div id="label">Landline:</div><div id="field"><?php echo getInput('','landline','')?> </div> 
<div id="label">Mobile:</div><div id="field"><?php echo getInput('','mobile','')?></div>
<div id="label">Gender:</div><div id="field"><?php echo getList('','gender','gender');?> </div> 
<div id="label">Dues:</div><div id="field"><?php echo getInput('','dues','')?> </div> 
<div id="label">Status:</div><div id="field"><?php echo getList('','std_status','stdStatus');?> </div> 
<!--Commenting following as skypeid  not required in NEW STUDENTS 28-01-2014--> 
<!--<div id="label">Skypeid:</div><div id="field"><?php //echo getTableList(stripslashes($row['skypeid']),'skypeid','campus_skype','Skyp ID\'s')?> </div> -->
<!--following as extId required in NEW STUDENTS 18-06-2015--> 
<div id="label">ExtId:</div><div id="field"><?php echo getTableList_ext(stripslashes($row['extId']),'extId','campus_voice_ext','EXT ID\'s')?> </div>
<div id="label">Country:</div><div id="field"><?php echo getList('','countryID','country');?> </div> 
<div id="label">Reference:</div><div id="field_sch_new"><div id="filter"><?php echo getReferenceFilter_new_student(); ?></div> </div>

<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
<div id="ajaxdiv_summary_student"></div>	

</form>
<?php include('include/footer.php');?>