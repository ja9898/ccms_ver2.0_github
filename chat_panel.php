<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id'];
if($_SESSION['userType']==3){
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

	$sql = "INSERT INTO `chat`(chat.fromID,chat.toID,chat.from,chat.to,message,sent)  VALUES('".$_SESSION['userId']."','".$id."', '".$_SESSION['userName']."' , '".$to_name."' , '".$_POST['chat_msg']."',NOW())"; 
	mysql_query($sql) or die(mysql_error()); 


	///////////////////////////////////////////////////////

	getMessages('chat_msg');

	}
	else
	{
		getMessages('error');
	}
} 

$result1 = mysql_query("SELECT * FROM `chat` WHERE (`toID` = '".$_SESSION['userId']."' and `fromID` = '".$id."') || (`fromID` = '".$_SESSION['userId']."' and `toID` = '".$id."') ORDER BY sent") or die(mysql_error());; 

//showUser($row['fromID']).":".$row['message']."\n".
?>
<form action='' method='POST' onsubmit="">

<div id="label">Messages Submitted(READ ONLY):</div><div id="field"><fieldset>
<legend><?php echo $to_name; ?></legend>
<textarea readonly name='comments_general_readonly'><?php while($row1 = mysql_fetch_array($result1)) 
{ 
	if($_SESSION['userType']==3){
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