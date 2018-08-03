<? 
include('config.php');
include('include/header.php'); 

?>
<div id="filter">
<form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">


<br>
<!--FOR FILTERING STUDENT STATUS ONLY-->
<!--<div id="field"><?php //echo getList('','stdStatus','stdStatusmo-list');?> 
<input name="sender" class="button" id="sender" type="submit" value="Filter Student status only" /></div>-->
</form>
</div>
<?
echo "<table  border=0 id='table_liquid' cellspacing=0 >"; 
echo "<tr>"; 

echo "<th class='specalt'><b>ID</b></th>"; 
 
 
echo "<th class='specalt'><b>Start Date</b></th>"; 
echo "<th class='specalt'><b>End Date</b></th>"; 
echo "<th class='specalt'><b>Student</b></th>"; 


echo "<th class='specalt' colspan=4><b>Actions</b></th>";  
echo "</tr>"; 

//$result="SELECT campus_schedule.startTime,campus_schedule.endTime,campus_schedule.id as sch_id,campus_schedule.studentID,campus_schedule.std_status,campus_schedule.courseID,campus_schedule.teacherID,campus_schedule.classType,
//		campus_students.id,campus_students.countryID 
//		FROM campus_schedule 
//		INNER JOIN campus_students 
//		ON campus_schedule.studentID=campus_students.id and campus_schedule.status=1 and (campus_schedule.std_status=1 OR campus_schedule.std_status=2) ORDER BY  campus_students.countryID asc";

//	$rowcount = mysql_num_rows($result);
//	$result=mysql_query($result);
	
//while($row = mysql_fetch_array($result)){ 

/*$query="select `campus_students`.id,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.id=".$row['studentID'];
$results=mysql_query($query);
$rows=mysql_fetch_array($results);*/


//$query2="select `campus_students`.id,`campus_students`.email,`campus_students`.mobile,`campus_students`.phone,`campus_students`.landline,`campus_students`.countryID from `campus_students` where campus_students.countryID=2 and campus_students.id=".$row['studentID'];
//$results2=mysql_query($query2);
//$rows2=mysql_fetch_array($results2);

$sch_id=array('2047','5151','6994','7216','7302','7994','7995','8055','8056','8291','8492','8958','9232','9456','9667','12628','10045','10237','10325','10578','10780','10781','11542','11581','11702','11759','11946','12252','12302','12407','12509','12561','12629','12636','12741','12746','12752','12753','12754','12756','12773','12817','13003','13289','13197','13241','13242','13248','13251','13252','13255','13256','13301','13401','13402','13409','13410','13443','13444','13657','13666','13672','13686','13697','13833','13841','13842','13850','13851','13852','13853','13854','13855','13856','13857');
//30 to 28th '2047','5151','6994','7216','7302','7994','7995','8055','8056','8291','8492','8958','9232','9456','9667','12628','10045','10237','10325','10578','10780','10781','11542','11581','11702','11759','11946','12252','12302','12407','12509','12561','12629','12636','12741','12746','12752','12753','12754','12756','12773','12817','13003','13289','13197','13241','13242','13248','13251','13252','13255','13256','13301','13401','13402','13409','13410','13443','13444','13657','13666','13672','13686','13697','13833','13841','13842','13850','13851','13852','13853','13854','13855','13856','13857'
//29 to 27th '1073','7318','7340','8239','9368','9504','9674','9887','10414','10809','10810','10816','10947','10980','10981','10991','10992','10993','11819','11590','11612','11762','11811','11821','11984','12119','12121','12138','12229','12230','12231','12285','12455','12457','13066','13222','13223','13224','13235','13236','13237','13238','13239','13489','13636','13685','13797','13800','13801','13810','13812','13813','13814','13815','13875'
foreach($sch_id as $schid){
//Commenting following so that no one should accidently make an hour BACK or FORWARD  
//CHANGE STARTTIME or ENDTIME to make the required TIME FIELD to change 1 hour back(or according to the requirement)
echo $update_paydate="UPDATE campus_schedule 
SET paydate = DATE_SUB(paydate,INTERVAL 2 DAY) 
WHERE id=".$schid." ";
echo "<br>";
$out=mysql_query($update_paydate);
//day(campus_schedule.paydate) = 27
//DATE_SUB(OrderDate,INTERVAL 5 DAY)
//date_starts = DATE_ADD(date_starts,INTERVAL 14 DAY)
}


//foreach($row AS $key => $value) { $row[$key] = stripslashes($value); } 
echo "<tr>";  
 
//echo "<td valign='top'>" . nl2br( $row['sch_id']) . "</td>";  


//echo "<td valign='top'>" . nl2br( $row['startDate']) . "</td>";  
//echo "<td valign='top'>" . nl2br( $row['endDate']) . "</td>";  
//echo "<td valign='top'>" . showStudents(nl2br( $row['studentID'])) . "</td>"; 
  




/*if($row['statussch']=='1'){

echo "
<td><a  class=button href=make_regular.php?id={$row['studentID']}&schedule={$row['id']}>Make Regular</a></td> ";} */
echo "</tr>"; 
echo "</table>"; 
echo "<a href=# class=button>New Row</a>"; 
include('include/footer.php');
?>