<?php
//CSV Reader in PHP.
/***********************************************/
//CSV File name

require_once("../config.php");
/*

$from_date = '2014-03-27';
$to_date = '2014-04-18';
*/

//$from_date = '2015-10-22';
$from_date = '0000-00-00';
$to_date = '2015-11-06';

//$qry_distinct_parent = "SELECT distinct(parentId) as ParentID FROM tbl_children WHERE signInDate BETWEEN '$from_date 00:00:00' AND '$to_date 23:59:59' AND (std_status = 1 OR std_status = 0 OR std_status = 2) ";

$qry_management = "
SELECT * 
FROM `capmus_users` 
WHERE `status`=1 AND voice_id!='' AND 
(`user_type`=1 OR `user_type`=8 OR `user_type`=9 OR `user_type`=15 OR `user_type`=16)";


$rs_management = mysql_query($qry_management) or die(mysql_query());

$tofile0 = '';

$no_voice_setting_user_id_arr = array();
$flag = 0;
while($row_management = mysql_fetch_array($rs_management)){
	
	$no_voice_setting_parent_id_arr = array('7725');
	/* $qry_child = "SELECT phone as Phone1, phone_1 as Phone2, mobile as Mobile1, mobile2 as Mobile2, mobile3 as Mobile3 , voice_id, countryID FROM tbl_children WHERE parentId = '".$row_distinct_parent['ParentID']."' AND parentId <> '1444'  limit 0,1";
	$rs_child = mysql_query($qry_child) or die(mysql_error());
	$row_child = mysql_fetch_array($rs_child);
 */
	$tofile1 = '';
	$tofile2 = '';
	$tofile3 = '';
	$tofile4 = '';
	
	$flag++;
	
	
	
	if(trim($row_management['voice_id']) != ''){
	
		//extension
		/* $tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		$tofile3 .= '33'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
		 *///exit;

		$tofile1 .= "[".$row_management['voice_id']."]\r\n";
		$tofile1 .= "deny=0.0.0.0/0.0.0.0\r\n";
		$tofile1 .= "secret=".$row_management['v_password']."\r\n";
		$tofile1 .= "dtmfmode=rfc2833\r\n";
		$tofile1 .= "canreinvite=\r\n";
		$tofile1 .= "context=from-internal\r\n";
		$tofile1 .= "host=dynamic\r\n";
		$tofile1 .= "type=friend\r\n";
		$tofile1 .= "nat=yes\r\n";
		$tofile1 .= "port=5060\r\n";
		$tofile1 .= "qualify=yes\r\n";
			$tofile1 .= "dial=SIP/".$row_management['voice_id']."\r\n";
		$tofile1 .= "mailbox=".$row_management['voice_id']."@device\r\n";
		$tofile1 .= "permit=0.0.0.0/0.0.0.0\r\n";
		$tofile1 .= "trustrpid=yes\r\n";
		$tofile1 .= "sendrpid=no\r\n";
		$tofile1 .= "qualifyfreq=64\r\n";
		$tofile1 .= "transport=ws,udp,tcp,tls\r\n";
		$tofile1 .= "encryption=yes\r\n";
		$tofile1 .= "callerid= <".$row_management['voice_id'].">\r\n";
		$tofile1 .= "callcounter=yes\r\n";
		$tofile1 .= "faxdetect=no\r\n";
		$tofile1 .= "cc_monitor_policy=generic\r\n";
		$tofile1 .= "\r\n";
		
		
		$final_tofile_str .= $tofile1;

		
	}//end if(trim($row_get_extid_number['extId']) != '')
}//end while

	$final_tofile_str = $tofile0.$final_tofile_str;
	$myFile = "voice-id-all-ids-with-numbers-PATTERN_management".date('dMYHis')."($from_date to $to_date).txt";
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
//include('include/footer.php');
exit;   
?>