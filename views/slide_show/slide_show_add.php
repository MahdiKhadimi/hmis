<?php require_once("../../config/connection.php"); ?>
<?php
    //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	checkLevel(2, 2, 9, 9, 9, 9, 9, 9, 9, 9);	



	
	if(isset($_POST["title"])) {
		$title = getValue($_POST["title"]);
		$description = getValue($_POST["description"]);

		// getting image and store in the disk 
		if($_FILES["photo"]["name"] != "") { 
		
			$filetype = $_FILES["photo"]["type"];
			
			if($filetype == "image/jpeg" || $filetype == "image/png" || $filetype == "image/gif") {
				if($_FILES["photo"]["size"] <= 4 * 1024 * 1024) {		
					$path = "../../images/slide_show/" . time() . $_FILES["photo"]["name"];		
					$result = move_uploaded_file($_FILES["photo"]["tmp_name"], $path);
					
					if(!$result) {
						header("location:slide_show_add.php?upload=failed");
					}
				}
				else {
					header("location:slide_show_add.php?filesize=invalid");
				}
			}
			else {
				header("location:slide_show_add.php?filetype=invalid");
			}		
		}
		else {
			if($gender == 0) {
				$path = "../../images/slide_show/user_m.png";
			}
			else {
				$path = "../../images/slide_show/user_f.png";
			}
		}
		
		$result =mysqli_query($con, "INSERT INTO slide_show VALUES (NULL, '$title', '$description','$path')");
		if($result) {
			header("location:slide_show_list.php?add=done");
		}
		else {
			header("location:slide_show_add.php?error=notadd");
		}
		
		
	}

?>
<?php require_once("../layouts/header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Add New slide_show</h1>
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
				Could not upload slide_show photo! Please try again!
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
					Title:
				</span>
				<input required type="text" name="title" class="form-control">
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
					Photo:
				</span>
				<input type="file" name="photo" class="form-control">
			</div>
		
				
			<input type="submit" value="Register slide_show" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>


<?php require_once("../layouts/footer_mis.php"); ?>