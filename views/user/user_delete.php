<?php

	require_once("../../config/connection.php");
	 //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(8, 9, 9, 9, 9, 9, 9, 9, 9, 9);
	$user_id = getValue($_GET["user_id"]);
	
	$result = mysqli_query($con, "DELETE FROM users WHERE user_id = $user_id");
	
	if($result) {
		header("location:user_list.php?delete=done");
	}
	else {
		header("location:user_list.php?error=notdelete");
	}
	

?>