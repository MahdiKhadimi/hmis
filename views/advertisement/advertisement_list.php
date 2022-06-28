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

	$alladvertisement = mysqli_query($con, "SELECT * FROM advertisement");
	$row_alladvertisement = mysqli_fetch_assoc($alladvertisement);
	
	$totalrows = mysqli_num_rows($alladvertisement);
	$rows_per_page = 2;
	$totalpage = ceil($totalrows / $rows_per_page);

	$offset = ($page - 1) * $rows_per_page;
	$advertisement= mysqli_query($con,"SELECT * FROM advertisement ORDER BY advertisement_id ASC LIMIT $offset,$rows_per_page");
	$row_advertisement = mysqli_fetch_assoc($advertisement);

?>
<?php require_once("../layouts/header.php"); ?>

<a href="#" id="print" class="noprint btn btn-primary pull-right">
	<span class="glyphicon glyphicon-print"></span> 
	Print
</a>

<a href="advertisement_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New
</a>

<h2>advertisement List</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New advertisement has been successfully added!
	</div>
<?php } ?>


<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected advertisement has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected advertisement has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected advertisement!
	</div>
<?php } ?>

<div class="table-responsive">
	
<table class="table table-striped">
	<tr>
		<th>S/N</th>
		<th>Title </th>
		<th>Description</th>
		<th>URL</th>
		<th>Photo</th>
		<th>Start Date</th>
		<th>End Date</th>>
		<th class="noprint">Edit</th>
		<th class="noprint">Delete</th>
	</tr>
   <?php if($row_advertisement) { ?>
	<?php $x = 1; do { ?>
	<tr>
		<td><?php echo $x++; ?></td>
		<td><?php echo $row_advertisement["title"]; ?></td>
		<td><?php echo $row_advertisement["description"]; ?></td>
		<td><?php echo $row_advertisement["url"]; ?></td>
		<td> <a href="<?php echo $row_advertisement['photo'];?> " target="_blank"><img src="<?php echo $row_advertisement["photo"]; ?>" width="40" class=""></a></td>
		<td><?php echo $row_advertisement["start_date"]; ?></td>
		<td><?php echo $row_advertisement["end_date"]; ?></td>
		<td class="noprint">
			<a href="advertisement_edit.php?advertisement_id=<?php echo $row_advertisement["advertisement_id"]; ?>">
				<span class="glyphicon glyphicon-edit"></span>
			</a>
		</td>
		<td class="noprint">
			<a class="delete" href="advertisement_delete.php?advertisement_id=<?php echo $row_advertisement["advertisement_id"]; ?>">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	</tr>
	<?php } while($row_advertisement = mysqli_fetch_assoc($advertisement)); ?>
	<?php } ?>
</table>
</div>	

<ul class="pagination noprint">
<?php if($page != 1) { ?>
	<li><a href="advertisement_list.php?page=1">
		First 
	</a></li>
<?php } ?>

<?php if($page > 1) { ?>
	<li><a href="advertisement_list.php?page=<?php echo $page-1; ?>">
		Previous 
	</a></li>
<?php } ?>

<?php if($page < $totalpage) { ?>
	<li><a href="advertisement_list.php?page=<?php echo $page+1; ?>">
		Next
	</a></li>
<?php } ?>

<?php if($page != $totalpage) { ?>
	<li><a href="advertisement_list.php?page=<?php echo $totalpage; ?>">
		Last
	</a></li>
<?php } ?>
</ul>

<br>

<ul class="pagination noprint">
<?php for($x=1; $x<=$totalpage; $x++) { ?>
	<li>
		<?php if($x != $page) { ?>
			<a href="advertisement_list.php?page=<?php echo $x; ?>">
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