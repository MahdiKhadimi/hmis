<?php require_once("../../config/connection.php"); ?>
<?php
    //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	checkLevel(2, 2, 9, 9, 9, 9, 9, 9, 9, 9);	



	
	if(isset($_POST["service_name"])) {
		$service_name = getValue($_POST["service_name"]);
		$description = getValue($_POST["description"]);
		$amount = getValue($_POST["amount"]);
		$currency = getValue($_POST["currency"]);
		$timing= getValue($_POST["timing"]);
		// getting image and store in the disk 
		if($_FILES["photo"]["name"] != "") { 
		
			$filetype = $_FILES["photo"]["type"];
			
			if($filetype == "image/jpeg" || $filetype == "image/png" || $filetype == "image/gif") {
				if($_FILES["photo"]["size"] <= 4 * 1024 * 1024) {		
					$path = "../../images/service/" . time() . $_FILES["photo"]["name"];		
					$result = move_uploaded_file($_FILES["photo"]["tmp_name"], $path);
					
					if(!$result) {
						header("location:service_add.php?upload=failed");
					}
				}
				else {
					header("location:service_add.php?filesize=invalid");
				}
			}
			else {
				header("location:service_add.php?filetype=invalid");
			}		
		}
		else {
			if($gender == 0) {
				$path = "../../images/service/user_m.png";
			}
			else {
				$path = "../../images/service/user_f.png";
			}
		}
		
		$result =mysqli_query($con, "INSERT INTO service VALUES (NULL, '$service_name', '$description',$amount,'$currency','$path','$timing')");
		if($result) {
			header("location:service_list.php?add=done");
		}
		else {
			header("location:service_add.php?error=notadd");
		}
		
		
	}

?>
<?php require_once("../layouts/header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Add New service</h1>
	</div>
	
	<div class="panel-body">
	
		<?php if(isset($_GET["filetype"])) { ?>
			<div class="alert alert-warning">
				Invalid file type (Choose only jpg, png, gif)!
			</div>
		<?php } ?>
		
		<?php if(isset($_GET["filesize"])) { ?>
			<div class="alert alert-warning">
				Invalid file size (maximum allowed size is 4 MB)!
			</div>
		<?php } ?>
		
		<?php if(isset($_GET["upload"])) { ?>
			<div class="alert alert-danger">
				Could not upload service photo! Please try again!
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
					Service Name:
				</span>
				<input required type="text" name="service_name" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Description:
				</span>
				<textarea name="description" class="form-control" cols="30" rows="10">

				</textarea>
			</div>
		</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="input-group">
				<span class="input-group-addon">
					Amount:
				</span>
				<input required type="text" name="amount" class="form-control">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					Currency:
				</span>
				<select name="currency" class="form-control" >
					<option >AFG</option>
					<option >USD</option>
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					Photo:
				</span>
				<input type="file" name="photo" class="form-control">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					Timing:
				</span>
				<input required type="text" name="timing" class="form-control">
			</div>
				
			<input type="submit" value="Register service" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>


<?php require_once("../layouts/footer_mis.php"); ?>