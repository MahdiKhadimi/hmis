<?php require_once("../../config/connection.php"); ?>
<?php

 //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
 checkLevel(1, 9, 9, 9, 9, 9, 1, 9, 9, 9);	

	$condition = "";

	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE medicine_name LIKE '%$search%' ";
	}
	
	$medicine = mysqli_query($con, "SELECT * FROM medicine $condition ORDER BY medicine_id DESC");
	
	
	$totalRows_medicine = mysqli_num_rows($medicine);
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>medicine List
<a href="medicine_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New 
</a>
</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New medicine has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected medicine has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected medicine has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected medicine!
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
	<b>Total Result: <?php echo $totalRows_medicine; ?></b>
</div>
<?php } ?>


<?php if($totalRows_medicine > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Name </th>
		<th>Description</th>
		<th>Form</th>
		<th>Quantity</th>
		<th>Price</th>
		<th>Price Unit</th>
		<th>Expire Date</th>
		
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php while($row_medicine = mysqli_fetch_assoc($medicine)) { ?>
		<tr>
			<td><?php echo $row_medicine["medicine_id"]; ?></td>
			<td><?php echo $row_medicine["medicine_name"]; ?></td>
			<td><?php echo $row_medicine["description"]; ?></td>
			<td><?php echo $row_medicine["form"]; ?></td>
			<td><?php echo $row_medicine["quantity"]; ?></td>
			<td><?php echo $row_medicine["price"]; ?></td>
			<td><?php echo $row_medicine["price_unit"]; ?></td>
			<td><?php echo $row_medicine["expire_date"]; ?></td>
			<td>
				<a href="medicine_edit.php?medicine_id=<?php echo $row_medicine["medicine_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="medicine_delete.php?medicine_id=<?php echo $row_medicine["medicine_id"]; ?>">
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