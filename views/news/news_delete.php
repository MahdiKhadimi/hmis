<?php

	require_once("../../config/connection.php");	
      //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(8, 8, 9, 9, 9, 9, 9, 9, 9, 9);	
	
	
	$news_id = getValue($_GET["news_id"]);
	
	$news = mysqli_query($con, "SELECT news_file FROM news WHERE news_id = $news_id");
	$row_news = mysqli_fetch_assoc($news);
	
	$result = mysqli_query($con, "DELETE FROM news WHERE news_id = $news_id");
	
	if($result) {
		if($row_news["news_file"] != "../../images/news/user_m.png" && $row_news["news_file"] != "../../images/news/user_f.png") {
			unlink($row_news["news_file"]);
		}
		
		header("location:news_list.php?delete=done");
	}
	else {
		header("location:news_list.php?error=notdelete");
	}


?>