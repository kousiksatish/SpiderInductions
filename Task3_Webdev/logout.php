<?php

	session_start();
	
	session_destroy();
	
	setcookie("spideruser", "$username" , time()+1000, "/summer/backend","fr.localhost.com", 0);
	
	header("location:index.php");
	
?>
	
