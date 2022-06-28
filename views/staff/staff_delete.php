<?php

	require_once("../../config/connection.php");
	
	  //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	  checkLevel(8, 9, 9, 8, 9, 9, 9, 9, 9, 9);
	
	
	
	
	$staff_id = getValue($_GET["staff_id"]);
	
	$staff = mysqli_query($con, "SELECT photo FROM staff WHERE staff_id = $staff_id");
	$row_staff = mysqli_fetch_assoc($staff);
	
	$result = mysqli_query($con, "DELETE FROM staff WHERE staff_id = $staff_id");
	
	if($result) {
		if($row_staff["photo"] != "../../images/staff/user_m.png" && $row_staff["photo"] != "../../images/staff/user_f.png") {
			unlink($row_staff["photo"]);
		}
		
		header("location:staff_list.php?delete=done");
	}
	else {
		header("location:staff_list.php?error=notdelete");
	}


?>