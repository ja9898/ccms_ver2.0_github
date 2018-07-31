<?php
//CSV Reader in PHP.
/***********************************************/
//CSV File name

include('config.php');
include('include/header.php'); 

/*

$from_date = '2014-03-27';
$to_date = '2014-04-18';
*/

$from_date = '0000-00-00';
$to_date = '2016-06-06';

//$qry_distinct_parent = "SELECT distinct(studentID) as studentID,phone as Phone1, extId, countryID FROM campus_students WHERE signInDate BETWEEN '$from_date' AND '$to_date' AND (std_status = 1 OR std_status=0) ";

//$rs_distinct_parent = mysql_query($qry_distinct_parent) or die(mysql_query());
echo $qry_child = "SELECT id,phone as Phone1,mobile as Mobile3, extId, countryID FROM campus_students WHERE id BETWEEN 8865 AND 9020 AND (std_status = 2 OR std_status=1 OR std_status=3) ";
echo $rs_child = mysql_query($qry_child) or die(mysql_error());


$tofile0 = '';


//$no_voice_setting_user_id_arr = array();
//$flag = 0;
while($row_child = mysql_fetch_array($rs_child)){

	$sql_get_extid_number = "SELECT * FROM campus_voice_ext WHERE id='".$row_child['extId']."' ";
	$result_get_extid_number = mysql_query($sql_get_extid_number) or die(mysql_error()); 
	$row_get_extid_number= mysql_fetch_array ( $result_get_extid_number );

	$tofile1 = '';
	$tofile2 = '';
	$tofile3 = '';
	$tofile4 = '';
	
	$flag++;
	$row_get_extid_number['extId'];
	$row_child['id'];
	$row_child['countryID'];
	
	$row_child['Phone1'];
	$phone1_without_dashes_brackets_output = preg_replace('/\D+/', '', $row_child['Phone1']);
	$phone1_without_dashes_brackets_output = ltrim($phone1_without_dashes_brackets_output, '0');
	
	$row_child['Mobile3'];
	$Mobile3_without_dashes_brackets_output = preg_replace('/\D+/', '', $row_child['Mobile3']);
	$Mobile3_without_dashes_brackets_output = ltrim($Mobile3_without_dashes_brackets_output, '0');
	//exit;
	if(trim($row_child['extId']) != ''){
	
		//extension
		/* $tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		$tofile3 .= '33'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
		 *///exit;

		$tofile1 .= "exten => 66".$row_get_extid_number['extId'].",1,Set(__RINGTIMER=$"."{IF($[$"."{DB(AMPUSER/66".$row_get_extid_number['extId']."/ringtimer)} > 0]?$"."{DB(AMPUSER/66".$row_get_extid_number['extId']."/ringtimer)}:$"."{RINGTIMER_DEFAULT})})\r\n";
		$tofile1 .= "exten => 66".$row_get_extid_number['extId'].",n,Macro(exten-vm,novm,66".$row_get_extid_number['extId'].",0,0,0)\r\n";
		$tofile1 .= "exten => 66".$row_get_extid_number['extId'].",n(dest),Set(__PICKUPMARK=)\r\n";
		$tofile1 .= "exten => 66".$row_get_extid_number['extId'].",n,Goto($"."{IVR_CONTEXT},return,1)\r\n";
		$tofile1 .= "exten => 66".$row_get_extid_number['extId'].",n,Goto(from-internal,66".$row_get_extid_number['extId'].",1)\r\n";
		//$tofile1 .= "host=dynamic\r\n";
		//$tofile1 .= "type=friend\r\n";
		//$tofile1 .= "nat=yes\r\n";
		//$tofile1 .= "port=5060\r\n";
		//$tofile1 .= "qualify=yes\r\n";
		
		//devinfo_dial
		if(trim($row_child['Phone1']) !=''){
				$tofile1 .= "exten => 66".$row_get_extid_number['extId'].",hint,SIP/".trim($phone1_without_dashes_brackets_output)."@voip&Custom:DND66".$row_get_extid_number['extId'].",CustomPresence:66".$row_get_extid_number['extId']."\r\n";
			
		}else{
			
			$tofile1 .= "dial=SIP/NUMBER@voip";
		}
		
		if(trim($row_child['Mobile3']) !=''){

		
				//$tofile4 .= "SIP/".trim($Mobile3_without_dashes_brackets_output)."@voip".',';
			
		}else{
			//$tofile4 .= "SIP/NUMBER@voip".',';		
		}

		
		$tofile1 .= "\r\n";

		
		$final_tofile_str .= $tofile1;

		
	}//end if(trim($row_get_extid_number['extId']) != '')
}//end while

	$final_tofile_str = $tofile0.$final_tofile_str;
	$myFile = "voice-id-all-ids-with-numbers-PATTERN_2".date('dMYHis')."($from_date to $to_date).txt";
	$fh = fopen($myFile, 'w') or die("can't open file");
	fwrite($fh, $final_tofile_str);
	fclose($fh);

echo 'Process Completed';
//print($tofile);
exit;


$csvfile = 'Parent-VoiceIDs AQIB File.csv' ;
$row = 1;
if (($handle = fopen($csvfile, "r")) !== FALSE) {
    while (($data = fgetcsv($handle,1000, ",")) !== FALSE) {
        $num = count($data);
        for ($c=0; $c < 2; $c++) {
            $csvdata[$data[0]] = $data[1];
        }

    }
    fclose($handle);
}
echo "<pre>";
//print_r($csvdata);

foreach($csvdata  as $parent_note => $voice_node){
	
	echo $qry_update = "UPDATE tbl_user SET extId = '".$voice_node."' WHERE Id = '".$parent_note."'";
	//$rs_query = mysql_query($qry_update) or die(mysql_error());
	
	echo $qry_stu_update = "UPDATE tbl_children  SET extId = '".$voice_node."' WHERE parentId = '".$parent_note."'";
	//$rs_std_query = mysql_query($qry_stu_update) or die(mysql_error());

	echo '<br>';
}
include('include/footer.php');
//exit;   
?>