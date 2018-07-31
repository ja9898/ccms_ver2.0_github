<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 
$sch_id = (int) $_GET['sch_id']; 

if(isset($id) && $id!='')
/////////////////////////////////////////////////////// 
{
	mysql_query("UPDATE `campus_ticket_new_tn` SET open_close=2 WHERE `id` = '$id' ") ; 

	$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$sch_id' "));
	
	$sql_get_ttl_mttl="SELECT * FROM capmus_users WHERE id='".$row['teacherID']."'";
	$row_get_ttl_mttl = mysql_fetch_array ( mysql_query($sql_get_ttl_mttl));
	
	//TTL and MTTL email		START
	$sql_get_ttl_email="SELECT * FROM capmus_users WHERE id='".$row_get_ttl_mttl['LeadId']."'";
	$row_get_ttl_email = mysql_fetch_array ( mysql_query($sql_get_ttl_email));		
	$sql_get_mttl_email="SELECT * FROM capmus_users WHERE id='".$row_get_ttl_mttl['main_LeadId']."'";
	$row_get_mttl_email = mysql_fetch_array ( mysql_query($sql_get_mttl_email));
	//TTL and MTTL email		END
	
	//STUDENT email		START
	$sql_get_student_email="SELECT * FROM campus_students WHERE id='".$row['studentID']."'";
	$row_get_student_email = mysql_fetch_array ( mysql_query($sql_get_student_email));		
	//STUDENT email		END
	
	//Ticker number		START
	$sql_get_tn="SELECT * FROM campus_ticket_new_tn WHERE id='".$id."'";
	$row_get_tn = mysql_fetch_array ( mysql_query($sql_get_tn));		
	//Ticker number		END
	
//STUDENT TICKET NUMBER EMAIL
$email_to_send_TICKET_CLOSED_TO_STUDENT = "Hello  <b>".showStudents($row_get_tn['studentID'])." </b> , <br><br>
Thank you for contacting YCC Support. <br><br>
Your ticket number <b>".$row_get_tn['ticket_number']."</b> is CLOSED and has been resolved,  <br><br>
If you have any queries , Please GENERATE TICKET from your DAILY SCHEDULE <br><br>
URL: www.yourcloudcampus.com<br>
Skype: yourcloudcampus<br>
AUS  : 280-911-200<br>
U.S.A: 215-764-6162<br>
U.K  : 121-288-3093<br>";
?>

<input rows="10" cols="90" id='email_to_send_TICKET_CLOSED_TO_STUDENT' name='email_to_send_TICKET_CLOSED_TO_STUDENT' readonly="readonly" type='hidden' value="<?php echo $email_to_send_TICKET_CLOSED_TO_STUDENT; ?>"/>

<input id='ttl_ticket_email' name='ttl_ticket_email' readonly="readonly" type='hidden' value="<?php echo $row_get_ttl_email['email']; ?>"/>
<input id='mttl_ticket_email' name='mttl_ticket_email' readonly="readonly" type='hidden' value="<?php echo $row_get_mttl_email['email']; ?>"/>
<input id='student_ticket_email' name='student_ticket_email' readonly="readonly" type='hidden' value="<?php echo $row_get_student_email['email']; ?>"/>

	
<?	
echo '<script> email_to_send_TICKET_CLOSED_TO_STUDENT(); </script>';
}
///////////////////////////////////////////////////////
getMessages('edit','ticket_list.php');
include('include/footer.php');?>