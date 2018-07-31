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
//echo $qry_child = "SELECT id,phone as Phone1,mobile as Mobile3, extId, countryID FROM campus_students WHERE date(signInDate)>='$from_date' AND date(signInDate)<='$to_date' AND (std_status = 2 OR std_status=1 OR std_status=3) ";
//echo $qry_child = "SELECT id,phone as Phone1,mobile as Mobile3, extId, countryID FROM campus_students WHERE id BETWEEN 8052 AND 8307  AND (std_status = 2 OR std_status=1 OR std_status=3) ";
echo $qry_child = "SELECT id,phone as Phone1,mobile as Mobile3, extId, countryID FROM campus_students WHERE id BETWEEN 8865 AND 9020  AND (std_status = 2 OR std_status=1 OR std_status=3) ";
echo $rs_child = mysql_query($qry_child) or die(mysql_error());


$tofile0 = '';
$tofile0 = 'extension'.',';
$tofile0 .= 'name'.',';
$tofile0 .= 'cid_masquerade'.',';
$tofile0 .= 'sipname'.',';
$tofile0 .= 'outboundcid'.',';
$tofile0 .= 'devinfo_dial'.',';
$tofile0 .= 'deviceuser'.',';
$tofile0 .= 'description'.',';
$tofile0 .= 'devinfo_secret'.',';
$tofile0 .= "\r\n";

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
	//echo $row_get_extid_number['extId'];
	//echo $row_child['id'];
	//echo $row_child['countryID'];
	
	$row_child['Phone1'];
	$phone1_without_dashes_brackets_output = preg_replace('/\D+/', '', $row_child['Phone1']);
	$phone1_without_dashes_brackets_output = ltrim($phone1_without_dashes_brackets_output, '0');
	
	$row_child['Mobile3'];
	$Mobile3_without_dashes_brackets_output = preg_replace('/\D+/', '', $row_child['Mobile3']);
	$Mobile3_without_dashes_brackets_output = ltrim($Mobile3_without_dashes_brackets_output, '0');
	
	if(trim($row_child['extId']) != ''){
	
		//extension
		//$tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		//$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		//$tofile3 .= '33'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
		//exit;
		//Name
		//$tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		//$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		//$tofile3 .= '33'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
	
		//cid_masquerade
		//$tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		//$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		//$tofile3 .= '33'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
		
		//sipname
		//$tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		//$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		//$tofile3 .= '33'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
	
		//outboundcid
		//$tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		//$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		//$tofile3 .= '520100'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
		
		//devinfo_dial
		if(trim($row_child['Phone1']) !=''){
			
			if($row_child['countryID'] == 36){
				//Its Pakistan
				//$pak_phone = trim($phone1_without_dashes_brackets_output);
				//$pak_phone = ltrim($pak_phone,'92');
				//$pak_phone = ltrim($pak_phone,'0');
				//$pak_phone = '0'.$pak_phone;
				
				//$tofile1 .= "SIP/".trim($pak_phone)."@voip".',';
				//$tofile2 .= "SIP/".trim($pak_phone)."@voipp".',';
				//$tofile3 .= "SIP/7".trim($pak_phone)."@local".',';
				
			}else{
				//$tofile1 .= "SIP/".trim($phone1_without_dashes_brackets_output)."@voip".',';
				//$tofile2 .= "SIP/".trim($phone1_without_dashes_brackets_output)."@voipp".',';
				//$tofile3 .= "SIP/700".trim($phone1_without_dashes_brackets_output)."@local".',';
				$tofile4 .= "SIP/".trim($phone1_without_dashes_brackets_output)."@voip".',';
			}
		}else{
			
			//$tofile1 .= "SIP/NUMBER@voip".',';
			//$tofile2 .= "SIP/NUMBER@voipp".',';
			//$tofile3 .= "SIP/700NUMBER@local".',';
			$tofile4 .= "SIP/NUMBER@voip".',';
		}
		
		if(trim($row_child['Mobile3']) !=''){

			if($row_child['countryID'] == 36){
				//Its Pakistan
				//$pak_phone3 = trim($Mobile3_without_dashes_brackets_output);
				//$pak_phone3 = ltrim($pak_phone,'92');
				//$pak_phone3 = ltrim($pak_phone3,'0');
				//$pak_phone3 = '0'.$pak_phone3;
				
				//$tofile4 .= "SIP/7".trim($pak_phone3)."@local".',';
				
			}else{
				//$tofile4 .= "SIP/".trim($Mobile3_without_dashes_brackets_output)."@voip".',';
			}
		}else{
			//$tofile4 .= "SIP/NUMBER@voip".',';		
		}
	
		//deviceuser
		//$tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		//$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		//$tofile3 .= '33'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
		
		//description
		//$tofile1 .= '11'.trim($row_get_extid_number['extId']).',';
		//$tofile2 .= '22'.trim($row_get_extid_number['extId']).',';
		//$tofile3 .= '33'.trim($row_get_extid_number['extId']).',';
		$tofile4 .= '66'.trim($row_get_extid_number['extId']).',';
		
		//devinfo_secret
		//$tofile1 .= 'BZH@ss6990'.',';
		//$tofile2 .= 'BZH@ss6990'.',';
		//$tofile3 .= 'BZH@ss6990'.',';
		$tofile4 .= 'BZH@ss6990'.',';
		
		//$tofile1 .= "\r\n";
		//$tofile2 .= "\r\n";
		//$tofile3 .= "\r\n";
		$tofile4 .= "\r\n";
		
		//$final_tofile_str .= $tofile1;
		//$final_tofile_str .= $tofile2;
		//$final_tofile_str .= $tofile3;
		$final_tofile_str .= $tofile4;
		
	}//end if(trim($row_get_extid_number['extId']) != '')
}//end while

	$final_tofile_str = $tofile0.$final_tofile_str;
	$myFile = "aaqib-voiceid-update-collection-customer".date('dMYHis')."($from_date to $to_date)_with_66_ext_only.csv";
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