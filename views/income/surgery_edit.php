<?php require_once("../../config/connection.php"); ?>
<?php
     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(4, 9, 9, 9, 4, 9, 9, 9, 9, 9);
    // getting departments 
	$departments = mysqli_query($con,"SELECT * FROM department ORDER BY department_name ASC");
    if(isset($_GET['surgery_id'])){
		$surgery_id = getValue($_GET['surgery_id']);
        
		    
		$surgery = mysqli_query($con,"SELECT * 	FROM surgery WHERE surgery_id=$surgery_id");
	    $row_surgery = mysqli_fetch_assoc($surgery);
	if(isset($_POST["surgery_name"])) {
		$surgery_name = getValue($_POST["surgery_name"]);
		$department_id = getValue($_POST["department_id"]);
		$price = getValue($_POST["price"]);

		
		$result = mysqli_query($con, "UPDATE surgery SET surgery_name='$surgery_name', department_id= $department_id,price=$price WHERE surgery_id=$surgery_id");
		
		if($result) {
			header("location:surgery_list.php?edit=done");
		}
		else {
			header("location:surgery_add.php?error=notedit");
		}
		
	}
}	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Add New surgery</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not add new surgery!
			</div>
		<?php } ?>
	
		<form method="post">
			
			<div class="input-group">
				<span class="input-group-addon">
					 Name:
				</span>
				<input type="text" value="<?php echo $row_surgery['surgery_name']?>" class="form-control" name="surgery_name">
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
				   Department
				</span>
				<select name="department_id" class="form-control">
					<?php while($row_department = mysqli_fetch_assoc($departments)) { ?>
						<option <?php if($row_department['department_id']==$row_surgery['department_id'])  {echo "selected";} ?> value="<?php echo $row_department['department_id']?>"><?php echo $row_department['department_name']?></option>
					<?php } ?>		
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Price:
				</span>
				<input type="number"value="<?php echo $row_surgery['price']?>" class="form-control" name="price" >
			</div>
		
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Save changes">
			
		</form>
		
	</div>

</div>

</div>



<?php require_once("../layouts/footer_mis.php"); ?>