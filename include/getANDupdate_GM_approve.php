<?php
include('../config.php');
include('function-inc.php');

//BEST LINK TO MAKE CHECKBOX ARRAY using single NAME but different VALUES
//http://coursesweb.net/php-mysql/get-value-multiple-selected-checkbox-same-name_t
//BEST LINK TO see that which of the CHECKBOXES are SELECTED
//http://www.overpie.com/jquery/articles/jquery-get-selected-checkboxes
$id=$_GET['id'];
$GMApprove=$_GET['GMApprove'];
$GMComments=$_GET['GMComments'];
$id=$_GET['id'];

/* echo "UPDATE campus_empleave SET GMApprove = '".$GMApprove."' , GMComments = '".$GMComments."' , 
HRID = '".$_SESSION['userId']."' , HRDate=NOW() WHERE id='".$id."' ";
 */
$update_HRReceive_comments = mysql_query("UPDATE campus_empleave SET GMApprove = '".$GMApprove."' , 
GMComments = '".$GMComments."' , GMID = '".$_SESSION['userId']."' , GMDate=NOW() WHERE id='".$id."' ") or trigger_error(mysql_error());
?>