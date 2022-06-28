<?php require_once("../../config/connection.php"); ?>
<?php
     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(1, 1, 9, 9, 9, 9, 9, 9, 9, 9);	

	
	if(isset($_GET["page"])) {
		$page = $_GET["page"];
	}
	else {
		$page = 1;
	}

	$allservice = mysqli_query($con, "SELECT * FROM service");
	$row_allservice = mysqli_fetch_assoc($allservice);
	
	$totalrows = mysqli_num_rows($allservice);
	$rows_per_page = 2;
	$totalpage = ceil($totalrows / $rows_per_page);

	$offset = ($page - 1) * $rows_per_page;
	$service= mysqli_query($con,"SELECT * FROM service ORDER BY service_id ASC LIMIT $offset,$rows_per_page");
	$row_service = mysqli_fetch_assoc($service);

?>
<?php require_once("../layouts/header.php"); ?>

<a href="#" id="print" class="noprint btn btn-primary pull-right">
	<span class="glyphicon glyphicon-print"></span> 
	Print
</a>

<a href="service_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New
</a>

<h2>service List</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New service has been successfully added!
	</div>
<?php } ?>


<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected service has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected service has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected service!
	</div>
<?php } ?>

<div class="table-responsive">
	
<table class="table table-striped">
	<tr>
		<th>S/N</th>
		<th>Sevice Name </th>
		<th>Description</th>
		<th>Amount</th>	
		<th>Photo</th>
		<th>Timing</th>
		<th class="noprint">Edit</th>
		<th class="noprint">Delete</th>
	</tr>
   <?php if($row_service) { ?>
	<?php $x = 1; do { ?>
	<tr>
		<td><?php echo $x++; ?></td>
		<td><?php echo $row_service["service_name"]; ?></td>
		<td><?php echo $row_service["description"]; ?></td>
		<td> <?php echo $row_service["amount"]; ?> <?php echo $row_service["currency"]; ?> </td>
		<td> <a href="<?php echo $row_service['photo'];?> " target="_blank"><img src="<?php echo $row_service["photo"]; ?>" width="40" class=""></a></td>
		<td><?php echo $row_service["timing"]; ?></td>
		<td class="noprint">
			<a href="service_edit.php?service_id=<?php echo $row_service["service_id"]; ?>">
				<span class="glyphicon glyphicon-edit"></span>
			</a>
		</td>
		<td class="noprint">
			<a class="delete" href="service_delete.php?service_id=<?php echo $row_service["service_id"]; ?>">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	</tr>
	<?php } while($row_service = mysqli_fetch_assoc($service)); ?>
	<?php } ?>
</table>
</div>	

<ul class="pagination noprint">
<?php if($page != 1) { ?>
	<li><a href="service_list.php?page=1">
		First 
	</a></li>
<?php } ?>

<?php if($page > 1) { ?>
	<li><a href="service_list.php?page=<?php echo $page-1; ?>">
		Previous 
	</a></li>
<?php } ?>

<?php if($page < $totalpage) { ?>
	<li><a href="service_list.php?page=<?php echo $page+1; ?>">
		Next
	</a></li>
<?php } ?>

<?php if($page != $totalpage) { ?>
	<li><a href="service_list.php?page=<?php echo $totalpage; ?>">
		Last
	</a></li>
<?php } ?>
</ul>

<br>

<ul class="pagination noprint">
<?php for($x=1; $x<=$totalpage; $x++) { ?>
	<li>
		<?php if($x != $page) { ?>
			<a href="service_list.php?page=<?php echo $x; ?>">
				<?php echo $x; ?>
			</a>
		<?php } else { ?>
			<a href="#">
				<?php echo $x; ?>
			</a>
		<?php } ?>
	</li>
<?php } ?>
</ul>

<?php require_once("../layouts/footer_mis.php"); ?>