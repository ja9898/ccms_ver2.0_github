<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php
getTeacherFilterLead();
getFilterSubmit();
?>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<br><br>
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
if($_SESSION['userId']==159)
{
	echo "<th class='specalt' colspan=1>Actions</th>";
}
echo "<th class='specalt'><b>Id</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 
echo "<th class='specalt'><b>Teacher</b></th>"; 
//echo "<th class='specalt'><b>Amount/Dues</b></th>"; 
//echo "<th class='specalt'><b>Amount/Dues - NEW</b></th>";
echo "<th class='specalt'><b>Amount/Dues-USD</b></th>"; 
echo "<th class='specalt'><b>Amount/Dues - NEW USD</b></th>";
echo "<th class='specalt'><b>USD RESULT/DIFF</b></th>";
//echo "<th class='specalt'><b>Signin Date</b></th>";
//echo "<th class='specalt'><b>Pay Date</b></th>";  
//echo "<th class='specalt'><b>Pay Date - NEW</b></th>";  
echo "<th class='specalt'><b>Operator</b></th>";
echo "<th class='specalt'><b>CCMS DATE</b></th>";
echo "<th class='specalt'><b>TEAMLEAD</b></th>";
//echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
echo "</tr>"; 
//mysql_query("SELECT * FROM `campus_schedule` where status=1") or trigger_error(mysql_error());

	if(isset($_POST['check_done']))
	{
		$id_check_done = $_POST['check_done'];
		$check_done = mysql_query("UPDATE campus_schedule_ver2_list SET check_done = 0 WHERE id='".$id_check_done."' ") or trigger_error(mysql_error());
		getMessages('edit','book_scheduler_manage_amounts_ver2_list.php');
	}
	else
	{
	if(isset($_POST['search-submit'])){
		$sql="SELECT * FROM campus_schedule_ver2_list WHERE check_done=1 "; 
		if($_POST['search-teacher-id2']!=0)
		{
			$sql.="and LeadId='".$_POST['search-teacher-id2']."' ";
		}
		if(isset($_POST['fromDate']) && $_POST['fromDate']!='' && isset($_POST['toDate']) && $_POST['toDate']!='')
		{
			$sql.=" and campus_schedule_ver2_list.ccms_date BETWEEN '".prepareDate($_POST['fromDate'])."' 
			AND '".prepareDate($_POST['toDate'])."'";
		}
		$result =  mysql_query($sql) or die(mysql_error());
		}
	
	}


	$rowcount = mysql_num_rows($result);
	
	$sum_dues=array();

//Get 1 cad to usd rate from db
$sql_1cad_to_dollar_rate_USDval="SELECT * FROM campus_currency WHERE id = 433";
$row_1cad_to_dollar_rate_USDval = mysql_fetch_array(mysql_query($sql_1cad_to_dollar_rate_USDval));
$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];
//Arrays for the Amount sum
$cad_amt_new=array();
$usd_amt_new=array();	
//Teamlead total sum
$usd_amt_TL_RESULT=array();	

while($row = mysql_fetch_array($result)){ 
$sum=$row['dues'];
$sum_dues[$row['id']]=$sum;

$cad_amt_new[$row['id']] = $row['dues_new'];
$usd_amt_new[$row['id']] = $row['dues_new']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'];


$dues_usd = round($row['dues']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'],2);
$dues_usd_new = round($row['dues_new']*$row_1cad_to_dollar_rate_USDval['1_cad_to_usd'],2);
//If the Difference between NEW and OLD value is whether, >0 OR <0 OR ==0
$dues_usd_RESULT = $dues_usd_new - $dues_usd;

foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 

if($dues_usd_RESULT==0)
{
	
}
else
{
	echo "<tr>"; 
	if($_SESSION['userId']==159)
	{	
		echo "<td valign='top'><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=book_scheduler_manage_amounts_ver2_delete.php?id={$row['id']}>Delete</a></td></td>";
	}
	echo "<td valign='top'>" . $row['id'] . "</td>";  
	echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>";  
	echo "<td valign='top'>" . showUser( nl2br( $row['teacherID'])) . "</td>"; 
	//echo "<td valign='top'>" . nl2br( $row['dues']) . "</td>";  
	//echo "<td valign='top'>" . nl2br( $row['dues_new']) . "</td>"; 
	echo "<td valign='top'>" . $dues_usd . "</td>";
	echo "<td valign='top'>" . $dues_usd_new . "</td>";
	if($dues_usd_RESULT>0)
	{
	echo "<td valign='top' style='color:GREEN'>" . $dues_usd_RESULT . "</td>";
	$usd_amt_TL_RESULT[$row['id']] = $dues_usd_RESULT;
	}
	if($dues_usd_RESULT<0)
	{
	echo "<td valign='top' style='color:RED'>" . $dues_usd_RESULT . "</td>";
	}
	if($dues_usd_RESULT==0)
	{
	echo "<td valign='top' style='color:BLUE'>" . $dues_usd_RESULT . "</td>";
	}
	/////////////////////////////////////////////////////////////////////////
	//echo "<td valign='top'>" . nl2br( $row['duedate']) . "</td>";
	//echo "<td valign='top'>" . nl2br( $row['paydate']) . "</td>";
	//echo "<td valign='top'>" . nl2br( $row['paydate_new']) . "</td>";
	echo "<td valign='top'>" . showUser(nl2br( $row['operator'])) . "</td>"; 
	echo "<td valign='top'>" . nl2br( $row['ccms_date']) . "</td>";
	echo "<td valign='top'>" . showUser(nl2br( $row['LeadId'])) . "</td>";
	echo "</tr>";
}

} 

echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'> </td>";
echo "<td valign='top'>Sum </td>";  
echo "<td valign='top'> </td>";
echo "<td valign='top'><b>USD $" . nl2br( round(array_sum($usd_amt_new),2))  . "</td>"; 
echo "<td valign='top'><b>USD $" . nl2br( array_sum($usd_amt_TL_RESULT))  . "</td>";  
echo "</tr>";
echo "</table>"; 
include('include/footer.php');
?>