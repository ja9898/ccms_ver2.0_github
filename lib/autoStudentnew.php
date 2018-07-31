<?php 
	
	include('../config.php'); 
	
	$SQL_FROM = 'campus_students';
	$firstName = 'firstName';
	$lastName = 'lastName';
	$std_status = 'std_status';

?>
<?php
	$searchq		=	strip_tags($_GET['q']);
	$getRecord_sql	=	'SELECT * FROM '.$SQL_FROM.' WHERE ('.$firstName.' LIKE "'.$searchq.'%" or '.$lastName.' LIKE "'.$searchq.'%") and std_status IN (1,2) ';
	if($_SESSION['userType']==5)
	{
	 	$getRecord_sql.=' and agent_id="'.$_SESSION['userId'].'"';
	}
	$getRecord		=	mysql_query($getRecord_sql);
	if(strlen($searchq)>0){
	
	echo '<ul>';
	while ($row = mysql_fetch_array($getRecord)) {?>
		<li><a href="#" onclick="javascript:setValueStudent2(<?php echo $row['id'] ?>,'<?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?>')"><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?> </a></li>
	<?php } 
	echo '</ul>';
	?>
<?php } ?>