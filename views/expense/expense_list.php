<?php require_once("../../config/connection.php"); ?>
<?php
   //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
   checkLevel(1, 9, 9, 9, 1, 9, 9, 9, 9, 9);

	$condition = "";

	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE expense_to LIKE '%$search%' ";
	}
	
	$expense = mysqli_query($con, "SELECT * FROM expense $condition ORDER BY expense_id DESC");
	$row_expense = mysqli_fetch_assoc($expense);
	
	$totalRows_expense = mysqli_num_rows($expense);
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>Expense List
<a href="expense_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New 
</a>
</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New expense has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected expense has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected expense has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected expense!
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
	<b>Total Result: <?php echo $totalRows_expense; ?></b>
</div>
<?php } ?>


<?php if($totalRows_expense > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Expense To</th>
		<th>Amount</th>
		<th>Date</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php $totalAFN = 0; $totalUSD = 0; $totalEUR = 0;
			do { ?>
		<tr>
			<td><?php echo $row_expense["expense_id"]; ?></td>
			<td><?php echo $row_expense["expense_to"]; ?></td>
			<td><?php echo number_format($row_expense["amount"], 0); ?> <?php echo $row_expense["currency"]; ?></td>
			<td><?php echo $row_expense["expense_date"]; ?></td>
			<?php
				if($row_expense["currency"] == "USD") {
					$totalUSD += $row_expense["amount"];
				}
				else if($row_expense["currency"] == "AFN") {
					$totalAFN += $row_expense["amount"];
				}
				else if($row_expense["currency"] == "EUR") {
					$totalEUR += $row_expense["amount"];
				}
			?>
			<td>
				<a href="expense_edit.php?expense_id=<?php echo $row_expense["expense_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="expense_delete.php?expense_id=<?php echo $row_expense["expense_id"]; ?>">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>
	<?php } while($row_expense = mysqli_fetch_assoc($expense)); ?>
	
	<tr>
		<td></td>
		<td><b>Total Expense:</b></td>
		<td>
			<b>
			<?php echo number_format($totalAFN, 0); ?> AFN<br>
			<?php echo number_format($totalUSD, 0); ?> USD<br>
			<?php echo number_format($totalEUR, 0); ?> EUR<br>
			</b>
		</td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	
</table>
<?php } else { ?>
	<div class="alert alert-warning text-center">
		<h3 style="border:none;">No Result Found!</h3>
	</div>
<?php } ?>


<?php require_once("../layouts/footer_mis.php"); ?>