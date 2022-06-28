<?php require_once("../../config/connection.php"); ?>
<?php
         //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(1, 9, 9, 9, 9, 9, 9, 9, 9, 1);
    // this code use to make migration 
     $patients = mysqli_query($con,"SELECT * FROM patient");
	 $all_patient = mysqli_num_rows($patients);
	 $row_perpage =5;
     $total_page = ceil(($all_patient/$row_perpage));
	
    if(isset($_GET["page"])){
	    $page = getValue($_GET["page"]);
	}else{
		$page= $total_page;
	 }
   
    $offset=($page-1)*$row_perpage;
	$patient = mysqli_query($con, "SELECT * FROM patient LIMIT $offset,$row_perpage");
   



?>
<?php require_once("../layouts/header.php"); ?>

<a href="#" id="print" class="noprint btn btn-primary pull-right">
	<span class="glyphicon glyphicon-print"></span> 
	Print
</a>

<a href="patient_add.php"  class="noprint btn btn-primary pull-right" style="margin-right:5px;">
	Add New
</a>

<h2>patient List</h2>

<?php if(isset($_GET["add"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		New patient has been successfully added!
	</div>
<?php } ?>

<?php if(isset($_GET["edit"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient has been successfully updated!
	</div>
<?php } ?>

<?php if(isset($_GET["delete"])) { ?>
	<div class="alert alert-success alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Selected patient has been successfully deleted!
	</div>
<?php } ?>

<?php if(isset($_GET["error"])) { ?>
	<div class="alert alert-danger alert-dismissable">
		<button class="close" data-dismiss="alert" area-hidden="true">&times;</button>
		Could not delete selected patient!
	</div>
<?php } ?>

<table class="table table-striped">
	<tr>
		<th>S/N</th>
		<th>ID</th>
		<th>patient Name</th>
		<th>Phone</th>
		<th>Gender</th>
		<th>Age</th>
		<th>Address</th>	
		<th>History</th>	
		<th class="noprint">Edit</th>
		<th class="noprint">Delete</th>
	</tr>
   
	<?php $x = 1; while($row_patient = mysqli_fetch_assoc($patient)) { ?>
	<tr>
		<td><?php echo $x++; ?></td>
		<td><?php echo $row_patient["patient_id"]; ?></td>
		<td><?php echo $row_patient["firstname"]; ?> <?php echo $row_patient["lastname"]; ?></td>
		<td><?php echo $row_patient["phone"]; ?></td>
		<td><?php echo $row_patient["gender"]==0?"male":"female" ; ?></td>
		<td><?php echo date("Y")-$row_patient["birth_year"]; ?></td>
		<td><?php echo $row_patient["address"]; ?></td>
		<td><?php echo $row_patient["history"]; ?></td>
		
		<td class="noprint">
			<a href="patient_edit.php?patient_id=<?php echo $row_patient["patient_id"]; ?>" >
				<span class="glyphicon glyphicon-edit"></span>
			</a>
		</td>
		<td class="noprint">
			<a class="delete" href="patient_delete.php?patient_id=<?php echo $row_patient["patient_id"]; ?>">
				<span class="glyphicon glyphicon-trash"></span>
			</a>
		</td>
	</tr>
	<?php } ?>

	<!--  pagination links  -->
	<caption>
		<ul class="pagination">
		   <?php if($page!=1){ ?>
				<li class="page-item"><a href="patient_list.php?page=1" class="page-link">first</a></li>
		    <?php } ?>	
			<?php for($i=1;$i<=$total_page;$i++) { if($i!=$page) {  ?> 

		       <li class="page-item"><a href="patient_list.php?page=<?php echo $i;?>" class="page-link"><?php echo $i;?></a></li>
    		   
			   <?php } } ?>
		    <?php if($page<$total_page) { ?>
				<li class="page-item"><a href="patient_list.php?page=<?php echo $page;?>" class="page-link">last</a></li>
           <?php } ?>
      	</ul>
</caption>
</table>
	



<?php require_once("../layouts/footer_mis.php"); ?>