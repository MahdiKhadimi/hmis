<?php require_once("../../config/connection.php"); ?>
<?php
     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(4, 4, 9, 9, 9, 9, 9, 9, 9, 9);	


  if(isset($_GET['service_id'])){
	  $service_id = getValue($_GET['service_id']);
	  $service = mysqli_query($con,"SELECT * FROM service WHERE service_id=$service_id");
     $row_service= mysqli_fetch_assoc($service);
	  
	}
	
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
					unlink($row_service['photo']);
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
			$path=$row_service['photo'];
		}
		
		$result =mysqli_query($con, "UPDATE service SET service_name='$service_name', description='$description',amount=$amount,currency='$currency',photo='$path',timing='$timing' WHERE service_id=$service_id");
		if($result) {
			header("location:service_list.php?add=done");
		}
		else {
			header("location:service_edit.php?error=notadd&service_id=$service_id");
		}
		
		
	}

?>
<?php require_once("../layouts/header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Edit Service</h1>
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
				<input value="<?php echo $row_service['service_name']; ?>" required type="text" name="service_name" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Description:
				</span>
				<textarea name="description" class="form-control" cols="30" rows="10">
                <?php echo $row_service['description'];?>
				</textarea>
			</div>
		</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			<div class="input-group">
				<span class="input-group-addon">
					Amount:
				</span>
				<input value="<?php echo $row_service['amount']; ?>" required type="text" name="amount" class="form-control">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					Currency:
				</span>
				<select name="currency" class="form-control" >
					<option <?php if($row_service['currency']=='AFG'){echo "selected"; } ?> >AFG</option>
					<option <?php if($row_service['currency']=='USD'){echo 'selected';}?> >USD</option>
				</select>
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					Photo:
				</span>
				<input type="file" name="photo" class="form-control">
				
			</div>
			<img src="<?php echo $row_service['photo']; ?>" style="width:80px;">
			<div class="input-group">
				<span class="input-group-addon">
					Timing:
				</span>
				<input  value="<?php echo $row_service['timing']; ?>" required type="text" name="timing" class="form-control">
			</div>
				
			<input type="submit" value="Register service" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>


<?php require_once("../layouts/footer_mis.php"); ?>