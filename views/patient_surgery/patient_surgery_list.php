<?php require_once("../../config/connection.php"); ?>
<?php
        //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(1, 9, 9, 9, 9, 9, 9, 9, 9, 1);

	$condition = "";

	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE patient.firstname LIKE '%$search%' ";
	}
	// getting information form surgery, staff, patient tables 
	$patient_surgery = mysqli_query($con, "SELECT
	patient_surgery_id,
	 patient.firstname as p_firstname, patient.lastname as p_lastname,
     surgery.surgery_name,surgery_date, surgery_result,
	 staff.firstname as s_firstname, staff.lastname as s_lastname
	 FROM 
	(((patient_surgery 
	  INNER JOIN patient ON patient_surgery.patient_id=patient.patient_id)
	  INNER JOIN surgery ON patient_surgery.surgery_id=surgery.surgery_id)
	  INNER JOIN staff ON patient_surgery.staff_id=staff.staff_id)
	$condition ORDER BY patient_surgery_id DESC");
	
	
	$totalRows_patient_surgery = mysqli_num_rows($patient_surgery);
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>patient_surgery List
<a href="patient_surgery_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New 
</a>
</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New patient_surgery has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient_surgery has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient_surgery has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected patient_surgery!
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
	<b>Total Result: <?php echo $totalRows_patient_surgery; ?></b>
</div>
<?php } ?>


<?php if($totalRows_patient_surgery > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Patient Name </th>
		<th>Surgery Name</th>
		<th>Doctor Name</th>
		<th>Surgery Date </th>
		<th>Surgery Result</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php while($row_patient_surgery = mysqli_fetch_assoc($patient_surgery)) { ?>
		<tr>
			<td><?php echo $row_patient_surgery["patient_surgery_id"]; ?></td>
			<td> <?php echo $row_patient_surgery["p_firstname"]; ?>  <?php echo $row_patient_surgery["p_lastname"]; ?> </td>
			<td><?php echo $row_patient_surgery["surgery_name"]; ?></td>
			<td> <?php echo $row_patient_surgery["s_firstname"]; ?>  <?php echo $row_patient_surgery["s_lastname"]; ?> </td>
			<td><?php echo $row_patient_surgery["surgery_date"]; ?></td>
			<td><?php echo $row_patient_surgery["surgery_result"]; ?></td>	
			<td>
				<a href="patient_surgery_edit.php?patient_surgery_id=<?php echo $row_patient_surgery["patient_surgery_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="patient_surgery_delete.php?patient_surgery_id=<?php echo $row_patient_surgery["patient_surgery_id"]; ?>">
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