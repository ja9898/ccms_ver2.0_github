<? 
include('config.php'); 
include('include/header.php');

if($_SESSION['userId']==159 || $_SESSION['userId']==48 || $_SESSION['userId']==506 || $_SESSION['userId']==206 || $_SESSION['userId']==227 || $_SESSION['userId']==95 || $_SESSION['userId']==395 || $_SESSION['userId']==126 || $_SESSION['userId']==411 || $_SESSION['userId']==195 || $_SESSION['userId']==703 || $_SESSION['userId']==2015 || $_SESSION['userId']==2055 || $_SESSION['userId']==1805)
{

$schedule=$_GET['schedule'];
$crs=$_GET['crs']; 
$classType=$_GET['classType'];
$startTime=$_GET['startTime'];
$teacherID=$_GET['teacherID'];	//Newly added for commision , 03-10-2013
$agentId=$_GET['agentId'];		//Newly added - Lahore agent for lahore campus

$end_date_readonly = date('Y-m-d', strtotime(nl2br($systemdate). ' + 1000 days'));

if (isset($_POST['submitted']) && !empty($_POST['signInDate']) && !empty($_POST['transactionID']) && !empty($_POST['date']) && !empty($_POST['paydate']) && $_POST['amount'] >=0 /*!empty($_POST['dateRecieved'])-Previously used*/ && !empty($_POST['method']) && $_POST['campus']!=0 && !empty($_POST['search-parent-id'])) { 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 


//Transaction ID duplication check regardless of the STUDENTID and SCHEDULEID
$sql_check_duplication_tran = ("SELECT * FROM campus_transaction WHERE   
								transactionID='{$_POST['transactionID']}' ") or die(mysql_error());
$sql_check_duplication_tran_result = mysql_query($sql_check_duplication_tran);
$row_count = mysql_num_rows($sql_check_duplication_tran_result);


if($row_count>=1)
{
getMessages('error');
}

else
{

$sql_get_LEAD_and_MAINLEAD = mysql_fetch_array (mysql_query("SELECT * FROM capmus_users WHERE id='$teacherID'")) or die(mysql_error());
$LeadId = $sql_get_LEAD_and_MAINLEAD['LeadId'];
$main_LeadId = $sql_get_LEAD_and_MAINLEAD['main_LeadId'];

/* $sql_get_agent_LEAD_and_MAINLEAD = mysql_fetch_array (mysql_query("SELECT * FROM capmus_users WHERE id='$agentId'")) or die(mysql_error());
$agentLeadId = $sql_get_agent_LEAD_and_MAINLEAD['LeadId'];
$main_agentLeadId = $sql_get_agent_LEAD_and_MAINLEAD['main_LeadId']; */

/*if($agentId==565)
{
	$campus=2;
}
else
{
	$campus=1;
}*/

//Following is BANK PAYMENT IMAGE UPLOAD CODE
//FOLLOWING CODE is the FILE UPLOADER code//
$allowedext2=array("");
$allowedext=array("jpg","jpeg");
$extension=end(explode(".",$_FILES["bank_payment_image"]["name"]));
if(($_FILES["bank_payment_image"]["size"]<=200000) && (in_array($extension, $allowedext)) && ($_FILES["bank_payment_image"]["size"]!=0)
&& ($_POST['method_new']==2 || $_POST['method_new']==3 || $_POST['method_new']==4 ))
{
	if($_FILES["bank_payment_image"]["error"]>0)
	{
		echo "Return Code:". $_FILES["bank_payment_image"]["error"] ."<br />";
	}
	else
	{
			$dir = "bank_payment_images_upload";
			/* if(is_dir($dir) == false)
			{
				mkdir($dir);
				echo "<script>alert('Directory made')</script>";
			} */		
					
			move_uploaded_file($_FILES["bank_payment_image"]["tmp_name"], $dir."/".$_FILES["bank_payment_image"]["name"]);
			//Making proper string with folder name to the file path
			$filepath=$dir."/".$_FILES["bank_payment_image"]["name"];
		 $sql = "INSERT INTO `campus_transaction` ( `transactionID` ,  `date` ,  `studentID` , `teacherID` , 
		 `schedule_id` ,`courseID`,  `method` ,  `method_array` , `currency_array` , `amount_original` , `amount_gbp` ,
		 `amount`, `discount_tran` , `comments` ,`operator`, `classType` , `startTime` , `dateRecieved` , 
		 `LeadId` , `main_LeadId` , `sender_name` , `email` , `agent_id` , `agentLeadId` , `main_agentLeadId` , 
		 `campus` , `agent_comm` , `teacher_comm` , `cardSave_ccv_code` , `amount_usd_simple` , 
		 `VirtualTerminal_name` , `VirtualTerminal_number` , `VirtualTerminal_date` , `datetime_now_accounts` , 
		 `bank_payment_image_filepath` , `bankNameId` , 
		`amountDefaultNew` , `amountOriginalNew` , `feeDeductNew` , `totalReceivedNew` , `discountNew` ,
		`amountDefaultNew_Usd` , `amountOriginalNew_Usd` , `feeDeductNew_Usd` , 
		`totalReceivedNew_Usd` , `discountNew_Usd` , `statusPendRejAccpt` ) 
		 VALUES(  '{$_POST['transactionID']}' ,  '".prepareDate($_POST['date'])."' ,  '{$_POST['studentID']}' , 
		 '".$teacherID."' , '".$schedule."'  , '".$crs."' ,  '{$_POST['method']}' ,  '{$_POST['method_new']}' , 
		 '{$_POST['currency_id']}' , '{$_POST['amount_original']}' , '{$_POST['amount_gbp']}' , '{$_POST['amount']}' , 
		 '{$_POST['discount']}' ,'{$_POST['comments']}' , '".$_SESSION['userId']."', '".$classType."' , 
		 '".$startTime."' ,'".prepareDate($_POST['paydate'])."' , '".$LeadId."' , '".$main_LeadId."' , 
		 '{$_POST['sender_name']}' , '{$_POST['email']}' , '".$agentId."' , '".$agentLeadId."' , 
		 '".$main_agentLeadId."' , '{$_POST['campus']}' , '{$_POST['agent_id']}' , '{$_POST['teacher_id']}' , 
		 '{$_POST['cardSave_ccv_code']}' , '{$_POST['amount_usd_simple']}' , '{$_POST['VirtualTerminal_name']}' , 
		 '{$_POST['VirtualTerminal_number']}' , '{$_POST['VirtualTerminal_date']}' , NOW() , 
		'".$filepath."', '{$_POST['bankName']}' , 
		'{$_POST['amountDefaultNew']}' , '{$_POST['amountOriginalNew']}' , '{$_POST['feeDeductNew']}' , 
		'{$_POST['totalReceivedNew']}' , '{$_POST['discountNew']}' , 
		'{$_POST['amountDefaultNew_Usd']}' , '{$_POST['amountOriginalNew_Usd']}' , '{$_POST['feeDeductNew_Usd']}' , 
		'{$_POST['amountUsdSimpleNew']}' , '{$_POST['discountNew_Usd']}' , '".$statusPendRejAccpt."' ) "; 
		mysql_query($sql) or die(mysql_error());
		$sql = "UPDATE `campus_students` SET    `std_status` =  '2', signInDate=   '".prepareDate($_POST['signInDate'])."', paydate=   '".prepareDate($_POST['paydate'])."' , parentId = '{$_POST['search-parent-id']}' WHERE `id` = '{$_POST['studentID']}' "; 

		////////////////// Query to get the status of TRIAL that will become regular in the next query
		$row_std_status_old = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '{$_GET['schedule']}' "));
		//////////////////

		if($_POST['std_status']!='2'){
			mysql_query($sql) or die(mysql_error()); 
			
			$sql = "UPDATE `campus_schedule` SET  dues= '{$_POST['amount']}' , dues_original= '{$_POST['amount_original']}' , dues_gbp= '{$_POST['amount_gbp']}' , currency_array= '{$_POST['currency_id']}' , discount= '{$_POST['discount']}' ,duedate=   '".prepareDate($_POST['signInDate'])."',  paydate=   '".prepareDate($_POST['paydate'])."',  std_status_old='".$row_std_status_old['std_status']."' , std_status='2', `startDate` =  '".prepareDate($_POST['courseStart'])."', endDate=   '".prepareDate($_POST['courseEnd'])."' , `grade` =  '{$_POST['grade']}' ,  `syllabus` =  '{$_POST['syllabus']}' , `record_link` =  '".$_POST['record_link']."'  , 
			`dues_amountDefaultNew` = '{$_POST['amountDefaultNew']}' , `dues_amountOriginalNew`='{$_POST['amountOriginalNew']}' , 
			`dues_feeDeductNew`='{$_POST['feeDeductNew']}' , `dues_totalReceivedNew`='{$_POST['totalReceivedNew']}' , 
			`dues_discountNew`='{$_POST['discountNew']}' ,
			`dues_amountDefaultNew_Usd`='{$_POST['amountDefaultNew_Usd']}' , `dues_amountOriginalNew_Usd`='{$_POST['amountOriginalNew_Usd']}' , 
			`dues_feeDeductNew_Usd`='{$_POST['feeDeductNew_Usd']}' , 
			`dues_totalReceivedNew_Usd`='{$_POST['amountUsdSimpleNew']}' , `dues_discountNew_Usd`='{$_POST['discountNew_Usd']}' , 
			`statusPendRejAccpt`='".$statusPendRejAccpt."' 
			WHERE id='{$_GET['schedule']}' "; 
			/* if(isset($_GET['schedule'])){
				$schedule=$_GET['schedule']; */
				
				//$sql.=" and id='{$_GET['schedule']}'";
				/* } */
			mysql_query($sql) or die(mysql_error()); 
			/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
			$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '{$_GET['schedule']}' "));
			$make_regular_schedule="Course:".getData( nl2br( $row['courseID']),'course').",Teacher:".showUser( nl2br( $row['teacherID'])).",Student:". showStudents(nl2br( $row['studentID']))
							.",TranID:".nl2br( $_POST['transactionID']).",StartTime:".nl2br( $_POST['startTime'])
							.",BKDATE:".nl2br( $row['dateBooked']).",Class Days:".getData(nl2br( $row['classType']),'plan').",Status:".getData(nl2br( $row['std_status']),'stdStatusmo-list')
							.",CSDATE:".prepareDate($_POST['courseStart']).",CEDATE:".prepareDate($_POST['courseEnd']).",SignUp-DATE:".prepareDate($_POST['signInDate']).",PAYDATE:".prepareDate($_POST['paydate'])
							.",Amount:".nl2br( $_POST['amount']).",Method:".nl2br( $_POST['method']);
			user_log( $_SERVER['PHP_SELF'] , "MAKE_REG_SCHEDULE" , $_SESSION['userId'] ,$make_regular_schedule);

			///////////////////////////////////////////////////////

		getMessages('add');
		}
	}
}

else if($_FILES["bank_payment_image"]["size"]>200000 && ($_POST['method_new']==2 || $_POST['method_new']==3 || $_POST['method_new']==4))// elseif of the if IMAGE UPLOAD
{
	if($_FILES["lecture_file"]["name"]=="" || $_FILES["bank_payment_image"]["size"]>200000)
	{
		echo "<script>alert('Invalid File Selection OR File is bigger than 200KB, Data cannot be inserted')</script>";
		getMessages('error');
	}
}
else{
	$sql = "INSERT INTO `campus_transaction` ( `transactionID` ,  `date` ,  `studentID` , `teacherID` , 
		 `schedule_id` ,`courseID`,  `method` ,  `method_array` , `currency_array` , `amount_original` , `amount_gbp` ,
		 `amount`, `discount_tran` , `comments` ,`operator`, `classType` , `startTime` , `dateRecieved` , 
		 `LeadId` , `main_LeadId` , `sender_name` , `email` , `agent_id` , `agentLeadId` , `main_agentLeadId` , 
		 `campus` , `agent_comm` , `teacher_comm` , `cardSave_ccv_code` , `amount_usd_simple` , 
		 `VirtualTerminal_name` , `VirtualTerminal_number` , `VirtualTerminal_date` , `datetime_now_accounts`  , 
		 `bankNameId` , 
		`amountDefaultNew` , `amountOriginalNew` , `feeDeductNew` , `totalReceivedNew` , `discountNew` ,
		`amountDefaultNew_Usd` , `amountOriginalNew_Usd` , `feeDeductNew_Usd` , 
		`totalReceivedNew_Usd` , `discountNew_Usd` , `statusPendRejAccpt`  ) 
		 VALUES(  '{$_POST['transactionID']}' ,  '".prepareDate($_POST['date'])."' ,  '{$_POST['studentID']}' , 
		 '".$teacherID."' , '".$schedule."'  , '".$crs."' ,  '{$_POST['method']}' ,  '{$_POST['method_new']}' , 
		 '{$_POST['currency_id']}' , '{$_POST['amount_original']}' , '{$_POST['amount_gbp']}' , '{$_POST['amount']}' , 
		 '{$_POST['discount']}' ,'{$_POST['comments']}' , '".$_SESSION['userId']."', '".$classType."' , 
		 '".$startTime."' ,'".prepareDate($_POST['paydate'])."' , '".$LeadId."' , '".$main_LeadId."' , 
		 '{$_POST['sender_name']}' , '{$_POST['email']}' , '".$agentId."' , '".$agentLeadId."' , 
		 '".$main_agentLeadId."' , '{$_POST['campus']}' , '{$_POST['agent_id']}' , '{$_POST['teacher_id']}' , 
		 '{$_POST['cardSave_ccv_code']}' , '{$_POST['amount_usd_simple']}' , '{$_POST['VirtualTerminal_name']}' , 
		 '{$_POST['VirtualTerminal_number']}' , '{$_POST['VirtualTerminal_date']}' , NOW() ,  '{$_POST['bankName']}'  , 
'{$_POST['amountDefaultNew']}' , '{$_POST['amountOriginalNew']}' , '{$_POST['feeDeductNew']}' , 
'{$_POST['totalReceivedNew']}' , '{$_POST['discountNew']}' , 
'{$_POST['amountDefaultNew_Usd']}' , '{$_POST['amountOriginalNew_Usd']}' , '{$_POST['feeDeductNew_Usd']}' , 
'{$_POST['amountUsdSimpleNew']}' , '{$_POST['discountNew_Usd']}' , '".$statusPendRejAccpt."'  ) "; 
		mysql_query($sql) or die(mysql_error());
		$sql = "UPDATE `campus_students` SET    `std_status` =  '2', signInDate=   '".prepareDate($_POST['signInDate'])."', paydate=   '".prepareDate($_POST['paydate'])."' , parentId = '{$_POST['search-parent-id']}' WHERE `id` = '{$_POST['studentID']}' "; 

		////////////////// Query to get the status of TRIAL that will become regular in the next query
		$row_std_status_old = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '{$_GET['schedule']}' "));
		//////////////////

		if($_POST['std_status']!='2'){
			mysql_query($sql) or die(mysql_error()); 
			
			$sql = "UPDATE `campus_schedule` SET  dues= '{$_POST['amount']}' , dues_original= '{$_POST['amount_original']}' , dues_gbp= '{$_POST['amount_gbp']}' , currency_array= '{$_POST['currency_id']}' , discount= '{$_POST['discount']}' ,duedate=   '".prepareDate($_POST['signInDate'])."',  paydate=   '".prepareDate($_POST['paydate'])."',  std_status_old='".$row_std_status_old['std_status']."' , std_status='2', `startDate` =  '".prepareDate($_POST['courseStart'])."', endDate=   '".prepareDate($_POST['courseEnd'])."' , `grade` =  '{$_POST['grade']}' ,  `syllabus` =  '{$_POST['syllabus']}' , `record_link` =  '".$_POST['record_link']."'  , 
			`dues_amountDefaultNew` = '{$_POST['amountDefaultNew']}' , `dues_amountOriginalNew`='{$_POST['amountOriginalNew']}' , 
`dues_feeDeductNew`='{$_POST['feeDeductNew']}' , `dues_totalReceivedNew`='{$_POST['totalReceivedNew']}' , 
`dues_discountNew`='{$_POST['discountNew']}' ,
`dues_amountDefaultNew_Usd`='{$_POST['amountDefaultNew_Usd']}' , `dues_amountOriginalNew_Usd`='{$_POST['amountOriginalNew_Usd']}' , 
`dues_feeDeductNew_Usd`='{$_POST['feeDeductNew_Usd']}' , 
`dues_totalReceivedNew_Usd`='{$_POST['amountUsdSimpleNew']}' , `dues_discountNew_Usd`='{$_POST['discountNew_Usd']}' , 
`statusPendRejAccpt`='".$statusPendRejAccpt."' 
WHERE id='{$_GET['schedule']}'  "; 
			
			/* if(isset($_GET['schedule'])){
				$schedule=$_GET['schedule'];
				
				$sql.=" and id='{$_GET['schedule']}'";
				} */
			mysql_query($sql) or die(mysql_error()); 
			/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
			$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '{$_GET['schedule']}' "));
			$make_regular_schedule="Course:".getData( nl2br( $row['courseID']),'course').",Teacher:".showUser( nl2br( $row['teacherID'])).",Student:". showStudents(nl2br( $row['studentID']))
							.",TranID:".nl2br( $_POST['transactionID']).",StartTime:".nl2br( $_POST['startTime'])
							.",BKDATE:".nl2br( $row['dateBooked']).",Class Days:".getData(nl2br( $row['classType']),'plan').",Status:".getData(nl2br( $row['std_status']),'stdStatusmo-list')
							.",CSDATE:".prepareDate($_POST['courseStart']).",CEDATE:".prepareDate($_POST['courseEnd']).",SignUp-DATE:".prepareDate($_POST['signInDate']).",PAYDATE:".prepareDate($_POST['paydate'])
							.",Amount:".nl2br( $_POST['amount']).",Method:".nl2br( $_POST['method']);
			user_log( $_SERVER['PHP_SELF'] , "MAKE_REG_SCHEDULE" , $_SESSION['userId'] ,$make_regular_schedule);

			///////////////////////////////////////////////////////

		getMessages('add');
		}	
}

} }	
else if (isset($_POST['submitted']) && empty($_POST['signInDate']) && empty($_POST['amount'])){
	getMessages('error');
	}
?>

<form action='' method='POST' onsubmit="return check_cardsave_transactionID_length(this);" enctype="multipart/form-data"> 
<div id="label">SignIn Date:</div><div id="field"><input required type='text' id='signInDate' name='signInDate' class="flexy_datepicker_input" onchange='date_rec_date_signin()'/> </div>
<div id="label">Transaction ID:</div><div id="field"><input required type='text' name='transactionID' id='transactionID'/> </div>
<div id="label">Date Received:</div><div id="field"><input required type='text' id='date' name='date' class="" readonly='readonly'/> </div>
<!--<div id="label">Recurring/Due Date:</div><div id="field"><input required type='text' name='dateRecieved' class="flexy_datepicker_input"/> </div>-->
<div id="label">Recurring-Paying/Due Date:</div><div id="field"><input required type='text' name='paydate' id='paydate' class="" readonly='readonly'/> </div>

<div id="label">Student:</div><div id="field"><?php echo getDataList(stripslashes($_GET['id']),'studentID',4);?> </div>
<div id="label">Course:</div><div id="field"><?php echo getData($_GET['crs'],'course');//getScheduleList(stripslashes($_GET['crs']));?> </div>
<div id="label">Class Plan:</div><div id="field"><?php echo getData($_GET['classType'],'plan');?></div>
<div id="label">Start Time:</div><div id="field"><input type="text"  name="startTime" readonly="readonly" id="startTime" value="<?php echo stripslashes($startTime); ?>" /></div> 
<div id="label">Method(ReadOnly):</div><div id="field"><input type='text' id='method' name='method' readonly="readonly"/> </div>
<div id="label">Method:</div><div id="field"><?php echo getList_payment_method('','method_new','paymentMode','','update_payment_method');?> </div>
<div id="label">CCV CODE:</div><div id="field"><input type="text" name="cardSave_ccv_code" id="cardSave_ccv_code" style="visibility:hidden;" placeholder='Enter Card Save CCV Code'/></div>
<div id="label">Card holder name:</div><div id="field"><input type="text" name="VirtualTerminal_name" id="VirtualTerminal_name" style="visibility:hidden;" placeholder='Enter Card Holder Name'/></div>
<div id="label">Card number:</div><div id="field"><input type="text" name="VirtualTerminal_number" id="VirtualTerminal_number" style="visibility:hidden;" placeholder='Enter Card Numebr'/></div>
<div id="label">Expiry date:</div><div id="field"><input type="text" name="VirtualTerminal_date" id="VirtualTerminal_date" style="visibility:hidden;" placeholder='Enter Expiry Date'/></div>

<!--Image upload for bank payment-->
<div id="label">Upload image WU/Bank/Phy:</div><div id="field"><input id="bank_payment_image" name="bank_payment_image" type="file" style="visibility:hidden;"/></div>
<!--/////////////////////////////-->

<!--********************************Bank dropdown************************************* -->
<div id="label">Bank Selection:</div><div id="field">
	<select id="bankName" name="bankName" style="visibility:hidden;" onchange="">
				<option value="">Select Bank:</option>
				<option value="1">HBL</option>
				<option value="2">ABL</option>
				<option value="3">ALFALAH</option>
				<option value="4">UBL</option>
				<option value="5">MCB</option>
				<option value="6">Soneri</option>
				<option value="7">Other</option>
	</select></div>
<!--<div id="label">Bank Selection:</div><div id="field"><?php //echo getList('','bankName','bankName');?> </div>-->


<!--********************************Testing for Currency conversion************************************* -->
<div id="label">Currency NEW:</div><div id="field">
	<select id="currency_id" name="currency_id" onchange="getCurrencyValue(this.value)">
				<option value="">Select Currency:</option>
				<option value="1">GBP</option>
				<option value="2">USD</option>
				<option value="3">CAD</option>
				<option value="4">AUD</option>
				<option value="5">NZD</option>
				<option value="6">SGD</option>
	</select></div>


<div id="label">Actual Slot rate: (Editable)</div><div id="field"><input type='text' id='amountDefaultNew' name='amountDefaultNew' value='<?= stripslashes($sql_amount['dues_original']) ?>'/> </div>
<div id="label">Invoiced Amount:</div><div id="field"><input type='text' id='amountOriginalNew' name='amountOriginalNew' onchange="javascript : reset_values();"  required/> </div>
<div id="label">Net Received:</div><div id="field"><input type='text' id='totalReceivedNew' name='totalReceivedNew' onchange="javascript : calculate_currency_conversion();" required/> </div>
<div id="label">Paypal Fee:</div><div id="field"><input type='text' id='feeDeductNew' name='feeDeductNew' readonly='readonly'  required/> </div>
<div id="label">Discount Given:</div><div id="field"><input type='text' id='discountNew' name='discountNew' readonly='readonly' required/> </div>

<div id="label" style='background-color:lime; color-black'>Net Converted Amount -USD :</div><div id="field"><input style='background-color:lime' type='text' id='amountUsdSimpleNew' name='amountUsdSimpleNew' readonly='readonly' required/> </div>

<!-- ****************************************************************************************************** -->
<div id="label">Sender Name:</div><div id="field"><input type='text' id='sender_name' name='sender_name' required/> </div>
<div id="label">Email:</div><div id="field"><input type='email' id='email' name='email' required/> </div>

<div id="label">Course Start Date:</div><div id="field"><input required type='text' name='courseStart' class="flexy_datepicker_input"/> </div>
<div id="label">Course End Date:</div><div id="field"><input type='text' name='courseEnd' readonly="readonly" value="<?php echo $end_date_readonly; ?>" class=""/> </div>
<div id="label">Campus:</div><div id="field"><?php echo getList('','campus','campus');?> </div> 
<!--<div id="label">Agent Commision:</div><div id="field"><input type='text' name='agent_id' /></div>
<div id="label">Teacher Commision:</div><div id="field"><input type='text' name='teacher_id' /></div>-->
<div id="label">Agent Commision:</div><div id="field"><?php echo getDataList_reference('','agent_id','');?></div>
<div id="label">Teacher Commision:</div><div id="field"><?php echo getDataList('','teacher_id',3);?></div>
<div id="label">Parent:</div><div id="field_sch_new"><div id="filter"><?php getParentFilter();?></div> </div>
<div id="label">Grade:</div><div id="field"><input name='grade' id='grade' type='number' placeholder="Enter digit" required/> </div>
<div id="label">Syllabus:</div><div id="field"><input name='syllabus' id='syllabus' required/> </div>
<div id="label">Comments:</div><div id="field"><textarea required name='comments' ></textarea> </div>
<div id="label">Recording Link:</div><div id="field"><input name='record_link' id='record_link' required/></div>
<div id="label"></div><div id="field"><input type='submit' value='Make Regular' /><input type='hidden' value='1' name='submitted' /></div> 

<div id="label" style='visibility:hidden'>Updated Currency value - AUTO:</div><div id="field"><div id="value_of_currency"><input type='hidden'  name='value_of_currency' /></div></div>
<div id="label"></div><div id="field"><input type='hidden' id='value_of_cad' name='value_of_cad' /></div>
<div id="label"></div><div id="field"><input type='hidden' id='simple_convert' name='simple_convert' /></div>
<div id="label" style='visibility:hidden'>Converted Amount-GBP:</div><div id="field"><input type='hidden' id='amount_gbp' name='amount_gbp'/> </div>
<div id="label" style='visibility:hidden'>Converted Amount-CAD:</div><div id="field"><input type='hidden' id='amount' name='amount'/> </div>
<!-- Old CAD values calculations-->
<div id="label">Original Amount:</div><div id="field"><input type='text' id='amount_original' name='amount_original' onchange="javascript : calculate_currency_conversion();" /> </div>
<div id="label" style='background-color:lime; color-black'>Converted Amount Simple-USD :</div><div id="field"><input style='background-color:lime' type='text' id='amount_usd_simple' name='amount_usd_simple' readonly='readonly' required/> </div>
<div id="label">Discount:</div><div id="field"><input type='text' name='discount'/> </div>

<!-- NEW VALUES -->
<div id="label" style='visibility:hidden'>Actual Slot USD:</div><div id="field"><input type='hidden' id='amountDefaultNew_Usd' name='amountDefaultNew_Usd' value='' readonly='readonly'/> </div>
<div id="label" style='visibility:hidden'>Invoiced Amount USD:</div><div id="field"><input type='hidden' id='amountOriginalNew_Usd' name='amountOriginalNew_Usd'  required/> </div>
<div id="label" style='visibility:hidden'>Paypal Fee  USD:</div><div id="field"><input type='hidden' id='feeDeductNew_Usd' name='feeDeductNew_Usd'  required/> </div>
<div id="label" style='visibility:hidden'>Discount USD :</div><div id="field"><input type='hidden' id='discountNew_Usd' name='discountNew_Usd' readonly='readonly' required/> </div>
<!-- USD value is now amountUsdSimpleNew-->
<!--<div id="label">Total Received USD :</div><div id="field"><input type='text' id='totalReceivedNew_Usd' name='totalReceivedNew_Usd' readonly='readonly' required/> </div>-->
<!-- NEW VALUES -->

</form> 
<? 
}
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
}

include('include/footer.php');?>