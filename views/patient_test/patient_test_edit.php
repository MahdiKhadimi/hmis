<?php require_once("../../config/connection.php"); ?>
<?php

      //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	  checkLevel(4, 9, 9, 9, 9, 9, 9, 9, 9, 4);
    $patient = mysqli_query($con,"SELECT * FROM patient");

	$test = mysqli_query($con,"SELECT * FROM test");

	$patient_test_id=getValue($_GET['patient_test_id']);

	$patient_test = mysqli_query($con,"SELECT * FROM ((patient_test 
	  INNER JOIN patient ON patient_test.patient_id=patient.patient_id)
	  INNER JOIN test ON patient_test.test_id = test.test_id)
	 WHERE patient_test_id=$patient_test_id ");
	$row_patient_test=mysqli_fetch_assoc($patient_test);
	if(isset($_POST["test_id"])) {
		$patient_id = getValue($_POST["patient_id"]);
		$patient_id=explode("-",$patient_id);
		$patient_id=$patient_id[0];

		$test_id = getValue($_POST["test_id"]);
		$test_id= explode("-",$test_id);
		$test_id=$test_id[0];

		$test_date = getValue($_POST["test_date"]);
		$test_result = getValue($_POST["test_result"]);
	;	
		$result = mysqli_query($con, "UPDATE patient_test SET patient_id=$patient_id,test_id=$test_id, test_date='$test_date', test_result='$test_result' WHERE patient_test_id=$patient_test_id");
		
		if($result) {
			header("location:patient_test_list.php?edit=done");
		}
		else {
			header("location:patient_test_edit.php?error=notedit");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Edit test</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not edit  test!
			</div>
		<?php } ?>
	
		<form method="post">
			
		<div class="input-group">
				<span class="input-group-addon">
					 Patient:
				</span>
				<input type="text" value="<?php echo $row_patient_test['patient_id']?>-<?php echo $row_patient_test['firstname']?> <?php echo $row_patient_test['lastname']?>"list="patient" class="form-control" name="patient_id">
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
				<input type="text" value="<?php echo $row_patient_test['test_id']?>-<?php echo $row_patient_test['test_name']?>" list="test" class="form-control" name="test_id">
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
				<input type="text" value="<?php echo $row_patient_test['test_date']?>" class="form-control" name="test_date" id="test_date">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Test Result:
				</span>
				<input type="text" value="<?php echo $row_patient_test['test_result']?>" class="form-control" name="test_result">
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