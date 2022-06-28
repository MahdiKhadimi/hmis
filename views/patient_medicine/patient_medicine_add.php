<?php require_once("../../config/connection.php"); ?>
<?php require_once("../income/income_add.php"); ?>
<?php

     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(2, 9, 9, 9, 9, 9, 9, 9, 9, 2);
    $patient = mysqli_query($con,"SELECT * FROM patient");

	$medicine = mysqli_query($con,"SELECT * FROM medicine");
	
	if(isset($_POST["medicine_id"])) {
		$patient_id = getValue($_POST["patient_id"]);
		$patient_id=explode("-",$patient_id);
		$patient_id=$patient_id[0];

		$medicine_id = getValue($_POST["medicine_id"]);
		$medicine_id= explode("-",$medicine_id);
		$medicine_id=$medicine_id[0];

		$quantity = getValue($_POST["quantity"]);
		$unit_price = getValue($_POST["unit_price"]);
		$total_price = getValue($_POST["total_price"]);
		$apply_date = getValue($_POST["apply_date"]);
	;	
		$result = mysqli_query($con, "INSERT INTO patient_medicine VALUES (NULL, $patient_id,$medicine_id,$quantity,'$unit_price',$total_price, '$apply_date')");
		
		if($result) {
			
			// insert data into income table 
			incomeAdd($patient_id,$total_price,$unit_price,'medicine',$apply_date); 
    
			header("location:patient_medicine_list.php?add=done");
		}
		else {
			header("location:patient_medicine_add.php?error=notadd");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Add New medicine</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not add new medicine!
			</div>
		<?php } ?>
	
		<form method="post">
			
		<div class="input-group">
				<span class="input-group-addon">
					 Patient:
				</span>
				<input type="text" list="patient" class="form-control" name="patient_id">
				<datalist id="patient">
					<?php while($row_patient=mysqli_fetch_assoc($patient) ) { ?>
					
						<option value="<?php echo $row_patient['patient_id']; ?>-<?php echo $row_patient['firstname'];?> <?php echo $row_patient['lastname'];?> "/>
				    <?php } ?>		
					
				</datalist>

		 </div>

		 <div class="input-group">
				<span class="input-group-addon">
					 medicine:
				</span>
				<input type="text" list="medicine" class="form-control" name="medicine_id">
				<datalist id="medicine">
					<?php while($row_medicine=mysqli_fetch_assoc($medicine) ) { ?>
					
						<option value="<?php echo $row_medicine['medicine_id']; ?>-<?php echo $row_medicine['medicine_name'];?> "/>
				    <?php } ?>		
					
				</datalist>

		 </div>

			
		
			<div class="input-group">
				<span class="input-group-addon">
				   Quantity:
				</span>
				<input type="number" class="form-control" name="quantity">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Unit Price
				</span>
				<select name="unit_price" class="form-control">
					<option >AFG</option>
					<option >USD</option>
			    </select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Total Price:
				</span>
				<input type="number" class="form-control" name="total_price">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Apply Date:
				</span>
				<input type="text" class="form-control" name="apply_date" id="apply_date">
			</div>
		
			
			
			
			<input type="submit" class="btn btn-primary" value="Add medicine">
			
		</form>
		
	</div>

</div>

</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "apply_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });

	
</script>

<?php require_once("../layouts/footer_mis.php"); ?>