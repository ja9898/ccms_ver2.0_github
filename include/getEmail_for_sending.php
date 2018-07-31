<?php
include('../config.php');
include('function-inc.php');

//BEST LINK TO MAKE CHECKBOX ARRAY using single NAME but different VALUES
//http://coursesweb.net/php-mysql/get-value-multiple-selected-checkbox-same-name_t
//BEST LINK TO see that which of the CHECKBOXES are SELECTED
//http://www.overpie.com/jquery/articles/jquery-get-selected-checkboxes
$ids_for_email=$_GET['ids_for_email'];

$Email_for_sending_query=("SELECT * FROM campus_students WHERE id IN (".$ids_for_email.") ");
$result=mysql_query($Email_for_sending_query);
$emails=array();
?>
<?php while($row=mysql_fetch_array($result)) { 
 $emails[]=$row['email'];
 } 
 echo implode(",",$emails);
 ?>