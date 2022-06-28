<?php require_once("../../config/connection.php"); ?>
<?php
     //  checkLevel($admin_level, $website_level, $stock_level, $hr_level, $finance_level, $surgery_level, $pharmacy_level, $laboratoar_level, $blood_bank_level, $patient_level)
	 checkLevel(2, 2, 9, 9, 9, 9, 9, 9, 9, 9);	



	
	if(isset($_POST["title"])) {
		$title = getValue($_POST["title"]);
		$source = getValue($_POST["source"]);
		$news_date = getValue($_POST["news_date"]);
	    $visit = 0;
		$description = getValue($_POST["description"]);

		// getting image and store in the disk 
		if($_FILES["news_file"]["name"] != "") { 
			$filetype = $_FILES["news_file"]["type"];
			
			if($filetype == "image/jpeg" || $filetype == "image/png" || $filetype == "image/gif") {
				if($_FILES["news_file"]["size"] <= 4 * 1024 * 1024) {		
					$path = "../../images/news/" . time() . $_FILES["news_file"]["name"];		
					$result = move_uploaded_file($_FILES["news_file"]["tmp_name"], $path);
					
					if(!$result) {
						header("location:news_add.php?upload=failed");
					}
				}
				else {
					header("location:news_add.php?filesize=invalid");
				}
			}
			else {
				header("location:news_add.php?filetype=invalid");
			}		
		}
		else {
			
			
		}
		
		
	
	   
		$result =mysqli_query($con, "INSERT INTO news VALUES (NULL, '$title', '$description','$path','$news_date','$source',$visit)");
		
		if($result) {
			header("location:news_list.php?add=done");
		}
		else {
			header("location:news_add.php?error=notadd");
		}
		
		
	}

?>
<?php require_once("../layouts/header.php"); ?>

<div class="panel panel-primary">
	<div class="panel-heading">
		<h1>Add New News</h1>
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
				Could not upload news news_file! Please try again!
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
					News_file:
				</span>
				<input type="file" name="news_file" class="form-control">
			</div>
			<div class="input-group">
				<span class="input-group-addon">
					News Date
				</span>
				<input type="text" autocomplete="off" name="news_date" class="form-control" id="newsDate">
			</div>
		    <div class="input-group">
				<span class="input-group-addon">
					Source:
				</span>
				<input type="text" name="source" class="form-control">
			</div>
				
			<input type="submit" value="Register news" class="btn btn-primary">
			
			</div>
			
		</form>
	</div>
</div>


<script type="text/javascript">
	Calendar.setup({
        inputField      :    "newsDate",
        ifFormat        :    "%Y-%m-%d",
        showsTime       :    false,
        timeFormat      :    "24"
    });
</script>

<?php require_once("../layouts/footer_mis.php"); ?>