<?php require_once("../../config/connection.php"); ?>
<?php

       //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	   checkLevel(1, 9, 9, 9, 9, 9, 9, 9, 9, 1);
  $condition = "";

	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE patient.firstname LIKE '%$search%' ";
	}
	
	$patient_medicine = mysqli_query($con, "SELECT * FROM 
	((patient_medicine 
	  INNER JOIN patient ON patient_medicine.patient_id=patient.patient_id)
	  INNER JOIN medicine ON patient_medicine.medicine_id=medicine.medicine_id)
	$condition ORDER BY patient_medicine_id DESC");
	
	
	$totalRows_patient_medicine = mysqli_num_rows($patient_medicine);
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>patient_medicine List
<a href="patient_medicine_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New 
</a>
</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New patient_medicine has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient_medicine has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient_medicine has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected patient_medicine!
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
	<b>Total Result: <?php echo $totalRows_patient_medicine; ?> </b>
</div>
<?php } ?>


<?php if($totalRows_patient_medicine > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Patient Name </th>
		<th>Medicine Name</th>
		<th>Quantity</th>
		<th>Unit Price</th>
		<th>Total Price</th>
		<th>Apply Date</th>
	
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php while($row_patient_medicine = mysqli_fetch_assoc($patient_medicine)) { ?>
		<tr>
			<td><?php echo $row_patient_medicine["patient_medicine_id"]; ?></td>
			<td> <?php echo $row_patient_medicine["firstname"]; ?>  <?php echo $row_patient_medicine["lastname"]; ?> </td>
			<td><?php echo $row_patient_medicine["medicine_name"]; ?></td>
			<td><?php echo $row_patient_medicine["quantity"]; ?></td>
			<td><?php echo $row_patient_medicine["unit_price"]; ?></td>
			<td><?php echo $row_patient_medicine["total_price"]; ?></td>
			<td><?php echo $row_patient_medicine["apply_date"]; ?></td>	
			<td>
				<a href="patient_medicine_edit.php?patient_medicine_id=<?php echo $row_patient_medicine["patient_medicine_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="patient_medicine_delete.php?patient_medicine_id=<?php echo $row_patient_medicine["patient_medicine_id"]; ?>">
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