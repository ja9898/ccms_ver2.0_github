<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


<br>
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','stdStatus','stdStatusmo-list');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
</div>
<?
echo $result="SELECT campus_schedule.id,campus_schedule.duedate as due_date,
	day(campus_schedule.duedate) AS dayz,month(campus_schedule.duedate) AS month,
	campus_schedule.dues as amount,campus_schedule.studentID,campus_schedule.courseID,
	campus_schedule.classType,campus_schedule.`status`,
	campus_schedule.std_status,campus_schedule.std_status_old,campus_schedule.startTime,
	campus_schedule.dues_original,campus_schedule.courseID,
	
	campus_transaction.id as tran_id,campus_transaction.transactionID,campus_transaction.date as date_rec_cam_tran,campus_transaction.studentID,
	campus_transaction.amount as amounttran,campus_transaction.operator as tran_op,campus_transaction.courseID as tran_cid,campus_transaction.classType as tran_ctid,
	campus_transaction.dateRecieved as maxdate_rec,campus_transaction.startTime,campus_transaction.schedule_id,campus_transaction.comments,campus_transaction.teacherID,
	campus_transaction.method,campus_transaction.method_array,campus_transaction.LeadId,campus_transaction.main_LeadId,
	campus_transaction.sender_name,campus_transaction.email, 
	campus_transaction.currency_array,campus_transaction.amount_gbp as amounttran_gbp, 
	campus_transaction.amount_original as amounttran_original,campus_transaction.campus,
	campus_transaction.agent_id,campus_transaction.agentLeadId,campus_transaction.main_agentLeadId,
	campus_transaction.accounts_chk,campus_transaction.accounts_comment,
	campus_transaction.agent_comm,campus_transaction.teacher_comm,campus_transaction.cardSave_ccv_code,
	campus_transaction.amount_usd_simple,
	campus_transaction.datetime_now_accounts,campus_transaction.bank_payment_image_filepath,
	campus_transaction.discount_tran,campus_transaction.amount_original_deducted,
	campus_transaction.bankNameId, 
	campus_transaction.amountDefaultNew,campus_transaction.amountOriginalNew,campus_transaction.feeDeductNew,
	campus_transaction.totalReceivedNew,campus_transaction.discountNew,
	campus_transaction.amountDefaultNew_Usd,campus_transaction.amountOriginalNew_Usd,campus_transaction.feeDeductNew_Usd,
	campus_transaction.totalReceivedNew_Usd,campus_transaction.discountNew_Usd,
	campus_transaction.statusPendRejAccpt,campus_transaction.statusPendRejAccpt_User ,
	
	campus_transaction.amount_original_old,campus_transaction.amount_old,
	campus_transaction.discount_tran_old 
	
	FROM campus_schedule 
	INNER JOIN campus_transaction 
	ON campus_schedule.studentID=campus_transaction.studentID and campus_schedule.id=campus_transaction.schedule_id 
	and campus_schedule.`status` =1  and campus_transaction.statusPendRejAccpt=1 and 
	campus_transaction.date BETWEEN '2018-08-01' AND '2018-08-31' and campus_transaction.date!='' ";

	$rowcount = mysql_num_rows($result);
	$result=mysql_query($result);
//Get 1 USA/CAD/AUS/GBP/NZD/SGD to usd rate from db
$sql_original_currency="SELECT * FROM campus_currency WHERE id = 1208";
$row_curr_to_dollar_rate = mysql_fetch_array(mysql_query($sql_original_currency));

	
while($row = mysql_fetch_array($result)){

/* if($row['currency_array']==2){ 
	$amountDefaultNew_Usd = round($row['payment_local']*$row_curr_to_dollar_rate['1_usd_to_usd'],2);
}
if($row['currency_array']==1){ 
	$amountDefaultNew_Usd = round($row_auto_transact['payment_local']*$row_curr_to_dollar_rate['1_gbp_to_usd'],2);
}
if($row['currency_array']==4){ 
	$amountDefaultNew_Usd = round($row_auto_transact['payment_local']*$row_curr_to_dollar_rate['1_aud_to_usd'],2);
}
if($row['currency_array']==3){ 
	$amountDefaultNew_Usd = round($row_auto_transact['payment_local']*$row_curr_to_dollar_rate['1_cad_to_usd_new'],2);
}
if($row['currency_array']==5){ 
	$amountDefaultNew_Usd = round($row_auto_transact['payment_local']*$row_curr_to_dollar_rate['1_nzd_to_usd'],2);
}
if($row['currency_array']==6){ 
	$amountDefaultNew_Usd = round($row_auto_transact['payment_local']*$row_curr_to_dollar_rate['1_sgd_to_usd'],2);
}
					
 */

echo $update_amount="UPDATE campus_transaction  
SET campus_transaction.amount='".$row['amount_old']."',
campus_transaction.amount_original='".$row['amount_original_old']."', 
campus_transaction.discount_tran='".$row['discount_tran_old']."' 
WHERE campus_transaction.id='".$row['tran_id']."' ";
echo "<br>";
echo "TRAN schid:".$row['schedule_id'];echo "<br>";
echo "schid:".$row['id'];echo "<br>";echo "<br>";

//$out=mysql_query($update_amount);
  
  







/*if($row['statussch']=='1'){

echo "
<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['id']}>Make Regular</a></td> ";} */

} 

echo "<a href=# class=button>New Row</a>"; 
include('include/footer.php');
?>