<? 
include('config.php');
include('include/header.php'); 

echo "<table id='table_liquid' id='classes_cell' cellspacing='0' width='100%'>
<tr>
<th class='specalt' >Tutor</th>   

<th class='specalt'>Days</th>
<th class='specalt'>00:00</th>
<th class='specalt'>01:00</th>
<th class='specalt'>02:00</th>
<th class='specalt'>03:00</th>
<th class='specalt'>04:00</th>
<th class='specalt'>05:00</th>
<th class='specalt'>06:00</th>
<th class='specalt'>07:00</th>
<th class='specalt'>08:00</th>
<th class='specalt'>09:00</th>
<th class='specalt'>10:00</th>
<th class='specalt'>11:00</th>
<th class='specalt'>12:00</th>
<th class='specalt'>13:00</th>
<th class='specalt'>14:00</th>
<th class='specalt'>15:00</th>
<th class='specalt'>16:00</th>
<th class='specalt'>17:00</th>
<th class='specalt'>18:00</th>
<th class='specalt'>19:00</th>
<th class='specalt'>20:00</th>
<th class='specalt'>21:00</th>
<th class='specalt'>22:00</th>
<th class='specalt'>23:00</th>

</tr>";
$Classes=array('00:00','01:00','02:00','03:00','04:00','05:00','06:00','07:00','08:00','09:00','10:00','11:00','12:00','13:00','14:00','15:00','16:00','17:00','18:00','19:00','20:00','21:00','22:00','23:00');
$gettutor="Select * from `capmus_users` where user_type=3";
if(isset($_SESSION['userId']) && $_SESSION['userType']==3){
$gettutor.=" and id=".$_SESSION['userId'];
}
$gettutorresult=mysql_query($gettutor);
$counterdays=0;
$counterweekdays;
$countertime;
$weekdays=array('Sunday','Monday','Tuesday','Wednesday','Thursday','Friday','Saturday');
$classType=array();
$classType[1]=array('Monday','Tuesday','Wednesday');
$classType[2]=array('Thursday','Friday','Saturday');
while($gettutorresultrow=mysql_fetch_array($gettutorresult))
{
//echo $studentquery="SELECT campus_students.std_status,campus_students.*,time.time as ttime,days.days as daysss,users.user_full_name as tutorname FROM students,customers,users,days,time WHERE campus_students.std_status in ('1','2') and customers.customer_id=students.customer_id and students.user_id=".$gettutorresultrow['user_id']." AND students.days_id=days.days_id AND students.time_id=time.time_id group by student_id  order by tutorname";
 $studentquery="SELECT campus_schedule.id,campus_schedule.startTime,campus_schedule.startDate,campus_schedule.endDate,campus_schedule.teacherID,campus_schedule.studentID,campus_schedule.dateBooked,campus_schedule.classType,campus_schedule.`status`,capmus_users.firstName,capmus_users.middleName,capmus_users.lastName
FROM campus_schedule INNER JOIN capmus_users ON campus_schedule.teacherID = capmus_users.id  WHERE campus_schedule.teacherID=".$gettutorresultrow['id']." and capmus_users.`status` = 1 and campus_schedule.status=1 ";

$result = mysql_query($studentquery);
while($row = mysql_fetch_array($result))
  {
  $data[$counterdays]['studentid']=  $row['student'];
  $data[$counterdays]['timeid']=  $row['startTime'];
  $data[$counterdays]['studentname']=  "<div style='white-space:nowrap'>".showUser($gettutorresultrow['id'])."</div>";
  foreach($weekdays as $key => $weekday){
  
  $dayss=array();
  
  

 
 
	//$data[$counterdays][$weekday]=$weekday;
  foreach ($Classes as $classname)
  {
 
  	if($classname==$row['startTime'] )
	{
		//echo 'ahsan'.$row['days_id'];
	 if(in_array($weekday,$classType[$row['classType']])){
		
		
		if(isset($data[$counterdays][$weekday][$classname]))
			$data[$counterdays][$weekday][$classname].="<div style='white-space:nowrap'>[ ".showStudents($row['studentID'])." ]</div>";
		else
			$data[$counterdays][$weekday][$classname]="<div style='white-space:nowrap'>[ ".showStudents($row['studentID'])." ]</div>";}
	elseif(empty($data[$counterdays][$weekday][$classname]))
	{
	$data[$counterdays][$weekday][$classname]='&nbsp;';
	}
	}
	elseif(empty($data[$counterdays][$weekday][$classname])){
	$data[$counterdays][$weekday][$classname]='&nbsp;';
	}
	 
  }

  } 
 }$counterdays++;
  }
if(sizeof($data)>0)
foreach($data as $key=>$value)
{


  foreach($weekdays as $keyy => $weekday){
  
 echo "<tr id='".$weekday."'>";

echo "<td>".$value['studentname']."</td>";
  $dayss=array();
  
  echo "<td>".$weekday."</td>";

 
 
	//$data[$counterdays][$weekday]=$weekday;
  foreach ($Classes as $classname)
  {
	
	 echo "<td>".$value[$weekday][$classname]."</td>";
  }

    echo "</tr>";
  //print_r($data);
 }$counterdays++;
  }
 echo "</table>";
 
 
include('include/footer.php');
?>