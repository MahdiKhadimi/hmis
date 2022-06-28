<?php

	require_once("../../config/connection.php");
	  //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	  checkLevel(8, 9, 9, 9, 9, 9, 9, 9, 9, 9);
	$department_id = getValue($_GET["department_id"]);
	
	$result = mysqli_query($con, "DELETE FROM department WHERE department_id = $department_id");
	
	if($result) {
		header("location:department_list.php?delete=done");
	}
	else {
		header("location:department_list.php?error=notdelete");
	}
	

?>