<?php 
	
	include('../config.php'); 
	
	$SQL_FROM = 'capmus_users';
	$firstName = 'firstName';
	$lastName = 'lastName';

?>
<?php
	$searchq		=	strip_tags($_GET['q']);
	$getRecord_sql	=	'SELECT * FROM '.$SQL_FROM.' WHERE ('.$firstName.' LIKE "'.$searchq.'%" or '.$lastName.' LIKE "'.$searchq.'%") and status=1 ';
	$getRecord		=	mysql_query($getRecord_sql);
	if(strlen($searchq)>0){
	
	echo '<ul>';
	while ($row = mysql_fetch_array($getRecord)) {?>
		<li><a href="#" onclick="javascript:setValueReference(<?php echo $row['id'] ?>,'<?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?>')"><?php echo $row['firstName']; ?> <?php echo $row['lastName']; ?> </a></li>
	<?php } 
	echo '</ul>';
	?>
<?php } ?>