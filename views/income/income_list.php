<?php require_once("../../config/connection.php"); ?>
<?php

    //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(1, 9, 9, 9, 1, 9, 9, 9, 9, 9);
	$condition = "";

	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE income_type LIKE '%$search%' ";
	}
	
	$income = mysqli_query($con, "SELECT * FROM income 
	 INNER JOIN patient ON income.patient_id=patient.patient_id
	 $condition
	 ORDER BY income.income_id DESC");
	$totalRows_income = mysqli_num_rows($income);
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>Income List

</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New income has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected income has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected income has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected income!
	</div>
<?php } ?>

<form method="get">
	<div class="input-group">
		<span class="input-group-addon">
			Search:
		</span>
		<input type="text" name="q" class="form-control" placeholder="Search For Income Type">
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
	<b>Total Result: <?php echo $totalRows_income; ?></b>
</div>
<?php } ?>


<?php if($totalRows_income > 0) { ?>
<table class="table table-striped">
	<tr>
	
		<th>S/No</th>
		<th>Patient Name</th>
		<th>Amount </th>
		<th>Income Type</th>
		<th>Income Date</th>
		
	</tr>
	
	<?php $i=1; while($row_income = mysqli_fetch_assoc($income)) { ?>
		<tr>
			
			<td><?php echo $i++;?></td>
			<td><?php echo $row_income["firstname"]; ?> <?php echo $row_income["lastname"]; ?> </td>
			<td><?php echo $row_income["amount"]; ?></td>
			<td><?php echo $row_income["income_type"]; ?></td>
			<td><?php echo $row_income["income_date"]; ?></td>
		</tr>
	<?php } ?>
	

	
</table>
<?php } else { ?>
	<div class="alert alert-warning text-center">
		<h3 style="border:none;">No Result Found!</h3>
	</div>
<?php } ?>


<?php require_once("../layouts/footer_mis.php"); ?>