<? 
include('config.php'); 
include('include/header.php');
if (isset($_POST['submitted']) && !empty($_POST['assign_name']) && !empty($_POST['description']) && !empty($_POST['start_date']) && !empty($_POST['end_date'])) {
if(isset($_POST['enable_disable']))
{
	$enable_disable = 1;
}
else
{
	$enable_disable = 0;
}
//FOLLOWING CODE is the FILE UPLOADER code//
$allowedext2=array("");
$allowedext=array("pdf","doc","docx");
$extension=end(explode(".",$_FILES["assignment_file"]["name"]));
	if(($_FILES["assignment_file"]["size"]<=20000000) && (in_array($extension, $allowedext)) && ($_FILES["assignment_file"]["size"]!=0))
	{
		if($_FILES["assignment_file"]["error"]>0)
		{
			echo "Return Code:". $_FILES["assignment_file"]["error"] ."<br />";
		}
		else
		{
		move_uploaded_file($_FILES["assignment_file"]["tmp_name"], "assignment_upload/" . $_FILES["assignment_file"]["name"]);
		//Making proper string with folder name to the file path
		$filepath="assignment_upload/" . $_FILES["assignment_file"]["name"];
		$sql = "INSERT INTO `campus_assignment` (   `assign_name` ,  `description` ,  `start_date` ,  `end_date` , `amount` , `assigned_to` ,`operator` , `enable_disable` , `datetime` ,  `file_path` ) VALUES(    '{$_POST['assign_name']}' ,  '{$_POST['description']}' , '".prepareDate($_POST['start_date'])."' , '".prepareDate($_POST['end_date'])."' , '{$_POST['amount']}' , '{$_POST['assigned_to']}' ,'".$_SESSION['userId']."' , '$enable_disable' , NOW() , '$filepath' ) "; 
		mysql_query($sql) or die(mysql_error()); 
		getMessages('add'); 
		}
	}

	else
	{
		echo "<script>alert('Invalid File Selection OR File is bigger than 20 MB, Data cannot be inserted')</script>";
		getMessages('error');
	}
} 

?>

<form action="<?php echo $_SERVER['PHP_SELF']; ?>" method='POST' enctype="multipart/form-data" id="new_entry"> 

<div id="label">Assignment Name:</div><div id="field"><input type='text' name='assign_name' required/></div> 
<div id="label">Description:</div><div id="field"><input type='text' name='description' required/> </div>
<div id="label">Start Date:</div><div id="field"><input type="text"  name="start_date"  id="start_date"  class="flexy_datepicker_input"/></div>
<div id="label">End Date:</div><div id="field"><input type="text"  name="end_date"  id="end_date" class="flexy_datepicker_input"/></div>
<div id="label">Amount:</div><div id="field"><input type='text' name='amount'/> </div>
<div id="label">Enable/Disable for download</div><div id="field" style="color:red"><?php echo getCheckbox($_POST['enable_disable'],'enable_disable'); ?>(Check/Uncheck for download)</div>
<div id="label">Select person for assignment:</div><div id="field" name=""><?php echo getDataList_reference(stripslashes($_POST['assigned_to']),'assigned_to','',''); ?> </div>

<div id="label">Select file(pdf,doc-ONLY):</div><div id="field"><input name="assignment_file" type="file" /></div>

<div id="label">&nbsp;</div><div id="field"><input type='submit' class="button" value='Submit' /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<?php include('include/footer.php');?>