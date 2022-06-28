<?php require_once("../../config/connection.php"); ?>
<?php
  //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
  checkLevel(2, 9, 9, 9, 9, 9, 2, 9, 9, 9);	
	if(isset($_POST["medicine_name"])) {
		$medicine_name = getValue($_POST["medicine_name"]);
		$description = getValue($_POST["description"]);
		$form = getValue($_POST["form"]);
		$quantity = getValue($_POST["quantity"]);
		$price = getValue($_POST["price"]);
		$price_unit = getValue($_POST["price_unit"]);
		$expire_date = getValue($_POST["expire_date"]);			
		$result = mysqli_query($con, "INSERT INTO medicine VALUES (NULL, '$medicine_name', '$description','$form',$quantity, $price, '$price_unit','$expire_date')");
		
		if($result) {
			header("location:medicine_list.php?add=done");
		}
		else {
			header("location:medicine_add.php?error=notadd");
		}
		
	}
	
?>
<?php require_once("../layouts/header.php"); ?>


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
	     <div class="col-md-6">		
			<div class="input-group">
				<span class="input-group-addon">
					 Name:
				</span>
				<input type="text" class="form-control" name="medicine_name">
			</div>
			
		
			<div class="input-group">
				<span class="input-group-addon">
				   Price:
				</span>
				<input type="number" class="form-control" name="price">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					 Price Unit:
				</span>
				<select name="price_unit" class="form-control">
                   <option >AFG</option>
                   <option >USD</option> 
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Quantity:
				</span>
				<input type="number" class="form-control" name="quantity">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
				   Expire Date:
				</span>
				<input type="text" class="form-control" name="expire_date" id="medicine_date">
			</div>


			<div class="input-group">
				<span class="input-group-addon">
					 Form:
				</span>
				<select name="form" id="" class="form-control">
                   <option >Capsule</option>
                   <option >Syrup</option>
                   <option >Injection</option>
				</select>
			</div>
			<
	    </div>	
		<div class="col-md-6">	
			
		<div class="input-group">
				<span class="input-group-addon">
				   Description:
				</span>
				
				<textarea name="description" id="" cols="30" rows="10" class="form-control"></textarea>
		</div>
					
		  <input type="submit" class="btn btn-primary" value="Add medicine">
		</div>	
		</form>
		
	</div>

</div>





<script type="text/javascript">
	Calendar.setup({
        inputField      :    "medicine_date",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
</script>

<?php require_once("../layouts/footer_mis.php"); ?>