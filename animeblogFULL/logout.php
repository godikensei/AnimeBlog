<?php
	session_start();
	session_destroy();
	unset($_SESSION['nickname']);
	$_SESSION['message'] = "Ki vagy jelentkezve!";
	header("location: index.php");
?>