<? 
include('config.php'); 
include('include/header.php');
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>GBP</th>"; 
echo "<th class='specalt'>USD</th>"; 
echo "<th class='specalt'>CAD</th>"; 
echo "<th class='specalt'>AUD</th>";
echo "<th class='specalt'>NZD</th>";
echo "<th class='specalt'>SGD</th>";
echo "</tr>"; ?>

<!--
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<tr>
<td valign='top'> <input name="gbp" type="text" id="gbp" class="allownumericwithdecimal" required />  </td>
<td valign='top'> <input name="usd" type="text" id="usd" class="allownumericwithdecimal" required />  </td>
<td valign='top'> <input name="cad" type="text" id="cad" class="allownumericwithdecimal" required /> </td>
<td valign='top'> <input name="aud" type="text" id="aud" class="allownumericwithdecimal" required /> </td>
</tr>
</table>
&nbsp;&nbsp;<input type="submit" class="button" name="submit_currency" value="Filter"></form>-->

<?
 	$sql="SELECT * FROM campus_currency";
		if(isset($_POST['currency_values_chkbox']))
		 {
			echo "<script>alert('Currency Values will go in the database')</script>";
			$gbp_value = $_POST['gbp'];
			$usd_value = $_POST['usd'];
			$cad_value = $_POST['cad'];
			$aud_value = $_POST['aud'];
			$nzd_value = $_POST['nzd'];
			$sgd_value = $_POST['sgd'];
			$sql_currency_value="INSERT INTO `campus_currency`(gbp,usd,cad,aud,nzd,sgd,date) VALUES( '".$gbp_value."' , '".$usd_value."' , '".$cad_value."' , '".$aud_value."' , '".$nzd_value."' , '".$sgd_value."' , '".date('Y-m-d')."')";
			mysql_query($sql_currency_value) or die(mysql_error());
		 }
		 else
		 {
			//echo "<script>alert('Currency Values will NOT GO IN THE DATABASE')</script>";
		 }
?>

<!--<div id="filter">-->
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<tr>
<td valign='top'> <input name="gbp" type="text" id="gbp" class="allownumericwithdecimal"  />  </td>
<td valign='top'> <input name="usd" type="text" id="usd" class="allownumericwithdecimal"  />  </td>
<td valign='top'> <input name="cad" type="text" id="cad" class="allownumericwithdecimal"  /> </td>
<td valign='top'> <input name="aud" type="text" id="aud" class="allownumericwithdecimal"  /> </td>
<td valign='top'> <input name="nzd" type="text" id="nzd" class="allownumericwithdecimal"  /> </td>
<td valign='top'> <input name="sgd" type="text" id="sgd" class="allownumericwithdecimal"  /> </td>
</tr>
</table>
<div id="label">POPULATE DB Manually</div><div id="field" style="color:red"><?php echo getCheckbox($_POST['currency_values_chkbox'],'currency_values_chkbox'); ?>(Check this box to POPULATE currency values Manually)</div>

<br><br>
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Populate DB Manually"></form>
<br /><br />
<a class="button" href="xe_crawler.php" target="_blank">Populate DataBase from (www.xe.com) LIVE DATA</a>
<br /><br />
<!--</div>-->

<? 
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>ID</th>"; 
echo "<th class='specalt' style=''>GBP</th>";
echo "<th class='specalt' style=''>USD</th>";
echo "<th class='specalt' style=''>CAD</th>";
echo "<th class='specalt' style=''>AUD</th>";
echo "<th class='specalt' style=''>NZD</th>";
echo "<th class='specalt' style=''>SGD</th>";
echo "<th class='specalt' style=''>1 CAD to USD</th>";
//***********************************<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	//Newly added //23-11-16
echo "<th class='specalt' style=''>1 USD to USD</th>";
echo "<th class='specalt' style=''>1 GBP to USD</th>";
echo "<th class='specalt' style=''>1 AUD to USD</th>";
echo "<th class='specalt' style=''>1 CAD to USD NEW</th>";
echo "<th class='specalt' style=''>1 NZD to USD</th>";
echo "<th class='specalt' style=''>1 SGD to USD</th>";
//***********************************<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
echo "<th class='specalt' style=''>Date</th>";
echo "</tr>";



	$result = mysql_query($sql) or trigger_error(mysql_error()); 

	while($row = mysql_fetch_array($result)){ 
	foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
	
	echo "<td valign='top'>" .  nl2br( $row['id']) . "</td>";
	echo "<td valign='top'>" .  nl2br( $row['gbp']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['usd']). "</td>"; 
	echo "<td valign='top'>" . 	nl2br( $row['cad']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['aud']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['nzd']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['sgd']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['1_cad_to_usd']). "</td>";
	//***********************************<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<	//Newly added //23-11-16
	echo "<td valign='top'>" . 	nl2br( $row['1_usd_to_usd']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['1_gbp_to_usd']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['1_aud_to_usd']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['1_cad_to_usd_new']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['1_nzd_to_usd']). "</td>";
	echo "<td valign='top'>" . 	nl2br( $row['1_sgd_to_usd']). "</td>";
	//***********************************<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	echo "<td valign='top'>" . 	nl2br( $row['date']). "</td>";
	echo "</tr>"; 
	
	
	
	//********************************************************************************
	
	}

echo "</table>";
?>



<?include('include/footer.php');?>
