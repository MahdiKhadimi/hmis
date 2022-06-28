<?php require_once("../../config/connection.php"); ?>
<?php

	$year = getValue($_GET["absent_year"]);
	$month = getValue($_GET["absent_month"]);
	$staff_id = getValue($_GET["staff_id"]);
	$attendance = mysqli_query($con, "SELECT * FROM attendance WHERE staff_id = $staff_id AND absent_year = $year AND absent_month = $month");
	$row_attendance = mysqli_fetch_assoc($attendance);
	$staff = mysqli_query($con,"SELECT * FROM staff");




?>

<?php require_once("../layouts/header.php"); ?>

<h2>Attendance Detail</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New attendance has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected attendance has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected attendance has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected attendance!
	</div>
<?php } ?>



<table class="table table-striped">
	<tr>
		<th>Date</th>
		<th>Hours</th>
		<th width="30">Edit</th>
		<th width="30">Delete</th>
	</tr>

	<?php $total = 0; do { ?>
	<tr>
		<td><?php echo $row_attendance["absent_year"]; ?>-<?php echo $row_attendance["absent_month"]; ?>-<?php echo $row_attendance["absent_day"]; ?></td>
		<td data-toggle="modal" data-target="#myModal">
			<?php echo $row_attendance["hours"]; ?> hrs 
		</td>
		<?php $total += $row_attendance["hours"]; ?>
		<td align="center">
			<a href="attendance_edit.php?staff_id=<?php echo $row_attendance["staff_id"]; ?>&absent_year=<?php echo $row_attendance["absent_year"]; ?>&absent_month=<?php echo $row_attendance["absent_month"]; ?>&absent_day=<?php echo $row_attendance["absent_day"]; ?>">
				<span class="glyphicon glyphicon-edit"></span>
			</a>
		</td>
		<td align="center">
			<a class="delete" href="attendance_delete.php?staff_id=<?php echo $row_attendance["staff_id"]; ?>&absent_year=<?php echo $row_attendance["absent_year"]; ?>&absent_month=<?php echo $row_attendance["absent_month"]; ?>&absent_day=<?php echo $row_attendance["absent_day"]; ?>">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	</tr>
	<?php } while($row_attendance = mysqli_fetch_assoc($attendance)); ?>
	
	<tr>
		<td><b>Total</b></td>
		<td><b><?php echo $total; ?> hrs</b></td>
		<td></td>
		<td></td>
	</tr>
	
</table>





<?php require_once("../layouts/footer_mis.php"); ?>