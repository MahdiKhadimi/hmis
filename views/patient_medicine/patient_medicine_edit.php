<?php require_once("../../config/connection.php"); ?>
<?php
        //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(4, 9, 9, 9, 9, 9, 9, 9, 9,4);
    $patient = mysqli_query($con,"SELECT * FROM patient");

	$medicine = mysqli_query($con,"SELECT * FROM medicine");
	$patient_medicine_id="";
   if(isset($_GET['patient_medicine_id'])){
	$patient_medicine_id = getValue($_GET['patient_medicine_id']);


  
   
	$patient_medicine = mysqli_query($con,"SELECT * FROM ((patient_medicine 
	INNER JOIN patient ON patient_medicine.patient_id = patient.patient_id)
	INNER JOIN medicine ON patient_medicine.medicine_id = medicine.medicine_id) 
	WHERE patient_medicine_id= $patient_medicine_id
	");
    $row_patient_medicine = mysqli_fetch_assoc($patient_medicine);
 }
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
	
		
		$result = mysqli_query($con, "UPDATE  patient_medicine SET patient_id=$patient_id,medicine_id=$medicine_id,quantity=$quantity,unit_price='$unit_price',total_price=$total_price, apply_date='$apply_date' WHERE patient_medicine_id=$patient_medicine_id ");
		
		if($result) {
			header("location:patient_medicine_list.php?add=done");
		}
		else {
			header("location:patient_medicine_edit.php?error=notadd&patient_medicine_id=$patient_medicine_id");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>

<div class="col-lg-8 col-md-8 col-ms-8 col-xs-12 col-lg-offset-2 col-md-offset-2 col-sm-offset-2 col-xs-offset-0">

<div class="panel panel-primary">
	
	<div class="panel-heading">
		<h1>Edit medicine</h1>
	</div>

	<div class="panel-body">
	
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Could not edit medicine!
			</div>
		<?php } ?>
	
		<form method="post">
			
		<div class="input-group">
				<span class="input-group-addon">
					 Patient:
				</span>
				<input type="text" value="<?php echo $row_patient_medicine['patient_id']?>-<?php echo $row_patient_medicine['firstname']?> <?php echo $row_patient_medicine['lastname']?>" list="patient" class="form-control" name="patient_id">
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
				<input type="text" value=" <?php echo $row_patient_medicine['medicine_id']?>-<?php echo $row_patient_medicine['medicine_name']?>" list="medicine" class="form-control" name="medicine_id">
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
				<input type="number" value="<?php echo $row_patient_medicine['quantity'];?>" class="form-control" name="quantity">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Unit Price
				</span>
				<select name="unit_price" class="form-control">
					<option <?php if($row_patient_medicine['unit_price']=="AFG"){echo "selected";} ?> >AFG</option>
					<option <?php if($row_patient_medicine['unit_price']=="USD"){echo "selected";} ?>>USD</option>
			    </select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Total Price:
				</span>
				<input type="number" value="<?php echo $row_patient_medicine['total_price']; ?>" class="form-control" name="total_price">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Apply Date:
				</span>
				<input type="text" value="<?php echo $row_patient_medicine['apply_date']; ?>" class="form-control" name="apply_date" id="apply_date">
			</div>
		
			
			
			
			<input type="submit" class="btn btn-primary" value="save change">
			
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