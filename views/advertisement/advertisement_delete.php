<?php

	require_once("../../config/connection.php");	
	    //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
		checkLevel(8, 8, 9, 9, 9, 9, 9, 9, 9, 9);	

	
	$advertisement_id = getValue($_GET["advertisement_id"]);
	
	$advertisement = mysqli_query($con, "SELECT photo FROM advertisement WHERE advertisement_id = $advertisement_id");
	$row_advertisement = mysqli_fetch_assoc($advertisement);
	
	$result = mysqli_query($con, "DELETE FROM advertisement WHERE advertisement_id = $advertisement_id");
	
	if($result) {
		if($row_advertisement["photo"] != "../../images/advertisement/user_m.png" && $row_advertisement["photo"] != "../../images/advertisement/user_f.png") {
			unlink($row_advertisement["photo"]);
		}
		
		header("location:advertisement_list.php?delete=done");
	}
	else {
		header("location:advertisement_list.php?error=notdelete");
	}


?>