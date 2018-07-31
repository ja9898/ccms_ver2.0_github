<? 
include('config.php'); 
include('include/header.php');?>

<form action='' method='POST'>
<?
	// Code to add 10 extension IDs onclick of a BUTTON 		START <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<
	$systemdatetime = systemDateTime();
	$systemdate = systemDate();
	if (isset($_POST['extid_submitted'])) 
	{
		//Get last row of EXTID from db
		$sql_get_last_extid="SELECT    *
		FROM      campus_voice_ext 
		ORDER BY  id DESC
		LIMIT     1;";
		$row_get_last_extid = mysql_fetch_array(mysql_query($sql_get_last_extid));
		$row_get_last_extid['extId'];
		
		//Adding 1 and 10 in the last ext ID
		$start_range = $row_get_last_extid['extId'] + 1;
		$end_range = $row_get_last_extid['extId'] + 10;
		
		//Checking duplication
		$sql_check_extId= mysql_query("SELECT extId FROM campus_voice_ext WHERE extId >= '".$start_range."' AND extId <= '".$end_range."' ");
		if (mysql_num_rows($sql_check_extId)>=1)
		{
			getMessages('duplicate','','Ext ID Duplication');
		}
		else
		{
			$count_range = $end_range - $start_range;
			if($count_range==0)
			{
				for($i=0 ; $i<=$count_range ; $i++)
				{
					//echo "inside for loop";
					$sql = "INSERT INTO `campus_voice_ext` ( `extId` ,  `date` ,  `userId` , `status`  ) VALUES(  '$start_range' ,  '".date('y-m-d')."' ,  '".$_SESSION['userId']."' ,  '2'  ) "; 
					mysql_query($sql) or die(mysql_error());
				}
				getMessages('add'); 
			}
			else
			{
				for($i=0 ; $i<=$count_range ; $i++)
				{
					//echo "inside for loop 222";
					$var_extId_from = $start_range + $i;
					$sql = "INSERT INTO `campus_voice_ext` ( `extId` ,  `date` ,  `userId` , `status`  ) VALUES(  '".$var_extId_from."' ,  '".date('y-m-d')."' ,  '".$_SESSION['userId']."' ,  '2'  ) "; 
					mysql_query($sql) or die(mysql_error()); 
				}
				getMessages('add');
			}
		} 

	}
	// Code to add 10 extension IDs onclick of a BUTTON 		END <<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<<

?>
<div id="label"></div><div id="field"><input type='submit' value='ADD 10 Extension IDs' class="button" /><input type='hidden' value='1' name='extid_submitted'/> </div> 
<div id="label"></div>
</form> 

<?
echo "<table border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 
echo "<th class='specalt'>Id</th>"; 
echo "<th class='specalt'>Ext Id</th>"; 
echo "<th class='specalt'>Date</th>";
echo "<th class='specalt'>User Name</th>"; 
echo "<th class='specalt'>Status</th>";
echo "<th class='specalt'>StudentId</th>"; 
echo "<th class='specalt'>Action</th>";
echo "</tr>"; 
//$result = mysql_query("SELECT campus_students.id AS studentID, campus_skype.id, campus_skype.skype, campus_skype.password, campus_skype.status
 //FROM campus_skype left JOIN campus_students ON campus_skype.id = campus_students.skypeid ") or trigger_error(mysql_error()); 
 /*
 $result = getResultResource($_table='campus_skype',$_post='',$_where='',$join='',$joinFields='',$joinWhere='',
 $joinselect="left JOIN campus_students ON campus_skype.id = campus_students.skypeid",$orderby="",
 $_fields="campus_students.id AS studentID, campus_skype.id, campus_skype.skype, campus_skype.password, campus_skype.status, campus_students.countryID");
 */
 //$result = getResultResource($_table='campus_skype',$_post='',$_where='',$join='',$joinFields='',$joinWhere='',
 //$joinselect="left JOIN campus_schedule ON campus_skype.id = campus_schedule.skypeid",$orderby="",
 //$_fields="campus_schedule.studentID AS studentID, campus_skype.id, campus_skype.skype, campus_skype.password, campus_skype.status");
 $sql = "SELECT campus_students.id AS studentID, campus_voice_ext.id, campus_voice_ext.extId, campus_voice_ext.userId, campus_voice_ext.status , campus_voice_ext.date, campus_students.countryID 
 FROM campus_voice_ext LEFT JOIN campus_students ON campus_voice_ext.id = campus_students.extId";
 $result = mysql_query($sql);
 
while($row = mysql_fetch_array($result)){ 
foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
echo "<td valign='top'>" . nl2br( $row['id']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['extId']) . "</td>";  
echo "<td valign='top'>" . nl2br( $row['date']) . "</td>";
echo "<td valign='top'>" . showUser( $row['userId']) . "</td>";  
echo "<td valign='top'>" .  getData(nl2br( $row['status']),'ext_status') . "</td>"; 
echo "<td valign='top'>" ;  if(!empty($row['studentID'])) { echo showStudents(nl2br( $row['studentID']));} echo "</td>"; 
echo "<td valign='top'><a class=button href=ext_edit.php?id={$row['id']}>Edit</a>&nbsp;&nbsp;&nbsp;<a onclick=\"return confirm('Are you sure you want to delete this Record?')\" class=button href=ext_delete.php?id={$row['id']}>Delete</a></td> "; 
echo "</tr>"; 
} 
echo "</table>"; 
echo "<a class=button href=ext_new.php>New Row</a>"; 
include('include/footer.php');?>