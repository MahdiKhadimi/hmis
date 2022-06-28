<?php require_once("../../config/connection.php"); ?>
<?php

     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(4, 4, 9, 9, 9, 9, 9, 9, 9, 9);	

if(isset($_GET['advertisement_id'])){
	$advertisement_id = getValue($_GET['advertisement_id']);
	$advertisement = mysqli_query($con,"SELECT * FROM advertisement WHERE advertisement_id=$advertisement_id");
	$row_advertisement = mysqli_fetch_assoc($advertisement);
   }
   
	if(isset($_POST["title"])) {
		$title = getValue($_POST["title"]);
		$description = getValue($_POST["description"]);
		$url = getValue($_POST["url"]);
		$start_date = getValue($_POST["start_date"]);
		$end_date = getValue($_POST["end_date"]);	
		// getting image and store in the disk 
		if($_FILES["photo"]["name"] != "") { 
		
			$filetype = $_FILES["photo"]["type"];
			
			if($filetype == "image/jpeg" || $filetype == "image/png" || $filetype == "image/gif") {
				if($_FILES["photo"]["size"] <= 4 * 1024 * 1024) {		
					$path = "../../images/advertisement/" . time() . $_FILES["photo"]["name"];		
					$result = move_uploaded_file($_FILES["photo"]["tmp_name"], $path);
				   unlink($row_advertisement['photo']);	
					if(!$result) {
						header("location:advertisement_add.php?upload=failed");
					}
				}
				else {
					header("location:advertisement_add.php?filesize=invalid");
				}
			}
			else {
				header("location:advertisement_add.php?filetype=invalid");
			}		
		}
		else {
			 $path= $row_advertisement['photo'];
		}
		
		
	
	
	
		$result =mysqli_query($con, "UPDATE advertisement SET title='$title', description='$description', url='$url', photo='$path',start_date='$start_date',end_date='$end_date' WHERE advertisement_id=$advertisement_id");
	 
		if($result) {
			header("location:advertisement_list.php?add=done");
		}
		else {
			header("location:advertisement_edit.php?error=notadd&advertisement_id=$advertisement_id");
		}
		
		
	}

?>
<?php require_once("../layouts/header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Edit Advertisement</h1>
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
				Could not upload advertisement photo! Please try again!
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
				<input required value="<?php echo $row_advertisement['title'];?>" type="text" name="title" class="form-control">
			</div>
		
			<div class="input-group">
				<span class="input-group-addon">
					Description:
				</span>
				<textarea name="description" class="form-control" cols="30" rows="10">
                  <?php echo $row_advertisement['description'];?>
				</textarea>
			</div>
		</div>
			
			<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
			
			<div class="input-group">
				<span class="input-group-addon">
					Photo:
				</span>
				<input type="file" name="photo" class="form-control">
				<img src="<?php echo $row_advertisement['photo']?>" style="width:80px;" alt="advertisement photo">
			</div>

			<div class="input-group">
				<span class="input-group-addon">
					Url:
				</span>
				<input value="<?php echo $row_advertisement['url'];?>" type="text" autocomplete="off" name="url" class="form-control" >
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					Start Date:
				</span>
				<input value="<?php echo $row_advertisement['start_date'];?>" type="text" autocomplete="off" name="start_date" class="form-control" id="startDate">
			</div>
			

			<div class="input-group">
				<span class="input-group-addon">
					End Date:
				</span>
				<input value="<?php echo $row_advertisement['end_date'];?>"  type="text" autocomplete="off" name="end_date" class="form-control" id="endDate">
			</div>
			
		
		
			
		
			
			<input type="submit" value="Save Changes" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>

<script type="text/javascript">
	Calendar.setup({
        inputField      :    "startDate",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
	Calendar.setup({
        inputField      :    "endDate",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
</script>

<?php require_once("../layouts/footer_mis.php"); ?>