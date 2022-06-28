<?php

	require_once("../../config/connection.php");	
	   //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	   checkLevel(8, 8, 9, 9, 9, 9, 9, 9, 9, 9);	

	
	$slide_show_id = getValue($_GET["slide_show_id"]);
	
	$slide_show = mysqli_query($con, "SELECT photo FROM slide_show WHERE slide_show_id = $slide_show_id");
	$row_slide_show = mysqli_fetch_assoc($slide_show);
	
	$result = mysqli_query($con, "DELETE FROM slide_show WHERE slide_show_id = $slide_show_id");
	
	if($result) {
		if($row_slide_show["photo"] != "../../images/slide_show/user_m.png" && $row_slide_show["photo"] != "../../images/slide_show/user_f.png") {
			unlink($row_slide_show["photo"]);
		}
		
		header("location:slide_show_list.php?delete=done");
	}
	else {
		header("location:slide_show_list.php?error=notdelete");
	}


?>