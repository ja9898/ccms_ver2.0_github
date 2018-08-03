<? 
include('config.php'); 
include('include/header.php');
//global $id_getTL;
if (isset($_POST['submitted'])) { 
//foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 

//TTL Amount Array
$amount_array_TTL = $_POST['amountId_TTL'];

//MATL Amount Array
$amount_array_ATL = $_POST['amountId_ATL'];


$_POST['yearID'];echo "<br>";
$_POST['monthID'];echo "<br>";
//Whole month FROM, TO DATE
$fromDate = getData(nl2br( $_POST['yearID']),'year')."-".getData(nl2br( $_POST['monthID']),'month')."-"."01";
$toDate = getData(nl2br( $_POST['yearID']),'year')."-".getData(nl2br( $_POST['monthID']),'month')."-".date('t');
////////////////////////////

	//Displaying and getting proper ID's of TEACHER TEAMLEAD Names(TTL Names)
	$sql_getTTL="SELECT * FROM capmus_users WHERE user_type=8 and status=1 ";
	$result_getTTL=mysql_query($sql_getTTL);
	$id_getTTL=array();
	$id_getTTL_usertype=array();
	
	while($row_getTTL=mysql_fetch_array($result_getTTL))
	{
	
		$id_getTTL[]=$row_getTTL['id'];echo "<br>";
		$id_getTTL_usertype[]=$row_getTTL['user_type'];echo "<br>";
	}
	///////////////////////////////////////////////////////////////////////
echo $size_of_TTL = sizeof($id_getTTL);echo "<br>";
echo $size_of_amount_TTL = sizeof($amount_array_TTL);echo "<br>";

	//Displaying and getting proper ID's of MAIN AGENT TEAMLEAD Names(ATL Names)
	$sql_getATL="SELECT * FROM capmus_users WHERE user_type=16 and status=1 ";
	$result_getATL=mysql_query($sql_getATL);
	$id_getATL=array();
	$id_getATL_usertype=array();
	
	while($row_getATL=mysql_fetch_array($result_getATL))
	{
	
		$id_getATL[]=$row_getATL['id'];echo "<br>";
		$id_getATL_usertype[]=$row_getATL['user_type'];echo "<br>";
	}
	///////////////////////////////////////////////////////////////////////
echo $size_of_ATL = sizeof($id_getATL);echo "<br>";
echo $size_of_amount_ATL = sizeof($amount_array_ATL);echo "<br>";

if(!empty($_POST['total_target_amount']))
{
	$sql_total_target = "INSERT INTO `campus_target_table` ( `LeadId` , `amount` , `fromDate` , `toDate`) VALUES(  0 ,  '".$_POST['total_target_amount']."' , '".$fromDate."' , '".$toDate."'  ) "; 
	mysql_query($sql_total_target) or die(mysql_error());
	echo "<script>alert('Total Target amount Successfully inserted.');</script>";
}

foreach($id_getTTL as $key => $value){
echo $id_getTTL[$key];echo "final1<br>";
echo $amount_array_TTL[$key];echo "final2<br>";

if(!empty($id_getTTL) && !empty($amount_array_TTL) && $size_of_TTL!=0 && $size_of_amount_TTL!=0 && $size_of_TTL==$size_of_amount_TTL){
$sql = "INSERT INTO `campus_target_table` ( `LeadId` , `amount` , `fromDate` , `toDate` , user_type) VALUES(  '".$id_getTTL[$key]."' ,  '".$amount_array_TTL[$key]."' , '".$fromDate."' , '".$toDate."' , '".$id_getTTL_usertype[$key]."' ) "; 
mysql_query($sql) or die(mysql_error()); 
}
//getMessages('add');
//echo "<script>window.location.href = 'index.php'</script>";
echo "<script>alert('TTL Successful.');</script>";
}

foreach($id_getATL as $key => $value){
echo $id_getATL[$key];echo "final1<br>";
echo $amount_array_ATL[$key];echo "final2<br>";

if(!empty($id_getATL) && !empty($amount_array_ATL) && $size_of_ATL!=0 && $size_of_amount_ATL!=0 && $size_of_ATL==$size_of_amount_ATL){
$sql = "INSERT INTO `campus_target_table` ( `LeadId` , `amount` , `fromDate` , `toDate` , user_type) VALUES(  '".$id_getATL[$key]."' ,  '".$amount_array_ATL[$key]."' , '".$fromDate."' , '".$toDate."' , '".$id_getATL_usertype[$key]."' ) "; 
mysql_query($sql) or die(mysql_error()); 
}
//getMessages('add');
//echo "<script>window.location.href = 'index.php'</script>";
echo "<script>alert('ATL Successful.');</script>";
}

if(!empty($_POST['amountId_ycc_lhr_agent']))
{
	$sql_ycc_lhr_agent = "INSERT INTO `campus_target_table` ( `LeadId` , `amount` , `fromDate` , `toDate`) VALUES(  2 ,  '".$_POST['amountId_ycc_lhr_agent']."' , '".$fromDate."' , '".$toDate."'  ) "; 
	mysql_query($sql_ycc_lhr_agent) or die(mysql_error());
	echo "<script>alert('ycc_lhr_agent amount Successfully inserted.');</script>";
}

/*else
{
getMessages('duplicate');
}*/ 
}

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
//$teacher_course_list=implode(",",$_COURSE_ARRAY);
//$add_teacher_course="Teacher:".showUser( nl2br( $_POST['teacherID'])).",Course:".$teacher_course_list;
				//user_log( $_SERVER['PHP_SELF'] , "ADD_TEACHER_COURSE" , $_SESSION['userId'] ,$add_teacher_course);
///////////////////////////////////////////////////////
//getMessages('add');} 
?>

<form action='' method='POST'> 
<div id="label">Target Amount:</div><div id="field"><input type='text' name="total_target_amount"  required /></div>

<?
	//Displaying Teacher Teamlead Names(TTL Names)
	$sql_getTTL="SELECT * FROM capmus_users WHERE user_type=8 and status=1 ";
	$result_getTTL=mysql_query($sql_getTTL);
	$id_getTTL=array();
	echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
	while($row_getTTL=mysql_fetch_array($result_getTTL))
	{
	echo "<tr>";  
		$id_getTTL[]=$row_getTTL['id'];
		showUser(nl2br( $row_getTTL['id']));echo "<br>";
		echo "<td valign='top'>" . showUser(nl2br( $row_getTTL['id'])) . "</td><td valign='top'><input name='amountId_TTL[]' type='text' required /></td>";
	echo "</tr>";	
	}
	echo "</table>";
	$all_getTTL = implode(",",$id_getTTL);
	/////////////////////////////////////////////
	
	//Displaying Main Agent Teamlead Names(MATL Names)
	$sql_getATL="SELECT * FROM capmus_users WHERE user_type=16 and status=1 ";
	$result_getATL=mysql_query($sql_getATL);
	$id_getATL=array();
	echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
	while($row_getATL=mysql_fetch_array($result_getATL))
	{
	echo "<tr>";  
		$id_getATL[]=$row_getATL['id'];
		showUser(nl2br( $row_getATL['id']));echo "<br>";
		echo "<td valign='top'>" . showUser(nl2br( $row_getATL['id'])) . "</td><td valign='top'><input name='amountId_ATL[]' type='text' required /></td>";
	echo "</tr>";	
	}
	echo "</table>";
	$all_getATL = implode(",",$id_getATL);
	//////////////////////////////////////////////////
	
	//Displaying YCC Lahore Agent
	$sql_get_ycc_lhr_agent="SELECT * FROM capmus_users WHERE id=565 and user_type=5 and status=1 ";
	$result_get_ycc_lhr_agent=mysql_query($sql_get_ycc_lhr_agent);
	//$id_get_ycc_lhr_agent=array();
	echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
	while($row_get_ycc_lhr_agent=mysql_fetch_array($result_get_ycc_lhr_agent))
	{
	echo "<tr>";  
		$id_get_ycc_lhr_agent=$row_get_ycc_lhr_agent['id'];
		showUser(nl2br( $row_get_ycc_lhr_agent['id']));echo "<br>";
		echo "<td valign='top'>" . showUser(nl2br( $row_get_ycc_lhr_agent['id'])) . "</td><td valign='top'><input name='amountId_ycc_lhr_agent' type='text' required /></td>";
	echo "</tr>";	
	}
	echo "</table>";
	//$all_get_ycc_lhr_agent = implode(",",$id_get_ycc_lhr_agent);
	//////////////////////////////////////////////////
	
?>
<div id="label">Year:</div><div id="field"><?php echo getList('','yearID','year');?> </div> 
<div id="label">Month:</div><div id="field"><?php echo getList('','monthID','month');?> </div> 


<div id="label"></div><div id="field"><input type='' name="teamLeadId[]" value="<?php $all_getTTL; ?>"/></div>
<div id="label"></div><div id="field"><input type='' name="AgentteamLeadId[]" value="<?php $all_getATL; ?>"/></div>
 

<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? include('include/footer.php'); ?>