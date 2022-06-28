<?php require_once("../../config/connection.php"); ?>
<?php require_once("../income/income_add.php"); ?>
<?php
         //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(2, 9, 9, 9, 9, 9, 9, 9, 9, 2);
    $patient = mysqli_query($con,"SELECT * FROM patient");

	$test = mysqli_query($con,"SELECT * FROM test");
	
	if(isset($_POST["test_id"])) {
		$patient_id = getValue($_POST["patient_id"]);
		$patient_id=explode("-",$patient_id);
		$patient_id=$patient_id[0];

		$test_id = getValue($_POST["test_id"]);
		$test_id= explode("-",$test_id);
		$test_id=$test_id[0];

		$test_date = getValue($_POST["test_date"]);
		$test_result = getValue($_POST["test_result"]);
		
		$result = mysqli_query($con, "INSERT INTO patient_test VALUES (NULL, $patient_id,$test_id, '$test_date', '$test_result')");
		
		if($result) {

            // getting test price 
            $test=mysqli_query($con,"SELECT * FROM test WHERE test_id=$test_id");
            $row_test = mysqli_fetch_assoc($test);
			$amount = $row_test['price'];
			$currency = $row_test['currency'];
            // add amount of income in the income table 
			incomeAdd($patient_id,$amount,$currency,'test',$test_date);

			header("location:patient_test_list.php?add=done");
		}
		else {
			header("location:patient_test_add.php?error=notadd");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Add New test</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not add new test!
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
					 Test:
				</span>
				<input type="text" list="test" class="form-control" name="test_id">
				<datalist id="test">
					<?php while($row_test=mysqli_fetch_assoc($test) ) { ?>
					
						<option value="<?php echo $row_test['test_id']; ?>-<?php echo $row_test['test_name'];?> "/>
				    <?php } ?>		
					
				</datalist>

		 </div>

			
		
			<div class="input-group">
				<span class="input-group-addon">
				   Date:
				</span>
				<input type="text" class="form-control" name="test_date" id="test_date">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Test Result:
				</span>
				<input type="text" class="form-control" name="test_result">
			</div>
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Add test">
			
		</form>
		
	</div>

</div>

</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "test_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });

	
</script>

<?php require_once("../layouts/footer_mis.php"); ?>