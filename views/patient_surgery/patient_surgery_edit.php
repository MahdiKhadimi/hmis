<?php require_once("../../config/connection.php"); ?>
<?php

        //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(4, 9, 9, 9, 9, 9, 9, 9, 9, 4);
    $patient = mysqli_query($con,"SELECT * FROM patient");
    $staff = mysqli_query($con,"SELECT * FROM staff");
	$surgery = mysqli_query($con,"SELECT * FROM surgery");

    $patient_surgery_id="";
    if(isset($_GET['patient_surgery_id'])){
	$patient_surgery_id=getValue($_GET['patient_surgery_id']);
	

	// getting information form surgery, staff, patient tables 
	$patient_surgery = mysqli_query($con, "SELECT
	patient_surgery_id,
	patient_surgery.patient_id,
	patient_surgery.staff_id,
	patient_surgery.surgery_id,
	 patient.firstname as p_firstname, patient.lastname as p_lastname,
     surgery.surgery_name,surgery_date, surgery_result,
	 staff.firstname as s_firstname, staff.lastname as s_lastname
	 FROM 
	(((patient_surgery 
	  INNER JOIN patient ON patient_surgery.patient_id=patient.patient_id)
	  INNER JOIN surgery ON patient_surgery.surgery_id=surgery.surgery_id)
	  INNER JOIN staff ON patient_surgery.staff_id=staff.staff_id)
	  WHERE patient_surgery_id=$patient_surgery_id
	   ORDER BY patient_surgery_id DESC");
	 $row_patient_surgery= mysqli_fetch_assoc($patient_surgery);
}
	if(isset($_POST["surgery_id"])) {
		$patient_id = getValue($_POST["patient_id"]);
		$patient_id=explode("-",$patient_id);
		$patient_id=$patient_id[0];

		$surgery_id = getValue($_POST["surgery_id"]);
		$surgery_id= explode("-",$surgery_id);
		$surgery_id=$surgery_id[0];

		$staff_id = getValue($_POST["staff_id"]);
		$staff_id= explode("-",$staff_id);
		$staff_id=$staff_id[0];

		$surgery_date = getValue($_POST["surgery_date"]);
		$surgery_result = getValue($_POST["surgery_result"]);
		

		$result = mysqli_query($con, "UPDATE  patient_surgery SET surgery_id=$surgery_id,patient_id=$patient_id,staff_id=$staff_id, surgery_date='$surgery_date', surgery_result='$surgery_result' WHERE patient_surgery_id=$patient_surgery_id");
		
		if($result) {
			header("location:patient_surgery_list.php?edit=done");
		}
		else {
			header("location:patient_surgery_edit.php?error=notedit");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Edit surgery</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could Not Edit Surgery!
			</div>
		<?php } ?>
	
		<form method="post">
			
		<div class="input-group">
				<span class="input-group-addon">
					 Patient:
				</span>
				<input type="text" value="<?php echo $row_patient_surgery['patient_id']?>-<?php echo $row_patient_surgery['p_firstname']?> <?php echo $row_patient_surgery['p_lastname']?>" list="patient" class="form-control" name="patient_id">
				<datalist id="patient">
					<?php while($row_patient=mysqli_fetch_assoc($patient) ) { ?>
					
						<option value="<?php echo $row_patient['patient_id']; ?>-<?php echo $row_patient['firstname'];?> <?php echo $row_patient['lastname'];?> "/>
				    <?php } ?>		
					
				</datalist>

		 </div>

		 <div class="input-group">
				<span class="input-group-addon">
					 surgery:
				</span>
				<input type="text"  value="<?php echo $row_patient_surgery['surgery_id']?>-<?php echo $row_patient_surgery['surgery_name']?>" list="surgery" class="form-control" name="surgery_id">
				<datalist id="surgery">
					<?php while($row_surgery=mysqli_fetch_assoc($surgery) ) { ?>
					
						<option value="<?php echo $row_surgery['surgery_id']; ?>-<?php echo $row_surgery['surgery_name'];?> "/>
				    <?php } ?>		
					
				</datalist>

		 </div>
		 <div class="input-group">
				<span class="input-group-addon">
					 Doctor:
				</span>
				<input type="text"  value="<?php echo $row_patient_surgery['staff_id']?>-<?php echo $row_patient_surgery['s_firstname']?> <?php echo $row_patient_surgery['s_lastname']?>" list="staff" class="form-control" name="staff_id">
				<datalist id="staff">
					<?php while($row_staff=mysqli_fetch_assoc($staff) ) { ?>
					
						<option value="<?php echo $row_staff['staff_id']; ?>-<?php echo $row_staff['firstname'];?> <?php echo $row_staff['lastname'];?> "/>
				    <?php } ?>		
					
				</datalist>

		 </div>

			
		
			<div class="input-group">
				<span class="input-group-addon">
				   Date:
				</span>
				<input type="text"  value="<?php echo $row_patient_surgery['surgery_date']?>" class="form-control" name="surgery_date" id="surgery_date">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   surgery Result:
				</span>
				<input type="text" value="<?php echo $row_patient_surgery['surgery_result']?>" class="form-control"  class="form-control" name="surgery_result">
			</div>
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Save Change">
			
		</form>
		
	</div>

</div>

</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "surgery_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });

	
</script>

<?php require_once("../layouts/footer_mis.php"); ?>