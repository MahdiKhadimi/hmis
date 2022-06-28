<?php require_once("../../config/connection.php"); ?>
<?php

	$condition = "";

	if(isset($_GET["q"])) {
		$search = getValue($_GET["q"]);
		$condition = " WHERE staff.firstname LIKE '%$search% ' ";
	}
	
	$overtime = mysqli_query($con, "SELECT * FROM overtime 
	  INNER JOIN staff ON overtime.staff_id=staff.staff_id
  	$condition ORDER BY overtime_year DESC, overtime_month DESC");	

	$totalRows_overtime = mysqli_num_rows($overtime);
	
?>
<?php require_once("../layouts/header.php"); ?>

<h2>overtime List
<a href="overtime_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New 
</a>
</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New overtime has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected overtime has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected overtime has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected overtime!
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
	<b>Total Result: <?php echo $totalRows_overtime; ?> </b>
</div>
<?php } ?>


<?php if($totalRows_overtime > 0) { ?>
<table class="table table-striped">
	<tr>
		<th>S/No</th>
		<th>Staff Name </th>
		<th>Photo</th>
		<th>Year</th>
		<th>Month</th>
		<th>Day</th>
		<th>Hours</th>
		<th>Edit</th>
		<th>Delete</th>
	</tr>
	
	<?php $x=1; while($row_overtime = mysqli_fetch_assoc($overtime)) { ?>
		<tr>
			<td><?php echo $x++;?></td>
			<td> <?php echo $row_overtime["firstname"]; ?>  <?php echo $row_overtime["lastname"]; ?> </td>
			<td><img src="<?php echo $row_overtime['photo'];?>" style="width:40px;"></td>
			<td><?php echo $row_overtime["overtime_year"]; ?></td>
			<td><?php echo $row_overtime["overtime_month"]; ?></td>
			<td><?php echo $row_overtime["overtime_day"]; ?></td>
			<td><?php echo $row_overtime["hours"]; ?></td>
			<td>
				<a href="overtime_edit.php?staff_id=<?php echo $row_overtime["staff_id"]; ?>&overtime_year=<?php echo $row_overtime["overtime_year"]; ?>&overtime_month=<?php echo $row_overtime["overtime_month"]; ?>&overtime_day=<?php echo $row_overtime["overtime_day"]; ?>">
					<span class="glyphicon glyphicon-edit"></span>
				</a>
			</td>
			<td>
				<a class="delete" href="overtime_delete.php?staff_id=<?php echo $row_overtime["staff_id"]; ?>&overtime_year=<?php echo $row_overtime["overtime_year"]; ?>&overtime_month=<?php echo $row_overtime["overtime_month"]; ?>&overtime_day=<?php echo $row_overtime["overtime_day"]; ?>">
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