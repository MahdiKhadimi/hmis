<?php

	require_once("../../config/connection.php");
	
	$admit_id = getValue($_GET["admit_id"]);
	
	$result = mysqli_query($con, "DELETE FROM admit WHERE admit_id = $admit_id");
	
	if($result) {
		header("location:admit_list.php?delete=done");
	}
	else {
		header("location:admit_list.php?error=notdelete");
	}
	

?>