<?php require_once("../../config/connection.php"); ?>
<?php require_once("../income/income_add.php"); ?>
<?php
     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(2, 9, 9, 9, 9, 9, 9, 9, 9, 2);

    $patient = mysqli_query($con,"SELECT * FROM patient");
    $staff = mysqli_query($con,"SELECT * FROM staff");
	$surgery = mysqli_query($con,"SELECT * FROM surgery");	
	if(isset($_POST["surgery_id"])) {
		$patient_id = getValue($_POST["patient_id"]);
		$patient_id=explode("-",$patient_id);
		$patient_id=$patient_id[0];

		$surgery_id = getValue($_POST["surgery_id"]);
		$surgery_id= explode("-",$surgery_id);
		$surgery_id=$surgery_id[0];

		$staff_id = getValue($_POST["staff_id"]);
		$staff_id= explode("-",$staff_id);
		$staff_id=$staff_id[0];

		$surgery_date = getValue($_POST["surgery_date"]);
		$surgery_result = getValue($_POST["surgery_result"]);
		

		$result = mysqli_query($con, "INSERT INTO patient_surgery VALUES (NULL,$surgery_id,$patient_id,$staff_id, '$surgery_date', '$surgery_result')");
		
		if($result) {
            // getting surgery amount 
			$surgery = mysqli_query($con,"SELECT * FROM surgery WHERE surgery_id=$surgery_id");
			$row_surgery = mysqli_fetch_assoc($surgery);
			$amount = $row_surgery['price'];
            $currency= $row_surgery['currency'];

			// add data in the income table 
			incomeAdd($patient_id,$amount,$currency,'surgery',$surgery_date);
			header("location:patient_surgery_list.php?add=done");
		}
		else {
			header("location:patient_surgery_add.php?error=notadd");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Add New surgery</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not add new surgery!
			</div>
		<?php } ?>
	
		<form method="post">
			
		<div class="input-group">
				<span class="input-group-addon">
					 Patient:
				</span>
				<input type="text" list="patient" class="form-control" name="patient_id">
				<datalist id="patient">
					<?php while($row_patient=mysqli_fetch_assoc($patient) ) { ?>
					
						<option value="<?php echo $row_patient['patient_id']; ?>-<?php echo $row_patient['firstname'];?> <?php echo $row_patient['lastname'];?> "/>
				    <?php } ?>		
					
				</datalist>

		 </div>

		 <div class="input-group">
				<span class="input-group-addon">
					 surgery:
				</span>
				<input type="text" list="surgery" class="form-control" name="surgery_id">
				<datalist id="surgery">
					<?php while($row_surgery=mysqli_fetch_assoc($surgery) ) { ?>
					
						<option value="<?php echo $row_surgery['surgery_id']; ?>-<?php echo $row_surgery['surgery_name'];?> "/>
				    <?php } ?>		
					
				</datalist>

		 </div>
		 <div class="input-group">
				<span class="input-group-addon">
					 Doctor:
				</span>
				<input type="text" list="staff" class="form-control" name="staff_id">
				<datalist id="staff">
					<?php while($row_staff=mysqli_fetch_assoc($staff) ) { ?>
					
						<option value="<?php echo $row_staff['staff_id']; ?>-<?php echo $row_staff['firstname'];?> <?php echo $row_staff['lastname'];?> "/>
				    <?php } ?>		
					
				</datalist>

		 </div>

			
		
			<div class="input-group">
				<span class="input-group-addon">
				   Date:
				</span>
				<input type="text" class="form-control" name="surgery_date" id="surgery_date">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   surgery Result:
				</span>
				<input type="text" class="form-control" name="surgery_result">
			</div>
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Add surgery">
			
		</form>
		
	</div>

</div>

</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "surgery_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });

	
</script>

<?php require_once("../layouts/footer_mis.php"); ?>