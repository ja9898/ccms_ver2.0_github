<?php
include('../config.php');
include('function-inc.php');
/*foreach($_GET AS $key => $value) {
    $_GET[$key] = mysql_real_escape_string($value);
}
$_classType=getClassTypeSchedule90($_GET['classType']);
$_condition=getCondition90($_GET['classType']);*/
//if(isset($_GET['usertype_teamlead'])
//{
	$currency_id=intval($_GET['currency_id']);
//}

if($currency_id==1)
{
	$getCurrencyValue_query=("SELECT * FROM campus_currency WHERE id = (
      SELECT MAX(id)
      FROM campus_currency)");
	$row=mysql_fetch_array(mysql_query($getCurrencyValue_query));?>
	<input type='hidden' id="value_of_currency" name="value_of_currency" readonly="readonly" value=<? echo $row['gbp']; ?> />
	<br><div style='visibility:hidden' id="label">CAD - Auto:</div><input type='hidden' id="value_of_cad" name="value_of_cad" readonly="readonly" value=<? echo $row['cad']; ?> />
	<br><div style='visibility:hidden' id="label">1 gbp to usd:</div><input type='hidden' id="simple_convert" name="simple_convert" readonly="readonly" value=<? echo $row['1_gbp_to_usd']; ?> />
<?
}
if($currency_id==2)
{
	$getCurrencyValue_query=("SELECT * FROM campus_currency WHERE id = (
      SELECT MAX(id)
      FROM campus_currency)");
	$row=mysql_fetch_array(mysql_query($getCurrencyValue_query));?>
	<input type='hidden' id="value_of_currency" name="value_of_currency" readonly="readonly" value=<? echo $row['usd']; ?> />
	<br><div style='visibility:hidden' id="label">CAD - Auto:</div><input type='hidden' id="value_of_cad" name="value_of_cad" readonly="readonly" value=<? echo $row['cad']; ?> />
	<br><div style='visibility:hidden' id="label">1 usd to usd:</div><input type='hidden' id="simple_convert" name="simple_convert" readonly="readonly" value=<? echo $row['1_usd_to_usd']; ?> />
<?
}
if($currency_id==3)
{
	$getCurrencyValue_query=("SELECT * FROM campus_currency WHERE id = (
      SELECT MAX(id)
      FROM campus_currency)");
	$row=mysql_fetch_array(mysql_query($getCurrencyValue_query));?>
	<input type='hidden' id="value_of_currency" name="value_of_currency" readonly="readonly" value=<? echo $row['cad']; ?> />
	<br><div style='visibility:hidden' id="label">CAD - Auto:</div><input type='hidden' id="value_of_cad" name="value_of_cad" readonly="readonly" value=<? echo $row['cad']; ?> />
	<br><div style='visibility:hidden' id="label">1 cad to usd:</div><input type='hidden' id="simple_convert" name="simple_convert" readonly="readonly" value=<? echo $row['1_cad_to_usd_new']; ?> />
<?
}
if($currency_id==4)
{
	$getCurrencyValue_query=("SELECT * FROM campus_currency WHERE id = (
      SELECT MAX(id)
      FROM campus_currency)");
	$row=mysql_fetch_array(mysql_query($getCurrencyValue_query));?>
	<input type='hidden' id="value_of_currency" name="value_of_currency" readonly="readonly" value=<? echo $row['aud']; ?> />
	<br><div style='visibility:hidden' id="label">CAD - Auto:</div><input type='hidden' id="value_of_cad" name="value_of_cad" readonly="readonly" value=<? echo $row['cad']; ?> />
	<br><div style='visibility:hidden' id="label">1 aud to usd:</div><input type='hidden' id="simple_convert" name="simple_convert" readonly="readonly" value=<? echo $row['1_aud_to_usd']; ?> />
<?
}
if($currency_id==5)
{
	$getCurrencyValue_query=("SELECT * FROM campus_currency WHERE id = (
      SELECT MAX(id)
      FROM campus_currency)");
	$row=mysql_fetch_array(mysql_query($getCurrencyValue_query));?>
	<input type='hidden' id="value_of_currency" name="value_of_currency" readonly="readonly" value=<? echo $row['nzd']; ?> />
	<br><div style='visibility:hidden' id="label">CAD - Auto:</div><input type='hidden' id="value_of_cad" name="value_of_cad" readonly="readonly" value=<? echo $row['cad']; ?> />
	<br><div style='visibility:hidden' id="label">1 nzd to usd:</div><input type='hidden' id="simple_convert" name="simple_convert" readonly="readonly" value=<? echo $row['1_nzd_to_usd']; ?> />
<?
}
if($currency_id==6)
{
	$getCurrencyValue_query=("SELECT * FROM campus_currency WHERE id = (
      SELECT MAX(id)
      FROM campus_currency)");
	$row=mysql_fetch_array(mysql_query($getCurrencyValue_query));?>
	<input type='hidden' id="value_of_currency" name="value_of_currency" readonly="readonly" value=<? echo $row['sgd']; ?> />
	<br><div style='visibility:hidden' id="label">CAD - Auto:</div><input type='hidden' id="value_of_cad" name="value_of_cad" readonly="readonly" value=<? echo $row['cad']; ?> />
	<br><div style='visibility:hidden' id="label">1 sgd to usd:</div><input type='hidden' id="simple_convert" name="simple_convert" readonly="readonly" value=<? echo $row['1_sgd_to_usd']; ?> />
<?
}


?>


