<? 
include('config.php');
include('include/header.php');  
$id = (int) $_GET['id'];

if (isset($_POST['submitted'])) {
	if(!empty($_POST['comments_ticket']!=''))
	{
		/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
		$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$id' "));
		/////////////////////////////////////////////////////// 
		
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
		
		
		$ticket_number = date('YmdHis');
		//Ticket number query INITIAL
		$sql_ticket="INSERT INTO campus_ticket_new_tn(studentID,ticket_number,date,teacherID,schedule_id,ttl,mttl,open_close) 
		VALUES('".$row['studentID']."','".$ticket_number."','".date('Y-m-d')."',
		'".$row['teacherID']."','".$id."','".$row_get_ttl_mttl['LeadId']."','".$row_get_ttl_mttl['main_LeadId']."' , '1')";
		mysql_query($sql_ticket);
		
		//Conversation query INITIAL
		$to_name = showUser( nl2br( $row_get_ttl_mttl['LeadId'] ));
		$sql_chat="INSERT INTO `campus_ticket_new_chat`(campus_ticket_new_chat.fromID,campus_ticket_new_chat.toID,campus_ticket_new_chat.from,campus_ticket_new_chat.to,message,sent,ticket_number) 
		VALUES('".$_SESSION['userId']."','".$row_get_ttl_mttl['LeadId']."',
		'".$_SESSION['userName']."' , '".$to_name."',
		'".$_POST['comments_ticket']."','".date('Y-m-d H:i:s')."','".$ticket_number."')";
		mysql_query($sql_chat) or die(mysql_error()); 
		
//////////////////////////////////// To SEND EMAIL on GENERATE_TICKET//////////////////////////////////
//SCHEDULE DETAILS EMAIL
$email_to_send_on_GENERATE_TICKET = "
<div align='center' style='color:Orange; font-size:20px; font-weight:bold'>Ticket From Student</div>
<table border=1 cellspacing=2px id='table_liquid' >
<tr align='center'>
<td colspan='7' style='color:Orange; background-color:purple; font-size:16px;'><b>Details are as following</b></td>
</tr>
<tr bgcolor=#eceff5>
<th class='specalt' style='font-size:12px'><b>Ticket number</b></th> 
<th class='specalt' style='font-size:12px'><b>Student</b></th> 
<th class='specalt' style='font-size:12px'><b>Teacher</b></th>
<th class='specalt' style='font-size:12px'><b>Course</b></th>
<th class='specalt' style='font-size:12px'><b>Class Days</b></th> 
<th class='specalt' style='font-size:12px'><b>Ticket Comments</b></th>
<th class='specalt' style='font-size:12px'><b>Date</b></th> 
</tr>";
$email_to_send_on_GENERATE_TICKET.="<tr bgcolor=#eceff5>
	<td valign='top' style='font-size:12px'>". $ticket_number ."</td>
	<td valign='top' style='font-size:12px'>". showStudents(nl2br( $row['studentID'])) ."</td>
	<td valign='top' style='font-size:12px'>". showUser( nl2br( $row['teacherID'])) ."</td>
	<td valign='top' style='font-size:12px'>". getData( nl2br( $row['courseID']),'course') ."</td>
	<td valign='top' style='font-size:12px'>". getData(nl2br( $row['classType']),'plan') ."</td>
	<td valign='top' style='font-size:12px'>". $_POST['comments_ticket'] ."</td>
	<td valign='top' style='font-size:12px'>". date('Y-m-d') ."</td>
	</tr></table>";
	
//STUDENT TICKET NUMBER EMAIL
$email_to_send_TICKET_TO_STUDENT = "Hello  <b>".showStudents($_SESSION['userId'])."</b> , <br><br>
Thank you for contacting YCC Support. <br><br>
Your ticket number <b>".$ticket_number."</b> has been received, and is being reviewed by Shift Manager/TeamLead. <br><br>
URL: www.yourcloudcampus.com<br>
Skype: yourcloudcampus<br>
AUS  : 280-911-200<br>
U.S.A: 215-764-6162<br>
U.K  : 121-288-3093<br>
"
;



?>
<input rows="10" cols="90" id='email_to_send_on_GENERATE_TICKET' name='email_to_send_on_GENERATE_TICKET' readonly="readonly" type='hidden' value="<?php echo $email_to_send_on_GENERATE_TICKET; ?>"/>
<input id='ttl_ticket_email' name='ttl_ticket_email' readonly="readonly" type='hidden' value="<?php echo $row_get_ttl_email['email']; ?>"/>
<input id='mttl_ticket_email' name='mttl_ticket_email' readonly="readonly" type='hidden' value="<?php echo $row_get_mttl_email['email']; ?>"/>

<input rows="10" cols="90" id='email_to_send_TICKET_TO_STUDENT' name='email_to_send_TICKET_TO_STUDENT' readonly="readonly" type='hidden' value="<?php echo $email_to_send_TICKET_TO_STUDENT; ?>"/>
<input id='student_ticket_email' name='student_ticket_email' readonly="readonly" type='hidden' value="<?php echo $row_get_student_email['email']; ?>"/>

<?
//if($std_status==2){
echo '<script> email_to_send_on_GENERATE_TICKET(); </script>';
echo '<script> email_to_send_TICKET_TO_STUDENT(); </script>';
//}
/////////////////////////////////////////////////////
		
		getMessages('generate_ticket');
	}
	else
	{
		getMessages('error');
	}

}
?>
<form action='' method='POST' onsubmit="return checkLength(this);">
<div id="label">Ticket/Enquiry:</div><div id="field"><textarea name='comments_ticket' id='comments_ticket' required></textarea></div>  
<div id="label"></div><div id="field"><input type='submit' value='Send Ticket' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<?include('include/footer.php');?> 