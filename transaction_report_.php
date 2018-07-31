<? 
include('config.php'); 
include('include/header.php');

if(isset($_POST['submit']))
{
	
	$fromDate=date('d',strtotime($_POST['fromDate']));
	$toDate=date('d',strtotime($_POST['toDate']));
	$fromMonth=date('m',$_POST['fromDate']);
	$toMonth=date('m',$_POST['toDate']);
	if($fromDate < $toDate){
	     $sql="SELECT *,day(campus_transaction.date) as `day`  FROM campus_transaction WHERE DAY(campus_transaction.date)  BETWEEN ".$fromDate." AND ".$toDate."   GROUP BY day(date) order by date DESC";}
	else{
	     $sql="SELECT *,day(campus_transaction.date) as `day`  FROM campus_transaction WHERE DAY(campus_transaction.date) NOT BETWEEN ".$toDate." AND ".$fromDate."  GROUP BY day(date) order by date DESC";
	}

	
}
else
{
	$sql="SELECT *,day(campus_transaction.date) as `day` FROM campus_transaction   group by day(date) order by `date` DESC";
}
?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
&nbsp;&nbsp;<input type="submit" class="button" name="submit" value="Filter"></form>
<br /><br />
</div>

<? 
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Day</th>"; 
 
echo "<th class='specalt'>Total Amount</th>"; 
echo "<th class='specalt'>Recieved Amount</th>"; 
echo "<th class='specalt'>Pending Amount</th>"; 

echo "</tr>";
$amount=array();
$recieved=array();
$pending =array();
$result = mysql_query($sql) or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); }
$countsql="select sum(amount) as amount FROM campus_transaction where day(date)='".$value."'"; 
$countresult=mysql_query($countsql);
$countresult=mysql_fetch_assoc($countresult);

 $countmonthsql="select sum(amount) as amount FROM campus_transaction where month(date)='".date('m')."' and day(date)='".$value."'"; 
$countmonthesult=mysql_query($countmonthsql);
$countmonthesult=mysql_fetch_assoc($countmonthesult);

$amount[$value]=$countresult['amount'];
$recieved[$value]=$countmonthesult['amount'];
$pending[$value]=$countresult['amount']-$countmonthesult['amount'];
echo "<tr>";  
  
echo "<td valign='top'>" . nl2br( $row['day']) . "</td>";  
  
echo "<td valign='top'>$" . nl2br( $amount[$value])  . "</td>";  
echo "<td valign='top'>$" . nl2br( $recieved[$value]) . "</td>";  
echo "<td valign='top'>$" . nl2br( $pending[$value]) . "</td>";  
 
echo "</tr>"; 
}


echo "<tr>";  
  
echo "<td valign='top'>Sum </td>";  
  
echo "<td valign='top'><b>$" . nl2br( array_sum($amount))  . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($recieved)) . "</td>";  
echo "<td valign='top'><b>$" . nl2br( array_sum($pending)) . "</td>";  
 
echo "</tr>";

echo "</table>"; 
echo "<a href=transaction_new.php class=button>New Row</a>"; 
include('include/footer.php');?>