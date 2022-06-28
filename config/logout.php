<?php

	require_once("connection.php");
	
	unset($_SESSION["user_id"]);
	  
	  header("location:../index.php?logout=done");



?>