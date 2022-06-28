<?php require_once("../../config/connection.php"); ?>
<?php
       //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	   checkLevel(4, 9, 9, 9, 9, 9, 9, 9, 9, 9);
    //get specific room and showing in the form 
	if(isset($_GET['room_id'])){
	$room_id = getValue($_GET["room_id"]);	
     $room = mysqli_query($con,"SELECT * FROM room WHERE room_id=$room_id");
	 $row_room = mysqli_fetch_assoc($room);
	}

	//update room
	 $departments = mysqli_query($con,"SELECT * FROM department");
	if(isset($_POST["room_no"])) {
		$room_no = getValue($_POST["room_no"]);
		$room_type = getValue($_POST["room_type"]);
		$department_id = getValue($_POST["department_id"]);
		$capacity = getValue($_POST["capacity"]);
	
		$result = mysqli_query($con, "UPDATE room SET  room_no='$room_no',room_type='$room_type',department_id=$department_id,capacity='$capacity' WHERE room_id=$room_id");
		if($result) {
			header("location:room_list.php?edit=done");
		}
		else {
			header("location:room_edit.php?error=notedit&room_id=$room_id");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Edit new room</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not edit new room!
			</div>
		<?php } ?>
	
		<form method="post">
			
			<div class="input-group">
				<span class="input-group-editon">
					Room Number:
				</span>
				<input type="text" class="form-control" name="room_no" value="<?php echo $row_room['room_no'];?> ">
			</div>
			<div class="input-group">
				<span class="input-group-editon">
					Room Type:
				</span>
				<input type="text" class="form-control" name="room_type" value="<?php echo $row_room['room_type'];?>">
			</div>
			<div class="input-group">
				<span class="input-group-editon">
					Capacity:
				</span>
				<input type="number" class="form-control" name="capacity" value="<?php echo $row_room['capacity']; ?>" >
			</div>
			<div class="input-group">
				<span class="input-group-editon">
					Department:
				</span>
				<select name="department_id" class="form-control">
					<?php while($row_department=mysqli_fetch_assoc($departments)) { ?>
						<option <?php if($row_department['department_id']==$row_room['department_id']) {echo "selected";} ?> value="<?php echo $row_department['department_id']?>"><?php echo $row_department['department_name']?></option>
				    <?php } ?>		
						
				</select>
				
			</div>
			
			<input type="submit" class="btn btn-primary" value="edit room">
			
		</form>
		
	</div>

</div>

</div>

<?php require_once("../layouts/footer_mis.php"); ?>