<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted'])) { 
//foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 


foreach($_POST['courseID'] as $course){
$_inValid=checkDuplication($course,$_POST['teacherID']);
echo $course;
//echo $_inValid."-";
$_COURSE_ARRAY[$course] = getData( nl2br( $course),'course');
if(!$_inValid){
$sql = "INSERT INTO `capmus_teacher_course` ( `courseID` ,  `teacherID`) VALUES(  '{$course}' ,  '{$_POST['teacherID']}'   ) "; 
mysql_query($sql) or die(mysql_error()); 


//getMessages('add');
}
/*else
{
getMessages('duplicate');
}*/ 
}
/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$teacher_course_list=implode(",",$_COURSE_ARRAY);
$add_teacher_course="Teacher:".showUser( nl2br( $_POST['teacherID'])).",Course:".$teacher_course_list;
				user_log( $_SERVER['PHP_SELF'] , "ADD_TEACHER_COURSE" , $_SESSION['userId'] ,$add_teacher_course);
///////////////////////////////////////////////////////
getMessages('add');} 
?>

<form action='' method='POST'> 
<div id="label">Teacher:</div><div id="field"><?php echo getDataList('','teacherID',3);?> </div>
<div id="label">Course:</div><div id="field"><?php echo getCheckboxList('','courseID[]','course');?></div>  
 
<div id="label"></div><div id="field"><input type='submit' value='Add Row' /><input type='hidden' value='1' name='submitted'/> </div> 
</form> 
<? include('include/footer.php'); ?>