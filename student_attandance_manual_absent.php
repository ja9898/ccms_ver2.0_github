<? 
include('config.php');
include('include/header.php');  
foreach($_GET AS $key => $value) { $_GET[$key] = mysql_real_escape_string($value); } 
global $_LIST;


if (isset($_GET['id'])) { 


$_invalid=getClassStatus($_GET['id'],$_LIST['systemdate']);
if($_invalid=='2'){
$_eid=startClass_manual_absent($_GET['id']);
$_SESSION['class']=$_eid;
getMessages('add','');
}
else{
getMessages('duplicate','','Class already Started');
}
} 




include('include/footer.php'); ?>