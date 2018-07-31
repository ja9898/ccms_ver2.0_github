<? 
include('config.php'); 
include('include/header.php');

//echo $passed_array = unserialize($_POST['currency_name']);
if(isset($_POST['currency_populate_db_chkbox']))
{
	//PASSED RECEIVED ARRAYS
	$pass_array_gbp_received = unserialize(base64_decode($_POST["currency_array_result_gbp_received"]));
	$pass_array_cad_received = unserialize(base64_decode($_POST["currency_array_result_cad_received"]));
	//PASSED SIGNUPS ARRAYS
	$pass_array_gbp_signup = unserialize(base64_decode($_POST["currency_array_result_gbp_signup"]));
	$pass_array_cad_signup = unserialize(base64_decode($_POST["currency_array_result_cad_signup"]));
	
	$pass_index = unserialize(base64_decode($_POST["currency_index"]));

	$countOfArrayIndex = count($pass_index);


	for ($x=0; $x<=$countOfArrayIndex; $x++) {

		$currency_ID = $pass_index[$x];
		$currency_result_gbp_received = $pass_array_gbp_received[$pass_index[$x]];
		$currency_result_cad_received = $pass_array_cad_received[$pass_index[$x]];
		
		$currency_result_gbp_signup = $pass_array_gbp_signup[$pass_index[$x]];
		$currency_result_cad_signup = $pass_array_cad_signup[$pass_index[$x]];

		$sql_update_result="UPDATE campus_transaction SET result_gbp='".$currency_result_gbp_received."' , result_cad='".$currency_result_cad_received."' , result_gbp_signup='".$currency_result_gbp_signup."' , result_cad_signup='".$currency_result_cad_signup."'  WHERE id='".$currency_ID."' ";
		mysql_query($sql_update_result) or die(mysql_error());
	} 
	getMessages('add');
}
else
{
	echo "<label style='color:red; font-weight:bold'>NOTE: Database cannot be POPULATED-CheckBox not checked</u></label>";
}

include('include/footer.php');?>