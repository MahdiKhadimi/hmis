<?php

	require_once("../../config/connection.php");
	  //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	  checkLevel(8, 9, 9, 9, 9, 9, 9, 9, 9, 9);
	// Deleting room 
	$room_id = getValue($_GET["room_id"]);
	$result = mysqli_query($con, "DELETE FROM room WHERE room_id = $room_id");
	if($result) {
		header("location:room_list.php?delete=done");
	}
	else {
		header("location:room_list.php?error=notdelete");
	}
	

?>