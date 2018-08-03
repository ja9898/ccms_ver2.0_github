<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id'];
$tn = $_GET['tn'];
$sch_id = $_GET['sch_id'];
if($_SESSION['userType']==8){
$to_name = showStudents( nl2br( $id ));
}
else{
$to_name = showUser( nl2br( $id ));
}
//echo "<script>window.location.href = 'chat_panel.php'".$id."</script>";

//Query to make the messages recd column from 0 to 1, It means that the link is clicked, 
//and messages are in READ state or READ by the USER
$sql_read_unread="UPDATE chat SET recd=1 WHERE (`toID` = '".$_SESSION['userId']."' and `fromID` = '".$id."') and recd=0";
$result_sql_read_unread= mysql_query($sql_read_unread) or die(mysql_error());  
if (isset($_POST['submitted'])) { 

	if(!empty($_POST['chat_msg']) ){

	$from_name = showUser( nl2br( $_SESSION['userId']));

	$sql = "INSERT INTO `campus_ticket_new_chat`(campus_ticket_new_chat.fromID,campus_ticket_new_chat.toID,
	campus_ticket_new_chat.from,campus_ticket_new_chat.to,
	message,sent,ticket_number)  
	VALUES('".$_SESSION['userId']."','".$id."', '".$_SESSION['userName']."' , '".$to_name."' , 
	'".$_POST['chat_msg']."',NOW(),'".$tn."')"; 
	//exit;
	mysql_query($sql) or die(mysql_error()); 
	
		if($_SESSION['userType']==8){
			//Get schedule details
			$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$sch_id' "));
			
			$sql_get_ttl_mttl="SELECT * FROM capmus_users WHERE id='".$row['teacherID']."'";
			$row_get_ttl_mttl = mysql_fetch_array ( mysql_query($sql_get_ttl_mttl));
			
			//get student email		START
			$sql_get_student_email="SELECT * FROM campus_students WHERE id='".$row['studentID']."'";
			$row_get_student_email = mysql_fetch_array ( mysql_query($sql_get_student_email));		
			//get student email		END	
					
			//////////////////////////////////// To SEND EMAIL on REPLY_TICKET//////////////////////////////////
			$email_to_send_on_REPLY_TICKET = "
			<div align='center' style='color:Orange; font-size:20px; font-weight:bold'>Ticket Reply From TeamLead</div>
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
			<th class='specalt' style='font-size:12px'><b>Ticket Reply</b></th>
			<th class='specalt' style='font-size:12px'><b>Date</b></th>
			</tr>";

			$email_to_send_on_REPLY_TICKET.="<tr bgcolor=#eceff5>
				<td valign='top' style='font-size:12px'>". $tn ."</td>
				<td valign='top' style='font-size:12px'>". showStudents(nl2br( $row['studentID'])) ."</td>
				<td valign='top' style='font-size:12px'>". showUser( nl2br( $row['teacherID'])) ."</td>
				<td valign='top' style='font-size:12px'>". getData( nl2br( $row['courseID']),'course') ."</td>
				<td valign='top' style='font-size:12px'>". getData(nl2br( $row['classType']),'plan') ."</td>
				<td valign='top' style='font-size:12px'>". $_POST['chat_msg'] ."</td>
				<td valign='top' style='font-size:12px'>". date('Y-m-d H:i:s') ."</td>
				</tr></table>";
			?>
			<input rows="10" cols="90" id='email_to_send_on_REPLY_TICKET' name='email_to_send_on_REPLY_TICKET' readonly="readonly" type='hidden' value="<?php echo $email_to_send_on_REPLY_TICKET; ?>"/>
			<input id='get_student_email' name='get_student_email' readonly="readonly" type='hidden' value="<?php echo $row_get_student_email['email']; ?>"/>
			<?
			//if($std_status==2){
			echo '<script> email_to_send_on_REPLY_TICKET(); </script>';
			//}
			/////////////////////////////////////////////////////

		}
		else{
			$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_schedule` WHERE `id` = '$sch_id' "));
			
			$sql_get_ttl_mttl="SELECT * FROM capmus_users WHERE id='".$row['teacherID']."'";
			$row_get_ttl_mttl = mysql_fetch_array ( mysql_query($sql_get_ttl_mttl));
			
			//TTL and MTTL email		START
			$sql_get_ttl_email="SELECT * FROM capmus_users WHERE id='".$row_get_ttl_mttl['LeadId']."'";
			$row_get_ttl_email = mysql_fetch_array ( mysql_query($sql_get_ttl_email));		
			$sql_get_mttl_email="SELECT * FROM capmus_users WHERE id='".$row_get_ttl_mttl['main_LeadId']."'";
			$row_get_mttl_email = mysql_fetch_array ( mysql_query($sql_get_mttl_email));
			//TTL and MTTL email		END	
		
			//////////////////////////////////// To SEND EMAIL on GENERATE_TICKET//////////////////////////////////
			//SCHEDULE DETAILS EMAIL
			$email_to_send_on_GENERATE_TICKET = "
			<div align='center' style='color:Orange; font-size:20px; font-weight:bold'>Existing ticket From Student</div>
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
				<td valign='top' style='font-size:12px'>". $tn ."</td>
				<td valign='top' style='font-size:12px'>". showStudents(nl2br( $row['studentID'])) ."</td>
				<td valign='top' style='font-size:12px'>". showUser( nl2br( $row['teacherID'])) ."</td>
				<td valign='top' style='font-size:12px'>". getData( nl2br( $row['courseID']),'course') ."</td>
				<td valign='top' style='font-size:12px'>". getData(nl2br( $row['classType']),'plan') ."</td>
				<td valign='top' style='font-size:12px'>". $_POST['chat_msg'] ."</td>
				<td valign='top' style='font-size:12px'>". date('Y-m-d H:i:s') ."</td>
				</tr></table>";



			?>
			<input rows="10" cols="90" id='email_to_send_on_GENERATE_TICKET' name='email_to_send_on_GENERATE_TICKET' readonly="readonly" type='hidden' value="<?php echo $email_to_send_on_GENERATE_TICKET; ?>"/>
			<input id='ttl_ticket_email' name='ttl_ticket_email' readonly="readonly" type='hidden' value="<?php echo $row_get_ttl_email['email']; ?>"/>
			<input id='mttl_ticket_email' name='mttl_ticket_email' readonly="readonly" type='hidden' value="<?php echo $row_get_mttl_email['email']; ?>"/>


			<?
			//if($std_status==2){
			echo '<script> email_to_send_on_GENERATE_TICKET(); </script>';

			//}
			/////////////////////////////////////////////////////
		}
	///////////////////////////////////////////////////////

	getMessages('chat_msg');

	}
	else
	{
		getMessages('error');
	}
} 
if($_SESSION['userType']==1 || $_SESSION['userType']==15){
$result1 = mysql_query("SELECT * FROM `campus_ticket_new_chat` WHERE (ticket_number='".$tn."') ORDER BY sent") or die(mysql_error());; 
}
else{
$result1 = mysql_query("SELECT * FROM `campus_ticket_new_chat` WHERE (`toID` = '".$_SESSION['userId']."' and `fromID` = '".$id."' and ticket_number='".$tn."') || (`fromID` = '".$_SESSION['userId']."' and `toID` = '".$id."' and ticket_number='".$tn."') ORDER BY sent") or die(mysql_error());; 
}
//showUser($row['fromID']).":".$row['message']."\n".
?>
<form action='' method='POST' onsubmit="">

<div id="label">Messages Submitted(READ ONLY):</div><div id="field"><fieldset>
<legend><?php echo $to_name; ?></legend>
<textarea readonly name='comments_general_readonly'><?php while($row1 = mysql_fetch_array($result1)) 
{ 
	if($_SESSION['userType']==8){
	echo $row1['from']." : ".$row1['message']."\n"; 
	}
	else{
/* 		if($_SESSION['userType']==4){
			echo showStudents($_SESSION['userId'])." : ".$row1['message']."\n";
		}
		else{ */
			echo $row1['from']." : ".$row1['message']."\n";
/* 		}  */
	}
}?></textarea>
</fieldset>
</div> 

<div id="label">Type Message:</div><div id="field"><textarea name='chat_msg' class='textbox_chatpanel'></textarea></div>  
 
<div id="label"></div><div id="field"><input type='submit' value='Send' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? } 
include('include/footer.php');?>
<!--<script type="text/javascript">
  setTimeout(function () { location.reload(true); }, 8000);
</script>-->