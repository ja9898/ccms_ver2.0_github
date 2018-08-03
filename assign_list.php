<?php 
include('config.php'); 
include('include/header.php');
	
?>

<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
<div id="filter">
<?php

?>
<br><br>

</div>
</form>
<?
echo "<table  border=1 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'><b>Id</b></th>";
echo "<th class='specalt'><b>Assignment name</b></th>"; 
echo "<th class='specalt'><b>Description</b></th>"; 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Assigned/Free</b></th>"; 
echo "<th class='specalt'><b>Download attachment</b></th>"; 

echo "<th class='specalt' colspan=2><b>Actions</b></th>"; 
echo "</tr>"; 
$systemdate = systemDate();
if($_SESSION['userType']==3)
{
	$result = ("SELECT * FROM campus_assignment WHERE assigned_to='".$_SESSION['userId']."' ");	
	$result = mysql_query($result);
}
else
{
$result = ("SELECT * FROM campus_assignment ");
$result = mysql_query($result);
}


while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";
echo "<td valign='top'>" . nl2br( $row['assign_name']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['description']). "</td>";   
echo "<td valign='top'>" . nl2br( $row['start_date']) . "</td>"; 

//FOLLOWING IS FOR indication of the assignment DUE DATE
$sub_one_from_enddate = date('Y-m-d', strtotime(nl2br( $row['end_date']). ' -1 days'));
if(nl2br( $row['end_date'])==$systemdate)
{
	echo "<td valign='top' class='myDiv'>" . nl2br( $row['end_date']) . "</td>"; 
}
if(nl2br( $row['end_date'])<$systemdate)
{
	echo "<td valign='top' class=''>" . nl2br( $row['end_date']) . "</td>"; 
}
if(nl2br( $row['end_date'])>$systemdate)
{
	echo "<td valign='top' class='myDivblue'>" . nl2br( $row['end_date']) . "</td>"; 
}

//Following is for the download link ENABLE or DISABLE, depending on enable_disable(1/0)in DB
if(($row['assigned_to']==0 || empty($row['assigned_to'])))
{
	echo "<td valign='top' style='color:green'>Free</td>";
	echo "<td valign='top'><a href='". nl2br( $row['file_path'])."'>" . DOWNLOAD . "</a></td>";
}
else
{
	echo "<td valign='top' style='color:red'>Assigned</td>";
	echo "<td valign='top'><a href='". nl2br( $row['file_path'])."'>" . DOWNLOAD . "</a></td>";
}
echo "<td valign='top'><a class=button href=assign_edit.php?id={$row['id']}>Edit</a></td>";
echo "<td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=assign_delete.php?id={$row['id']}>Delete</a></td> "; 

echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=assign_new.php class=button>New Row</a>"; 
?>
<?php include('include/footer.php');?>