<? 
include('config.php'); 
include('include/header.php');

if(isset($_POST['submit']))
{
	
	$fromDate=date('d',strtotime($_POST['fromDate']));
	$toDate=date('d',strtotime($_POST['toDate']));
	$fromMonth=date('m',$_POST['fromDate']);
	$toMonth=date('m',$_POST['toDate']);
	echo $_POST['fromDate']."<br>";
	echo date("m-d-Y")."<br>";
	echo $fromDate.",".$toDate.",".$fromMonthm.",".$toMonth; 
	if($fromDate < $toDate){
	     $sql="SELECT campus_transaction.*,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline FROM campus_transaction ,`campus_students` WHERE ";
	 if(isset($_REQUEST['id'])) {$sql.="studentID=".$_REQUEST["id"]." and "  ;}
	$sql.="  DAY(campus_transaction.date)  BETWEEN ".$fromDate." AND ".$toDate." campus_transaction.studentID = campus_students.id GROUP BY campus_transaction.studentID";}
	elseif($fromDate == $toDate){
	 $sql="SELECT campus_transaction.*,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline FROM campus_transaction ,`campus_students` WHERE ";
	 if(isset($_REQUEST['id'])) {$sql.="studentID=".$_REQUEST["id"]." and "  ;}
	$sql.=" DAY(campus_transaction.date) = ".$toDate." campus_transaction.studentID = campus_students.id GROUP BY campus_transaction.studentID";}
	else{
	     $sql="SELECT campus_transaction.*,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline FROM campus_transaction ,`campus_students` WHERE ";
	 if(isset($_REQUEST['id'])) {$sql.="studentID=".$_REQUEST["id"]." and "  ;}
	$sql.="DAY(campus_transaction.date) NOT BETWEEN ".$toDate." AND ".$fromDate." campus_transaction.studentID = campus_students.id GROUP BY campus_transaction.studentID";
	}

	
}
else
{

	$sql="SELECT campus_transaction.*,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline FROM `campus_transaction`,`campus_students` where ";
	 if(isset($_REQUEST['id'])) {$sql.="studentID=".$_REQUEST["id"]." and " ;}
	$sql.=" campus_transaction.studentID = campus_students.id GROUP BY campus_transaction.studentID";
	
	//$q1=("SELECT campus_transaction.*, campus_schedule.duedate FROM campus_transaction  LEFT JOIN campus_schedule ON campus_schedule.duedate='".date("Y-m-d")."' GROUP BY campus_transaction.studentID");
	$q1=("SELECT campus_schedule.studentID,campus_schedule.dues FROM campus_schedule WHERE campus_schedule.duedate='".$datecheck."'");
	
	$q2=("SELECT * FROM campus_schedule WHERE duedate='".$datecheck."'");
}

?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;<?php echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
&nbsp;&nbsp;<input type="hidden" class="button" name="id" value="<?php if(isset($_GET['id'])) {echo $_GET["id"] ;}?>"><input type="submit" class="button" name="submit" value="Filter">
<input type="button" class="button" onclick="window.location.href='transaction_list.php'" value="List All"></form>
<br /><br />
</div>

<? 
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Phone</th>"; 
echo "<th class='specalt'>Email</th>"; 
echo "<th class='specalt'>Date</th>"; 
echo "<th class='specalt'>Student</th>"; 

echo "<th class='specalt'>Amount</th>"; 
echo "<th class='specalt'><b>Actions</b></th>"; 
echo "</tr>"; 
$result = mysql_query($sql) or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>";
if(!empty($row['phone'])){

//echo "[" . nl2br( $row['phone'] )."]";
echo "-";
}
if(!empty($row['mobile'])){
//echo " <br>[".nl2br( $row['mobile'] )."]";
echo "-";
}
if(!empty($row['landline'])){
//echo "<br>[".nl2br( $row['landline'] ) . "]";
echo "-";
}
echo "</td>";  
//echo "<td valign='top'>" . nl2br( $row['email']) . "</td>";  
echo "<td valign='top'>-</td>";
echo "<td valign='top'>" .prepareDate( nl2br( $row['date']),'m') . "</td>";  
echo "<td valign='top'><a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
  
echo "<td valign='top'>" . nl2br( $row['amount']) . "</td>";  
echo "<td ><a class=button href=class_details.php?id={$row['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$row['studentID']}>Pay</a>&nbsp;&nbsp;<a class=button href=transaction_edit.php?id={$row['studentID']}>Edit</a>&nbsp;&nbsp;<a class=button href=delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>";






//DISPLAYING RECORD OF THOSE STUDENTS WHOS PAYMENT IS DUE TODAY
/*echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
//echo "<th class='specalt'>Date</th>"; 
echo "<th class='specalt'>Name</th>"; 
echo "<th class='specalt'>Amount</th>"; 
echo "<th class='specalt'><b>Actions</b></th>"; 
echo "</tr>"; 
$results1 = mysql_query($q1); //or trigger_error(mysql_error()); 
if(mysql_num_rows($results1))
{
while($rows1 = mysql_fetch_array($results1)){ 
//foreach($rows1 AS $key => $value) { $rows1[$key] = stripslashes($value); } 
echo "<tr>";  
//echo "<td valign='top'>";

//echo "</td>";  
//echo "<td valign='top'>" . nl2br( $rows1['duedate']) . "</td>";  
echo "<td valign='top'>" . showStudents(nl2br( $rows1['studentID'])) . "</td>";
echo "<td valign='top'>" . nl2br( $rows1['dues']) . "</td>";  
echo "<td ><a class=button href=class_details.php?id={$row['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$row['studentID']}>Pay</a>&nbsp;&nbsp;<a class=button href=transaction_edit.php?id={$row['id']}>Edit</a>&nbsp;&nbsp;<a class=button href=delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>";
}*/





//DISPLAYING ROW FOR TODAY'S/CURRENT DATE
/*echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>Date</th>"; 

echo "</tr>"; 
$results2 = mysql_query($q2) or trigger_error(mysql_error()); 
while($rows2 = mysql_fetch_array($results2)){ 
foreach($rows2 AS $key => $value) { $rows2[$key] = stripslashes($value); } 
echo "<tr>";  
//echo "<td valign='top'>";

//echo "</td>";  
echo "<td valign='top'>" . nl2br( $rows2['duedate']) . "</td>";  
echo "</tr>"; 
} 
echo "</table>";*/




echo "<a href=transaction_new.php class=button>New Row</a>"; 
include('include/footer.php');?>