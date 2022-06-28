<?php

	require_once("../../config/connection.php");	
	   //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	   checkLevel(8, 8, 9, 9, 9, 9, 9, 9, 9, 9);	

	
	$service_id = getValue($_GET["service_id"]);
	
	$service = mysqli_query($con, "SELECT photo FROM service WHERE service_id = $service_id");
	$row_service = mysqli_fetch_assoc($service);
	
	$result = mysqli_query($con, "DELETE FROM service WHERE service_id = $service_id");
	
	if($result) {
		if($row_service["photo"] != "../../images/service/user_m.png" && $row_service["photo"] != "../../images/service/user_f.png") {
			unlink($row_service["photo"]);
		}
		
		header("location:service_list.php?delete=done");
	}
	else {
		header("location:service_list.php?error=notdelete");
	}


?>