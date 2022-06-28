
<?php
    require_once("../../config/connection.php");
  //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
  checkLevel(4, 9, 9, 9, 4, 9, 9, 9, 9, 9);
	$expense_id = getValue($_GET["expense_id"]);
	$expense = mysqli_query($con, "SELECT * FROM expense WHERE expense_id = $expense_id");
	$row_expense = mysqli_fetch_assoc($expense);
	
	
	if(isset($_POST["expense_to"])) {
		$expense_to = getValue($_POST["expense_to"]);
		$amount = getValue($_POST["amount"]);
		$currency = getValue($_POST["currency"]);
		$expense_date = getValue($_POST["expense_date"]);
		
		$result = mysqli_query($con, "UPDATE expense SET expense_to='$expense_to', amount=$amount, currency='$currency', expense_date='$expense_date' WHERE expense_id = $expense_id");
		
		if($result) {
			header("location:expense_list.php?edit=done");
		}
		else {
			header("location:expense_edit.php?error=notedit&expense_id=$expense_id");
		}
		
	}
	
?>

 <?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Edit Expense</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not save changes!
			</div>
		<?php } ?>
	
		<form method="post">
			
			<div class="input-group">
				<span class="input-group-addon">
					Expense To:
				</span>
				<input value="<?php echo $row_expense["expense_to"]; ?>" type="text" class="form-control" name="expense_to">
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
					Amount:
				</span>
				<input value="<?php echo $row_expense["amount"]; ?>" type="text" class="form-control" name="amount">
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
					Currency:
				</span>
				<select class="form-control" name="currency">
					<option <?php if($row_expense["currency"] == "AFN") echo "selected"; ?>>AFN</option>
					<option <?php if($row_expense["currency"] == "USD") echo "selected"; ?>>USD</option>
				</select>
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
					Expense Date:
				</span>
				<input value="<?php echo $row_expense["expense_date"]; ?>" autocomplete="off" type="text" class="form-control" name="expense_date" id="expense_date">
			</div>
			
			<input type="submit" class="btn btn-primary" value="Save Changes">
			<button class="btn btn-info" data-dismiss="panel">Cancel</button>
			
		</form>
		
	</div>

</div>

</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "expense_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
</script>

<?php require_once("../../config/footer_mis.php"); ?>