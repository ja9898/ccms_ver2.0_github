<? 
include('config.php'); 
include('include/header.php');
if(isset($_POST["upload_file_button"]))
{
$id_assessment=$_POST["id_assessment"];
$assessment_file_name = $_FILES["assessment_file_new"]["name"];

/////////////// ASSESSMENT FILE UPLOAD CODE IS AS FOLLOWING///////////////////


//FOLLOWING CODE is the FILE UPLOADER code//
$allowedext2=array("");
$allowedext=array("pdf","doc","docx");
$extension=end(explode(".",$_FILES["assessment_file_new"]["name"]));
	if(($_FILES["assessment_file_new"]["size"]<=20000000) && (in_array($extension, $allowedext)) && ($_FILES["assessment_file_new"]["size"]!=0))
	{
		if($_FILES["assessment_file_new"]["error"]>0)
		{
			echo "Return Code:". $_FILES["assessment_file_new"]["error"] ."<br />";
		}
		else
		{
			$dir = "assessment_upload/teacher_assessment_".$_SESSION['userId'];
			if(is_dir($dir) == false)
			{
				mkdir($dir);
				echo "<script>alert('Directory made')</script>";
			}		
			
			move_uploaded_file($_FILES["assessment_file_new"]["tmp_name"], $dir."/".$_FILES["assessment_file_new"]["name"]);
			//Making proper string with folder name to the file path
			$filepath=$dir."/".$_FILES["assessment_file_new"]["name"];
			$sql = "UPDATE `campus_schedule` SET  `assessment_filepath` =  '$filepath' , `assessment_date` =  '".date('Y-m-d')."' WHERE `id` = '".$_POST["id_assessment"]."' ";
			mysql_query($sql) or die(mysql_error()); 
			getMessages('edit_assessment','daily_scheduler_paydate_recurr.php'); 
		}
	}

	else
	{
		echo "<script>alert('Invalid File Selection OR File is bigger than 20 MB, Data cannot be inserted')</script>";
		getMessages('error');
	}
 
}
else
{
	echo "<script>alert('File Submit NOT SUCCESSFUL')</script>";
		
}

?>
 
<? 
include('include/footer.php');?> 
