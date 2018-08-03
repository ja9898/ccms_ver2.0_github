<?php
include('../config.php');
include('function-inc.php');
foreach($_GET AS $key => $value) {
    $_GET[$key] = mysql_real_escape_string($value);
}
$_classType=getClassTypeSchedule90($_GET['classType']);
$_condition=getCondition90($_GET['classType']);

$option="<select id='teacherID' name='teacherID'><option value=''>Select Teacher</option>";
$_sql="select distinct(teacherID) as teacher from capmus_teacher_course where courseID= ".$_GET['course'];
$_resultt=mysql_query($_sql);
while ($_teacherId=mysql_fetch_assoc($_resultt)) {
    $pakTime=array_keys($_LIST['time90'],$_GET['pakTime']);
    
    $_sql="select distinct(teacherID) as teacherID, breakStart, breakEnd from campus_timing where $_condition   and teacherID=".$_teacherId['teacher'];
    $_result=mysql_query($_sql);
    
    while ($_rows=mysql_fetch_assoc($_result)) {
        $available=array();
        
        foreach($_LIST['time90'] as $index=> $time ){
            if ($_rows['breakStart']>$_rows['breakEnd']) {
                if ($_rows['breakStart']> $index && $_rows['breakEnd'] < $index && $index >0  ) {
                     $available[$time]=0;
                } else if ($index >0) {
                      $_sql="select * from campus_schedule where startTime='".$time."' and status=1 and $_classType and teacherID=".$_teacherId['teacher'];
                    $_resultcount=mysql_query($_sql);
                    if (mysql_num_rows($_resultcount)<1) {
                        $available[$time]=1;
                    } else {
                        $available[$time]=0;
                    }
                }
            } else {
                if ($_rows['breakStart']<= $index && $_rows['breakEnd']> $index && $index >0  ) {
                     $_sql="select * from campus_schedule where startTime='".$time."' and status=1 and $_classType and teacherID=".$_teacherId['teacher'];
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
        //print_r($available);
        if ($available[$_LIST['time90'][$pakTime[0]]]) {
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
