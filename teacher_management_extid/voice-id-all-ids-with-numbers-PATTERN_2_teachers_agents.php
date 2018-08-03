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

$qry_teachers_agents = "
SELECT * 
FROM `capmus_users` 
WHERE `status`=1 AND voice_id!='' AND 
(`user_type`=3 OR `user_type`=5) AND (`empShift`=1 OR `empShift`=2)";


$rs_teachers_agents = mysql_query($qry_teachers_agents) or die(mysql_query());

$tofile0 = '';

$no_voice_setting_user_id_arr = array();
$flag = 0;
while($row_teachers_agents = mysql_fetch_array($rs_teachers_agents)){
	
	$no_voice_setting_parent_id_arr = array('7725');
	/* $qry_child = "SELECT phone as Phone1, phone_1 as Phone2, mobile as Mobile1, mobile2 as Mobile2, mobile3 as Mobile3 , voice_id, countryID FROM tbl_children WHERE parentId = '".$row_distinct_parent['ParentID']."' AND parentId <> '1444'  limit 0,1";
	$rs_child = mysql_query($qry_child) or die(mysql_error());
	$row_child = mysql_fetch_array($rs_child);
 */
	$tofile1 = '';
	
	$flag++;
	
	
	
	if(trim($row_teachers_agents['voice_id']) != ''){
		//extension
		/* $tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		$tofile3 .= '33'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
		 *///exit;
		 
		$tofile1 .= "exten => ".$row_teachers_agents['voice_id'].",1,Set(__RINGTIMER=$"."{IF($[$"."{DB(AMPUSER/".$row_teachers_agents['voice_id']."/ringtimer)} > 0]?$"."{DB(AMPUSER/".$row_teachers_agents['voice_id']."/ringtimer)}:$"."{RINGTIMER_DEFAULT})})\r\n";
		$tofile1 .= "exten => ".$row_teachers_agents['voice_id'].",n,Macro(exten-vm,novm,".$row_teachers_agents['voice_id'].",0,0,0)\r\n";
		$tofile1 .= "exten => ".$row_teachers_agents['voice_id'].",n(dest),Set(__PICKUPMARK=)\r\n";
		$tofile1 .= "exten => ".$row_teachers_agents['voice_id'].",n,Goto($"."{IVR_CONTEXT},return,1)\r\n";
		$tofile1 .= "exten => ".$row_teachers_agents['voice_id'].",n,Goto(from-internal,".$row_teachers_agents['voice_id'].",1)\r\n";
		$tofile1 .= "exten => ".$row_teachers_agents['voice_id'].",hint,SIP/".$row_teachers_agents['voice_id']."@voip&Custom:DND".$row_teachers_agents['voice_id'].",CustomPresence:".$row_teachers_agents['voice_id']."\r\n";
		$tofile1 .= "\r\n";		
		
		$final_tofile_str .= $tofile1;

		
	}//end if(trim($row_get_extid_number['extId']) != '')
}//end while

	$final_tofile_str = $tofile0.$final_tofile_str;
	$myFile = "voice-id-all-ids-with-numbers-PATTERN_2_teachers".date('dMYHis')."($from_date to $to_date).txt";
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