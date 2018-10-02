<?php

//USEFUL Links to get the values of table cells <td>
//1) http://stackoverflow.com/questions/23089513/extract-specific-values-from-html-table-using-regex
//2) http://stackoverflow.com/questions/19348774/php-find-specific-values-inside-of-tablefile
//*********????????		I am using 2nd one as it worked for me quite well	?????????**********

$database="testnew";
$username="root";
$password="";
/*$r = mysql_connect('localhost',$username,$password);
if (!$r) {
    echo "Could not connect to server\n";
    trigger_error(mysql_error(), E_USER_ERROR);
} else {
    echo "Connection established\n"; 
}*/

$link = mysql_connect('localhost', $username, $password);
if (!$link) {
    die('Not connected : ' . mysql_error());
}
else {
    echo "Connection established\n"; 
}
if (! mysql_select_db($database) ) {
    die ('Can\'t use cloud_new1 : ' . mysql_error());
}
// It may take a whils to crawl a site ...
set_time_limit(10000);		
///////////////////////////////////////////////////////////////////////////////////////////////////////////
$file_contents = @file_get_contents("http://www.salahtimes.com/pakistan/islamabad");
if($file_contents==''){ break; }
$value = preg_match_all('/<table.*?>(.*?)<\/table>/si', $file_contents, $estimates); 
$content_est = $estimates[0][0];
$string = $content_est;
$td_num = substr_count($string, '<td>');
for ($i=1;$i<=$td_num;$i++)
{
	$first_td_main[$i] = strpos($string, '<td>') + 4; 
	$first_td[$i] = strpos($string, '<td>'); 
	$last_td[$i]  = strpos($string, '</td>');
	$td_value[$i] = substr($string,$first_td[$i],$last_td[$i]-$first_td[$i]);

	$td_value_main[$i].= substr($string,$first_td_main[$i],$last_td[$i]-$first_td_main[$i]);

/* if($td_value_main[$i]==date('d'))
	{
		$td_value[$i]+1;echo "****";echo "<br>";
		$td_value[$i]+2;echo "****";echo "<br>";
		$td_value[$i]+3;echo "****";echo "<br>";
		$td_value[$i]+4;echo "****";echo "<br>";
	} */
	$string = substr($string,$last_td[$i]+5);
	if($td_value_main[$i]==date('d'))
	{
		echo "SALAH TIME:".$salah_time=$string;echo "<br>";echo "<br>";
		$pieces = explode("<td>",$salah_time);
		//echo $pieces[0];echo "<br>"; // piece1
		//echo $pieces[1];echo "<br>"; // piece2
		$pieces[2];
		//echo $pieces[3];echo "<br>";
		$pieces[4];
		$pieces[5];
		$pieces[6];
		$pieces[7];
		$piece1 = ltrim($pieces[2], "''");
		$piece2 = ltrim($pieces[4], "''");
		$piece3 = ltrim($pieces[5], "''");
		$piece4 = ltrim($pieces[6], "''");
		$piece5 = ltrim($pieces[7], "''");
		
		$piece1 = explode('</td>',$piece1);
		$piece1 = $piece1[0];
		$piece2 = explode('</td>',$piece2);
		$piece2 = $piece2[0];
		$piece3 = explode('</td>',$piece3);
		$piece3 = $piece3[0];
		$piece4 = explode('</td>',$piece4);
		$piece4 = $piece4[0];
		//$piece5 = rtrim($piece5, "</td>");
		$input = $piece5;
		$result = explode('</td>',$input);
		$piece5 = $result[0];
		break;
	}
}
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt'><b>Fajr</b></th>"; 
echo "<th class='specalt'><b>Zohar</b></th>"; 
echo "<th class='specalt'><b>Asar</b></th>";
echo "<th class='specalt'><b>Magrib</b></th>"; 
echo "<th class='specalt'><b>Isha</b></th>";
echo "</tr>"; 
echo "<tr>";
echo "<td valign='top' style='color:green; font-weight:bold;'>".$piece1."</td>";
echo "<td valign='top' style='color:green; font-weight:bold;'>".$piece2."</td>";
echo "<td valign='top' style='color:green; font-weight:bold;'>".$piece3."</td>";
echo "<td valign='top' style='color:green; font-weight:bold;'>".$piece4."</td>";
echo "<td valign='top' style='color:green; font-weight:bold;'>".$piece5."</td>";
echo "</tr>";
echo "</table>";
//////////////////////////////////////////////////////////////////////////////////////////////////////


	if($piece1!=''){
	  echo $sql="INSERT INTO `campus_prayer_times` (id,fajr,zohar,asar,magrib,isha,date) 
	  VALUES ('','".$piece1."','".$piece2."','".$piece3."','".$piece4."','".$piece5."','".date('Y-m-d')."')";
	  $result = mysql_query($sql) or die(mysql_error());
	}

echo "done";
?>
