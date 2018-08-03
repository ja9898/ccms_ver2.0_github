<?php
	include('file_include.php');
	extract($_GET);
	$url_to_redirect = SOFTPHONE_URL."?uid=".$uid."&number=".$number."&r=".rand();
	header("Location: $url_to_redirect");
	exit;
	
?>