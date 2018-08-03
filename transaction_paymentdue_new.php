<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) 
{ 
//foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 
	if($_POST['email']!="")
	{
		//echo $_POST['email']."<br>";
		//echo $_POST['paymentdue']."<br>";
		//echo $_POST['mailaction'];
		$sql=("INSERT INTO campus_transaction_paymentdue(id,email,action,mailaction) VALUES('','{$_POST['email']}' , '{$_POST['paymentdue']}' ,'{$_POST['mailaction']}') ");
		//mysql_query($sql) or die(mysql_error()); 
		$result=mysql_query($sql);
		getMessages('add'); 
	}
	else
	{
		getMessages('error');
	}
}
?>

<form action='' method='POST'> 
<div id="label">Email:</div><div id="field"><?php echo getInput($_POST['email'],'email','')?> </div>
<div id="label">Payment Due Option:</div><div id="field"><?php echo getList($_POST['paymentdue'],'paymentdue','paymentdue');?> </div>
<div id="label">Mail Action:</div><div id="field"><?php echo getList($_POST['mailaction'],'mailaction','mailaction');?> </div>
<div id="label"></div><div id="field"><input type='submit' value='Add Row' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<? include('include/footer.php');?>