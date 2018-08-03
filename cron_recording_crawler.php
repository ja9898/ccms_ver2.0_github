<?php
set_time_limit(0);

error_reporting(E_ALL ^ E_NOTICE);
include('config.php');
include('include/header.php');

function readCSV($csvFile){

	$file_handle = fopen($csvFile, 'r');
	//$count=1;
	while (!feof($file_handle) ) {
		
		$line_of_csv = fgetcsv($file_handle,2500);
		
		$source_caller_arr = explode('-',ltrim(trim($line_of_csv[5]),'SIP/'));
		$source_caller = $source_caller_arr[0];

		$source_caller = str_replace($str_search_arr, $str_replace_arr,$source_caller);
		
		$destination_caller = trim($line_of_csv[2]);
		
		$call_start_time = trim(date('Y-m-d H:i:s', strtotime($line_of_csv[9])));
		$call_end_time = trim(date('Y-m-d H:i:s', strtotime($line_of_csv[11])));
		
		$call_duration_in_seconds = trim($line_of_csv[12]);
		$call_status = trim($line_of_csv[14]);
		
		$call_date = trim(date('Y-m-d', strtotime($line_of_csv[9])));

		$recording_file_destination_caller = $destination_caller;
		$substr_3_dig = substr($destination_caller,0,3);
		$substr_2_dig = substr($destination_caller,0,2);
		
		if($substr_3_dig == '699' || $substr_3_dig == '688')
			$recording_file_destination_caller = substr($destination_caller,3,strlen($destination_caller));


		if($substr_2_dig == '99' || $substr_2_dig == '72')
			 $recording_file_destination_caller = substr($destination_caller,2,strlen($destination_caller));

		$other_details = $line_of_csv[7];
		
		$recording_file = $recording_file_destination_caller.'-'.trim(date('Ymd', strtotime($line_of_csv[9]))).'-'.trim(date('His', strtotime($line_of_csv[9]))).'--'.$source_caller.'.wav';
		
		$qry_check_if_rec_exist = "SELECT * FROM tbl_recordings_log WHERE source_caller = '".addslashes($source_caller)."' AND destination_caller = '".addslashes($destination_caller)."' AND call_start_time = '".addslashes($call_start_time)."' AND call_end_time = '".addslashes($call_end_time)."'";
		$rs_check_if_rec_exist = mysql_query($qry_check_if_rec_exist) or die(mysql_error());
		
		$count_if_rec_exist = mysql_num_rows($rs_check_if_rec_exist);
		

		if($count_if_rec_exist == 0){
			
			echo $qry_insert_recording = "INSERT INTO tbl_recordings_log SET source_caller = '".addslashes($source_caller)."', destination_caller = '".addslashes($destination_caller)."',
											call_start_time = '".addslashes($call_start_time)."', call_end_time = '".addslashes($call_end_time)."',
											call_duration = '".addslashes($call_duration_in_seconds)."', call_status = '".addslashes($call_status)."', 
											call_date = '".addslashes($call_date)."', other_details = '".addslashes($other_details)."',
											recording_file = '".addslashes($recording_file)."', created_date = '".date('Y-m-d')."'";
				
			
			mysql_query($qry_insert_recording)	or die(mysql_error());
			
			echo '<br><hr><br>';
		}//end if($count_if_rec_exist == 0)
		//$count = $count+1;
	}//end while (!feof($csvFile) )
	
	fclose($file_handle);
	
}//end readCSV($csvFile)

//$url = "http://192.168.1.13/taleemequran/newadmin/upload_ref/Master1.txt";
//$url = '65-254-45-122/8009.csv';
$url = 'http://104.222.97.179/LOG/8020.csv';
$txt = file_get_contents("http://104.222.97.179/LOG/8020.csv");

$fp = fopen("upload_ref/8020.txt", "w");
fwrite($fp,$txt);
fclose($fp);
/*
$ch = curl_init ($url);
curl_setopt ($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_FILE, $fp);
curl_setopt($ch, CURLOPT_HEADER, 0);
curl_exec($ch);
curl_close($ch);
fclose($fp);	
*/

// Set path to CSV file
$csvFile = 'upload_ref/8020.txt';
$csv = readCSV($csvFile);

echo "Done";
include('include/footer.php');
exit;


exit;

?>