<?php require_once("../../config/connection.php"); ?>
<?php
	   //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	    checkLevel(2, 9, 9, 9, 9, 9, 9, 9, 9, 9);	

	if(isset($_POST["department_name"])) {
		$department_name = getValue($_POST["department_name"]);
		
		$result = mysqli_query($con, "INSERT INTO department VALUES (NULL, '$department_name')");
		
		if($result) {
			header("location:department_list.php?add=done");
		}
		else {
			header("location:department_add.php?error=notadd");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Add New Department</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not add new department!
			</div>
		<?php } ?>
	
		<form method="post">
			
			<div class="input-group">
				<span class="input-group-addon">
					Department Name:
				</span>
				<input type="text" class="form-control" name="department_name">
			</div>
			
			<input type="submit" class="btn btn-primary" value="Add Department">
			
		</form>
		
	</div>

</div>

</div>

<?php require_once("../layouts/footer_mis.php"); ?>