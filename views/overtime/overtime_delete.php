<?php

	require_once("../../config/connection.php");
	
	$staff_id = getValue($_GET["staff_id"]);
	$overtime_year= getValue($_GET["overtime_year"]);
	$overtime_month= getValue($_GET["overtime_month"]);
	$overtime_day = getValue($_GET["overtime_day"]);
	
	$result = mysqli_query($con, "DELETE FROM overtime WHERE staff_id = $staff_id AND overtime_year=$overtime_year AND overtime_month=$overtime_month AND overtime_day=$overtime_day");
	
	if($result) {
		header("location:overtime_list.php?delete=done");
	}
	else {
		header("location:overtime_list.php?error=notdelete");
	}
	

?>