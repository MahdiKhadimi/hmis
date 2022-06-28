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

	$allhistory = mysqli_query($con, "SELECT * FROM history");
	$row_allhistory = mysqli_fetch_assoc($allhistory);
	
	$totalrows = mysqli_num_rows($allhistory);
	$rows_per_page = 2;
	$totalpage = ceil($totalrows / $rows_per_page);

	$offset = ($page - 1) * $rows_per_page;
	$history= mysqli_query($con,"SELECT * FROM history ORDER BY history_id ASC LIMIT $offset,$rows_per_page");
	$row_history = mysqli_fetch_assoc($history);

?>
<?php require_once("../layouts/header.php"); ?>

<a href="#" id="print" class="noprint btn btn-primary pull-right">
	<span class="glyphicon glyphicon-print"></span> 
	Print
</a>

<a href="history_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New
</a>

<h2>history List</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New history has been successfully added!
	</div>
<?php } ?>


<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected history has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected history has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected history!
	</div>
<?php } ?>

<div class="table-responsive">
	
<table class="table table-striped">
	<tr>
		<th>S/N</th>
		<th>Title </th>
		<th>Description</th>
	
		<th>Photo</th>
	
		<th class="noprint">Edit</th>
		<th class="noprint">Delete</th>
	</tr>
   <?php if($row_history) { ?>
	<?php $x = 1; do { ?>
	<tr>
		<td><?php echo $x++; ?></td>
		<td><?php echo $row_history["title"]; ?></td>
		<td><?php echo $row_history["description"]; ?></td>
	
		<td> <a href="<?php echo $row_history['photo'];?> " target="_blank"><img src="<?php echo $row_history["photo"]; ?>" width="40" class=""></a></td>
	
		<td class="noprint">
			<a href="history_edit.php?history_id=<?php echo $row_history["history_id"]; ?>">
				<span class="glyphicon glyphicon-edit"></span>
			</a>
		</td>
		<td class="noprint">
			<a class="delete" href="history_delete.php?history_id=<?php echo $row_history["history_id"]; ?>">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	</tr>
	<?php } while($row_history = mysqli_fetch_assoc($history)); ?>
	<?php } ?>
</table>
</div>	

<ul class="pagination noprint">
<?php if($page != 1) { ?>
	<li><a href="history_list.php?page=1">
		First 
	</a></li>
<?php } ?>

<?php if($page > 1) { ?>
	<li><a href="history_list.php?page=<?php echo $page-1; ?>">
		Previous 
	</a></li>
<?php } ?>

<?php if($page < $totalpage) { ?>
	<li><a href="history_list.php?page=<?php echo $page+1; ?>">
		Next
	</a></li>
<?php } ?>

<?php if($page != $totalpage) { ?>
	<li><a href="history_list.php?page=<?php echo $totalpage; ?>">
		Last
	</a></li>
<?php } ?>
</ul>

<br>

<ul class="pagination noprint">
<?php for($x=1; $x<=$totalpage; $x++) { ?>
	<li>
		<?php if($x != $page) { ?>
			<a href="history_list.php?page=<?php echo $x; ?>">
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