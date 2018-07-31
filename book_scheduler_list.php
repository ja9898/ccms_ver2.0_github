<? 
include('config.php');
include('include/header.php'); 
/*<table id='table_liquid' id='classes_cell' cellspacing='0' width='100%'>*/
?>



<form action='<?php echo $_SERVER['PHP_SELF']?>' method='post'>
<select name='days[]' multiple='multiple' size='5' >
<option>Select Days</option>
<option <?php if(isset($_POST['days']) && in_array("Monday",$_POST['days'])){ echo "selected='selected'";}?>>Monday</option>
<option <?php if(isset($_POST['days']) && in_array("Tuesday",$_POST['days'])){ echo "selected='selected'";}?>>Tuesday</option>
<option <?php if(isset($_POST['days']) && in_array("Wednesday",$_POST['days'])){ echo "selected='selected'";}?>>Wednesday</option>
<option <?php if(isset($_POST['days']) && in_array("Thursday",$_POST['days'])){ echo "selected='selected'";}?>>Thursday</option>
<option <?php if(isset($_POST['days']) && in_array("Friday",$_POST['days'])){ echo "selected='selected'";}?>>Friday</option>
<option <?php if(isset($_POST['days']) && in_array("Saturday",$_POST['days'])){ echo "selected='selected'";}?>>Saturday</option>
<option <?php if(isset($_POST['days']) && in_array("Sunday",$_POST['days'])){ echo "selected='selected'";}?>>Sunday</option>
</select><br /><input type="submit" class="button" value="Add Row"></form><br /><br /><br />



<?php
$pageData= "<div id=\"tableDiv_General\" class=\"tableDiv\">

        <table id=\"Open_Text_General\" class=\"FixedTables\">
<thead><tr>
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

</tr></thead><tbody>";
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
			$data[$counterdays][$weekday][$classname].="<div >[ ".showStudents($row['studentID'])." ]</div>";
		else
			$data[$counterdays][$weekday][$classname]="<div >[ ".showStudents($row['studentID'])." ]</div>";}
	elseif(empty($data[$counterdays][$weekday][$classname]))
	{
	$data[$counterdays][$weekday][$classname]='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	}
	elseif(empty($data[$counterdays][$weekday][$classname])){
	$data[$counterdays][$weekday][$classname]='&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
	}
	 
  }

  } 
 }$counterdays++;
  }
if(sizeof($data)>0)
foreach($data as $key=>$value)
{


  foreach($weekdays as $keyy => $weekday){
  if(isset($_POST['days']) && in_array($weekday,$_POST['days'])){
 $pageData.= "<tr id='".$weekday."'>";

$pageData.= "<td>".$value['studentname']."</td>";
  $dayss=array();
  
  $pageData.= "<td>".$weekday."</td>";

 
 
	//$data[$counterdays][$weekday]=$weekday;
  foreach ($Classes as $classname)
  {
	
	 $pageData.= "<td>".$value[$weekday][$classname]."</td>";
  }

    $pageData.= "</tr>";
	}
  //print_r($data);
 }$counterdays++;
  }
 $pageData.= "</tbody></table>";
 
 ?>

<div id=""><?php //echo $pageData; ?></div>
<div ><?php //echo $pageData; ?></div>
<div ><?php //echo $pageData; ?></div>
 <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.3.1/jquery.min.js"></script>
 <script type="text/javascript" src="js/sh_main.min.js"></script>
    <script type="text/javascript" src="js/sh_javascript.js"></script>
<script type="text/javascript" src="js/jquery.fixedtable.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            sh_highlightDocument();

            $(".tableDiv").each(function() {
                var Id = $(this).get(0).id;
                var maintbheight = 455;
                var maintbwidth = 700;

                $("#" + Id + " .FixedTables").fixedTable({
                    width: maintbwidth,
                    height: maintbheight,
                    fixedColumns: 2,
                    classHeader: "fixedHead",
                    classFooter: "fixedFoot",
                    classColumn: "fixedColumn",
                    fixedColumnWidth: 200,
					
                    outerId: Id,
                   
                    fixedColumnbackcolor:"#ECEFF5",
                    fixedColumnhovercolor:"#ECEFF5"
                });
            });
        });
    </script>

    <style type="text/css">
        
        p
        {
            float:left;
            width: 100%;
            margin: 20px 0px;
        }
        .fixedColumn .fixedTable td
        {
           /* color: #FFFFFF;
            background-color: #187BAF;*/
			 background: url("../images/scheme1/bullet1.gif") no-repeat scroll 0 0 #ECEFF5;
             color: #797268;
            font-size: 12px;
            font-weight: normal;
        }
        
        .fixedHead td, .fixedFoot td
        {
          /*  color: #FFFFFF;
            background-color: #187BAF;*/
			 background: url("../images/scheme1/bullet1.gif") no-repeat scroll 0 0 #ECEFF5;
    color: #797268;
            font-size: 12px;
            font-weight: normal;
            padding: 5px;
           /* border: 1px solid #187BAF;*/
        }
        .fixedTable td
        {
            font-size: 8.5pt;
            background-color: #FFFFFF;
            padding: 5px;
            text-align: left;
            /*border: 1px solid #ECEFF5;*/
        }
		.fixedHead table{
			border-bottom:1px solid #fff;
		}
    </style>
    <link href="css/sh_style.css" rel="Stylesheet" type="text/css" />

</head>


 <?php
 echo $pageData."</div>";
include('include/footer.php');
?>