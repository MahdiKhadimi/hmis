<?php

	require_once("../../config/connection.php");	
	    //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
		checkLevel(8, 8, 9, 9, 9, 9, 9, 9, 9, 9);	

	
	$history_id = getValue($_GET["history_id"]);
	
	$history = mysqli_query($con, "SELECT photo FROM history WHERE history_id = $history_id");
	$row_history = mysqli_fetch_assoc($history);
	
	$result = mysqli_query($con, "DELETE FROM history WHERE history_id = $history_id");
	
	if($result) {
		if($row_history["photo"] != "../../images/history/user_m.png" && $row_history["photo"] != "../../images/history/user_f.png") {
			unlink($row_history["photo"]);
		}
		
		header("location:history_list.php?delete=done");
	}
	else {
		header("location:history_list.php?error=notdelete");
	}


?>