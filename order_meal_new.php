<? 
include('config.php');
include('include/header.php');  
$id = (int) $_GET['id'];

if (isset($_POST['submitted'])) {

	$sql_check_time= mysql_query("SELECT userId,DATE_FORMAT(dateTime, '%H:%i') as TIMEdateTime FROM campus_meal WHERE userId='".$_SESSION['userId']."' AND now() < DATE_ADD(dateTime, INTERVAL 1 HOUR) ORDER by id DESC LIMIT 1 ");
	$row_check_time = mysql_fetch_assoc($sql_check_time);
	$row_check_time['TIMEdateTime'];
	if (mysql_num_rows($sql_check_time)>=1)
	{
		getMessages('error_meal','','Another Menu NOT ALLOWED within 1 hour of 1st Menu');
	}
	else
	{
		if(isset($_POST['menuId']) && $_POST['menuId']!=0)
		{
			$dateTime = date('Y-m-d H:i:s');
			$sql_insert_meal = "INSERT INTO campus_meal (`userId`,`menuId`,`comments`,`dateTime`) 
			VALUES ('".$_SESSION['userId']."' , '{$_POST['menuId']}' , '{$_POST['commentsMeal']}' , '".$dateTime."') ";
			$result_meal = mysql_query($sql_insert_meal);	
			getMessages('add');
			$email_to_send_on_MENU_ORDER = "<table border=1 id='table_liquid' cellspacing='2px' >
			<tr bgcolor=#eceff5>
			<th class='specalt' style='font-size:12px'><b>Customer Name</b></th>
			<th class='specalt' style='font-size:12px'><b>Menu</b></th>
			<th class='specalt' style='font-size:12px'><b>Menu Comments </b></th> 
			<th class='specalt' style='font-size:12px'><b>Date Time</b></th></tr>";
			$email_to_send_on_MENU_ORDER.="<tr bgcolor=#eceff5>
			<td valign='top' style='font-size:12px'>". showUser($_SESSION['userId']) ."</td>
			<td valign='top' style='font-size:12px'>". getData(nl2br( $_POST['menuId']),'menuAry') ."</td>
			<td valign='top' style='font-size:12px'>". $_POST['commentsMeal'] ."</td>
			<td valign='top' style='font-size:12px'>". $dateTime ."</td></tr></table>";
			?>
			<input rows="10" cols="90" id='email_to_send_on_MENU_ORDER' name='email_to_send_on_MENU_ORDER' readonly="readonly" type='hidden' value="<?php echo $email_to_send_on_MENU_ORDER; ?>"/>
			<?
			echo '<script> email_to_send_on_MENU_ORDER(); </script>';
		}
		else
		{
			getMessages('error');
		}
	}
}
?>
<form action='' method='POST' onsubmit="">
<div id="label">Teacher Name:</div><div id="field"><label name='teacher-readonly'><?php echo showUser($_SESSION['userId']); ?> </label></div>
<div id="label">Menu:</div><div id="field"><?php echo getList('','menuId','menuAry');?> </div> 
<div id="label">Comments:</div><div id="field"><textarea name='commentsMeal' id='commentsMeal' required></textarea></div>  
<div id="label"></div><div id="field"><input type='submit' value='Order Meal' class="button" /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<div id="ajaxdiv_summary_confirm_menu" name="ajaxdiv_summary_confirm_menu"> </div>

<?include('include/footer.php');?> 