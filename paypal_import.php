<?php
//***************************************************************************************************
//http://community.sitepoint.com/t/import-excel-file-to-php-myadmin-through-file-uploading-using-php/38433/2
//***************************************************************************************************


include('config.php');
include('include/header.php'); 


if ($_FILES["file"]["error"] > 0)
{
    echo "Error: " . $_FILES["file"]["error"] . "<br>";
}
else
{
    echo "Upload: " . $_FILES["file"]["name"] . "<br>";
    echo "Type: " . $_FILES["file"]["type"] . "<br>";
    echo "Size: " . ($_FILES["file"]["size"] / 1024) . " Kb<br>";
    //echo "Stored in: " . $_FILES["file"]["tmp_name"];
	$a=$_FILES["file"]["tmp_name"];
	//echo $a;


// path where your CSV file is located
//define('CSV_PATH','C:/xampp/htdocs/');
//<!-- C:\\xampp\\htdocs -->
// Name of your CSV file
$csv_file = $a;

if (($getfile = fopen($csv_file, "r")) !== FALSE) {
         $data = fgetcsv($getfile, 1000, ",");
   while (($data = fgetcsv($getfile, 1000, ",")) !== FALSE) {
     //$num = count($data);
	   //echo $num;
        //for ($c=0; $c < $num; $c++) {
            $result = $data;
			//echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";echo "<br>";
			
        	$str = implode(",", $result);
        	$slice = explode(",", $str);
			echo "<br>";echo "<br>";echo "<br>";
			$col1 = prepareDate($slice[0]);echo "<br>";
			$col2 = $slice[1];echo "<br>";
			$col3 = $slice[2];echo "<br>";
			$col4 = $slice[3];echo "<br>";
			$col5 = $slice[4];echo "<br>";
			$col6 = $slice[5];echo "<br>";
			$col7 = $slice[6];echo "<br>";
			$col8 = $slice[7];echo "<br>";
			$col9 = $slice[8];echo "<br>";
			$col10 = $slice[9];echo "<br>";
			$col11 = $slice[10];echo "<br>";
			
			$col12 = $slice[11];echo "<br>";
			$col13 = $slice[12];echo "<br>";
			$col14 = $slice[13];echo "<br>";
			$col15 = $slice[14];echo "<br>";
			$col16 = $slice[15];echo "<br>";
			$col17 = $slice[16];echo "<br>";
			$col18 = $slice[17];echo "<br>";
			$col19 = $slice[18];echo "<br>";
			$col20 = $slice[19];echo "<br>";
			$col21 = $slice[20];echo "<br>";
			
			$col22 = $slice[21];echo "<br>";
			$col23 = $slice[22];echo "<br>";
			$col24 = $slice[23];echo "<br>";
			$col25 = $slice[24];echo "<br>";
			$col26 = $slice[25];echo "<br>";
			$col27 = $slice[26];echo "<br>";
			$col28 = $slice[27];echo "<br>";
			$col29 = $slice[28];echo "<br>";
			$col30 = $slice[29];echo "<br>";
			$col31 = $slice[30];echo "<br>";
			$col32 = $slice[31];echo "<br>";
			$col33 = $slice[32];echo "<br>";
			$col34 = $slice[33];echo "<br>";
			$col35 = $slice[34];echo "<br>";
			$col36 = $slice[35];echo "<br>";
			$col37 = $slice[36];echo "<br>";
			$col38 = $slice[37];echo "<br>";
			$col39 = $slice[38];echo "<br>";
			$col40 = $slice[39];echo "<br>";
			$col41 = $slice[40];echo "<br>";
			$col42 = $slice[41];echo "<br>";
			
			

$query = "INSERT INTO campus_transaction_paypal(
date,time,timezone,name,type,status,currency,gross,fee,net,fromemail,toemail,transactionId,
counterparty_status,address_status,item_title,itemId,postage_package,insurance,vat,option1name,
option1value,option2name,option2value,auctionsite,buyerId,itemurl,closingdate,escrowId,invoiceId,
referencetxnId,invoiceNo,customNo,receiptId,balance,addressline1,addressline2,town,state,postcode,
country,contactperson) VALUES('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."',
'".$col7."','".$col8."','".$col9."','".$col10."','".$col11."','".$col12."','".$col13."','".$col14."',
'".$col15."','".$col16."','".$col17."','".$col18."','".$col19."','".$col20."','".$col21."','".$col22."',
'".$col23."','".$col24."','".$col25."','".$col26."','".$col27."','".$col28."','".$col29."','".$col30."',
'".$col31."','".$col32."','".$col33."','".$col34."','".$col35."','".$col36."','".$col37."','".$col38."',
'".$col39."','".$col40."','".$col41."','".$col42."')";
$result=mysql_query($query);
}
}
echo "<script>alert('Record successfully uploaded.');</script>";
echo "<script>window.location.href = 'index.php'</script>";
//echo "File data successfully imported to database!!";
}
include('include/footer.php');
?>