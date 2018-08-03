<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted']) ) {

//FOLLOWING CODE is the FILE UPLOADER code//
$allowedext2=array("");
$allowedext=array("pdf","doc","docx");
$extension=end(explode(".",$_FILES["assignment_file_new"]["name"]));
	if(($_FILES["assignment_file_new"]["size"]<=20000000) && (in_array($extension, $allowedext)) && ($_FILES["assignment_file_new"]["size"]!=0))
	{
		if($_FILES["assignment_file_new"]["error"]>0)
		{
			echo "Return Code:". $_FILES["assignment_file_new"]["error"] ."<br />";
		}
		else
		{
		move_uploaded_file($_FILES["assignment_file_new"]["tmp_name"], "assignment_upload/" . $_FILES["assignment_file_new"]["name"]);
		//Making proper string with folder name to the file path
		$filepath="assignment_upload/" . $_FILES["assignment_file_new"]["name"];
		$sql = "UPDATE `campus_assignment` SET  `assign_name` =  '{$_POST['assign_name']}' ,`description` =  '{$_POST['description']}' ,  `start_date` =  '".prepareDate($_POST['start_date'])."' ,  `end_date` =  '".prepareDate($_POST['end_date'])."' , `amount` =  '{$_POST['amount']}' , `assigned_to` =  '{$_POST['assigned_to']}' ,  `enable_disable` =  '{$_POST['enable_disable']}'  ,  `file_path` =  '$filepath'   WHERE `id` = $id ";
		mysql_query($sql) or die(mysql_error()); 
		getMessages('edit'); 
		}
	}

	else 
	{
		$sql = "UPDATE `campus_assignment` SET  `assign_name` =  '{$_POST['assign_name']}' ,`description` =  '{$_POST['description']}' ,  `start_date` =  '".prepareDate($_POST['start_date'])."' ,  `end_date` =  '".prepareDate($_POST['end_date'])."' , `amount` =  '{$_POST['amount']}' , `assigned_to` =  '{$_POST['assigned_to']}' ,  `enable_disable` =  '{$_POST['enable_disable']}'    WHERE `id` = $id "; 
		mysql_query($sql) or die(mysql_error());
		getMessages('edit');
	}
 

} 
$_sql="SELECT * FROM `campus_assignment` WHERE `id` = '$id'  ";

$_result=mysql_query($_sql);
$row = mysql_fetch_assoc($_result);

?>

<form action='' enctype="multipart/form-data" method='POST'> 
<div id="label">Assignment Name:</div><div id="field"><?php echo getInput(stripslashes($row['assign_name']) ,'assign_name','')?></div>
<div id="label">Description:</div><div id="field"><?php echo getInput(stripslashes($row['description']),'description','')?></div>
<div id="label">Start Date:</div><div id="field"><?php echo getInput(prepareDate(stripslashes($row['start_date'])),'start_date','class="flexy_datepicker_input"')?></div>
<div id="label">End Date:</div><div id="field"><?php echo getInput(prepareDate(stripslashes($row['end_date'])),'end_date','class="flexy_datepicker_input"')?></div>
<div id="label">Amount:</div><div id="field"><input type="text"  name="amount" id="amount" value="<?php echo stripslashes($row['amount']); ?>" /></div>

<div id="label">Enable/Disable for download:</div><div id="field"><?php echo getCheckbox(stripslashes($row['enable_disable']),'enable_disable');?> </div>

<!--<div id="label">Select person for assignment:</div><div id="field_sch_new"><div id="filter"><?php //echo getReferenceFilter_new_student(); ?></div> </div>-->
<div id="label">Select person for assignment:</div><div id="field" name=""><?php echo getDataList_reference(stripslashes($row['assigned_to']),'assigned_to','',''); ?> </div>


<div id="label">Old file(pdf,doc-ONLY):</div><div id="field"><textarea readonly name="assignment_file_old"><?php echo stripslashes($row['file_path']);?></textarea></div> 
<div id="label">Select file-if you want to replace old(pdf,doc-ONLY):</div><div id="field"><input name="assignment_file_new" type="file" /></div>

<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<? } 
include('include/footer.php');?> 
