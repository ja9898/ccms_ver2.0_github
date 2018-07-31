<? 
include('config.php');
include('include/header.php');  
foreach($_GET AS $key => $value) { $_GET[$key] = mysql_real_escape_string($value); } 
global $_LIST;


if (isset($_GET['id'])) { 


$_invalid=getClassStatus($_GET['id'],$_LIST['systemdate']);
if($_invalid=='2'){
$_eid=startClass($_GET['id']);
$_SESSION['class']=$_eid;
getMessages('add','daily_scheduler.php');
echo "<script>window.location.href = 'daily_scheduler.php'</script>";
}
else{
getMessages('duplicate','','Class already Started');
}
} 


if (isset($_POST['submitted'])) { 
$_id=getClassId($_GET['eid'],$_LIST['systemdate']);
$timenow = time();
$newtime = $timenow;
//FOLLOWING CODE is the FILE UPLOADER code//
$allowedext2=array("");
$allowedext=array("jpg","jpeg","doc","docx","xls","xlsx","pdf","rar","png");
$extension=end(explode(".",$_FILES["lecture_file"]["name"]));
//($_FILES["lecture_file"]["size"]<=2000000) && (in_array($extension, $allowedext)) && ($_FILES["lecture_file"]["size"]!=0) &&
	if($_POST['status']==1)
	{
		/* if($_FILES["lecture_file"]["error"]>0)
		{
			echo "Return Code:". $_FILES["lecture_file"]["error"] ."<br />";
		}
		else
		{ */
			$dir = "lecture_images_upload/teacher_lectures_".showUser( nl2br( $_SESSION['userId']));
				if(is_dir($dir) == false)
				{
					mkdir($dir);
					echo "<script>alert('Directory made')</script>";
				}		
				
			move_uploaded_file($_FILES["lecture_file"]["tmp_name"], $dir."/".$_FILES["lecture_file"]["name"]);
			//Making proper string with folder name to the file path
			$filepath=$dir."/".$_FILES["lecture_file"]["name"];
			
			
			//Making message for email *********************************************** //Start
			//echo "SELECT * FROM campus_attendance_student WHERE id='".$_id."' ";
			$student_details=mysql_fetch_array(mysql_query("SELECT * FROM campus_attendance_student WHERE id='".$_id."' "));			
				//Getting emailStudent from campus_schedule		//emailStudent start
				//echo "SELECT * FROM campus_schedule WHERE id='".$student_details['schedule_id']."' ";
				$emailStudent_check_from_sch=mysql_fetch_array(mysql_query("SELECT * FROM campus_schedule WHERE id='".$student_details['schedule_id']."' "));
				$emailStudent = $emailStudent_check_from_sch['emailStudent'];
				$systemdate = systemDate();	//Getting systemdate
				$emailClassDays = getData(nl2br( $emailStudent_check_from_sch['classType']),'plan'); //Getting CLASS DAYS
				$student_name = showStudents(nl2br( $student_details['studentID']));
				$teacher_name = showUser(nl2br( $student_details['teacherID']));			
				//YCC REF NO
				$ycc_refno = '<br><br>YourCloudCampus Ref No:'.$student_details['studentID'].'-'.date('mdYAGis').'-'.$student_details['teacherID'];
				///////////////////////////////////////////		//emailStudent end
			//Format of the TABLE sent within the EMAIL TO STUDENT
			$email_msg="<div align='center' style='color:Orange; font-size:20px; font-weight:bold'>Email From YOURCLOUDCAMPUS</div>
			<table border='1'  cellspacing=2px > 
			<tr align='center'>
			<td colspan='2' style='color:Orange; background-color:purple; font-size:16px;'><b>Student Daily Class Report</b></td>
			</tr>
			
			<tr bgcolor=#CD96CD>
			<td><b>Date</b></td>
			<td valign='top'> ".$systemdate."</td>
			</tr>
			
			<tr bgcolor=#EED2EE>
			<td><b>Attendance</b></td>
			<td valign='top'> ".getData(nl2br( $_POST['status']),'class_status')."</td>
			</tr>
			
			<tr bgcolor=#CD96CD>
			<td><b>Scheduled Days</b></td>
			<td valign='top'> ".$emailClassDays."</td>
			</tr>
			
			<tr bgcolor=#EED2EE>
			<td><b>Student Name</b></td>
			<td valign='top'> ".$student_name."</td>
			</tr>
			
			<tr bgcolor=#CD96CD>
			<td><b>Teacher Name</b></td>
			<td valign='top'> ".$teacher_name."</td>
			</tr>";
			
			if($_POST['lessonDetails']){			
			$email_msg.="<tr bgcolor=#EED2EE>
			<td><b>Lesson Studied Today</b></td>
			<td valign='top'> ".$_POST['lessonDetails']."</td>
			</tr>
			
			</table>";
			}//end if
			
			$email_msg.="<br><br>
			URL: www.yourcloudcampus.com<br>
			E-mail: Info@yourcloudcampus.com<br>
			Skype: yourcloudcampus<br>
			AUS  : 280-911-200<br>
			U.S.A: 215-764-6162<br>
			U.K  : 121-288-3093<br>";
			
			
			//Quran part, Surah/kalima/lessons etc		//NEWLY ADDED 28-11-16	//START
			if($_POST['dua']){
				$duadetail=mysql_fetch_array(mysql_query("select * from campus_dua where id='".$_POST['dua']."'"));
				$email_msg.="<br/>  And Learn Dua:  <b>(".$duadetail['dua'].")</b><br/>";
			}//end if 
			if($_POST['kalima']){
				$email_msg.="  And recited kalima: <b>".$_POST['kalima']."</b><br/>";
				
			}//end if 
			if($_POST['prayer']){
				$prayerdetail=mysql_fetch_array(mysql_query("select * from campus_prayer where id='".$_POST['prayer']."'"));
				$email_msg.="  And Learn Prayer:  <b>".$prayerdetail['name']."</b>(".$prayerdetail['description'].")<br/>";
			}//end if
			if($_POST['lesson']){
				$lessondetail=mysql_fetch_array(mysql_query("select * from campus_syllabus where id='".$_POST['lesson']."'"));
				$email_msg.="  And Learn Lesson:  <b>".$lessondetail['lessonName']."</b>(".$lessondetail['arabicName'].")<br/>";
			}//end if
			if($_POST['surah']){
				$surahdetail=mysql_fetch_array(mysql_query("select * from campus_surah where id='".$_POST['surah']."'"));
				$email_msg.="  And Learn Surah:  <b>(".$surahdetail['level'].")</b><br/>";
			}//end if
			if($_POST['verseFrom']){
				$email_msg.="  FROM VERSE:  <b>(".$_POST['verseFrom'].")</b><br/>";
			}//end if
			if($_POST['verseTo']){
				$email_msg.="  TO VERSE:  <b>(".$_POST['verseTo'].")</b><br/>";
			}//end if
			//Quran part, Surah/kalima/lessons etc		//NEWLY ADDED 28-11-16	//END
			
			if($_POST['record_link']){
				$email_msg.="  <b>Recording Link:</b>  <b><a href='".$_POST['record_link']."' target=_blank>".$_POST['record_link']."</a></b><br/>";
			}//end if		//NEWLY ADDED 06-02-18	//END
			
			
			//Getting student email using studentID
			$student_email = mysql_fetch_array(mysql_query("SELECT * FROM campus_students WHERE id = '".$student_details['studentID']."'"));
			$student_email['email'];
			///////////////////////////////////////
			$email_msg.=$ycc_refno."---";
			$email_msg.=$student_email['email'];
?>
<input rows="10" cols="90" id='email_format_to_send_StudentParent_ycc' name='email_format_to_send_StudentParent_ycc' readonly="readonly" type='hidden' value="<?php echo $email_msg; ?>"/>
<input id='student_email' name='student_email' readonly="readonly" type='hidden' value="<?php echo $student_email['email']; ?>"/>
<?
if($emailStudent==1)
{
	echo '<script> send_email_to_StudentParent_ycc(); </script>';
}

			//Making message for email *********************************************** //End
			
			$sql = "update  `campus_attendance_student` set  `status` ='{$_POST['status']}' , 
			`endTime`= '".date('H:i:s' , $newtime)."' , 
			`comments`= '{$_POST['comments']}'  , 
			`grade`='{$_POST['grade']}' ,  
			`lessonDetails`='{$_POST['lessonDetails']}' , 
			`lecture_image_filepath` =  '$filepath' , 
			`lecture_image_date` =  '".date('Y-m-d')."' ,
			`dua` =  '".$_POST['dua']."' ,
			`prayer` =  '".$_POST['prayer']."' ,
			`kalima` =  '".$_POST['kalima']."' ,
			`extra_comments` =  '".$_POST['extra_comments']."' ,
			`lesson` =  '".$_POST['lesson']."' ,
			`surah` =  '".$_POST['surah']."' ,
			`verseFrom` =  '".$_POST['verseFrom']."' ,
			`verseTo` =  '".$_POST['verseTo']."' , 
			`record_link` =  '".$_POST['record_link']."' 
			where id='$_id'"; 
			mysql_query($sql) or die(mysql_error()); 

		//echo $_POST['grade'].",".$_POST['lessonDetails'];
		//echo "Grade:".$_POST['grade'].",".$_POST['lessonDetails'];
		getMessages('add'); 
		/* } */
	}

	else if($_FILES["lecture_file"]["name"]=="" && $_FILES["lecture_file"]["tmp_name"]=="" && $_POST['status']==0)
	{
		$filepath="";
		$sql = "update  `campus_attendance_student` set  `status` ='{$_POST['status']}' , 
		`endTime`= '".date('H:i:s' , $newtime)."' , 
		`comments`= '{$_POST['comments']}'  , 
		`grade`='{$_POST['grade']}' ,  
		`lessonDetails`='{$_POST['lessonDetails']}' , 
		`lecture_image_filepath` =  '$filepath' , 
		`lecture_image_date` =  '".date('Y-m-d')."' , 
		`dua` =  '".$_POST['dua']."' ,
		`prayer` =  '".$_POST['prayer']."' ,
		`kalima` =  '".$_POST['kalima']."' ,
		`extra_comments` =  '".$_POST['extra_comments']."' ,
		`lesson` =  '".$_POST['lesson']."' ,
		`surah` =  '".$_POST['surah']."' ,
		`verseFrom` =  '".$_POST['verseFrom']."' ,
		`verseTo` =  '".$_POST['verseTo']."' , 
		`record_link` =  '".$_POST['record_link']."' 
		where id='$_id'"; 
		mysql_query($sql) or die(mysql_error());
		getMessages('add');
		echo "<b>NO IMAGE RESTRICTION</b>";
	}
	
	else
	{
		echo "<script>alert('Invalid File Selection OR File is bigger than 2 MB, Data cannot be inserted')</script>";
		getMessages('error');
	}

//header("Location: index.php");

//sleep(1.2);
//header("Location: daily_scheduler.php");

} 

if (isset($_GET['eid']) && !isset($_POST['submitted'])) { ?>



<form name='form_attandance' action='' method='POST' enctype="multipart/form-data"> 
<br/><br/>
<div align='center'><h1 style="font-size:20px; color:skyblue; font-weight:bold;">Science Teachers, Please fill till COMMENTS</h1></div>
<div id="label">Status:</div><div id="field"><input type='radio' name='status' value="0"/> Absent <input type='radio' name='status' value="1"/> Present
<!--<input type='radio' name='status' value="5"/>Make Over--></div>
<div id="label">Grade:</div><div id="field"><input name='grade' id='grade' type='number' placeholder="Enter digit"/> </div>

<div id="label">Upload image(jpg/png ONLY 2MB):</div><div id="field"><input name="lecture_file" type="file"/></div>

<div id="label">LessonDetails:</div><div id="field"><textarea name='lessonDetails' id='lessonDetails'  placeholder="" ></textarea> </div>
<div id="label">Comments:</div><div id="field"><textarea name='comments' id='comments' ></textarea> </div>
<!--****Commenting following as was using for comments restriction, so removed the class to submit
without restrictions**** IMPORTANT COMMENTS TO READ-->
<!--<div id="label">LessonDetails:</div><div id="field"><textarea name='lessonDetails' id='lessonDetails' class="lessonDetails_sa" placeholder="Mandatory field/Min 20 characters" ></textarea> </div>
<div id="label">Comments:</div><div id="field"><textarea name='comments' id='comments' class="comments_sa"></textarea> </div>
<<<<<<<<<<<<<<<<<< FORM SUBMISSION FUNCTION>>>>>>>>>>>>>>>>>>>>>>
onsubmit="return checkLength_student_attendance(this);"
-->

<br/><br/>
<div align='center'><h1 style="font-size:20px; color:violet; font-weight:bold;">Quran Teachers, Please fill following details</h1></div>
<div id="label">Comments for Management:</div><div id="field"><textarea rows="4" cols="25" name='extra_comments' id='extra_comments' ></textarea> </div>
<br><br><br>

                            <div id="label">Select Dua:</div>
                            <div id="field"><select name="dua" id="dua" class="select-box">
                            <option value="" selected="selected">Select Dua</option>
                                <?php 
                                $dua			=		"select * from campus_dua ORDER BY id ASC";
                                $query_dua		=		mysql_query($dua);
                                $i=0;
                                while($row_dua=mysql_fetch_array($query_dua)) {
                                $i++;
                                ?>
                                
                                <option value="<?php echo $row_dua['id']; ?>"><?php echo $i.') '.$row_dua['dua']; ?></option>
                                <?php } ?>
                                </select>
                            </div>
                            <div id="label">Select Prayers:</div>
                            <div id="field"><select name="prayer" id="prayer" class="select-box">
                              <option value="" selected="selected">Select Prayer</option>
                              <?php 
                             $prayer	=	"select * from campus_prayer";
                             $query_prayer	=	mysql_query($prayer);
                             while($row_prayer	=	mysql_fetch_array($query_prayer)) { ?>
                              <option value="<?php echo $row_prayer['id']; ?>"><?php echo $row_prayer['name']; ?></option>
                              <?php  } ?>
                            </select>
							</div>
						  
							<div id="label">Select Kalima:</div>
                            <div id="field"><select name="kalima" id="kalima" class="select-box">
                            <option value="" selected="selected">Select Kalima </option>
                                <option value="Kalima 1">Kalima 1</option>
                                <option value="Kalima 2">Kalima 2</option>
                                <option value="Kalima 3">Kalima 3</option>
                                <option value="Kalima 4">Kalima 4</option>
                                <option value="Kalima 5">Kalima 5</option>
                                <option value="Kalima 6">Kalima 6</option>
                                </select>
                            </div>
						  
						  
							<div id="label">Comments</div>
                            <div id="field">
                              <select name="extra_comments" id="extra_comments" class="select-box">
                                <option value="" selected="selected">Select Comments:</option>
                                <option value="Class has already taken">Class has already taken</option>
                                <option value="Student was late today">Student was late today</option>
                                <option value="Tafseer class ">Tafseer class</option>
                                <option value="Translation class">Translation class</option>
                                <option value="Tajweed class">Tajweed class</option>
                                <option value="Class has taken by his/her brother/sister/mother instead of him/her">Class has taken by his/her brother/sister/mother instead of him/her</option>
                                <option value="because of urgent work just took a short class">because of urgent work just took a short class</option>
                                <option value="Head phone is not working properly">Head phone is not working properly</option>
                                
                                <option value="Voice quality is not good">Voice quality is not good</option>
                                <option value="He has week internet connection">He has week internet connection</option>
                                <option value="Read an Islamic chapter">Read an Islamic chapter</option>
                                <option value="Hifz/memorization class">Hifz/memorization class</option>
                                <option value="Revised only Duas/Kalimas/Namaz">Revised only Duas/Kalimas/Namaz</option>
                                <option value="Class was taken by phone/eyebeam">Class was taken by phone/eyebeam</option>           
                                <option value="Went offline during the class">Went offline during the class</option>
                                <option value="Read yesterday's lesson again">Read yesterday's lesson again</option>
                                <option value="Student don't take class on this day due to their personal commitments">Student don't take class on this day due to their personal commitments</option>
                                
                            </select>
                            </div>
							
							
                            <div id="label">Select lesson Recited Today:</div>
							<div id="field">
                                 <select name="lesson" id="lesson" class="select-box" >
                                  <option value="" selected="selected">Select Lesson recited Today</option>
                                  <?php 
                              $sql = "select * from campus_syllabus";
                                $rs = mysql_query($sql) or die(mysql_error());
                                while($rsys		=	mysql_fetch_array($rs)) { 
                                ?>
                                  <option value="<?php echo $rsys['id']; ?>"><?php echo $rsys['lessonName']; ?></option>
                                  <?php } ?>
                                </select>
							</div>
							
							
							<div id="label">Select Surah of Quran:</div>
							<div id="field">
                              <select name="surah" id="surah" class="select-box" onChange="showLevelDetail(this.value)">
                                <option value="" selected="selected">Select Surah</option>
                                <?php $sql2 = "select * from campus_surah order by id";
                                $rs2 = mysql_query($sql2) or die(mysql_error());
                                while($level	=	mysql_fetch_array($rs2)) { ?>
                                <option value="<?php echo $level['id']; ?>"><?php echo $level['level']; ?></option>
                                <?php } ?>
                            </select>
							</div>
							
							<div id="label">VerseFrom:</div>
							<div id="field"><?php echo getList('','verseFrom','verse');?>
							</div> 
							
							<div id="label">VerseTo:</div>
							<div id="field"><?php echo getList('','verseTo','verse');?>
							</div> 
							
							<div id="label">Recording Link:</div>
							<div id="field"><input name='record_link' id='record_link' required/>
							</div> 
							

<div id="label"></div><div id="field"><input type='submit' class="button" value='End Class' /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<?php } 

include('include/footer.php'); ?>