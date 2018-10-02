<? 
include('config.php'); 
include('include/header.php'); 

$id_new = (int) $_GET['id'];
$schedule=$_GET['schedule'];
$crs=$_GET['crs'];
$classType=$_GET['classType'];
$due_date=$_GET['due_date'];
$pay_date=$_GET['pay_date'];
$startTime=$_GET['startTime'];	//NEWLY ADDED for more campus_schedule and campus_transaction records match, Added on 28-06-2013
$teacherID=$_GET['teacherID'];	//Newly added for commision , 03-10-2013

//$duedate_date_for_recurr_date = date('d', strtotime( nl2br($pay_date)));		//	NEWLY ADDED**
//$current_month_for_recurr_date = date('m');									//	NEWLY ADDED ***NOW OBSOLETE
//$current_year_for_recurr_date = date('Y');									//	NEWLY ADDED**

if(date('m')==12)
{
	$paydate_date_for_recurr_date = date('d', strtotime( nl2br($pay_date)));	//	NEWLY ADDED
	$current_month_for_recurr_date = date('m');									//	NEWLY ADDED	//29-06-2013
	$current_month_for_recurr_date = date('m') - 11;
	$current_year_for_recurr_date = date('Y') + 1;									//	NEWLY ADDED
	$complete_recurr_date = date('Y-m-d', strtotime( $current_year_for_recurr_date."-".$current_month_for_recurr_date."-".$paydate_date_for_recurr_date));
	//Adding for NEXT MONTH for the 1st of month for salary commision calculations
	$first_date_for_salary_comm = 01;	
	$current_month_for_salary_comm = date('m');									//	NEWLY ADDED	//16-03-2017
	$current_month_for_salary_comm = date('m') - 11;
	$current_year_for_salary_comm = date('Y') + 1;
	$salary_comm_date_fixed = date('Y-m-d', strtotime( $current_year_for_salary_comm."-".$current_month_for_salary_comm."-".$first_date_for_salary_comm));
	//////////////////////////////////////////////////////////////////////////////
}
else
{
	$paydate_date_for_recurr_date = date('d', strtotime( nl2br($pay_date)));	//	NEWLY ADDED
	$current_month_for_recurr_date = date('m');									//	NEWLY ADDED	//29-06-2013
	$current_month_for_recurr_date = date('m') + 1;
	$current_year_for_recurr_date = date('Y');									//	NEWLY ADDED
	$complete_recurr_date = date('Y-m-d', strtotime( $current_year_for_recurr_date."-".$current_month_for_recurr_date."-".$paydate_date_for_recurr_date));
	//Adding for NEXT MONTH for the 1st of month for salary commision calculations
	$first_date_for_salary_comm = 01;	
	$current_month_for_salary_comm = date('m');									//	NEWLY ADDED	//29-06-2013
	$current_month_for_salary_comm = date('m') + 1;
	$current_year_for_salary_comm = date('Y');
	$salary_comm_date_fixed = date('Y-m-d', strtotime( $current_year_for_salary_comm."-".$current_month_for_salary_comm."-".$first_date_for_salary_comm));
	//////////////////////////////////////////////////////////////////////////////
}


$sql_amount = mysql_fetch_array (mysql_query("SELECT * FROM campus_schedule WHERE id='{$_GET['schedule']}' and studentID='$id_new' and courseID='$crs' and classType='$classType' and startTime='$startTime'")) or die(mysql_error());

$sql_get_LEAD_and_MAINLEAD = mysql_fetch_array (mysql_query("SELECT * FROM capmus_users WHERE id='$teacherID'")) or die(mysql_error());
$LeadId = $sql_get_LEAD_and_MAINLEAD['LeadId'];
$main_LeadId = $sql_get_LEAD_and_MAINLEAD['main_LeadId'];

//Adding for DATE RECEIVED that has to be fixed according to systemdate, CCMS bas Only // 09-09-2015
$systemdate = systemDate();

if (isset($_POST['submitted']) && $_POST['amount'] >=0 ) {

//Transaction ID duplication check regardless of the STUDENTID and SCHEDULEID
$sql_check_duplication_tran = ("SELECT * FROM campus_transaction WHERE   
								transactionID='{$_POST['transactionID']}' ") or die(mysql_error());
$sql_check_duplication_tran_result = mysql_query($sql_check_duplication_tran);
$row_count = mysql_num_rows($sql_check_duplication_tran_result);
//Samemonth dual tran check against the schedule ID
$sql_check_SAMEMONTH_dual_tran = ("SELECT * FROM campus_transaction WHERE schedule_id='{$_GET['schedule']}' 
								and dateRecieved='{$_POST['dateRecieved']}' ") or die(mysql_error());
$sql_check_SAMEMONTH_dual_tran_result = mysql_query($sql_check_SAMEMONTH_dual_tran);
$row_count_SAMEMONTH_dual_tran = mysql_num_rows($sql_check_SAMEMONTH_dual_tran_result);

if($row_count>=1)
{
getMessages('error');
}

else if($row_count_SAMEMONTH_dual_tran>0)
{
getMessages('samemonth_dual_tran_not_allowed_error');
}

else if(($_SESSION['userType']==8 || $_SESSION['userType']==15) && $_POST['amount']==0)
{
getMessages('transaction_with_zero_error');
}

else
{

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
		$sql = "INSERT INTO `campus_transaction` ( `transactionID` ,  `date` ,  `studentID` , `teacherID` , `schedule_id` ,  `courseID` ,  `method` , `method_array` , `currency_array` , `amount_original` , `amount_gbp` , `amount` , `discount_tran` ,`comments` ,`operator`, `classType` , `startTime` , `dateRecieved` , `LeadId` , `main_LeadId` , `sender_name` , `email` , `cardSave_ccv_code` , `amount_usd_simple` , `VirtualTerminal_name` , `VirtualTerminal_number` , `VirtualTerminal_date` , `datetime_now_accounts` , `bank_payment_image_filepath` , `bankNameId` , 
		`amountDefaultNew` , `amountOriginalNew` , `feeDeductNew` , `totalReceivedNew` , `discountNew` ,
		`amountDefaultNew_Usd` , `amountOriginalNew_Usd` , `feeDeductNew_Usd` , 
		`totalReceivedNew_Usd` , `discountNew_Usd` , `statusPendRejAccpt` ) 
		VALUES(  '{$_POST['transactionID']}' ,  '".prepareDate($_POST['date'])."' , '{$_POST['studentID']}' , '".$teacherID."' , '".$schedule."'  , '{$sql_amount['courseID']}' ,  '{$_POST['method']}' , '{$_POST['method_new']}'  , '{$_POST['currency_id']}' , '{$_POST['amountDefaultNew']}' , '{$_POST['amount_gbp']}' , '{$_POST['amountDefaultNew_Usd']}' , '{$_POST['discountNew_Usd']}' , '{$_POST['comments']}' , '".$_SESSION['userId']."', '".$classType."' , '".$startTime."' ,'".prepareDate($_POST['dateRecieved'])."' , '".$LeadId."' , '".$main_LeadId."' , '{$_POST['sender_name']}' , '{$_POST['email']}' , '{$_POST['cardSave_ccv_code']}' , '{$_POST['amount_usd_simple']}' , '{$_POST['VirtualTerminal_name']}' , '{$_POST['VirtualTerminal_number']}' , '{$_POST['VirtualTerminal_date']}' , NOW() , '".$filepath."' , '{$_POST['bankName']}' , 
		'{$_POST['amountDefaultNew']}' , '{$_POST['amountOriginalNew']}' , '{$_POST['feeDeductNew']}' , 
		'{$_POST['totalReceivedNew']}' , '{$_POST['discountNew']}' , 
		'{$_POST['amountDefaultNew_Usd']}' , '{$_POST['amountOriginalNew_Usd']}' , '{$_POST['feeDeductNew_Usd']}' , 
		'{$_POST['amountUsdSimpleNew']}' , '{$_POST['discountNew_Usd']}' , '".$statusPendRejAccpt."' ) "; 
		mysql_query($sql) or die(mysql_error());
		$sql = "UPDATE `campus_students` SET    `std_status` =  '2'    WHERE `id` = '{$_POST['studentID']}' "; 

		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	NEWLY ADDED
		$sql_discount = "UPDATE campus_schedule SET discount = '{$_POST['discount']}' WHERE studentID = '{$_POST['studentID']}' and courseID = '{$_POST['courseID']}' and classType='{$_POST['classType']}' and startTime='{$_POST['startTime']}'";
		if(isset($_GET['schedule'])){
				$schedule_discount=$_GET['schedule'];
				
				$sql_discount.=" and id='{$_GET['schedule']}'";
				}
		mysql_query($sql_discount) or die(mysql_error());

		////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

		/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
		 $add_transaction="TranID:".nl2br( $_POST['transactionID']).",StartTime:".nl2br($sql_amount['startTime']).",Date_Recvd:".prepareDate( $_POST['date'])
						.",Date_Recur/PAY:". prepareDate( $_POST['dateRecieved'])
						.",Student:".showStudents(nl2br( $_POST['studentID'])).",Course:".showCourse(nl2br($sql_amount['courseID'])).",ClassType:".getData(nl2br( $sql_amount['classType']),'plan')
						.",Method:".nl2br( $_POST['method']).",Method_array:".nl2br( $_POST['method_new'])
						.",Person:".$_SESSION['userName']
						.",Amount:".nl2br($_POST['amount']).",Signup_Amt:".nl2br($_POST['amount_default']).",Discount:".nl2br($_POST['discount']);

						user_log( $_SERVER['PHP_SELF'] , "ADD_TRANSACTION_NEXT_DUE" , $_SESSION['userId'] ,$add_transaction, $_POST['comments']);
		 ///////////////////////////////////////////////////////
		echo showStudents(nl2br( $_POST['studentID']))."<br>";
		echo showCourse(nl2br($sql_amount['courseID']));


		if($_POST['std_status']!='2'){
			mysql_query($sql) or die(mysql_error()); 
		getMessages('add');
		}
	}			
} //old if of image upload
/////////////////////////////////////////////

else if($_FILES["bank_payment_image"]["size"]>200000 && ($_POST['method_new']==2 || $_POST['method_new']==3 || $_POST['method_new']==4))// elseif of the if IMAGE UPLOAD
{
	if($_FILES["lecture_file"]["name"]=="" || $_FILES["bank_payment_image"]["size"]>200000)
	{
		echo "<script>alert('Invalid File Selection OR File is bigger than 200KB, Data cannot be inserted')</script>";
		getMessages('error');
	}
}
else {
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
$sql = "INSERT INTO `campus_transaction` ( `transactionID` ,  `date` ,  `studentID` , `teacherID` , `schedule_id` ,  `courseID` ,  `method` , `method_array` , `currency_array` , `amount_original` , `amount_gbp` , `amount` , `discount_tran` ,`comments` ,`operator`, `classType` , `startTime` , `dateRecieved` , `LeadId` , `main_LeadId` , `sender_name` , `email` , `cardSave_ccv_code` , `amount_usd_simple` , `VirtualTerminal_name` , `VirtualTerminal_number` , `VirtualTerminal_date` , `datetime_now_accounts` , `bankNameId` , 
`amountDefaultNew` , `amountOriginalNew` , `feeDeductNew` , `totalReceivedNew` , `discountNew` ,
`amountDefaultNew_Usd` , `amountOriginalNew_Usd` , `feeDeductNew_Usd` , 
`totalReceivedNew_Usd` , `discountNew_Usd` , `statusPendRejAccpt` ) 
VALUES(  '{$_POST['transactionID']}' ,  '".prepareDate($_POST['date'])."' , '{$_POST['studentID']}' , '".$teacherID."' , '".$schedule."'  , '{$sql_amount['courseID']}' ,  '{$_POST['method']}' , '{$_POST['method_new']}'  , '{$_POST['currency_id']}' , '{$_POST['amountDefaultNew']}' , '{$_POST['amount_gbp']}' , '{$_POST['amountDefaultNew_Usd']}' , '{$_POST['discountNew_Usd']}' , '{$_POST['comments']}' , '".$_SESSION['userId']."', '".$classType."' , '".$startTime."' ,'".prepareDate($_POST['dateRecieved'])."' , '".$LeadId."' , '".$main_LeadId."' , '{$_POST['sender_name']}' , '{$_POST['email']}' , '{$_POST['cardSave_ccv_code']}' , '{$_POST['amount_usd_simple']}' , '{$_POST['VirtualTerminal_name']}' , '{$_POST['VirtualTerminal_number']}' , '{$_POST['VirtualTerminal_date']}' , NOW() , '{$_POST['bankName']}' , 
'{$_POST['amountDefaultNew']}' , '{$_POST['amountOriginalNew']}' , '{$_POST['feeDeductNew']}' , 
'{$_POST['totalReceivedNew']}' , '{$_POST['discountNew']}' , 
'{$_POST['amountDefaultNew_Usd']}' , '{$_POST['amountOriginalNew_Usd']}' , '{$_POST['feeDeductNew_Usd']}' , 
'{$_POST['amountUsdSimpleNew']}' , '{$_POST['discountNew_Usd']}' , '".$statusPendRejAccpt."' ) "; 
mysql_query($sql) or die(mysql_error());
$sql = "UPDATE `campus_students` SET    `std_status` =  '2'    WHERE `id` = '{$_POST['studentID']}' "; 

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////	NEWLY ADDED
$sql_discount = "UPDATE campus_schedule SET discount = '{$_POST['discount']}' WHERE studentID = '{$_POST['studentID']}' and courseID = '{$_POST['courseID']}' and classType='{$_POST['classType']}' and startTime='{$_POST['startTime']}'";
if(isset($_GET['schedule'])){
		$schedule_discount=$_GET['schedule'];
		
		$sql_discount.=" and id='{$_GET['schedule']}'";
		}
mysql_query($sql_discount) or die(mysql_error());

////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
 $add_transaction="TranID:".nl2br( $_POST['transactionID']).",StartTime:".nl2br($sql_amount['startTime']).",Date_Recvd:".prepareDate( $_POST['date'])
				.",Date_Recur/PAY:". prepareDate( $_POST['dateRecieved'])
				.",Student:".showStudents(nl2br( $_POST['studentID'])).",Course:".showCourse(nl2br($sql_amount['courseID'])).",ClassType:".getData(nl2br( $sql_amount['classType']),'plan')
				.",Method:".nl2br( $_POST['method']).",Method_array:".nl2br( $_POST['method_new'])
				.",Person:".$_SESSION['userName']
				.",Amount:".nl2br($_POST['amount']).",Signup_Amt:".nl2br($_POST['amount_default']).",Discount:".nl2br($_POST['discount']);

				user_log( $_SERVER['PHP_SELF'] , "ADD_TRANSACTION_NEXT_DUE" , $_SESSION['userId'] ,$add_transaction, $_POST['comments']);
 ///////////////////////////////////////////////////////
echo showStudents(nl2br( $_POST['studentID']))."<br>";
echo showCourse(nl2br($sql_amount['courseID']));


if($_POST['std_status']!='2'){
	mysql_query($sql) or die(mysql_error()); 
getMessages('add');
} //}//if NEW end of Image upload
	} //inner ELSE of Image upload end 
}//outer else END 
}
?>

<form action='' method='POST' onsubmit="return check_cardsave_transactionID_length(this);" enctype="multipart/form-data"> 
<div id="label">SignUp Date(Read only):</div><div id="field"><label name='due_date-readonly'><?php echo $due_date ?> </label></div>
<div id="label">Teacher Name:</div><div id="field"><label name='teacher-readonly'><?php echo showUser($teacherID); ?> </label></div>

<div id="label">TransactionID:</div><div id="field"><input type='text' name='transactionID' id='transactionID'/> </div>
<?php if($_SESSION['userId']==159 || $_SESSION['userId']==195 || $_SESSION['userId']==227) {   ?>
<div id="label">Date Received:</div><div id="field"><input type='text' name='date' class="flexy_datepicker_input"/> </div>
<?php } else {   ?>
<div id="label">Date Received:</div><div id="field"><input type='text' name='date' value='<?php echo $salary_comm_date_fixed; ?>' readonly='readonly'/> </div>
<?php } ?>
<!--OLD <div id="label">Recurring/Due Date:</div><div id="field"><input type='text' name='dateRecieved' class="flexy_datepicker_input"/> </div>-->

<!--NEW - SignUp Date DATE is EQUAL to RECURRING/DUE DATE DATE -->
<div id="label">Recurring/Due Date:</div><div id="field"><input type='text' name='dateRecieved' value='<?=$complete_recurr_date ?>' readonly='readonly'/> </div>
<!--WRONG <div id="label">StudentID:</div><div id="field" ><?php //echo getDataList(stripslashes($_GET['id']),'studentID',4);?> </div>-->
<!--WRONG <div id="label">StudentID:</div><div id="field" ><?php //echo getDataList_transaction_new(stripslashes($_GET['id']),'studentID',4);?> </div>-->
<div id="label">StudentID Label:</div><div id="field" name=""><?php echo getDataList_transaction_new2(stripslashes($_GET['id']),'studentID',4); ?> </div>
<input type='hidden' value='<?=$id_new ?>' name='studentID' />
<div id="label">Course:</div><div id="field"><?php echo getData(stripslashes($sql_amount['courseID']),'course');//WRONG getScheduleList(stripslashes($_GET['id']));?> </div>
<div id="label">Class Plan:</div><div id="field"><?php echo getData(stripslashes($sql_amount['classType']),'plan');//WRONG getScheduleList(stripslashes($_GET['id']));?> </div>
<div id="label">Start Time:</div><div id="field"><input type="text"  name="startTime" readonly="readonly" id="startTime" value="<?php echo stripslashes($sql_amount['startTime']); ?>" /></div> 
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
				<option value="7">PKR</option>				
	</select></div>
<div id="label">Actual Slot rate: (Editable)</div><div id="field"><input type='text' id='amountDefaultNew' name='amountDefaultNew' value='<?= stripslashes($sql_amount['dues_original']) ?>'  readonly='readonly'/> </div>
<div id="label">Invoiced Amount:</div><div id="field"><input type='text' id='amountOriginalNew' name='amountOriginalNew' onchange="javascript : reset_values();"  required/> </div>
<div id="label">Net Received:</div><div id="field"><input type='text' id='totalReceivedNew' name='totalReceivedNew' onchange="javascript : calculate_received_discount_amount();" required/> </div>
<div id="label">Paypal Fee:</div><div id="field"><input type='text' id='feeDeductNew' name='feeDeductNew' readonly='readonly'  required/> </div>
<div id="label">Discount Given:</div><div id="field"><input type='text' id='discountNew' name='discountNew' readonly='readonly' required/> </div>
<div id="label" style='background-color:lime; color-black'>Net Converted Amount -USD :</div><div id="field"><input style='background-color:lime' type='text' id='amountUsdSimpleNew' name='amountUsdSimpleNew' readonly='readonly' required/> </div>
<!-- ****************************************************************************************************** -->
<div id="label">Sender Name:</div><div id="field"><input type='text' id='sender_name' name='sender_name' required/> </div>
<div id="label">Email:</div><div id="field"><input type='email' id='email' name='email' required/> </div>
<div id="label">Comments:</div><div id="field"><textarea name='comments' id='comments' ><?php echo stripslashes($row['comments']);?></textarea></div> 
<div id="label"></div><div id="field"><input type='submit' value='Add Fee' /><input type='hidden' value='1' name='submitted' /></div> 



<!--FOLLOWING FIELDS ARE HIDDEN to shorten the form for PAY		//NEWLY ADDED 16-01-17-->
<div id="label" style='visibility:hidden'>Updated Currency value - AUTO:</div><div id="field"><div id="value_of_currency"><input type='hidden'  name='value_of_currency' /></div></div>
<div id="label"></div><div id="field"><input type='hidden' id='value_of_cad' name='value_of_cad' /></div>
<div id="label"></div><div id="field"><input type='hidden' id='simple_convert' name='simple_convert' /></div>
<div id="label" style='visibility:hidden'>Converted Amount-GBP:</div><div id="field"><input type='hidden' id='amount_gbp' name='amount_gbp' readonly='readonly' required/> </div>
<!--<div id="label">Converted Amount-CAD:</div><div id="field"><input type='text' id='amount' name='amount' onchange="javascript : calculate_discount();" required/> </div>-->
<div id="label" style='visibility:hidden'>Converted Amount-CAD:</div><div id="field"><input type='hidden' id='amount' name='amount' readonly='readonly' required/> </div>
<!-- Old CAD values calculations-->
<div id="label" style='visibility:hidden'>Original Amount:</div><div id="field"><input type='hidden' id='amount_original' name='amount_original' onchange="javascript : calculate_currency_conversion_with_discount();" required/> </div>
<div id="label" style='visibility:hidden'>SignUp Amount:</div><div id="field"><input type='hidden' id='amount_default' name='amount_default' value='<?= stripslashes($sql_amount['dues']) ?>' readonly='readonly'/> </div>
<div id="label" style='visibility:hidden'>Discount:</div><div id="field"><input type='hidden' id='discount' name='discount' readonly='readonly' required/> </div>
<div id="label" style='visibility:hidden; background-color:lime; color-black'>Converted Amount Simple-USD :</div><div id="field"><input style='background-color:lime' type='hidden' id='amount_usd_simple' name='amount_usd_simple' readonly='readonly' required/> </div>

<!-- NEW VALUES -->
<div id="label" style='visibility:hidden'>Actual Slot USD:</div><div id="field"><input type='hidden' id='amountDefaultNew_Usd' name='amountDefaultNew_Usd' value='' readonly='readonly'/> </div>
<div id="label" style='visibility:hidden'>Invoiced Amount USD:</div><div id="field"><input type='hidden' id='amountOriginalNew_Usd' name='amountOriginalNew_Usd'  required/> </div>
<div id="label" style='visibility:hidden'>Paypal Fee  USD:</div><div id="field"><input type='hidden' id='feeDeductNew_Usd' name='feeDeductNew_Usd'  required/> </div>
<div id="label" style='visibility:hidden'>Discount USD :</div><div id="field"><input type='hidden' id='discountNew_Usd' name='discountNew_Usd' readonly='readonly' required/> </div>
<!-- USD value is now amountUsdSimpleNew-->
<!--<div id="label">Total Received USD :</div><div id="field"><input type='text' id='totalReceivedNew_Usd' name='totalReceivedNew_Usd' readonly='readonly' required/> </div>-->
<!-- NEW VALUES -->
</form> 
<? include('include/footer.php');?>