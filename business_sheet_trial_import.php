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
			$col1 = $slice[0];echo "<br>";
			$col2 = $slice[1];echo "<br>";
			$col3 = $slice[2];echo "<br>";
			$col4 = $slice[3];echo "<br>";
			$col5 = $slice[4];echo "<br>";
			$col6 = $slice[5];echo "<br>";
			$col7 = $slice[6];echo "<br>";
			$col8 = $slice[7];echo "<br>";
			$col9 = $slice[8];echo "<br>";
			$col10 = prepareDate($slice[9]);echo "<br>";
			$col11 = $slice[10];echo "<br>";
			$col12 = prepareDate($slice[11]);echo "<br>";
			
			

$query = "INSERT INTO campus_trial_business_sheet(
studentName,status,agent,teacher,email,number,country,course,shift,signupDate,signupAmount,
bookingDate) VALUES('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."',
'".$col7."','".$col8."','".$col9."','".$col10."','".$col11."','".$col12."')";
$result=mysql_query($query);
}
}
echo "<script>alert('Record successfully uploaded.');</script>";
echo "<script>window.location.href = 'index.php'</script>";
//echo "File data successfully imported to database!!";
}
include('include/footer.php');
?>