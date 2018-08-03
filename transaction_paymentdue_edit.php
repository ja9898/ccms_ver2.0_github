<? 
include('config.php'); 
include('include/header.php');
if(isset($_GET['id']))
{
$id = (int) $_GET['id'];
if (isset($_POST['submitted'])) 
{ 
foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
		echo $_POST['email']."<br>";
		echo $_POST['paymentdue']."<br>";
		echo $_POST['mailaction'];
		$sql=("UPDATE campus_transaction_paymentdue SET email = '{$_POST['email']}' , action = '{$_POST['paymentdue']}' , mailaction = '{$_POST['mailaction']}' WHERE id = '{$_POST['id']}' ");
		//mysql_query($sql) or die(mysql_error()); 
		$result=mysql_query($sql) or die(mysql_error());
		getMessages('edit'); 
}
$row = mysql_fetch_array ( mysql_query("SELECT * FROM campus_transaction_paymentdue WHERE id = '$id' ")); 
}
?>

<form action='' method='POST'> 
<div id="label">Email:</div><div id="field"><?php echo getInput(stripslashes($row['email']),'email')?> </div>
<div id="label">Payment Due Option:</div><div id="field"><?php echo getList($row['action'],'paymentdue','paymentdue');?> </div>
<div id="label">Mail Action:</div><div id="field"><?php echo getList($row['mailaction'],'mailaction','mailaction');?> </div>
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /><input type='hidden'  name='id' value="<?php echo $row['id'] ?>"/> </div>
</form> 
<?  include('include/footer.php');?> 