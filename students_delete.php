<? 
include('config.php'); 
include('include/header.php');
$id = (int) $_GET['id']; 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `campus_students` WHERE `id` = '$id' "));
$delete_student="FName:". nl2br( $row['firstName']).",LName:". nl2br( $row['lastName']).",Email:". nl2br( $row['email'])
				.",Agent:". showUser(nl2br( $row['agent_id']))
				.",Phone:(P,M,LL)". nl2br( $row['phone']) ." , ". nl2br( $row['mobile']) ." , ". nl2br( $row['landline'])
				.",Status:". getData(nl2br( $row['std_status']),'stdStatus');
				user_log( $_SERVER['PHP_SELF'] , "DELETE_STUDENT" , $_SESSION['userId'] ,$delete_student);
///////////////////////////////////////////////////////
mysql_query("DELETE FROM `campus_students` WHERE `id` = '$id' ") ; 
getMessages('delete','students_list.php');
include('include/footer.php');?>