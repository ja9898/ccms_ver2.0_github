<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) {

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row_status_pre = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_students` WHERE `id` = '$id' "));
$edit_student_pre="FName:". nl2br( $row_status_pre['firstName']).",LName:".nl2br( $row_status_pre['lastName']).",Email:".nl2br( $row_status_pre['email'])
				.",Agent:".showUser(nl2br( $row_status_pre['agent_id'])).",Ref:".showUser(nl2br( $row_status_pre['reference']))
				.",Phone:(P,M,LL)".nl2br( $row_status_pre['phone'])." , ".nl2br( $row_status_pre['mobile'])." , ".nl2br( $row_status_pre['landline'])
				.",Status:".getData(nl2br( $row_status_pre['std_status']),'stdStatus');
///////////////////////////////////////////////////////



 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$status='';
if($_POST['std_status']!=2){

 $status=" `std_status` =  '{$_POST['std_status']}' , ";
}

  $sql = "UPDATE `campus_students` SET  `firstName` =  '".ucfirst($_POST['fName'])."' ,`agent_id` =  '{$_POST['agent_id']}' ,  `middleName` =  '".ucfirst($_POST['mName'])."' ,  `lastName` =  '".ucfirst($_POST['lName'])."' ,  `email` =  '{$_POST['email']}' ,  `phone` =  '{$_POST['phone']}' ,  `landline` =  '{$_POST['landline']}' ,  `mobile` =  '{$_POST['mobile']}' ,  `gender` =  '{$_POST['gender']}' ,  `signInDate` =  '".prepareDate($_POST['signInDate'])."' ,   `dues` =  '{$_POST['dues']}' ,  $status   `skypeid` =  '0' ,  `recurring` =  '{$_POST['recurring']}' ,  `countryID` =  '{$_POST['countryID']}'  , `std_status` =  '{$_POST['std_status']}' , `reference` =  '{$_POST['reference']}'  , `extId` = '{$_POST['extId']}'  WHERE `id` = $id "; 
//echo $_POST['extId'];exit;
  mysql_query($sql) or die(mysql_error()); 
//Commenting following as SKYPEID is not required during EDIT STUDENTS		28-01-2014
//skypeStatus($_POST['skypeid'],'2');
//skypeStatus($_POST['skypeid'],'1');

//Using following as EXTID is required during NEW STUDENTS 18-06-2015, 
if($_POST['extId']==0 || $_POST['extId']==''){
extStatus($_POST['extId'],'2');
}
else{
extStatus($_POST['extId'],'1');
}

if($_POST['std_status']=='3'){
	removeSchedule($id,'3');
	skypeStatus($_POST['skypeid'],'3');
}

if($_POST['std_status']=='3'){
	extStatus($_POST['extId'],'2');
}



/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$edit_student_new="FName:". nl2br( $_POST['fName']).",LName:".nl2br( $_POST['lName']).",Email:".nl2br( $_POST['email'])
				.",Agent:".showUser(nl2br( $_POST['agent_id'])).",Ref:".showUser(nl2br( $_POST['reference']))
				.",Phone:(P,M,LL)".nl2br( $_POST['phone'])." , ".nl2br( $_POST['mobile'])." , ".nl2br( $_POST['landline'])
				.",Status:".getData(nl2br( $_POST['std_status']),'stdStatus');
				user_log( $_SERVER['PHP_SELF'] , "EDIT_STUDENT" , $edit_student_pre ,$edit_student_new, $_POST['comments_edit']);
///////////////////////////////////////////////////////

getMessages('edit');
} 
$_sql="SELECT * FROM `campus_students` WHERE `id` = '$id'  ";
if($_SESSION['userType']==5)
{
	$_sql.=" and agent_id=".$_SESSION['userId']."";
}
$_result=mysql_query($_sql);
 
 
if(mysql_num_rows($_result)==0){
getMessages('noresult');

}else{
$row = mysql_fetch_assoc($_result );

?>

<form action='' method='POST'> 
<div id="label">First Name:</div><div id="field"><?php echo getInput(stripslashes($row['firstName']) ,'fName','')?></div>
<div id="label">Middle Name:</div><div id="field"><?php echo getInput(stripslashes($row['middleName']),'mName','')?></div>
<div id="label">Last Name:</div><div id="field"><?php echo getInput(stripslashes($row['lastName']),'lName','')?></div>
<div id="label">Email:</div><div id="field"><?php echo getInput(stripslashes($row['email']),'email','')?></div>
<div id="label">Phone:</div><div id="field"><?php echo getInput(stripslashes($row['phone']) ,'phone','')?></div>
<div id="label">Landline:</div><div id="field"><?php echo getInput(stripslashes($row['landline']) ,'landline','')?></div>
<div id="label">Mobile:</div><div id="field"><?php echo getInput(stripslashes($row['mobile']),'mobile','')?></div>
<div id="label">Gender:</div><div id="field"><?php echo getList(stripslashes($row['gender']) ,'gender','gender')?></div> 
<div id="label">SignInDate:</div><div id="field"><?php echo getInput(prepareDate(stripslashes($row['signInDate'])),'signInDate','class="flexy_datepicker_input"')?></div>
<div id="label">Dues:</div><div id="field"><?php echo getInput(stripslashes($row['dues']),'dues','')?></div>
<div id="label">Student Status:</div><div id="field"><?php echo getList(stripslashes($row['std_status']),'std_status','stdStatus');?></div>
<div id="label">Agent:</div><div id="field"><?php echo getDataList(stripslashes($row['agent_id']),'agent_id',5);?></div>
<!--Commenting following as skypeid editing not required in EDIT STUDENTS	28-01-2014-->
<!--<div id="label">Skypeid:</div><div id="field"><?php //echo getTableList(stripslashes($row['skypeid']),'skypeid','campus_skype','Skyp ID\'s')?> </div>-->

<div id="label">ExtId:</div><div id="field"><?php echo getTableList_ext(stripslashes($row['extId']),'extId','campus_voice_ext','EXT ID\'s')?> </div>

<div id="label">Recurring:</div><div id="field"><?php echo getCheckbox(stripslashes($row['recurring']),'recurring');?> </div>
<div id="label">CountryID:</div><div id="field"><?php echo getList(stripslashes($row['countryID']),'countryID','country');?></div>

<div id="label">Reference:</div><div id="field" name=""><?php echo getDataList_reference(stripslashes($row['reference']),'reference','',''); ?> </div>


<div id="label">Reason/Comments For Editing:</div><div id="field"><textarea name='comments_edit' required></textarea></div>  
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<? }} 
include('include/footer.php');?> 
