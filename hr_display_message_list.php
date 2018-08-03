<? 
include('config.php');
include('include/header.php');

echo "<table border=0 id='' cellspacing=0 >"; 
echo "<tr>";
echo "<th class='specalt' colspan=2><b>Actions</b></th>";  
echo "<th class='specalt'><b>Id</b></th>"; 
echo "<th class='specalt'><b>Heading</b></th>";  
echo "<th class='specalt'><b>Message</b></th>";
echo "<th class='specalt'><b>Active/Deactive</b></th>";
echo "</tr>";
$result = mysql_query("SELECT * FROM `campus_hr_messages` ") or trigger_error(mysql_error()); 
while($row = mysql_fetch_array($result)){ 
foreach($row as $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'><a href=hr_display_message_edit.php?id={$row['id']} class='button'>Edit</a></td><td><a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class='button' href=hr_display_message_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "<td valign=''>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['heading']) . "</td>";     
echo "<td valign='top'>" . nl2br( $row['message']) . "</td>";
echo "<td valign='top'>" . getData(nl2br( $row['active_deactive']),'status') . "</td>";
if($row['active_deactive']==1)
{
	$h1 = nl2br( $row['heading']);
	$m1 = nl2br( $row['message']);
	$m1 = stripslashes($m1);
	$m1 = str_replace("rn","<br>",$m1);
}
else
{
	$h2 = "No Updates";
	$m2 = "";
}
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a href=hr_display_message_new.php class='button'>New Row</a>"; 
?>
<div id="marqueecontainer" onMouseover="copyspeed=pausespeed" onMouseout="copyspeed=marqueespeed">
<div id="vmarquee" style="position: absolute; width: 98%;">
	<!--YOUR SCROLL CONTENT HERE-->
	<?
	if($h1!="" && $m1!="")
	{
		echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
		echo "<hr>";
		echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h1 . "</span>";
		echo "<p>" . $m1 . "</p>";
	}
	else
	{
		if($h1=="" && $m1=="")
		{
		echo "<span style='font-size:small; color:black; font-weight:bold;'>Notice as of " . date('d-m-Y') . "</span><br>";
		echo "<hr>";
		echo "<span style='font-size:small; color:#0BB5FF; font-weight:bold; text-decoration:underline'>" . $h2 . "</span>";
		echo "<p>" . $m2 . "</p>";
		}
	}
	?>
	<!--YOUR SCROLL CONTENT HERE-->
</div>
</div>

<?
include('include/footer.php');
?>