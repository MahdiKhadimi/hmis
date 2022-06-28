<?php require_once("../../config/connection.php"); ?>
<?php
       //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	   checkLevel(1, 9, 9, 9, 9, 9, 9, 9, 9, 1);

	$condition = "";

	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE patient.firstname LIKE '%$search%' ";
	}
	
	$patient_test = mysqli_query($con, "SELECT * FROM 
	((patient_test 
	  INNER JOIN patient ON patient_test.patient_id=patient.patient_id)
	  INNER JOIN test ON patient_test.test_id=test.test_id)
	$condition ORDER BY patient_test_id DESC");
	
	
	$totalRows_patient_test = mysqli_num_rows($patient_test);
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>patient_test List
<a href="patient_test_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New 
</a>
</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New patient_test has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient_test has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient_test has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected patient_test!
	</div>
<?php } ?>

<form method="get">
	<div class="input-group">
		<span class="input-group-addon">
			Search:
		</span>
		<input type="text" name="q" class="form-control">
		<span class="input-group-btn">
			<button class="btn btn-primary">
				<span style="color:white;" class="glyphicon glyphicon-search"></span>
			</button>
		</span>
	</div>
</form>

<?php if(isset($_GET["q"])) { ?>
<div style="font-size:18px;">
	<b>Search for: <?php echo $_GET["q"]; ?></b>
	<br>
	<b>Total Result: <?php echo $totalRows_patient_test; ?></b>
</div>
<?php } ?>


<?php if($totalRows_patient_test > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Patient Name </th>
		<th>Test Name</th>
		<th>Test Date </th>
		<th>Test Result</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php while($row_patient_test = mysqli_fetch_assoc($patient_test)) { ?>
		<tr>
			<td><?php echo $row_patient_test["patient_test_id"]; ?></td>
			<td> <?php echo $row_patient_test["firstname"]; ?>  <?php echo $row_patient_test["lastname"]; ?> </td>
			<td><?php echo $row_patient_test["test_name"]; ?></td>
			<td><?php echo $row_patient_test["test_date"]; ?></td>
			<td><?php echo $row_patient_test["test_result"]; ?></td>	
			<td>
				<a href="patient_test_edit.php?patient_test_id=<?php echo $row_patient_test["patient_test_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="patient_test_delete.php?patient_test_id=<?php echo $row_patient_test["patient_test_id"]; ?>">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>
	<?php } ?>
	

	
</table>
<?php } else { ?>
	<div class="alert alert-warning text-center">
		<h3 style="border:none;">No Result Found!</h3>
	</div>
<?php } ?>


<?php require_once("../layouts/footer_mis.php"); ?>