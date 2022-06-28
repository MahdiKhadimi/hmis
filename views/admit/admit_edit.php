<?php require_once("../../config/connection.php"); ?>
<?php
	
	  // getting room info 
	  $room = mysqli_query($con,"SELECT * FROM room ");
	  //getting patient info 
	  $patient = mysqli_query($con,"SELECT * FROM patient");
	
	  if(isset($_GET["admit_id"])){
		  $admit_id = getValue($_GET["admit_id"]);

	  
	  $admits = mysqli_query($con,"SELECT * FROM admit INNER JOIN patient ON patient.patient_id=admit.patient_id WHERE admit.admit_id= $admit_id");
      $row_admit = mysqli_fetch_assoc($admits);  

	  

	if(isset($_POST["patient_id"])) {
		$patient_id = getValue($_POST["patient_id"]);
		$patient_id=explode("-",$patient_id);
		$patient_id=$patient_id[0];
	
		$room_id = getValue($_POST["room_id"]);
		
		$in_date = getValue($_POST["in_date"]);
		$out_date = getValue($_POST["out_date"]);
		$status = getValue($_POST["status"]);	

	
	

		
		$result = mysqli_query($con, "UPDATE admit SET patient_id=$patient_id,room_id=$room_id, in_date='$in_date',out_date='$out_date',status='$status' WHERE admit_id=$admit_id");
		
		if($result) {
			header("location:admit_list.php?edit=done");
		}
		else {
			header("location:admit_edit.php?error=notedit&admit_id=$admit_id");
		}
		
	}
}	
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>edit admit</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not edit new admit!
			</div>
		<?php } ?>
	
		<form method="post">
			
			<div class="input-group">
				<span class="input-group-addon">
					 Patient:
				</span>
				<input type="text" name="patient_id" value="<?php echo $row_admit['patient_id'];?>-<?php echo $row_admit['firstname'];?> <?php echo $row_admit['lastname'];?> " list="patient" class="form-control" >
				<datalist id="patient">
					<?php while($row_patient=mysqli_fetch_assoc($patient) ) { ?>
						 
						<option value="<?php echo $row_patient['patient_id'];?>-<?php echo $row_patient['firstname']; ?> <?php echo $row_patient['lastname']; ?>"/>
				    <?php } ?>		
					
				</datalist>

			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
				   Room Number
				</span>
				<select name="room_id" class="form-control">
					 <?php while($row_room=mysqli_fetch_assoc($room) ) {  ?>
						   <option <?php if($row_admit['room_id']==$row_room['room_id']){ echo "selected" ;} ?> value="<?php echo $row_room['room_id'];?>" > <?php echo $row_room['room_no'];?> </option>
				     <?php } ?>		
				</select>
			</div>

			<div class="input-group">
				<span class="input-group-addon">
				   In Date:
				</span>
				<input value="<?php echo $row_admit['in_date']; ?>" type="text" class="form-control" name="in_date" id="in_date">
			</div>

			<div class="input-group">
				<span class="input-group-addon">
				   Out Date:
				</span>
				<input value="<?php echo $row_admit['out_date']; ?>" type="text" class="form-control" name="out_date" id="out_date" >
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Status
				</span>
				<input value="<?php echo $row_admit['status']; ?>" type="text" class="form-control" name="status">
			</div>
								
			<input type="submit" class="btn btn-primary" value="Add admit">
			
		</form>
		
	</div>

</div>

</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "in_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
	Calendar.setup({
        inputField      :    "out_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
	
</script>

<?php require_once("../layouts/footer_mis.php"); ?>