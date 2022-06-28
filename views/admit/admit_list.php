<?php require_once("../../config/connection.php"); ?>
<?php


	$admit = mysqli_query($con, "SELECT * FROM ((admit
	INNER JOIN patient ON admit.patient_id=patient.patient_id )
	 INNER JOIN room ON admit.room_id=room.room_id )
	 ORDER BY admit_id DESC");
	
	
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>admit List
<a href="admit_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New 
</a>
</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New admit has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected admit has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected admit has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected admit!
	</div>
<?php } ?>




<table class="table table-striped">
	<tr>
		<th>S/No</th>
		<th>Patient </th>
		<th>Room</th>
		<th>In Date</th>
		<th>Out Date </th>
		<th>Status</th>

		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php $x=1; while($row_admit = mysqli_fetch_assoc($admit)) { ?>
		<tr>
			<td><?php echo $x++?></td>
			<td><?php echo $row_admit["firstname"]; ?> <?php echo $row_admit["lastname"]; ?></td>
			<td><?php echo $row_admit["room_no"]; ?></td>
			<td><?php echo $row_admit["in_date"]; ?></td>
			<td><?php echo $row_admit["out_date"]; ?></td>
			<td><?php echo $row_admit["status"]; ?></td>
			<td>
				<a href="admit_edit.php?admit_id=<?php echo $row_admit["admit_id"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="admit_delete.php?admit_id=<?php echo $row_admit["admit_id"]; ?>">
					<span class="glyphicon glyphicon-trash"></span>
				</a>
			</td>
		</tr>
	<?php } ?>
	

	
</table>



<?php require_once("../layouts/footer_mis.php"); ?>