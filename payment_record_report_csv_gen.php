<? 
//EXPORT PHP TABLEinto a .CSV file of EXCEL - Following is a useful link
//http://stackoverflow.com/questions/16544698/export-database-results-to-csv-with-php
//http://stackoverflow.com/questions/217424/create-a-csv-file-for-a-user-in-php


// VERY IMPORTANT-FOR 1D or 2D arrays and to make CSV file out of these arrays, Use sessions, Further details in following link
//http://stackoverflow.com/questions/13811385/pass-array-from-one-page-to-another

//include('config.php'); 
//include('include/header.php');

header("Content-type: text/csv");
header("Content-Disposition: attachment; filename=file.csv");
header("Pragma: no-cache");
header("Expires: 0");

session_start();                    
if(isset($_SESSION['prr_array']))	
{
	$prr_a = $_SESSION['prr_array'];	//Simply using this $_SESSION array without applying loops as this array is already filled up 
										//in payment_record_report.php file
	//$array = array(
	//	array("data11", "data12", "data13"),	//SAMPLE DATA
	//	array("data21", "data22", "data23"),
	//	array("data31", "data32", "data23"));

	/*echo $array[0][0];						//SAMPLE DATA
	echo $array[0][1];
	echo $array[0][2];


	echo $prr_a[0][0];
	echo $prr_a[0][1];
	echo $prr_a[0][2];*/
}

outputCSV($prr_a);

function outputCSV($data) 
{
    $outstream = fopen("php://output", "w");
    function __outputCSV(&$vals, $key, $filehandler) {
        fputcsv($filehandler, $vals); // add parameters if you want
    }
    array_walk($data, "__outputCSV", $outstream);
    fclose($outstream);
}

//include('include/footer.php');?>

