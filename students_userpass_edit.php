<? 
include('config.php'); 
include('include/header.php');
if (isset($_GET['id']) ) { 
$id = (int) $_GET['id']; 
if (isset($_POST['submitted'])) {

foreach($_POST AS $key => $value) { $_POST[$key] = mysql_real_escape_string($value); } 

  $sql = "UPDATE `campus_students` SET  `username` =  '".$_POST['username']."' ,
  `password` =  '".$_POST['password']."'  WHERE `id` = $id "; 

  mysql_query($sql) or die(mysql_error()); 
getMessages('edit');
} 
$_sql="SELECT * FROM `campus_students` WHERE `id` = '$id'  ";
if($_SESSION['userType']==5)
{
	$_sql.=" and agent_id=".$_SESSION['userId']."";
}
$_result=mysql_query($_sql);
 
 
if(mysql_num_rows($_result)==0){
getMessages('noresult');

}else{
$row = mysql_fetch_assoc($_result);

?>

<form action='' method='POST'> 
<div id="label">Student Name:</div><div id="field"><label name='student-readonly'><?php echo showStudents(nl2br( $row['id'])); ?> </label></div>
<div id="label">Status:</div><div id="field"><label name='status'><?php echo getData(nl2br($row['std_status']),'stdStatusmo-list'); ?> </label></div>
<div id="label">Username:</div><div id="field"><?php echo getInput(stripslashes($row['username']) ,'username','')?></div>
<div id="label">Password:</div><div id="field"><?php echo getInput(stripslashes($row['password']),'password','')?></div>
<div id="label"></div><div id="field"><input type='submit' value='Edit Row' class="button" /><input type='hidden' value='1' name='submitted' /> </div>
</form> 
<? }} 
include('include/footer.php');?> 
