<?php require_once("../../config/connection.php"); ?>
<?php
      //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	  checkLevel(2, 9, 9, 9, 9, 9, 9, 9, 9, 9);
	 $departments = mysqli_query($con,"SELECT * FROM department");
	if(isset($_POST["room_no"])) {
		$room_no = getValue($_POST["room_no"]);
		$room_type = getValue($_POST["room_type"]);
		$department_id = getValue($_POST["department_id"]);
		$capacity = getValue($_POST["capacity"]);
		
		$result = mysqli_query($con, "INSERT INTO room VALUES (NULL, '$room_no','$room_type',$department_id,'$capacity')");
		
		if($result) {
			header("location:room_list.php?add=done");
		}
		else {
			header("location:room_add.php?error=notadd");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Add New room</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not add new room!
			</div>
		<?php } ?>
	
		<form method="post">
			
			<div class="input-group">
				<span class="input-group-addon">
					room Number:
				</span>
				<input type="text" class="form-control" name="room_no">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					room Type:
				</span>
				<input type="text" class="form-control" name="room_type">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					Capacity:
				</span>
				<input type="number" class="form-control" name="capacity">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					Department:
				</span>
				<select name="department_id" class="form-control">
					<?php while($row_room=mysqli_fetch_assoc($departments)) { ?>
						<option value="<?php echo $row_room['department_id']?>"><?php echo $row_room['department_name']?></option>
				    <?php } ?>		
						
				</select>
				
			</div>
			
			<input type="submit" class="btn btn-primary" value="Add room">
			
		</form>
		
	</div>

</div>

</div>

<?php require_once("../layouts/footer_mis.php"); ?>