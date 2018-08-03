<?php
include('config.php'); 
include('include/header.php');
?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">

&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>

&nbsp;&nbsp;
<?php //echo getInput(stripslashes($_POST['fromDate-day']),'fromDate-day','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php// echo getInput(stripslashes($_POST['toDate-day']),'toDate-day','class=flexy_datepicker_input');?>

&nbsp;&nbsp; 
<?php //getTeacherFilter(); ?>
&nbsp;&nbsp; 
<?php getAgentFilter(); ?>
&nbsp;&nbsp; 
Teacher Voice ID:
<input name="voice_id" type="text" class="mfield" id="voice_id"  autocomplete="Off" value="<?php echo $voice_id?>" />
<br><br>
<?php
getFilterSubmit();
?>
<br><br>

<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','std_status','stdStatus');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
</div>

<?
if(isset($_POST['search-submit']))
{
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>S. No</b></th>";
echo "<th class='specalt'><b>Source Number</b></th>"; 
echo "<th class='specalt'><b>Destination Number</b></th>";
echo "<th class='specalt'><b>Call Start Time</b></th>";
echo "<th class='specalt'><b>Call End Time</b></th>";
echo "<th class='specalt'><b>Call Duration</b></th>";  
echo "<th class='specalt'><b>Call Status</b></th>";
echo "<th class='specalt'><b>Recording File</b></th>";
echo "</tr>";	



//if(isset($_POST['voice_id']) || isset($_POST['search-teacher-id'])){
	
	extract($_POST);
	$where_clause = '';

	if($_POST['search-teacher-id']!= '' || $_POST['search-agent-id']!= ''){
		$agent_teacher = 0;
		if($_POST['search-teacher-id']!='') { $agent_teacher =  $_POST['search-teacher-id']; }
		if($_POST['search-agent-id']!='') { $agent_teacher =  $_POST['search-agent-id']; }
		$qry_get_emp_voice_id = "SELECT id, firstName, lastName, voice_id FROM capmus_users WHERE id = '".$agent_teacher."' AND status = '1'";
		$rs_get_emp_voice_id = mysql_query($qry_get_emp_voice_id) or die(mysql_error());
		
		$row_get_emp_voice_id = mysql_fetch_array($rs_get_emp_voice_id);
		$emp_voice_id = $row_get_emp_voice_id['voice_id'];
		$where_clause = " AND source_caller = '".$emp_voice_id."'";
		
		$emp_name = $row_get_emp_voice_id['id'].' - '.$row_get_emp_voice_id['firstName'].' '.$row_get_emp_voice_id['lastName'];

	}//end if($referral_hidden != '')
	
	if($voice_id != ''){
		$where_clause = " AND source_caller = '".$voice_id."'";
		$qry_get_emp_voice_id = "SELECT id, firstName, lastName, voice_id FROM capmus_users WHERE voice_id = '".$voice_id."' AND status = '1'";
		$rs_get_emp_voice_id = mysql_query($qry_get_emp_voice_id) or die(mysql_error());
		
		$row_get_emp_voice_id = mysql_fetch_array($rs_get_emp_voice_id);
		$emp_name = $row_get_emp_voice_id['id'].' - '.$row_get_emp_voice_id['firstName'].' '.$row_get_emp_voice_id['lastName'];		
		
	}//end if($voice_id != '')
	
	if($_POST['fromDate']!= '' && $_POST['toDate']!= ''){
		$where_clause .= " AND call_date BETWEEN '".prepareDate($_POST['fromDate'])."' AND '".prepareDate($_POST['toDate'])."'";
	}elseif($_POST['fromDate']!= '' && $_POST['toDate']== ''){
		$where_clause .= " AND call_date = '".prepareDate($_POST['fromDate'])."'";
	}elseif($_POST['fromDate']== '' && $_POST['toDate']!= ''){
		$where_clause .= " AND call_date = '".prepareDate($_POST['toDate'])."'";
	}
		
	$qry_search_log = "SELECT * FROM tbl_recordings_log WHERE 1=1 $where_clause ORDER BY call_start_time DESC";
	
	$rs_search_log = mysql_query($qry_search_log) or die(mysql_error());
	$count_search_log = mysql_num_rows($rs_search_log);
	
	
	
//}//end if(isset($_POST['voice_id']))

	  	if($count_search_log > 0){
echo "<tr>";  
	echo "<td colspan=10><h2>".$emp_name."</h2></td>";
echo "<tr>";

$i=1;
while($row_search_log = mysql_fetch_array($rs_search_log)){
echo "<tr>";
	echo "<td valign='top'>" . nl2br( $i) . "</td>";
	echo "<td valign='top'>" . nl2br( $row_search_log['source_caller']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row_search_log['destination_caller']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row_search_log['call_start_time']) . "</td>";  
	echo "<td valign='top'>" . nl2br( $row_search_log['call_end_time']) . "</td>";  
	echo "<td valign='top'>" . nl2br( round(($row_search_log['call_duration'])/60))  . "Minute(s) </td>"; 
	echo "<td valign='top'>" . nl2br( $row_search_log['call_status']) . "</td>";
   	if($row_search_log['call_status'] == 'ANSWERED'){?>
	<!--<td valign='top'>
		<a onclick=open_win("wav-player.php?src=<?php //echo base64_encode('http://104.222.97.179/RECORDINGS/ORIG/'.strtoupper(date(MY,strtotime($row_search_log['call_date']))).'/'.$row_search_log['recording_file'])?>"); href="javascript:;">Play File</a>
	</td>-->
	<!--<td valign='top'>
		<a onclick=open_win("wav-player.php?src=<?php //echo base64_encode('http://104.222.97.179/RECORDINGS/ORIG/'.strtoupper(date(Y,strtotime($row_search_log['call_date']))).'/'.date(F,strtotime($row_search_log['call_date'])).'/'.date(d,strtotime($row_search_log['call_date'])).'/'.$row_search_log['recording_file'];?>) ">Play File</a>
	</td>-->	
	
	<?
	echo "<td valign='top'><a href=http://104.222.97.179/RECORDINGS/ORIG/".strtoupper(date(Y,strtotime($row_search_log['call_date']))).'/'.date(F,strtotime($row_search_log['call_date'])).'/'.date(d,strtotime($row_search_log['call_date'])).'/'.$row_search_log['recording_file']." target='_blank'>Play file</a></td>";
	}else{
							echo "<td valign='top'>NA</td>";
						}
   
				$i++;
echo "</tr>"; 
			}//end while($row_search_log = mysql_fetch_array($rs_search_log))
		}else{
    		echo "<tr>";
            	echo "<td valign='top' colspan=10><strong>No Record Found</strong></td>";
			echo "</tr>";
		}//end if($count_search_log > 0)
 echo "</table>";
}//end SEARCH SUBMIT
	  ?>

<?php include('include/footer.php');?>