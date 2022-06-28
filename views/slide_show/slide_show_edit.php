<?php require_once("../../config/connection.php"); ?>
<?php
    //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	checkLevel(4, 4, 9, 9, 9, 9, 9, 9, 9, 9);	

 
   if(isset($_GET['slide_show_id'])){
          $slide_show_id = getValue($_GET['slide_show_id']);
		  $slide_show = mysqli_query($con,"SELECT * FROM slide_show WHERE slide_show_id=$slide_show_id");
		  $row_slide_show = mysqli_fetch_assoc($slide_show);
   }
	
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
					unlink($row_slide_show['photo']);
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
			$path = $row_slide_show['photo'];
		}
		
		$result =mysqli_query($con, "UPDATE slide_show SET title='$title', description='$description',photo='$path' WHERE  slide_show_id=$slide_show_id");
		if($result) {
			header("location:slide_show_list.php?add=done");
		}
		else {
			header("location:slide_show_edit.php?error=notadd&slide_show_id=$slide_show_id");
		}
		
		
	}

?>
<?php require_once("../layouts/header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Edit slide_show</h1>
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
				Update failed! Please try again!
			</div>
		<?php } ?>
	
		<form method="post" enctype="multipart/form-data">
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			<div class="input-group">
				<span class="input-group-addon">
					Title:
				</span>
				<input value="<?php echo $row_slide_show['title'];?>" required type="text" name="title" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Description:
				</span>
				<textarea name="description" class="form-control" cols="30" rows="10">
                 <?php echo $row_slide_show['description'];?>
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
				<img src="<?php echo $row_slide_show['photo'];?>" style="width:80px;">
       		<div>

			
				
			<input type="submit" value="Save Changes" class="btn btn-primary">
			</div>
		</div>
			
		</form>
	</div>
</div>


<?php require_once("../layouts/footer_mis.php"); ?>