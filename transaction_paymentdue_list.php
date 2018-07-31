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
	
	$sql2=("SELECT * FROM campus_transaction_paymentdue");
	
}

?>

<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<?php 
//getStudentFilter();
?>
&nbsp;&nbsp;
<?php //echo getInput(stripslashes($_POST['fromDate']),'fromDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
<?php //echo getInput(stripslashes($_POST['toDate']),'toDate','class=flexy_datepicker_input');?>&nbsp;&nbsp;
&nbsp;&nbsp;
<!--<input type="hidden" class="button" name="id" value="<?php if(isset($_GET['id'])) {echo $_GET["id"] ;}?>">
<input type="submit" class="button" name="submit" value="Filter">
<input type="button" class="button" onclick="window.location.href='transaction_paymentdue_list.php'" value="List All">-->
</form>
<br /><br />
</div>

<? 
echo "<table border=0 id='table_liquid' cellspacing=0  >"; 
echo "<tr>"; 
echo "<th class='specalt'>ID</th>"; 
echo "<th class='specalt'>Email</th>";  
echo "<th class='specalt'><b>File Actions</b></th>";
echo "<th class='specalt'><b>Mail Action(To: CC : BCC)</b></th>"; 
echo "<th class='specalt'><b>Actions</b></th>"; 
echo "</tr>"; 
$result = mysql_query($sql2) or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" .nl2br( $row['email']) . "</td>";  
//echo "<td valign='top'><a href=transaction_list.php?id={$row['studentID']}>" . showStudents(nl2br( $row['studentID'])) . "</a></td>";  
echo "<td valign='top'><a href=transaction_paymentdue_month.php>" . getData(nl2br( $row['action']),'paymentdue') . "</a></td>";    
echo "<td valign='top'>" .getData(nl2br( $row['mailaction']),'mailaction') . "</td>";    
echo "<td ><a class=button href=transaction_paymentdue_edit.php?id={$row['id']}>Edit</a>&nbsp;&nbsp;<a class=button href=delete.php?id={$row['id']}>Delete</a></td> "; 
//echo "<td valign='top'>" . nl2br( $row['action']) . "</td>";  
//echo "<td ><a class=button href=class_details.php?id={$row['studentID']}>Class Details</a>&nbsp;&nbsp;<a class=button href=transaction_new.php?id={$row['studentID']}>Pay</a>&nbsp;&nbsp;<a class=button href=transaction_edit.php?id={$row['id']}>Edit</a>&nbsp;&nbsp;<a class=button href=delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>";

//echo "<a href=transaction_paymentdue_month_per_student_report.php >Detailed report per student</a><br><br>"; 


echo "<a href=transaction_paymentdue_new.php class=button>New Row</a>"; 
include('include/footer.php');?>