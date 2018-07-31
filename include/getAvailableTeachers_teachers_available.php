<?php
include('../config.php');
include('function-inc.php');
foreach($_GET AS $key => $value) {
    $_GET[$key] = mysql_real_escape_string($value);
}
echo $_classType=getClassTypeSchedule($_GET['classType']);
echo $_condition=getCondition($_GET['classType']);


$option="<select id='teacherID' name='teacherID'><option value=''>Select Teacher</option>";
$_sql="select distinct(teacherID) as teacher from capmus_teacher_course ";//Class type removed here as it is used in book_scheduler_new.php
$_resultt=mysql_query($_sql);
while ($_teacherId=mysql_fetch_assoc($_resultt)) {
    $pakTime=array_keys($_LIST['time'],$_GET['pakTime']);
    echo "<pre>";
    $_sql="select distinct(teacherID) as teacherID, startTime, endTime from campus_timing where teacherID=".$_teacherId['teacher'];
    $_result=mysql_query($_sql);
    
    while ($_rows=mysql_fetch_assoc($_result)) {
        $available=array();
        
        foreach($_LIST['time'] as $index=> $time ){
            if ($_rows['startTime']>$_rows['endTime']) {
                if ($_rows['startTime']> $index && $_rows['endTime']< $index && $index >0  ) {
                    $available[$time]=0;
                } else if ($index >0) {
					
					if($time=='22:30' || $time=='23:00' || $time=='23:30')
                    {
					 $_sql="select * from campus_schedule where std_status!=3 and (startTime<='".$time."' and ( endTime>'".$time."' or endTime='00:00')) and   $_classType and teacherID=".$_teacherId['teacher'];}
                    else{
                      $_sql="select * from campus_schedule where std_status!=3 and (startTime<='".$time."' and endTime>'".$time."') and   $_classType and teacherID=".$_teacherId['teacher'];
					}
					
					$_resultcount=mysql_query($_sql);
                    if (mysql_num_rows($_resultcount)<1) {
                        $available[$time]=1;
                    } else {
                        $available[$time]=0;
                    }
					
					
                }
            } else {
                if ($_rows['startTime']<= $index && $_rows['endTime']> $index && $index >0  ) {
                    $_sql="select * from campus_schedule where std_status!=3 and  (startTime<='".$time."' and endTime>'".$time."')  and  $_classType and teacherID=".$_teacherId['teacher'];
                    $_resultcount=mysql_query($_sql);
                    if (mysql_num_rows($_resultcount)<1) {
                        $available[$time]=1;
                    } else {
                        $available[$time]=0;
                    }
                } else if ($index >0) {
                    $available[$time]=0;
                }
                
            }
        }
		//if($_rows['teacherID']=='76')
		//print_r($available);
        if ($available[$_LIST['time'][$pakTime[0]]]) {
            $_sql="select * from capmus_users where id=".$_rows['teacherID']." and status=1";
            $_res=mysql_query($_sql);
            if (mysql_num_rows($_res)>0) {
                $_row=mysql_fetch_assoc($_res);
                $option.="<option value='".$_row['id']."'>".$_row['firstName']." ".$_row['lastName']."</option>";
            }
        }
    }
}
echo $option.="</select>";
?>
