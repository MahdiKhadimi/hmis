<?php

	require_once("../../config/connection.php");
	     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
		 checkLevel(8, 9, 9, 9, 9, 9, 9, 9, 9, 8);
	$patient_medicine_id = getValue($_GET["patient_medicine_id"]);
	
	$result = mysqli_query($con, "DELETE FROM patient_medicine WHERE patient_medicine_id = $patient_medicine_id");
	
	if($result) {
		header("location:patient_medicine_list.php?delete=done");
	}
	else {
		header("location:patient_medicine_list.php?error=notdelete");
	}
	

?>