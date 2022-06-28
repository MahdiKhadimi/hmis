<?php
   require_once("../../config/connection.php");
    //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(2, 9, 9, 9, 2, 9, 9, 9, 9, 9);
  // this function use to inert income data 
  function incomeAdd($patient_id,$amount,$income_currency,$income_type,$income_date){
      global $con;
	  $result = mysqli_query($con,"INSERT INTO income VALUES(null,$patient_id,$amount,'$income_currency','$income_type','$income_date')");  
      return $result;

	}

?>