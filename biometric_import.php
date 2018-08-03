<?php
//***************************************************************************************************
//http://community.sitepoint.com/t/import-excel-file-to-php-myadmin-through-file-uploading-using-php/38433/2 for CSV
//http://stackoverflow.com/questions/11391366/php-read-from-file-with-a-space for txt file,TAB DLIMITED
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

/*******	>>>>>>>>>>>>>>>>>>>>>>>>>>>>>>IMPORTANT<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
Previously csv file was being uploaded, Now .txt file is being uploaded // 14-04-17 *********/
$csv_file = $a;
$fp = fopen($csv_file, "r") or die("Couldn't open File");
while (!feof($fp)) { //Continue loading strings till the end of file
    $line = fgets($fp, 1024); // Load one complete line
    $line = explode("\t", $line);
	
			echo "<br>";echo "<br>";echo "<br>";
            $col1 = $line[0];echo "<br>";
			$col2 = prepareDate($line[1]);echo "<br>";
			$col3 = $line[2];echo "<br>";
			$col4 = $line[3];echo "<br>";
			$col5 = $line[4];echo "<br>";
			$col6 = $line[5];echo "<br>";
			
			$col7 = $line[6];echo "<br>";
			$col8 = $line[7];echo "<br>";
			$col9 = $line[8];echo "<br>";
			$col10 = $line[9];echo "<br>";
			$col11 = $line[10];echo "<br>";
			
			$sql_check_same_bioid_date="SELECT * FROM campus_attendance_employee WHERE biometricId='".$col1."' AND date='".$col2."' ";
			$result_check_same_bioid_date=mysql_query($sql_check_same_bioid_date);
			$rowcount = mysql_num_rows($result_check_same_bioid_date);
		if(!$rowcount){

		$query = "INSERT INTO campus_attendance_employee(biometricId,date,onDuty,offDuty,clockIn,clockOut,late,early,absent,exception,department) VALUES('".$col1."','".$col2."','".$col3."','".$col4."','".$col5."','".$col6."','".$col7."','".$col8."','".$col9."','".$col10."','".$col11."')";
		$result=mysql_query($query);
		}
		else{
			echo "<script>alert('Duplication of BIOMETRIC ID and DATE found.');</script>";
			echo "<script>window.location.href = 'index.php'</script>";
			//exit;
		}
	}
echo "<script>alert('Record successfully uploaded.');</script>";
echo "<script>window.location.href = 'index.php'</script>";
}
include('include/footer.php');
?>