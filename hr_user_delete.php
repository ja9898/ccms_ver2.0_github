<? 
include('config.php');
include('include/header.php'); 
$id = (int) $_GET['id']; 

/////////////////////////////////////////////////////// NEWLY ADDED // FOR USER LOG
$row = mysql_fetch_array ( mysql_query("SELECT * FROM `capmus_users` WHERE `id` = '$id' "));
$delete_user="User:".nl2br( $row['username']).",Pass:".nl2br( $row['password']).",FName:". nl2br( $row['firstName'])
				.",LName:".nl2br( $row['lastName']).",Email:".nl2br( $row['email'])
				.",User_Type:".getData(nl2br( $row['user_type']),'userType').",Gender:".getData(nl2br( $row['gender']),'gender')
				.",Status:".getData(nl2br( $row['status']),'status')
				.",Designation:".getData(nl2br( $row['designationID']),'designation')
				.",Emp_type:".getData(nl2br( $row['empType']),'employeeType').",Shift:".getData(nl2br( $row['empShift']),'shift');
				user_log( $_SERVER['PHP_SELF'] , "HR_DELETE_USER" , $_SESSION['userId'] ,$delete_user);
///////////////////////////////////////////////////////

$usertype=getUserType($id);
if($usertype==3){
removeCourse($id);
removeTimings($id);
}
mysql_query("DELETE FROM `capmus_users` WHERE `id` = '$id' ") ; 
getMessages('delete','user_list.php');
?>
<?php include('include/footer.php');?>