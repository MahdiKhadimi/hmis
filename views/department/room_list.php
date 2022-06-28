<?php require_once("../../config/connection.php"); ?>
<?php
  //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
  checkLevel(1, 9, 9, 9, 9, 9, 9, 9, 9, 9);

   // this use to search
	$condition = "";   
	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE room_name LIKE '%$search%' ";
	}
	// query for getting the room list 
	$room = mysqli_query($con, "SELECT * FROM room INNER JOIN department ON room.department_id=department.department_id $condition ORDER BY room_id ASC");

	
	$totalRows_room = mysqli_num_rows($room);
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>room List <a style="font-size:14px" href="room_add.php" class="btn btn-info pull-right">Add New</a></h2>

<!-- start showing message -->
<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New room has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected room has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected room has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected room!
	</div>
<?php } ?>

<!-- end showing error -->

<!-- start search form  -->
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
<!-- end searching form -->
<?php if(isset($_GET["q"])) { ?>
<div style="font-size:18px;">
	<b>Search for: <?php echo $_GET["q"]; ?></b>
	<br>
	<b>Total Result: <?php echo $totalRows_room; ?></b>
</div>
<?php } ?>

<!-- table to show rooms -->
<?php if($totalRows_room > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>Number</th>
		<th>Type</th>
		<th>Department</th>
		<th>Capacity</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php  while($row_room = mysqli_fetch_assoc($room)) { ?>
		<tr>
			<td><?php echo $row_room["room_no"]; ?></td>
			<td><?php echo $row_room["room_type"]; ?></td>
			<td> <?php echo $row_room["department_name"]; ?></td>
			<td><?php echo $row_room["capacity"]; ?></td>
			<td>
				<a href="room_edit.php?room_id=<?php echo $row_room["room_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="room_delete.php?room_id=<?php echo $row_room["room_id"]; ?>">
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