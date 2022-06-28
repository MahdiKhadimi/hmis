<?php require_once("../../config/connection.php"); ?>
<?php

  //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
  checkLevel(2, 9, 9, 9, 9, 9, 9, 2, 9, 9);	
  
	if(isset($_POST["test_name"])) {
		$test_name = getValue($_POST["test_name"]);
		$test_type = getValue($_POST["test_type"]);
		$price = getValue($_POST["price"]);
		$currency = getValue($_POST["currency"]);
		$normal_result = getValue($_POST["normal_result"]);	

		$result = mysqli_query($con, "INSERT INTO test VALUES (NULL, '$test_name', '$test_type', $price,'$currency','$normal_result')");
		
		if($result) {
			header("location:test_list.php?add=done");
		}
		else {
			header("location:test_add.php?error=notadd");
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
					 Name:
				</span>
				<input type="text" class="form-control" name="test_name">
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
				   Type:
				</span>
				<input type="text" class="form-control" name="test_type">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Price:
				</span>
				<input type="number" class="form-control" name="price">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Currency:
				</span>
				<select name="currency" class="form-control">
					<option >AFG</option>
					<option >USD</option>
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Normal Result:
				</span>
				<input type="number" class="form-control" name="normal_result">
			</div>
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Add test">
			
		</form>
		
	</div>

</div>

</div>



<?php require_once("../layouts/footer_mis.php"); ?>