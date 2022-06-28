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

	$allnews = mysqli_query($con, "SELECT * FROM news");
	$row_allnews = mysqli_fetch_assoc($allnews);
	
	$totalrows = mysqli_num_rows($allnews);
	$rows_per_page = 2;
	$totalpage = ceil($totalrows / $rows_per_page);

	$offset = ($page - 1) * $rows_per_page;
	$news= mysqli_query($con,"SELECT * FROM news ORDER BY news_id ASC LIMIT $offset,$rows_per_page");
	$row_news = mysqli_fetch_assoc($news);

?>
<?php require_once("../layouts/header.php"); ?>

<a href="#" id="print" class="noprint btn btn-primary pull-right">
	<span class="glyphicon glyphicon-print"></span> 
	Print
</a>

<a href="news_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New
</a>

<h2>news List</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New news has been successfully added!
	</div>
<?php } ?>


<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected news has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected news has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected news!
	</div>
<?php } ?>

<div class="table-responsive">
	
<table class="table table-striped">
	<tr>
		<th>S/N</th>
		<th>Title</th>
		<th>Description</th>
		<th>News File </th>
		<th>News Date</th>
		<th>Source</th>
		<th>Visit</th>
		<th class="noprint">Edit</th>
		<th class="noprint">Delete</th>
	</tr>
   <?php if($row_news) { ?>
	<?php $x = 1; do { ?>
	<tr>
		<td><?php echo $x++; ?></td>
		<td><?php echo $row_news["title"]; ?></td>
		<td><?php echo $row_news["description"]; ?></td>
		<td> <a href="<?php echo $row_news['news_file'];?> " target="_blank"><img src="<?php echo $row_news["news_file"]; ?>" width="40" class=""></a></td>
		<td><?php echo $row_news["news_date"]; ?></td>
		<td><?php echo $row_news["source"]; ?></td>
		<td><?php echo $row_news["visit"]; ?></td>	
		<td class="noprint">
			<a href="news_edit.php?news_id=<?php echo $row_news["news_id"]; ?>">
				<span class="glyphicon glyphicon-edit"></span>
			</a>
		</td>
		<td class="noprint">
			<a class="delete" href="news_delete.php?news_id=<?php echo $row_news["news_id"]; ?>">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	</tr>
	<?php } while($row_news = mysqli_fetch_assoc($news)); ?>
	<?php } ?>
</table>
</div>	

<ul class="pagination noprint">
<?php if($page != 1) { ?>
	<li><a href="news_list.php?page=1">
		First 
	</a></li>
<?php } ?>

<?php if($page > 1) { ?>
	<li><a href="news_list.php?page=<?php echo $page-1; ?>">
		Previous 
	</a></li>
<?php } ?>

<?php if($page < $totalpage) { ?>
	<li><a href="news_list.php?page=<?php echo $page+1; ?>">
		Next
	</a></li>
<?php } ?>

<?php if($page != $totalpage) { ?>
	<li><a href="news_list.php?page=<?php echo $totalpage; ?>">
		Last
	</a></li>
<?php } ?>
</ul>

<br>

<ul class="pagination noprint">
<?php for($x=1; $x<=$totalpage; $x++) { ?>
	<li>
		<?php if($x != $page) { ?>
			<a href="news_list.php?page=<?php echo $x; ?>">
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