<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left"><?php 
//getTeacherFilter();
?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>
&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>
</div>
<br><br>

<div id="label">CAD to PKR(Enter exchange rate):</div>
<div id="field"><input name="exchange_rate" type="number" id="exchange_rate"  /></div> 

<div style="float:left">
<?php
getFilterSubmit();
?></div>
<br>

</form>
</div>
<?
if(isset($_POST['search-submit']))
{


//Table for REFERENCE
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
//Reference	***************************
echo "<tr bgcolor=#FF0000>";
echo "<th class='specalt'><b>Reference OF</b></th>"; 
echo "<th class='specalt'><b>Reference cnt</b></th>"; 
echo "<th class='specalt'><b>Reference Amt</b></th>"; 
echo "<th class='specalt'><b>Reference Commision</b></th>"; 
echo "</tr>"; 



$total_ref_sum_array=array();
$total_ref_amount_sum_array=array();	
$total_ref_commision_sum_array=array();	

		$fd = prepareDate($_POST['fromDate']);
		$td = prepareDate($_POST['toDate']);
		$ref_query="SELECT campus_schedule.id as sch_id,campus_schedule.dead_date,campus_schedule.std_status_old,campus_schedule.std_status,count(campus_schedule.reference) as cnt_ref,campus_schedule.status,SUM(campus_schedule.dues) as dues_ref,campus_schedule.dateBooked,campus_schedule.duedate,campus_schedule.comments_dead,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.reference 
		FROM campus_schedule 
		WHERE campus_schedule.status=1 and campus_schedule.reference!=0 and campus_schedule.reference IS NOT NULL"; 
		if($_POST['fromDate']!="" && $_POST['toDate']!="")
		{
			$ref_query.=" and campus_schedule.duedate>= '".prepareDate($_POST['fromDate'])."' and campus_schedule.duedate<= '".prepareDate($_POST['toDate'])."'";
		}
		$ref_query.="  GROUP BY campus_schedule.reference ORDER BY SUM(campus_schedule.dues) desc";
		
		$ref_result = mysql_query($ref_query) or trigger_error(mysql_error());
		while($row_ref_result = mysql_fetch_array($ref_result))
		{
		$row_ref_result['reference'];
		echo "<tr>";
			echo "<td valign='top'>" . "<a href=schedule_with_teamlead_commision.php?id={$row_ref_result['reference']}&fromdate={$fd}&todate={$td} target='_blank'>" . showUser(nl2br( $row_ref_result['reference'])) . "</a></td>";
			echo "<td valign='top'> " . $total_ref_sum_array[$row_ref_result['sch_id']] = $row_ref_result['cnt_ref'] . "</td>";
			echo "<td valign='top'> " . $total_ref_amount_sum_array[$row_ref_result['sch_id']] = $row_ref_result['dues_ref'] . "</td>";
			echo "<td valign='top'> " . $total_ref_commision_sum_array[$row_ref_result['sch_id']] = (($total_ref_amount_sum_array[$row_ref_result['sch_id']]) / 90) * (1000) . "</td>";		
		echo "</tr>";
		}
echo "<tr>";
echo "<td valign='top'> </td>";
echo "<td valign='top' style='color:red;'><b>" . nl2br( array_sum($total_ref_sum_array)) . "</td>";
echo "<td valign='top' style='color:red;'><b>$" . nl2br( array_sum($total_ref_amount_sum_array)) . "</td>";   
echo "<td valign='top' style='color:red;'><b>Rs." . nl2br( array_sum($total_ref_commision_sum_array)) . "</td>";   
echo "</tr>";
echo "</table>";


}


include('include/footer.php');
?>