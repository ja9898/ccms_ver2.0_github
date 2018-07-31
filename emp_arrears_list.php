<? 
include('config.php');
include('include/header.php');

//if($_SESSION['userId']==159 || $_SESSION['userId']==195 || $_SESSION['userId']==294 || $_SESSION['userId']==48)
//{

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div style="float:left">
<?php
/*getCourseFilter();
getActiveDeactiveFilter();
getFilterSubmit();*/
?></div>
<br>
</form>
</div>
<?
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>"; 
echo "<th class='specalt'><b>Arrears Amount</b></th>";  
echo "<th class='specalt'><b>empID</b></th>"; 
echo "<th class='specalt'><b>comments</b></th>"; 
echo "<th class='specalt'><b>date</b></th>";   
echo "<th class='specalt' colspan=4><b>Actions</b></th>"; 
echo "</tr>";

$result = mysql_query("SELECT * FROM `campus_emp_arrears`") or trigger_error(mysql_error());

while($row = mysql_fetch_array($result)){ 
foreach($row as $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['arrears_amount']) . "</td>"; 
echo "<td valign='top'>" . showUser( nl2br( $row['empID'])) . "</td>";    
echo "<td valign='top'>" . nl2br( $row['comments']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";  

echo "<td valign='top'><a href=emp_arrears_edit.php?id={$row['id']} class='button'>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class='button' href=#>Delete</a></td> ";
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=emp_arrears_new.php class='button'>New Row</a>"; 
//}
//else
//{
//	echo "<label style='color:red; font-weight:bold'>NOTE: Contact CCMS Administrator</u></label>";
//}
include('include/footer.php');
?>