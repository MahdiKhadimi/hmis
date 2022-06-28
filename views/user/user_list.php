<?php require_once("../../config/connection.php"); ?>
<?php
	 //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(1, 9, 9, 9, 9, 9, 9, 9, 9, 9);
	$user = mysqli_query($con, "SELECT * FROM users ORDER BY user_id ASC");
	$row_user = mysqli_fetch_assoc($user);
	
	$totalRows_user = mysqli_num_rows($user);
	
?>
<?php require_once("../layouts/header.php"); ?>

<a href="user_add.php" class="btn btn-primary pull-right">
	Add New User
</a>

<h2>User Accounts</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New user has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected user has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected user has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected user!
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
	<b>Total Result: <?php echo $totalRows_user; ?></b>
</div>
<?php } ?>


<?php if($totalRows_user > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>ID</th>
		<th>Name</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php do { ?>
		<tr>
			<td><?php echo $row_user["user_id"]; ?></td>
			<td><?php echo $row_user["username"]; ?></td>
			<td>
				<a href="user_edit.php?user_id=<?php echo $row_user["user_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="user_delete.php?user_id=<?php echo $row_user["user_id"]; ?>">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>
	<?php } while($row_user = mysqli_fetch_assoc($user)); ?>
	
</table>
<?php } else { ?>
	<div class="alert alert-warning text-center">
		<h3 style="border:none;">No Result Found!</h3>
	</div>
<?php } ?>


<?php require_once("../layouts/footer_mis.php"); ?>