<?php

	require_once("../../config/connection.php");
	     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
		 checkLevel(8, 9, 9, 9, 8, 9, 9, 9, 9, 9);
	$staff_id = getValue($_GET["staff_id"]);
	$salary_year= getValue($_GET["salary_year"]);
	$salary_month= getValue($_GET["salary_month"]);
	
	
	$result = mysqli_query($con, "DELETE FROM salary WHERE staff_id = $staff_id AND salary_year=$salary_year AND salary_month=$salary_month");
	
	if($result) {
		header("location:salary_list.php?delete=done");
	}
	else {
		header("location:salary_list.php?error=notdelete");
	}
	

?>