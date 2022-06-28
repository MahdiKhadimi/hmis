<?php require_once("../../config/connection.php"); ?>
<?php
     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(2, 9, 9, 9, 9, 9, 9, 9, 9, 2);
	
	if(isset($_POST["firstname"])) {
		$firstname = getValue($_POST["firstname"]);
		$lastname = getValue($_POST["lastname"]);
		$gender = getValue($_POST["gender"]);
		$birth_year = getValue($_POST["age"]);
		$birth_year =  date("Y")-$birth_year;
		$address = getValue($_POST["address"]);
		$phone = getValue($_POST["phone"]);	
		$history = getValue($_POST["history"]);	
		
	
		$result = mysqli_query($con, "INSERT INTO patient VALUES (NULL, '$firstname', '$lastname','$address','$phone', $gender, $birth_year, '$history')");
		
		if($result) {
			header("location:patient_list.php?add=done");
		}
		else {
			header("location:patient_add.php?error=notadd");
		}
		
		
	}

?>
<?php require_once("../layouts/header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Add New patient</h1>
	</div>
	
	<div class="panel-body">
	
	
		<?php if(isset($_GET["filesize"])) { ?>
			<div class="alert alert-warning">
				Invalid file size (maximum allowed size is 4 MB)!
			</div>
		<?php } ?>
		
		<?php if(isset($_GET["upload"])) { ?>
			<div class="alert alert-danger">
				Could not upload patient photo! Please try again!
			</div>
		<?php } ?>
		
		<?php if(isset($_GET["error"])) { ?>
			<div class="alert alert-danger">
				Registration failed! Please try again!
			</div>
		<?php } ?>
	
		<form method="post" enctype="multipart/form-data">
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			<div class="input-group">
				<span class="input-group-addon">
					Firstname:
				</span>
				<input required type="text" name="firstname" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Lastname:
				</span>
				<input required type="text" name="lastname" class="form-control">
			</div>
			
			<div class="input-group">
				<span class="input-group-addon">
					Gender:
				</span>  &nbsp;
				<label><input checked type="radio" name="gender" value="0"> Male</label> &nbsp;
				<label><input type="radio" name="gender" value="1"> Female</label>
			</div>
					
			<div class="input-group">
				<span class="input-group-addon">
					Age:
				</span>
				<input required type="number" name="age" class="form-control">
			</div>
		    <div class="input-group">
				<span class="input-group-addon">
					Phone:
				</span>
				<input required type="number" name="phone" class="form-control">
			</div>		
			<div class="input-group">
				<span class="input-group-addon">
					Address:
				</span>
				<input required type="text" name="address" class="form-control">
			</div>
		
			
		
			
		
		</div>
		<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			 	
					

			
		   <div class="input-group">
			   <span class="input-group-addon">
				   History
			   </span>
			   <textarea name="history" id="" cols="30" rows="10" class="form-control">

			   </textarea>
		   </div>
			
			
			
		
			
			<input type="submit" value="Register patient" class="btn btn-primary">
			
		</div>
			
		</form>
	</div>
</div>



<?php require_once("../layouts/footer_mis.php"); ?>